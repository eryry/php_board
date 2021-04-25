<?php
// 直接ここへ来たら、board.phpに返す処理
if( empty($_POST["sub"]) ) {
	header("Location:board.php?err01");
	exit();
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