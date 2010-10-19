<div class="actions">
	<ul>
		<li><?php echo $html->link('Zurück', '/degrees/edit/'.$degree['Degree']['id']) ?></li>
	</ul>
</div>

<div class="view">
	<h3>Kurs hinzufügen zu <?php echo $degree['Degree']['name'] ?></h3>
	<fieldset>
		<?php
		echo $form->create('Course', array('action'=>'addfordegree/'.$degree['Degree']['id']));
		echo $form->input('Degree', array('type'=>'hidden', 'value'=>$degree['Degree']['id']));
		if (!empty($unlinkedCourses)) {
			echo $form->input('Course.id', array('type'=>'select', 'options'=>$unlinkedCourses, 'empty'=>'Auswählen', 'label'=>'Existierenden Kurs auswählen'));
			echo '<p>&hellip;oder&hellip;</p>';
		}
		echo $form->input('Course.name', array('label'=>'Kurs anlegen'));
		echo $form->input('CoursesDegree.must', array('type'=>'checkbox', 'label'=>'Pflichtkurs'));
		echo $form->end('Speichern');
		?>
	</fieldset>
</div>
