<?php
header('Content-Type: application/json; charset=utf-8');

// $userTokenFile = "/var/task/user/api/config/user_token";
// $userDeviceIDFile = "/var/task/user/api/config/user_device_id";


// $userToken = file_get_contents($userTokenFile);
// $userDeviceID = file_get_contents($userDeviceIDFile);
$userToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhdWQiOiJ1bV9hY2Nlc3MiLCJleHAiOjE2ODY4MzExMTIsImlhdCI6MTY4Njc0NDcxMiwiaXNzIjoiVFMiLCJqdGkiOiIxNjZmN2MxMWM2ZDk0MGE3YjFmZTI1NmFjYTYyZTMwMiIsInN1YiI6IntcImhJZFwiOlwiZWMyZGZhOTYyMDQxNDZhYmE2MTMxNTJkOWY4YzZkNzRcIixcInBJZFwiOlwiNDllZDkxYjM1ODliNGQ2Y2FhNDg0MjQ0ZjM3NGY0MWJcIixcIm5hbWVcIjpcIlJham5pc2gga3VtYXJcIixcInBob25lXCI6XCI5MDIxMjkzODg2XCIsXCJpcFwiOlwiMTIyLjE2My41OS4yMDlcIixcImNvdW50cnlDb2RlXCI6XCJpblwiLFwiY3VzdG9tZXJUeXBlXCI6XCJudVwiLFwidHlwZVwiOlwicGhvbmVcIixcImlzRW1haWxWZXJpZmllZFwiOmZhbHNlLFwiaXNQaG9uZVZlcmlmaWVkXCI6dHJ1ZSxcImRldmljZUlkXCI6XCJjZWU2YjFlOC02ZGQxLTQ0NzItOGZmZi00MTcxOWMzNWNiMDZcIixcInByb2ZpbGVcIjpcIkFEVUxUXCIsXCJ2ZXJzaW9uXCI6XCJ2MlwiLFwic3Vic2NyaXB0aW9uc1wiOntcImluXCI6e1wiSG90c3RhclN1cGVyXCI6e1wic3RhdHVzXCI6XCJTXCIsXCJleHBpcnlcIjpcIjIwMjQtMDItMDNUMTQ6MTI6MjcuMDAwWlwiLFwic2hvd0Fkc1wiOlwiMVwiLFwiY250XCI6XCIxXCJ9fX0sXCJlbnRcIjpcIkNyVUJDZ1VLQXdvQkJSS3JBUklIWVc1a2NtOXBaQklEYVc5ekVnTjNaV0lTQ1dGdVpISnZhV1IwZGhJR1ptbHlaWFIyRWdkaGNIQnNaWFIyRWdSdGQyVmlFZ2QwYVhwbGJuUjJFZ1YzWldKdmN4SUdhbWx2YzNSaUVnUnliMnQxRWdkcWFXOHRiSGxtRWdwamFISnZiV1ZqWVhOMEVnUjBkbTl6RWdSd1kzUjJFZ05xYVc4YUFuTmtHZ0pvWkJvRFptaGtJZ056WkhJcUJuTjBaWEpsYnlvSVpHOXNZbmsxTGpFcUNtUnZiR0o1UVhSdGIzTllBUW9ORWdzSUFqZ0NRQUZRdUFoWUFRb2lDaG9LRGhJRk5UVTRNellTQlRZME1EUTVDZ2dpQm1acGNtVjBkaElFT0dSWUFRcklBUW9GQ2dNS0FRQVN2Z0VTQjJGdVpISnZhV1FTQTJsdmN4SURkMlZpRWdsaGJtUnliMmxrZEhZU0JtWnBjbVYwZGhJSFlYQndiR1YwZGhJRWJYZGxZaElIZEdsNlpXNTBkaElGZDJWaWIzTVNCbXBwYjNOMFloSUVjbTlyZFJJSGFtbHZMV3g1WmhJS1kyaHliMjFsWTJGemRCSUVkSFp2Y3hJRWNHTjBkaElEYW1sdkVnUjRZbTk0RWd0d2JHRjVjM1JoZEdsdmJob0NjMlFhQW1oa0dnTm1hR1FpQTNOa2Npb0djM1JsY21WdktnaGtiMnhpZVRVdU1Tb0taRzlzWW5sQmRHMXZjMWdCRWdrSUFSRDRnY0g2MWpFPVwiLFwiaXNzdWVkQXRcIjoxNjg2NzQ0NzEyMTQ2fSIsInZlcnNpb24iOiIxXzAifQ.Yse6W8Cj-BVdGvCI9sVXtnYaxS6YdMvfTwSw8E5UHWs";
$userDeviceID = "cee6b1e8-6dd1-4472-8fff-41719c35cb06";
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
