<?php
  $enable_referer = "http://localhost/Tenkokko/admin/managementScreen/admin.php";
//  if(!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] !== $enable_referer){
  //redirect
  //  header("Location: http://localhost/Tenkokko/admin/adminLogin/adminLogin.php");
//  }else{
    $pdo = new PDO('mysql:host=localhost;dbname=tenkokko;charset=utf8','root','hogehoge');

    //adminIDから参照
    $req = $pdo->prepare("SELECT * FROM admin where id=?");
    $req->execute([$adminID]);

    foreach($req->fetchAll() as $row){

    }

//  }

?>
