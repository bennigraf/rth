<div class="actions">
	<ul>
		<li><?php echo $html->link('Zurück', $referer) ?></li>
	</ul>
</div>

<div class="view">
	<h3>Kurs bearbeiten</h3>
	<fieldset>
		<?php
		echo $form->create('Course', array('action'=>'edit'));
		echo $form->input('id', array('type'=>'hidden', 'value'=>$course['Course']['id']));
		if (isset($degreeid)) {
			echo $form->input('degreeid', array('type'=>'hidden', 'value'=>$degreeid));
		}
		echo $form->input('name', array('value'=>$course['Course']['name']));
		
		echo $form->end('Speichern');
		?>
	</fieldset>
</div>