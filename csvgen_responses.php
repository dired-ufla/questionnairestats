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

header('Content-Type: application/excel');
header('Content-Disposition: attachment; filename="responses.csv"');

$fp = fopen('php://output', 'w');

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
	
		$head = array(get_string('lb_department', 'report_questionnairestats'), get_string('lb_shortname', 'report_questionnairestats'), 
			get_string('lb_fullname', 'report_questionnairestats'), get_string('lb_teacher', 'report_questionnairestats'));
		
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
	}
}

foreach ($result as $cs) {
	// Deal with column the name update of the questionnarie module
	$dbman = $DB->get_manager();
	$column_name = 'courseid';
	if (!$dbman->field_exists('questionnaire_survey', 'courseid')) {
		$column_name = 'owner';
	}
    
	// Building a list of questionnaire activities
	$questionnaireactivities = $DB->get_records('questionnaire_survey', array($column_name=>$cs->id), "name");
	$fback = reset($questionnaireactivities);
	
	foreach ($questionnaireactivities as $fback) {
		$dept = getDepartementFromCourseName($cs->shortname);		
		$responses = $DB->get_records('questionnaire_response', array('survey_id'=>$fback->id));	
		$questions = $DB->get_records('questionnaire_question', array('survey_id'=>$fback->id));	
		
		foreach ($responses as $resp) {
			
			// Catches the names of the teachers, based on the course fullname
			$pos = strrpos($cs->fullname, '-');
			if ($pos === false) {
				$teacher_names = '-';
				$fullname = $cs->fullname;
			} else {
				$teacher_names = substr($cs->fullname, $pos + 1);
				$fullname = substr($cs->fullname, 0, $pos);
			}
			
			$resp_data = array($dept, $cs->shortname, $fullname, $teacher_names);
			foreach ($questions as $quest) {
				$quest_resp = get_quest_responses($quest, $resp->id);
				if ($quest_resp != null) {
					if (is_array($quest_resp)) {
						foreach($quest_resp as $i) {
							$resp_data[] = $i;
						}
					} else {
						$resp_data[] = $quest_resp;
					}
				}
			}
			fputcsv($fp, $resp_data);
		}
	}	
}

fclose($fp);
