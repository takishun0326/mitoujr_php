<?php
  include("../../pdo.php");
  include("../../kotai_shikibetsu_number.php");

  $tenkoFinishCheck = $pdo->prepare("SELECT * FROM memberlist WHERE kotaiNum = ?");
  $tenkoFinishCheck->execute($kotaiNum);

  $tenkoFinished = "false";

  foreach($tenkoFinishCheck->fetchAll() as $row){
    if($row["RollCallCheck"] == 0){

      // RollCallCheck -> 1
        $rollCallCheck = $pdo->prepare(
          "UPDATE memberlist
          SET RollCallCheck = :RollCallCheck
           WHERE id =
           (SELECT id FROM
             (SELECT id FROM memberlist WHERE kotaiNum = :kotaiNum)
                as tmp)");
        $params1 = array(':RollCallCheck' => '1', ':kotaiNum' => $mobile_id);
        $rollCallCheck->execute($params1);
    }else{
      $tenkoFinished = "true";
    }
  }
/*

  // RollCallCount ++
  $rollCallCount1 = $pdo->prepare(
    "UPDATE memberlist
      SET RollCallCount =
        (SELECT RollCallCount + 1 FROM
  		      (SELECT RollCallCount FROM
              (SELECT * FROM memberlist WHERE kotaiNum = :kotaiNum1)
            as tmp1)
        as tmp2)
      WHERE id =
        (SELECT id FROM
          (SELECT id FROM memberlist WHERE kotaiNum = :kotaiNum2)
      as tmp3);
  SELECT * FROM memberlist");
$params2 = array(':kotaiNum1' => $mobile_id,':kotaiNum2' => $mobile_id);
$rollCallCount2->execute($params2);


$rollCallCount2 = $pdo->prepare("SELECT * FROM memberlist WHERE kotaiNum = ?");
$rollCallCount2->execute($mobile_id);
foreach ($rollCallCount2->fetchAll() as $row) {
  $RollCallTimes = $row["RollCallCount"];
}
*/
?>



<html>
<body>
  <p id = "RollCallCheck">NULL</p>
</body>
</html>




<script>
  /*var RollCallCheck = <?php //echo $tenkoFinished; ?>;
  var RollCallCheckID = document.getElementById("RollCallCheck");

  if(RollCallCheck == "false"){
    RollCallCheckID.innerHTML = "点呼を完了しました！";
  }else{
    RollCallCheckID.innerHTML = "点呼を完了しました！現在点呼を完了している回数は"
    + <?php //echo $RollCallTimes; ?> + "回です！";
  }
*/
</script>
