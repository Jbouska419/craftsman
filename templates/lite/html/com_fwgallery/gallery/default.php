<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<section id="gallery">
	<h1><?php echo $this->obj->name; ?></h1>
	<div id="items">
		<?php
		foreach ($this->list as $row) {
		?>
        <div id="item">
        <?php
			$this->row = $row;
			echo $this->loadTemplate('item');
		?>
        </div>
		<?php
		}
		?>
    </div>
</section>