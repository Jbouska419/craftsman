<?php
defined('_JEXEC') or die;
$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
$images = json_decode($this->item->images);
$metadata = json_decode($this->item->metadata);
?>
<div class="panel">
	<div class="panel-heading">
		<div class="left">
			<h3><a href="<?php echo $link; ?>"><?php echo $this->item->title; ?></a></h3>
		</div>
		<div class="right">
			<h3><?php echo JHtml::_('date', $this->item->created, JText::_('m / d / Y')); ?></h3>
		</div>
	</div>
	<div class="panel-body">
    	<div class="left">
        	<a href="<?php echo $link; ?>">
            	<img src="<?php echo $images->image_intro; ?>" alt="<?php echo $images->image_intro_alt;?>" title="<?php echo $images->image_intro_caption;?>" />
            </a>
        </div>
        <div class="right">
        	<p><?php echo $this->item->metadesc; ?>...<a href="<?php echo $link; ?>">Read More</a></p>
        </div>
	</div>
</div>