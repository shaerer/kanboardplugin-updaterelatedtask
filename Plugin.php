<?php

namespace Kanboard\Plugin\UpdateRelatedTaskButton;

use Kanboard\Core\Plugin\Base;
#use Kanboard\Core\Translator;
use Kanboard\Core\Security\Role;

class Plugin extends Base
{
    public function initialize()
    {
        $this->projectAccessMap->add('UpdateRelatedTaskController', array("confirm", "updateRelatedTask"), Role::PROJECT_MANAGER);
        $this->template->hook->attach('template:task:sidebar:actions', 'UpdateRelatedTaskButton:update_related_task/update_related_task_button');
    }

#ToDo
#    public function onStartup()
#    {
#        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
#    }

    public function getPluginName()
    {
        return 'Update Related Task Button';
    }

    public function getPluginDescription()
    {
        return t('Simple plugin which adds a button to update internally related `identical` tasks.');
    }

    public function getPluginAuthor()
    {
        return 'Stefan Haerer';
    }

    public function getPluginVersion()
    {
        return '0.0.1';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/shaerer/kanboard-update-related-task-plugin';
    }
}

