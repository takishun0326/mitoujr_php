<?php
  $enable_referer = "http://localhost/Tenkokko/admin/adminLogin/loginCheck.php";
  if(!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] !== $enable_referer){
  //redirect

  //  header("Location: http://localhost/Tenkokko/admin/adminLogin/adminLogin.php");

  }else{


  }

?>
<html>
  <title>管理者画面</title>
  <body>

    <input type = "button" name = "adminReg" value="管理者一覧">

  </body>
</html>
