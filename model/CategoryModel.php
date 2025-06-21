<?php

class CategoryModel extends Model
{
    /* --- SELECT semua folder milik user --- */
    public function getAll(int $user_id): array
    {
        $stmt = $this->db->prepare(
            'SELECT id, name, created_at
             FROM folders
             WHERE user_id = ?
             ORDER BY created_at DESC'
        );
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $data;
    }

    /* --- INSERT folder baru --- */
    public function create(int $user_id, string $name): void
    {
        $stmt = $this->db->prepare(
            'INSERT INTO folders (user_id, name) VALUES (?, ?)'
        );
        $stmt->bind_param('is', $user_id, $name);
        $stmt->execute();
        $stmt->close();
    }

    /* --- UPDATE nama folder (hanya milik user) --- */
    public function update(int $user_id, int $id, string $name): void
    {
        $stmt = $this->db->prepare(
            'UPDATE folders SET name = ?
             WHERE id = ? AND user_id = ?'
        );
        $stmt->bind_param('sii', $name, $id, $user_id);
        $stmt->execute();
        $stmt->close();
    }

    /* --- DELETE folder (hanya milik user) --- */
    public function delete(int $user_id, int $id): void
    {
        $stmt = $this->db->prepare(
            'DELETE FROM folders
             WHERE id = ? AND user_id = ?'
        );
        $stmt->bind_param('ii', $id, $user_id);
        $stmt->execute();
        $stmt->close();
    }
}
