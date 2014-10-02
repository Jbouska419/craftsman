<?php
defined('_JEXEC') or die;
?>

<?php $leadingcount = 0; ?>

<?php if (!empty($this->lead_items)) : ?>
	<section id="testamonials">
		<?php foreach ($this->lead_items as &$item) : ?>
			<?php $this->item = & $item; ?>
			<article id="item">
				<?php echo $this->loadTemplate('item'); ?>
			</article>
		<?php endforeach; ?>
	</section>
<?php endif; ?>

<?php if (($this->params->def('show_pagination', 1) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
<?php echo $this->pagination->getPagesLinks(); ?> 
<?php endif; ?>