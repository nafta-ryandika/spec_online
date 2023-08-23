<?php
require_once ("module/model/koneksi/koneksi.php");
require_once ("module/model/koneksi/browser.php");

$KS 	= $_GET["KODE_SPEC"];
$AKS 	= $_GET["AKS"];

if($AKS == "PRODUCT")
{
	$result = $db1->prepare("select FILEPROD as FILE from t_spec where KODE_SPEC = '$KS'"); 
}
elseif($AKS == "PACKAGING" )
{
	$result = $db1->prepare("select FILEPACK as FILE from t_spec where KODE_SPEC = '$KS'"); 
}
elseif($AKS == "FULL")
{
	$result = $db1->prepare("select FILE as FILE from t_spec where KODE_SPEC = '$KS'"); 
}

$result->execute();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
	$KODE_SPEC = $row["FILE"];
}
?>
<!DOCTYPE html>
<html>
	<head>
		<script src="../plugins/jquery/jquery-1.10.2.js"></script>
		<title>Print Document Spec</title>
		<style type="text/css">
			.container {
			    position: relative;
			    width: 100%;
			    height: 0;
			    padding-bottom: 56.25%;
			}
			.video {
			    position: relative;
			    top: 0;
			    left: 0;
			    width: 100%;
			    height: 100%;
			}
			#watermark
			{
			 position:fixed;
			 bottom:5px;
			 right:5px;
			 opacity:0.5;
			 z-index:99;
			 color:white;
			}
		</style>

		<style type="text/css" media="print">
		* { display: none; }
		</style>

		<script type="text/jscript">
		    function injectJS(){    
		        var frame    = $('myFrame');
		        var contents = frame.contents();
		        var body     = contents.find('body').attr("oncontextmenu", "return false");
		        var body     = contents.find('body').append('<div>New Div</div>');    
		    }
		</script>
		
		<script language="JavaScript" Type="text/javascript">
		// Disable keyboard button
		document.onkeydown = function (e) {
		    e = e || window.event;//Get event
		    if (e.ctrlKey) 
		    {
		        var c = e.which || e.keyCode;//Get key code
		        switch (c) 
		        {
		            case 80://Block Ctrl+P
		            case 83://Block Ctrl+S
		            // case 44://Block Printscreen
		                e.preventDefault();     
		                e.stopPropagation();
		            break;
		        }
		    }
		};

		//hide page when windows is not on focus
			$(window).focus(function() {
				$("body").show();
				}).blur(function() {
				$("body").hide();
				});
				
		// Disable right click
		document.oncontextmenu = function(){ 
		    return false; 
		};

		//alert before page loaded / closed
			// window.onbeforeunload = function () 
			// {
			//     return true;
			// };
		</script>
		
	</head>
	<body>
		<div class="container">
			<?php
			$browser = new Browser();
			if( $browser->getBrowser() == Browser::BROWSER_CHROME && $browser->getVersion() == 74) 
			{
				?>
				<iframe id="myFrame" src="<?php echo $KODE_SPEC; ?>#toolbar=0&scrollbar=0&navpanes=0&embedded=true&statusbar=0&view=Fit;readonly=true;disableprint=true;" frameborder="0" class="video" style="height:13000px;pointer-events:none;" oncontextmenu="return false;">
				</iframe>
				<?php
			}
			elseif( $browser->getBrowser() == Browser::BROWSER_SAFARI)
			{
				?>
				<iframe id="myFrame" src="<?php echo $KODE_SPEC; ?>#toolbar=0&scrollbar=0&navpanes=0&embedded=true&statusbar=0&view=Fit;readonly=true;disableprint=true;" frameborder="0" class="video" style="height:13000px;pointer-events:none;" oncontextmenu="return false;">
				</iframe>
				<?php	
			}
			elseif( $browser->getBrowser() == Browser::BROWSER_CHROME && $browser->getVersion() == 29) 
			{
				?>
				<iframe id="myFrame" src="<?php echo $KODE_SPEC; ?>#toolbar=0&scrollbar=0&navpanes=0&embedded=true&statusbar=0&view=Fit;readonly=true;disableprint=true;" frameborder="0" class="video" style="height:10000px;pointer-events:none;" oncontextmenu="return false;">
				</iframe>
				<?php
			}
			elseif( $browser->getBrowser() == Browser::BROWSER_CHROME && $browser->getVersion() == 75) 
			{
				?>
				<iframe id="myFrame" src="<?php echo $KODE_SPEC; ?>#toolbar=0&scrollbar=0&navpanes=0&embedded=true&statusbar=0&view=Fit;readonly=true;disableprint=true;" frameborder="0" class="video" style="height:8000px;pointer-events:none;" oncontextmenu="return false;">
				</iframe>
				<?php
			}
			elseif( $browser->getBrowser() == Browser::BROWSER_CHROME && $browser->getVersion() == 78) 
			{
				?>
				<iframe id="myFrame" src="<?php echo $KODE_SPEC; ?>#toolbar=0&scrollbar=0&navpanes=0&embedded=true&statusbar=0&view=Fit;readonly=true;disableprint=true;" frameborder="0" class="video" style="height:8000px;pointer-events:none;" oncontextmenu="return false;">
				</iframe>
				<?php
			}
			elseif( $browser->getBrowser() == Browser::BROWSER_CHROME && $browser->getVersion() == 80) 
			{
				?>
				<iframe id="myFrame" src="<?php echo $KODE_SPEC; ?>#toolbar=0&scrollbar=0&navpanes=0&embedded=true&statusbar=0&view=Fit;readonly=true;disableprint=true;" frameborder="0" class="video" style="height:5200px;pointer-events:none;" oncontextmenu="return false;">
				</iframe>
				<?php
			}
			elseif( $browser->getBrowser() == Browser::BROWSER_CHROME && $browser->getVersion() == 81) 
			{
				?>`
				<iframe id="myFrame" src="<?php echo $KODE_SPEC; ?>#toolbar=0&scrollbar=0&navpanes=0&embedded=true&statusbar=0&view=Fit;readonly=true;disableprint=true;" frameborder="0" class="video" style="height:8000px;pointer-events:none;" oncontextmenu="return false;">
				</iframe>
				<?php
			}
			elseif( $browser->getBrowser() == Browser::BROWSER_CHROME && $browser->getVersion() == 83) 
			{
				?>
				<iframe id="myFrame" src="<?php echo $KODE_SPEC; ?>#toolbar=0&scrollbar=0&navpanes=0&embedded=true&statusbar=0&view=Fit;readonly=true;disableprint=true;" frameborder="0" class="video" style="height:6000px;pointer-events:none;" oncontextmenu="return false;">
				</iframe>
				<?php
			}
			elseif( $browser->getBrowser() == Browser::BROWSER_CHROME && $browser->getVersion() == 85) 
			{
				?>
				<iframe id="myFrame" src="<?php echo $KODE_SPEC; ?>#toolbar=0&scrollbar=0&navpanes=0&embedded=true&statusbar=0&view=Fit;readonly=true;disableprint=true;" frameborder="0" class="video" style="height:9000px;pointer-events:none;" oncontextmenu="return false;">
				</iframe>
				<?php
			}
			elseif( $browser->getBrowser() == Browser::BROWSER_CHROME && $browser->getVersion() == 86) 
			{
				?>
				<iframe id="myFrame" src="<?php echo $KODE_SPEC; ?>#toolbar=0&scrollbar=0&navpanes=0&embedded=true&statusbar=0&view=Fit;readonly=true;disableprint=true;" frameborder="0" class="video" style="height:8200px;pointer-events:none;" oncontextmenu="return false;">
				</iframe>
				<?php
			}
			elseif( $browser->getBrowser() == Browser::BROWSER_CHROME && $browser->getVersion() == 87) 
			{
				?>
				<!-- 9000 -->
				<iframe id="myFrame" src="<?php echo $KODE_SPEC; ?>#toolbar=0&scrollbar=0&navpanes=0&embedded=true&statusbar=0&view=Fit;readonly=true;disableprint=true;" frameborder="0" class="video" style="height:5000px;pointer-events:none;" oncontextmenu="return false;">
				</iframe>
				<?php
			}
			elseif( $browser->getBrowser() == Browser::BROWSER_CHROME && $browser->getVersion() == 88) 
			{
				?>
				<iframe id="myFrame" src="<?php echo $KODE_SPEC; ?>#toolbar=0&scrollbar=0&navpanes=0&embedded=true&statusbar=0&view=Fit;readonly=true;disableprint=true;" frameborder="0" class="video" style="height:10000px;pointer-events:none;" oncontextmenu="return false;">
				</iframe>
				<?php
			}
			elseif( $browser->getBrowser() == Browser::BROWSER_CHROME && $browser->getVersion() == 89) 
			{
				?>
				<iframe id="myFrame" src="<?php echo $KODE_SPEC; ?>#toolbar=0&scrollbar=0&navpanes=0&embedded=true&statusbar=0&view=Fit;readonly=true;disableprint=true;" frameborder="0" class="video" style="height:12000px;pointer-events:none;" oncontextmenu="return false;">
				</iframe>
				<?php
			}
			elseif( $browser->getBrowser() == Browser::BROWSER_CHROME && $browser->getVersion() == 93) 
			{
				?>
				<iframe id="myFrame" src="<?php echo $KODE_SPEC; ?>#toolbar=0&scrollbar=0&navpanes=0&embedded=true&statusbar=0&view=Fit;readonly=true;disableprint=true;" frameborder="0" class="video" style="height:12000px;pointer-events:none;" oncontextmenu="return false;">
				</iframe>
				<?php
			}
			elseif( $browser->getBrowser() == Browser::BROWSER_CHROME && $browser->getVersion() == 99) 
			{
				?>
				<iframe id="myFrame" src="<?php echo $KODE_SPEC; ?>#toolbar=0&scrollbar=0&navpanes=0&embedded=true&statusbar=0&view=Fit;readonly=true;disableprint=true;" frameborder="0" class="video" style="height:12000px;pointer-events:none;" oncontextmenu="return false;">
				</iframe>
				<?php
			}
			else 
			{
			?>
				<iframe id="myFrame" src="<?php echo $KODE_SPEC; ?>#toolbar=0&scrollbar=0&navpanes=0&embedded=true&statusbar=0&view=Fit;readonly=true;disableprint=true;" frameborder="0" class="video" style="height:10000px;pointer-events:none;" oncontextmenu="return false;">
				</iframe>
			<?php
			}
			?>
		</div>  
	</body>
</html>