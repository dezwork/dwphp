<?php

/**
 * @Author: Cleberson Bieleski
 * @Date:   2017-12-23 04:54:45
 * @Last Modified by:   Cleberson Bieleski
 * @Last Modified time: 2018-01-12 12:00:21
 */
?>

<?
	if(isset($GLOBALS['f']->controller)){
		$this->controller=$GLOBALS['f']->controller;
	}
?>
<div class="blog-masthead">
  <div class="container">
    <nav class="nav blog-nav">
	<a class="nav-link" href="#">Inicial</a>

	<?
		if(isset($this->controller->content)){
			foreach ($this->controller->content as $result) {
	?>
			<a class="nav-link" href="#<?=$result['url']?>"><?=$result['title']?></a>
	<? }
		}
	?>
    </nav>
  </div>
</div>