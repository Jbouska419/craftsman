<?php
defined('_JEXEC') or die;
$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
$images = json_decode($this->item->images);
$metadata = json_decode($this->item->metadata);
?>
<div class="panel">
	<div class="panel-heading">
		<h3>
			<a href="<?php echo $link; ?>">
				<?php echo $this->item->title; ?>
			</a>
		</h3>
	</div>
	<div class="panel-body">
        	<p>
				<?php echo $this->item->metadesc; ?>...
                <a href="<?php echo $link; ?>">
                	Read More
                </a>
            </p>
	</div>
</div>