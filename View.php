<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/25/2015
 * Time: 11:36 AM
 */
class View
{
    private $pageMessages;
    private $formData;
    private $error;

    public function __construct() {
        $this->pageMessages = array();
    }

    public function render($pageMessages, $error) {
        $this->pageMessages = $pageMessages;
        $this->error = $error;
        $this->renderHeader();
        $this->renderMessages();
        $this->renderPagination();
        $this->renderFooter();
    }

    public function renderOnlyForm() 
    {
        $this->renderForm();
        $this->backlink();
    }
    public function renderTaskPage($task_data,$comments)
    {
        $this->renderOneTask($task_data);
        $this->renderStatusForm($task_data);
        $this->renderComments($comments);
        $this->renderCommentForm();
        $this->backlink();
    }    

    private function renderHeader() {
        echo '<!DOCTYPE html><head><title>Страница ' . $this->pageNumber .'</title>
         <link href="style.css" rel="stylesheet">
         </head><body><h1>Tasks list</h1>
         <a href=new_task.php>Add new task</a>';
    }

    private function renderMessages() {
       echo'
 <div class="layout">
   <div class="col1">';
        echo'TODO<hr/>';
        foreach ($this->pageMessages as $message) {
          if($message['status'] == 'TODO') {
              echo '<p>Task: <a href="task_page.php?task='.$message['id'].'">' . $message['name'] . '</a><br> Discription: ' . $message['discription'] . '<br>';
              echo 'Created date:' . $message['created'] . '<br>';
              echo $message['comments'].' commsents</p>';
              echo '<hr/>';
          }
        }
        echo'</div>
   <div class="col2">';
        echo'DOING<hr/>';
        foreach ($this->pageMessages as $message) {
            if($message['status'] == 'DOING') {
                echo '<p>Task: <a href="task_page.php?task='.$message['id'].'">' . $message['name'] . '</a><br> Discription: ' . $message['discription'] . '<br>';
                echo 'Created date:' . $message['created'] . '<br>';
                echo $message['comments'].' commsents</p>';
                echo '<hr/>';
            }
        }
        echo '</div>
   <div class="col3">';
        echo'DONE<hr/>';
        foreach ($this->pageMessages as $message) {
            if($message['status'] == 'DONE') {
                echo '<p>Task: <a href="task_page.php?task='.$message['id'].'">' . $message['name'] . '</a><br> Discription: ' . $message['discription'] . '<br>';
                echo 'Created date:' . $message['created'] . '<br>';
                echo $message['comments'].' commsents</p>';
                echo '<hr/>';
            }
        }
        echo '</div>
  </div>';
    }

    private function renderFooter() {
        echo '</body></html>';
    }

    private function renderForm() {
        if ($this->error)
            echo '<div>ПРИ ВВОДЕ ДОПУЩЕНЫ ОШИБКИ:<br/>' . $this->error . '</div>';
        echo
        '<div><form method="post" action="new_task.php">
            Task name<br/><input type="text" size="20" maxlength="20" name="name" value="' . $this->formData['name'] .'"><br/>
            Task discription<br/><textarea name="discription" cols="50" rows="10">' . $this->formData['discription'] .'</textarea><br/>
            Task status(Please enter TODO,DOING or DONE)<br/><input type="text" size="20" maxlength="20" name="status" value="' . $this->formData['status'] .'"><br/><br/>
            <input type="submit" value="Send">
            </form>
        </div>';
    }
    private function backlink() {
        echo '<a href="index.php"> Go to tasks</a>';
    }

    private function renderOneTask($task_data)
    {
        echo '<p>Task: '.$task_data['name'].'<br>
         Discription: ' . $task_data['discription'] . '<br>';
        echo 'Created date:' . $task_data['created'] . '</p>';
//        var_dump($_COOKIE['task']);
    }

    private function renderStatusForm($task_data)
    {
       echo'<div><form method="post" action="task_page.php">
             Task status(Please enter TODO,DOING or DONE)<br/><input type="text" size="20" maxlength="20" name="status" value="' . $task_data['status'] .'"><br><br>
             <input type="hidden" size="20" maxlength="20" name="task" value="' . $_GET['task'].'">
    <input type="submit" value="Update">
    </form>
    </div>';
    }

    private function renderCommentForm()
    {
        echo'<br><br><h2>Add new comment</h2>
            <div><form method="post" action="task_page.php">
            Your name<br/><input type="text" size="20" maxlength="20" name="author"><br/>
            Enter your comment<br/><textarea name="comment_body" cols="50" rows="10"></textarea><br/>
            <input type="hidden" size="20" maxlength="20" name="task" value="' . $_GET['task'].'">
            <br/>
            <input type="submit" value="Send">
            </form>
        </div>';
    }
    
    private function renderComments($comments)
    {
        echo '<h2>Comments</h2>';
        foreach ($comments as $comment) {
                echo '<p>' . $comment['author'] . '<br>  ' . $comment['body'] . '<br>';
                echo '</p>';
                echo '<hr/>';
        }
    }
}