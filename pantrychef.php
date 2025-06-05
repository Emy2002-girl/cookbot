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
                <a href="homepage.php"><div class="logo-icon"><img src="images/cutlery.png" alt="" width="35" height="35"></div></a>
                <a href="homepage.php" style="text-decoration:none"><span class="logo-text"><span style="color:#10B981;">Cook</span>Bot</span></a>
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
                Où les Ingrédients se Transforment en<span style="color:#059669"> Chef-d'œuvre !</span>
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
    <div class="contain">
  <div class="etapes">
    <div class="case">1</div>
    <h2 style="padding-top: 8px;">Ajoutez les ingrédients que vous avez à la maison.</h2>
    <p style="padding-top: 8px;">Vous pouvez choisir des ingrédients dans la liste ou dans votre inventaire enregistré.</p>
    <p style="padding-top: 20px;">N'oubliez pas : si un ingrédient n'est pas disponible dans la liste par défaut, il suffit de taper son
    nom dans la barre de recherche et de l'ajouter.</p>
  </div>
  <div class="ingredients">
    <select name="ingredient" id="ingredient-select">
      <option value="">Sélectionnez un ingrédient</option>
      <option value="tomate">Tomate</option>
      <option value="oeuf">Œuf</option>
    </select>
  </div>
</div>
        <div class="contain">
        <div class="etapes" style="line-height:40px">
            <div class="case">2</div>
            <h2 style="padding-top: 8px;">Sélectionnez le repas que vous souhaitez cuisiner.</h2>
            <p>Vous pouvez choisir le petit-déjeuner, le déjeuner, le goûter ou le dîner.</p>
            <p>PantryChef vous recommandera alors une recette adaptée au repas que vous avez choisi.</p>
            </div>
            <div class="ingedient">
                <select name="repas" id="">
                    <option value="pdéjeuner">petit-Déjeuner</option>
                    <option value="dejeuner">Déjeuner</option>
                <option value="">Snack</option>
               <option value="diner">diner</option>
                </select>
            </div>
        </div>
        <div class="contain">
           <div class="etapes">
          <div class="case">3</div>
                <h2 style="padding-top: 8px;">Sélectionnez les ustensiles de cuisine que vous avez.</h2>
                <p style="padding-top: 8px;">Choisissez les ustensiles de cuisine que vous avez ou que vous souhaitez utiliser.</p>
    <p style="padding-top: 20px;">Cela empêchera PantryChef de vous recommander des recettes utilisant des ustensiles que vous
    n'avez pas ou que vous ne souhaitez pas utiliser.</p>
        </div>
   
    <div class="tools-grid">
                <div class="tool-item">
                    <label class="checkbox-container">
                        <input type="checkbox" id="cooktop" name="tools" value="cooktop">
                        Plaque de cuisson
                    </label>
                </div>
                <div class="tool-item">
                    <label class="checkbox-container">
                        <input type="checkbox" id="oven" name="tools" value="oven">
                        Four
                    </label>
                </div>

                <div class="tool-item">
                    <label class="checkbox-container">
                        <input type="checkbox" id="microwave" name="tools" value="microwave">
                        Micro-ondes
                    </label>
                </div>

                <div class="tool-item">
                    <label class="checkbox-container">
                        <input type="checkbox" id="airfryer" name="tools" value="airfryer">
                        Friteuse à air
                    </label>
                </div>

                <div class="tool-item">
                    <label class="checkbox-container">
                        <input type="checkbox" id="sousvide" name="tools" value="sousvide">
                        Machine sous vide
                    </label>
                </div>

                <div class="tool-item">
                    <label class="checkbox-container">
                        <input type="checkbox" id="blender" name="tools" value="blender">
                        Mixeur
                    </label>
                </div>

                <div class="tool-item">
                    <label class="checkbox-container">
                        <input type="checkbox" id="foodprocessor" name="tools" value="foodprocessor">
                        Robot culinaire
                    </label>
                </div>

                <div class="tool-item">
                    <label class="checkbox-container">
                        <input type="checkbox" id="bbq" name="tools" value="bbq">
                        Barbecue
                    </label>
                </div>

                <div class="tool-item">
                    <label class="checkbox-container">
                        <input type="checkbox" id="slowcooker" name="tools" value="slowcooker">
                        Cuiseur lent
                    </label>
                </div>

                <div class="tool-item">
                    <label class="checkbox-container">
                        <input type="checkbox" id="pressurecooker" name="tools" value="pressurecooker">
                        Autocuiseur
                    </label>
                </div>
            </div>
        </div>
        </div>
        <div class="contain">
        <!-- Section 3: Sélection des ustensiles -->
           <div class="etapes">
          <div class="case">4</div>
                <h2 style="padding-top: 8px;">Sélectionnez le temps dont vous disposez.</h2>
                <p style="padding-top: 8px;">Sélectionnez 5 minutes si vous êtes pressé ou plus de temps si vous en avez.</p>
    <p style="padding-top: 20px;">Cela empêchera PantryChef de vous recommander des recettes qui prennent trop de temps à
    préparer.</p>
        </div>
        <div class="time-selector">
                <div class="time-display">
                    <div id="timeValue">5</div><div>minutes</div>
                </div>
                <div class="slider-container">
                    <div class="slider-progress" id="sliderProgress"></div>
                    <input type="range" id="timeSlider" min="5" max="90" value="5" step="5" class="slider">
                </div>
            </div>
        </div>
        <div class="contain">
           <div class="etapes">
          <div class="case">5</div>
                <h2 style="padding-top: 8px;">Sélectionnez votre niveau de compétence.</h2>
                <p style="padding-top: 8px;">Peu importe que vous soyez un novice ou un chef étoilé au Michelin.</p>
                <p style="padding-top: 20px;">PantryChef vous recommandera des recettes adaptées à votre niveau de compétence.</p>
        </div>
        <div class="niveau">
            <select name="niveau" id="">
                <option value="Novice">Novice</option>
                <option value="inter">Intermédiaire</option>
                <option value="expert">Expert</option>
            </select>
        </div>
        </div>
        <div class="containn">
        <div class="generer">
          <div class="case">6</div>
                <h2 style="padding-top: 8px;">Générez votre recette.</h2>
                <p style="padding-top: 8px;">Appuyez sur le bouton Générer et attendez que la magie opère.</p>
                <p style="padding-top: 20px;">En un clic, vous pouvez enregistrer votre recette dans le livre de cuisine ou l'ajouter à la liste de
              courses. Et si vous souhaitez commander les ingrédients en ligne, vous pouvez les ajouter à votre
              panier AmazonFresh ou InstaCart !</p>
        </div>
        <div class="btn-generer">
            <button id="btn-generer">Générer votre recette 🧑</button>
        </div>
    </section>
    <section class="footer">
        <h2 class="tit">Le compagnon parfait pour votre cuisine.</h2>
        <h2 class="titt">Inscrivez-vous gratuitement dès aujourd'hui.</h2>
        <button class="commencerr">Commencer gratuitement</button>
    </section>
    <section style="background-color: #F3F4F6;">
        <div class="footer2">
        <div class="conta">
            <div class="logo">
                <div class="cook"><img src="images/cutlery.png" alt="" width="35" height="35" >
                <span class="logo-text" style="position: absolute;"><span style="color:#10B981;">Cook</span>Bot</span></div>
            </div>
            <div class="descrip3">Découvrez la cuisine intelligente</div>
        </div>
          <div class=" conta propos">
            <h2>à propos</h2>
            <a href="#">Blog</a><br>
            <a href="#">Contacte</a><br>
          </div>
          <div class=" conta produit">
            <h2>Produit</h2>
            <a href="#">Tarification</a><br>
            <a href="#">FAQ</a><br>
          </div>
          <div class=" conta suiver">
            <h2>Suiver-nous</h2>
            <img src="images/Frame.png" alt="">
            <img src="images/Frame (1).png" alt="">
            <img src="images/Frame (2).png" alt="">
          </div>
          <div class="conta legal">
            <h2>Legal</h2>
            <a href="condition">Conditions</a><br>
            <a href="conf">Confidentalité</a><br>
          </div>
    </div>
    <div style=" width: 100%;height: 0.5px; background:black; margin: 30px 0;"></div>
    <div class="copyright">© 2025 CookBot. Tous droits réservés.</div>
    </section>
    <script src="scriptt.js"></script>
</body>
</html>