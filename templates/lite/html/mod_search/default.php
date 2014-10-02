<?php 
defined('_JEXEC') or die; 
$search_input = '<input name="searchword" id="mod-search-searchword" class="form-control" type="text" placeholder="Search" onblur="if (this.value==\'\') this.value=\'' . $text . '\';" onfocus="if (this.value==\'' . $text . '\') this.value=\'\';" />';
?>
<form class="navbar-form" role="search" action="<?php echo JRoute::_('index.php');?>" method="post">
	<div class="input-group">
		<?php echo $search_input; ?>
			<div class="input-group-btn">
				<button class="btn" type="submit" onclick="this.form.searchword.focus();"><i class="glyphicon glyphicon-search"></i></button>
			</div>
	</div>
	<input type="hidden" name="task" value="search" />
	<input type="hidden" name="option" value="com_search" />
	<input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
</form>