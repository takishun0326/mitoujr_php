<?php

$pdo = new PDO('mysql:host=localhost;dbname=tenkokko;charset=utf8','root','hogehoge');

//aocunt_touroku_formから入力データを受け取る
$userid = $_REQUEST['userID'];
//$name   = $_REQUEST['name'];
$pass   = addslashes($_REQUEST['pass']);//',￥がエスケープされる可能性がある
//ユーザーIDを元にデータベースから漁る
$m = $pdo->prepare("SELECT * FROM member_list where ユーザーID=?");
$m->execute([$userid]);

//個体識別番号の変更のためのPDO//////////////////////
$mobile_id = mobileId();
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
$kotai = $pdo->prepare("UPDATE member_list SET 個体識別番号（仮）= :kotai WHERE ユーザーID=:userid");
$params=array(':kotai' => $mobile_id,':userid' => $userid);//////////////こっからやるぞいｂ
/////////////////////////////////////////

$count=0;
foreach($m->fetchAll() as $row){
    $count++;
    if(($row['パスワード']==$pass)&&($row['ユーザーID']==$userid)){
        if($row['個体識別番号（仮）'] == NULL){
            echo '登録が完了しました！このページを閉じてください';
            $kotai->execute($params);
            echo "hoge";
;            exit();
        }else{
            echo "このアカウントはすでに別の機種で登録されています。";
            exit();
        }
    }else{
        echo 'ユーザーIDまたはパスワードが一致しません。';
        exit();
    }


}

//苗字がまず不一致だった
echo "ユーザーIDまたはパスワードが一致しません。";
//hogehogehogehogehoge
//issue2
//issue3
?>