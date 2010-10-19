<div class="actions">
	<ul>
		<li><?php echo $html->link('Registrieren', array('action'=>'signup')) ?></li>
	</ul>
</div>

<div class="view">
<?php
	echo $session->flash('auth');
    echo $form->create('User', array('action' => 'login'));
    echo $form->input('name');
    echo $form->input('password');
    echo $form->end('Anmelden');
?>
</div>