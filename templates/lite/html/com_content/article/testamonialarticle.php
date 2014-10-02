<?php
defined('_JEXEC') or die;
$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
$images = json_decode($this->item->images);
$metadata = json_decode($this->item->metadata);
?>
<div class="testamonial-article">
	<div class="panel-heading">
		<h3>
			<?php echo $this->item->title; ?> Testamonial
		</h3>
	</div>
	<div class="panel-body">
        	<p>
				<?php echo $this->item->text; ?>
            </p>
	</div>
</div>