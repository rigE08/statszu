<?php
require 'inc/db.php';
require 'inc/function.php';
require 'inc/scripts.php';


    global $db_table;

    
        echo"<section>

        <div class='col-md-12 pb-3'>
         <div class='card'>
            <div class='card-body gri'>
                <h5 class='card-title mb-1'>Search...</h5> 
                    <input type='text' id='search' placeholder='name, steamid, points etc.' class='form-control'> 
                     <button id='search-button' class='btn btn-block btn-verde my-3'>Search</button>

             </div>
            </div>
        </div>

              <div class='col-md-12'>
                <div class='card'>
                  <div class='card-body gri'>
                    <h3>Top 10</h3>
                    <div class='table-wrap'>
                    <table id='top10' class='table table-hover table-sm' data-info='false'>
                      <thead>
                        <tr>
                            <th scope='col'>#</th>
                            <th scope='col'>PLAYER</th>
                            <th class='d-none' scope='col'>STEAMID</th>
                            <th scope='col'>POINTS</th>
                            <th scope='col'>RANK</th>
                            <th scope='col'>KILLS</th>
                            <th scope='col'>DEATHS</th>
                            <th scope='col'>TIME</th>
                            <th scope='col'>HS</th>
                            <th scope='col'>K/D</th>
                        </tr>
                      </thead>
                      <tbody>";

    //QUERRY ALL
    $query_all = "SELECT * FROM $db_table ORDER BY score DESC";
    $result4 = mysqli_query($conn, $query_all);

        $rank = 0;

        while($row = mysqli_fetch_array($result4)){
            $rank++;
            $id = $row['id'];
            $name = $row['name'];
            $steamid = $row['steam'];
            $score = $row['score'];
            $kills = $row['kills'];
            $deaths = $row['deaths'];
            $connected = format_time($row['connected']);
            $hs = $row['headshots'];
            $knife = $row['knife'];
            $puncte = $row['score'];

            //KD CHECK
            if($deaths > 0){
                $kd = number_format(($kills/$deaths), 2);
            }else{
                $kd = "0";
            }
            //KD CHECK

            require 'inc/ranks.php'; // GRADES IMG FUNCTION
            
                      echo"
                        <tr>
                            <th>$rank</th>
                            <th><a href='showplayer.php?id=". $id ."'>$name</a></th>
                            <th class='d-none'>$steamid</th>
                            <th>$score</th>
                            <th>$rankimg</th>
                            <th>$kills</th>
                            <th>$deaths</th>
                            <th>$connected</th>
                            <th>$hs</th>
                            <th>$kd</th>
                            </tr>";
        }
                   echo" </tbody></table>
                   </div>
                  </div>
                </div>
              </div>
              
            </section>";
        
?>
<script>
 $("#search-button").click(function(){
                $.each($("#top10 tbody tr"), function() {

                    if($(this).text().toLowerCase().indexOf($('#search').val().toLowerCase()) === -1)
                        $(this).hide();
                    else
                        $(this).show();                
                });
            }); 
</script>