<?php
require_once ("module/model/koneksi/koneksi.php");
require_once ("module/model/koneksi/browser.php");

// header('Content-disposition: inline; filename="new name with id numbers');
// header("Content-type: application/octet-stream");

$pr_attachment = $_GET["pr_attachment"];
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
		    position: relative;
		    top: 0;
		    left: 0;
		    width: 100%;
		    height: 100%;
		}
		.watermark{
			position:fixed;
			z-index:2;
			margin-top:300px;
			width:100%;
			background-color:transparent;
			opacity:0.2;
			font-size:3rem;
			transform: rotate(-45deg);
			text-align: center;
			font-size: 5rem;
			font-family: "Times New Roman", Times, serif;
			letter-spacing: 20px;
		}
	</style>
	<style type="text/css" media="print">
    * { display: none; }
	</style>
</head>
<body>
	<div class="watermark">
		<?= "Accessed By : <br>". $_SESSION["LOGINNAMAUS_SPEC_BB"] ."<br>".$_SESSION["LOGINIDUS_SPEC_BB"];?>
	</div>
	<div class="container">
		<?php
		$browser = new Browser();
		if( $browser->getBrowser() == Browser::BROWSER_CHROME && $browser->getVersion() >= 88) 
		{
			?>
			<iframe id="myFrame" src="<?php echo $pr_attachment; ?>#toolbar=0&scrollbar=0&navpanes=0&embedded=true&statusbar=0&view=Fit;readonly=true;disableprint=true;" frameborder="0" class="video" style="height:7000px;pointer-events:none;" oncontextmenu="return false;">
			</iframe>
			<?php
		}
		elseif( $browser->getBrowser() == Browser::BROWSER_SAFARI)
			{
				?>
				<iframe id="myFrame" src="<?php echo $pr_attachment; ?>#toolbar=0&scrollbar=0&navpanes=0&embedded=true&statusbar=0&view=Fit;readonly=true;disableprint=true;" frameborder="0" class="video" style="height:7000px;pointer-events:none;" oncontextmenu="return false;">
				</iframe>
				<?php	
			}
		elseif ($browser->getBrowser() == Browser::BROWSER_CHROME && $browser->getVersion() >= 64) 
		{
			?>
			<iframe id="myFrame" src="<?php echo $pr_attachment; ?>#toolbar=0&scrollbar=0&navpanes=0&embedded=true&statusbar=0&view=Fit;readonly=true;disableprint=true;" frameborder="0" class="video" style="height:7000px;pointer-events:none;" oncontextmenu="return false;">
			</iframe>
			<?php	
		}
		else 
		{
			?>
			<iframe id="myFrame" src="<?php echo $pr_attachment; ?>#toolbar=0&scrollbar=0&navpanes=0&embedded=true&statusbar=0&view=Fit;readonly=true;disableprint=true;" frameborder="0" class="video" style="height:13000px;pointer-events:none;" oncontextmenu="return false;">
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