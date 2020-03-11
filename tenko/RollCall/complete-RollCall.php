<?php
include("../../pdo.php");
include("../../kotai-shikibetsu-number.php");

$tenkoFinishCheck = $pdo->prepare("SELECT * FROM memberlist WHERE kotaiNum = ?");
$tenkoFinishCheck->execute([$mobile_id]);

$tenkoFinished = "false";

foreach ($tenkoFinishCheck->fetchAll() as $row) {
  if ($row["RollCallCheck"] == 0) {
    $tenkoFinished = "false";
  } else {
    $tenkoFinished = "true";
    $RollCallTimes = $row["RollCallCount"] + 1;
  }
}

if ($tenkoFinished == "false") {
  // RollCallCheck -> 1
  $rollCallCheck = $pdo->prepare("UPDATE memberlist
        SET RollCallCheck = :RollCallCheck
         WHERE id =
         (SELECT id FROM
           (SELECT id FROM memberlist WHERE kotaiNum = :kotaiNum)
              as tmp)");
  $params1       = array(
    ':RollCallCheck' => '1',
    ':kotaiNum' => $mobile_id
  );
  $rollCallCheck->execute($params1);
}

// RollCallCount ++
$rollCallCount1 = $pdo->prepare("UPDATE memberlist
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
$params2        = array(
  ':kotaiNum1' => $mobile_id,
  ':kotaiNum2' => $mobile_id
);
$rollCallCount1->execute($params2);
?>

<!-- View -->
<?php
$title = '点呼完了';
$root = $_SERVER['DOCUMENT_ROOT'];
include "$root/components/head.php";
?>
<link rel="stylesheet" href="form.css">
<body>
  <div class="container">
    <p id="RollCallCheck" class="form-caption">点呼完了メッセージ欄</p>
    <form class="form" action="../questionnaire/send-questionnaire.php" method="post">
      <textarea name="comment" placeholder="良ければご意見・改善点などをお聞かせください"></textarea>
      <button type="submit" class="button">送信</button>
    </form>
  </div>
  <script>
    const RollCallCheck = '<?php echo $tenkoFinished ?>';
    if (RollCallCheck === 'false') {
      // 初めて点呼した人
      document.getElementById('RollCallCheck').textContent = '点呼を完了しました！';
    } else {
      // 2回目以降
      document.getElementById('RollCallCheck').textContent = '点呼を完了しました！現在点呼を完了している回数は ' + String(<?php echo $RollCallTimes; ?>) + ' 回です！';
    }
  </script>
</body>
