<?php
defined('_JEXEC') or die('Restricted access');
if($this->identified){
	$config = hikashop_config();
	$address_selector = (int)$config->get('checkout_address_selector', 0);
?>

<section id="hikashop-address">
	<div id="left">
		<fieldset id="hikashop_checkout_billing_address">
    		<div class="panel">
  				<div class="panel-heading">
    				<h3 class="panel-title">
						<?php echo JText::_('HIKASHOP_BILLING_ADDRESS'); ?>
                    </h3>
  				</div>
  				<div class="panel-body">
					<?php
					if(empty($address_selector) || $address_selector == 0) {
						$this->type = 'billing';
						echo $this->loadTemplate('view');
					}else{
						$this->type = 'billing';
						echo $this->loadTemplate('select');
					}
					?>
  				</div>
			</div>
       	</fieldset>
    </div>
    <div id="right">
    	<?php
		if($this->has_shipping) {
		?>
        <fieldset id="hikashop_checkout_shipping_address">
    		<div class="panel">
  				<div class="panel-heading">
    				<h3 class="panel-title">
						<?php echo JText::_('HIKASHOP_SHIPPING_ADDRESS'); ?>
                    </h3>
  				</div>
  				<div class="panel-body">
					<?php
					$checked = '';
					$style = '';
					$override = false;
					foreach($this->currentShipping as $selectedMethod){
						if(!empty($selectedMethod) && method_exists($selectedMethod, 'getShippingAddress')) {
							$override = $selectedMethod->getShippingAddress();
						}
					}
					if(!empty($override)) {
						echo $override;
					}else if(!empty($address_selector)) {
						$this->type = 'shipping';
						echo $this->loadTemplate('select');
					}else{
						if($config->get('shipping_address_same_checkbox', 1)) {
							$onclick = 'return hikashopSameAddress(this.checked);';
								if($this->shipping_address==$this->billing_address){
									$checked = 'checked="checked" ';
									$style = ' style="display:none"';
									$nb_addresses = count(@$this->addresses);
									if($nb_addresses==1){
										$address = reset($this->addresses);
										$onclick='if(!this.checked) { hikashopEditAddress(document.getElementById(\'hikashop_checkout_shipping_address_edit_'.$address->address_id.'\'),1,false); } '.$onclick;
									}
								}
					?>
					<label for="same_address">
						<input <?php echo $checked; ?>type="checkbox" id="same_address" name="same_address" value="yes" alt="Same address" onclick="<?php echo $onclick; ?>" />
						<?php echo JText::_('SAME_AS_BILLING');?>
					</label>
					<?php
						}else{
							$style = '';
						}
					?>
					<div class="hikashop_checkout_shipping_div" id="hikashop_checkout_shipping_div" <?php echo $style;?>>
					<?php
						$this->type = 'shipping';
						echo $this->loadTemplate('view');
					}
		}
		?>
        </fieldset>
    </div>
</section>	
<?php
}else{
}
