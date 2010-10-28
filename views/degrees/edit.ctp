<div class="actions">
	<ul>
		<li><?php echo $html->link('Zurück zur Übersicht', '/users/view') ?></li>
		<!-- <li><?php echo $this->Html->link('Löschen', array('action' => 'delete') ); ?></li> -->
	</ul>
	<p>
		Achtung: Alle hier gemachten Änderungen gelten für <strong>alle</strong> Benutzer! Not alone, you are. Act wise you must, young master...
	</p>
</div>

<div class="view form">
	<h3>Kurse bearbeiten:</h3>
	<div class="degreecol">
		<h2><?php echo $degree['Degree']['name'] ?></h2>
		<ul><li class="action"><?php echo $html->link('Kurs hinzufügen', '/courses/addfordegree/'.$degree['Degree']['id']) ?></li></ul>

		<h4>Pflicht&ndash;Kurse</h4>
		<ul>
		<?php
		if (empty($degree['Mustcourse'])) {
			?><li class="none">Keine vorhanden&hellip;</li><?php
		}
		foreach ($degree['Mustcourse'] as $course) {
			echo '<li>';
			echo '<span class="actionlinks">';
			echo $html->link(
						$html->image('icons/down.png', array('alt'=>'Freiwilling')), 
						'/courses/freewilly/'.$course['id'].'/'.$degree['Degree']['id'],
						array('escape'=>false, 'title'=>'Freiwillig')).' ';
			echo $html->link(
						$html->image('icons/edit.png', array('alt'=>'Bearbeiten')),
						'/courses/edit/'.$course['id'].'/'.$degree['Degree']['id'],
						array('escape'=>false, 'title'=>'Umbenennen')).' ';
			echo $html->link(
						$html->image('icons/remove.png', array('alt'=>'Löschen')),
						'/degrees/delcourse/'.$degree['Degree']['id'].'/'.$course['id'],
						array('escape'=>false, 'title'=>'Aus dem Studiengang werfen'));
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
			?><li class="none">Keine vorhanden&hellip;</li><?php
		}
		foreach ($degree['Course'] as $course) {
			echo '<li>';
			echo '<span class="actionlinks">';
			echo $html->link(
						$html->image('icons/up.png', array('alt'=>'Pflicht')), 
						'/courses/makemust/'.$course['id'].'/'.$degree['Degree']['id'],
						array('escape'=>false, 'title'=>'Pflicht')).' ';
			echo $html->link(
						$html->image('icons/edit.png', array('alt'=>'Bearbeiten')),
						'/courses/edit/'.$course['id'].'/'.$degree['Degree']['id'],
						array('escape'=>false, 'title'=>'Umbenennen')).' ';
			echo $html->link(
						$html->image('icons/remove.png', array('alt'=>'Löschen')),
						'/degrees/delcourse/'.$degree['Degree']['id'].'/'.$course['id'],
						array('escape'=>false, 'title'=>'Aus dem Studiengang werfen'));
			echo '</span>';
			echo $course['name'];
			echo '</li>';
		}
		?>
		</ul>
	</div>
</div>
