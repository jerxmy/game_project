let mysql = require("mysql");
let config = require("./config.json");

let con = mysql.createConnection({
  host: config.DB_HOST,
  user: config.DB_USERNAME,
  password: config.DB_PASSWORD,
  database: config.DB_NAME,
  port: config.DB_PORT,
});

con.connect(function (err) {
  if (err) throw err;
  console.log("Successfully connected to the database");
  let sql =
    "CREATE TABLE IF NOT EXISTS obstacle (id INT AUTO_INCREMENT PRIMARY KEY, amandes VARCHAR(255), quantity INT)";
  con.query(sql, function (err, result) {
    if (err) throw err;
    console.log("Table successfully created");
  });
});
