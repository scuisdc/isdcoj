<!DOCTYPE html>

<html>
<head>
	<title>训练平台 四川大学软件学院信息安全与网络攻防协会</title>
	<?php
	session_start();
	session_start();
	if (!isset($_SESSION['valid_user'])) {
		echo '<script>window.location.href="index.php";</script>';
	}
	require('../header.inc.php');
	?>
	<script src="/assets/js/jQuery.headroom.min.js" type="text/javascript"></script>
	<script src="/assets/js/jquery.min.js" type="text/javascript"></script>
	<style>
		.btn-primary { 
			color:#FFEFD7; ient(top, #FF9B22 0%, #FF8C00 100%); 
			background-image: none; 
		}
		.pds{
			margin-bottom: 20px;
		}
	</style>
</head>
<body>
	
<?php $_home_class='""';$_blog_class='""';$_game_class='""';$_train_class='"active"';$_about_class='"dropdown"';require('../navi.inc.php'); ?>

<?php
    require_once('ioj-mission-start.php');
    require_once('./include/ioj-util-second.php');
?>

<header id="head" class="secondary"></header>
<div class="container">
	<ol class="breadcrumb">
				<li><a href="index.php">训练平台</a></li>
				<li><a href="problemlist.php">答题列表</a></li>
				<li class="active">题目描述</li>
		</ol>
		<?php
			function getfilecontent($filedir)
			{
				$str = "";
				$file = fopen($filedir, "r");
				if($file)
				{
					$ch = fgetc($file);
                                while(!feof($file))
                                {
                                        $str = $str.$ch;
                                        $ch = fgetc($file);
                                }
                                return $str;
				}
				else echo "no such file";
			}

            $db = new mysqli(ISDCOJ_MYSQL_HOST, ISDCOJ_MYSQL_USER, ISDCOJ_MYSQL_PWD, ISDCOJ_MYSQL_DBNAME);
            ioj_check_db_error();
            $db->query("set character set 'utf8'");
            $db->query("set names 'utf8'");
			$id=$_GET["id"];
			//$id = $db->real_escape_string($id);
			$query = "SELECT * FROM " . ISDCOJ_MYSQL_TBISSUE . " where id=".$id;
			$result = $db->query($query);
			if($row = $result->fetch_array(MYSQLI_ASSOC)){
				echo '<div class="page-header" align="center">
							<h1>'.$row[$IOJ_ISSUESC["id"]].'  '.$row[$IOJ_ISSUESC["title"]].'</h1><br/>
							<h6><small>Start Time: '.$row[$IOJ_ISSUESC["begin"]].'  '.'End Time: '.$row[$IOJ_ISSUESC["end"]].'</small></h6>
						</div>';
						// time limit:'.$row['TL'].'  '.'memory limit:'.$row['ML'].'  '.'
				$endtime = $row[$IOJ_ISSUESC["end"]];
				echo '<div class="panel panel-default">
						  <div class="panel-heading">Description</div>
						  <div class="panel-body">'.
						  getfilecontent($row[$IOJ_ISSUESC["description"]])
						  .'</div>
						</div>';
				echo '<div class="panel panel-default">
						  <div class="panel-heading">Input</div>
						  <div class="panel-body">'.
						    getfilecontent($row[$IOJ_ISSUESC["in"]])
						  .'</div>
						</div>';
				echo '<div class="panel panel-default">
						  <div class="panel-heading">Output</div>
						  <div class="panel-body">'.
						    getfilecontent($row[$IOJ_ISSUESC["out"]])
						  .'</div>
						</div>';
			}
			$time = time();
			$endtime = strtotime($endtime);
			if ($time < $endtime) {
				echo'<div class align="center">
				<button type="button" id="SubmitButton" class="btn btn-primary pds">Submit</button>

				<script>
				  $("#SubmitButton").on("click", function () {
						location.href = "./submit.php?id='.$id.'"; })
				</script>
				</div>';
			} 
			$db.close();
		?>
</div>
<?php require('../footer.inc.php');?>
</body>
</html>
