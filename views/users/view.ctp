<div class="actions">
	<ul>
		<li><?php echo $html->link('Studiengänge wählen', array('action'=>'setup', $user['User']['id'])) ?></li>
		<li><?php echo $html->link('Stundenplan', array('action'=>'timetable', $user['User']['id'])) ?></li>
		<li><?php echo $html->link('Abmelden', array('action'=>'logout')) ?></li>
	</ul>
	<p class="important">
		Achtung: Alle angaben ohne Gewähr oder Vollkasko-Versicherung! <?php echo $html->link('...mehr', '/pages/about') ?>
	</p>
	<p>
		Good news, everyone! If you like this service, feel free to donate beer to the <a href="mailto:bennigraf@gmail.com?Subject=I want to give beer">Benni Graf Foundation</a>.
	</p>
</div>

<div class="users view">
	<?php //debug($user) ?>
	<h1>Hi <?php echo $user['User']['name'] ?>! Hier sind deine Kurse:</h1>
	
	<div class="degreecols">
		<?php
		$colcounter = -1;
		foreach ($user['Degree'] as $degree):
			$colcounter++;
			if ($colcounter == 3) {
				echo '</div><div class="degreecols">';
				$colcounter = 0;
			}
			?>
			<div class="degreecol">
				<h2><?php echo $degree['name'] ?></h2>
				<ul><li class="action"><?php echo $html->link('Kurse bearbeiten', '/degrees/edit/'.$degree['id']) ?></li></ul>
				<!-- <ul><li class="action"><?php echo $html->link('Kurs hinzufügen', '/courses/addfordegree/'.$degree['id']) ?></li></ul> -->
				<h4>Pflicht&ndash;Kurse</h4>
				<ul>
				<?php
				if (empty($degree['Mustcourse'])) {
					?><li>Keine vorhanden&hellip;</li><?php
				}
				foreach ($degree['Mustcourse'] as $course) {
					echo '<li';
					if ($course['attend']==1) { echo ' class="attending"'; }
					echo '>';
					echo '<span class="actionlinks">';
					if($course['attend']==1) {
						echo $html->link(
									$html->image('icons/leave.png', array('alt'=>'Austreten')),
									'/users/leavecourse/'.$course['id'],
									array('escape'=>false, 'title'=>'Austreten'));
					} else {
						echo $html->link(
									$html->image('icons/add.png', array('alt'=>'Teilnehmen')),
									'/users/entercourse/'.$course['id'],
									array('escape'=>false, 'title'=>'Austreten'));
					}
					echo '</span>';
					echo $course['name'];
					echo '</li>';
				}
				?>
				</ul>
				
				<h4>Sonstige</h4>
				<ul>
				<?php
				if (empty($degree['Course'])) {
					?><li>Keine vorhanden&hellip;</li><?php
				}
				foreach ($degree['Course'] as $course) {
					echo '<li';
					if ($course['attend']==1) { echo ' class="attending"'; }
					echo '>';
					echo '<span class="actionlinks">';
					if($course['attend']==1) {
						echo $html->link(
									$html->image('icons/leave.png', array('alt'=>'Austreten')),
									'/users/leavecourse/'.$course['id'],
									array('escape'=>false, 'title'=>'Austreten'));
					} else {
						echo $html->link(
									$html->image('icons/add.png', array('alt'=>'Teilnehmen')),
									'/users/entercourse/'.$course['id'],
									array('escape'=>false, 'title'=>'Austreten'));
					}
					echo '</span>';
					echo $course['name'];
					echo '</li>';
				}
				?>
				</ul>
			</div>
		<?php
		endforeach; ?>
	</div>
</div>
