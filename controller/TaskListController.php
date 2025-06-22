<?php

class TaskList extends Controller
{
    private function currentUserId(): ?int
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return $_SESSION['user_id'] ?? null;
    }

    public function todoList()
    {
        $uid     = $this->currentUserId();
        $model   = $this->loadModel('ListModel');
        // $todos   = $model->getAllTodos($uid);
        // $folders = $model->getAllFolders($uid);

        $this->loadView('halaman-list.php', ['userId' => $uid]);
    }

    public function listByFolder()
    {
        $folder_id = $_GET['folder_id'] ?? 0;
        $uid       = $this->currentUserId();

        $model   = $this->loadModel('ListModel');
        // $todos   = $model->getTodosByFolder($uid, $folder_id);
        // $folders = $model->getAllFolders($uid);

        $this->loadView('halaman-list.php', ['userId' => $uid]);
    }

 
}
