<?php
header('Content-Type: application/json; charset=utf-8');

$userTokenFile = "config/user_token";
$userDeviceIDFile = "config/user_device_id";


$userToken = file_get_contents($userTokenFile);
$userDeviceID = file_get_contents($userDeviceIDFile);
$AKAMAI_ENCRYPTION_KEY = "\x05\xfc\x1a\x01\xca\xc9\x4b\xc4\x12\xfc\x53\x12\x07\x75\xf9\xee";
$st = time();
$exp = $st + 6000;
$hotstarauth = "st=$st~exp=$exp~acl=/*";
$hotstarauth = "$hotstarauth"."~hmac=" . hash_hmac("sha256", $hotstarauth, $AKAMAI_ENCRYPTION_KEY);
$auth = "hdntl=exp=$exp~acl=/*";
$auth1 = "$auth"."~data=hdntl~hmac=" . hash_hmac("sha256", $hotstarauth, $AKAMAI_ENCRYPTION_KEY);

$id = $_GET['id'];

$url= "https://api.hotstar.com/play/v2/playback/content/$id?device-id=$userDeviceID&desired-config=|&os-name=Android&os-version=8";

$headers = array(
    'hotstarauth: '.$hotstarauth,
    'X-Country-Code: in',
    'X-HS-AppVersion: 3.3.0',
    'X-HS-Platform: firetv',
    'X-HS-Client: platform:android;app_id:in.startv.hotstar;app_version:23.02.20.38;os:Android;os_version:8.1.0;schema_version:0.0.771;brand:vivo;model:vivo 1724;carrier:;network_data:UNKNOWN',
    'X-HS-UserToken: '.$userToken,
    'Cookie: '.$auth1,
);

$curl = curl_init();
  curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => $headers,
));

$response = curl_exec($curl);
curl_close($curl);

$zx = json_decode($response, true);

$xurl = $zx['data']['playBackSets'][0]['playbackUrl'];
$blink = @get_headers($xurl, 1); 
$alink = $blink['Set-Cookie'];

echo $alink;

echo "" . PHP_EOL;
echo "" . PHP_EOL;

echo $xurl;

echo "" . PHP_EOL;
echo "" . PHP_EOL;

echo $response;


?>
