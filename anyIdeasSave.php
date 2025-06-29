<?php

// 共通関数を呼び出すおまじない
require_once('funcs.php');


// ◆◆◆ 1. index.phpからPOSTデータ取得
$whenToDo = $_POST['whenToDo'];
$whoWith = $_POST['whoWith'];
$whatToDo = $_POST['whatToDo'];


// ◆◆◆ 2. DBへ接続➡DBへPOSTデータを登録➡データ登録処理後処理
// 2.(1) DB接続
// 頻繁にDB接続が発生するので、DB接続は共通関数とする
// 2.(2)で$pdoを使うので、db_conn();の実行だけではなく、実行した戻り値を$pdoに代入する
$pdo = db_conn();

// 2.(2) SQL（DBデータ登録）
// 2.(2).1 SQL文を用意
// SQLインジェクション対策のため、仮の箱としてプレースホルダを用意（例　:whenToDo）
$stmt = $pdo->prepare
  ("INSERT INTO anyideas(
        id, 
        whenToDo, 
        whoWith, 
        whatToDo, 
        date
    )
  VALUES(
        NULL, 
        :whenToDo, 
        :whoWith, 
        :whatToDo, 
        now())"
    );

// 2.(2).2 バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR
$stmt->bindValue(':whenToDo', $whenToDo, PDO::PARAM_STR);
$stmt->bindValue(':whoWith', $whoWith, PDO::PARAM_STR);
$stmt->bindValue(':whatToDo', $whatToDo, PDO::PARAM_STR);

// 2.(2).3 実行
$status = $stmt->execute();

// 2.(3) データ登録後処理
// 2.(3).1 実行エラー時の処理
if($status === false){
      $error = $stmt->errorInfo();
  exit('ErrorMessage:'.$error[2]);
}else{
    // 2.(3).2 index.php にリダイレクト
    header("Location: index.php");
    exit;
}

?>