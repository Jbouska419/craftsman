<?php
defined('_JEXEC') or die;
$config = JFactory::getConfig();
?>
				<?php
				foreach ($list as $i => &$item){
					if($item->id <> 101){
					echo '<li class="right-link">';
					switch ($item->type) :
						case 'separator':
						case 'url':
						case 'component':
						case 'heading':
							require JModuleHelper::getLayoutPath('mod_menu', 'default_'.$item->type);
						break;	
						default:
							require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
						break;
					endswitch;
					if ($item->deeper){
						echo '<ul class="dropdown-menu">';
					}elseif ($item->shallower){
						echo '</li>';
						echo str_repeat('</ul></li>', $item->level_diff);
					} else {
						echo '</li>';
					}
					}
				}
				?>
				<li class="right-item">{loadposition search}</li>
        		<li class="right-item">{loadposition cart}</li>