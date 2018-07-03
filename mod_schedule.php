<?php
/**
 * Scouting Schedule
 *
 * @package    SIJ.schedule
 * @subpackage Modules
 * @license    GNU/GPL, see LICENSE.md
 */

// Set date
setlocale(LC_ALL, 'nl-NL', 'nl_NL.utf8', 'NL_nl', 'nl_NL', 'nl');
date_default_timezone_set('Amsterdam');

// maanden
$months[1] = "januari";
$months[2] = "februari";
$months[3] = "maart";
$months[4] = "april";
$months[5] = "mei";
$months[6] = "juni";
$months[7] = "juli";
$months[8] = "augustus";
$months[9] = "september";
$months[10] = "oktober";
$months[11] = "november";
$months[12] = "december";

// dagen
$weekdays[0] = "maandag";
$weekdays[1] = "dinsdag";
$weekdays[2] = "woensdag";
$weekdays[3] = "donderdag";
$weekdays[4] = "vrijdag";
$weekdays[5] = "zaterdag";
$weekdays[6] = "zondag";

function appendThings(/* map[string,mixed] */ $array, /* string */ $key, /* string */ $value) {
   if (!isset($array[$key]))
       $array[$key] = array($value);
   else if (is_array($array[$key]))
       $array[$key][] = $value;
   else
       $array[$key] = array($array[$key], $value);

   return $array;
}

// No direct access
defined('_JEXEC') or die;

// Open Schedule
$file_contents = file_get_contents(JUri::base().'modules/mod_schedule/images/programma.json');
$schedule = json_decode($file_contents);

// Group schedule per day
$grouped_events = [];
foreach ($schedule as $value) {
  $timestamp = $value->startDate/1000;
  $key = "<span>".$weekdays[date('w', $timestamp)]."</span><br>".date('j', $timestamp)." ".$months[date('n', $timestamp)];
  $grouped_events = appendThings($grouped_events, $key, $value);
}

// Filter for subcamp filtering
$filter = $params->get('filter');

// Add CSS
$document = JFactory::getDocument();
$document->addStyleSheet(JUri::base().'modules/mod_schedule/tmpl/style.css');

require JModuleHelper::getLayoutPath('mod_schedule');
