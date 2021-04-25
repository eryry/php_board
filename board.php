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


session_start();
function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}
$sub_u_name="";
if(!empty($_SESSION["u_name"])) {
    $sub_u_name = h($_SESSION["u_name"]);
}
$sub_time="";
if(!empty($_SESSION["sub_time"])){
    $sub_time= $_SESSION["sub_time"];
    // echo $sub_time;
}
$u_text="";
if(!empty($_SESSION["u_text"])){
    $u_text= $_SESSION["u_text"];
}

;?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>LEVEL2：簡易掲示板</title>
</head>
<body>
<h1>LEVEL2：簡易掲示板</h1>

<section>
<form action="exec_sub.php" method="post">
    <p>名前：
    <input type="text" name="u_name" value="">
    </p>
    <p>投稿文：
    <textarea type="text" name="u_text" value=""></textarea>
    </p>
    <input type="submit" name="sub" value="投稿する">
</form>
</section>

<section>
    <article>
    <p>名前：<?php echo $sub_u_name;?></p>
    <p>投稿日時：<?php echo $sub_time;?></p>
    <p>投稿文：<?php echo $u_text;?></p>
    </article>
</section>
    
</body>
</html>