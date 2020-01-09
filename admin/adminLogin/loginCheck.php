<?php

  $enable_referer = "http://localhost/Tenkokko/admin/adminLogin/adminLogin.php";
//  if(!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] !== $enable_referer){
    //redirect
//    echo "boo";
    //header("Location: http://localhost/Tenkokko/admin/adminLogin/adminLogin.php");

//  }else{

    $pdo = new PDO('mysql:host=localhost;dbname=tenkokko;charset=utf8','root','hogehoge');

    $adminID = $_REQUEST['adminID'];
    $familyName = $_REQUEST['苗字'];
    $name = $_REQUEST['名前'];
    $password = $_REQUEST['password'];

    //adminIDから参照
    $req = $pdo->prepare("SELECT * FROM admin where id=?");
    $req->execute([$adminID]);

    foreach($req->fetchAll() as $row){

      //全て一致するなら
      if($row['id']==$adminID && $row['firstName']==$name
      && $row['lastName']==$familyName && $row['password']==$password){
          header('Location: http://localhost/Tenkokko/admin/managementScreen/admin.php');
      }
    }
echo "g";
    //header('Location: http://localhost/Tenkokko/admin/adminLogin/adminLogin.php');
    //$adminID =$request['adminID'];
//  }
?>
