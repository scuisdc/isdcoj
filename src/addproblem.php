
<?php
header("Content-type: text/html; charset=utf-8");

require_once('ioj-mission-start.php');
require_once('./include/ioj-util-second.php');

$problemname = trim($_POST['problemname']);
$input = trim($_POST['input']);
$output = trim($_POST['output']);
$problemdescription = trim($_POST['problemdescription']);
$year = trim($_POST['year']);
$month = trim($_POST['month']);
$day = trim($_POST['day']);
$hour = trim($_POST['hour']);
$min = trim($_POST['min']);
$sec = trim($_POST['sec']);
$timelimit = trim($_POST['timelimit']);
$spacelimit = trim($_POST['spacelimit']);

$str = $year."-".$month."-".$day." ".$hour.":".$min.":".$sec;
$starttimestamp = mktime();
$endtimestamp = strtotime($str);
$endtime = strftime("%F %T", $endtimestamp);


$db = new mysqli(ISDCOJ_MYSQL_HOST, ISDCOJ_MYSQL_USER, ISDCOJ_MYSQL_PWD, ISDCOJ_MYSQL_DBNAME);
if(mysqli_connect_errno()) {
	echo "error"; }
$db->query("SET NAMES UTF8");
$problemname = $problemname;
$timelimit = $timelimit;
$spacelimit = $spacelimit;
$endtime = $endtime;
$problemdescription = $problemdescription;
$input = $input;
$output = $output;

$issue_fields = "(`".$IOJ_ISSUESC["id"]."`, `".$IOJ_ISSUESC["title"]."`, `".$IOJ_ISSUESC["time_comp"]."`, `".$IOJ_ISSUESC["space_comp"]."`, `".$IOJ_ISSUESC["begin"]."`, `".$IOJ_ISSUESC["end"]."`, `".$IOJ_ISSUESC["description"]."`, `".$IOJ_ISSUESC["in"]."`, `".$IOJ_ISSUESC["out"]."`, `".$IOJ_ISSUESC["numofAC"]."`)";
$insert = "INSERT INTO `" . ISDCOJ_MYSQL_TBISSUE . "` ". $issue_fields ." VALUES (NULL, '".$problemname."', '".$timelimit."', '".$spacelimit."', CURRENT_TIMESTAMP, '".$endtime."', '0','0','0','0');";
echo $insert;
$result = $db->query($insert);
echo $result;
$db->close();

$db1 = new mysqli(ISDCOJ_MYSQL_HOST, ISDCOJ_MYSQL_USER, ISDCOJ_MYSQL_PWD, ISDCOJ_MYSQL_DBNAME);
$db1->query("SET NAMES UTF8");
if(mysqli_connect_errno())  {
	echo "error";
}
$query = 'select * from ' . ISDCOJ_MYSQL_TBISSUE . ' where name = "'.$problemname.'" ORDER BY `' . $IOJ_ISSUESC["id"] . '` ASC;';
echo $query;

$result = $db1->query($query);
if($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$problemid = $row[$IOJ_ISSUESC["id"]];
}
$problemid = stripslashes($problemid);

echo $problemid."<br />";

$ori_path = ioj_path_join(ISDCOJ_PROBLEMS_PATH, $problemid) . '/';
echo $ori_path."<br />";
mkdir($ori_path, 0777, true);
echo "<script>alert(Successful);</script>";
$inputpath = ioj_path_join($ori_path, "input");
$outputpath = ioj_path_join($ori_path, "output");
$descriptionpath = ioj_path_join($ori_path, "description");

echo $inputpath."<br />";
echo $outputpath."<br />";
echo $descriptionpath."<br />";

$fpin = fopen($inputpath, "w");
$fpout = fopen($outputpath, "w");
$fpdes = fopen($descriptionpath, "w");

fwrite($fpin, $input);
fwrite($fpout, $output);
fwrite($fpdes, $problemdescription);

fclose($fpin);
fclose($fpout);
fclose($fpdes);

$path_replace_script = "python " . ioj_path_join(ISDCOJ_EXTERNAL_PATH, 'replace.py') . " ";

# secondwtq: WTF, should be something like foreach, map, whatever
#   not a repeat call.
system($path_replace_script . $inputpath);
system($path_replace_script . $outputpath);
system($path_replace_script . $descriptionpath);

$answer_dir = ioj_path_join($ori_path, "answer");
$cpp_dir = ioj_path_join($answer_dir, "cpp");
$java_dir = ioj_path_join($answer_dir, "java");
$py_dir = ioj_path_join($answer_dir, "py");
$html_dir = ioj_path_join($answer_dir, "html");
$php_dir = ioj_path_join($answer_dir, "php");
echo $answer_dir;
mkdir($answer_dir, 0777, true);
mkdir($cpp_dir, 0777, true);
mkdir($java_dir, 0777, true);
mkdir($py_dir, 0777, true);
mkdir($html_dir, 0777, true);
mkdir($php_dir, 0777, true);

$update = "update " . ISDCOJ_MYSQL_TBISSUE . " set ".$IOJ_ISSUESC["in"]." = '".$inputpath."', ".$IOJ_ISSUESC["out"]." = '".$outputpath."', ".$IOJ_ISSUESC["description"]." = '".$descriptionpath."'  where ".$IOJ_ISSUESC["title"]." = '".$problemname."'";
$db1->query($update);
$db1->close();


?>
