const express = require("express");
const router = express.Router();
const db = require("../db");

// GET semua todo berdasarkan folder_id dan user_id
router.get("/:userId/:folderId", async (req, res) => {
  const { userId, folderId } = req.params;
  const [rows] = await db.execute(
    `SELECT id, title, is_done, due_date, created_at, updated_at
     FROM todos
     WHERE user_id = ? AND folder_id = ?
     ORDER BY created_at DESC`,
    [userId, folderId]
  );
  res.json(rows);
});

// POST todo baru
router.post("/", async (req, res) => {
  const { folder_id, user_id, title, due_date } = req.body;
  const [result] = await db.execute(
    `INSERT INTO todos (folder_id, user_id, title, due_date)
     VALUES (?, ?, ?, ?)`,
    [folder_id, user_id, title, due_date || null]
  );
  res.json({ success: true, id: result.insertId });
});

// PUT update todo
router.put("/", async (req, res) => {
  const { id, user_id, title, due_date } = req.body;
  await db.execute(
    `UPDATE todos SET title = ?, due_date = ? WHERE id = ? AND user_id = ?`,
    [title, due_date, id, user_id]
  );
  res.json({ success: true });
});

// DELETE todo
router.delete("/", async (req, res) => {
  const { id, user_id } = req.body;
  await db.execute(`DELETE FROM todos WHERE id = ? AND user_id = ?`, [
    id,
    user_id,
  ]);
  res.json({ success: true });
});

module.exports = router;
