<?php
$KODE_SPEC = $_GET["KODE_SPEC"];

require_once ("module/model/koneksi/koneksi.php");

$result = $db1->prepare("select FILE from t_spec where KODE_SPEC = '$KODE_SPEC'"); 
$result->execute();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
	$KODE_SPEC = $row["FILE"];
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
		<iframe src="<?php echo $KODE_SPEC; ?>#toolbar=0&scrollbar=0&navpanes=0&embedded=true&statusbar=0&view=Fit;readonly=true;disableprint=true;" style="position: absolute; width: 100%; height: 100%; border: none;pointer-events:none;"></iframe>
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