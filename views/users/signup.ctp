
<div class="actions">
	<ul>
		<li><?php echo $html->link('Zurück zur Anmeldung', array('action'=>'login')) ?></li>
	</ul>
	<p>
		Do <strong>not</strong> use your E-Mail-Adress and the password to that account here. <a href="http://xkcd.com/792/">Read this for more info.</a>
	</p>
</div>

<div class="view">
<?php
    echo $form->create('User', array('action' => 'signup'));
    echo $form->input('name');
    echo $form->input('password');
    echo $form->end('Registrieren');
?>
</div>