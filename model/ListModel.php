<?php

class ListModel extends Model
{
    public function getAllFolders($user_id)
    {
        $sql = "SELECT * FROM folders WHERE user_id = $user_id ORDER BY created_at DESC";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllTodos($user_id)
    {
        $sql = "SELECT * FROM todos WHERE user_id = $user_id ORDER BY created_at DESC";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTodosByFolder($user_id, $folder_id)
    {
        $sql = "SELECT * FROM todos WHERE user_id = $user_id AND folder_id = $folder_id ORDER BY due_date ASC";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insert($user_id, $folder_id, $title, $due_date)
    {
        $sql = "INSERT INTO todos (user_id, folder_id, title, is_done, due_date) 
                VALUES ('$user_id', '$folder_id', '$title', 0, '$due_date')";
        return $this->db->query($sql);
    }

    public function update($user_id, $id, $title, $due_date)
    {
        $sql = "UPDATE todos 
                SET title = '$title', due_date = '$due_date' 
                WHERE id = $id AND user_id = $user_id";
        return $this->db->query($sql);
    }

    public function toggleDone($user_id, $id)
    {
        $sql = "UPDATE todos 
                SET is_done = NOT is_done 
                WHERE id = $id AND user_id = $user_id";
        return $this->db->query($sql);
    }

    public function delete($user_id, $id)
    {
        $sql = "DELETE FROM todos WHERE id = $id AND user_id = $user_id";
        return $this->db->query($sql);
    }
}
