<?php
class Arabic_Query
{
    private $arQueryFields          = array();
    private $arQueryLexPatterns     = array();
    private $arQueryLexReplacements = array();
    private $arQueryMode            = 0;
        
    public function __construct()
    {
	 $this->rootDirectory = dirname(__FILE__);
    
        $json = json_decode(file_get_contents($this->rootDirectory . '/data/ar_query.json'), true);

        foreach ($json['preg_replace']['pair'] as $pair) {
            array_push($this->arQueryLexPatterns, (string)$pair['search']);
            array_push($this->arQueryLexReplacements, (string)$pair['replace']);
        }
      }
    
	public function setQueryArrFields($arrConfig)
    {
        if (is_array($arrConfig)) {
            // Get arQueryFields array
            $this->arQueryFields = $arrConfig;
        }
        return $this;
    }

     public function setQueryStrFields($strConfig)
    {
        if (is_string($strConfig)) {
            // Get arQueryFields array
            $this->arQueryFields = explode(',', $strConfig);
        }
        return $this;
    }

    public function setQueryMode($mode)
    {
        if (in_array($mode, array('0', '1'))) {
            // Set search mode [0 for OR logic | 1 for AND logic]
            $this->arQueryMode = $mode;
        }

        return $this;
    }

    public function getQueryMode()
    {
        // Get search mode value [0 for OR logic | 1 for AND logic]
        return $this->arQueryMode;
    }

   public function getQueryArrFields()
    {
        $fields = $this->arQueryFields;

        return $fields;
    }

    public function getQueryStrFields()
    {
        $fields = implode(',', $this->arQueryFields);

        return $fields;
    }

   public function arQueryWhereCondition($arg)
    {
        $sql = '';

        //$arg   = mysql_real_escape_string($arg);
        $search  = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
        $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");
        $arg     = str_replace($search, $replace, $arg);

        // Check if there are phrases in $arg should handle as it is
        $phrase = explode("\"", $arg);

        if (count($phrase) > 2) {
            // Re-init $arg variable
            // (It will contain the rest of $arg except phrases).
            $arg = '';

            for ($i = 0; $i < count($phrase); $i++) {
                $subPhrase = $phrase[$i];
                if ($i % 2 == 0 && $subPhrase != '') {
                    // Re-build $arg variable after restricting phrases
                    $arg .= $subPhrase;
                } elseif ($i % 2 == 1 && $subPhrase != '') {
                    // Handle phrases using reqular LIKE matching in MySQL
                    $wordCondition[] = $this->getWordLike($subPhrase);
                }
            }
        }

        // Handle normal $arg using lex's and regular expresion
        $words = preg_split('/\s+/', trim($arg));

        foreach ($words as $word) {
            //if (is_numeric($word) || strlen($word) > 2) {
                // Take off all the punctuation
                //$word = preg_replace("/\p{P}/", '', $word);
                $exclude = array('(', ')', '[', ']', '{', '}', ',', ';', ':', '?', '!', '،', '؛', '؟');
                $word    = str_replace($exclude, '', $word);

                $wordCondition[] = $this->getWordRegExp($word);
            //}
        }

        if (!empty($wordCondition)) {
            if ($this->arQueryMode == 0) {
                $sql = '(' . implode(') OR (', $wordCondition) . ')';
            } elseif ($this->arQueryMode == 1) {
                $sql = '(' . implode(') AND (', $wordCondition) . ')';
            }
        }

        return $sql;
    }
    private function getWordRegExp($arg)
    {
        $arg = $this->arQueryLex($arg);
        //$sql = implode(" REGEXP '$arg' OR ", $this->_fields) . " REGEXP '$arg'";
        $sql = ' REPLACE(' . implode(", 'ـ', '') REGEXP '$arg' OR REPLACE(", $this->arQueryFields) .
               ", 'ـ', '') REGEXP '$arg'";

        return $sql;
    }
   private function getWordLike($arg)
    {
        $sql = implode(" LIKE '$arg' OR ", $this->arQueryFields) . " LIKE '$arg'";

        return $sql;
    }
public function arQueryOrderBy($arg)
    {
        // Check if there are phrases in $arg should handle as it is
        $phrase = explode("\"", $arg);
        if (count($phrase) > 2) {
            // Re-init $arg variable (It will contain the rest of $arg except phrases).
            $arg = '';
            for ($i = 0; $i < count($phrase); $i++) {
                if ($i % 2 == 0 && isset($phrase[$i])) {
                    // Re-build $arg variable after restricting phrases
                    $arg .= $phrase[$i];
                } elseif ($i % 2 == 1 && isset($phrase[$i])) {
                    // Handle phrases using reqular LIKE matching in MySQL
                    $wordOrder[] = $this->getWordLike($phrase[$i]);
                }
            }
        }

        // Handle normal $arg using lex's and regular expresion
        $words = explode(' ', $arg);
        foreach ($words as $word) {
            if ($word != '') {
                $wordOrder[] = 'CASE WHEN ' . $this->getWordRegExp($word) . ' THEN 1 ELSE 0 END';
            }
        }

        $order = '((' . implode(') + (', $wordOrder) . ')) DESC';

        return $order;
    }
   private function arQueryLex($arg)
    {
        $arg = preg_replace($this->arQueryLexPatterns, $this->arQueryLexReplacements, $arg);

        return $arg;
    }

