<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>らんきんぐ</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/earlyaccess/nicomoji.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c" rel="stylesheet">
</head>

<body>
    <?php
    //前画面からゲームのスコアを受け取る
    try {
        $miss = $_GET['miss']; //ミスタイプの数
        $game_time = $_GET['game_time']; //ゲームタイム
    } catch (Exception $e) //DBｻｰﾊﾞｰ
    {
        print 'ただいま障害により大変ご迷惑をお掛けしております。';
        exit(); //強制終了の命令
    }
    ?>


    <div class="recode">
        <h3>ランキングに登録する<br>
            名前を入力してください</h3>
        <!-- 名前入力フォーム -->
        <!-- <form action="date_insert.php" method="post"> -->
        <input type="text" id="player_name" />
        <input id="OK" type="submit" class="btn-square-toy" value="ＯＫ">
        <!-- </form> -->
    </div>




    <!-- TODO：※ここから名前を入力させた後、スコアと一緒に【date_insert.php】に渡してDBに登録 -->
    <script>
        const OK_btn = document.getElementById('OK');
        console.log(OK_btn);
        //OKボタンが押されたら

        OK_btn.addEventListener('click', e => {
            let player_name; //ランキングに登録する名前
            const nameTextbox = document.getElementById('player_name');
            player_name = nameTextbox.value;

            if (player_name == null) {
                print("名前が入力されていません。");
            } else {
                //名前が入力されていたら、DBに格納するデータを次のページに渡す
                const miss = '<?= $miss ?>';
                const game_time = '<?= $game_time ?>';
                location.replace("http://localhost/タイピングゲーム/date_insert.php?miss=" + miss + "&game_time=" + game_time + "&player_name=" + player_name);
            }
        });
    </script>

</body>

</html>