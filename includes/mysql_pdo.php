<?php
/**
 * Simple MySQLi Class 0.3
 *
 * @author      JReam
 * @license     GNU General Public License 3 (http://www.gnu.org/licenses/)
 *
 * This program is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the
 * Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details:
 * http://www.gnu.org/licenses/
 *
 * @uses    ----------------------------------------
 *
        // A Config array should be setup from a config file with these parameters:
        $config = array();
        $config['host'] = 'localhost';
        $config['user'] = 'root';
        $config['pass'] = '';
        $config['table'] = 'table';

        // Then simply connect to your DB this way:
        $db = new DB($config);

        // Run a Query:
        $db->query('SELECT * FROM someplace');

        // Get an array of items:
        $result = $db->get();
        print_r($result);
        
        // Optional fetch modes (1 and 2)
        $db->setFetchMode(1);
        
        // Get a single item:
        $result = $db->get('field');
        print_r($result);

        What you do with displaying the array result is up to you!
        ----------------------------------------
 */

class DB
{

    /**
    * @var <str> The mode to return results, defualt is PDO::FETCH_BOTH, use setFetchMode() to change.
    */
    private $fetchMode = PDO::FETCH_BOTH;
    
    /**
    * @desc     Creates the pdo object for usage.
    *
    * @param    <arr> $db Required connection params.
    */
    public function  __construct($db) {
		$this->host = $db['host'];
		$this->user = $db['user'];
		$this->pass = $db['pass'];
		$this->db = $db['table'];
        $this->charset = 'utf8mb4';
     $this->dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
     $this->options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::ATTR_PERSISTENT => false,
	//PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
	PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci",
            ];
           try {
     $this->pdo = new PDO($this->dsn, $this->user, $this->pass, $this->options);
         } catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
         }
    }
    
    /** 
    * @desc     Optionally set the return mode.
    *
    * @param    <int> $type The mode: 1 for PDO::FETCH_NUM, 2 for PDO::FETCH_ASSOC, default is PDO::FETCH_BOTH
    */
    public function setFetchMode($type)
    {
        switch($type)
        {           
            case 1:
            $this->fetchMode = PDO::FETCH_NUM;
            break;
            
            case 2:
            $this->fetchMode = PDO::FETCH_ASSOC;
            break;
            
            default:
            $this->fetchMode = PDO::FETCH_BOTH;
            break;

        }

    }

    /**
     * @desc    Simple preparation to clean the SQL/Setup result Object.
     *
     * @param   <str> SQL statement
     * @return  <bln|null>
     */
    public function query($SQL)
    {
		//$SQL = str_replace("'", "",$SQL);
		/*if (is_integer($item))
			{
				$bindType = PDO::PARAM_INT;
			}
			elseif (is_float($item))
			{
				$bindType = PDO::PARAM_STR;
			}
			else
			{
				$bindType = PDO::PARAM_STR;
			}
			*/
        //$this->SQL = $this->pdo->quote($SQL,PDO::PARAM_STR);
	     $this->SQL = $SQL;
		 $search  = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
         $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");
         $this->SQL     = str_replace($search, $replace, $this->SQL);
         
         $this->result = $this->pdo->query($SQL);

        if ($this->result == true)
        {
            return true;
        }
        else
        {
            printf("<b>Problem with SQL:</b> %s\n", $this->SQL);
            exit;
        }
    }

    /**
     * @desc    Get the results
     *
     * @param   <str|int> $field Select a single field, or leave blank to select all.
     * @return  <mixed>
     */
    public function get($field = NULL)
    {
        if ($field == NULL)
        {
            /** Grab all the data */
            $data = array();

            $row = $this->result->fetchAll($this->fetchMode);
            
                $data = $row;
				
            
        }
        else
        {
			$data = array();
            /** Select the specific row */
            $row = $this->result->fetchAll($this->fetchMode);
             if ($row)
             {
            $data = $row[0][$field];
            } 
     		}
       
        /** Make sure to close the result Set */
        //$this->pdo = null;

        return $data;

    }
    
    /**
    * @desc     Returns the automatically generated insert ID
    *           This MUST come after an insert Query.
    */
    public function id()
    {
        return $this->pdo->lastInsertId();
    }

    /**
     * @desc    Automatically close the connection when finished with this object.
     */
    public function __destruct()
    {
        $this->pdo = null;

    }

}