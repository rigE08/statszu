<?php
require 'inc/db.php';
require 'inc/function.php';


    global $db_table;

    //QUERRY TOTAL PLAYERS
    $query_players = "SELECT COUNT(id) AS total_players FROM $db_table";
    $result = mysqli_query($conn, $query_players);
    $row = mysqli_fetch_assoc($result); 
    $totalplayers = number_format($row['total_players']);

    //QUERRY TOTAL KILLS
    $query_kills = "SELECT SUM(kills) AS total_kills FROM $db_table";
    $result1 = mysqli_query($conn, $query_kills);
    $row = mysqli_fetch_assoc($result1); 
    $totalkills = number_format($row['total_kills']);

    //QUERRY TOTAL HEADSHOTS
    $query_hs = "SELECT SUM(headshots) AS total_hs FROM $db_table";
    $result2 = mysqli_query($conn, $query_hs);
    $row = mysqli_fetch_assoc($result2); 
    $totalhs = number_format($row['total_hs']);

    //QUERRY TOTAL KNIVES
    $query_knife = "SELECT SUM(knife) AS total_knife FROM $db_table";
    $result3 = mysqli_query($conn, $query_knife);
    $row = mysqli_fetch_assoc($result3); 
    $totalknife = number_format($row['total_knife']);


       echo" <section class='mb-4'>
        <div class='card-body'>
                <div class='row'>

                    <div class='col-md-3 pb-3'>
                        <div class='card'>
                            <div class='card-body gri pb-5'>
                                <h5 class='card-title pt-3'>Total Players</h5>
                                <p class='card-text total fa-2x'><i class='fas fa-users'></i>
                                    $totalplayers
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class='col-md-3 pb-3'>
                        <div class='card'>
                            <div class='card-body gri pb-5'>
                                <h5 class='card-title pt-3'>Total Kills</h5>
                                <p class='card-text total fa-2x'><i class='fas fa-skull-crossbones'></i>
                                    $totalkills
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class='col-md-3 pb-3'>
                        <div class='card'>
                            <div class='card-body gri pb-5'>
                                <h5 class='card-title pt-3'>Total Headshots</h5>
                                <p class='card-text total fa-2x'><img src='img/playerpanel/headshot.svg' height='35px' />
                                    $totalhs
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class='col-md-3 pb-3'>
                        <div class='card'>
                            <div class='card-body gri pb-5'>
                                <h5 class='card-title pt-3'>Total Knives</h5>
                                <p class='card-text total fa-2x'><img src='img/playerpanel/knife90.svg' height='45px' />
                                    $totalknife
                                </p>
                            </div>
                        </div>
                    </div>


                </div>
        </div>
        </section>";

        echo"<section>
              <div class='col-md-12'>
                <div class='card'>
                  <div class='card-body table-responsive gri'>
                    <h3>Top 10</h3>
                    <table id='top10' class='table table-hover table-sm ' data-info='false'>
                      <thead>
                        <tr>
                            <th scope='col'>#</th>
                            <th scope='col'>PLAYER</th>
                            <th scope='col'>POINTS</th>
                            <th scope='col'>RANK</th>
                            <th scope='col'>KILLS</th>
                            <th scope='col'>DEATHS</th>
                            <th scope='col'>TIME</th>
                            <th scope='col'>HS</th>
                            <th scope='col'>KNIVES</th>
                        </tr>
                      </thead>
                      <tbody>";

    //QUERRY ALL
    $query_all = "SELECT * FROM $db_table ORDER BY score DESC LIMIT 10";
    $result4 = mysqli_query($conn, $query_all);

        $rank = 0;

        while($row = mysqli_fetch_array($result4)){
            $rank++;
            $id = $row['id'];
            $name = $row['name'];
            $score = $row['score'];
            $kills = $row['kills'];
            $deaths = $row['deaths'];
            $connected = format_time($row['connected']);
            $hs = $row['headshots'];
            $knife = $row['knife'];
            $puncte = $row['score'];

            require 'inc/ranks.php'; // GRADES IMG FUNCTION
            
                      echo"
                        <tr>
                            <th>$rank</th>
                            <th><a href='player.php?id=". $id ."'>$name</a></th>
                            <th>$score</th>
                            <th>$rankimg</th>
                            <th>$kills</th>
                            <th>$deaths</th>
                            <th>$connected</th>
                            <th>$hs</th>
                            <th>$knife</th>
                         </tr>
                      ";
        }
                   echo" </tbody></table>
                  </div>
                </div>
              </div>
              
            </section>";
        

?>