<?php
// Activer l'affichage des erreurs pour le débogage
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config.php';
require_once 'user.php';

$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $database = new Database();
        $db = $database->getConnection();
        $utilisateur = new Utilisateur($db);

        $nom = trim($_POST['nom']);
        $prenom = trim($_POST['prenom'] ?? '');
        $email = trim($_POST['email']);
        $mot_de_passe = $_POST['mot_de_passe'];
        $confirmer_mot_de_passe = $_POST['confirmer_mot_de_passe'];
        $id_abonnement = $_POST['id_abonnement'] ?? 1;

        // Vérifier que les mots de passe correspondent
        if ($mot_de_passe !== $confirmer_mot_de_passe) {
            $message = 'Les mots de passe ne correspondent pas';
            $message_type = 'error';
        } else {
            $result = $utilisateur->inscrire($nom, $prenom, $email, $mot_de_passe, $id_abonnement);
            $message = $result['message'];
            $message_type = $result['success'] ? 'success' : 'error';
            
            if ($result['success']) {
                header('Location: login.php?inscrit=1');
                exit();
            }
        }
    } catch (Exception $e) {
        $message = 'Erreur: ' . $e->getMessage();
        $message_type = 'error';
    }
}

// Récupérer les types d'abonnements
try {
    $database = new Database();
    $db = $database->getConnection();
    $query = "SELECT * FROM ABONNEMENT WHERE STATUS = 'ACTIF' ORDER BY PRIX ASC";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $abonnements = $stmt->fetchAll();
} catch (Exception $e) {
    $abonnements = [];
    $message = 'Erreur lors de la récupération des abonnements: ' . $e->getMessage();
    $message_type = 'error';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - CookBot</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: linear-gradient(135deg, #23b585 0%, #E0E0E0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container { 
            background: white; 
            padding: 40px; 
            border-radius: 15px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
        }
        .logo { text-align: center; margin-bottom: 30px; }
        .logo div {font-size: 2.5em;display: flex;margin-bottom: 10px;gap: 10px;align-items: center;justify-content: center;font-weight: 600;}
        .logo p { margin-left:10px; color: #666; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 600; color: #333; }
        input[type="text"], input[type="email"], input[type="password"], select {
            width: 100%; 
            padding: 12px 15px; 
            border: 2px solid #e1e5e9; 
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        input:focus, select:focus { 
            outline: none; 
            border-color: #667eea; 
        }
        .form-row { display: flex; gap: 15px; }
        .form-row .form-group { flex: 1; }
        button { 
            width: 100%; 
            padding: 15px; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white; 
            border: none; 
            border-radius: 8px; 
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
        }
        button:hover { transform: translateY(-2px); }
        .message { 
            padding: 15px; 
            margin-bottom: 20px; 
            border-radius: 8px; 
            font-weight: 500;
        }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .links { text-align: center; margin-top: 20px; }
        .links a { color: #667eea; text-decoration: none; font-weight: 500; }
        .links a:hover { text-decoration: underline; }
        .abonnement-info { 
            background: #f8f9fa; 
            padding: 10px; 
            border-radius: 5px; 
            margin-top: 5px; 
            font-size: 14px; 
            color: #666; 
        }
        @media (max-width: 576px) {
            .form-row { flex-direction: column; gap: 0; }
            .container { padding: 20px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <div><img src="images/cutlery.png" alt="" srcset="" style="width:47px">
            <span style="color:#10b981">Cook</span><span style="margin-left:-11px">Bot</span></div>
            <p>Votre assistant culinaire personnel</p>
        </div>
        
        <?php if ($message): ?>
            <div class="message <?php echo $message_type; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-row">
                <div class="form-group">
                    <label for="nom">Nom *</label>
                    <input type="text" id="nom" name="nom" required value="<?php echo isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" value="<?php echo isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : ''; ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="mot_de_passe">Mot de passe *</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required minlength="6">
                <div class="abonnement-info">
                    Le mot de passe doit contenir au moins 6 caractères
                </div>
            </div>
            
            <div class="form-group">
                <label for="confirmer_mot_de_passe">Confirmer le mot de passe *</label>
                <input type="password" id="confirmer_mot_de_passe" name="confirmer_mot_de_passe" required minlength="6">
            </div>
            
            <div class="form-group">
                <label for="id_abonnement">Type d'abonnement</label>
                <select id="id_abonnement" name="id_abonnement">
                    <?php foreach ($abonnements as $abonnement): ?>
                        <option value="<?php echo $abonnement['ID_ABONNEMENT']; ?>" 
                                <?php echo (isset($_POST['id_abonnement']) && $_POST['id_abonnement'] == $abonnement['ID_ABONNEMENT']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($abonnement['TYPE_ABONNE']); ?> 
                            <?php if ($abonnement['PRIX'] > 0): ?>
                                - <?php echo number_format($abonnement['PRIX'], 2); ?>€
                            <?php else: ?>
                                - Gratuit
                            <?php endif; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="abonnement-info">
                    L'abonnement gratuit vous permet de créer jusqu'à 10 recettes
                </div>
            </div>
            <button type="submit" style="background: linear-gradient(135deg, #10B981 0%, #98c1ae 100%);">S'inscrire</button>
        </form>
        
        <div class="links">
            <p>Déjà un compte ? <a href="login.php" style="color:#30bb8c">Se connecter</a></p>
        </div>
    </div>
</body>
</html>