<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 *
 * @package   	report
 * @subpackage 	questionnairestats
 * @copyright 	2018 Paulo Jr.
 * @license   	http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(dirname(__FILE__).'/../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require(__DIR__. '/util.php');

$category = optional_param('category', ALL_CATEGORIES, PARAM_INT);

if ($category != ALL_CATEGORIES) {
	$result = $DB->get_records('course', array('category'=>$category), "fullname");
} else {
	$result = $DB->get_records('course', null, "fullname");
}

$cs = reset($result);
if ($cs != null) {
	
	// Deal with column the name update of the questionnarie module
	$dbman = $DB->get_manager();
	$column_name = 'courseid';
	if (!$dbman->field_exists('questionnaire_survey', 'courseid')) {
		$column_name = 'owner';
	}
    
	// Building a list of questionnaire activities
	$questionnaireactivities = $DB->get_records('questionnaire_survey', array($column_name=>$cs->id), "name");
	$fback = reset($questionnaireactivities);
	
	if ($fback != null) {
	
		header('Content-Type: application/excel');
		header('Content-Disposition: attachment; filename="sample.csv"');

		$fp = fopen('php://output', 'w');

		$head = array(get_string('lb_department', 'report_questionnairestats'), get_string('lb_shortname', 'report_questionnairestats'), 
			get_string('lb_fullname', 'report_questionnairestats'));
		
		$questions = $DB->get_records('questionnaire_question', array('survey_id'=>$fback->id));	
		foreach ($questions as $quest) {
			$quest_name = get_quest_name($quest);
			if ($quest_name != null) {
				if (is_array($quest_name)) {
					foreach($quest_name as $i) {
						$head[] = $i;
					}
				} else {
					$head[] = $quest_name;
				}
			}
		}		
		
		fputcsv($fp, $head);
		fclose($fp);
	}
}
