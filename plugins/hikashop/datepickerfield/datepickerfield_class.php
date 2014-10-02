<?php
/**
 * @package	HikaShop for Joomla!
 * @version	2.3.1
 * @author	hikashop.com
 * @copyright	(C) 2010-2014 HIKARI SOFTWARE. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?><?php
class fieldOpt_datepicker_options {
	public function show($value) {
		if(!empty($value)) {
			if(is_string($value))
				$value = unserialize($value);
		} else {
			$value = array();
		}

		$excludeFormats = array(
			JHTML::_('select.option', 'mdY', 'm/d/Y'),
			JHTML::_('select.option', 'dmY', 'd/m/Y')
		);

		$months = array();
		for($i = 1; $i <= 12; $i++) {
			$months[] = JHTML::_('select.option', $i, $i);
		}

		$ret = '
<table class="table admintable table-stripped">
	<tr>
		<td class="key">'.JText::_('DATE_PICKER_OPT_DEFAULT_TODAY').'</td>
		<td>'.
			JHTML::_('hikaselect.booleanlist', "field_options[datepicker_options][today]" , '', @$value['today']).
		'</td>
	</tr>
	<tr>
		<td class="key">'.JText::_('DATE_PICKER_OPT_INLINE_DISPLAY').'</td>
		<td>'.
			JHTML::_('hikaselect.booleanlist', "field_options[datepicker_options][inline]" , '', @$value['inline']).
		'</td>
	</tr>
	<tr>
		<td class="key">'.JText::_('DATE_PICKER_OPT_MONDAY_FIRST').'</td>
		<td>'.
			JHTML::_('hikaselect.booleanlist', "field_options[datepicker_options][monday_first]" , '', @$value['monday_first']).
		'</td>
	</tr>
	<tr>
		<td class="key">'.JText::_('DATE_PICKER_OPT_CHANGE_MONTH').'</td>
		<td>'.
			JHTML::_('hikaselect.booleanlist', "field_options[datepicker_options][change_month]" , '', @$value['change_month']).
		'</td>
	</tr>
	<tr>
		<td class="key">'.JText::_('DATE_PICKER_OPT_CHANGE_YEAR').'</td>
		<td>'.
			JHTML::_('hikaselect.booleanlist', "field_options[datepicker_options][change_year]" , '', @$value['change_year']).
		'</td>
	</tr>
	<tr>
		<td class="key">'.JText::_('DATE_PICKER_OPT_SHOW_BTN_PANEL').'</td>
		<td>'.
			JHTML::_('hikaselect.booleanlist', "field_options[datepicker_options][show_btn_panel]" , '', @$value['show_btn_panel']).
		'</td>
	</tr>
	<tr>
		<td class="key">'.JText::_('DATE_PICKER_OPT_SHOW_MONTHS').'</td>
		<td>'.
			JHTML::_('select.genericlist', $months, "field_options[datepicker_options][show_months]", '', 'value', 'text', @$value['show_months']).
		'</td>
	</tr>
	<tr>
		<td class="key">'.JText::_('DATE_PICKER_OPT_OTHER_MONTH').'</td>
		<td>'.
			JHTML::_('hikaselect.booleanlist', "field_options[datepicker_options][other_month]" , '', @$value['other_month']).
		'</td>
	</tr>
	<tr>
		<td class="key">'.JText::_('DATE_PICKER_OPT_FORBIDDEN_DAYS').'</td>
		<td>
			<label><input type="checkbox" name="field_options[datepicker_options][forbidden_1]" value="1"'.(empty($value['forbidden_1'])?'':' checked="checked"').'/> '.JText::_('MONDAY').'</label><br/>
			<label><input type="checkbox" name="field_options[datepicker_options][forbidden_2]" value="1"'.(empty($value['forbidden_2'])?'':' checked="checked"').'/> '.JText::_('TUESDAY').'</label><br/>
			<label><input type="checkbox" name="field_options[datepicker_options][forbidden_3]" value="1"'.(empty($value['forbidden_3'])?'':' checked="checked"').'/> '.JText::_('WEDNESDAY').'</label><br/>
			<label><input type="checkbox" name="field_options[datepicker_options][forbidden_4]" value="1"'.(empty($value['forbidden_4'])?'':' checked="checked"').'/> '.JText::_('THURSDAY').'</label><br/>
			<label><input type="checkbox" name="field_options[datepicker_options][forbidden_5]" value="1"'.(empty($value['forbidden_5'])?'':' checked="checked"').'/> '.JText::_('FRIDAY').'</label><br/>
			<label><input type="checkbox" name="field_options[datepicker_options][forbidden_6]" value="1"'.(empty($value['forbidden_6'])?'':' checked="checked"').'/> '.JText::_('SATURDAY').'</label><br/>
			<label><input type="checkbox" name="field_options[datepicker_options][forbidden_0]" value="1"'.(empty($value['forbidden_0'])?'':' checked="checked"').'/> '.JText::_('SUNDAY').'</label>
		</td>
	</tr>
	<tr>
		<td class="key">'.JText::_('DATE_PICKER_OPT_EXCLUDES').'</td>
		<td>
			'.JHTML::_('select.genericlist', $excludeFormats, "field_options[datepicker_options][exclude_days_format]", '', 'value', 'text', @$value['exclude_days_format']).'<br/>
			<textarea name="field_options__datepicker_options__excludes">'.@$value['excludes'].'</textarea>
		</td>
	</tr>
	<tr>
		<td class="key">'.JText::_('DATE_PICKER_WAITING_DAYS').'</td>
		<td>
			<input type="text" name="field_options[datepicker_options][waiting]" value="'.@$value['waiting'].'" />
		</td>
	</tr>
	<tr>
		<td class="key">'.JText::_('DATE_PICKER_HOUR_EXTRA_DAY').'</td>
		<td>
			<input type="text" name="field_options[datepicker_options][hour_extra_day]" value="'.@$value['hour_extra_day'].'" />
		</td>
	</tr>
</table>';
		return $ret;
	}

	public function save(&$options) {
		if(!empty($options['datepicker_options']))
			$options['datepicker_options']['excludes'] = JRequest::getVar('field_options__datepicker_options__excludes','','','string',JREQUEST_ALLOWRAW);
	}
}

class hikashopDatepickerfield {

	public $prefix = null;
	public $suffix = null;
	public $excludeValue = null;
	public $report = null;
	public $parent = null;

	public function __construct(&$obj) {
		$this->prefix = $obj->prefix;
		$this->suffix = $obj->suffix;
		$this->excludeValue =& $obj->excludeValue;
		$this->report = @$obj->report;
		$this->parent =& $obj;

		$timeoffset = 0;
		$jconfig = JFactory::getConfig();
		if(!HIKASHOP_J30){
			$timeoffset = $jconfig->getValue('config.offset');
		} else {
			$timeoffset = $jconfig->get('offset');
		}
		if(HIKASHOP_J16){
			$dateC = JFactory::getDate(time(),$timeoffset);
			$timeoffset = $dateC->getOffsetFromGMT(true);
		}
		$this->timeoffset = $timeoffset *60*60 + date('Z');
	}

	private function init() {
		static $init = null;
		if($init !== null)
			return $init;

		hikashop_loadJsLib('jquery');
		$js = '
hkjQuery(function() {
	var excludeWDays = function(date, w, d, dt, rg) {
		var day = date.getDay(),
			md = (date.getMonth()+1) * 100 + date.getDate(),
			fd = date.getFullYear() * 10000 + md,
			r = true;
		if(w) { for(var i = w.length - 1; r && i >= 0; i--) { r = (day != w[i]); }}
		if(d) { for(var i = d.length - 1; r && i >= 0; i--) { r = (md != d[i]); }}
		if(dt) { for(var i = dt.length - 1; r && i >= 0; i--) { r = (fd != dt[i]); }}
		if(rg) { for(var i = rg.length - 1; r && i >= 0; i--) {
			if(rg[i][2] == 2)
				r = (md < rg[i][0] || md > rg[i][1]);
			else
				r = (fd < rg[i][0] || fd > rg[i][1]);
		}}
		return [r, \'\'];
	};
	hkjQuery(".hikashop_datepicker").each(function(){
		var t = hkjQuery(this), options = {};
		if(t.attr("data-options")) {
			options = Oby.evalJSON( t.attr("data-options") );
		}
		if(options["exclude"] || options["excludeDays"] || options["excludeDates"] || options["excludeRanges"]) {
			options["beforeShowDay"] = function(date){ return excludeWDays(date, options["exclude"], options["excludeDays"], options["excludeDates"], options["excludeRanges"]); };
		}
		options["altField"] = "#"+t.attr("data-picker");
		options["altFormat"] = "yy/mm/dd";
		t.datepicker(options);

		t.change(function(){
			var e = hkjQuery(this), format = e.datepicker("option", "dateFormat");
			if(e.val() == "") {
				hkjQuery("#"+e.attr("data-picker")).val("");
			} else {
				try{
					hkjQuery.datepicker.parseDate(format, e.val());
				}catch(ex) {
					hkjQuery("#"+e.attr("data-picker")).val("");
				}
			}
		});
	});
});';
		$doc = JFactory::getDocument();
		$doc->addScriptDeclaration($js);
		$doc->addStyleSheet('//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css');

		$init = true;
		return $init;
	}

	public function getFieldName($field) {
		return '<label for="' . $this->prefix . $field->field_namekey . $this->suffix.'">' . $this->trans($field->field_realname) . '</label>';
	}

	public function trans($name) {
		$val = preg_replace('#[^a-z0-9]#i', '_', strtoupper($name));
		$trans = JText::_($val);
		if($val == $trans)
			return $name;
		return $trans;
	}

	public function show(&$field, $value) {
		if(!$this->init())
			return '';

		if(!empty($field->field_value) && !is_array($field->field_value)) {
			$field->field_value = $this->parent->explodeValues($field->field_value);
		}
		if(isset($field->field_value[$value])) {
			$value = $field->field_value[$value]->value;
		}

		if(is_string($field->field_options)) {
			$field->field_options = unserialize($field->field_options);
		}
		$format = @$field->field_options['format'];
		if(strpos($format, '%') !== false) {
			$format = str_replace(array('%A','%d','%B','%m','%Y','%y','%H','%M','%S','%a'),array('l','d','F','m','Y','y','H','i','s','D'),$format);
		}

		$ret = $value;
		$date = $this->getDate($value);
		$timestamp = $this->getTimestamp($date);

		$joomlaFormat = str_replace(array('l','d','F','m','Y','y','H','i','s','D'),array('%A','%d','%B','%m','%Y','%y','%H','%M','%S','%a'),$format);
		if(!empty($joomlaFormat))
			$ret = hikashop_getDate($timestamp, $joomlaFormat);
		else
			$ret = hikashop_getDate($timestamp);

		return $ret;
	}

	public function display($field, $value, $map, $inside, $options = '', $test = false) {
		if(!$this->init())
			return '';

		$app = JFactory::getApplication();
		$ret = '';
		$id = $this->prefix . @$field->field_namekey . $this->suffix;

		$value = $this->getDate($value);
		$timestamp = $this->getTimestamp($value);

		$datepicker_options = @$field->field_options['datepicker_options'];
		if(!empty($datepicker_options)) {
			if(is_string($datepicker_options))
				$datepicker_options = unserialize($datepicker_options);
		} else {
			$datepicker_options = array();
		}

		$dateOptions = array();

		if(!empty($datepicker_options['hour_extra_day'])) {
			$hour = (int)$datepicker_options['hour_extra_day'];
			$date_today = getdate();
			$current_hour = (int)$date_today['hours'] + $this->timeoffset;
			if($current_hour >= $hour)
				$datepicker_options['waiting'] = (int)$datepicker_options['waiting'] + 1;
		}

		if(@$field->field_options['allow'] == 'future') {
			if(!empty($datepicker_options['waiting']))
				$dateOptions[] = 'minDate:'.(int)$datepicker_options['waiting'];
			else
				$dateOptions[] = 'minDate:0';
		} else if(@$field->field_options['allow'] == 'past') {
			if(!empty($datepicker_options['waiting']))
				$dateOptions[] = 'maxDate:'.(0 - (int)($datepicker_options['waiting']));
			else
				$dateOptions[] = 'maxDate:0';
		}

		$format = @$field->field_options['format'];
		if(strpos('%', $format) !== false) {
			$format = str_replace(array('%A','%d','%B','%m','%Y','%y','%H','%M','%S','%a'),array('l','d','F','m','Y','y','H','i','s','D'),$format);
		}
		if(!empty($format)) {
			$dateOptions[] = 'dateFormat:\''.str_replace(
					array('j','d', 'z','D','l', 'n','m', 'M','F', 'y','Y'),
					array('d','dd','o','D','DD','m','mm','M','MM','y','yy'),
					$format
				).'\'';
		}

		$joomlaFormat = str_replace(array('l','d','F','m','Y','y','H','i','s','D'),array('%A','%d','%B','%m','%Y','%y','%H','%M','%S','%a'),$format);
		if(!empty($value) && !empty($value['y'])) {
			if(!empty($joomlaFormat))
				$txtValue = hikashop_getDate($timestamp, $joomlaFormat);
			else
				$txtValue = hikashop_getDate($timestamp);
		} else {
			$timestamp = 0;
			$txtValue = '';
		}

		if(!empty($datepicker_options['today'])) { // && empty($timestamp)) {
			$timestamp = time();
			if(!empty($datepicker_options['waiting']))
				$timestamp += 86400 * (int)$datepicker_options['waiting'];
			if(!empty($joomlaFormat))
				$txtValue = hikashop_getDate($timestamp, $joomlaFormat);
			else
				$txtValue = hikashop_getDate($timestamp);
		}

		if(!empty($txtValue))
			$dateOptions[] = 'defaultDate:\''.$txtValue.'\'';

		if(!empty($datepicker_options['monday_first']))
			$dateOptions[] = 'firstDay:1';

		if(!empty($datepicker_options['change_month']))
			$dateOptions[] = 'changeMonth:true';
		if(!empty($datepicker_options['change_year']))
			$dateOptions[] = 'changeYear:true';
		if(!empty($datepicker_options['show_btn_panel']))
			$dateOptions[] = 'showButtonPanel:true';
		if(!empty($datepicker_options['show_months']) && (int)$datepicker_options['show_months'] > 1 && (int)$datepicker_options['show_months'] <= 12)
			$dateOptions[] = 'numberOfMonths:'.(int)$datepicker_options['show_months'];

		if(!empty($datepicker_options['other_month'])) {
			$dateOptions[] = 'showOtherMonths:true';
			$dateOptions[] = 'selectOtherMonths:true';
		}

		$spe_day_format = 'm/d/Y';
		if(!empty($datepicker_options['exclude_days_format'])) {
			$spe_day_format = $datepicker_options['exclude_days_format'];
		}

		$excludeDays = array();
		for($i = 0; $i <= 6; $i++) { if(!empty($datepicker_options['forbidden_'.$i])) { $excludeDays[] = $i; } }
		if(!empty($excludeDays)) $dateOptions[] = 'exclude:['.implode(',',$excludeDays).']';

		$excludeDays = explode('|', str_replace(array("\r\n","\n","\r",' '),array('|','|','|','|'), $datepicker_options['excludes']));
		$date_today = getdate();
		$disabled_dates = array();
		$disabled_days = array();
		$disabled_ranges = array();
		foreach($excludeDays as $day){
			if(strpos($day, '-') === false) {
				$day = explode('/', trim($day));
				$ret = $this->convertDay($day, $date_today, $spe_day_format);
				if(!empty($ret)) {
					if(count($day) == 3)
						$disabled_dates[] = $ret;
					if(count($day) == 2)
						$disabled_days[] = $ret;
				}
			} else {
				$days = explode('-', trim($day));
				$day1 = explode('/', trim($days[0]));
				$ret1 = $this->convertDay($day1, $date_today, $spe_day_format);
				$day2 = explode('/', trim($days[1]));
				$ret2 = $this->convertDay($day2, $date_today, $spe_day_format);

				if(!empty($ret1) && !empty($ret2) && count($day1) == count($day2)) {
					$disabled_ranges[] = '['.$ret1.','.$ret2.','.count($day1).']';
				}
			}
		}
		if(!empty($disabled_days))
			$dateOptions[] = 'excludeDays:['.implode(',',$disabled_days).']';
		if(!empty($disabled_dates))
			$dateOptions[] = 'excludeDates:['.implode(',',$disabled_dates).']';
		if(!empty($disabled_ranges))
			$dateOptions[] = 'excludeRanges:['.implode(',',$disabled_ranges).']';

		if(!empty($dateOptions)) {
			$dateOptions = '{' . implode(',', $dateOptions) . '}';
		} else {
			$dateOptions = '';
		}

		if(empty($datepicker_options['inline'])) {
			if(($app->isAdmin() && HIKASHOP_BACK_RESPONSIVE) || (!$app->isAdmin() && HIKASHOP_RESPONSIVE)) {
				$ret = '<div class="input-append">'.
					'<input type="text" id="'.$id.'_input" data-picker="'.$id.'" data-options="'.$dateOptions.'" class="hikashop_datepicker" value="'.$txtValue.'"/>'.
					'<button class="btn" onclick="document.getElementById(\''.$id.'_input\').focus();return false;"><i class="icon-calendar"></i></button>'.
					'</div>';
			} else {
				$ret = '<input type="text" data-picker="'.$id.'" data-options="'.$dateOptions.'" class="hikashop_datepicker" value="'.$txtValue.'"/>';
			}
		} else {
			$ret = '<div data-picker="'.$id.'" data-options="'.$dateOptions.'" class="hikashop_datepicker" value="'.$txtValue.'"></div>';
		}

		$ret .= '<input type="hidden" value="'.$this->serializeDate($value).'" name="'.$map.'" id="'.$id.'"/>';

		return $ret;
	}

	private function convertDay($day, $today, $spe_day_format) {
		if(count($day) == 3) {
			$y = (int)$day[2];
			if($y < 100) $y += 2000;
			if($spe_day_format == 'dmY') {
				$d = (int)$day[0]; $m = (int)$day[1];
			} else {
				$d = (int)$day[1]; $m = (int)$day[0];
			}

			if( empty($today) || $y >= $today['year'] || $m >= $today['mon'] || $d >= $today['mday'] ) {
				return $y.(($m<10)?'0':'').$m.(($d<10)?'0':'').$d;
			}
			return '';
		}

		if(count($day) == 2) {
			if($spe_day_format == 'dmY') {
				$d = (int)$day[0]; $m = (int)$day[1];
			} else {
				$d = (int)$day[1]; $m = (int)$day[0];
			}
			return $m.(($d<10)?'0':'').$d;
		}
		return '';
	}

	private function getDate($value, $format = 'm/d/Y') {
		$ret = array(
			'y' => 0, 'm' => 0, 'd' => 0,
			'h' => 0, 'i' => 0, 's' => 0
		);

		if(empty($value))
			return $ret;

		$dateValue = $value;
		if(preg_match('#^([0-9]+)$#', $value)) {
			if(strlen($value) == 14) {
				$dateValue = substr($value,0,4) . '/' . substr($value,4,2) . '/' . substr($value,6,2);
			} else {
				$dateValue = hikashop_getDate($value, '%Y/%m/%d');
			}
			list($y,$m,$d) = explode('/', $dateValue, 3);
		} else {
			$y = 0; $m = 0; $d = 0;
			$timestamp = strtotime(str_replace('/', '-', $value));
			if($timestamp !== false && $timestamp !== -1 && $timestamp > 0) {
				$dateValue = date('Y/m/d', $timestamp);
				list($y,$m,$d) = explode('/', $dateValue, 3);
			} else {
				list($y,$m,$d) = explode('/', $value, 3);
			}
		}

		$ret['y'] = (int)$y;
		$ret['m'] = (int)$m;
		$ret['d'] = (int)$d;

		return $ret;
	}

	private function getTimestamp($value) {
		if(is_array($value)) {
			$value = $value['y'] . '/' . $value['m'] . '/' . $value['d'];
		}
		$ret = hikashop_getTime($value);

		return $ret;
	}

	private function serializeDate($value) {
		$ret = $value['y'];

		$keys = array('m' => 12, 'd' => 31, 'h' => 24, 'i' => 60, 's' => 60);
		foreach($keys as $k => $v) {
			$t = (int)$value[$k];
			if($t > $v) $t = $v;
			if($t < 0) $t = 0;
			if($t < 10) $ret .= '0';
			$ret .= $t;
		}

		return $ret;
	}

	public function JSCheck(&$oneField,&$requiredFields,&$validMessages,&$values){
		if(!empty($oneField->field_required)){
			$requiredFields[] = $oneField->field_namekey;
			if(!empty($oneField->field_options['errormessage'])){
				$validMessages[] = addslashes($this->trans($oneField->field_options['errormessage']));
			}else{
				$validMessages[] = addslashes(JText::sprintf('FIELD_VALID',$this->trans($oneField->field_realname)));
			}
		}
	}

	public function check(&$field, &$value, $oldvalue) {
		$app = JFactory::getApplication();

		$fieldClass = hikashop_get('class.field');
		$fullField = $fieldClass->get($field->field_id);

		if(!empty($value)) {
			$dateValue = $this->getDate($value);
			$value = $this->serializeDate($dateValue);
		} else {
			$value = '';
			$dateValue = array();
		}

		if(!empty($value) && !empty($dateValue['y'])) {
			$fullDayCode = $dateValue['y'] * 10000 + $dateValue['m'] * 100 + $dateValue['d'];
			$dayCode = $dateValue['m'] * 100 + $dateValue['d'];

			$today = getdate();
			$today_year = (int)$today['year'];
			$today_month = (int)$today['mon'];
			$today_day = (int)$today['mday'];

			$fullTodayCode = $today_year * 10000 + $today_month * 100 + $today_day;
			$todayCode = $today_month * 100 + $today_day;

			if(!empty($fullField->field_options['hour_extra_day'])) {
				$hour = (int)$fullField->field_options['hour_extra_day'];
				$date_today = getdate();
				$current_hour = (int)$date_today['hours'] + $this->timeoffset;
				if($current_hour >= $hour)
					$fullField->field_options['waiting'] = (int)$fullField->field_options['waiting'] + 1;
			}

			if(!empty($fullField->field_options['allow'])) {

				if($fullField->field_options['allow'] == 'futur') {
					$fullTodayCode += (int)$fullField->field_options['waiting'];
					$todayCode += (int)$fullField->field_options['waiting'];
				}
				if($fullField->field_options['allow'] == 'past') {
					$fullTodayCode -= (int)$fullField->field_options['waiting'];
					$todayCode -= (int)$fullField->field_options['waiting'];
				}

				if($fullField->field_options['allow'] == 'futur' && $fullDayCode < $fullTodayCode) {
					$app->enqueueMessage(JText::sprintf('PLEASE_FILL_THE_FIELD', $this->trans($field->field_realname)));
					return false;
				}

				if($fullField->field_options['allow'] == 'past' && $fullDayCode > $fullTodayCode) {
					$app->enqueueMessage(JText::sprintf('PLEASE_FILL_THE_FIELD', $this->trans($field->field_realname)));
					return false;
				}
			}

			$datepicker_options = @$fullField->field_options['datepicker_options'];
			if(!empty($datepicker_options)) {
				if(is_string($datepicker_options))
					$datepicker_options = unserialize($datepicker_options);
			} else {
				$datepicker_options = array();
			}

			$timestamp = $this->getTimestamp($dateValue);
			$phpDate = getdate($timestamp);
			$wday = $phpDate['wday'];

			$excludeDays = array();
			for($i = 0; $i <= 6; $i++) {
				if(!empty($datepicker_options['forbidden_'.$i]) && $i == $wday) {
					$app->enqueueMessage(JText::sprintf('DATE_PICKER_INCORRECT_DATE_FOR', $this->trans($field->field_realname)));
					return false;
				}
			}

			if(!empty($datepicker_options['excludes'])) {
				$spe_day_format = 'm/d/Y';
				if(!empty($datepicker_options['exclude_days_format'])) {
					$spe_day_format = $datepicker_options['exclude_days_format'];
				}

				$excludeDays = explode('|', str_replace(array("\r\n","\n","\r",' '),array('|','|','|','|'), $datepicker_options['excludes']));
				foreach($excludeDays as $day){
					if(strpos($day, '-') === false) {
						$day = explode('/', trim($day));
						$ret = (int)$this->convertDay($day, null, $spe_day_format);
						if(!empty($ret)) {
							if(count($day) == 3 && $fullDayCode == $ret) {
								$app->enqueueMessage(JText::sprintf('DATE_PICKER_INCORRECT_DATE_FOR', $this->trans($field->field_realname)));
								return false;
							}
							if(count($day) == 2 && $dayCode == $ret) {
								$app->enqueueMessage(JText::sprintf('DATE_PICKER_INCORRECT_DATE_FOR', $this->trans($field->field_realname)));
								return false;
							}
						}
					} else {
						$days = explode('-', trim($day));
						$day1 = explode('/', trim($days[0]));
						$ret1 = (int)$this->convertDay($day1, null, $spe_day_format);
						$day2 = explode('/', trim($days[1]));
						$ret2 = (int)$this->convertDay($day2, null, $spe_day_format);

						if(!empty($ret1) && !empty($ret2) && count($day1) == count($day2) && $ret1 < $ret2) {
							if(count($day) == 3 && $fullTodayCode >= $ret1 && $fullTodayCode <= $ret2) {
								$app->enqueueMessage(JText::sprintf('DATE_PICKER_INCORRECT_DATE_FOR', $this->trans($field->field_realname)));
								return false;
							} else if(count($day) == 2 && $todayCode >= $ret1 && $todayCode <= $ret2) {
								$app->enqueueMessage(JText::sprintf('DATE_PICKER_INCORRECT_DATE_FOR', $this->trans($field->field_realname)));
								return false;
							}
						}
					}
				}
			}
		}

		if(!$field->field_required || strlen($value) || strlen($oldvalue)) {
			return true;
		}
		if($this->report)
			$app->enqueueMessage(JText::sprintf('PLEASE_FILL_THE_FIELD', $this->trans($field->field_realname)));
		return false;
	}
}
