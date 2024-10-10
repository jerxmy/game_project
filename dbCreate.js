const mysql = require("mysql");

let con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "root",
  database: "migrationTest",
});

con.connect(function (err) {
  if (err) throw err;
  console.log("Connected");
  con.query(
    "CREATE DATABASE IF NOT EXIST migrationTest",
    function (err, result) {
      if ((err, result)) {
        console.log("Database created !");
      }
    }
  );
});
