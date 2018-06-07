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
	if (!strpos($str_course_name, 'gae')) {
		return 'DAE';
	} else if (!strpos($str_course_name, 'gag')) {
		return 'DAG';
	} else if (!strpos($str_course_name, 'gbi')) {
		return 'DBI';
	} else if (!strpos($str_course_name, 'gca')) {
		return 'DCA';
	} else if (!strpos($str_course_name, 'gcc')) {
		return 'DCC';
	} else if (!strpos($str_course_name, 'gcs')) {
		return 'DCS';
	} else if (!strpos($str_course_name, 'gsa')) {
		return 'DSA';
	} else if (!strpos($str_course_name, 'gex')) {
		return 'DEX';
	} else if (!strpos($str_course_name, 'gef')) {
		return 'DCF';
	} else if (!strpos($str_course_name, 'gch')) {
		return 'DCH';
	} else if (!strpos($str_course_name, 'gdi')) {
		return 'DIR';
	} else if (!strpos($str_course_name, 'gde')) {
		return 'DED';
	} else if (!strpos($str_course_name, 'gfd')) {
		return 'DEF';
	} else if (!strpos($str_course_name, 'gne')) {
		return 'DEG';
	} else if (!strpos($str_course_name, 'gel')) {
		return 'DEL';
	} else if (!strpos($str_course_name, 'get')) {
		return 'DEB';
	} else if (!strpos($str_course_name, 'ges')) {
		return 'DES';
	} else if (!strpos($str_course_name, 'gfi')) {
		return 'DFI';
	} else if (!strpos($str_course_name, 'gfp')) {
		return 'DFP';
	} else if (!strpos($str_course_name, 'gnu')) {
		return 'DNU';
	} else if (!strpos($str_course_name, 'gmv')) {
		return 'DMV';
	} else if (!strpos($str_course_name, 'gqi')) {
		return 'DQI';
	} else if (!strpos($str_course_name, 'gzo')) {
		return 'DZO';
	} else if (!strpos($str_course_name, 'prg')) {
		return 'PRG';
	} else {
		return '?';
	}
}
