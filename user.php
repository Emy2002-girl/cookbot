<?php
class User {
    private $conn;
    private $table = 'users';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Inscription d'un nouvel utilisateur
    public function register($username, $email, $password) {
        // Vérifier si l'utilisateur existe déjà
        if ($this->userExists($username, $email)) {
            return ['success' => false, 'message' => 'Utilisateur ou email déjà existant'];
        }

        // Validation des données
        if (!$this->validateInput($username, $email, $password)) {
            return ['success' => false, 'message' => 'Données invalides'];
        }

        // Hachage du mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO " . $this->table . " (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);

        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Inscription réussie'];
        }
        return ['success' => false, 'message' => 'Erreur lors de l\'inscription'];
    }

    // Connexion utilisateur
    public function login($username, $password) {
        $query = "SELECT id, username, email, password FROM " . $this->table . " WHERE username = :username OR email = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (password_verify($password, $user['password'])) {
                // Démarrer la session
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                
                return ['success' => true, 'message' => 'Connexion réussie'];
            }
        }
        return ['success' => false, 'message' => 'Identifiants incorrects'];
    }

    // Vérifier si l'utilisateur existe
    private function userExists($username, $email) {
        $query = "SELECT id FROM " . $this->table . " WHERE username = :username OR email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }

    // Validation des données d'entrée
    private function validateInput($username, $email, $password) {
        if (strlen($username) < 3 || strlen($username) > 50) {
            return false;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        if (strlen($password) < 6) {
            return false;
        }
        return true;
    }

    // Déconnexion
    public function logout() {
        session_start();
        session_destroy();
        return true;
    }

    // Vérifier si l'utilisateur est connecté
    public function isLoggedIn() {
        session_start();
        return isset($_SESSION['user_id']);
    }
}
?>