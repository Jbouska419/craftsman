<?php
/**
 * @package     Joomla.Site
 * @subpackage  Template.Beez3
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

function renderMessage($msgList)
{
	$buffer  = null;

	if (is_array($msgList))
	{
		foreach ($msgList as $type => $msgs)
		{
			$buffer .= '<div class="alert alert-warning alert-dismissable">';
			$buffer .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
			if (count($msgs))
			{
				foreach ($msgs as $msg)
				{
					$buffer .= '<strong>Alert!</strong> ';
					$buffer .= $msg;
				}
			}
			$buffer .= '</div>';
		}

		return $buffer;
	}
}