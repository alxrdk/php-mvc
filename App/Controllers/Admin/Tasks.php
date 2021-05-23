<?php

namespace App\Controllers\Admin;

use \App\Config;
use \Tamtamchik\SimpleFlash\Flash;

class Tasks extends \App\Controllers\Tasks
{
    use \App\Traits\Auth;

    protected function checkAuth()
    {
        if (!$this->isAuthorized()) {
            header('Location: /login');
            return false;
        }

        return true;
    }

    public function edit(array $params = [])
    {
        if ($this->checkAuth()) {
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
    }

    public function complite(array $params)
    {
        if ($this->checkAuth()) {
            $this->tasks()->complite($params['id'], $params['complited']);
            header('Location: /tasks' . $this->getRefererParams($params));
        }
    }

    public function delete(array $params)
    {
        if ($this->checkAuth()) {
            $this->tasks()->delete($params['id']);
            header('Location: /tasks' . $this->getRefererParams($params));
        }
    }

}