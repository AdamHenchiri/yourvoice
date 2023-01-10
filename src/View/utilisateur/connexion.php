

<form method="post" action="frontController.php?controller=utilisateur&action=connected">
    <div class="container">
        <div class="container_connexion">
                <h1>Connexion</h1>
                <input class="text" type="text" placeholder="Identifiant*" name="login" id="login_id" required/>
                <input class="text" type="password" placeholder="Mot de passe*" name="mdp" id="mdp" required/>
                <div class="champ1">
                    <p id="champsrequis">* champs requis</p>
                </div>
                <input id="envoyer" type="submit" value="Connexion"/>

                <div class="separateur">

                </div>
            <?php echo "<a id=\"redirection\" href=\"frontController.php?controller=utilisateur&action=mdpOublieView\"> Mot de passe oublié </a> "; ?>

            <?php echo "<a id=\"redirection\" href=\"frontController.php?controller=utilisateur&action=create\"> Je n'ai pas encore de compte</a> "; ?>

            <?php echo "<a id=\"redirection\" href=\"frontController.php?controller=admin&action=connexion\"> Je suis un administrateur </a> "; ?>

        </div>
    </div>
</form>


