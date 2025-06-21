<?php

class Category extends Controller
{
    /** Ambil ID user yg login */
    private function currentUserId(): ?int
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return $_SESSION['user_id'] ?? null;
    }

    /* ====== READ ====== */
    public function index()
    {
        $uid = $this->currentUserId();
        $model = $this->loadModel('CategoryModel');
        $categories = $model->getAll($uid);
        $this->loadView('sidebar.php', ['categories' => $categories]);
    }

    /* ====== CREATE ====== */
    public function addCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
            $uid = $this->currentUserId();
            $model = $this->loadModel('CategoryModel');
            $model->create($uid, $_POST['name']);
            echo 'success';
            exit;
        }
    }

    /* ====== READ (kelola) ====== */
    public function manage_category()
    {
        $uid = $this->currentUserId();
        $model = $this->loadModel('CategoryModel');
        $categories = $model->getAll($uid);
        $this->loadView('manage.php', ['categories' => $categories]);
    }

    /* ====== UPDATE ====== */
    public function updateCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['name'])) {
            $uid = $this->currentUserId();
            $model = $this->loadModel('CategoryModel');
            $model->update($uid, $_POST['id'], $_POST['name']);
            echo 'updated';
            exit;
        }
    }

    /* ====== DELETE ====== */
    public function deleteCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $uid = $this->currentUserId();
            $model = $this->loadModel('CategoryModel');
            $model->delete($uid, $_POST['id']);
            echo 'deleted';
            exit;
        }
    }
}
