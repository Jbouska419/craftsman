<?php
defined('_JEXEC') or die();

/**
 *
 * @package    VirtueMart
 * @subpackage Plugins  - Elements
 * @author Valérie Isaksen
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2011 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id$
 */
if (!class_exists('VmConfig'))
	require(JPATH_ROOT .'/administrator/components/com_virtuemart/helpers/config.php');

if (!class_exists('ShopFunctions'))
	require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'shopfunctions.php');
if (!class_exists('TableCategories'))
	require(JPATH_VM_ADMINISTRATOR . DS . 'tables' . DS . 'categories.php');
jimport('joomla.form.formfield');

/*
 * This element is used by the menu manager
 * Should be that way
 */
class JFormFieldCategories extends JFormField {

	protected $type = 'vmcategories';

	// This line is required to keep Joomla! 1.6/1.7 from complaining
	protected function getInput() {
		$key = ($this->element['key_field'] ? $this->element['key_field'] : 'value');
		$val = ($this->element['value_field'] ? $this->element['value_field'] : $this->name);

		VmConfig::loadJLang('com_virtuemart');

		$categorylist = ShopFunctions::categoryListTree(array($this->value));

		$html = '<select class="inputbox"   name="' . $this->name . '" >';
		$html .= '<option value="0">' . vmText::_('COM_VIRTUEMART_CATEGORY_FORM_TOP_LEVEL') . '</option>';
		$html .= $categorylist;
		$html .= "</select>";
		return $html;
	}


}


