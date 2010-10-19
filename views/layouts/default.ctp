<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>rth: <?php echo $title_for_layout ?></title>
	<!-- Include external files and scripts here (See HTML helper for more info.) -->
	<?php echo $scripts_for_layout ?>
	<?php echo $html->css('screen'); ?>
</head>
<body>

	<div id="header">
		<h1>rth, dude!</h1>
	</div>
	

	<div id="content">
		<?php echo $content_for_layout ?>
	</div>
	
	<div id="footer">
		<p>This is... wait for it... awesome!</p>
	</div>
	
	<?php echo $this->element('sql_dump'); ?>

	<?php echo $javascript->link('jquery-1.4.3.min'); ?>
	<?php echo $javascript->link('domscript'); ?>
	<script type="text/javascript">
		// jQuery(dom_init);
	</script>
	
</body>
</html>