    private function arQueryAllWordForms($word)
    {
        $wordForms = array($word);

        $postfix1 = array('كم', 'كن', 'نا', 'ها', 'هم', 'هن');
        $postfix2 = array('ين', 'ون', 'ان', 'ات', 'وا');

        $len = mb_strlen($word, 'UTF-8');

        if (mb_substr($word, 0, 2, 'UTF-8') == 'ال') {
            $word = mb_substr($word, 2, mb_strlen($word, 'UTF-8'), 'UTF-8');
        }

        $wordForms[] = $word;

        $str1 = mb_substr($word, 0, -1, 'UTF-8');
        $str2 = mb_substr($word, 0, -2, 'UTF-8');
        $str3 = mb_substr($word, 0, -3, 'UTF-8');

        $last1 = mb_substr($word, -1, mb_strlen($word, 'UTF-8'), 'UTF-8');
        $last2 = mb_substr($word, -2, mb_strlen($word, 'UTF-8'), 'UTF-8');
        $last3 = mb_substr($word, -3, mb_strlen($word, 'UTF-8'), 'UTF-8');

        if ($len >= 6 && $last3 == 'تين') {
            $wordForms[] = $str3;
            $wordForms[] = $str3 . 'ة';
            $wordForms[] = $word . 'ة';
        }

        if ($len >= 6 && ($last3 == 'كما' || $last3 == 'هما')) {
            $wordForms[] = $str3;
            $wordForms[] = $str3 . 'كما';
            $wordForms[] = $str3 . 'هما';
        }

        if ($len >= 5 && in_array($last2, $postfix2)) {
            $wordForms[] = $str2;
            $wordForms[] = $str2 . 'ة';
            $wordForms[] = $str2 . 'تين';

            foreach ($postfix2 as $postfix) {
                $wordForms[] = $str2 . $postfix;
            }
        }

        if ($len >= 5 && in_array($last2, $postfix1)) {
            $wordForms[] = $str2;
            $wordForms[] = $str2 . 'ي';
            $wordForms[] = $str2 . 'ك';
            $wordForms[] = $str2 . 'كما';
            $wordForms[] = $str2 . 'هما';

            foreach ($postfix1 as $postfix) {
                $wordForms[] = $str2 . $postfix;
            }
        }

        if ($len >= 5 && $last2 == 'ية') {
            $wordForms[] = $str1;
            $wordForms[] = $str2;
        }

        if (
            ($len >= 4 && ($last1 == 'ة' || $last1 == 'ه' || $last1 == 'ت'))
            || ($len >= 5 && $last2 == 'ات')
        ) {
            $wordForms[] = $str1;
            $wordForms[] = $str1 . 'ة';
            $wordForms[] = $str1 . 'ه';
            $wordForms[] = $str1 . 'ت';
            $wordForms[] = $str1 . 'ات';
        }

        if ($len >= 4 && $last1 == 'ى') {
            $wordForms[] = $str1 . 'ا';
        }

        $trans = array('أ' => 'ا', 'إ' => 'ا', 'آ' => 'ا');
        foreach ($wordForms as $word) {
            $normWord = strtr($word, $trans);
            if ($normWord != $word) {
                $wordForms[] = $normWord;
            }
        }

        $wordForms = array_unique($wordForms);

        return $wordForms;
    }
  public function arQueryAllForms($arg)
    {
        $wordForms = array();
        $words     = explode(' ', $arg);

        foreach ($words as $word) {
            $wordForms = array_merge($wordForms, $this->arQueryAllWordForms($word));
        }

        $str = implode(' ', $wordForms);

        return $str;
    }
}