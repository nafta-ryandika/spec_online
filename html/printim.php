<?php
$KODE_SPEC = $_GET["KODE_SPEC"];

require_once ("module/model/koneksi/koneksi.php");

$result = $db1->prepare("select INTERNAL_MEMO from t_spec where KODE_SPEC = '$KODE_SPEC'"); 
$result->execute();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
	$INTERNAL_MEMO = $row["INTERNAL_MEMO"];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		 .container {
		    position: relative;
		     width: 100%;
		     height: 0;
		     padding-bottom: 56.25%;
		 }
		 .video {
		     position: absolute;
		     top: 0;
		     left: 0;
		     width: 100%;
		     height: 100%;
		 }
	</style>
	<style type="text/css" media="print">
    * { display: none; }
	</style>
	
</head>
<body>
	<!-- <embed id="myFrame" src="<?php echo $KODE_SPEC; ?>#toolbar=0&scrollbar=0&navpanes=0&embedded=true&statusbar=0&view=Fit;readonly=true;disableprint=true;" style="width:100%; height:9000px;pointer-events:none;" frameborder="0">
	</embed>  -->
	<div class="container">
		<?php
		if (isset($_SERVER['HTTP_USER_AGENT'])) {
		    $agent = $_SERVER['HTTP_USER_AGENT'];
		}
		if (strlen(strstr($agent, 'Chrome/64')) > 0 or strlen(strstr($agent, 'Chrome/65')) > 0 or strlen(strstr($agent, 'Chrome/66')) > 0) {
			?>
			<iframe id="myFrame" src="<?php echo $INTERNAL_MEMO; ?>#toolbar=0&scrollbar=0&navpanes=0&embedded=true&statusbar=0&view=Fit;readonly=true;disableprint=true;" frameborder="0" class="video" style="pointer-events:none;">
			</iframe>
			<?php
		}
		else{
			?>
			<iframe id="myFrame" src="<?php echo $INTERNAL_MEMO; ?>#toolbar=0&scrollbar=0&navpanes=0&embedded=true&statusbar=0&view=Fit;readonly=true;disableprint=true;" frameborder="0" class="video" style="pointer-events:none;height:15000px;">
			</iframe>
			<?php
		}
		?>
	</div> 
	<script type="text/javascript">
		document.oncontextmenu = function() { 
	    return false; 
	};
	window.onbeforeunload = function () {//Prevent Ctrl+W
	    return;
	};

	document.onkeydown = function (e) {
	    e = e || window.event;//Get event
	    if (e.ctrlKey) {
	        var c = e.which || e.keyCode;//Get key code
	        switch (c) {
	            case 83://Block Ctrl+S
	            case 87://Block Ctrl+W --Not work in Chrome
	                e.preventDefault();     
	                e.stopPropagation();
	            break;
	        }
	    }
	};
	</script>                      
</body>
</html>