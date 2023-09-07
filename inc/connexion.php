<?php
try {
    $connexion = new PDO(
        'mysql:host=localhost;dbname= bdd;charset=utf8',
        'root',
         ''
    );

    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo "C'est pas facile le code &#128546;" . $e->getMessage();
}

?>
