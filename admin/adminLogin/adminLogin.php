<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>管理画面ログイン - てんこっこ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="adminLogin.css">
  </head>
  <body>
    <div class="container">
      <form class="login-form" action="loginCheck.php" method="post">
        <fieldset class="control-group">
          <legend>てんこっこ管理画面ログイン</legend>
          <label class="input-wrapper" id="admin-id">
            <input
              type="text"
              name="admin-id"
              placeholder="&nbsp;"
              autocomplete="off"
              spellcheck="false"
              required
            >
            <span class="label">管理者 ID</span>
          </label>
          <label class="input-wrapper" id="family-name">
            <input
              type="text"
              name="family-name"
              placeholder="&nbsp;"
              autocomplete="off"
              spellcheck="false"
              required
            >
            <span class="label">姓</span>
          </label>
          <label class="input-wrapper" id="given-name">
            <input
              type="text"
              name="given-name"
              placeholder="&nbsp;"
              autocomplete="off"
              spellcheck="false"
              required
            >
            <span class="label">名</span>
          </label>
          <label class="input-wrapper" id="password">
            <input
              type="password"
              name="password"
              placeholder="&nbsp;"
              required
            >
            <span class="label">パスワード</span>
          </label>
          <button type="submit" class="login-button">ログイン</button>
        </fieldset>
      </form>
      <small class="note">* Internet Explorer や Microsoft Edge ではページが正しく表示されない場合があります。</small>
    </div>
  </body>
</html>
