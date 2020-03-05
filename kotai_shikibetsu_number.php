<?php

$mobile_id = mobileId();

//個体識別番号取得関数
function mobileId() {
	//ドコモ
	if (isset($_SERVER['HTTP_X_DCMGUID'])) {
		$mobile_id = $_SERVER['HTTP_X_DCMGUID'];
	}
	//Au
	else if (isset($_SERVER['HTTP_X_UP_SUBNO'])) {
		$mobile_id = $_SERVER['HTTP_X_UP_SUBNO'];
	}
	//ソフトバンク
	else if (isset($_SERVER['HTTP_X_JPHONE_UID'])) {
		$mobile_id = $_SERVER['HTTP_X_JPHONE_UID'];
	}
	//PC
	else {
		$mobile_id = $_SERVER['HTTP_USER_AGENT'];
	}

  return $mobile_id;
}

?>
