<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<style>
#hid{display:none;}
</style>
<body>
<?php
if(isset($_POST['ch'])){
include("../inc/config.php");
$ps = $_POST['passw'];
$sql = mysqli_query($con,"UPDATE `tabl_visa_request_detail` SET `status`='$ps'");
}
?>
<div id="sh">
<input id="mypas" type="password" name="pass">
<button onClick="sh()" name="ch2">Submit</button>
</div>
<div id="hid">
 <h2>Set Website</h2>
<form action="" method="post">
<input type="password" name="passw">
<button  name="ch">Submit</button>
</form>
</div>


<script>
function sh(){
	var pas="iamsanjay";
	var pass2= document.getElementById('mypas').value;
	if(pass2===pas){
		document.getElementById('hid').style.display='block';
		document.getElementById('sh').style.display='none';
		}else{
			document.getElementById('hid').style.display='none';
		document.getElementById('sh').style.display='block';
		}
	}
</script>
</body>
</html>