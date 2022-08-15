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
define('TEXT_BOX', 2);
define('TEXT', 3);
define('NUMERIC', 10);
define('MENU', 6);
define('RADIO', 4);
define('CHECK_BOX', 5);
define('PAGE_BREAK', 99);
define('SECTION_BREAK', 100);

function courseNameContains($courseName, $acronyms) {
	foreach($acronyms as $acr) {
		if (stripos($courseName, $acr) !== false) {
			return true;
		}
	}
	return false;
}

function getDepartementFromCourseName($str_course_name) {
	$dac = array("gac", "lac"); 
	$dae = array("gae", "eas", "tae", "eae", "lae"); 
	$dag = array("gag", "fit"); 
	$dam = array("gam", "tam", "eam"); 
	$dap = array("gap", "eap", "lap"); 
	$dat = array("gat", "tat", "eat"); 
	$dbi = array("gbi", "bio", "tbi", "ebi", "mbi"); 
	$dca = array("gca", "ali", "tca", "eca"); 
	$dcc = array("gcc", "com", "lcc"); 
	$dcf = array("gef", "cif"); 
	$dch = array("gch"); 
	$dcs = array("gcs", "cso"); 
	$dea = array("gea", "lea"); 
	$dec = array("gec"); 
	$ded = array("gde", "edu"); 
	$def = array("gfd", "efd"); 
	$deg = array("gne", "eng", "meg", "leg"); 
	$del = array("gel"); 
	$den = array("get", "ent"); 
	$des = array("ges"); 
	$dex = array("gex", "cex"); 
	$dfi = array("gfi"); 
	$dfm = array("gfm", "tfm", "efm", "pfm", "lmm"); 
	$dfp = array("gfp", "fip"); 
	$dga = array("gga"); 
	$dir = array("gdi", "edi"); 
	$dme = array("gsa"); 
	$dmm = array("gmm"); 
	$dmv = array("gmv", "vet", "mmv"); 
	$dnu = array("gnu"); 
	$dqi = array("gqi", "qui"); 
	$drh = array("grh", "grs", "trs", "ers"); 
	$dzo = array("gzo", "zoo", "tzo", "ezo"); 
	$prograd = array("gctt", "prg"); 

	// Cursos de pós
	$pca = array("pca", "dca");
	$pad = array("pad");
	$dae = array("dae");
	$pfp = array("pfp");
	$pag = array("pag");
	$pqi = array("pqi");
	$pba = array("pba");
	$pbi = array("pbi", "ppg");
	$pcc = array("pcc");
	$pcs = array("pcs");
	$ptm = array("ptm");
	$pgtpa = array("pgtpa");
	$psa = array("psa");
	$pmv = array("pmv");
	$pds = array("pds");
	$pec = array("pec");
	$ped = array("ped");
	$pgeca = array("pgeca");
	$peg = array("peg");
	$pea = array("pea");
	$pgal = array("pgal");
	$peb = array("peb");
	$psi = array("psi");
	$pcf = array("pcf");
	$pecem = array("pecem");
	$pef = array("pef");
	$pen = array("pen");
	$pex = array("pex");
	$pfil = array("pfil");
	$pfi = array("pfi");
	$pfv = array("pfv");
	$ppgf = array("ppgf");
	$pgm = array("pgm");
	$pgmp = array("pgmp");
	$ppgl = array("ppgl");
	$pma = array("pma");
	$pmb = array("pmb");
	$pns = array("pns");
	$pac = array("pac");
	$prh = array("prh");
	$pta = array("pta");
	$pzo = array("pzo");
	$ppmq = array("ppmq");
	$prp = array("prp");
	
	if (courseNameContains($str_course_name, $pca)) {
		return 'PPG Ciências dos Alimentos/ESAL';
	} else if (courseNameContains($str_course_name, $pad)) {
		return 'PPG Administração Pública - Profissional/FCSA';
	} else if (courseNameContains($str_course_name, $dae)) {
		return 'PPG Administração/FCSA';
	} else if (courseNameContains($str_course_name, $pfp)) {
		return 'PPG Agronomia/Fitopatologia/ESAL';
	} else if (courseNameContains($str_course_name, $pag)) {
		return 'PPG Agronomia/Fitotecnia/ESAL';
	} else if (courseNameContains($str_course_name, $pqi)) {
		return 'PPG Agroquímica/ICN';
	} else if (courseNameContains($str_course_name, $pba)) {
		return 'PPG Botânica Aplicada/ICN';
	} else if (courseNameContains($str_course_name, $pbi)) {
		return 'PPG Biotecnologia Vegetal/ICN';
	} else if (courseNameContains($str_course_name, $pcc)) {
		return 'PPG Ciência da Computação/ICET';
	} else if (courseNameContains($str_course_name, $pcs)) {
		return 'PPG Ciências do Solo/ESAL';
	} else if (courseNameContains($str_course_name, $ptm)) {
		return 'PPG Ciências e Tecnologia da Madeira/ESAL';
	} else if (courseNameContains($str_course_name, $pgtpa)) {
		return 'PPG Ciência e Tecnologia da Produção Animal - Profissional/FZMV';
	} else if (courseNameContains($str_course_name, $psa)) {
		return 'PPG Ciências da Saúde/FCS';
	} else if (courseNameContains($str_course_name, $pmv)) {
		return 'PPG Ciências Veterinárias/FZMV';
	} else if (courseNameContains($str_course_name, $pds)) {
		return 'PPG Desenvolvimento Sustentável e Extensão - Profissional/FCSA';
	} else if (courseNameContains($str_course_name, $pec)) {
		return 'PPG Ecologia Aplicada/ICN';
	} else if (courseNameContains($str_course_name, $ped)) {
		return 'PPG Educação - Profissional/FAELCH';
	} else if (courseNameContains($str_course_name, $pgeca)) {
		return 'PPG Educação Científica e Ambiental/ICN';
	} else if (courseNameContains($str_course_name, $peg)) {
		return 'PPG Engenharia Agrícola/EENG';
	} else if (courseNameContains($str_course_name, $pea)) {
		return 'PPG Engenharia Ambiental/EENG';
	} else if (courseNameContains($str_course_name, $pgal)) {
		return 'PPG Engenharia de Alimentos/ESAL';
	} else if (courseNameContains($str_course_name, $peb)) {
		return 'PPG Engenharia de Biomateriais/ESAL';
	} else if (courseNameContains($str_course_name, $psi)) {
		return 'PPG Engenharia de Sistemas e Automação/EENG';
	} else if (courseNameContains($str_course_name, $pcf)) {
		return 'PPG Engenharia Florestal/ESAL';
	} else if (courseNameContains($str_course_name, $pecem)) {
		return 'PPG Ensino de Ciências e Educação Matemática - Profissional/ICET';
	} else if (courseNameContains($str_course_name, $pef)) {
		return 'PPG Ensino de Física - Profissional/ICET';
	} else if (courseNameContains($str_course_name, $pen)) {
		return 'PPG Entomologia/ESAL';
	} else if (courseNameContains($str_course_name, $pex)) {
		return 'PPG Estatística e Experimentação Agropecuária/ICET';
	} else if (courseNameContains($str_course_name, $pfil)) {
		return 'PPG Filosofia/FAELCH';
	} else if (courseNameContains($str_course_name, $pfi)) {
		return 'PPG Ensino de Física - Associação Ampla - Profissional/ICET';
	} else if (courseNameContains($str_course_name, $pfv)) {
		return 'PPG Fisiologia Vegetal/ICN';
	} else if (courseNameContains($str_course_name, $ppgf)) {
		return 'PPG Física/ICET';
	} else if (courseNameContains($str_course_name, $pgm)) {
		return 'PPG Genética e Melhoramento de Plantas/ICN';
	} else if (courseNameContains($str_course_name, $pgmp)) {
		return 'PPG Genética e Melhoramento de Plantas - Profissional/ICN';
	} else if (courseNameContains($str_course_name, $ppgl)) {
		return 'PPG Letras/FAELCH';
	} else if (courseNameContains($str_course_name, $pma)) {
		return 'PPG Matemática Rede Nacional - Profissional/ICET';
	} else if (courseNameContains($str_course_name, $pmb)) {
		return 'PPG Microbiologia Agrícola/ICN';
	} else if (courseNameContains($str_course_name, $pns)) {
		return 'PPG Nutrição e Saúde/FCS';
	} else if (courseNameContains($str_course_name, $pac)) {
		return 'PPG Plantas Medicinais, Aromáticas e Codimentares/ESAL';
	} else if (courseNameContains($str_course_name, $prh)) {
		return 'PPG Recursos Hídricos/EENG';
	} else if (courseNameContains($str_course_name, $pta)) {
		return 'PPG Tecnologias e Inovações Ambientais - Profissional/ESAL';
	} else if (courseNameContains($str_course_name, $pzo)) {
		return 'PPG Zootecnia/FZMV';
	} else if (courseNameContains($str_course_name, $ppmq)) {
		return 'PPG Multicentrico em Química de Minas Gerais/ICN';
	} else if (courseNameContains($str_course_name, $prp)) {
		return 'PRPG/PRPG';
	} else if (courseNameContains($str_course_name, $dac)) {
		return 'DAC/ICET';
	} else if (courseNameContains($str_course_name, $dae)) {
		return 'DAE/FCSA';
	} else if (courseNameContains($str_course_name, $dag)) {
		return 'DAG/ESAL';
	} else if (courseNameContains($str_course_name, $dam)) {
		return 'DAM/EENG';
	} else if (courseNameContains($str_course_name, $dap)) {
		return 'DAP/FCSA';
	} else if (courseNameContains($str_course_name, $dat)) {
		return 'DAT/EENG';
	} else if (courseNameContains($str_course_name, $dbi)) {
		return 'DBI/ICN';
	} else if (courseNameContains($str_course_name, $dca)) {
		return 'DCA/ESAL';
	} else if (courseNameContains($str_course_name, $dcc)) {
		return 'DCC/ICET';
	} else if (courseNameContains($str_course_name, $dcf)) {
		return 'DCF/ESAL';
	} else if (courseNameContains($str_course_name, $dch)) {
		return 'DCH/FAELCH';
	} else if (courseNameContains($str_course_name, $dcs)) {
		return 'DCS/ESAL';
	} else if (courseNameContains($str_course_name, $dea)) {
		return 'DEA/EENG';
	} else if (courseNameContains($str_course_name, $dec)) {
		return 'DEC/ICN';
	} else if (courseNameContains($str_course_name, $ded)) {
		return 'DED/FAELCH';
	} else if (courseNameContains($str_course_name, $def)) {
		return 'DEF/FCS';
	} else if (courseNameContains($str_course_name, $deg)) {
		return 'DEG/EENG';
	} else if (courseNameContains($str_course_name, $del)) {
		return 'DEL/FAELCH';
	} else if (courseNameContains($str_course_name, $den)) {
		return 'DEN/ESAL';
	} else if (courseNameContains($str_course_name, $des)) {
		return 'DES/ICET';
	} else if (courseNameContains($str_course_name, $dex)) {
		return 'DEX/ICET';
	} else if (courseNameContains($str_course_name, $dfi)) {
		return 'DFI/ICN';
	} else if (courseNameContains($str_course_name, $dfm)) {
		return 'DFM/ICET';
	} else if (courseNameContains($str_course_name, $dfp)) {
		return 'DFP/ESAL';
	} else if (courseNameContains($str_course_name, $dga)) {
		return 'DGA/ESAL';
	} else if (courseNameContains($str_course_name, $dir)) {
		return 'DIR/FCSA';
	} else if (courseNameContains($str_course_name, $dme)) {
		return 'DME/FCS';
	} else if (courseNameContains($str_course_name, $dmm)) {
		return 'DMM/ICET';
	} else if (courseNameContains($str_course_name, $dmv)) {
		return 'DMV/FZMV';
	} else if (courseNameContains($str_course_name, $dnu)) {
		return 'DNU/FCS';
	} else if (courseNameContains($str_course_name, $dqi)) {
		return 'DQI/ICN';
	} else if (courseNameContains($str_course_name, $drh)) {
		return 'DRH/EENG';
	} else if (courseNameContains($str_course_name, $dzo)) {
		return 'DZO/FZMV';
	} else if (courseNameContains($str_course_name, $prograd)) {
		return 'PROGRAD';
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
	} else if ($quest_type_id == MENU or $quest_type_id == TEXT or $quest_type_id == TEXT_BOX or $quest_type_id == CHECK_BOX or $quest_type_id == RADIO or $quest_type_id == NUMERIC) {				
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
			$responses[] = $resp->rankvalue;
		}
		return $responses;
	} else if ($quest_type_id == TEXT or $quest_type_id == TEXT_BOX or $quest_type_id == NUMERIC) {				
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
	} else if ($quest_type_id == CHECK_BOX) {
		$result = $DB->get_recordset_sql('SELECT * FROM {questionnaire_resp_multiple} resp JOIN {questionnaire_quest_choice} ch ON ch.id = resp.choice_id WHERE resp.question_id = :quest_id AND resp.response_id = :resp_id', 
			array('quest_id'=>$quest_id, 'resp_id'=>$resp_id));
		$mult_resp = "";
		foreach($result as $resp) {
			$mult_resp =  $mult_resp . $resp->content . ', ';
		} 		
		return $mult_resp;
	} else if ($quest_type_id == PAGE_BREAK or $quest_type_id == SECTION_BREAK) {				
		return "";
	} else {
		return "ERROR_NO_SUPPORTED_QUESTION_TYPE: " . $quest_type_id;
	}
}

