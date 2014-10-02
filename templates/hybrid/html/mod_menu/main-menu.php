<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.
?>
<nav class="main-menu" id="enc-navbar-open">
			<div class="enc-navbar-header">
				<a class="enc-navbar-brand">God's Craftsman</a>
					<div class="enc-navbar-button">
						<a href="#enc-navbar-open">&#9776;</a>
						<a href="#">&#9776;</a>
					</div>
			</div>
			<div class="enc-navbar-collapse">
				<ul class="enc-nav">
<?php
foreach ($list as $i => &$item)
{
	echo '<li>';

	// Render the menu item.
	switch ($item->type) :
		case 'separator':
		case 'url':
		case 'component':
		case 'heading':
			require JModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
			break;

		default:
			require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
			break;
	endswitch;

	// The next item is deeper.
	if ($item->deeper)
	{
		echo '<ul class="nav-child unstyled small">';
	}
	elseif ($item->shallower)
	{
		// The next item is shallower.
		echo '</li>';
		echo str_repeat('</ul></li>', $item->level_diff);
	}
	else
	{
		// The next item is on the same level.
		echo '</li>';
	}
}
?>
				</ul>
			</div>
		</nav>