<?php
$password = 'admin'; // Remplacez 'admin' par le mot de passe réel de l'administrateur
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
echo "Le hachage du mot de passe est : " . $hashedPassword;
