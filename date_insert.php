
<?php
try {
    //前画面から各情報を受け取る
    $miss = $_GET['miss'];
    $game_time = $_GET['game_time'];
    $player_name = $_GET['player_name'];

    //DBに接続
    $dsn = 'mysql:dbname=typinggame;host=localhost:1111;charset=utf8';
    $user = 'root'; //ユーザー名
    $password = ''; //パスワード（今回はなし）
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    //SQL
    $sql = 'INSERT INTO ranking(player_name,game_time,miss) VALUES (?,?,?)'; //入れたいデータは？で表現
    $stmt = $dbh->prepare($sql);
    $data[] = $player_name; //？にセットしたいデータが入っている変数を順番に書く
    $data[] = $game_time;
    $data[] = $miss;
    $stmt->execute($data); //SQL文で指令を出すための命令
    $dbh = null; //ﾃﾞｰﾀﾍﾞｰｽから切断する

    header('location:http://localhost/タイピングゲーム/ranking_view.php');
} catch (Exception $e) //DBｻｰﾊﾞｰ
{
    print 'ただいま障害により大変ご迷惑をお掛けしております。';
    exit(); //強制終了の命令
}


?>