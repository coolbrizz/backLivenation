<?php

namespace App;

class Auth
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function user(): ?User
    {
        //On démarre la session si elle n'existe pas 
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $id = $_SESSION['auth'] ?? null;
        if ($id === null) {
            return null;
        }
        $query = $this->pdo->prepare('SELECT * FROM users WHERE id = ? ');
        $query->execute([$id]);
        $user = $query->fetchObject(User::class);
        return $user ?: null;
    }
    public function login(string $username,  string $password): ?User
    {
        //On trouve l'uilisateur qui correspond au user
        $query = $this->pdo->prepare('SELECT * FROM users WHERE username = :username ');
        $query->execute(['username' => $username]);
        $user = $query->fetchObject(User::class);
        if ($user === false) {
            return null;
        }
        // on verifie l'état du mot de pâsse
        if (password_verify($password, $user->password)) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['auth'] = $user->id;
            return $user;
        }
        return null;
    }
}
