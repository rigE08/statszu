<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >

<link rel="stylesheet" type="text/css" href="bootstrap.css" />
<link rel="stylesheet" type="text/css" href="zustats.css" />

<script src="js/jquery-1.4.4.min.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/jquery.titlecase.js"></script>
<script type="text/javascript" src="js/jquery.blockUI.js"></script>
<script src="scripts.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-4KM27M68TB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-4KM27M68TB');
</script>


<body onload="make_oddeven(0)"><center>
<?php

?>
</center>
<p>
<?php
require 'inc/db.php';
global $db_table;

// Add and Mul functions are made by Nitrogen. (http://www.php.net/manual/pt_BR/function.bcmul.php#92103)
function Add($Num1,$Num2,$Scale=null) {
   // check if they're valid positive numbers, extract the whole numbers and decimals
   if(!preg_match("/^\+?(\d+)(\.\d+)?$/",$Num1,$Tmp1)||
      !preg_match("/^\+?(\d+)(\.\d+)?$/",$Num2,$Tmp2)) return('0');

   // this is where the result is stored
   $Output=array();

   // remove ending zeroes from decimals and remove point
   $Dec1=isset($Tmp1[2])?rtrim(substr($Tmp1[2],1),'0'):'';
   $Dec2=isset($Tmp2[2])?rtrim(substr($Tmp2[2],1),'0'):'';

   // calculate the longest length of decimals
   $DLen=max(strlen($Dec1),strlen($Dec2));

   // if $Scale is null, automatically set it to the amount of decimal places for accuracy
   if($Scale==null) $Scale=$DLen;

   // remove leading zeroes and reverse the whole numbers, then append padded decimals on the end
   $Num1=strrev(ltrim($Tmp1[1],'0').str_pad($Dec1,$DLen,'0'));
   $Num2=strrev(ltrim($Tmp2[1],'0').str_pad($Dec2,$DLen,'0'));

   // calculate the longest length we need to process
   $MLen=max(strlen($Num1),strlen($Num2));

   // pad the two numbers so they are of equal length (both equal to $MLen)
   $Num1=str_pad($Num1,$MLen,'0');
   $Num2=str_pad($Num2,$MLen,'0');

   // process each digit, keep the ones, carry the tens (remainders)
   for($i=0;$i<$MLen;$i++) {
     $Sum=((int)$Num1{$i}+(int)$Num2{$i});
     if(isset($Output[$i])) $Sum+=$Output[$i];
     $Output[$i]=$Sum%10;
     if($Sum>9) $Output[$i+1]=1;
   }

   // convert the array to string and reverse it
   $Output=strrev(implode($Output));
   return($Output);
	/*//echo  ";:;" . substr($Output,0,strlen($Output));
   // substring the decimal digits from the result, pad if necessary (if $Scale > amount of actual decimals)
   // next, since actual zero values can cause a problem with the substring values, if so, just simply give '0'
   // next, append the decimal value, if $Scale is defined, and return result
   $Decimal=str_pad(substr($Output,-$DLen,$Scale),$Scale,'0');
   $Output=(($MLen-$DLen<1)?'0':substr($Output,0,-$DLen));
   $Output.=(($Scale>0)?".{$Decimal}":'');
   */

 }

 function Mul($Num1='0',$Num2='0') {
   // check if they're both plain numbers
   if(!preg_match("/^\d+$/",$Num1)||!preg_match("/^\d+$/",$Num2)) return(0);

   // remove zeroes from beginning of numbers
   for($i=0;$i<strlen($Num1);$i++) if(@$Num1{$i}!='0') {$Num1=substr($Num1,$i);break;}
   for($i=0;$i<strlen($Num2);$i++) if(@$Num2{$i}!='0') {$Num2=substr($Num2,$i);break;}

   // get both number lengths
   $Len1=strlen($Num1);
   $Len2=strlen($Num2);

   // $Rema is for storing the calculated numbers and $Rema2 is for carrying the remainders
   $Rema=$Rema2=array();

   // we start by making a $Len1 by $Len2 table (array)
   for($y=$i=0;$y<$Len1;$y++)
     for($x=0;$x<$Len2;$x++)
       // we use the classic lattice method for calculating the multiplication..
       // this will multiply each number in $Num1 with each number in $Num2 and store it accordingly
       @$Rema[$i++%$Len2].=sprintf('%02d',(int)$Num1{$y}*(int)$Num2{$x});

   // cycle through each stored number
   for($y=0;$y<$Len2;$y++)
     for($x=0;$x<$Len1*2;$x++)
       // add up the numbers in the diagonal fashion the lattice method uses
       @$Rema2[Floor(($x-1)/2)+1+$y]+=(int)$Rema[$y]{$x};

   // reverse the results around
   $Rema2=array_reverse($Rema2);

   // cycle through all the results again
   for($i=0;$i<count($Rema2);$i++) {
     // reverse this item, split, keep the first digit, spread the other digits down the array
     $Rema3=str_split(strrev($Rema2[$i]));
     for($o=0;$o<count($Rema3);$o++)
       if($o==0) @$Rema2[$i+$o]=$Rema3[$o];
       else @$Rema2[$i+$o]+=$Rema3[$o];
   }
   // implode $Rema2 so it's a string and reverse it, this is the result!
   $Rema2=strrev(implode($Rema2));

   // just to make sure, we delete the zeros from the beginning of the result and return
   while(strlen($Rema2)>1&&$Rema2{0}=='0') $Rema2=substr($Rema2,1);

   return($Rema2);
 }
