
<form method="post" action="frontController.php?controller=utilisateur&action=created">
    <div class="container">
        <div class="container_connexion">
            <h1>Inscription</h1>
            <input class="text" type="text" placeholder="Pseudo*" name="login" id="login_id" required/>
            <input class="text" type="text" placeholder="Nom*" name="nom" id="nom" required/>
            <input class="text" type="text" placeholder="Prenom*" name="prenom" id="prenom" required/>
            <input class="text" type="number" placeholder="age*" name="age" id="age" required/>
            <input class="text" type="email" placeholder="Email*" name="email" id="email" required/>
            <input class="text" type="password" placeholder="Mot de passe*" name="mdp" id="mdp_id" required/>
            <input class="text" type="password" placeholder="Vérification du mot de passe*" name="mdp2" id="mdp2_id" required/>
            <div class="champ1">
                <p id="champsrequis">* champs requis</p>
            </div>
            <div class="cgu">
                <input type="checkbox" required/>
                <p>En cochant cette case vous acceptez les CGU</p>
            </div>
            <input id="envoyer" type="submit" value="S'inscrire" />
            <div class="separateur">

            </div>

            <?php echo "<a id=\"redirection\" href=\"frontController.php?controller=utilisateur&action=connexion\"> J'ai déjà un compte</a> "; ?>

        </div>

    </div>


</form>

