<?php
  echo "You completed roll call";


  $pdo = new PDO('mysql:host=localhost;dbname=tenkokko;charset=utf8','root','hogehoge');

  $m = $pdo->prepare("SELECT * FROM member_list where ユーザーID=?");
  $hoge="example1";
  $times= 1;
  $m->execute([$hoge]);

  $kotai = $pdo->prepare("UPDATE member_list SET 点呼完了=:tenko WHERE ユーザーID=:userid");
  $params=array(':tenko' => $times,':userid' => $hoge);

    $kotai->execute($params);
?>
<html></br><br/></html>
<?php
  echo "It's prototype";
?>
