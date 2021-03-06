<?php
/**
*
* Description
*
* @package	VirtueMart
* @subpackage Shipment
* @author RickG
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: default.php 7918 2014-05-13 17:19:47Z Milbo $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

AdminUIHelper::startAdminArea($this);

?>

<form action="index.php" method="post" name="adminForm" id="adminForm">
	<div id="editcell">
		<table class="adminlist table" cellspacing="0" cellpadding="0">
		<thead>
		<tr>
			<th width="10">
				<input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this)" />
			</th>
			<th>
				<?php echo $this->sort('shipment_name', 'COM_VIRTUEMART_SHIPMENT_NAME_LBL'); ?>
			</th>
                        <th>
				<?php echo vmText::_('COM_VIRTUEMART_SHIPMENT_LIST_DESCRIPTION_LBL'); ?>
			</th>
                        <th width="20">
				<?php echo vmText::_('COM_VIRTUEMART_SHIPPING_SHOPPERGROUPS'); ?>
			</th>
                        <th>
				<?php echo $this->sort('shipment_element', 'COM_VIRTUEMART_SHIPMENTMETHOD'); ?>
			</th>
			<th>
				<?php echo $this->sort('ordering', 'COM_VIRTUEMART_LIST_ORDER'); ?>
			</th>
			<th width="20"><?php echo $this->sort('published', 'COM_VIRTUEMART_PUBLISHED'); ?></th>
			 <th><?php echo $this->sort('virtuemart_shipmentmethod_id', 'COM_VIRTUEMART_ID')  ?></th>
		</tr>
		</thead>
		<?php
		$k = 0;
		for ($i=0, $n=count( $this->shipments ); $i < $n; $i++) {
			$row = $this->shipments[$i];
			$published = JHtml::_('grid.published', $row, $i );
			/**
			 * @todo Add to database layout published column
			 */
			$row->published = 1;
			$checked = JHtml::_('grid.id', $i, $row->virtuemart_shipmentmethod_id);
			$editlink = JROUTE::_('index.php?option=com_virtuemart&view=shipmentmethod&task=edit&cid[]=' . $row->virtuemart_shipmentmethod_id);
			?>
			<tr class="row<?php echo $k ; ?>">
				<td width="10">
					<?php echo $checked; ?>
				</td>
				<td align="left">
					<?php echo JHtml::_('link', $editlink, vmText::_($row->shipment_name)); ?>
				</td>
                                <td align="left">
					<?php echo $row->shipment_desc; ?>
				</td>
                                <td>
					<?php echo $row->shipmentShoppersList; ?>
				</td>
                                <td align="left">
					<?php echo $row->shipment_element; //JHtml::_('link', $editlink, vmText::_($row->shipment_element)); ?>
				</td>
				<td align="left">
					<?php echo vmText::_($row->ordering); ?>
				</td>
				<td><?php echo $published; ?></td>
				<td align="center">
					<?php echo $row->virtuemart_shipmentmethod_id; ?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		<tfoot>
			<tr>
				<td colspan="10">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
	</table>
</div>

	<?php echo $this->addStandardHiddenToForm(); ?>
</form>



<?php AdminUIHelper::endAdminArea(); ?>