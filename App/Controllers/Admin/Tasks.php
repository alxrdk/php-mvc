<?php

namespace App\Controllers\Admin;

use \App\Config;
use \Tamtamchik\SimpleFlash\Flash;

class Tasks extends \App\Controllers\Tasks
{
    use \App\Traits\Admin;
    use \App\Traits\Auth;

    public function edit(array $params = []) : void
    {
        if (!empty($_POST)) {
            $errors = $this->validateTask();
            if (sizeof($errors) > 0) {
                $id = $_POST['id'] ?? null;

                $this->view('Admin\Edit',
                    [
                        'posted' => true,
                        'username' => $_POST['username'],
                        'email' => $_POST['email'],
                        'description' => $_POST['description'],
                        'complited' => $_POST['complited'],
                        'task' => $this->tasks()->getById($id),
                        'page' => $this->getCurrentPage($params, $this->tasks()->count()),
                        'order' => $this->getOrder($params),
                        'asc' => $this->getOrderAsc($params),
                        'errors' => $errors
                        ]
                );

            } else {

                $this->tasks()->edit($_POST['id'], $_POST['username'], $_POST['email'], $_POST['description'], !empty($_POST['complited']));

                $msg = new Flash();
                $msg->success('Task updated successfully!');
                header('Location: /tasks' . $this->getRefererParams($params));

            }

        } else {

            $id = $params['id'] ?? null;
            if (!empty($id))
                $this->view('Admin\Edit',
                    [
                        'posted' => false,
                        'task' => $this->tasks()->getById($id),
                        'page' => $this->getCurrentPage($params, $this->tasks()->count()),
                        'order' => $this->getOrder($params),
                        'asc' => $this->getOrderAsc($params)
                    ]
                );

            else {
                header('Location: /');
            }
        }
    }

    public function complite(array $params) : void
    {
        $this->tasks()->complite($params['id'], $params['complited']);
        header('Location: /tasks' . $this->getRefererParams($params));
    }

    public function delete(array $params) : void
    {
        $this->tasks()->delete($params['id']);
        $msg = new Flash();
        $msg->success('Task deleted successfully!');
        header('Location: /tasks' . $this->getRefererParams($params));
}

}