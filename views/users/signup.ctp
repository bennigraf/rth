
<div class="actions">
	<ul>
		<li><?php echo $html->link('Zurück zur Anmeldung', array('action'=>'login')) ?></li>
	</ul>
</div>

<div class="view">
<?php
    echo $form->create('User', array('action' => 'signup'));
    echo $form->input('name');
    echo $form->input('password');
    echo $form->end('Registrieren');
?>
</div>