<?php

/*
$memtotal = 1 * 1024 * 1024;

$memtotal = intval($memtotal) / 1024 / 1024;

/*
function bytesToSize($bytes, $precision = 2)
{  
    $kilobyte = 1024;
    $megabyte = $kilobyte * 1024;
    $gigabyte = $megabyte * 1024;
    $terabyte = $gigabyte * 1024;
   
    if (($bytes >= 0) && ($bytes < $kilobyte)) {
        return $bytes . ' B';
 
    } elseif (($bytes >= $kilobyte) && ($bytes < $megabyte)) {
        return round($bytes / $kilobyte, $precision) . ' KB';
 
    } elseif (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
        return round($bytes / $megabyte, $precision) . ' MB';
 
    } elseif (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
        return round($bytes / $gigabyte, $precision) . ' GB';
 
    } elseif ($bytes >= $terabyte) {
        return round($bytes / $terabyte, $precision) . ' TB';
    } else {
        return $bytes . ' B';
    }
}

$gb = "19G";
//$gb = intval($gb) * 1024 * 1024 * 1024;

//echo bytesToSize($gb);

echo substr($gb,-1);

/*
$_IP_ADDRESS = $_SERVER['REMOTE_ADDR'];
$_PERINTAH = "arp -a $_IP_ADDRESS";
ob_start();
system($_PERINTAH);
$_HASIL = ob_get_contents();
ob_clean();
$_PECAH = strstr($_HASIL, $_IP_ADDRESS);
$_PECAH_STRING = explode($_IP_ADDRESS, str_replace(" ", "", $_PECAH));
$_HASIL = substr($_PECAH_STRING[1], 0, 17);
echo "IP Anda : ".$_IP_ADDRESS."
MAC ADDRESS Anda : ".$_HASIL;

/*
ob_start(); 
system("ipconfig /all"); 
 $cominfo=ob_get_contents(); 
ob_clean(); 
$search = "Physical";
$primarymac = strpos($cominfo, $search); 
$mac=substr($cominfo,($primarymac+36),17);//MAC Address
echo $mac;
*/
?>