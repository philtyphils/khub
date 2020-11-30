<?php
	include("../service_billing/application/libraries/jqSajax.class.php"); 	
	
	
	function enc(){
		
		//$arr = explode("/",$_SERVER['PHP_SELF']);
		//return NAMA_SERVER."/".$arr[1]."/";
		return "ApLtOWeR11470JaKarTa";
		//return NAMA_SERVER;
	}
	
	
	$ajax = new jqSajax();
	$ajax->export('enc');
	$ajax->processClientReq();
?>