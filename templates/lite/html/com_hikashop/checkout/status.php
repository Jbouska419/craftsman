<?php
/**
 * @package	HikaShop for Joomla!
 * @version	2.3.1
 * @author	hikashop.com
 * @copyright	(C) 2010-2014 HIKARI SOFTWARE. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?><br/>
<section id="hikashop-status">
<div class="panel">
  <div class="panel-heading">
    <h3 class="panel-title">Order Status</h3>
  </div>
  <div class="panel-body">
  	<ul class="list-group">
    <li class="list-group-item">
<?php
	$array = array();
	if(!empty($this->shipping_data)) {
		$names = array();
		foreach($this->shipping_data as $shipping) {
			$names[] = $shipping->shipping_name;
		}
		$array[] = JText::sprintf('HIKASHOP_SHIPPING_METHOD_CHOSEN', '<span class="label label-info">'.implode(', ', $names).'</span>');
	}
	if(!empty($this->payment_data)) {
		$array[]= JText::sprintf('HIKASHOP_PAYMENT_METHOD_CHOSEN', '<span class="label label-info">'.$this->payment_data->payment_name.'</span>');
	}
	
	echo implode('<br />', $array);
?>
</li>
</ul>
</div>
</div>
</section>
