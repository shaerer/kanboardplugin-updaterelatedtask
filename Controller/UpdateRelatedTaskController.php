<?php

namespace Kanboard\Plugin\UpdateRelatedTaskButton\Controller;

use Kanboard\Controller;
use Kanboard\Controller\BaseController;
use Kanboard\Core\Controller\AccessForbiddenException;

class UpdateRelatedTaskController extends BaseController
{
    public function confirm()
    {
        $task = $this->getTask();
        $user = $this->getUser();

//	if ($user['role'] == 'app-viewer']) {
//            throw new AccessForbiddenException();
//        }

        $this->response->html($this->template->render('UpdateRelatedTaskButton:update_related_task/update_related_task_confirm', array(
            'task' => $task,
            'user' => $user
        )));
    }

    public function updateRelatedTask()
    {
        $task = $this->getTask();
        $this->checkCSRFParam();


	$command = escapeshellcmd( "/home/kanboard/PythonEnv/mpm_mvv/bin/python /home/kanboard/PythonCode/UpdateRelatedTaskController.py" ) . ' ' . escapeshellarg( $task['id'] );
	$output = shell_exec($command);

        $this->flash->success(t($output));

        return $this->response->redirect($this->helper->url->to('TaskViewController', 'show', array('task_id' => $task['id'], 'project_id' => $task['project_id'])), true);
    }
}
