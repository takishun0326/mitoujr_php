<?php
include("../../pdo.php");
include("../../kotai-shikibetsu-number.php");

//jsで使う falseは個体識別番号がかぶっていない状態
$kotaiCheck = "false";
$kotaiNumCheck = $pdo->prepare("SELECT * FROM memberlist where kotaiNum = ?");
$kotaiNumCheck->execute([$mobile_id]);

foreach($kotaiNumCheck->fetchAll() as $row){
	 if($row["kotaiNum"] == $mobile_id){
		 // 個体識別番号かぶってるぜ
		 	$kotaiCheck = "true";
	 }
}


//aocunt_touroku_formから入力データを受け取る
// 封印 $userid = $_REQUEST['admin_id'];
$Familyname   = $_REQUEST['family-name'];
$Givenname = $_REQUEST['given-name'];
$pass   = addslashes($_REQUEST['password']);//',￥がエスケープされる可能性がある


// 個体識別番号がかぶっていなかったら
if($kotaiCheck == "false"){

	//ユーザーIDの最大値を取得
	$maxID_query = $pdo->query(
		"SELECT * FROM memberlist WHERE id =
			(SELECT id FROM
				(SELECT MAX(id) FROM memberlist)
		 as tmp)");

	foreach($maxID_query->fetchAll() as $row){
			$nextId = $row["id"] + 1;
	}

	// DBに送信する用
	$insert = $pdo->prepare("INSERT INTO memberlist(id,FamilyName,GivenName,password,
		RollCallCheck,RollCallCount,kotaiNum) VALUES(
			:nextID,
			:FamilyName,
			:GivenName,
			:password,
			:RollCallCheck,
			:RollCallCount,
			:kotaiNum)");

	$params=array(':nextID' => $nextId,':FamilyName' => $Familyname,':GivenName' => $Givenname,
	':password'=> $pass,':RollCallCheck' => '0',':RollCallCount' => '0', ':kotaiNum' => $mobile_id);

	// 新しく挿入
	$insert->execute($params);

	//ページ遷移
	header("Location: account-touroku-success.php");
	exit();

}
?>

<!-- View -->
<?php
$title = '確認';
$root = $_SERVER['DOCUMENT_ROOT'];
include "$root/components/head.php";
?>
<body>
	<p id="kotaiCheck">null</p>
	<script>
		// 個体識別番号をチェック
		const check = "<?php echo $kotaiCheck; ?>";
		// 個体識別番号が被っているとき
		if (check === 'true') {
			document.getElementById('kotaiCheck').textContent = '個体識別番号が被っています';
		}
	</script>
</body>
