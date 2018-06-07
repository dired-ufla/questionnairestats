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
 * Strings for component 'report_coursestats', language 'en'
 *
 * @package   	report
 * @subpackage 	questionnairestats
 * @copyright 	2018 Paulo Jr.
 * @license   	http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(dirname(__FILE__).'/../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require(__DIR__. '/constants.php');

admin_externalpage_setup('reportquestionnairestats', '', null, '', array('pagelayout'=>'report'));

$category = optional_param('category', ALL_CATEGORIES, PARAM_INT);

if ($category != ALL_CATEGORIES) {
	$result = $DB->get_records('course', array('category'=>$category), "fullname");
} else {
	$result = $DB->get_records('course', null, "fullname");
}

header('Content-Type: application/excel');
header('Content-Disposition: attachment; filename="sample.csv"');

$fp = fopen('php://output', 'w');

$head = array(get_string('lb_category', 'report_questionnairestats'), get_string('lb_shortname', 'report_questionnairestats'), get_string('lb_fullname', 'report_questionnairestats'), 
	get_string('lb_feedbackname', 'report_questionnairestats'), get_string('lb_amount_of_students', 'report_questionnairestats'), 
	get_string('lb_amount_of_responses', 'report_questionnairestats'), get_string('lb_percentage_of_responses', 'report_questionnairestats'));

fputcsv($fp, $head);

foreach ($result as $cs) {
    $coursecontext = context_course::instance($cs->id);
    $coursestudents = get_enrolled_users($coursecontext, 'mod/assignment:submit');
    $amount_of_students = count($coursestudents);
    
    $cat = $DB->get_record('course_categories', array('id'=>$cs->category));
    
    // Deal with column the name update of the questionnarie module
    $dbman = $DB->get_manager();
    $column_name = 'courseid';
    if (!$dbman->field_exists('questionnaire_survey', 'courseid')) {
		$column_name = 'owner';
	}
    
    // Building a list of questionnaire activities
    $questionnaireactivities = $DB->get_records('questionnaire_survey', array($column_name=>$cs->id), "name");
    foreach ($questionnaireactivities as $fback) {
		// Count the number of questionnaire responses
		$amount_of_responses = $DB->count_records('questionnaire_response', array('survey_id'=>$fback->id));		
		
		$perc_of_responses = 0;
		if ($amount_of_students > 0) {
			$perc_of_responses = ($amount_of_responses / $amount_of_students) * 100;
		}
		
		$row = array($cat->name, $cs->shortname, $cs->fullname, $fback->name, $amount_of_students, $amount_of_responses, number_format($perc_of_responses, 2));
		fputcsv($fp, $row);
	}    
}

fclose($fp);
