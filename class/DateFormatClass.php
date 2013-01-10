<?php
 class DateFormat
 {
	public static function change($date, $format="d-m-Y")
    {
		$date = new DateTime($date);
		return $date->format($format);
    }	
 }
?>