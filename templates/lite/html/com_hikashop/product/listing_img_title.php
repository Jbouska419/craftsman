<?php
defined('_JEXEC') or die('Restricted access');
$link = hikashop_contentLink('product&task=show&cid='.$this->row->product_id.'&name='.$this->row->alias.$this->itemid.$this->category_pathway,$this->row);
$image_options = array('default' => true,'forcesize'=>$this->config->get('image_force_size',true),'scale'=>$this->config->get('image_scale_mode','inside'));
$img = $this->image->getThumbnail(@$this->row->file_path, array('width' => $this->image->main_thumbnail_x, 'height' => $this->image->main_thumbnail_y), $image_options);
?>
<div class="outer">
<div class="panel">
  <div class="panel-heading">
    <h2 class="panel-title">
   		<a href="<?php echo $link;?>">
        	<?php echo $this->row->product_name; ?>
        </a>
    </h2>
  </div>
  <div class="panel-body">
    <a href="<?php echo $link;?>">
    	<img src="<?php echo $img->url; ?>" />
    </a>
  </div>
  <ul class="list-group">
	<li class="list-group-item">
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