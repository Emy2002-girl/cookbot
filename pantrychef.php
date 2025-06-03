<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CookBot - Pantrychef</title>
    <link rel="stylesheet" href="pantrychef.css">
</head>
<body>
<header class="header">
        <nav class="nav-container">
            <!-- Logo -->
            <div class="logo">
                <div class="logo-icon"><img src="images/cutlery.png" alt="" width="35" height="35"></div>
                <span class="logo-text"><span style="color:#10B981;">Cook</span>Bot</span>
            </div>
            <!-- Navigation Menu -->
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        Fonctionnalités
                        <span class="dropdown-arrow"></span>
                    </a>
                    
                    <!-- Dropdown Menu -->
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item">
                            <div class="dropdown-icon icon-pantry">🥘</div>
                            <span class="dropdown-text">PantryChef</span>
                        </a>
                        
                        <a href="#" class="dropdown-item">
                            <div class="dropdown-icon icon-master">👨‍🍳</div>
                            <span class="dropdown-text">MasterChef</span>
                        </a>
                        
                        <a href="#" class="dropdown-item">
                            <div class="dropdown-icon icon-macros">🍌</div>
                            <span class="dropdown-text">MacrosChef</span>
                        </a>
                        
                        <a href="#" class="dropdown-item">
                            <div class="dropdown-icon icon-meal">📅</div>
                            <span class="dropdown-text">MealPlanChef</span>
                        </a>
                    </div>
                </li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link">Tarification</a>
                </li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link">Blog</a>
                </li>
            </ul>
            <div class="header-right">
                <span style="border: 1px solid gainsboro; padding: 0.5rem 0.75rem; border-radius: 18px;">FR</span>
                <span style="border: 1px solid gainsboro; padding: 0.5rem 0.75rem; border-radius: 18px;"><img src="images/sun.png" alt="" width="17" height="17" margin-top="5px"></span>
                <a href="login.php" class="login-link" >Se connecter</a>
                <a href="inscription.php" class="btn-primary">S'inscrire</a>
            </div>
        </div>
        </nav>
    </header>
    <section class="hero">
        <div class="container">
            <div class="description">
                <div class="flex">
                <img src="images/Overlay (1).png" style="width:20px,height:20px">
                <h2>PantryChef</h2></div>
                <p class="desc">
                Où les Ingrédients se Transforment en<span> Chef-d'œuvre !</span>
                </p>
                <p class="desc1">
                Vous avez un garde-manger bien garni mais aucune inspiration pour les recettes ?
                PantryChef est le génie de la cuisine qui transforme vos ingrédients de base en délices
                gastronomiques. Fini les dilemmes du dîner, place aux plats délicieux !
                </p>
            </div>
            <div class="image"><img src="images/super.jpg" alt="" srcset="" width="100%" height="auto" style="border-radius:20%;box-shadow: #BDBDBD 10px 7px 0px"></div>
        </div>
    </section>
    <section class="content">
        <div class="container2">
            <div class="etapes">
            <div class="case">1</div>
            <h2>Ajoutez les ingrédients que vous avez à la maison.</h2>
            <p>Vous pouvez choisir des ingrédients dans la liste ou dans votre inventaire enregistré.</p>
            <p>N'oubliez pas : si un ingrédient n'est pas disponible dans la liste par défaut, il suffit de taper son
            nom dans la barre de recherche et de l'ajouter.</p>
            </div>
            <div class="ingedients">
                <select name="ingedient" id=""></select>
            </div>
        </div>
        <div class="container2">
        <div class="etapes">
            <div class="case">2</div>
            <h2>Ajoutez les ingrédients que vous avez à la maison.</h2>
            <p>Vous pouvez choisir des ingrédients dans la liste ou dans votre inventaire enregistré.</p>
            <p>N'oubliez pas : si un ingrédient n'est pas disponible dans la liste par défaut, il suffit de taper son
            nom dans la barre de recherche et de l'ajouter.</p>
            </div>
            <div class="ingedients">
                <select name="repas" id="">
                    <option value="pdéjeuner">petit-Déjeuner</option>
                    <option value="dejeuner">Déjeuner</option>
                <option value="">Snack</option>
               <option value="diner">diner</option>
                </select>
            </div>
        </div>
        </div>
    </section>
</body>
</html>