<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form method="post" action="frontController.php?controller=utilisateur&action=updated">
    <fieldset>
        <legend>Mon formulaire :</legend>
        <p>
            <label for="login_id">login</label> :
            <input type="text" name="login" id="login_id" value="<?php echo $v->getLogin(); ?>"  readonly="readonly" required/>
        </p>
        <p>
            <label for="nom">nom</label> :
            <input value="<?php echo htmlspecialchars($v->getNom()) ?>" type="text" name="nom" id="nom"  required/>
        </p>
        <p>
            <label for="prenom">prenom</label> :
            <input value="<?php echo htmlspecialchars($v->getPrenom()) ?>" type="text" name="prenom" id="prenom" required/>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>
</body>
</html>
