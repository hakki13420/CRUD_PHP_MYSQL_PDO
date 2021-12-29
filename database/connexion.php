<?php

try {
    $con = new PDO('mysql:host=localhost;dbname=crud_php', 'root', '');
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
