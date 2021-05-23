<?php

namespace App\Controllers;

use \App\Config;
use \JasonGrimes\Paginator;
use \Tamtamchik\SimpleFlash\Flash;

class Tasks extends \App\Controller
{
    use \App\Traits\Auth;
    use \App\Traits\TasksModel;

    protected function getOrder(array $params)
    {
        $order = 'created';
        if (isset($params['order']) && in_array($params['order'], ['username', 'email', 'complited', 'created'])) {
            $order = $params['order'];
        }
        return $order;
    }

    protected function getOrderAsc(array $params)
    {
        return boolval($params['asc'] ?? 1);
    }

    protected function getCurrentPage(array $params, int $totalItems)
    {
        $page = $params['p'] ?? 1;
        if ($page <= 0)
            $page = 1;
        $maxPage = ceil($totalItems ? $totalItems : 1 / Config::ITEMS_PER_PAGE);
        return ($page > $maxPage) ? $maxPage : $page;
    }

    protected function getRefererParams(array $params) {
        return "?p=" . ($params['p'] ?? 1) . "&order=" . $this->getOrder($params) . "&asc=" . $this->getOrderAsc($params) ;
    }

    protected function getPaginator(array $params, int $totalItems, int $currentPage, string $urlPattern)
    {
        $itemsPerPage = Config::ITEMS_PER_PAGE;
        return new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
    }

    public function show(array $params, array $advancedParams = [])
    {
        $totalItems = $this->tasks()->count();
        $currentPage = $this->getCurrentPage($params, $totalItems);
        $orderField = $this->getOrder($params);
        $orderAsc = $this->getOrderAsc($params);
        $viewParams = [
            'tasks' => $this->tasks()->get(
                $orderField,
                $orderAsc,
                ($currentPage - 1) * Config::ITEMS_PER_PAGE,
                Config::ITEMS_PER_PAGE
            ),
            'paginator'=> $this->getPaginator($params, $totalItems, $currentPage, '/tasks?p=(:num)'),
            'page' => $currentPage,
            'order' => $orderField,
            'asc' => $orderAsc,
            'authorized' => $this->isAuthorized(),
            'msg' => new Flash()
        ] + $advancedParams;

        $this->view('Tasks', $viewParams);
    }

    protected function validateTask()
    {
        $errors = [];
        if (empty($_POST['username'])) {
            $errors[] = 'Empty username';
        }

        if (empty($_POST['email'])) {
            $errors[] = 'Empty email';
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email is not valid';
        }

        if (empty($_POST['description'])) {
            $errors[] = 'Empty description';
        }

        return $errors;
    }

    public function add(array $params)
    {
        $errors = $this->validateTask();
        if (sizeof($errors) > 0) {

            $this->show(
                $params,
                [
                    'username' => $_POST['username'],
                    'email' => $_POST['email'],
                    'description' => $_POST['description'],
                    'errors' => $errors
                ]
            );

        } else {
            $this->tasks()->add($_POST['username'], $_POST['email'], $_POST['description'], false);
            $msg = new Flash();
            $msg->success('Task added successfully!');
            header('Location: /');
        }
    }

}