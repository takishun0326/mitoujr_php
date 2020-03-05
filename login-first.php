<?php
include("kotai-shikibetsu-number.php");
include("pdo.php");

//$pdo = new PDO('mysql:host=localhost;dbname=tenkokko;charset=utf8','root','hogehoge');

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
		 header("Location: tenko/RollCall/complete-RollCall.php");
		 exit();
	 }
}

header("Location: tenko/register/account-touroku-form.php");
exit();

?>
