const mysql = require("mysql");

let con = mysql.createConnection({
  host: "localHost",
  user: "root",
  password: "root",
  database: "migrationTest",
});

con.connect(function (err) {
  if (err) throw err;
  console.log("Connected");
  let querySooS =
    "CREATE TABLE IF NOT EXISTS obstacles(id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255), isDangerous BOOL, image VARCHAR(255))";
  con.query(querySooS, function (err, result) {
    if (err) throw err;
    console.log("Table successfully created ! ");
  });
});
