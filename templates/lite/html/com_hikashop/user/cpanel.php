<?php
defined('_JEXEC') or die('Restricted access');
?>
<section id="user-cpanel">
<h1><?php echo JText::_('CUSTOMER_ACCOUNT');?></h1>
<div id="items">
<?php
foreach($this->buttons as $oneButton){
$url = hikashop_level($oneButton['level']) ? 'onclick="document.location.href=\''.$oneButton['link'].'\';"' : ''; 
?>
<div id="item">
<div class="panel">
<div class="panel-heading">
<h3 class="panel-title">
<a href="<?php echo hikashop_level($oneButton['level']) ? $oneButton['link'] : '#'; ?>">
<?php echo $oneButton['text']; ?>
</a>
</h3>
</div>
<div class="panel-body">
<a href="<?php echo hikashop_level($oneButton['level']) ? $oneButton['link'] : '#'; ?>">
<?php echo $oneButton['description']; ?>
</a>
</div>
</div>
</div>
<?php }	?>
</div>
</section>