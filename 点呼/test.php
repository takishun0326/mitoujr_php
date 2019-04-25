<?php
    $test = "hoge";
    $pdo = new PDO('mysql:;host=localhost;dbname=example_1;charset=utf8','root','Takimoto1440');
    
    $test = $pdo ->query("select * from tenko_time");
    $result = $test->fetch();
    
    $tenko_start_hour = $result['tenko_start_hour'];
    $tenko_start_minute=$result['tenko_start_minute'];
    $tenko_finish_hour = $result['tenko_finish_hour'];
    $tenko_finish_minute=$result['tenko_finish_minute'];
?>




<script>
var jikan = new Date();

var hour = jikan.getHours();
var minute = jikan.getMinutes();
var second = jikan.getSeconds();


tenko_s_h="<?php echo $tenko_start_hour?>"+"<?php echo $tenko_start_minute?>";

tenko_f_h="<?php echo $tenko_finish_hour?>";
tenko_f_m="<?php echo $tenko_finish_minute?>";
//点呼開始時間終了時間をMySql→PHP経由で取得

alert(tenko_s_h);
if(){

}else {
}
</script>