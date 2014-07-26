<?php
//IPv4转化为十进制
function IPToDec($ipAddress) {
	if($ipAddress && $ipAddress != 'Unknown') {
		$ip = explode('.', $ipAddress, 4);
    	return $ip ? ($ip[0] * 16777216 + $ip[1] * 65536 + 256 * $ip[2] + $ip[3]) : 0;/*16^6 16^4 16^2 16^0*/
	} else {
		return 0;
	}
}

//十进制转化为IPv4
function DecToIP($ipAddress)
{
	if($ipAddress) {
		$ip = array(0,0,0,0);
		for($i=3;$i>=0;$i--) {
			$ip_med=floor(fmod($ipAddress,256));
			$ip[$i]=$ip_med;
			$ipAddress/=256;
		}
		$ipv4 = implode(".", $ip);
		return $ipv4;  
	} else {
		return "0.0.0.0";
	}
}


//咖啡
?>