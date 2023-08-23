<?php
	if (isset($_SERVER['HTTP_USER_AGENT'])) 
	{
	    $agent = $_SERVER['HTTP_USER_AGENT'];
	}

	$arr_browsers = ["Opera", "Edg", "Chrome", "Safari", "Firefox", "MSIE", "Trident"];
	foreach ($arr_browsers as $browser) 
	{
	    if (strpos($agent, $browser) !== false) 
	    {
	        $user_browser = $browser;
	        break;
	    }   
	}
	
	if ($user_browser == "Chrome" or $user_browser == "Safari")
	{
	    session_start();
		ini_set("date.timezone","Asia/Jakarta");
		ini_set('max_execution_time', 0); //300 seconds = 5 minutes
		ini_set('upload_max_filesize', '2M');
		$db1 = new PDO('mysql:host=192.168.10.167:3307;dbname=spekproduk_bb', 'spek', 'spekangka8');
	}
	else
	{
		?><script>alert('Website hanya dapat diakses melalui browser Google Chrome.')</script><?php
	    http_response_code(404);
  		die(0);
	}


	//CONNECTION TIMEOUT--
	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 900)) 
	{
		unset($_SESSION["LOGINIDUS_SPEC_BB"]);
	}
	$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

	header("Refresh:901");
	// -----------------------------------------------------------------------------------------

	$TGL = date("Y-m-d");

	function GetQuery($query){
		$db1 = new PDO('mysql:host=192.168.10.167:3307;dbname=spekproduk_bb', 'spek', 'spekangka8');

		$result = $db1->prepare($query) or trigger_error(mysql_error()); 
		$result->execute();

		return $result;
	}

	function kodeAuto($namatabel,$namakolom)
	{
		$db1 = new PDO('mysql:host=192.168.10.167:3307;dbname=spekproduk_bb', 'spek', 'spekangka8');

		$akhir = 0;
		$stmt = $db1->prepare("select max($namakolom) as akhir from $namatabel");
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			if(isset($row["akhir"]))
			{
				$akhir = intval($row["akhir"]);
			}
		}
		$akhir = $akhir + 1;
		return $akhir;
	}

	function merge_queries(array $original, array $updates) {
	$params = array_merge($original, $updates);
	return '?'.http_build_query($params);
	}
	
	function getIp(){
		$IP_ADDRESS = $_SERVER['REMOTE_ADDR'];     
		if($IP_ADDRESS){
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				$IP_ADDRESS = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$IP_ADDRESS = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}
			return $IP_ADDRESS;
		}
		// There might not be any data
		return false;
	}

	function createKode($namaTabel,$namaKolom,$awalan,$jumlahAngka)
	{
		$db1 = new PDO('mysql:host=192.168.10.167:3307;dbname=spekproduk_bb', 'spek', 'spekangka8');
		$angkaAkhir = 0;
		
		$stmt = $db1->query("select max(right($namaKolom,$jumlahAngka)) as akhir from $namaTabel");
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			if(isset($row["akhir"]))
			{
				$angkaAkhir = intval($row["akhir"]);
			}
		}
		$angkaAkhir = $angkaAkhir + 1;
		return $awalan.substr("00000000".$angkaAkhir,-1*$jumlahAngka);
	}
?>