<?php
include 'inc/db.php';

$result = mysqli_query($conn, "SELECT id,name,score,kills,deaths,connected,headshots,knife FROM rankme");

$rows = array();
    while($row = mysqli_fetch_array($result))
    {
        $rows[] = $row;
    }
    echo json_encode($rows);