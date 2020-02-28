<?php
  include("../../pdo.php");
  include("../../kotai_shikibetsu_number.php");

// RollCallCheck
  $rollCallCheck = $pdo->prepare(
    "UPDATE memberlist
    SET RollCallCheck = :RollCallCheck
     WHERE id =
     (SELECT id FROM
       (SELECT id FROM memberlist WHERE kotaiNum = :kotaiNum)
          as tmp)");
  $params1 = array(':RollCallCheck' => '1', ':kotaiNum' = $mobile_id);
  $rollCallCheck->execute($params1);

  // RollCallCount ++
  $rollCallCount = $pdo->prepare(
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
  $rollCallCount->execute($params2);
?>

<?php
  echo "It's prototype";
?>
