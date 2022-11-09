<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>inscription</title>
</head>
<body>
<form method="post" action="frontController.php?controller=utilisateur&action=created">
    <fieldset>
        <legend>INSCRIPTION</legend>
        <p>
            <label for="login_id">Identifiant</label>
            <input type="text" placeholder="macrone" name="login" id="login_id" required/>
        </p>
        <p>
            <label for="nom">Nom</label>
            <input type="text" placeholder="macron" name="nom" id="nom" required/>
        </p>
        <p>
            <label for="prenom">Prénom</label>
            <input type="text" placeholder="emmanuel" name="prenom" id="prenom" required/>
        </p>
        <p>
            <label for="age">Âge</label>
            <input type="number" placeholder="20" name="age" id="age" required/>
        </p>
        <p>
            <label for="email">Email</label>
            <input type="email" placeholder="email@amail.com" name="email" id="email" required/>
        </p>
        <p>
            <label for="mdp">Mot de passe</label>
            <input type="password" placeholder="******" name="mdp" id="mdp" required/>
        </p>
        <p>
            <input type="submit" value="S'inscrire" />
        </p>
    </fieldset>
</form>
</body>
</html>
