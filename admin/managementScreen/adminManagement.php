<?php
  $enable_referer = "http://localhost/Tenkokko/admin/managementScreen/admin.php";
//  if(!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] !== $enable_referer){
  //redirect
  //  header("Location: http://localhost/Tenkokko/admin/adminLogin/adminLogin.php");
//  }else{
  $pdo = new PDO('mysql:host=localhost;dbname=tenkokko;charset=utf8','root','hogehoge');
if($_SERVER['REQUEST_METHOD'] == 'POST'){

  $arrayID = $_REQUEST["id"];
  $array_FName = $_REQUEST["firstName"];
  $array_LName = $_REQUEST["lastName"];
  //print_r($arrayID);

  for($i=0; $i<count($arrayID);$i++){

    $checkDB = $pdo->prepare("SELECT * from admin where id = ?");
    $checkDB->execute([$arrayID[$i]]);
    $check_FName = $pdo->prepare("UPDATE admin set firstName = :Fname where id = :id");
    $check_LName = $pdo->prepare("UPDATE admin set lastName = :Lname where id = :id");

  //  if($checkDB["firstName"] != $array_FName[$i]){
  //    $check_FName->execute([$array_FName[$i], $arrayID]);
  //  }
    $check_FName->execute(array(":Fname"=> $array_FName[$i],":id"=>$arrayID[$i]));
    $check_LName->execute(array(":Lname"=> $array_LName[$i],":id"=>$arrayID[$i]));
  }


}


    //adminIDから参照
    $req = $pdo->prepare("SELECT * FROM admin");
    $req->execute();

?>


<html>
<head>管理者管理</head>
<body>
  <form action ="adminManagement.php" method="post">
  <table border="5">
    <tr>
      <th>id </th>
      <th>first name</th>
      <th>last name </th>

    </tr>
    <?php foreach($req->fetchAll() as $row){ ?>
      <tr>
           <td ><input type = "text" name="id[]" size = "1"  value=<?php echo $row['id']?>>  </td>
           <td ><input type = "text" name="firstName[]" size = "10" value=<?php echo $row['firstName'] ?> contenteditable="true"> </td>
           <td ><input type = "text" name= "lastName[]" size = "10" value=<?php echo $row['lastName'] ?> contenteditable="true"> </td>
      </tr>
    <?php } ?>

  </table>
  <input type="submit" value="変更を更新">
</form>
<form>
  <input type="text" id="id01" placeholder="id">
  <input type="text" id="id02" placeholder="firstName">
  <input type="text" id="id03" placeholder="lastName">
  <input type="submit" name = "addManager" value = "管理者を追加"  onclick = "addManager()">
</form>

</body>
</html>
