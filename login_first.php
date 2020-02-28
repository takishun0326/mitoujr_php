<?php
include("../../kotai_shikibetsu_number.php");
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
		 header("Location: tenko/RollCall/tenko_mainPage.php");
		 exit;
	 }
}

header("Location: tenko/register/acount_touroku_form.php");
exit;

?>
