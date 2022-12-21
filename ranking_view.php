<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ランキング</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/earlyaccess/nicomoji.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c" rel="stylesheet">
</head>

<body>
    <!-- TODO:ランキングをDBから取得して表示する -->

</body>
<h1>ランキング</h1>
<?php
try {

    $dsn = 'mysql:dbname=typinggame;host=localhost:1111;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //DBからデータを取得（①ゲームタイムが短い②ミスタイプがすくない）
    $sql = 'SELECT player_name,game_time,miss FROM ranking ORDER BY game_time ASC, miss ASC';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null; //データベースから切断

    $ranking_num = 1;
    print '<div class="table_all">';
    print '<table border="1">
    <thead>
        <tr>
            <th>順位</th>
            <th>名前</th>
            <th>ゲームタイム</th>
            <th>ミスタイプ</th>
        </tr>
    </thead>
    <tbody>';
    while ($ranking_num <= 10) {
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($rec == false) {
            break;
        }
        print '<tr>
        <td>' . $ranking_num . '位</td>
        <td>' . $rec['player_name'] . '</td>
        <td>' . $rec['game_time'] . '秒</td>
        <td>' . $rec['miss'] . '回</td>
    </tr>';
        $ranking_num++;
    }
    print '</tbody>';
    print '</table>';
    print '<br><button type="button" class="btn-square-toy" id="reset2">もう一度始める</button>';
    print '</div>';
} catch (Exception $e) {
    print 'ただいま障害により大変ご迷惑をお掛けしております。';
    print '';
    exit();
}

?>

<script>
    let reset_btn = document.getElementById('reset2');
    reset_btn.addEventListener('click', function() {
        window.location.href = 'http://localhost/タイピングゲーム/index.html';
    }, false);
</script>

</html>