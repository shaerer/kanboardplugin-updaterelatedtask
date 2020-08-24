<?php if ($task['is_active'] == 1): ?>
<li>
<?= $this->modal->confirm('clock-o', t('Update related Task'), 'UpdateRelatedTaskController', 'confirm', array('plugin' => 'UpdateRelatedTaskButton', 'task_id' => $task['id'], 'project_id' => $task['project_id'])) ?>
</li>
<?php endif ?>