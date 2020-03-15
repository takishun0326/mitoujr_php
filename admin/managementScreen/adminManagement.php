<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include("$root/pdo.php");
$enable_referer = "$root/admin/managementScreen/admin.php";

//function
function updateManager(){

  $root = $_SERVER['DOCUMENT_ROOT'];
  include("$root/pdo.php");

  $arrayID = $_REQUEST["id"];
  $array_fName = $_REQUEST["family-name"];
  $array_gName = $_REQUEST["give-name"];
  //print_r($arrayID);

  for($i=0; $i<count($arrayID);$i++){

    $checkDB = $pdo->prepare("SELECT * from adminlist where id = ?");
    $checkDB->execute([$arrayID[$i]]);
    $check_fName = $pdo->prepare("UPDATE adminlist set family-name = :Fname where id = :id");
    $check_gName = $pdo->prepare("UPDATE adminlist set given-name = :Gname where id = :id");

  //  if($checkDB["firstName"] != $array_FName[$i]){
  //    $check_FName->execute([$array_FName[$i], $arrayID]);
  //  }
    $check_fName->execute(array(":Fname"=> $array_fName[$i],":id"=>$arrayID[$i]));
    $check_gName->execute(array(":Gname"=> $array_gName[$i],":id"=>$arrayID[$i]));
  }

}

function addManager(){

  $root = $_SERVER['DOCUMENT_ROOT'];
  include("$root/pdo.php");

  echo "hoge";
}
//  if(!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] !== $enable_referer){
  //redirect
  //  header("Location: http://localhost/Tenkokko/admin/adminLogin/adminLogin.php");
//  }else{
    //adminIDから参照
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $checkOption = $_REQUEST["update-manager"];
    if($checkOption == "update"){
      updateManager();
    }else{
      addManager();
    }
  }
    $req = $pdo->query("SELECT * FROM adminlist");
?>


<html>
<head>管理者管理</head>
<body>
  <form action ="adminManagement.php" method="post">
  <table border="5">
    <tr>
      <th>id </th>
      <th>family name</th>
      <th>given name </th>

    </tr>
    <?php foreach($req->fetchAll() as $row){ ?>
      <tr>
           <td ><input type = "text" name="id[]" size = "1"  value=<?php echo $row['id']?>>  </td>
           <td ><input type = "text" name="family-name[]" size = "10" value=<?php echo $row['family-name'] ?> contenteditable="true"> </td>
           <td ><input type = "text" name= "given-name[]" size = "10" value="<?php echo $row['given-name'] ?>" contenteditable="true"> </td>
      </tr>
    <?php } ?>
    <input type="hidden" value="update" name="update-manager">
  </table>
  <input type="submit" value="変更を更新" onClick="updateManager()">
</form>
<form action ="adminManagement.php" method="post">
  <input type="text" name="add-family-name" placeholder="family-name">
  <input type="text" name="add-given-name" placeholder="given-name">

  <input type="hidden" value="ADD" name="update-manager">
  <input type="submit" value = "管理者を追加"  onclick = "addManager()">
</form>

</body>
</html>
