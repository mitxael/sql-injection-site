<?php

function launchDbScript($sqlFileToExecute, $selectDb, $reportError)
{
	$link = mysql_connect(DB_SERVER, DB_USER, DB_PWD);
	if (!$link && $reportError) {
	  echo "Error : MySQL Connection error";
	}
	 
	if ($selectDb)
		mysql_select_db(DB_NAME, $link);
	 
	// read the sql file
	$f = fopen($sqlFileToExecute,"r+");
	$sqlFile = fread($f, filesize($sqlFileToExecute));
	$sqlArray = explode(';',$sqlFile);
	$sqlErrorCode = 0;
	foreach ($sqlArray as $stmt) {
	  if (strlen($stmt)>3 && substr(ltrim($stmt),0,2)!='/*') {
		$result = mysql_query($stmt);
		if (!$result) {
		  $sqlErrorCode = mysql_errno();
		  $sqlErrorText = mysql_error();
		  $sqlStmt = $stmt;
		  break;
		}
	  }
	}
	if ($sqlErrorCode == 0) {
	  echo "Script is executed succesfully!<br />";
	} else if ($reportError) {
	  echo "An error occured during script!<br/>";
	  echo "Error code: $sqlErrorCode<br/>";
	  echo "Error text: $sqlErrorText<br/>";
	  echo "Statement:<br/> $sqlStmt<br/>";
	}
}
 
?>