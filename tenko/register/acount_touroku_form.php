<?php
$title = '利用者登録';
$root = $_SERVER['DOCUMENT_ROOT'];
include "$root/components/head.php";
?>
<link rel="stylesheet" href="acount_touroku_form_Design.css">
<body>
  <div class="container">
    <h1 class="form-caption">てんこっこ 利用者登録</h1>
    <form class="login-form" action="acount_touroku_kakunin.php" method="post">
      <label class="input-wrapper" id="admin-id">
        <input
          type="number"
          name="admin-id"
          placeholder="&nbsp;"
          autocomplete="off"
          spellcheck="false"
          required
          disabled
          value="0000000"
        >
        <span class="label">ID</span>
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
    </form>
    <small class="note">* Internet Explorer や Microsoft Edge ではページが正しく表示されない場合があります。</small>
  </div>
</body>
