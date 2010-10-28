<div class="actions">
	<ul>
		<li><?php echo $html->link('Zurück', $referer) ?></li>
	</ul>
</div>

<div class="view">
	<h3>Kurs bearbeiten</h3>
	<fieldset>
		<p>
			Achtung: Änderungen hier werden auf diesen Kurs generell angewendet - nicht nur für diesen Studiengang.
		</p>
		<?php
		echo $form->create('Course', array('action'=>'edit'));
		echo $form->input('id', array('type'=>'hidden', 'value'=>$course['Course']['id']));
		if (isset($degreeid)) {
			echo $form->input('degreeid', array('type'=>'hidden', 'value'=>$degreeid));
		}
		echo $form->input('name', array('value'=>$course['Course']['name']));
		
		echo '<fieldset>';
		echo $form->input('hasdate', array('type'=>'checkbox', 'label'=>'Termin', 'checked'=>$course['Course']['hasdate']));
		echo $form->input('weekday', array(
			'type'=>'select', 'label'=>'Am ', 'selected'=>$course['Course']['weekday'],
			'options'=>array(
				1=>'Montag', 2=>'Dienstag', 3=>'Mittwoch', 4=>'Donnerstag', 
				5=>'Freitag', 6=>'Samstag'
			)
		));
		echo $form->input('time', array('label'=>'Um (hh:mm, 24h)', 'value'=>$course['Course']['time']));
		echo $form->input('duration', array('type'=>'text', 'label'=>'Dauer (in Minuten)', 'value'=>$course['Course']['duration']));
		echo '</fieldset>';
		
		echo $form->end('Speichern');
		?>
	</fieldset>
</div>