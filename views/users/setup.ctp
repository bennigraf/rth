<div class="users setup">
	<h2><?php echo $user['User']['name'] ?></h2>
	<fieldset>
		<?php
		echo $form->create('User', array('action'=>'setup/'.$user['User']['id']));
		echo $form->input('id', array('type'=>'hidden', 'value'=>$user['User']['id']));
		echo $form->input('Degree', array('label'=>'Studiengang wählen', 'selected'=>$userDegrees, 'multiple'=>'checkbox'));
		?><p><em>&hellip;oder, falls dein Studiengang noch nicht in der Liste ist, &hellip;</em></p><?php
		echo $form->input('newdegree', array('label'=>'Neuen Studiengang erstellen'));
		?><p><em>(Bitte auf korrekte Schreibweise achten!)</em></p><?php
		echo $form->end('Speichern');
		?>
	</fieldset>
	
	
	
</div>
