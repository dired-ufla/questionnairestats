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

function getDepartementFromCourseName($str_course_name) {
	if (strpos($str_course_name, 'gae') !== false) {
		return 'DAE';
	} else if (strpos($str_course_name, 'gag') !== false) {
		return 'DAG';
	} else if (strpos($str_course_name, 'gbi') !== false) {
		return 'DBI';
	} else if (strpos($str_course_name, 'gca') !== false) {
		return 'DCA';
	} else if (strpos($str_course_name, 'gcc') !== false) {
		return 'DCC';
	} else if (strpos($str_course_name, 'gcs') !== false) {
		return 'DCS';
	} else if (strpos($str_course_name, 'gsa') !== false) {
		return 'DSA';
	} else if (strpos($str_course_name, 'gex') !== false) {
		return 'DEX';
	} else if (strpos($str_course_name, 'gef') !== false) {
		return 'DCF';
	} else if (strpos($str_course_name, 'gch') !== false) {
		return 'DCH';
	} else if (strpos($str_course_name, 'gdi') !== false) {
		return 'DIR';
	} else if (strpos($str_course_name, 'gde') !== false) {
		return 'DED';
	} else if (strpos($str_course_name, 'gfd') !== false) {
		return 'DEF';
	} else if (strpos($str_course_name, 'gne') !== false) {
		return 'DEG';
	} else if (strpos($str_course_name, 'gel') !== false) {
		return 'DEL';
	} else if (strpos($str_course_name, 'get') !== false) {
		return 'DEB';
	} else if (strpos($str_course_name, 'ges') !== false) {
		return 'DES';
	} else if (strpos($str_course_name, 'gfi') !== false) {
		return 'DFI';
	} else if (strpos($str_course_name, 'gfp') !== false) {
		return 'DFP';
	} else if (strpos($str_course_name, 'gnu') !== false) {
		return 'DNU';
	} else if (strpos($str_course_name, 'gmv') !== false) {
		return 'DMV';
	} else if (strpos($str_course_name, 'gqi') !== false) {
		return 'DQI';
	} else if (strpos($str_course_name, 'gzo') !== false) {
		return 'DZO';
	} else if (strpos($str_course_name, 'prg') !== false) {
		return 'PRG';
	} else {
		return '?';
	}
}