date_default_timezone_set('America/Sao_Paulo');

include_once "inc/geoip.inc";
$gi = geoip_open("GeoIP.dat",GEOIP_STANDARD);
function secondsToTime($seconds)
{
    // extract hours
    $hours = floor($seconds / (60 * 60));

    // extract minutes
    $divisor_for_minutes = $seconds % (60 * 60);
    $minutes = floor($divisor_for_minutes / 60);

    // extract the remaining seconds
    $divisor_for_seconds = $divisor_for_minutes % 60;
    $seconds = ceil($divisor_for_seconds);

    // return the final array
    $obj = array(
        "h" => (int) $hours,
        "m" => (int) $minutes,
        "s" => (int) $seconds,
    );
	$time = $obj['h'] . " hours, " . $obj['m'] . " minutes, " . $obj['s'] . " seconds";
    return $time;
}

$query1 = "SELECT * FROM `$db_table` ORDER BY score DESC";
$resultado1 = mysqli_query($conn,$query1);
$rank = 0;
while ($row = mysqli_fetch_array($resultado1)) {
$rank++;
if($_GET['id'] == $row['id'])
	{
	$cc = geoip_country_code_by_addr($gi,$row['lastip']);
	$cn = geoip_country_name_by_addr($gi,$row['lastip']);
	?>
	
	
				<table class='table1 normaltable2' >
					<tr><th colspan=2>Player</th></tr>
					<tr>
						<td colspan=2><center>

							<?php if($cc != "") {
								echo "<IMG SRC=\"locations/" .  geoip_country_code_by_addr($gi,$row['lastip']) . ".png\" width=18 height=12>";
								} else {
								echo "<IMG SRC=\"locations/unknown.gif\" width=18 height=12>";
								}
								echo "<b>{$row['name']}</b>";?>
						</center></td>

					</tr>
					<tr>
						<td>Location:
						</td>
						<td><?php
							if($cc != "") {
								echo  geoip_country_name_by_addr($gi,$row['lastip']) . "(" . geoip_country_code_by_addr($gi,$row['lastip']) . ")"; //country of that IP address

							} else {
								echo "Unknown";
							}
							?>
						</td>
					</tr>
					<tr>
						<td>STEAM:ID:
						</td>
						<td><?php echo $row['steam'];?>
						</td>
					</tr>

					<tr>
						<td>Steam Profile:
						</td>
						<td><?php function getFriendId($steamId)
	{

		//Example SteamID: "STEAM_X:Y:ZZZZZZZZ"
		$gameType = 0; //This is X.  It's either 0 or 1 depending on which game you are playing (CSS, L4D, TF2, etc)
		$authServer = 0; //This is Y.  Some people have a 0, some people have a 1
		$clientId = ''; //This is ZZZZZZZZ.

		//Remove the "STEAM_"
		$steamId = str_replace('STEAM_', '' ,$steamId);

		//Split steamId into parts
		$parts = explode(':', $steamId);
		$gameType = $parts[0];
		$authServer = $parts[1];
		$clientId = $parts[2];

		//Calculate friendId
		$t = Add("76561197960265728", $authServer,0);
		$s = Mul($clientId, '2',0);
		$result = Add($t,$s,0);
		//$result = bcadd((bcadd('76561197960265728', $authServer)), (bcmul($clientId, '2')));
		return($result);
	}

	$authid = $row['steam'];

	echo "<a href=\"http://steamcommunity.com/profiles/" . getFriendId($authid) . "\" target=_blank>Steam Profile</a>"; ?>
						</td>
					</tr>
					<tr>
						<td>Last connection:
						</td>

						<td><?php echo date('Y-m-d H:i',$row['lastconnect']);?>

						</td>
					</tr>
					<tr>
						<td>Connected Time:
						</td>

						<td><?php echo secondsToTime($row['connected']);?>
						</td>
					</tr>


				</table>

				<table class='table2 normaltable2' >

					<tr><th colspan=4 align=left>Weapons Kills</th></tr>
					<?php $weapon_string="knife,taser,glock,usp_silencer,hkp2000,p250,deagle,elite,fiveseven,tec9,cz75a,revolver,xm1014,mag7,sawedoff,negev,m249,mac10,mp9,mp7,mp5sd,ump45,p90,galilar,famas,ak47,m4a1,m4a1_silencer,aug,ssg08,sg556,awp,scar20,hegrenade";
						$weapon_array = explode(",",$weapon_string);
						if($row['kills'] == 0){$kills = 1;} else {$kills=$row['kills'];}
						$i =0;
						foreach($weapon_array as $weapon){
							if(is_int($i/2)){
								echo "<tr>";
							}
							$temp = strval($row[$weapon]/$kills*100);

							$weapon_names=array('Knives','Zeusx27','Glock','USP','P2000','P250','DEAGLE','Dual Berettas','FiveSeven','Tec-9','Cz75a','Revolver','Xm1014','Mag7','Sawedoff','Negev','M249','Mac10','Mp9','Mp7','Mp5','Ump45','P90','Galil','Famas','Ak-47','M4A4','M4A1-S','Aug','SSG','SG','AWP','Scar20','HE Grenade');
							echo "<td>{$weapon_names[$i]}</td>"; echo "<td>{$row[$weapon]} (";
							$ts = 1;
							$temp = strval($row[$weapon]/$kills*100);
							if(strpos($temp,".") !== false || $ts == 0){
								for($i1 = 0; $i1<=strpos($temp,".")+2;$i1++){
									if( strlen($temp)-1 <$i1 ){
										$ts=0;
									}else{
										echo $temp[$i1];
										}

								}
							} else { echo $temp . ".00";} echo	"%)</td>";
							$i++;
							if(is_int($i/2)){
								echo "</tr>";
							}
						}
					?>
				</table>
			
			
				<table class='table3 normaltable'>
					<tr><th colspan=2>Statistics</th></tr>
					<tr>
						<td>Score:
						</td>

						<td align=right><?php echo $row['score'];?>
						</td>
					</tr>
					<tr>
						<td>Rank:
						</td>

						<td align=right><?php echo $rank;?>
						</td>
					</tr>
					<tr>
						<td>Kills per minute:
						</td>

						<td align=right><?php $temp = strval($row['kills']/($row['connected']/60));
										if(strpos($temp,".") !== false){
																			for($i = 0; $i<=strpos($temp,".")+2;$i++){
																				if( strlen($temp)-1 <$i ){
																					break;
																				}else{
																					echo $temp[$i];
																					}

																			}
																		} else { echo $temp . ".00";}?>
						</td>
					</tr>
					<tr>
						<td>Kills per death:
						</td>

						<td align=right><?php $deaths = 1; if($row['deaths'] != 0 ) { $deaths=$row['deaths'];}$temp = strval($row['kills']/$deaths);
																		if(strpos($temp,".") !== false){
																			for($i = 0; $i<=strpos($temp,".")+2;$i++){
																				if( strlen($temp)-1 <$i ){
																					break;
																				}else{
																					echo $temp[$i];
																					}

																			}
																		} else { echo $temp . ".00";}
																		?>
						</td>
					</tr>
					<tr>
						<td>Shots per kill:
						</td>

						<td align=right><?php $kills = 1; if($row['kills'] != 0 ) { $kills=$row['kills'];} $temp= strval($row['shots']/$kills);
																		if(strpos($temp,".") !== false){
																			for($i = 0; $i<=strpos($temp,".")+2;$i++){
																				if( strlen($temp)-1 <$i ){
																					break;
																				}else{
																					echo $temp[$i];
																					}

																			}
																		} else { echo $temp . ".00";}?>
						</td>
					</tr>
					<tr>
						<td>Headshots per kill:
						</td>

						<td align=right><?php $temp = strval($row['headshots']/$kills);if(strpos($temp,".") !== false){
																			for($i = 0; $i<=strpos($temp,".")+2;$i++){
																				if( strlen($temp)-1 <$i ){
																					break;
																				}else{
																					echo $temp[$i];
																					}

																			}
																		} else { echo $temp . ".00";}?>
						</td>
					</tr>
					<tr>
						<td>Accuracy:
						</td>

						<td align=right><?php if($row['shots'] == 0){$shots = 1;} else {$shots = $row['shots'];}$temp = strval($row['hits']/$shots);if(strpos($temp,".") !== false){
																			for($i = 0; $i<=strpos($temp,".")+2;$i++){
																				if( strlen($temp)-1 <$i ){
																					break;
																				}else{
																					echo $temp[$i];
																					}

																			}
																		} else { echo $temp . ".00";}?>
						</td>
					</tr>
					<tr>
						<td>Kills:
						</td>

						<td align=right><?php echo $row['kills'];?>
						</td>
					</tr>
					<tr>
						<td>Deaths:
						</td>

						<td align=right><?php echo $row['deaths'];?>
						</td>
					</tr>
					<tr>
						<td>Shots:
						</td>

						<td align=right><?php echo $row['shots'];?>
						</td>
					</tr>
					<tr>
						<td>Hits:
						</td>

						<td align=right><?php echo $row['hits'];?>
						</td>
					</tr>
					<tr>
						<td>Rounds Won as TR:
						</td>

						<td align=right><?php echo $row['tr_win'];?>/<?php echo $row['rounds_tr'];?>
						</td>
					</tr>
					<tr>
						<td>Rounds Won as CT:
						</td>

						<td align=right><?php echo $row['ct_win'];?>/<?php echo $row['rounds_ct'];?>
						</td>
					</tr>
					<tr>
						<td>Planted Bombs:
						</td>

						<td align=right><?php echo $row['c4_planted'];?>
						</td>
					</tr>
					<tr>
						<td>Exploded Bombs:
						</td>

						<td align=right><?php echo $row['c4_exploded'];?>
						</td>
					</tr>
					<tr>
						<td>Defused Bombs:
						</td>

						<td align=right><?php echo $row['c4_defused'];?>
						</td>
					</tr>

				</table>
				<table class='table4 normaltable'>

					<tr><th colspan=2>Hitbox</th></tr>
					<tr>
						<td>Head
						</td>

						<td><?php echo $row['head'];?> (<?php if($row['hits'] == 0){$hits = 1;} else { $hits=$row['hits'];} $temp = strval($row['head']/$hits*100);
						if(strpos($temp,".") !== false){
																			for($i = 0; $i<=strpos($temp,".")+2;$i++){
																				if( strlen($temp)-1 <$i ){
																					break;
																				}else{
																					echo $temp[$i];
																					}

																			}
																		} else { echo $temp . ".00";}?>%)
						</td>
					</tr>
					<tr>
						<td>Chest
						</td>

						<td><?php echo $row['chest'];?> (<?php if($row['hits'] == 0){$hits = 1;} else { $hits=$row['hits'];} $temp = strval($row['chest']/$hits*100);
						if(strpos($temp,".") !== false){
																			for($i = 0; $i<=strpos($temp,".")+2;$i++){
																				if( strlen($temp)-1 <$i ){
																					break;
																				}else{
																					echo $temp[$i];
																					}

																			}
																		} else { echo $temp . ".00";}?>%)
						</td>
					</tr>
					<tr>
						<td>Stomach
						</td>

						<td><?php echo $row['stomach'];?> (<?php if($row['hits'] == 0){$hits = 1;} else { $hits=$row['hits'];} $temp = strval($row['stomach']/$hits*100);
						if(strpos($temp,".") !== false){
																			for($i = 0; $i<=strpos($temp,".")+2;$i++){
																				if( strlen($temp)-1 <$i ){
																					break;
																				}else{
																					echo $temp[$i];
																					}

																			}
																		} else { echo $temp . ".00";}?>%)
						</td>
					</tr>
					<tr>
						<td>Left Arm
						</td>

						<td><?php echo $row['left_arm'];?> (<?php if($row['hits'] == 0){$hits = 1;} else { $hits=$row['hits'];} $temp = strval($row['left_arm']/$hits*100);
						if(strpos($temp,".") !== false){
																			for($i = 0; $i<=strpos($temp,".")+2;$i++){
																				if( strlen($temp)-1 <$i ){
																					break;
																				}else{
																					echo $temp[$i];
																					}

																			}
																		} else { echo $temp . ".00";}?>%)
						</td>
					</tr>
					<tr>
						<td>Right Arm
						</td>

						<td><?php echo $row['right_arm'];?> (<?php if($row['hits'] == 0){$hits = 1;} else { $hits=$row['hits'];} $temp = strval($row['right_arm']/$hits*100);
						if(strpos($temp,".") !== false){
																			for($i = 0; $i<=strpos($temp,".")+2;$i++){
																				if( strlen($temp)-1 <$i ){
																					break;
																				}else{
																					echo $temp[$i];
																					}

																			}
																		} else { echo $temp . ".00";}?>%)
						</td>
					</tr>
					<tr>
						<td>Left Leg
						</td>

						<td><?php echo $row['left_leg'];?> (<?php if($row['hits'] == 0){$hits = 1;} else { $hits=$row['hits'];} $temp = strval($row['left_leg']/$hits*100);
						if(strpos($temp,".") !== false){
																			for($i = 0; $i<=strpos($temp,".")+2;$i++){
																				if( strlen($temp)-1 <$i ){
																					break;
																				}else{
																					echo $temp[$i];
																					}

																			}
																		} else { echo $temp . ".00";}?>%)
						</td>
					</tr>
					<tr>
						<td>Right Leg
						</td>

						<td><?php echo $row['right_leg'];?> (<?php if($row['hits'] == 0){$hits = 1;} else { $hits=$row['hits'];} $temp = strval($row['right_leg']/$hits*100);
						if(strpos($temp,".") !== false){
																			for($i = 0; $i<=strpos($temp,".")+2;$i++){
																				if( strlen($temp)-1 <$i ){
																					break;
																				}else{
																					echo $temp[$i];
																					}

																			}
																		} else { echo $temp . ".00";}?>%)
						</td>
					</tr>

				</table>
					<?php
	//print_r($row);
	}
}
?>
