<?php

$pdo = new PDO('mysql:host=localhost;dbname=tenkokko;charset=utf8','root','hogehoge');

//aocunt_touroku_formから入力データを受け取る
$myouji = $_REQUEST['myouji'];
$name   = $_REQUEST['name'];
$pass   = addslashes($_REQUEST['pass']);//',￥がエスケープされる可能性がある
//苗字を元にデータベースから漁る
$m = $pdo->prepare("SELECT * FROM member_list where 苗字=?");
$m->execute([$myouji]);




foreach($m->fetchAll() as $row){
    if(($row['パスワード']==$pass)&&($row['苗字']==$myouji)&&($row['名前']==$name)){
        echo '登録が完了しました！このページを閉じてください';
        exit();
    }else{
        echo '苗字、名前、パスワードうちどれかが違う可能性があります。';
        exit();
    }


}

//苗字がまず不一致だった
echo "hoge";
//hogehogehogehogehoge
?>