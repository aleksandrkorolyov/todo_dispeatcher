<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/25/2015
 * Time: 11:33 AM
 */
class Model
{
    private $messagesArray;
    private $messagesAmount;
    private $pageMessages;
    private $pageNumber;
    private $formData;
    private $error;

    public function __construct($action)
    {
        $this->messagesArray = array();
        $this->messagesAmount = 0;
        $this->action = $action;
        $this->messagesPerPage = 1;
        $this->pagesAmount = 1;
        $this->pageMessages = array();
        $this->pageNumber = 1;
        $this->formData['name'] = '';
        $this->formData['discription'] = '';
        $this->formData['status'] = '';
        $this->error = '';
    }

    public function run($pageNumber = 1)
    {
        $this->read();
    }

    public function add_task()
    {
        $this->write();
    }

    public function getPageTask()
    {
        return $this->one_task;
    }

    public function getPageMessages()
    {
        return $this->pageMessages;
    }

    public function getPagesAmount()
    {
        return $this->pagesAmount;
    }

    public function getError()
    {//получить сообщение при ошибке во введенных в форму данных
        return $this->error;
    }

    private function read()
    {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=test_base;charset=utf8", 'root', '1234');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM tasks ORDER BY created DESC ";

            $result = $pdo->query($query, PDO::FETCH_ASSOC);
            $this->pageMessages = $result->fetchAll();
            $tasks = $this->pageMessages;
            $i=0;
            while ($tasks[$i])
            {
                $queryCom = "SELECT count(*) FROM comments WHERE belong_to =".$tasks[$i]['id'];
                $result = $pdo->query($queryCom, PDO::FETCH_NUM);//выполняет запрос
                $row = $result->fetch();//извлекаем строку
                $tasks[$i]['comments'] = $row[0];
                $i++;
            }
            $this->pageMessages = $tasks;
            $pdo = NULL;
        } catch (PDOException $e) {
            echo $e->getMessage();
        };
    }
    
    public function read_one($task) 
    {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=test_base;charset=utf8", 'root', '1234');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM tasks WHERE id = ".$task;

            $result = $pdo->query($query, PDO::FETCH_ASSOC);
            $this->one_task = $result->fetch();
            $pdo = NULL;
        } catch (PDOException $e) {
            echo $e->getMessage();
        };
    }

    private function write()
    {
        $this->validate('name', array(2, 20));
        $this->validate('discription', array(1, 2000));
        $this->validate('status', array(2, 20));
        if ($this->error) return;
        $name = $this->formData['name'];
        $discription = $this->formData['discription'];
        $status = $this->formData['status'];
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=test_base;charset=utf8", 'root', '1234');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $exec = "INSERT into tasks set name='$name', discription='$discription', status='$status'";
            var_dump($exec);
            $result = $pdo->exec($exec);
            $pdo = NULL;
        } catch (PDOException $e) {
            echo $e->getMessage();
        };

        header('Location: http://' . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME']);
        exit();
    }

    private function validate($key, array $length)
    {//$key - ключ массива $_GET, $length - допустимая длина [min, max]
        if (!empty($_POST[$key])) $this->formData[$key] = $_POST[$key];
        $this->formData[$key] = trim($this->formData[$key]);
        $len = mb_strlen($this->formData[$key]);
        if ($len < $length[0] | $len > $length[1])
            $this->error .= 'Длина текста в поле ' . $key . ' должна быть от ' . $length[0] . ' до ' . $length[1] . ' символов<br/>';
        $this->formData[$key] = str_replace("\t", ' ', $this->formData[$key]);
        $this->formData[$key] = str_replace(array("\r\n", "\n\r", "\r", "\n"), '<br/>', $this->formData[$key]);
        $this->formData[$key] = htmlspecialchars($this->formData[$key], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    public function changeStatus($new_status,$task)
    {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=test_base;charset=utf8", 'root', '1234');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "UPDATE tasks SET status = '$new_status' WHERE id = '$task'";

            $pdo->query($query, PDO::FETCH_ASSOC);
            header('Location: http://' . $_SERVER['SERVER_NAME'] . '/taskbook/index.php');
            exit();
        } catch (PDOException $e) {
            echo $e->getMessage();
        };
    }
    public function addComment($author,$comment_body,$task)
    {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=test_base;charset=utf8", 'root', '1234');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "INSERT into comments set author='$author', body='$comment_body', belong_to='$task'";

            $pdo->query($query, PDO::FETCH_ASSOC);
            header('Location: http://' . $_SERVER['SERVER_NAME'] . '/taskkbook/task_page.php?task='.$task);
            exit();
        } catch (PDOException $e) {
            echo $e->getMessage();
        };
    }

    public function getTaskComments($task_id)
    {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=test_base;charset=utf8", 'root', '1234');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM comments WHERE belong_to = ".$task_id." ORDER BY id DESC ";

            $result = $pdo->query($query, PDO::FETCH_ASSOC);
            $comments = $result->fetchAll();
            return $comments;

            $pdo = NULL;
        } catch (PDOException $e) {
            echo $e->getMessage();
        };
    }
}