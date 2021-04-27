<?php

// LEVEL2：簡易掲示板 （V2）
// 仕様
// * 必要入力項目
//     * 名前（未入力の場合は、自動挿入（NO NAME））最大20文字
//     * 投稿日時（フォーマットは 年/月/日 時:分:秒とし、自動挿入）
//     * 本文（必須入力）最大500文字
// * 投稿内容はテキストファイルに保存
// * 一度投稿した、名前はセッションに保存して自動反映
// * 
// * 画像投稿機能を実装（時間があれば）
// * 日付毎、名前毎にフィルタリング機能を実装（時間があれば）
// * ページネーションを実装（「< 1 2 3 ... >」「<前へ 次へ>」どちらでも可）（時間があれば）
// 目的
// * ファイルの保存、読み込み、編集を学ぶ
// * 現在日時の出力方法を学ぶ
// 

// １）入力フォームと、それを受け取る準備：日付のみ自動で、他は入力値で。
// ２）まずは、「投稿」→「表示」を実装　
// ※1時間ではここまでしか出来なかった。スペルミスで時間無駄にしたのでスペル注意！
// ３）一度投稿した名前をセッションに保存して自動反映を実装
// ４）必須項目の投稿文を必須設定に。
// ５）名前のMAX文字数設定
// ６）投稿本文のMAX文字数設定
// ７）本文をテキストファイルに保存（どうやるのか？独習PHPで復習して試す)
// ━━━ここまでが最低限の仕様━ここまでを4月中に実装する━━━


session_start();
function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}
if(!empty($_SESSION["u_name"])) {
    $sub_u_name = h($_SESSION["u_name"]);
}else{
    $sub_u_name="";
}
$sub_time="";
if(!empty($_SESSION["sub_time"])){
    $sub_time= $_SESSION["sub_time"];
}
$u_text="";
if(!empty($_SESSION["u_text"])){
    $u_text= h($_SESSION["u_text"]);
}

define('FILENAME','./message.txt');
$message_array=[];
if($file_handle = fopen(FILENAME,'r')) {
    // r＝＞ファイルを読み込みモードで開く
    while($data= fgets($file_handle)) {
        $split_data = preg_split('/\'/',$data);
        $message = [
            "view_name" => $split_data[1],
            "message" => $split_data[3],
            "post_date" => $split_data[5],
        ];
        array_unshift($message_array,$message);  
    }
    // ファイル閉じる
    fclose($file_handle);
}

;?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>LEVEL2：簡易掲示板</title>
    <style>
    article{
        background-color: coral;
        margin: 5px;
        padding: 5px 20px;
        border-radius:5px;
    }
    .p_date{
        font-size: 13px;
    }
    </style>
</head>
<body>
<h1>LEVEL2：簡易掲示板</h1>

<section>
<form action="exec_sub.php" method="post">
    <p><label for="u_name">名前：</label>
    <input type="text" name="u_name" id="u_name" value="<?php echo $sub_u_name;?>">
    </p>
    <p><label for="u_text">投稿文：</label>
    <textarea type="text" name="u_text" id="u_text" value=""></textarea>
    </p>
    <input type="submit" name="sub" value="投稿する">
</form>
</section>
<hr>
<!-- <section>
    <article>
        <p>名前：<?php echo $sub_u_name;?></p>
        <p>投稿日時：<?php echo $sub_time;?></p>
        <p>投稿文：<?php echo $u_text;?></p>
    </article>
</section> -->

<section class="p2">
    <?php if(!empty($message_array)): ?>
    <?php foreach($message_array as $val): ?>
    <article>
        <p>名前：<?php echo $val["view_name"];?>
        <span class="p_date">投稿日時：<?php echo $val["post_date"];?></span></p>
        <p>投稿文：<?php echo $val["message"];?></p>
    </article>
    <?php endforeach; ?>
    <?php endif; ?>
</section>
    
</body>
</html>