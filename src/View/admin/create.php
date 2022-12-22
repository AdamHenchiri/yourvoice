
<form method="post" action="frontController.php?controller=admin&action=created">
    <div class="container">
        <div class="container_connexion">
            <h1>Inscription</h1>
            <input class="text" type="text" placeholder="Pseudo*" name="login" id="login_id" required/>
            <input class="text" type="email" placeholder="Email*" name="email" id="email" required/>
            <input class="text" type="password" placeholder="Mot de passe*" name="password_1" id="password_1" required/>
            <input class="text" type="password" placeholder="Vérification du mot de passe*" name="password_2" id="password_2" required/>
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

            <?php echo "<a id=\"redirection\" href=\"frontController.php?controller=admin&action=connexion\"> J'ai déjà un compte</a> "; ?>

        </div>

    </div>


</form>

