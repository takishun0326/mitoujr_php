<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  include("$root/pdo.php");
  $enable_referer = "$root/admin/managementScreen/admin.php";
  //  if(!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] !== $enable_referer){
    //redirect
    //  header("Location: http://localhost/Tenkokko/admin/adminLogin/adminLogin.php");
  //  }else{

  //function
  function updateManager(){

    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/pdo.php");

    $arrayID = $_REQUEST["id"];
    $array_fName = $_REQUEST["family-name"];
    $array_gName = $_REQUEST["given-name"];
    //print_r($arrayID);

    for($i=0; $i<count($arrayID);$i++){

      $checkDB = $pdo->prepare("SELECT * from adminlist where id = ?");
      $checkDB->execute([$arrayID[$i]]);
      $check_fName = $pdo->prepare("UPDATE adminlist set family_name = :Fname where id = :id");
      $check_gName = $pdo->prepare("UPDATE adminlist set given_name = :Gname where id = :id");

      $check_fName->execute(array(":Fname"=> $array_fName[$i],":id"=>$arrayID[$i]));
      $check_gName->execute(array(":Gname"=> $array_gName[$i],":id"=>$arrayID[$i]));
    }
  }

  // admin追加
  function addManager(){
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/pdo.php");

    $add_fName = $_REQUEST["add-family-name"];
    $add_gName = $_REQUEST["add-given-name"];
    $add_pass = $_REQUEST["add-password"];

    $add_manager = $pdo->prepare(
      "INSERT INTO adminlist(id,family_name,given_name,password)
     VALUES((SELECT MAX(id) FROM adminlist ):family_name,:given_name,:password)");

    $params = array(":family_name" => $add_fName,"given_name" => $add_gName,":password" => $add_pass);
    $add_manager->execute($params);
  }

      //adminIDから参照
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $checkOption = $_REQUEST["update-manager"];
      if($checkOption == "update"){
        updateManager();
      }else if($checkOption == "ADD"){
        addManager();
      }
    }
    $req = $pdo->query("SELECT * FROM adminlist");
?>

<?php
  function autoIncrementReset(){
    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root/pdo.php");

    $pdo->query("ALTER TABLE adminlist auto_increment = 1");
  }
?>

<html>
<head>管理者管理</head>
<body>
  <input type="submit" value="auto increment reset" onClick="autoIncrementReset()">

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
           <td ><input type = "text" name="family-name[]" size = "10" value=<?php echo $row['family_name'] ?> contenteditable="true"> </td>
           <td ><input type = "text" name= "given-name[]" size = "10" value="<?php echo $row['given_name'] ?>" contenteditable="true"> </td>
      </tr>
    <?php } ?>
    <input type="hidden" value="update" name="update-manager">
  </table>
  <input type="submit" value="変更を更新" onClick="updateManager()">
</form>
<form action ="adminManagement.php" method="post">
  <input type="text" name="add-family-name" placeholder="family-name">
  <input type="text" name="add-given-name" placeholder="given-name">
  <input type="text" name="add-password" placeholder="password">

  <input type="hidden" value="ADD" name="update-manager">
  <input type="submit" value = "管理者を追加"  onclick = "addManager()">
</form>

</body>
</html>
