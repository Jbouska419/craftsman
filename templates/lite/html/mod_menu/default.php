<?php
defined('_JEXEC') or die;
$config = JFactory::getConfig();
?>
<nav class="menu" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo $_SERVER[HTTP_HOST]; ?>">
				Brand
            </a>
		</div>
		<div class="collapse navbar-collapse" id="menu-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<?php
				foreach ($list as $i => &$item){
					if($item->id <> 101){
					echo '<li>';
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
			</ul>
		</div>
	</div>
</nav>