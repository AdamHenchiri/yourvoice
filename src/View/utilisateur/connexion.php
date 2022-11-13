<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>connexion</title>
</head>

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

            <?php echo "<a id=\"redirection\" href=\"frontController.php?controller=utilisateur&action=create\"> Je n'ai pas encore de compte</a> "; ?>

        </div>
    </div>
</form>

</div>
</body>
</html>
