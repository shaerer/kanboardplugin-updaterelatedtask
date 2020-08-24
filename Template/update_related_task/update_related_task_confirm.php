<div class="page-header">
    <h2><?= t('Update related task') ?></h2>
</div>

<div class="confirm">
    <p class="alert alert-info">
        <?= t('Do you really want to update the related task: "%s"?', $this->text->e($task['title'])) ?>
    </p>

    <?= $this->modal->confirmButtons(
        'UpdateRelatedTaskController',
        'updateRelatedTask',
        array('plugin' => 'UpdateRelatedTaskButton', 'task_id' => $task['id'], 'project_id' => $task['project_id'])
    ) ?>
</div>