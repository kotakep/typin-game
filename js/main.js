let randoms = []; //乱数格納用
let strlen = 0;   //何文字目をみているか
let i = 0;        //乱数配列使用時の添字
let clear = "";   //入力済み文字格納用
let change = "";  //未入力文字格納用

let miss = 0;     //ミスタイプ
let ok = 0;       //入力済み文字数
let times = 0;    //ゲームタイム


//----- 問題生成　-----//
const words = [
    'tomato',
    'mikan',
    'yakiniku',
    'osushi',
    'hannba-gu',
    'momo',
    'kyuuri',
];

const furigana = [
    'トマト',
    'みかん',
    'やきにく',
    'おすし',
    'ハンバーグ',
    'もも',
    'きゅうり'
];

// 乱数生成関数
function intRandom(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

// 最小値と最大値(問題数分)
let min = 0, max = words.length - 1;
let k;

// 重複チェックしながら乱数作成
for (k = min; k <= max; k++) {
    while (true) {
        var tmp = intRandom(min, max);
        if (!randoms.includes(tmp)) {
            randoms.push(tmp);
            break;
        }
    }
}

// ゲーム開始時間を取得
const startTime = performance.now();

//問題ワードとフリガナを表示
const furiganaWord = document.getElementById('furigana');
furiganaWord.textContent = furigana[randoms[i]];

const typingWord = document.getElementById('typingWord');
typingWord.textContent = words[randoms[i]];

//クリアした文字を表示する場所を取得
const clearWord = document.getElementById('clearWord');


//----入力された値が正しいか判定する-----//
window.addEventListener('keydown', e => {
    change = "";
    //入力された文字が正解の時
    if (e.key === words[randoms[i]][strlen]) {
        //正解した文字をclearWordに格納して表示
        clear += words[randoms[i]][strlen];
        clearWord.textContent = clear;
        //次の文字に移動
        strlen++;
        //未入力の文字を表示する
        for (let j = strlen; j < words[randoms[i]].length; j++) {
            change += words[randoms[i]][j];
        }
        typingWord.textContent = change;
        ok++;
    }
    else {
        miss++;

    }

    //-----入力がすべて正解したら----//
    if (words[randoms[i]].length == strlen) {
        i++;//次の問題にするためにインクリメント
        furiganaWord.textContent = furigana[randoms[i]];//次の問題表示
        typingWord.textContent = words[randoms[i]];
        clearWord.textContent = "";//クリアワードの初期化
        clear = "";
        strlen = 0;//文字数の初期化
    }

    //-----ゲームクリアしたら結果を表示-----//
    if (randoms.length == i) {
        const endTime = performance.now(); // 終了時間を取得
        const endview = document.getElementById('end');
        endview.textContent = "ゲームクリア！！";
        const okview = document.getElementById('ok');
        okview.textContent = "入力した数：" + ok + "もじ";
        const missview = document.getElementById('miss');
        missview.textContent = "ミスした数：" + miss + "かい";
        const timeview = document.getElementById('time');
        times = (endTime - startTime) / 1000;
        times = times.toFixed(2);
        timeview.textContent = "タイム：" + times + "秒";

        document.getElementById('reset').innerHTML = " <button type=" + '"button" ' + "class=" + '"btn-square-toy" ' + "id=" + '"reset2"' + ">もう一度始める</button>";
        document.getElementById('ranking').innerHTML = " <button type=" + '"button" ' + "class=" + '"btn-square-toy" ' + "id=" + '"ranking2"' + ">ランキングに登録する</button>";
    }

    //トップ画面へ戻る
    let reset_btn = document.getElementById('reset2');
    reset_btn.addEventListener('click', function () {
        window.location.href = 'index.html';
    }, false);

    //ランキング登録画面へ遷移
    let ranking_btn = document.getElementById('ranking2');
    ranking_btn.addEventListener('click', function () {
        location.replace("http://localhost/タイピングゲーム/data_summary.php?miss=" + miss + "&game_time=" + times);
    }, false);

});




