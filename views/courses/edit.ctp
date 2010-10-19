<div class="courses form">
<?php echo $this->Form->create('Course');?>
	<fieldset>
 		<legend><?php __('Edit Course'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('Degree');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Course.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Course.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Courses', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Participations', true), array('controller' => 'participations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Participation', true), array('controller' => 'participations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Degrees', true), array('controller' => 'degrees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Degree', true), array('controller' => 'degrees', 'action' => 'add')); ?> </li>
	</ul>
</div>