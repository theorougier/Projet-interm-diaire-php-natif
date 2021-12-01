<?php
# Fill our vars and run on cli
# $ php -f db-connect-test.php

$dbname = 'phplogin';
$dbuser = 'root';
$dbpass = 'example';
$dbhost = 'edd48e466bf6';

$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$test_query = "SHOW TABLES FROM $dbname";
$result = mysqli_query($test_query);

$tblCnt = 0;
while($tbl = mysqli_fetch_array($result)) {
  $tblCnt++;
  #echo $tbl[0]."<br />\n";
}

if (!$tblCnt) {
  echo "There are no tables<br />\n";
} else {
  echo "There are $tblCnt tables<br />\n";
}