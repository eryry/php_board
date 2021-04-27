<?php
// 直接ここへ来たら、board.phpに返す処理
if( empty($_POST["sub"]) ) {
	header("Location:board.php?err01");
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

session_start();
if(!empty($_POST["u_name"])) {
    $_SESSION["u_name"] = $_POST["u_name"];
}else{
    $_SESSION["u_name"] = "NO NAME";
}
$_SESSION["u_text"] = $_POST["u_text"];
$_SESSION["sub_time"] = date("Y年m月d日 H:i:s");



header("Location:board.php");

?>