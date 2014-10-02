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

<section class="hikashop-product-single">
	<div class="inner">
		<div class="panel-heading">
			<h2 class="panel-title">
				<?php echo $this->element->product_name; ?>
			</h2>
		</div>
		<div class="panel-body">
			<ul class="list-group">
            	<li class="list-group-item">
                			<?php
			$this->row = & $this->element;
			$this->setLayout('show_block_img');
			echo $this->loadTemplate();
			?>
            				<?php
				if($this->params->get('show_price')){
				$this->setLayout('listing_price');
				echo $this->loadTemplate();
				}
				?>
                </li>
				<li class="list-group-item">
                				<?php
				if($this->params->get('add_to_cart') || $this->params->get('add_to_wishlist')){
				$this->setLayout('add_to_cart_listing');
				echo $this->loadTemplate();
				}
				?>
				</li>
			</ul>
		</div>
	</div>
</section>