
<?php
function countryCityFromIP($ipAddr)
{
//function to find country and city from IP address
//Developed by Roshan Bhattarai http://roshanbh.com.np

//verify the IP address for the
ip2long($ipAddr)== -1 || ip2long($ipAddr) === false ? trigger_error("Invalid IP", E_USER_ERROR) : "";
$ipDetail=array(); //initialize a blank array

//get the XML result from hostip.info
//$xml = file_get_contents("http://api.hostip.info/?ip=".$ipAddr);

$ch = curl_init();

// informar URL e outras funções ao CURL
curl_setopt($ch, CURLOPT_URL, "http://api.hostip.info/?ip=".$ipAddr);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Acessar a URL e retornar a saída
$xml = curl_exec($ch);

// liberar
curl_close($ch);

//get the city name inside the node <gml:name> and </gml:name>
preg_match("@<Hostip>(\s)*<gml:name>(.*?)</gml:name>@si",$xml,$match);

//assing the city name to the array
//$ipDetail['city']=$match[2]; 

//get the country name inside the node <countryName> and </countryName>
preg_match("@<countryName>(.*?)</countryName>@si",$xml,$matches);

//assign the country name to the $ipDetail array
$ipDetail['country']=$matches[1];

//get the country name inside the node <countryName> and </countryName>
preg_match("@<countryAbbrev>(.*?)</countryAbbrev>@si",$xml,$cc_match);
$ipDetail['country_code']=$cc_match[1]; //assing the country code to array

//return the array containing city, country and country code
return $ipDetail;

}

?>