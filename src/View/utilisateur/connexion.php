<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>connexion</title>
</head>
<body>
<form method="post" action="frontController.php?controller=utilisateur&action=connected">
    <fieldset>
        <legend> CONNEXION </legend>
        <p>
            <label for="login_id">Identifiant</label>
            <input type="text" placeholder="macrone" name="login" id="login_id" required/>
        </p>
        <p>
            <label for="mdp">Mot de passe</label>
            <input type="password" placeholder="******" name="mdp" id="mdp" required/>
        </p>
        <p>
            <input type="submit" value="Connexion" />
        </p>
    </fieldset>
</form>
<?php echo "<div><a href=\"frontController.php?controller=utilisateur&action=create\"> Vous n'avez pas encore de compte ? Cliquer ici!</a></div> "; ?>
</body>
</html>
