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

$table->head = array(	get_string('lb_course', 'report_feedbackstats'));
foreach ($result as $cs) {
    $row = array();
    $row[] = $cs->shortname;
	$table->data[] = $row;
}

echo html_writer::table($table);

echo $OUTPUT->footer();
