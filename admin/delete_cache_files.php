<?php

Deletetemplates('../templates_c/');

function Deletetemplates($fromdir, $recursed = 1 ) {
	if ($fromdir == "" or !is_dir($fromdir)) {
		echo ('Invalid directory');
		return false;
	}

	$filelist = array();
	$dir = opendir($fromdir);

	while($file = readdir($dir)) {
		if($file == "." || $file == ".." || $file == 'readme.txt' || $file == 'index.html' || $file == 'index.htm') {
			continue;
		} elseif (is_dir($fromdir."/".$file)) {
			if ($recursed == 1) {
				$temp = Deletetemplates($fromdir."/".$file, $recursed);
			}
		} elseif (file_exists($fromdir."/".$file) && filemtime($fromdir."/".$file)) {
			unlink($fromdir."/".$file);
         echo("Old cache files deleted.. <br />");
		}
	}

	closedir($dir);

	return true;
}


function DeleteFiles($fromdir, $recursed = 1 ) {
	if ($fromdir == "" or !is_dir($fromdir)) {
		echo ('Invalid directory');
		return false;
	}

	$filelist = array();
	$dir = opendir($fromdir);

	while($file = readdir($dir)) {
		if($file == "." || $file == ".." || $file == 'readme.txt' || $file == 'index.html' || $file == 'index.htm') {
			continue;
		} elseif (is_dir($fromdir."/".$file)) {
			if ($recursed == 1) {
				$temp = DeleteFiles($fromdir."/".$file, $recursed);
			}
		} elseif (file_exists($fromdir."/".$file) && filemtime($fromdir."/".$file)) {
			unlink($fromdir."/".$file);
		}
	}

	closedir($dir);

	return true;
}
?>
