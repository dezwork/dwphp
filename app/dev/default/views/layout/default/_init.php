<?php

/**
 * @Author: Cleberson Bieleski
 * @Date:   2017-12-23 04:54:45
 * @Last Modified by:   Cleberson Bieleski
 * @Last Modified time: 2018-01-14 10:16:30
 */
?>
<!DOCTYPE html>
<html>
		<head>
			<?=$html->head->printHead();?>
			<?=$html->getTagFilesLinks('start');?>
			<?=$html->getTagFilesScripts('start');?>
		</head>
		<body id="<?=$this->getNamePage()?>" class="anFF10">
				<?=$template->templateInclude('menu.php');?>
				<?=$template->templateInclude('header.php');?>
				<div class="container">
				    <div class="row">
						<? include $GLOBALS['f']->pageView;?>
				    </div>
				</div>
				<?=$this->includeModals();?>
				<?=$template->templateInclude('footer.php');?>
			<?=$html->getTagFilesLinks('end');?>
			<?=$html->getTagFilesScripts('end');?>
		</body>
</html>