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
        // $categories = $model->getAll($uid);
        $this->loadView('sidebar.php', ['userId' => $uid]);
    }


    /* ====== READ (kelola) ====== */
    public function manage_category()
    {
        $uid = $this->currentUserId();
        $model = $this->loadModel('CategoryModel');
        // $categories = $model->getAll($uid);
        $this->loadView('manage.php', ['userId' => $uid]);
    }


  
}
