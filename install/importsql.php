<?php
ini_set('display_errors',1);
ini_set('error_reporting',E_ALL);
set_time_limit(0);
	//ini_set('memory_limit', '-1');
	@ini_set("max_execution_time", 1000);
	@ini_set("default_socket_timeout", 240);

// Name of the file
$filename = 'quran.sql';
// MySQL host
$mysql_host = 'localhost';
// MySQL username
$mysql_username = 'root';
// MySQL password
$mysql_password = '12345678';
// Database name
$mysql_database = 'api_alquran';

// Connect to MySQL server
$db = mysqli_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysqli_error());
// Select database
mysqli_select_db($db,$mysql_database) or die('Error selecting MySQL database: ' . mysqli_error());

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
// Skip it if it's a comment
if (substr($line, 0, 2) == '--' || $line == '')
    continue;

// Add this line to the current segment
$templine .= $line;
// If it has a semicolon at the end, it's the end of the query
if (substr(trim($line), -1, 1) == ';')
{
    // Perform the query
    mysqli_query($db,$templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_error() . '<br /><br />');
    // Reset temp variable to empty
    $templine = '';
}
}
 echo "Tables imported successfully";
?>
