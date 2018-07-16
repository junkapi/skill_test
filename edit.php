<?php

  $dsn = 'mysql:dbname=skill_test1;host=localhost';
  $user = 'root';
  $password = '';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->query('SET NAMES utf8');

  $id = $_GET['id'];


  $sql = 'SELECT * FROM `tasks` WHERE `id` = ?';

  $data[] = $id;

  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);


  $comment = $stmt->fetch(PDO::FETCH_ASSOC);



  $dbh = null;



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

        <form method="POST" action="update.php">
          <div class="form-group">
            <label for="task" style="font-family: 'Hannotate SC',sans-serif;">タスク</label>
            <input name="title" class="form-control" value="<?php echo $comment['title'] ?>">
            <input type="hidden" name="id" value="<?php echo $comment['id'] ?>">
          </div>
          <div class="form-group">
            <label for="date" style="font-family: 'Hannotate SC',sans-serif;">日程</label>
            <input type="date" name="date" class="form-control" value="<?php echo $comment['date'] ?>">
          </div>
          <div class="form-group">
            <label for="detail" style="font-family: 'Hannotate SC',sans-serif;">詳細</label>
            <textarea name="detail" class="form-control" rows="3" value="<?php echo $comment['detail'] ?>"></textarea><br>
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