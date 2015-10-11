<?php
$device_token="APA91bEgvEf5nqbQiPtOcemMl4tREEt1pUdUr_YjyFsWncec7O00QHpsslJBwWBmk8IpBNy5hQEL9wkSebmwiiVB0MbqVDYRP9vvY6hvhv4rvVSMLob3hVi1ea6myCtxopX3UNmoV-KC";
$poruka = 'Ovo je push notifikacija!';

$url = 'http://push.ionic.io/api/v1/push';

$data = array(
                  'tokens' => array($device_token), 
                  'notification' => array('alert' => $poruka),    
                  );
      
$content = json_encode($data);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
curl_setopt($ch, CURLOPT_USERPWD, "e098bf033c4063d39cca8907db43822df88988e04e00af91" . ":" );  
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'X-Ionic-Application-Id: 9c3c346d' 
));
$result = curl_exec($ch);
curl_close($ch);