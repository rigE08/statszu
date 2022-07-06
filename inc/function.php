<?php
function format_time($t, $f = ' hrs') // t = seconds, f = separator 
	{
	return sprintf("%02d%s", floor($t / 3600), $f, ($t / 60) % 60, $f, $t % 60);
	}

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
		$time = $obj['h'] . " hrs, " . $obj['m'] . " min, ";
		return $time;
	}