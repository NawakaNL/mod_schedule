<?php
/**
 * Scouting Schedule
 *
 * @package    SIJ.schedule
 * @subpackage Modules
 * @license    GNU/GPL, see LICENSE.md
 */

// Set date
setlocale(LC_ALL, 'nl-NL', 'nl_NL.utf8', 'nl_NL', 'nl');
date_default_timezone_set('Amsterdam');

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
  $key = strftime('<span>%A</span><br> %e %B', $value->startDate/1000);
  $grouped_events = appendThings($grouped_events, $key, $value);
}

// Filter for subcamp filtering
$filter = $params->get('filter');

// Add CSS
$document = JFactory::getDocument();
$document->addStyleSheet(JUri::base().'modules/mod_schedule/tmpl/style.css');

require JModuleHelper::getLayoutPath('mod_schedule');
