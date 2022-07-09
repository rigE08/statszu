<?php
require 'inc/db.php';
require 'function.php';
error_reporting (E_ALL ^ E_NOTICE);
date_default_timezone_set('America/Sao_Paulo');

include_once "inc/geoip.inc";
$gi = geoip_open("GeoIP.dat",GEOIP_STANDARD);

    global $db_table;

    $query_all = "SELECT * FROM $db_table ORDER BY score DESC";
    $result = mysqli_query($conn, $query_all);
    $rank = 0;
        while($row = mysqli_fetch_array($result))
        {
            require 'inc/date.php';
            require 'inc/ranks.php';
            $rank++;

            if($_GET['id'] == $row['id'])
            {
                $cc = geoip_country_code_by_addr($gi,$row['lastip']);
                $cn = geoip_country_name_by_addr($gi,$row['lastip']);
?>
        <section class='mb-4'>
                        <div class='row'>
                            <div class='col-xl-4 col-sm-6 col-12 mb-4'>
                                <div class='card gri'>
                                    <div class='card-header py-3'>
                                    <?php 
                                        echo"<h5 class='mb-0 text-center verde'>$rankimg <a data-title='Click for steam profile' href='http://steamcommunity.com/profiles/$steamprofile' target=_blank ><strong>$name </strong></a>";
                                            if($cc != "") {
                                                echo "<img src='img/locations/" .  geoip_country_code_by_addr($gi,$row['lastip']) . ".png' width=28 height=15>";
                                            }else{
                                                echo "<img src='img/locations/unknown.gif' width=28 height=15>";
                                            }
                                            ?>
                                        </h5>
                                    </div>
                                    <?php
                                        echo"<div class='card-body gri'>
                                        <div class='d-flex justify-content-between px-md-1'>
                                            <div class='align-self-center'>
                                                <div class='container mx-4 mb-1'>
                                                    <div class='row'>

                                                        <div class='col-6 col-sm-6'>SteamID</div>
                                                        <div class='col-6 col-sm-6'>
                                                            <span class='badge bg-verde '>$authid</span>
                                                        </div>

                                                        <div class='col-6 col-sm-6'>Points</div>
                                                        <div class='col-6 col-sm-6'>
                                                            <span class='badge bg-verde '>$score</span>
                                                        </div>

                                                        <div class='col-6 col-sm-6'>Kills</div>
                                                        <div class='col-6 col-sm-6'>
                                                            <span class='badge bg-verde '>$kills</span>
                                                        </div>

                                                        <div class='col-6 col-sm-6'>Deaths</div>
                                                        <div class='col-6 col-sm-6'>
                                                            <span class='badge bg-verde '>$deaths</span>
                                                        </div>

                                                        <div class='col-6 col-sm-6'>Headshot</div>
                                                        <div class='col-6 col-sm-6'>
                                                            <span class='badge bg-verde '>$procenths %</span>
                                                        </div>

                                                        <div class='col-6 col-sm-6'>K/D</div>
                                                        <div class='col-6 col-sm-6'>
                                                            <span class='badge bg-verde '>$kd</span>
                                                        </div>

                                                        <div class='col-6 col-sm-6'>Total Time</div>
                                                        <div class='col-6 col-sm-6'>
                                                            <span class='badge bg-verde '>$connected</span>
                                                        </div>

                                                        <div class='col-6 col-sm-6'>Last connection</div>
                                                        <div class='col-6 col-sm-6'>
                                                            <span class='badge bg-verde '>$lastconnected</span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class='col-xl-4 col-sm-6 col-12 mb-2'>
                                <div class='card'>
                                    <div class='card-body gri mb-3'>
                                        <div class='d-flex justify-content-between px-md-1'>
                                            <div class='align-self-center'>
                                                <img src='img/playerpanel/noscope.svg' height='35px'>
                                            </div>
                                            <div class='text-end'>
                                                <h5>$noscope</h5>
                                                <h5 class='mb-0'>No Scope</h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='card-body gri mb-3'>
                                        <div class='d-flex justify-content-between px-md-1'>
                                            <div class='align-self-center'>
                                                <img src='img/playerpanel/terro.png' height='35px'>
                                            </div>
                                            <div class='text-end'>
                                                <h5>$c4_exp</h5>
                                                <h5 class='mb-0'>Exploded Bomb</h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='card-body gri mb-3'>
                                        <div class='d-flex justify-content-between px-md-1'>
                                            <div class='align-self-center'>
                                                <img src='img/playerpanel/ct.png' height='35px'>
                                            </div>
                                            <div class='text-end'>
                                                <h5>$c4_def</h5>
                                                <h5 class='mb-0'>Defused Bomb</h5>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class='col-xl-4 col-sm-6 col-12 mb-2'>
                                <div class='card'>
                                    <div class='card-body gri mb-3'>
                                        <div class='d-flex justify-content-between px-md-1'>
                                            <div class='align-self-center'>
                                                <img src='img/playerpanel/mvp.png' height='35px'>
                                            </div>
                                            <div class='text-end'>
                                                <h5>$mvp</h5>
                                                <h5 class='mb-0'>MVP</h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='card-body gri mb-3'>
                                        <div class='d-flex justify-content-between px-md-1'>
                                            <div class='align-self-center'>
                                                <img src='img/playerpanel/wallbang.png' height='35px'>
                                            </div>
                                            <div class='text-end'>
                                                <h5>$wallbang</h5>
                                                <h5 class='mb-0'>Wallbang</h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='card-body gri mb-3'>
                                        <div class='d-flex justify-content-between px-md-1'>
                                            <div class='align-self-center'>
                                                <img src='img/playerpanel/firstblood.png' height='35px'>
                                            </div>
                                            <div class='text-end'>
                                                <h5>$first_blood</h5>
                                                <h5 class='mb-0'>First Blood</h5>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class='col-xl-6 col-sm-6 col-12 mb-2'>
                                <div class='card gri'>
                                    <div class='card-header py-3'>
                                        <h5 class='mb-0 text-center'>Weapons</h5>
                                    </div>
                                    
                                    <div class='card-header py-1 d-flex justify-content-between border-bottom border-dark'>
                                    <div class='align-self-center'>
                                    <h6 class='my-0'>Weapon</h6>
                                    </div>
                                    <div class='text-end'>
                                        <h6 class='my-0'>Kills</h6>
                                    </div>
                                </div>
                                    <div class='card-body gri weapons-wrap py-1'>

                                    
                                        <a data-title='KNIFE'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark '>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_knife.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$knife</h6>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='ZEUS-X27'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_taser.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$zeus</h6>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='GLOCK'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_glock.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$glock</h6>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='USP'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_usp_silencer.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$usp</h6>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='P2000'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_p250.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$p2000</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='P250'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_hkp2000.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$p250</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='DEAGLE'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_deagle.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$deagle</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='DUAL BERETTAS'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_elite.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$dualberettas</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='FIVESEVEN'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_fiveseven.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$fiveseven</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='TEC-9'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_tec9.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$tec9</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='CZ75A'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_cz75a.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$cz</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='REVOLVER'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_revolver.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$revolver</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='XM1014'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_xm1014.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$xm1014</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='MAG7'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_mag7.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$mag7</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='SAWEDOFF'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_sawedoff.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$sawedoff</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='NEGEV'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_negev.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$negev</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='M249'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_m249.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$m249</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='MAC-10'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_mac10.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$mac10</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='MP9'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_mp9.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$mp9</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='MP7'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_mp7.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$mp7</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='MP5'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_mp5sd.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$mp5</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='UMP45'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_ump45.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$ump</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='P90'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_p90.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$p90</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='PP-BIZON'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_bizon.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$bizon</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='GALIL'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_galilar.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$galil</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='FAMAS'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_famas.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$famas</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='AK-47'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_ak47.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$ak47</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='M4A4'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_m4a1.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$m4a4</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='M4A1-S'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_m4a1_silencer.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$m4a1</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='AUG'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_aug.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$aug</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='SCOUT'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_scout2.svg' height='35px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$scout</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='SG'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_sg556.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$sg</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='AWP'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_awp.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$awp</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='SCAR-20'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_scar20.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$scar20</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='G3SG1'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_g3sg1.svg' height='20px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$g3sg1</h5>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='MOLOTOV'>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_inferno.svg' height='35px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$molotov</h6>
                                                </div>
                                            </div>
                                        </a>
                                        <a data-title='GRENADE'>
                                            <div class='d-flex justify-content-between px-md-1'>
                                                <div class='align-self-center'>
                                                    <img src='img/weapons/weapon_hegrenade.svg' height='35px'>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-2'>$granade</h5>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    

                                    <div class='card-footer py-3'>
                                    </div>

                                </div>
                            </div>
                            <!-----------WEAPONS------------>

                            <div class='col-xl-6 col-sm-6 col-12 mb-2'>
                                <div class='card gri'>
                                    <div class='card-header py-3'>
                                        <h5 class='mb-0 text-center'>Statistics</h5>
                                    </div>
                                    <div class='card-body gri statistics-wrap py-0'>

                                        <div class='d-flex justify-content-between border-bottom border-dark'>
                                            <div   div class='text-left'>
                                                <h6 class='my-1'>Top Position</h6>
                                            </div>
                                            <div class='text-left'>
                                                <h6 class='my-1'>$rank</h6>
                                            </div>
                                        </div>
                                    
                                            <div class='d-flex justify-content-between  border-bottom border-dark'>
                                                <div   div class='text-left'>
                                                    <h6 class='my-2'>Longest Noscope</h6>
                                                </div>
                                                <div class='text-left'>
                                                    <h6 class='my-2'>$long_noscope m</h6>
                                                </div>
                                            </div>

                                            <div class='d-flex justify-content-between border-bottom border-dark'>
                                                <div   div class='text-left'>
                                                    <h6 class='my-2'>Kill per minute</h6>
                                                </div>
                                                <div class='text-left'>
                                                    <h6 class='my-2'>$kpm</h6>
                                                </div>
                                            </div>

                                            <div class='d-flex justify-content-between border-bottom border-dark'>
                                                <div   div class='text-left'>
                                                    <h6 class='my-2'>Kill per death</h6>
                                                </div>
                                                <div class='text-left'>
                                                    <h6 class='my-2'>$kpd</h6>
                                                </div>
                                            </div>

                                            <div class='d-flex justify-content-between border-bottom border-dark'>
                                                <div   div class='text-left'>
                                                    <h6 class='my-2'>Shots per kill</h6>
                                                </div>
                                                <div class='text-left'>
                                                    <h6 class='my-2'>$spk</h6>
                                                </div>
                                            </div>

                                            <div class='d-flex justify-content-between border-bottom border-dark'>
                                                <div   div class='text-left'>
                                                    <h6 class='my-2'>Headshots per kill</h6>
                                                </div>
                                                <div class='text-left'>
                                                    <h6 class='my-2'>$hspk</h6>
                                                </div>
                                            </div>

                                            <div class='d-flex justify-content-between border-bottom border-dark'>
                                                <div   div class='text-left'>
                                                    <h6 class='my-2'>Accuracy</h6>
                                                </div>
                                                <div class='text-left'>
                                                    <h6 class='my-2'>$acc</h6>
                                                </div>
                                            </div>

                                            <div class='d-flex justify-content-between border-bottom border-dark'>
                                                <div   div class='text-left'>
                                                    <h6 class='my-2'>Suicides</h6>
                                                </div>
                                                <div class='text-left'>
                                                    <h6 class='my-2'>$suicides</h6>
                                                </div>
                                            </div>

                                            <div class='d-flex justify-content-between border-bottom border-dark'>
                                                <div   div class='text-left'>
                                                    <h6 class='my-2'>Assists</h6>
                                                </div>
                                                <div class='text-left'>
                                                    <h6 class='my-2'>$assists</h6>
                                                </div>
                                            </div>

                                            <div class='d-flex justify-content-between border-bottom border-dark'>
                                                <div   div class='text-left'>
                                                    <h6 class='my-2'>Shots</h6>
                                                </div>
                                                <div class='text-left'>
                                                    <h6 class='my-2'>$shots</h6>
                                                </div>
                                            </div>

                                            <div class='d-flex justify-content-between border-bottom border-dark'>
                                                <div   div class='text-left'>
                                                    <h6 class='my-2'>Hits</h6>
                                                </div>
                                                <div class='text-left'>
                                                    <h6 class='my-2'>$hits</h6>
                                                </div>
                                            </div>

                                            <div class='d-flex justify-content-between border-bottom border-dark'>
                                                <div class='text-left'>
                                                    <h6 class='my-2'>CT Winned Rounds</h6>
                                                </div>
                                                <div class='text-left'>
                                                    <h6 class='my-2'>$ct_win</h6>
                                                </div>
                                            </div>

                                            <div class='d-flex justify-content-between border-bottom border-dark'>
                                                <div   div class='text-left'>
                                                    <h6 class='my-2'>CT Played Roundds</h6>
                                                </div>
                                                <div class='text-left'>
                                                    <h6 class='my-2'>$ct_play</h6>
                                                </div>
                                            </div>

                                            <div class='d-flex justify-content-between border-bottom border-dark'>
                                                <div class='text-left'>
                                                    <h6 class='my-2'>Terro Winned Rounds</h6>
                                                </div>
                                                <div class='text-left'>
                                                    <h6 class='my-2'>$t_win</h6>
                                                </div>
                                            </div>

                                            <div class='d-flex justify-content-between border-bottom border-dark'>
                                                <div   div class='text-left'>
                                                    <h6 class='my-2'>Terro Played Rounds</h6>
                                                </div>
                                                <div class='text-left'>
                                                    <h6 class='my-2'>$t_play</h6>
                                                </div>
                                            </div>

                                            <div class='d-flex justify-content-between border-bottom border-dark'>
                                                <div class='text-left'>
                                                    <h6 class='my-2'>Winned Matches</h6>
                                                </div>
                                                <div class='text-left'>
                                                    <h6 class='my-2'>$win_match</h6>
                                                </div>
                                            </div>

                                            <div class='d-flex justify-content-between border-bottom border-dark'>
                                                <div class='text-left'>
                                                    <h6 class='my-2'>Tied Matches</h6>
                                                </div>
                                                <div class='text-left'>
                                                    <h6 class='my-2'>$draw_match</h6>
                                                </div>
                                            </div>

                                            <div class='d-flex justify-content-between border-bottom border-dark'>
                                                <div   div class='text-left'>
                                                    <h6 class='my-2'>Losed Matches</h6>
                                                </div>
                                                <div class='text-left'>
                                                    <h6 class='my-2'>$lose_match</h6>
                                                </div>
                                            </div>

                                            <div class='d-flex justify-content-between px-md-1'>
                                                <div   div class='text-left'>
                                                    <h6 class='my-2'>C4 Planted</h6>
                                                </div>
                                                <div class='text-left'>
                                                    <h6 class='my-2'>$c4_plant</h6>
                                                </div>
                                            </div>

                                    </div>

                                    

                                    <div class='card-footer py-3'>
                                    </div>

                                </div>
                            </div><!--WEAPONS-->



                            <div class='col-xl-12 col-sm-6 col-12 mb-2'>
                                <div class='card gri'>
                                    <div class='card-header py-3'>
                                        <h5 class='mb-0 text-center'>Body Hits</h5>
                                    </div>
                                    <div class='card-body gri'>

                                        
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='text-left'>
                                                    <h6 class='my-1'>Head</h6>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-1'><strong>$head</strong> ($head_hit %)</h6>
                                                </div>
                                            </div>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='text-left'>
                                                    <h6 class='my-1'>Chest</h6>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-1'><strong>$chest</strong> ($chest_hit %)</h5>
                                                </div>
                                            </div>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='text-left'>
                                                    <h6 class='my-1'>Stomach</h6>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-1'><strong>$stomach</strong> ($stomach_hit %)</h5>
                                                </div>
                                            </div>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='text-left'>
                                                    <h6 class='my-1'>Left Arm</h6>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-1'><strong>$left_arm</strong> ($left_arm_hit %)</h5>
                                                </div>
                                            </div>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='text-left'>
                                                    <h6 class='my-1'>Right Arm</h5>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-1'><strong>$right_arm</strong> ($right_arm_hit %)</h5>
                                                </div>
                                            </div>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='text-left'>
                                                    <h6 class='my-1'>Left Leg</h6>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-1'><strong>$left_leg</strong> ($left_leg_hit %)</h5>
                                                </div>
                                            </div>
                                            <div class='d-flex justify-content-between px-md-1 border-bottom border-dark'>
                                                <div class='text-left'>
                                                    <h6 class='my-1'>Right Leg</h6>
                                                </div>
                                                <div class='text-end'>
                                                    <h6 class='my-1'><strong>$right_leg</strong> ($right_leg_hit %)</h5>
                                                </div>
                                            </div>

                                        
                                    </div>


                                </div>
                            </div>


                        </div>
                    </section>";
                    ?>
<?php
                }
        }


?>