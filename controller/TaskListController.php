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
        $todos   = $model->getAllTodos($uid);
        $folders = $model->getAllFolders($uid);

        $this->loadView('halaman-list.php', [
            'todos' => $todos,
            'folders' => $folders,
            'selected_folder_id' => null
        ]);
    }

    public function listByFolder()
    {
        $folder_id = $_GET['folder_id'] ?? 0;
        $uid       = $this->currentUserId();

        $model   = $this->loadModel('ListModel');
        $todos   = $model->getTodosByFolder($uid, $folder_id);
        $folders = $model->getAllFolders($uid);

        $this->loadView('halaman-list.php', [
            'todos' => $todos,
            'folders' => $folders,
            'selected_folder_id' => $folder_id
        ]);
    }

    public function add()
    {
        $folder_id = $_POST['folder_id'];
        $title     = $_POST['title'];
        $due_date  = $_POST['due_date'];
        $uid       = $this->currentUserId();

        $model = $this->loadModel('ListModel');
        $model->insert($uid, $folder_id, $title, $due_date);

        header("location:index.php?c=TaskList&m=listByFolder&folder_id=" . $folder_id);
        exit;
    }

    public function edit()
    {
        $id        = $_POST['id'];
        $title     = trim($_POST['title']);
        $due_date  = $_POST['due_date'];
        $uid       = $this->currentUserId();

        if (empty($title) || empty($due_date)) {
            die("Judul dan tanggal tidak boleh kosong.");
        }

        $model = $this->loadModel('ListModel');
        $model->update($uid, $id, $title, $due_date);

        if (!empty($_POST['folder_id'])) {
            header("location:index.php?c=TaskList&m=listByFolder&folder_id=" . $_POST['folder_id']);
        } else {
            header("location:index.php?c=TaskList&m=todoList");
        }
        exit;
    }

    public function toggleDone()
    {
        $id  = $_GET['id'];
        $uid = $this->currentUserId();
        $folder_id = $_GET['folder_id'] ?? 0;

        $model = $this->loadModel('ListModel');
        $model->toggleDone($uid, $id);

        header("Location: index.php?c=TaskList&m=listByFolder&folder_id=$folder_id");
        exit;
    }

    public function delete()
    {
        $id        = $_GET['id'];
        $folder_id = $_GET['folder_id'] ?? null;
        $uid       = $this->currentUserId();

        $model = $this->loadModel('ListModel');
        $model->delete($uid, $id);

        header("location:index.php?c=TaskList&m=listByFolder&folder_id=$folder_id");
        exit;
    }
}
