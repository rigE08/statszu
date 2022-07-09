<?php


$id = $row['id'];
            $name = $row['name'];
            $score = $row['score'];
            $kills = $row['kills'];
            $deaths = $row['deaths'];
            $headshots = $row['headshots'];
            $puncte = $row['score'];
            $authid = $row['steam'];
            $hs = $row['headshots'];
            $lastconnect = $row['lastconnect'];
            $noscope = $row['no_scope'];
            $c4_exp = $row['c4_exploded'];
            $c4_def = $row['c4_defused'];
            $mvp = $row['mvp'];
            $wallbang = $row['wallbang'];
            $first_blood = $row['first_blood'];

            //WEAPONS
            $knife = $row['knife'];
            $zeus = $row['taser'];
            $glock = $row['glock'];
            $usp = $row['usp_silencer'];
            $p2000 = $row['hkp2000'];
            $p250 = $row['p250'];
            $deagle = $row['deagle'];
            $dualberettas = $row['elite'];
            $fiveseven = $row['fiveseven'];
            $tec9 = $row['tec9'];
            $cz = $row['cz75a'];
            $revolver = $row['revolver'];
            $xm1014 = $row['xm1014'];
            $mag7 = $row['mag7'];
            $sawedoff = $row['sawedoff'];
            $negev =$row['negev'];
            $m249 = $row['m249'];
            $mac10 = $row['mac10'];
            $mp9 = $row['mp9'];
            $mp7 = $row['mp7'];
            $mp5 = $row['mp5sd'];
            $ump = $row['ump45'];
            $p90 = $row['p90'];
            $bizon = $row['bizon'];
            $galil = $row['galilar'];
            $famas = $row['famas'];
            $ak47 = $row['ak47'];
            $m4a4 = $row['m4a1'];
            $m4a1 = $row['m4a1_silencer'];
            $aug = $row['aug'];
            $scout = $row['ssg08'];
            $sg = $row['sg556'];
            $awp = $row['awp'];
            $scar20 = $row['scar20'];
            $g3sg1 = $row['g3sg1'];
            $molotov = $row['inferno'];
            $granade = $row['hegrenade'];

            //STATISTICS
            $longest_noscope = $row['no_scope_dis'];
            $suicides = $row['suicides'];
            $assists = $row['assists'];
            $shots = $row['shots'];
            $hits = $row['hits'];
            $ct_win = $row['ct_win'];
            $ct_play = $row['rounds_ct'];
            $t_win = $row['tr_win'];
            $t_play = $row['rounds_tr'];
            $win_match = $row['match_win'];
            $draw_match = $row['match_draw'];
            $lose_match = $row['match_lose'];
            $c4_plant = $row['c4_planted'];

            //BODY HITS
            $head = $row['head'];
            $chest = $row['chest'];
            $stomach = $row['stomach'];
            $left_arm = $row['left_arm'];
            $right_arm = $row['right_arm'];
            $left_leg = $row['left_leg'];
            $right_leg = $row['right_leg'];

            if($hits > 0){
                $head_hit = number_format(($head/$hits * 100), 2);
            }else{
                $head_hit = "0";
            }

            if($hits > 0){
                $chest_hit = number_format(($chest/$hits * 100), 2);
            }else{
                $chest_hit = "0";
            }

            if($hits > 0){
                $stomach_hit = number_format(($stomach/$hits * 100), 2);
            }else{
                $stomach_hit = "0";
            }

            if($hits > 0){
                $left_arm_hit = number_format(($left_arm/$hits * 100), 2);
            }else{
                $left_arm_hit = "0";
            }

            if($hits > 0){
                $right_arm_hit = number_format(($right_arm/$hits * 100), 2);
            }else{
                $right_arm_hit = "0";
            }
            if($hits > 0){
                $left_leg_hit = number_format(($left_leg/$hits * 100), 2);
            }else{
                $left_leg_hit = "0";
            }
            if($hits > 0){
                $right_leg_hit = number_format(($right_leg/$hits * 100), 2);
            }else{
                $right_leg_hit = "0";
            }
            //BODY HITS

            $connected = format_time($row['connected']);
            $lastconnected = date('d-m-Y H:ia',$row['lastconnect']);
            $steamprofile = getFriendId($authid);


            if($longest_noscope > 0){
                $long_noscope = number_format(($longest_noscope/100),2);
            }else{
                $long_noscope = "0";
            }

            if($connected > 0){
                $kpm = number_format($kills/($connected/60));
                $kpm = str_replace(",",".",$kpm);
            }else{
                $kpm = "0";
            }

            if($deaths > 0){
                $kpd = number_format($kills/($deaths),2);
            }else{
                $kpd = "0";
            }

            if($kills > 0){
                $hspk = number_format($headshots/($kills),2);
            }else{
                $hspk = "0";
            }

            if($shots > 0){
                $acc = number_format($hits/($shots),2);
            }else{
                $acc = "0";
            }

            if($kills > 0){
                $spk = number_format($shots/($kills),2);
            }else{
                $spk = "0";
            }

            if($headshots > 0){
                $procenths = number_format(($headshots/$kills * 100), 2);
            }else{
                $procenths = "0";
            }

            if($deaths > 0){
                $kd = number_format(($kills/$deaths), 2);
            }else{
                $kd = "0.0";
            }
?>