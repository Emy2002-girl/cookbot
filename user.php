<?php
class Utilisateur {
    private $conn;
    private $table = 'UTILISATEUR';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Inscription d'un nouvel utilisateur
    public function inscrire($nom, $prenom, $email, $mot_de_passe, $id_abonnement = 1) {
        // Vérifier si l'email existe déjà
        if ($this->emailExiste($email)) {
            return ['success' => false, 'message' => 'Cet email est déjà utilisé'];
        }

        // Validation des données
        if (!$this->validerDonnees($nom, $email, $mot_de_passe)) {
            return ['success' => false, 'message' => 'Données invalides'];
        }

        // Hachage du mot de passe
        $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);
        
        // Token de vérification
        $token_verification = bin2hex(random_bytes(32));

        $query = "INSERT INTO " . $this->table . " 
                  (NOM, PRENOM, EMAIL, MOT_DE_PASSE, ID_ABONNEMENT, TOKEN_VERIFICATION) 
                  VALUES (:nom, :prenom, :email, :mot_de_passe, :id_abonnement, :token_verification)";
        
        try {
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':mot_de_passe', $mot_de_passe_hash);
            $stmt->bindParam(':id_abonnement', $id_abonnement);
            $stmt->bindParam(':token_verification', $token_verification);

            if ($stmt->execute()) {
                return [
                    'success' => true, 
                    'message' => 'Inscription réussie',
                    'user_id' => $this->conn->lastInsertId(),
                    'token' => $token_verification
                ];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Erreur lors de l\'inscription: ' . $e->getMessage()];
        }
        
        return ['success' => false, 'message' => 'Erreur lors de l\'inscription'];
    }

    // Connexion utilisateur
    public function connecter($email, $mot_de_passe) {
        $query = "SELECT u.*, a.TYPE_ABONNE, a.STATUS as ABONNEMENT_STATUS 
                  FROM " . $this->table . " u 
                  LEFT JOIN ABONNEMENT a ON u.ID_ABONNEMENT = a.ID_ABONNEMENT 
                  WHERE u.EMAIL = :email AND u.STATUS = 'ACTIF'";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $utilisateur = $stmt->fetch();
                
                if (password_verify($mot_de_passe, $utilisateur['MOT_DE_PASSE'])) {
                    // Mettre à jour la dernière connexion
                    $this->mettreAJourDerniereConnexion($utilisateur['ID_UTILISATEUR']);
                    
                    // Démarrer la session
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION['user_id'] = $utilisateur['ID_UTILISATEUR'];
                    $_SESSION['nom'] = $utilisateur['NOM'];
                    $_SESSION['prenom'] = $utilisateur['PRENOM'];
                    $_SESSION['email'] = $utilisateur['EMAIL'];
                    $_SESSION['role'] = $utilisateur['ROLE'];
                    $_SESSION['type_abonne'] = $utilisateur['TYPE_ABONNE'];
                    $_SESSION['est_verifie'] = $utilisateur['EST_VERIFIE'];
                    
                    return ['success' => true, 'message' => 'Connexion réussie', 'user' => $utilisateur];
                }
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Erreur lors de la connexion: ' . $e->getMessage()];
        }
        
        return ['success' => false, 'message' => 'Email ou mot de passe incorrect'];
    }

    // Vérifier si l'email existe
    private function emailExiste($email) {
        $query = "SELECT ID_UTILISATEUR FROM " . $this->table . " WHERE EMAIL = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // Validation des données
    private function validerDonnees($nom, $email, $mot_de_passe) {
        if (empty($nom) || strlen($nom) < 2 || strlen($nom) > 100) return false;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
        if (empty($mot_de_passe) || strlen($mot_de_passe) < 6) return false;
        return true;
    }

    // Mettre à jour la dernière connexion
    private function mettreAJourDerniereConnexion($user_id) {
        $query = "UPDATE " . $this->table . " SET DATE_DERNIERE_CONNEXION = NOW() WHERE ID_UTILISATEUR = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    }

    // Déconnexion
    public function deconnecter() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        return true;
    }

    // Vérifier si l'utilisateur est connecté
    public function estConnecte() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user_id']);
    }

    // Obtenir les informations utilisateur
    public function obtenirUtilisateur($user_id) {
        $query = "SELECT u.*, a.TYPE_ABONNE, a.STATUS as ABONNEMENT_STATUS 
                  FROM " . $this->table . " u 
                  LEFT JOIN ABONNEMENT a ON u.ID_ABONNEMENT = a.ID_ABONNEMENT 
                  WHERE u.ID_UTILISATEUR = :user_id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        
        return $stmt->fetch();
    }

    // Obtenir les statistiques utilisateur
    public function obtenirStatistiques($user_id) {
        $stats = [];
        
        // Nombre de recettes créées
        $query = "SELECT COUNT(*) as nb_recettes FROM RECETTE WHERE ID_UTILISATEUR = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $stats['nb_recettes'] = $stmt->fetch()['nb_recettes'];
        
        // Nombre de favoris
        $query = "SELECT COUNT(*) as nb_favoris FROM FAVORI WHERE ID_UTILISATEUR = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $stats['nb_favoris'] = $stmt->fetch()['nb_favoris'];
        
        return $stats;
    }
}
?>