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
/////////////////////////////////////////////////
$pdo = new PDO('mysql:host=localhost;dbname=tenkokko;charset=utf8','root','hogehoge');

$kotai = $pdo->prepare("SELECT * FROM member_list where 個体識別番号（仮）=?");
$kotai->execute([$mobile_id]);

foreach($kotai->fetchAll() as $row){
    if($row["個体識別番号（）"] == $mobile_id){
        $user_id=$row["ユーザーID"];
        header("Location: http://localhost/点呼管理/点呼/tenko_test.php");
        exit;
    }
}
header("Location: http://localhost/点呼管理/acount_touroku_form.php");
    exit;
?>
