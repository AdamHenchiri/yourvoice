<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>connexion</title>
</head>

<form method="post" action="frontController.php?controller=utilisateur&action=connected">
    <div class="container_connexion">
            <h1>Connexion</h1>
            <input class="text" type="text" placeholder="Login*" name="login" id="login_id" required/>
            <input class=text" type="password" placeholder="Mot de passe*" name="mdp" id="mdp" required/>
            <p id="champsrequis">* champs requis</p>
            <input id="envoyer" type="submit" value="Connexion"/>

    </div>
</form>
<?php echo "<a href=\"frontController.php?controller=utilisateur&action=create\"> vous n'avez pas encore de compte ? cliquer ici!</a> "; ?>
</div>
</body>
</html>
