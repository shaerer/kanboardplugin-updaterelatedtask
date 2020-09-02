<div class="page-header">
    <h2><?= t('Verbundene Karte(n) updaten') ?></h2>
</div>

<div class="confirm">
    <p class="alert alert-info">
        <?= t('Wollen Sie wirklich alle mit "updatet" verbundenen Karten von "%s" überschreiben? (Im Zweifel bitte abbrechen und interne Links überprüfen)', $this->text->e($task['title'])) ?>
    </p>

    <?= $this->modal->confirmButtons(
        'UpdateRelatedTaskController',
        'updateRelatedTask',
        array('plugin' => 'UpdateRelatedTaskButton', 'task_id' => $task['id'], 'project_id' => $task['project_id'])
    ) ?>
</div>
