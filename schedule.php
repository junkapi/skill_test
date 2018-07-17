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

  $sql = 'SELECT * FROM `tasks` ORDER BY `date` ASC';
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
      <div class="col-xs-10 col-xs-offset-1">

        <h2 class="text-center content_header" style="font-family: 'Hannotate SC',sans-serif;">タスク管理</h2>

          <div class="col-xs-4">
            <div style="position: fixed;">
            <a href="post.php" class="btn btn-primary button" style="font-family: 'Hannotate SC',sans-serif;">追加</a>
            </div>
          </div>

           <div class="col-xs-8">
            <?php  foreach ($comments as $comment): ?>
            <div class="task">
             <h2 style="font-family: 'Hannotate SC',sans-serif;"><span><?php echo $comment['date'] ?></span></h2>
              <div class="box14">
               <h3 style="font-family: 'Hannotate SC',sans-serif;">
                <a href="detail.php" style="font-weight: bold;"><?php echo $comment['title'] ?></a>
                <a href="edit.php?id=<?php echo $comment["id"]; ?>" class="btn btn-success" style="color: white">編集</a>
                <a href="delete.php?id=<?php echo $comment["id"]; ?>" class="btn btn-danger" style="color: white">削除</a></h3>
                <p style="font-family: 'Hannotate SC',sans-serif;"><?php echo $comment['detail'] ?></p>
              </div>
            </div>
           <?php endforeach; ?>
          </div>


      </div>
    </div>
  </div>

  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
</body>
</html>