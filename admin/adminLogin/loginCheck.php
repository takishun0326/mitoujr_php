<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  include("$root/pdo.php");

  $adminID = $_REQUEST['admin-id'];
  $family_name = $_REQUEST['family-name'];
  $given_name = $_REQUEST['given-name'];
  $password = $_REQUEST['password'];

    //adminIDから参照
    $req = $pdo->prepare("SELECT * FROM adminlist where id=?");
    $req->execute([$adminID]);

    foreach($req->fetchAll() as $row){

      //全て一致するなら
      if($row['id']==$adminID && $row['family-name']==$family_name
      && $row['given-name']==$given_name && $row['password']==$password){
        //login
          header('Location: ../managementScreen/admin.php');
          exit();
      }
    }
    //header('Location: adminLogin.php');

?>
