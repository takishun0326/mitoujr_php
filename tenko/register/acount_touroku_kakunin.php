<?php
include("../../pdo.php");
include("../../kotai_shikibetsu_number.php");

//jsで使う Falseは個体識別番号がかぶっていない状態
$kotaiCheck = "False";
$kotaiNumCheck = $pdo->prepare("SELECT * FROM memberlist where kotaiNum = ?");
$kotaiNumCheck->execute([$mobile_id]);

foreach($kotaiNumCheck->fetchAll() as $row){
	 if($row["kotaiNum"] == $mobile_id){
		 // 個体識別番号かぶってるぜ
		 	$kotaiCheck = "True";
	 }
}


//aocunt_touroku_formから入力データを受け取る
// 封印 $userid = $_REQUEST['admin_id'];
$Familyname   = $_REQUEST['family-name'];
$Givenname = $_REQUEST['given-name'];
$pass   = addslashes($_REQUEST['password']);//',￥がエスケープされる可能性がある
/*
//ユーザーIDの最大値を取得
$maxID_query = $pdo->query("SELECT MAX(id) as id_Max FROM memberlist");
$maxID = $maxID_query->fetch(PDO::FETCH_ASSOC);
$nextID = $maxID["id_Max"]+1

echo $nextID;
*/

// 個体識別番号がかぶっていなかったら
if($kotaiCheck == "False"){

	//ユーザーIDの最大値を取得
	$maxID_query = $pdo->query("INSERT INTO memberlist(id) SELECT MAX(id) + 1 FROM memberlist");

	// DBに送信する用
	$insert = $pdo->prepare("UPDATE memberlist SET
		FamilyName = :FamilyName,
		GivenName = :GivenName,
		password = :password,
		RollCallCheck = :RollCallCheck,
		RollCallCount = :RollCallCount,
		kotaiNum = :kotaiNum
		where id = 3");//(SELECT MAX(id) FROM memberlist)");
	$params=array(':FamilyName' => $Familyname,':GivenName' => $Givenname,
	':password'=> $pass,':RollCallCheck' => '0',':RollCallCount' => '0', ':kotaiNum' => $mobile_id );

	// 新しく挿入
	$insert->execute($params);

	//ページ遷移
	header("Location: acount_touroku_success.php");
	exit();

}


?>
