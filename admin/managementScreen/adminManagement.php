<?php
  $enable_referer = "http://localhost/Tenkokko/admin/managementScreen/admin.php";
//  if(!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] !== $enable_referer){
  //redirect
  //  header("Location: http://localhost/Tenkokko/admin/adminLogin/adminLogin.php");
//  }else{
    $pdo = new PDO('mysql:host=localhost;dbname=tenkokko;charset=utf8','root','hogehoge');

    //adminIDから参照
    $req = $pdo->prepare("SELECT * FROM admin");
    $req->execute();
?>


<html>
<head>管理者管理</head>
<body>
  <table border="5">
    <tr>
      <th>id </th>
      <th>first name</th>
      <th>last name </th>

    </tr>
    <?php foreach($req->fetchAll() as $row){ ?>
      <tr>
           <td> <?php echo $row['id']?>  </td>
           <td> <?php echo $row['firstName'] ?> </td>
           <td> <?php echo $row['lastName'] ?> </td>
      </tr>
    <?php } ?>

  </table>
</body>
</html>
