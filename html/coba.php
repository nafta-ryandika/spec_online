<?php
require_once ("module/model/koneksi/koneksi.php");
require_once ("module/model/koneksi/browser.php");

$KS 	= $_GET["KODE_SPEC"];

$result = $db1->prepare("select FILE from t_spec where KODE_SPEC = '$KS'"); 
$result->execute();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
	$KODE_SPEC = $row["FILE"];
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Print Document Spec</title>
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

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
		</script>

		<script type="text/jscript">
		    function injectJS(){    
		        var frame    = $('myFrame');
		        var contents = frame.contents();
		        var body     = contents.find('body').attr("oncontextmenu", "return false");
		        var body     = contents.find('body').append('<div>New Div</div>');    
		    }
		</script>
		
		<script language="JavaScript" Type="text/javascript">
		function popupMsg(theMsg) 
		{
			alert(theMsg);
		}
		</script>
		
	</head>
	<body oncontextmenu="return false;">
		<div class="container">
			<?php
			$browser = new Browser();
			if( $browser->getBrowser() == Browser::BROWSER_CHROME && $browser->getVersion() >= 64) 
			{
				?>
				<iframe id="myFrame" src="<?php echo $KODE_SPEC; ?>#toolbar=0#scrollbar=1" class="video" style="height:5000px;pointer-events:none;" oncontextmenu="return false;">
				</iframe>
				<?php
			}
			else 
			{
			?>
				<iframe id="myFrame" src="<?php echo $KODE_SPEC; ?>#toolbar=0&scrollbar=0&navpanes=0&embedded=true&statusbar=0&view=Fit;readonly=true;disableprint=true;" frameborder="0" class="video" style="height:13000px;pointer-events:auto;" oncontextmenu="return false;">
				</iframe>
			<?php
			}
			?>
		</div>

		<script type="text/javascript">	
		document.oncontextmenu = function() 
		{ 
		    return false; 
		};

		//alert before page loaded / closed
		window.onbeforeunload = function () 
		{
		    return true;
		};

		document.onkeydown = function (e) {
		    e = e || window.event;//Get event
		    if (e.ctrlKey) 
		    {
		        var c = e.which || e.keyCode;//Get key code
		        switch (c) 
		        {
		            case 80://Block Ctrl+P
		            case 83://Block Ctrl+S
		                e.preventDefault();     
		                e.stopPropagation();
		            break;
		        }
		    }
		};
	</script>   
	</body>
</html>