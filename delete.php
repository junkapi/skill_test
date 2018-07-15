<?php

// 削除する処理

  $dsn = 'mysql:dbname=skill_test1;host=localhost';
  $user = 'root';
  $password = '';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->query('SET NAMES utf8');

  $id = $_GET['id'];


  $sql = 'DELETE FROM `tasks` WHERE `id` = ?';

  $data[] = $id;

  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);



  $dbh = null;


// リダイレクト
    header("Location: schedule.php");
    exit();
