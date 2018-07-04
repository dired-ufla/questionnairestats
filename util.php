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
 * @package   report
 * @subpackage questionnairestats
 * @copyright 2018 Paulo Jr.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

define('ALL_CATEGORIES', -1);

// Question types
define('RANK', 8);
define('TEXT', 3);
define('NUMERIC', 10);
define('MENU', 6);
define('RADIO', 4);
define('PAGE_BREAK', 99);
define('SECTION_BREAK', 100);

function getDepartementFromCourseName($str_course_name) {
	if (stripos($str_course_name, 'gae') !== false) {
		return 'DAE';
	} else if (stripos($str_course_name, 'gag') !== false) {
		return 'DAG';
	} else if (stripos($str_course_name, 'gbi') !== false) {
		return 'DBI';
	} else if (stripos($str_course_name, 'gca') !== false) {
		return 'DCA';
	} else if (stripos($str_course_name, 'gcc') !== false) {
		return 'DCC';
	} else if (stripos($str_course_name, 'gcs') !== false) {
		return 'DCS';
	} else if (stripos($str_course_name, 'gsa') !== false) {
		return 'DSA';
	} else if (stripos($str_course_name, 'gex') !== false) {
		return 'DEX';
	} else if (stripos($str_course_name, 'gef') !== false) {
		return 'DCF';
	} else if (stripos($str_course_name, 'gch') !== false) {
		return 'DCH';
	} else if (stripos($str_course_name, 'gdi') !== false) {
		return 'DIR';
	} else if (stripos($str_course_name, 'gde') !== false) {
		return 'DED';
	} else if (stripos($str_course_name, 'gfd') !== false) {
		return 'DEF';
	} else if (stripos($str_course_name, 'gne') !== false) {
		return 'DEG';
	} else if (stripos($str_course_name, 'gel') !== false) {
		return 'DEL';
	} else if (stripos($str_course_name, 'get') !== false) {
		return 'DEB';
	} else if (stripos($str_course_name, 'ges') !== false) {
		return 'DES';
	} else if (stripos($str_course_name, 'gfi') !== false) {
		return 'DFI';
	} else if (stripos($str_course_name, 'gfp') !== false) {
		return 'DFP';
	} else if (stripos($str_course_name, 'gnu') !== false) {
		return 'DNU';
	} else if (stripos($str_course_name, 'gmv') !== false) {
		return 'DMV';
	} else if (stripos($str_course_name, 'gqi') !== false) {
		return 'DQI';
	} else if (stripos($str_course_name, 'gzo') !== false) {
		return 'DZO';
	} else if (stripos($str_course_name, 'prg') !== false) {
		return 'PRG';
	} else {
		return '?';
	}
}

function get_quest_name($quest) {
	global $DB;
	
	$quest_id = $quest->id;
	$quest_type_id = $quest->type_id;
	
	if ($quest_type_id == RANK) {
		$result = $DB->get_records('questionnaire_quest_choice', array('question_id'=>$quest_id));
		$names = array();
		foreach ($result as $name) {
			$names[] = strip_tags($name->content);
		}
		return $names;
	} else if ($quest_type_id == MENU or $quest_type_id == TEXT or $quest_type_id == RADIO or $quest_type_id == NUMERIC) {				
		return strip_tags($quest->content);
	} else if ($quest_type_id == PAGE_BREAK or $quest_type_id == SECTION_BREAK) {				
		return "";
	} else {
		return "ERROR_NO_SUPPORTED_QUESTION_TYPE: " . $quest_type_id;
	}
}

function get_quest_responses($quest, $resp_id) {
	global $DB;
	
	$quest_id = $quest->id;
	$quest_type_id = $quest->type_id;
	
	if ($quest_type_id == RANK) {
		$result = $DB->get_records('questionnaire_response_rank', array('question_id'=>$quest_id, 'response_id'=>$resp_id));
		$responses = array();
		foreach ($result as $resp) {
			$responses[] = $resp->rank;
		}
		return $responses;
	} else if ($quest_type_id == TEXT or $quest_type_id == NUMERIC) {				
		$result = $DB->get_records('questionnaire_response_text', array('question_id'=>$quest_id, 'response_id'=>$resp_id));
		if ($result == null) {
			return "-";
		}
		foreach($result as $resp) {
			return strip_tags($resp->response);		
		}		
		
	} else if ($quest_type_id == MENU or $quest_type_id == RADIO) {
		$result = $DB->get_recordset_sql('SELECT * FROM {questionnaire_resp_single} resp JOIN {questionnaire_quest_choice} ch ON ch.id = resp.choice_id WHERE resp.question_id = :quest_id AND resp.response_id = :resp_id', 
			array('quest_id'=>$quest_id, 'resp_id'=>$resp_id));
		foreach($result as $resp) {
			return $resp->content;
		} 		
	} else if ($quest_type_id == PAGE_BREAK or $quest_type_id == SECTION_BREAK) {				
		return "";
	} else {
		return "ERROR_NO_SUPPORTED_QUESTION_TYPE: " . $quest_type_id;
	}
	
}

