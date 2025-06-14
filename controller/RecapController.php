<?php

class Recap extends Controller
{

    function todoRecap()
    {
        $model = $this->loadModel('TodoModel');
        $todayTodos = $model->getTodos(0, true);
        $allTodos = $model->getTodos(0);
        $this->loadView('todorecap.php', [
            'all' => $allTodos,
            'today' => $todayTodos
        ]);
    }

    function todoDetailAll()
    {
        $model = $this->loadModel('TodoModel');
        $allTodos = $model->getTodos(0);
        $this->loadView('tododetail-all.php', [
            'all' => $allTodos
        ]);
    }

    function todoDetailToday()
    {
        $model = $this->loadModel('TodoModel');
        $todayTodos = $model->getTodos(0, true);
        $this->loadView('tododetail-today.php', [
            'today' => $todayTodos
        ]);
    }

    function todoDone()
    {
        $model = $this->loadModel('TodoModel');
        $doneTodos = $model->getTodos(1);
        $this->loadView('todo-done.php', [
            'done' => $doneTodos
        ]);
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
                $todos = $model->getTodos(1);
                break;
            case 'all':
                $todos = $model->getTodos(0);
                break;
            case 'today':
                $todos = $model->getTodos(0, true);
                break;
            default:
                $todos = $model->getTodos(0);
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
