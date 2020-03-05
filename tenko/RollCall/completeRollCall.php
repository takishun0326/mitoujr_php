<?php
  include("../../pdo.php");
  include("../../kotai_shikibetsu_number.php");

  $tenkoFinishCheck = $pdo->prepare("SELECT * FROM memberlist WHERE kotaiNum = ?");
  $tenkoFinishCheck->execute([$mobile_id]);

  $tenkoFinished = "false";

  foreach($tenkoFinishCheck->fetchAll() as $row){
    if($row["RollCallCheck"] == 0){
      $tenkoFinished = "false";
    }else{
      $tenkoFinished = "true";
      $RollCallTimes = $row["RollCallCount"] + 1;
    }
  }

  if($tenkoFinished == "false"){
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
  }



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
      as tmp3)");
  $params2 = array(':kotaiNum1' => $mobile_id,':kotaiNum2' => $mobile_id);
  $rollCallCount1->execute($params2);

?>


<html>
<body>
  <p id = "RollCallCheck">点呼完了メッセージ欄</p>
</body>
</html>




<script>

  var RollCallCheck = "<?php echo $tenkoFinished; ?>";
  if(RollCallCheck == "false"){
    // 初めて点呼をした人
    document.getElementById("RollCallCheck").textContent = "点呼を完了しました！";
  }else{
    //2回目以降
    document.getElementById("RollCallCheck").textContent = "点呼を完了しました！現在点呼を完了している回数は"+  String(<?php echo $RollCallTimes; ?>) +"回です！";
  }

</script>
