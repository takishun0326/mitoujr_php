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
    <form class="form">
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
