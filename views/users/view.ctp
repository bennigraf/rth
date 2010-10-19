<div class="actions">
	<ul>
		<li><?php echo $html->link('Studiengänge wählen', array('action'=>'setup', $user['User']['id'])) ?></li>
		<li><?php echo $html->link('Abmelden', array('action'=>'logout')) ?></li>
	</ul>
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


<!--
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User', true), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete User', true), array('action' => 'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
-->