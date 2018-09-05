<?php
date_default_timezone_set('Asia/Jakarta');
require_once("sdata-modules.php");
/**
 * @Author: Eka Syahwan
 * @Date:   2017-12-11 17:01:26
 * @Last Modified by:   Eka Syahwan
 * @Last Modified time: 2018-09-05 10:48:10
*/
##############################################################################################################

$config['mmses'] 		= 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$config['gaid'] 		= 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$config['av'] 			= 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$config['imei'] 		= 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

##############################################################################################################
echo "[+] BOT TELAH JALAN ... TUNGGU SEBENTAR ..\r\n";
echo "[+] JIKA TIDAK ADA RESPONS DARI SERVER MAKA TOKEN / DATA CONFIG KAMU SALAH\r\n\n";
$urls[] = array('url' 	=> 'https://api.ctree.id/api2/user/info?mmses='.$config['mmses'].'&av='.$config['av'].'&ov=8.0.0&lc=in_ID&pn=com.vitiglobal.cashtree');
$responsx = $sdata->sdata($urls); unset($url); 
$jsonAuth = json_decode($responsx[0]['respons'],true);
if($jsonAuth['code'] == 0 && !empty($jsonAuth['result']['info']['ph'])){
	echo "[+] ========= INFORMASI AKUN ============= [+]\r\n";
	echo "[+] Saldo : ".$jsonAuth['result']['cash_status']['total']."\r\n[+] Reward Harian : ".$jsonAuth['result']['cash_status']['earn_today']."\r\n";
	echo "[+] No HP : ".$jsonAuth['result']['info']['ph']."\r\n[+] Invite Code : ".$jsonAuth['result']['info']['inv_code']."\r\n";
	echo "[+] ========= =============  ============= [+]\r\n";
	echo "[+] Login berhasil ...\r\n";
	echo "\r\n\n";
}else{
	die("Config anda salah.");
}
while (TRUE) {
	$url[] = array('url' => 'https://api.ctree.id/api2/ad/list');
	$hed[] = array('post' => 'lng=111.22222&gaid='.$config['gaid'].'&ov=8.0.0&l={}&m={}&mmses='.$config['mmses'].'&r={}&gpid=^localroot'.time().'n@gmail.com&av='.$config['av'].'&lc=in_ID&imei='.$config['imei'].'&pn=com.vitiglobal.cashtree&lat=-6.123388383');
	$respons = $sdata->sdata($url , $hed); unset($url); unset($hed);
	$json 	 = json_decode($respons['0']['respons'],true);
	foreach ($json['result']['al'] as $key => $datadaily) {
		if(strtolower($datadaily['tp']) == 'visit'){
			if($datadaily['dr'] == 0){
				echo "[+][".$datadaily['a']."][ ".$datadaily['tp']." | Reward : ".$datadaily['dr']."] ".$datadaily['tt']." (Sudah di reedem)\r\n";
			}else{
				echo "[+][".$datadaily['a']."][ ".$datadaily['tp']." | Reward : ".$datadaily['dr']."] ".$datadaily['tt'];
				$url[] = array('url' 	=> 'https://api.ctree.id/api2/ad/start');
				$hed[] = array('post'	=> 'mmses='.$config['mmses'].'&adid='.$datadaily['a'].'&av='.$config['av'].'&ov=8.0.0&lc=in_ID&from=C&pn=com.vitiglobal.cashtree');
				$respons = $sdata->sdata($url , $hed); unset($url); unset($hed);
				$json 	 = json_decode($respons['0']['respons'],true);

				$url[] = array('url' 	=> "https://api.ctree.id/".$json['result']['redirect']);
				$url[] = array('url' 	=> $json['result']['url']);
				$urls[] = array('url' 	=> 'https://api.ctree.id/api2/user/info?mmses='.$config['mmses'].'&av='.$config['av'].'&ov=8.0.0&lc=in_ID&pn=com.vitiglobal.cashtree');

				$respons = $sdata->sdata($url); unset($url); 
				$responsx = $sdata->sdata($urls); unset($url); 

				$json = json_decode($responsx['0']['respons'],true);
				echo " => Visit Success (Saldo : ".$json['result']['cash_status']['total']." | Earn Today : ".$json['result']['cash_status']['earn_today']." )\r\n";

			}
		}

		if(strtolower($datadaily['tp']) == 'watch'){
			if($datadaily['dr'] == 0){
				echo "[+][".$datadaily['a']."][ ".$datadaily['tp']." | Reward : ".$datadaily['dr']."] ".$datadaily['tt']." (Sudah di reedem)\r\n";
			}else{
				echo "[+][".$datadaily['a']."][ ".$datadaily['tp']." | Reward : ".$datadaily['dr']."] ".$datadaily['tt'];
				$url[] = array('url' 	=> 'https://api.ctree.id/api2/ad/start');
				$hed[] = array('post'	=> 'mmses='.$config['mmses'].'&adid='.$datadaily['a'].'&av='.$config['av'].'&ov=8.0.0&lc=in_ID&from=C&pn=com.vitiglobal.cashtree');
				$respons = $sdata->sdata($url , $hed); unset($url); unset($hed);
				$json 	 = json_decode($respons['0']['respons'],true);

				$url[] 		= array('url' 	=> "https://api.ctree.id/".$json['result']['redirect']);
				$urls[] 	= array('url' 	=> 'https://api.ctree.id/api2/user/info?mmses='.$config['mmses'].'&av='.$config['av'].'&ov=8.0.0&lc=in_ID&pn=com.vitiglobal.cashtree');
				$reedm[] 	= array('url' 	=> "https://api.ctree.id/api2/ad/complete/video");
				$reedh[] 	= array('post' 	=> 'mmses='.$config['mmses'].'&adid='.$datadaily['a'].'&av='.$config['av'].'&ov=8.0.0&lc=in_ID&pn=com.vitiglobal.cashtree');

				$respons 	= $sdata->sdata($url); unset($url); 
				$responsx 	= $sdata->sdata($urls); unset($urls); 
				$responsrd 	= $sdata->sdata($reedm , $reedh); unset($reedm);unset($reedh); 

				$jsonns = json_decode($responsrd['0']['respons'],true);
				$json = json_decode($responsx['0']['respons'],true);

				if($jsonns['code'] == '401001'){
					echo " => Watch Failed (Saldo : ".$json['result']['cash_status']['total']." | Earn Today : ".$json['result']['cash_status']['earn_today']." )\r\n";
				}else{
					echo " => Watch Success (Saldo : ".$json['result']['cash_status']['total']." | Earn Today : ".$json['result']['cash_status']['earn_today']." )\r\n";
				}
			}
		}

		if(strtolower($datadaily['tp']) == 'install'){
			if($datadaily['dr'] == 0){
				echo "[+][".$datadaily['a']."][ ".$datadaily['tp']." | Reward : ".$datadaily['dr']."] ".$datadaily['tt']." (Sudah di reedem)\r\n";
			}else{
				echo "[+][".$datadaily['a']."][ ".$datadaily['tp']." | Reward : ".$datadaily['dr']."] ".$datadaily['tt'];

				$url[] 		= array('url' 	=> 'https://api.ctree.id/api2/ad/start');
				$hed[] 		= array('post'	=> 'mmses='.$config['mmses'].'&adid='.$datadaily['a'].'&av='.$config['av'].'&ov=8.0.0&lc=in_ID&from=C&pn=com.vitiglobal.cashtree');
				$respons 	= $sdata->sdata($url , $hed); unset($url); unset($hed);
				$json 	 	= json_decode($respons['0']['respons'],true);

				$url[] 		= array('url' 	=> "https://api.ctree.id/".$json['result']['redirect']);
				$apps[] 	= array('url' 	=> "https://api.ctree.id/api2/user/apps/add");
				$apph[] 	= array('post'	=> 'app='.$datadaily['pk'].'&mmses='.$config['mmses'].'&size=13384697&av='.$config['av'].'&ov=8.0.0&lc=in_ID&pn=com.vitiglobal.cashtree');

				$claim[] 	= array('url' 	=> "https://api.ctree.id/api2/ad/complete/reward");
				$claih[] 	= array('post'	=> 'mmses='.$config['mmses'].'&adid='.$datadaily['a'].'&av='.$datadaily['av'].'&ov=8.0.0&lc=in_ID&pn=com.vitiglobal.cashtree');
			
				$urls[] 	= array('url' 	=> 'https://api.ctree.id/api2/user/info?mmses='.$config['mmses'].'&av='.$config['av'].'&ov=8.0.0&lc=in_ID&pn=com.vitiglobal.cashtree');
				$responsx 	= $sdata->sdata($urls); unset($urls); 

				$respons 	= $sdata->sdata($url); unset($url);  
				$responsrd 	= $sdata->sdata($apps , $apph); unset($apph);unset($apps); 
				$responscl 	= $sdata->sdata($claim , $claih); unset($claim);unset($claih); 
				$jsonns 	= json_decode($responsrd['0']['respons'],true);
				print_r($jsonns);


				print_r($responscl);
				$json 		= json_decode($responsx['0']['respons'],true);
				$jsoncl 	= json_decode($responscl['0']['respons'],true);

				//print_r($jsoncl);

				if($jsonns['code'] == '401001' || $jsoncl['code'] != 0){
					echo " => Install Failed (Saldo : ".$json['result']['cash_status']['total']." | Earn Today : ".$json['result']['cash_status']['earn_today']." )\r\n";
				}else{
					echo " => Install Success (Saldo : ".$json['result']['cash_status']['total']." | Earn Today : ".$json['result']['cash_status']['earn_today']." )\r\n";
				}

			}
		}

	}
	echo "[+] Delay : ";
	for ($i=0; $i <5; $i++) { 
		if(!preg_match("/\./", ((10 / 100) * $i))){
			echo ((10 / 100) * $i)." % ";
		}
		sleep(1);
	}
	echo "\r\n";
}
?>
