<?php


// 不正を防ぐ
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db2;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
  exit('DBConnectError'.$e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table;");

// 実行する
$status = $stmt->execute();

//３．データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  // while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
  //   $view .= '<td>' . $result['ID'] . '</td>' . `<td>` . h($result['book']) .  '</td>' . `<td>` .h($result['book_url']) .  '</td>' . `<td>` .h($result['content']) .   '</td>';
  // }

  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    // $view .= '<p>' . $result['No'] . ' / ' . h($result['title']) . ' / ' . h($result['comment']) . ' / ' . h($result['book_url']) . '</p>' ;
    $id = $result['id'];
    $book = h($result['book']);
    $content = h($result['content']);
    $book_url = h($result['book_url']);
    $date = $result['date'];

    $view .= "
    <tr>
      <td>{$id}</td>
      <td>{$date}</td>
      <td><a href='{$book_url}'>{$book}</a></td>
      <td>{$content}</td>
    </tr>
    ";
  }

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/style.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<table class="form-table">
      <tr>
        <td style="width:100px">番号</td>
        <td style="width:400px">登録日時</td>
        <td style="width:400px">タイトル</td>
        <td style="width:400px">コメント</td>
      </tr>
      <?= $view ?>
</table> 
<!-- Main[End] -->

</body>
</html>
