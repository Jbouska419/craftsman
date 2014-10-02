<?php
/**
 * @package	HikaShop for Joomla!
 * @version	2.3.1
 * @author	hikashop.com
 * @copyright	(C) 2010-2014 HIKARI SOFTWARE. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?>
<section id="hikashop-coupon">
<div class="panel">
<fieldset>
  <div class="panel-heading">
    <h3 class="panel-title">Coupons</h3>
  </div>
  <div class="panel-body">
  	<ul class="list-group">
<li class="list-group-item">
	<?php
	if(empty($this->coupon)){
		echo JText::_('HIKASHOP_ENTER_COUPON');
		?>
		<input id="hikashop_checkout_coupon_input" type="text" name="coupon" value="" />
	<?php
		echo $this->cart->displayButton(JText::_('ADD'),'refresh',$this->params,hikashop_completeLink('checkout'),'',' onclick="return hikashopCheckCoupon(\'hikashop_checkout_coupon_input\');"');
	}else{
		echo JText::sprintf('HIKASHOP_COUPON_LABEL',@$this->coupon->discount_code);
		global $Itemid;
		$url_itemid='';
		if(!empty($Itemid)){
			$url_itemid='&Itemid='.$Itemid;
		}
		?>
		<a href="<?php echo hikashop_completeLink('checkout&task=step&step='.($this->step+1).'&previous='.$this->step.'&removecoupon=1'.'&'.hikashop_getFormToken().'=1'.$url_itemid); ?>"  title="<?php echo JText::_('REMOVE_COUPON'); ?>" >
			<img src="<?php echo HIKASHOP_IMAGES . 'delete2.png';?>" alt="<?php echo JText::_('REMOVE_COUPON'); ?>" />
		</a>
	<?php }?>
</li>
</ul>
</div>
</fieldset>
</div>
</section>
