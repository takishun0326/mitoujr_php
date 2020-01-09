<?php echo "(prototype)";?>
<html></br></html>

<?php

    echo "Roll Call Time";
?>

<html></br></html>

<?php
    $test = "hoge";
    $pdo = new PDO('mysql:;host=localhost;dbname=tenkokko;charset=utf8','root','hogehoge');

    $test = $pdo ->query("SELECT * FROM tenko_time");
    $result = $test->fetch();

    $tenko_start_hour = $result['tenko_start_hour'];
    $tenko_start_minute=$result['tenko_start_minute'];
    $tenko_finish_hour = $result['tenko_finish_hour'];
    $tenko_finish_minute=$result['tenko_finish_minute'];

    echo $tenko_start_hour;
    echo ":";
    echo $tenko_start_minute;
    echo "~";
    echo $tenko_finish_hour;
    echo ":";
    echo $tenko_finish_minute;
?>


<html>
<body>
  <form action=completeRollCall.php method="post">
    </br>
    </br>
    <input type="submit" value="Complete Roll Call">
  </form>
<br/><br/>
  <p>"LINE bot" cannot be used now...→</p>
</body>

</html>

<script>
function hoge1(){
    alert(tenkokko_time());
}

function tenkokko_time(){

    // var jikan = new Date();

    // var hour = jikan.getHours();
    // var minute = jikan.getMinutes();
    document.write("unko");
}
function fun(){
    // var tenko_s_h="<?php echo $tenko_start_hour?>"+"<?php //echo $tenko_start_minute?>";

    // var tenko_f_h="<?php echo $tenko_finish_hour?>";
    // var tenko_f_m="<?php echo $tenko_finish_minute?>";
    //点呼開始時間終了時間をMySql→PHP経由で取得

    alert("hoge");
    if(){

    }else {
    }

}

</script>
