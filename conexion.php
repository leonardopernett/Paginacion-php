<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=paginacion', 'root', 'Admin09');
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>