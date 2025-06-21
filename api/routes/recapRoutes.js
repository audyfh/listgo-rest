const express = require("express");
const router = express.Router();
const db = require("../db");

const getTodos = async (req, res) => {
  const { userId, isDone, todayOnly } = req.query;

  if (!userId || isDone === undefined) {
    return res
      .status(400)
      .json({ error: "Missing required parameters: userId or isDone" });
  }

  try {
    let query = `SELECT * FROM todos WHERE user_id = ? AND is_done = ?`;
    const queryParams = [parseInt(userId), parseInt(isDone)];

    if (todayOnly === "true") {
      query += ` AND due_date = CURDATE()`;
    }
    query += ` ORDER BY due_date ASC`;
    const [rows] = await db.query(query, queryParams);
    res.status(200).json(rows);
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
  
};

const toggleDone = async (req, res) => {
  const { id } = req.params;

  try {
    const query = `UPDATE todos SET is_done = NOT is_done WHERE id = ?`;
    await db.query(query, [parseInt(id)]);
    res.status(200).json(true);
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
  
};

const deleteTodo = async (req, res) => {
  const { id } = req.params;

  try {
    const query = `DELETE FROM todos WHERE id = ?`;
    await db.query(query, [parseInt(id)]);

    res.status(200).json(true);
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
  
};

router.get("/todos", getTodos);
router.patch("/toggle/:id", toggleDone);
router.delete("/delete/:id", deleteTodo);

module.exports = router;
