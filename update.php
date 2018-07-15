<?php

// 削除する処理

    $dsn = 'mysql:dbname=skill_test1;host=localhost';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->query('SET NAMES utf8');


// なぜ$id,$nickname,$commentなのか
//    →edit.phpのinputのnameがそれぞれの名前だから
    $id = htmlspecialchars($_POST['id']);
    $title = htmlspecialchars($_POST['title']);
    $date = $_POST['date'];
    $detail = htmlspecialchars($_POST['detail']);


// 方法①
    // $sql = 'UPDATE `posts` SET `nickname` = :nickname, `comment` = :comment WHERE id = :id';
    $sql = 'UPDATE `tasks` SET `title` = ?, `date` = ?, `detail` = ? WHERE `id` = ?';
    $date = [$title, $date, $detail, $id];
    $stmt = $dbh->prepare($sql);
    $stmt->execute($date);


// // 方法②

//     $sql = 'UPDATE `posts` SET `nickname` = ?, `comment` = ? WHERE `id` = ?';


//     $date = [$nickname, $comment, $id];
        // 配列に値を追加して入れている

    // $date[] = $nickname;
        // 配列に値を入れている

//     $stmt = $dbh->prepare($sql);
//     $stmt->execute($date);

    $dbh = null;


// リダイレクト
    header("Location: schedule.php");
    exit();
