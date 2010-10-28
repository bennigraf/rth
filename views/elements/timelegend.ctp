<ul class="timecolumn legend <?php if(isset($right)) { echo 'right'; } ?>">
	<li>&nbsp;</li>
	<?php
	$time = array('h'=>9, 'm'=>'0');
	for ($slot=0; $slot < 49; $slot++) { 
		echo '<li>';
			echo $time['h'].':';
			if ($time['m']<15) { echo '00'; } else { echo $time['m']; }
		echo '</li>';
		$time['m'] = $time['m'] + 15;
		if ($time['m']==60) {
			$time['m'] = 0;
			$time['h']++;
		}
	}
	
	?>
</ul>