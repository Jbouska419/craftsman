<?php
defined('_JEXEC') or die('Restricted access');
$image = reset($this->element->images);	
$product_thumbnail = 'media/com_hikashop/upload/thumbnails/100x100f/'.$image->file_path;
$product_image = 'media/com_hikashop/upload/'.$image->file_path;
?>
<a href="<?php echo $product_image; ?>" data-lightbox="<?php echo $this->element->product_name; ?>" data-title="<?php echo $this->element->product_name; ?>">
	<img src="<?php echo $product_thumbnail; ?>" class="center-block" alt="<?php echo $this->element->product_name; ?>" />
</a>