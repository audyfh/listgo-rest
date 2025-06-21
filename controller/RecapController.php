<?php

class Recap extends Controller
{

    function currentUser()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return $_SESSION['user_id'] ?? null;
    }

    function todoRecap()
    {
        $uid   = $this->currentUser();  
        // $model = $this->loadModel('TodoModel');
        // $todayTodos = $model->getTodos($uid,0, true);
        // $allTodos = $model->getTodos($uid,0,false);
        $this->loadView('todorecap.php');
    }

    function todoDetailAll()
    {
        $uid   = $this->currentUser();  
        $model = $this->loadModel('TodoModel');
        // $allTodos = $model->getTodos($uid,0,false);
        $this->loadView('tododetail-all.php');
    }

    function todoDetailToday()
    {
        $uid   = $this->currentUser();  
        $model = $this->loadModel('TodoModel');
        // $todayTodos = $model->getTodos($uid,0, true);
        $this->loadView('tododetail-today.php');
    }

    function todoDone()
    {
        $uid   = $this->currentUser();  
        $model = $this->loadModel('TodoModel');
        // $doneTodos = $model->getTodos($uid,1,false);
        $this->loadView('todo-done.php');
    }

    function toggleDone()
    {
        $id = $_GET['id'];
        $model = $this->loadModel('TodoModel');
        $model->toggleDone($id);
        header("Location: index.php?c=Recap&m=todoRecap");
        exit;
    }

    function deleteTodo()
    {
        $id = $_GET['id'];
        $model = $this->loadModel('TodoModel');
        $model->deleteTodo($id);
        header("Location: index.php?c=Recap&m=todoRecap");
        exit;
    }

    function downloadPDF()
    {
        $uid   = $this->currentUser();  
        require_once('./dompdf/autoload.inc.php');
        $dompdf = new \Dompdf\Dompdf();
        $model = $this->loadModel('TodoModel');

        $filter = $_GET['filter'];
        $filePath = 'view/pdf-todo.php';

        if (!file_exists($filePath)) {
            die("File not found.");
        }

        switch ($filter) {
            case 'done':
                $todos = $model->getTodos($uid,1,false);
                break;
            case 'all':
                $todos = $model->getTodos($uid,0,false);
                break;
            case 'today':
                $todos = $model->getTodos($uid,0, true);
                break;
            default:
                $todos = $model->getTodos($uid,0,false);
                break;
        }

        $statusLabel = ucfirst($filter);
        ob_start();
        include($filePath);
        $html = ob_get_clean();
        $options = $dompdf->getOptions();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf->setOptions($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("todo_report_{$filter}.pdf", array("Attachment" => true));
        exit;
    }
}
