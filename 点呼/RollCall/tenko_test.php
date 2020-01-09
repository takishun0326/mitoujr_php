<html>
<body>

<form name="tenko" action="tenko_kanryou.php" method="post">
    <input type="hidden" name="hidden_input" value=""/>
</form>

<input type="button" value="Complete Roll Call" onclick="test()"/>
</body>
<script type="text/javascript">
//35.08191576230813,134.01427586575412津山高専緯度経度
//
function test() {
    test2(navigator.geolocation.getCurrentPosition());
}

function test2(position) {
    document.tenko.hidden_input.value = "緯度:" + position.coords.latitude;
    document.tenko.hidden_input.value += "経度:" + position.coords.longitude;
    
    var date = new Date(position.timestamp);

    document.tenko.hidden_input.value += "取得時刻:" + date.toLocaleString();
    document.tenko.submit();



}
</script>

</html>