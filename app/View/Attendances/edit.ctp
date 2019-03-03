<div class="attendances form">
<?php echo $this->Form->create('Attendance'); ?>
	<fieldset>
		<legend><?php echo __('Edit Attendance'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('student_id');
		echo $this->Form->input('instructor_id');
		echo $this->Form->input('status');
		echo $this->Form->input('note');
		echo $this->Form->input('deleted_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Attendance.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Attendance.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Attendances'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Students'), array('controller' => 'students', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student'), array('controller' => 'students', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Instructors'), array('controller' => 'instructors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instructor'), array('controller' => 'instructors', 'action' => 'add')); ?> </li>
	</ul>
</div>
