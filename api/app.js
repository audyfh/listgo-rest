const express = require("express");
const cors = require("cors");
const pool = require('./db');

const recapRoutes = require("./routes/recapRoutes");
const categoryRoutes = require("./routes/categoryRoute");
const listRoutes = require("./routes/listRoute");

const app = express();
const port = 8000;

app.use(express.json());
app.use(cors());

app.use("/api/category", categoryRoutes);

app.use("/api/recap", recapRoutes);

app.listen(port, () => {
  console.log(`App is running at port: ${port}`);
});
