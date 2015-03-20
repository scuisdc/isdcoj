<!DOCTYPE html>
<html>
<head>
    <title>训练平台 四川大学信息安全与网络攻防协会</title>
    <?php
      session_start();
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
    <?php $_home_class='""';$_blog_class='""';$_game_class='""';$_train_class='"active"';$_about_class='"dropdown"';require '../navi.inc.php';?>

    <header id="head" class="secondary"></header>

    <div class="container">
      <ol class="breadcrumb">
        <li><a href="index.php">训练平台</a></li>
        <li class="active">题目添加</li>
      </ol>
      
      <div>
          <header class="page-header">
            <h1 class="page-title">题目添加</h1>
          </header>

          <form class="form-horizontal" role="form" accept-charset="UTF-8" method="POST" action="addproblem.php" name="form">
          <div class="form-group">
              <label class="col-sm-2 control-label">题目名称</label>
              <div class="col-sm-10">
                <input placeholder="inputname" name="problemname" size="15" type="text">
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label">DEADLINE</label>
              <div class="col-sm-10">
                <input placeholder="year" name="year" size="5">
                <input placeholder="month" name="month" size="5">
                <input placeholder="day" name="day" size="5">
                <input placeholder="hour" name="hour" size="5">
                <input placeholder="min" name="min" size="5">
                <input placeholder="sec" name="sec" size="5">
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label">时间复杂度</label>
              <div class="col-sm-10">
                <input name="timelimit" placeholder="time limit" size="8">
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label">空间复杂度</label>
              <div class="col-sm-10">
                <input name="spacelimit" placeholder="space limit" size="8">
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label">输入</label>
              <div class="col-sm-10">
                <textarea placeholder="input" name="input" row="5" cols="90"></textarea>
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label">输出</label>
              <div class="col-sm-10">
                <textarea placeholder="output" name="output" row="5" cols="90"></textarea>
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label">题目描述</label>
              <div class="col-sm-10">
                <textarea rows="9" cols="90" placeholder="description" name="problemdescription"></textarea>
              </div>
          </div>
          <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <input class="btn btn-primary pds" value="提交按钮" type="submit">
              </div>
          </div>
        </form>
      </div>
    </div>
</body>
<?php require('../footer.inc.php');?>
</html>
