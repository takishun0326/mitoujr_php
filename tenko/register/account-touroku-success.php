<?php
$title = '登録完了';
$root = $_SERVER['DOCUMENT_ROOT'];
include "$root/components/head.php";
?>
<body>
  <p>登録が完了しました</p>
  <p>このページは 3 秒後に閉じられます</p>
  <script>
    setTimeout(() => {
      window.open('about:blank', '_self').close();
    }, 3000);
  </script>
</body>
