<?php

 date_default_timezone_set("Asia/Manila");


  $dsn = 'mysql:dbname=skill_test1;host=localhost';
  $user = 'root';
  $password = '';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->query('SET NAMES utf8');

  if (!empty($_POST)) {

    $title = htmlspecialchars($_POST['title']);
    $date = $_POST['date'];
    $detail = htmlspecialchars($_POST['detail']);


    if (!empty($title || $detail)) {

      $sql = 'INSERT INTO `tasks`(`title`, `date`, `detail`) VALUES (?,?,?)';

      $data[] = $title;
      $data[] = $date;
      $data[] = $detail;

      $stmt = $dbh->prepare($sql);
      $stmt->execute($data);
    }
  }

  $sql = 'SELECT * FROM `tasks` ORDER BY `date` DESC';
  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  $comments = array();
  while (1) {
  // データを１件ずつ取得
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($rec == false) {
         break;
      }

       $comments[] = $rec;
  }

  $dbh = null  


?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Skill Test</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body style="margin-top: 60px">
  <div class="container">
    <div class="row">
      <div class="col-xs-8 col-xs-offset-2 thumbnail">
        <h2 class="text-center content_header" style="font-family: 'Hannotate SC',sans-serif;">タスク追加</h2>

        <form method="POST" action="schedule.php">
          <div class="form-group">
            <label for="task" style="font-family: 'Hannotate SC',sans-serif;">タスク</label>
            <input name="title" class="form-control" placeholder="title" required>
          </div>
          <div class="form-group">
            <label for="date" style="font-family: 'Hannotate SC',sans-serif;">日程</label>
            <input type="date" name="date" class="form-control" placeholder="date" required>
          </div>
          <div class="form-group">
            <label for="detail" style="font-family: 'Hannotate SC',sans-serif;">詳細</label>
            <textarea name="detail" class="form-control" rows="3" placeholder="detail" required></textarea><br>
          </div>
          <input type="submit" class="btn btn-primary" value="投稿">
        </form>

      </div>
    </div>
  </div>
  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
</body>
</html>