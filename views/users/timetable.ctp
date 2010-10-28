<div class="actions">
	<ul>
		<li><?php echo $html->link('Zurück zur Übersicht', array('action'=>'view', $user['User']['id'])) ?></li>
		<li><?php echo $html->link('.ics (iCal, etc)', array('action'=>'timetableics', $user['User']['id'], 'calendar.ics')) ?></li>
	</ul>
	<p>
		.ics muss heruntergeladen werden - Abonnieren funktioniert noch nicht!
	</p>
</div>

<div class="view timetable">
	<?php
	echo $this->element('timelegend');
	for ($weekday=1; $weekday < 7; $weekday++) { 
		$time = array('h'=>9, 'm'=>'0');
		?>
		<ul class="timecolumn">
			<li class="header"><?php echo strftime('%A', strtotime('1970-W01-'.$weekday) ) ?></li>
			<?php
			$levels = array();
			for ($slot=0; $slot < 49; $slot++) { 
				$timestr = $time['h'].':';
				if ($time['m']<15) { $timestr.='00'; } else { $timestr.=$time['m']; }

				echo '<li>';
				if (!empty($courses[$weekday]) && !empty($courses[$weekday][$timestr])) {
					
					for ($i=0; $i < 5; $i++) { 
						if (empty($levels[$slot][$i])) {
							$datelvl = $i;
							for ($j=0; $j < $courses[$weekday][$timestr]['Course']['duration']/15; $j++) { 
								$levels[$slot + $j][$i] = true;
							}
							break;
						}
					}
					
					$height = $courses[$weekday][$timestr]['Course']['duration'] / 15 * 19 - 2;
					?>
						<div class="date lvl<?php echo $datelvl ?>" style="height: <?php echo $height ?>px">
							<div><span><?php echo $courses[$weekday][$timestr]['Course']['name'] ?></span></div>
						</div>
					<?php
				}
				
				echo '&nbsp;</li>';

				$time['m'] = $time['m'] + 15;
				if ($time['m']==60) {
					$time['m'] = 0;
					$time['h']++;
				}
			}
			
			?>
		</ul>
		<?php
	}
	
	echo $this->element('timelegend', array('right'=>true));
	?>
</div>