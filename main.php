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
 * @subpackage 	feedbackstats
 * @copyright 	2018 Paulo Jr.
 * @license   	http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(dirname(__FILE__).'/../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require(__DIR__. '/constants.php');

admin_externalpage_setup('reportfeedbackstats', '', null, '', array('pagelayout'=>'report'));

$category = optional_param('category', ALL_CATEGORIES, PARAM_INT);

$url = new moodle_url($CFG->wwwroot . '/report/feedbackstats/index.php');
$link = html_writer::link($url, get_string('link_back', 'report_feedbackstats'));

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('pluginname', 'report_feedbackstats') . ' - ' . $link);

if ($category != ALL_CATEGORIES) {
	$result = $DB->get_records(COURSE_TABLE_NAME, array('category'=>$category), "shortname");
} else {
	$result = $DB->get_records(COURSE_TABLE_NAME, null, "shortname");
}

$table = new html_table();

$table->head = array(get_string('lb_course', 'report_feedbackstats'), get_string('lb_amount_of_students', 'report_feedbackstats') . ' / ' . get_string('lb_amount_of_responses', 'report_feedbackstats'), 
	get_string('lb_percentage_of_responses', 'report_feedbackstats'));
foreach ($result as $cs) {
    $coursecontext = context_course::instance($cs->id);
    $coursestudents = get_enrolled_users($coursecontext, 'mod/assignment:submit');
    $amount_of_students = count($coursestudents);
    
    $row = array('<b>' . $cs->shortname . '</b>', '<b>' . $amount_of_students . '</b>', '');
    $table->data[] = $row;
    
    // Building a list of feedback activities
    
    $feedbackactivities = $DB->get_records(FEEDBACK_TABLE_NAME, array('course'=>$cs->id), "name");
    foreach ($feedbackactivities as $fback) {
		// Count the number of feedback responses
		$amount_of_responses = $DB->count_records(FEEDBACK_RESPONSES_TABLE_NAME, array('feedback'=>$fback->id));		
		
		$perc_of_responses = 0;
		if ($amount_of_students > 0) {
			$perc_of_responses = ($amount_of_responses / $amount_of_students) * 100;
		}
		
		$row = array('&nbsp;&nbsp;&nbsp;&nbsp;<i>' . $fback->name . '</i>', $amount_of_responses,  ' (' . number_format($perc_of_responses, 2) . '%)');
		$table->data[] = $row;
	}
    
}

echo html_writer::table($table);

echo $OUTPUT->footer();
