<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsModifier
 */

/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty date modifier time ago
 * Purpose:  converts unix timestamps or datetime strings to words
 * Type:     modifier<br>
 * Name:     timeAgo<br>
 * @author   Prashant Baldha
 * @param string
 * @return string
 */ 
 
function smarty_modifier_time_ago($string, $default_date='', $formatter='auto')
{
	$string = trim($string);
	$time = date("H:i:s",strtotime($string));
		
	if($string=="0000-00-00 00:00")
	{
		return "None";			
	}
	if($time == "00:00:00")
	{
		$string = date("Y-m-d",strtotime($string));
		$format='%d %b, %Y';
	}

	//For TimeZone seting
	/*
	$date = new DateTime($string, new DateTimeZone(INITIAL_TIME_ZONE));
	$date->setTimezone(new DateTimeZone($config["time_zone"]));
	$string = $date->format('Y-m-d H:i:s');
	*/
    
    $date = $string;
	// for using it with preceding 'vor'            index
    $timeStrings = array(
						  'recently',            // 0       <- now or future posts :-)
                        'second', 'seconds',    // 1,1
                        'minute','minutes',      // 3,3
                        'hour', 'hours',   // 5,5
                        'day', 'days',         // 7,7
                        'week', 'weeks',      // 9,9
                        'month', 'months',      // 11,12
                        'year','years');      // 13,14
      $debug = false;
      $sec = time() - (( strtotime($date)) ? strtotime($date) : $date);
      
      if ( $sec <= 0) return $timeStrings[0]." ago";
      
      if ( $sec < 2) return $sec." ".$timeStrings[1]." ago";
      if ( $sec < 60) return $sec." ".$timeStrings[2]." ago";
      
      $min = $sec / 60;
      if ( floor($min+0.5) < 2) return floor($min+0.5)." ".$timeStrings[3]." ago";
      if ( $min < 60) return floor($min+0.5)." ".$timeStrings[4]." ago";
      
      $hrs = $min / 60;
      echo ($debug == true) ? "hours: ".floor($hrs+0.5)."<br />" : '';
      if ( floor($hrs+0.5) < 2) return floor($hrs+0.5)." ".$timeStrings[5]." ago";
      if ( $hrs < 24) return floor($hrs+0.5)." ".$timeStrings[6]." ago";
      
      $days = $hrs / 24;
      echo ($debug == true) ? "days: ".floor($days+0.5)."<br />" : '';
      if ( floor($days+0.5) < 2) return floor($days+0.5)." ".$timeStrings[7]." ago";
      if ( $days < 7) return floor($days+0.5)." ".$timeStrings[8]." ago";
      
      $weeks = $days / 7;
      echo ($debug == true) ? "weeks: ".floor($weeks+0.5)."<br />" : '';
      if ( floor($weeks+0.5) < 2) return floor($weeks+0.5)." ".$timeStrings[9]." ago";
      if ( $weeks < 4) return floor($weeks+0.5)." ".$timeStrings[10]." ago";
      
      $months = $weeks / 4;
      if ( floor($months+0.5) < 2) return floor($months+0.5)." ".$timeStrings[11]." ago";
      if ( $months < 12) return floor($months+0.5)." ".$timeStrings[12]." ago";
      
      $years = $weeks / 51;
      if ( floor($years+0.5) < 2) return floor($years+0.5)." ".$timeStrings[13]." ago";
      return floor($years+0.5)." ".$timeStrings[14]." ago"; 
}
