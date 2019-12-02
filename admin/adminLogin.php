<html>
<title>管理者ログイン</title>
<body>
  <form action="loginCheck.php" method="post">
    <fieldset>

      ユーザーID:
      <input type="text" name="adminID" size="10" value="" required><br />
      苗字:
      <input type="text" name="苗字"　size="3" value="" required><br />
      名前:
      <input type="text" name="名前" size="10" value="" required><br />
      パスワード:
      <input type="password" name="password" size="15" value="" required><br />

      <br />
        <input type="submit" value="ログイン" required>
    </fieldset>
  </form>
</body>
</html>
