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

//ユーザーIDの最大値を取得
$maxID =1;// $pdo->query("SELECT MAX(id) FROM memberlist") +1;



// 個体識別番号がかぶっていなかったら
if($kotaiCheck == "False"){
	// DBに送信する用
	$insert = $pdo->prepare("INSERT INTO memberlist (id,FamilyName,GivenName,password,RollCallCheck,RollCallCount,kotaiNum)
		 VALUES(:maxid,:FamilyName,:GivenName,:password,:RollCallCheck,:RollCallCount,:kotaiNum)");
	$params=array(':maxid' => $maxID,':FamilyName' => $Familyname,':GivenName' => $Givenname,
	':password'=> $pass,':RollCallCheck' => '0','RollCallCount' => '0', 'kotaiNum' => $mobile_id );
	echo '登録が完了しました！このページを閉じてください';

// 新しく挿入
	$kotai->execute($params);
}


?>
