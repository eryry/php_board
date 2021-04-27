<?php
// 直接ここへ来たら、board.phpに返す処理
if( empty($_POST["sub"]) ) {
	header("Location:board.php?err01");
	exit();
}

session_start();
// 投稿本文がなかったらだめ
if(empty($_POST["u_text"])){
	header("Location:board.php?err02");
    $_SESSION["err_msg_text"]="必須項目なので投稿文入力ください";
	exit();
}

// 名前20文字以上はだめ
if(mb_strlen($_POST["u_name"]) >= 20){ 
    $_SESSION["err_msg_name"]="20文字以内で入力ください";
    // $_SESSION["u_name"]="";
    header("Location:board.php?err03");
	exit();
}


define('FILENAME','./message.txt');
date_default_timezone_set('Asia/Tokyo');

if( $file_handle = fopen(FILENAME, "a")) {
    // ファイルを開いて末尾に追加書き込みする準備

    // 書き込み日時を取得
    $now_date = date("Y年m月d日 H:i:s");


    // 書き込むデータ作成
    if(!empty($_POST["u_name"])) {
        $u_name = $_POST["u_name"];
    }else{
        $u_name = "NO NAME";
    }
    $data = "'".$u_name."','".$_POST["u_text"]."','".$now_date."'\n";
    // 書き込む
    fwrite($file_handle, $data);

    // ファイルを閉じる
    fclose( $file_handle );
}

if(!empty($_POST["u_name"])) {
    $_SESSION["u_name"] = $_POST["u_name"];
}else{
    $_SESSION["u_name"] = "";
}



header("Location:board.php");

?>