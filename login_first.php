<?php
//個体識別番号取得
$mobile_id = mobileId();

//個体識別番号取得関数////////////////////////
function mobileId() {
	//ドコモ
	if (isset($_SERVER['HTTP_X_DCMGUID'])) {
		$mobile_id = $_SERVER['HTTP_X_DCMGUID'];
	}
	//Au
	else if (isset($_SERVER['HTTP_X_UP_SUBNO'])) {
		$mobile_id = $_SERVER['HTTP_X_UP_SUBNO'];
	}
	//ソフトバンク
	else if (isset($_SERVER['HTTP_X_JPHONE_UID'])) {
		$mobile_id = $_SERVER['HTTP_X_JPHONE_UID'];
	}
	//PC
	else {
		$mobile_id = $_SERVER['HTTP_USER_AGENT'];
	}

  return $mobile_id;
}
////////////////////////////////////////////////
//$pdo = new PDO('mysql:host=localhost;dbname=tenkokko;charset=utf8','root','hogehoge');

include("pdo.php");
/*
$kotai = $pdo->query("SELECT * FROM memberlist");
foreach($kotai->fetchAll() as $row){
	echo $row["id"];
}

*/




$kotai = $pdo->prepare("SELECT * FROM memberlist where kotaiNum=?");
$kotai->execute([$mobile_id]);

foreach($kotai->fetchAll() as $row){

	 if($row["kotaiNum"] == $mobile_id){
		 $user_id=$row["id"];
		 header("Location: 点呼/RollCall/tenko_mainPage.php");
		 exit;
	 }
}

header("Location: 点呼/register/acount_touroku_form.php");
exit;

?>
