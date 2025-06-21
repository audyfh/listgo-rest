const express = require("express");
const router = express.Router();
const db = require("../db");

// GET semua folder milik user
router.get("/:userId", async (req, res) => {
  const { userId } = req.params;
  const [rows] = await db.execute(
    "SELECT id, name, created_at FROM folders WHERE user_id = ? ORDER BY created_at DESC",
    [userId]
  );
  res.json(rows);
});

// POST buat folder baru
router.post("/", async (req, res) => {
  const { user_id, name } = req.body;
  await db.execute("INSERT INTO folders (user_id, name) VALUES (?, ?)", [user_id, name]);
  res.json({ success: true });
});

// PUT update folder
router.put("/", async (req, res) => {
  const { user_id, id, name } = req.body;
  await db.execute("UPDATE folders SET name = ? WHERE id = ? AND user_id = ?", [name, id, user_id]);
  res.json({ success: true });
});

// DELETE folder
router.delete("/", async (req, res) => {
  const { user_id, id } = req.body;
  await db.execute("DELETE FROM folders WHERE id = ? AND user_id = ?", [id, user_id]);
  res.json({ success: true });
});

module.exports = router;
