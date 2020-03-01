<?php
  include("../../pdo.php");

  // アンケート内容が入るとこ
  // アンケートタグのnameを""の中と同期
  $Comment = $_REQUEST["questionnaire"];


  $IDcheck = $pdo->query(
    "SELECT * FROM questionnaires WHERE id =
      (SELECT id FROM (SELECT MAX(id) FROM questionnaires )
    as tmp)");
  foreach($IDcheck->fetchAll() as $row){
    $nextID = $row["id"] + 1;
  }


  $setting = $pdo->prepare("INSERT INTO questionnaires(id,comment)
  VALUES (:id,:comment)");
  $params = array(":id" => $nextID,":comment" => $Comment);
  $setting->execute($params);

?>
