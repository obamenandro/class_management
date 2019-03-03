<div class="attendances view">
<h2><?php echo __('Attendance'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($attendance['Attendance']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Student'); ?></dt>
		<dd>
			<?php echo $this->Html->link($attendance['Student']['id'], array('controller' => 'students', 'action' => 'view', $attendance['Student']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Instructor'); ?></dt>
		<dd>
			<?php echo $this->Html->link($attendance['Instructor']['id'], array('controller' => 'instructors', 'action' => 'view', $attendance['Instructor']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($attendance['Attendance']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Note'); ?></dt>
		<dd>
			<?php echo h($attendance['Attendance']['note']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted Date'); ?></dt>
		<dd>
			<?php echo h($attendance['Attendance']['deleted_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($attendance['Attendance']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($attendance['Attendance']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Attendance'), array('action' => 'edit', $attendance['Attendance']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Attendance'), array('action' => 'delete', $attendance['Attendance']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $attendance['Attendance']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendances'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendance'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Students'), array('controller' => 'students', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student'), array('controller' => 'students', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Instructors'), array('controller' => 'instructors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instructor'), array('controller' => 'instructors', 'action' => 'add')); ?> </li>
	</ul>
</div>
