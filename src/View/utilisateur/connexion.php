<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>connexion</title>
</head>
<div class="container_connexion">
<form method="post" action="frontController.php?controller=utilisateur&action=connected">

        <legend>Connexion</legend>
        <p>
            <input type="text" placeholder="Login*" name="login" id="login_id" required/>
        </p>
        <p>
            <input type="password" placeholder="Mot de passe*" name="mdp" id="mdp" required/>
        </p>
        <p>
            <input id="envoyer" type="submit" value="Connexion"/>
        </p>

</form>
<?php echo "<a href=\"frontController.php?controller=utilisateur&action=create\"> vous n'avez pas encore de compte ? cliquer ici!</a> "; ?>
</div>
</body>
</html>
