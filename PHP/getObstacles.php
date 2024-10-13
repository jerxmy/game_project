<?php
$dbConfig = parse_ini_file("config.env");

$host = $dbConfig["DB_HOST"];
$username = $dbConfig["DB_USERNAME"];
$password = $dbConfig["DB_PASSWORD"];
$dbName = $dbConfig["DB_NAME"];

try {
    $pdo = new PDO(
        'mysql:host=' . $host . ';dbname=' . $dbName,
        $username,
        $password,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
    );
} catch (PDOException $e) {
    die("Can't connect to $dbName :" . $e->getMessage());
}

if (isset($_GET["id"])) {
    $amandeId = $_GET["id"];
    $request = $pdo->prepare('SELECT * FROM obstacles WHERE id = :amandeId');
    $request->bindParam(':amandeId', $amandeId, PDO::PARAM_STR);

    $amande = $request->execute();
    $amande = $request->fetch(PDO::FETCH_ASSOC);
} else {
    echo "Mets tes paramètres fdp";
}


echo $amande['amandes'];