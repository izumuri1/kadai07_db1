<?php

// 共通関数を呼び出すおまじない
require_once('funcs.php');

// ◆◆◆ 1. DB接続
// 頻繁にDB接続が発生するので、DB接続は共通関数とする
// 2.で$pdoを使うので、db_conn();の実行だけではなく、実行した戻り値を$pdoに代入する
$pdo = db_conn();

// 2. SQL（DBデータ取得）
$stmt = $pdo-> prepare("SELECT * FROM anyideas");
$status = $stmt -> execute();

// 3. データをHTMLへ表示するための前処理
// 格納のための箱を初期化
$data = [];
if ($status == false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  // Selectデータの数だけ自動でループしてくれる
  // PDO::FETCH_ASSOC は、fetchメソッドの「フェッチモード（取得形式）」を指定するための定数
  // このモードを指定すると、SQLの結果セットの1行を「カラム名をキーとしたオブジェクト」として返す
  // $resultはこのループの中だけで使用する一時的な変数（ループ変数）  
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    // .ドットがないと、$dataには最後の$resultしか格納されない
        $data[] = [
            // h()関数を利用してXSS対策
            'whenToDo' => h($result['whenToDo']),
            'whoWith'  => h($result['whoWith']),
            'whatToDo' => h($result['whatToDo'])
        ];
    }
}

// whenToDoを昇順で並び替え
usort($data, function($a, $b) {
    return strcmp($a['whenToDo'], $b['whenToDo']);
});

// PHPが出力するデータの種類を「JSON形式です」とブラウザやクライアントに伝えるためのおまじない
header('Content-Type: application/json');
// PHPの配列をJSON形式の文字列に変換する➡json_encode($data) をJSへ渡すため
echo json_encode($data);


?>