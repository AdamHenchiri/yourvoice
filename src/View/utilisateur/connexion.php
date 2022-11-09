<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>connexion</title>
</head>
<body>
<form method="post" action="frontController.php?controller=utilisateur&action=connected">
    <fieldset>
        <legend>Connexion</legend>
        <p>
            <label for="login_id">login</label> :
            <input type="text" placeholder="macrone" name="login" id="login_id" required/>
        </p>
        <p>
            <label for="mdp">mot de passe</label> :
            <input type="password" placeholder="******" name="mdp" id="mdp" required/>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>
<?php echo "<div><a href=\"frontController.php?controller=utilisateur&action=create\"> vous n'avez pas encore de compte ? cliquer ici!</a></div> "; ?>
</body>
</html>
