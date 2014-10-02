<?php
/**
 * FW Gallery 3.0
 * @copyright (C) 2014 Fastw3b
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.fastw3b.net/ Official website
 **/

defined( '_JEXEC' ) or die( 'Restricted access' );

$link = $this->params->get('hide_single_image_view')?(JURI::root(true).'/'.JFHelper::getFileFilename($this->row, '')):JRoute::_('index.php?option=com_fwgallery&view=image&id='.$this->row->id.':'.JFilterOutput :: stringURLSafe($this->row->name).'&Itemid='.JFHelper :: getItemid('image', $this->row->id, JRequest :: getInt('Itemid')).'#fwgallerytop');
$color_displayed = false;

$styles = array();
?>
<div class="panel">
  <div class="panel-body">
    <a href="<?php echo JURI::root(true).'/'.JFHelper::getFileFilename($this->row, ''); ?>" data-lightbox="<?php echo $this->obj->name; ?>" data-title="<?php echo htmlspecialchars($this->row->name); ?>">
		<img src="<?php echo JURI::root(true).'/'.JFHelper::getFileFilename($this->row, 'th'); ?>" />
	</a>
  </div>
</div>