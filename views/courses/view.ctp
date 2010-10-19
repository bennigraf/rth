<div class="courses view">
<h2><?php  __('Course');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $course['Course']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $course['Course']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Course', true), array('action' => 'edit', $course['Course']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Course', true), array('action' => 'delete', $course['Course']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $course['Course']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Courses', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Participations', true), array('controller' => 'participations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Participation', true), array('controller' => 'participations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Degrees', true), array('controller' => 'degrees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Degree', true), array('controller' => 'degrees', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Participations');?></h3>
	<?php if (!empty($course['Participation'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Course Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($course['Participation'] as $participation):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $participation['id'];?></td>
			<td><?php echo $participation['course_id'];?></td>
			<td><?php echo $participation['user_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'participations', 'action' => 'view', $participation['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'participations', 'action' => 'edit', $participation['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'participations', 'action' => 'delete', $participation['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $participation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Participation', true), array('controller' => 'participations', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Degrees');?></h3>
	<?php if (!empty($course['Degree'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($course['Degree'] as $degree):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $degree['id'];?></td>
			<td><?php echo $degree['name'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'degrees', 'action' => 'view', $degree['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'degrees', 'action' => 'edit', $degree['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'degrees', 'action' => 'delete', $degree['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $degree['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Degree', true), array('controller' => 'degrees', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
