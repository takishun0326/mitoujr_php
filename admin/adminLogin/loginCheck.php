<?php

  $enable_referer = "http://localhost/Tenkokko/adminLogin.php";
  if(!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] !== $enable_referer){
    //redirect
      header("Location: http://localhost/Tenkokko/admin/adminLogin.php");

  }else{

    $pdo = new PDO('mysql:host=localhost;dbname=tenkokko;charset=utf8','root','hogehoge');

    $adminID = $_REQUEST['adminID'];
    $familyName = $_REQUEST['苗字'];
    $name = $_REQUEST['名前'];
    $password = $_REQUEST['password'];

    //adminIDから参照
    $req = $pdo->prepare("SELECT * FROM admin where userID where adminID=?");
    $req->execute([$adminID]);

    foreach($req->fetchAll() as $row){

      //全て一致するなら
      if($row['adminID']==$adminID && $row['firstName']==$name
      && $row['LastName']==$familyName && $row['password']==$password){
          header('Location: http://localhost/admin.php');
      }
    }
    //$adminID =$request['adminID'];
  }
?>
