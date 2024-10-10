<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>J'aodre la sacuisse
        <?php
        $request = $pdo->query("SELECT * FROM frangipute WHERE id=3");
        $queryResult = $request->fetch(PDO::FETCH_ASSOC);

        echo "J'ai " . $queryResult['quantity'] . " " . $queryResult['amandes'];
        ?>
    </div>
</body>

</html>