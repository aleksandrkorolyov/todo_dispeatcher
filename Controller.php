<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/25/2015
 * Time: 11:30 AM
 */
class Controller
{
    private $model;
    private $view;

    public function run() {
        try {
            $this->model = new Model('read');
            $this->model->run();

            $this->view = new View();
            $this->view->render($this->model->getPageMessages(), $this->model->getError());//выводим страницу
        }
        catch(Exception $e) {
            echo 'ОШИБКА<br/>' . $e->getMessage();
        }
    }
    public function add() {
        try{
            
            $this->model = new Model();
            $this->model->add_task();

            $this->view = new View();
            $this->view->renderOnlyForm();
        }
        catch(Exception $e) {
            echo 'ОШИБКА ДОБАВЛЕНИЯ<br/>' . $e->getMessage();
        }

    }
    public function task($task) {
        try{
            $this->model = new Model();
            if (!empty($_POST['status']))
            $this->model->changeStatus($_POST['status'],$_POST['task']);
            if ((!empty($_POST['author']))&&(!empty($_POST['comment_body'])))
            $this->model->addComment($_POST['author'],$_POST['comment_body'],$_POST['task']);  
            
            $this->model->read_one($task);

            $this->view = new View();
            $this->view->renderTaskPage($this->model->getPageTask(),$this->model->getTaskComments($task));
        }
        catch(Exception $e) {
            echo 'ОШИБКА<br/>' . $e->getMessage();
        }

    }
}