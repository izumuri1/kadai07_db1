<?php
// 共通関数を登録

/********************************************************************************************
DB接続: db_conn()
********************************************************************************************/
function db_conn(){
    // configを呼び出すおまじない
    $config = require(__DIR__ . '/config/db_config.php');

    try {
    // 接続情報はdb_config.phpを参照
    // $pdo = new PDO($dsn, $username, $password, $options);　第一引数にdbname、charset、hostを入れる
    // 第二引数にusername、第三引数にpasswordを指定する
    $pdo = new PDO(
            "mysql:dbname={$config['db']}; charset={$config['charset']}; host={$config['host']}",
            $config['user'], 
            $config['pass']
        );
    // $pdoは関数の外でも使いたいので　returnしておく
    // return $pdo;と書くことで「この関数を呼び出した場所にPDOオブジェクトを返す」ことができる
    return $pdo;

    } catch (PDOException $e) {
    exit('DBConnectError'.$e->getMessage());
    }
}

/********************************************************************************************
XSS対策: h()
********************************************************************************************/
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}