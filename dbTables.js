let mysql = require("mysql");

let con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "migrationTest",
});

con.connect(function (err) {
  if (err) throw err;
  console.log("Successfully connected to the database");
  let sql =
    "CREATE TABLE IF NOT EXISTS frangipane (id INT AUTO_INCREMENT PRIMARY KEY, amandes VARCHAR(255), quantity INT)";
  con.query(sql, function (err, result) {
    if (err) throw err;
    console.log("Table successfully created");
  });

  sql =
    "CREATE TABLE IF NOT EXISTS frangipute (id INT AUTO_INCREMENT PRIMARY KEY, amandes VARCHAR(255), quantity INT)";
  con.query(sql, function (err, result) {
    if (err) throw err;
    console.log("Table successfully created");
  });
});
