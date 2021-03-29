<?php
foreach (range('ا', 'ي') as $letter) {
echo $letter;	
	
}
//print_r(ResourceBundle::getLocales(''));
$str = 'ا ب پ ت ث ج چ ح خ د ذ ر ز ژ ص ض ط ظ ع غ ف ق ک گ ل م ن و ه ی';
$arr = explode(' ', $str);

//setlocale(LC_ALL, 'ar');
//asort($arr, SORT_LOCALE_STRING);
//var_dump($arr);
$col = new \Collator('ar');
$col->asort($arr);
var_dump($arr);

function ords_to_unistr($ords, $encoding = 'UTF-8') {
    // Turns an array of ordinal values into a string of unicode characters
    $str = '';
    for ($i = 0; $i < count($ords); $i++) {
        // Pack this number into a 4-byte string
        // (Or multiple one-byte strings, depending on context.)
        $v = $ords[$i];
        $str .= pack("N",$v);
    }
    $str = mb_convert_encoding($str,$encoding,"UCS-4BE");
    return($str);
}

function unistr_to_ords($str, $encoding = 'UTF-8') {
    // Turns a string of unicode characters into an array of ordinal values,
    // Even if some of those characters are multibyte.
    $str = mb_convert_encoding($str,"UCS-4BE",$encoding);
    $ords = array();

    // Visit each unicode character
    for ($i = 0; $i < mb_strlen($str,"UCS-4BE"); $i++) {
        // Now we have 4 bytes. Find their total
        // numeric value.
        $s2 = mb_substr($str,$i,1,"UCS-4BE");
        $val = unpack("N",$s2);
        $ords[] = $val[1];
    }
    return($ords);
}

function alphabet($firstCharacter = 'A', $lastCharacter = 'Z') {
    $firstCharacterValue = unistr_to_ords($firstCharacter)[0];
    $lastCharacterValue = unistr_to_ords($lastCharacter)[0];

    if ($firstCharacterValue < $lastCharacterValue) {
        for ($character = $firstCharacterValue; $character <= $lastCharacterValue; ++$character) {
            yield ords_to_unistr(array($character));
        };
    } else {
        for ($character = $firstCharacterValue; $character >= $lastCharacterValue; --$character) {
            yield ords_to_unistr(array($character));
        };
    }
}

foreach (alphabet('ا', 'ي') as $letter) {
    echo $letter;

$countext = preg_match_all('/\p{Arabic}/u',$letter,$match);
print_r($match);
}

if (!function_exists('utf8_str_word_count')){
     function utf8_str_word_count($string, $format = 0, $charlist = null) {
            if ($charlist === null) {
                $regex = '/\\pL[\\pL\\p{Mn}\'-]*/u';
            }
            else {
                $split = array_map('preg_quote',
                preg_split('//u',$charlist,-1,PREG_SPLIT_NO_EMPTY));
                $regex = sprintf('/(\\pL|%1$s)([\\pL\\p{Mn}\'-]|%1$s)*/u',
                implode('|', $split));
            }
            switch ($format) {
                default:
                case 0:
                    // For PHP >= 5.4.0 this is fine:
                    return preg_match_all($regex, $string);
        
                    // For PHP < 5.4 it's necessary to do this:
                    // $results = null;
                    // return preg_match_all($regex, $string, $results);
                case 1:
                    $results = null;
                    preg_match_all($regex, $string, $results);
                    return $results[0];
                case 2:
                    $results = null;
                    preg_match_all($regex, $string, $results, PREG_OFFSET_CAPTURE);
                    return empty($results[0])
                            ? array()
                            : array_combine(
                                array_map('end', $results[0]),
                                array_map('reset', $results[0]));
            }
         }
       }