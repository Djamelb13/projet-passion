<?php
try {
    $connexion = new PDO(
        'mysql:host=localhost;dbname=bdd;charset=utf8',
        'root',
        ''
    );
    echo '<h2>C\'est trop facile le code &#128512;</h2> ';
    
} catch(PDOException $e) {
    echo "C'est pas facile le code &#128546;" . $e->getMessage();
}

?>
