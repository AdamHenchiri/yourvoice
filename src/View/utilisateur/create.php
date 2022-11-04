<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>inscription</title>
</head>
<body>
<form method="post" action="frontController.php?controller=utilisateur&action=created">
    <fieldset>
        <legend>inscription :</legend>
        <p>
            <label for="login_id">login</label> :
            <input type="text" placeholder="macrone" name="login" id="login_id" required/>
        </p>
        <p>
            <label for="nom">nom</label> :
            <input type="text" placeholder="macron" name="nom" id="nom" required/>
        </p>
        <p>
            <label for="prenom">prenom</label> :
            <input type="text" placeholder="emanuelle" name="prenom" id="prenom" required/>
        </p>
        <p>
            <label for="age">age</label> :
            <input type="number" placeholder="20" name="age" id="age" required/>
        </p>
        <p>
            <label for="email">email</label> :
            <input type="email" placeholder="email@amail.com" name="email" id="email" required/>
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
</body>
</html>
