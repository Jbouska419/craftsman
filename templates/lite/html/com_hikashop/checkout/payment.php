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
if(!empty($this->orderInfos->full_total->prices[0]) && bccomp($this->orderInfos->full_total->prices[0]->price_value_with_tax,0,5)!=0){
	if(!empty($this->methods)){
?>
<section id="hikashop-payment">
<div class="panel">
<fieldset>
  <div class="panel-heading">
    <h3 class="panel-title"><?php echo JText::_('HIKASHOP_PAYMENT_METHOD');?></h3>
  </div>
  <div class="panel-body">
<?php
		$done = false;
		$row_index=0;
		$auto_select_default = $this->config->get('auto_select_default',2);
		if($auto_select_default==1 && count($this->methods)>1) $auto_select_default=0;
		$odd = 0;

		if(!HIKASHOP_RESPONSIVE) {
?>
		<ul class="list-group">
<?php
			foreach($this->methods as $method){
				$checked = '';
				if(($this->payment_method==$method->payment_type && $this->payment_id==$method->payment_id)|| ($auto_select_default && empty($this->payment_id)&&!$done)){
					$checked = 'checked="checked"';
					$done = true;
				}
				if($this->config->get('auto_submit_methods',1) && empty($method->ask_cc) && empty($method->custom_html) && empty($checked)){
					$checked.=' onclick="this.form.action=this.form.action+\'#hikashop_payment_methods\';this.form.submit(); return false;"';
				}
?>
			<li class="list-group-item">
					<input class="hikashop_checkout_payment_radio" id="radio_<?php echo $method->payment_type.'_'.$method->payment_id;?>" type="radio" name="hikashop_payment" value="<?php echo $method->payment_type.'_'.$method->payment_id;?>" <?php echo $checked; ?> />
                <label for="radio_<?php echo $method->payment_type.'_'.$method->payment_id;?>" style="cursor:pointer;">
					<span class="hikashop_checkout_payment_image">
<?php
				if(!empty($method->payment_images)){
					$images = explode(',',$method->payment_images);
					if(!empty($images)){
						foreach($images as $image){
							if(!empty($this->images_payment[$image])){
?>
						<img src="<?php echo HIKASHOP_IMAGES .'payment/'. $this->images_payment[$image];?>" alt=""/>
<?php
							}
						}
					}
				}
?>
					</span>
					</label>            
                <label for="radio_<?php echo $method->payment_type.'_'.$method->payment_id;?>" style="cursor:pointer;">
					<span class="hikashop_checkout_payment_name"><?php echo $method->payment_name;?></span></label>
					<span class="hikashop_checkout_payment_cost">
<?php
				if($method->payment_price != "0"){
					echo $this->currencyHelper->format($method->payment_price,$this->full_total->prices[0]->price_currency_id);
				}
				else
					echo JText::_('FREE_PAYMENT');
?>
					</span>
<?php
				if(!empty($method->payment_description)){
?>
					<br/>
					<div class="hikashop_checkout_payment_description"><?php echo $method->payment_description;?></div>
<?php
				}
?>
				</li>
				<li class="list-group-item">
<?php
				$this->method =& $method;
				$this->setLayout('ccinfo');
				echo $this->loadTemplate();
?>
				</li>
<?php
				$row_index++;
				$odd = 1-$odd;
			}
?>
</ul>
<?php
		} else {
?>
<?php
	foreach($this->methods as $method){
		$checked = '';
		if(($this->payment_method==$method->payment_type && $this->payment_id==$method->payment_id)|| ($auto_select_default && empty($this->payment_id)&&!$done)){
			$checked = 'checked="checked"';
			$done = true;
		}
		if($this->config->get('auto_submit_methods',1) && empty($method->ask_cc) && empty($method->custom_html) && empty($checked)){
			$checked.=' onclick="this.form.action=this.form.action+\'#hikashop_payment_methods\';this.form.submit(); return false;"';
		}
?>
					<input class="hikashop_checkout_payment_radio" id="radio_<?php echo $method->payment_type.'_'.$method->payment_id;?>" type="radio" name="hikashop_payment" value="<?php echo $method->payment_type.'_'.$method->payment_id;?>" <?php echo $checked; ?> />
					<label class="btn btn-radio" for="radio_<?php echo $method->payment_type.'_'.$method->payment_id;?>"><?php echo $method->payment_name;?></label>
					<span class="hikashop_checkout_payment_cost">
<?php
	if($method->payment_price != "0")
		echo $this->currencyHelper->format($method->payment_price,$this->full_total->prices[0]->price_currency_id);
	else
		echo JText::_('FREE_PAYMENT');
?>
					</span>
					<span class="hikashop_checkout_payment_image">
<?php
				if(!empty($method->payment_images)){
					$images = explode(',',$method->payment_images);
					if(!empty($images)){
						foreach($images as $image){
							if(!empty($this->images_payment[$image])){
?>
						<img src="<?php echo HIKASHOP_IMAGES .'payment/'. $this->images_payment[$image];?>" alt=""/>
<?php
							}
						}
					}
				}
?>
					</span>
					<div class="hikashop_checkout_payment_description"><?php echo $method->payment_description;?></div>
<?php
		$this->method =& $method;
		$this->setLayout('ccinfo');
		echo $this->loadTemplate();
?>
<?php
	}
?>
<script>
(function($){
	jQuery("#hikashop_payment_methods .hika-radio input[checked=checked]").each(function() {
		jQuery("label[for=" + jQuery(this).attr('id') + "]").addClass('active btn-primary');
	});
	jQuery("#hikashop_payment_methods .hika-radio input").change(function() {
		jQuery(this).parents('div.hika-radio').find('label.active').removeClass('active btn-primary');
		jQuery("label[for=" + jQuery(this).attr('id') + "]").addClass('active btn-primary');
	});
})(jQuery);
</script>
<?php
	}
?>
</div>
	</fieldset>
</div>
</section>
<?php
	}
}

