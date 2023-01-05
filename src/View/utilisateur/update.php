<form method="post" action="frontController.php?controller=utilisateur&action=updated">
    <fieldset>
        <legend>Mon formulaire :</legend>
        <input type="hidden" name="id" id="id" value="<?php echo htmlspecialchars($v->getIdUtilisateur()); ?>"
               required/>
        <p>
            <label for="login_id">login</label> :
            <input type="text" name="login" id="login_id" value="<?php echo htmlspecialchars($v->getLogin()); ?>"
                   required/>
        </p>
        <p>
            <label for="nom">nom</label> :
            <input value="<?php echo htmlspecialchars($v->getNom()) ?>" type="text" name="nom" id="nom" required/>
        </p>
        <p>
            <label for="prenom">prenom</label> :
            <input value="<?php echo htmlspecialchars($v->getPrenom()) ?>" type="text" name="prenom" id="prenom"
                   required/>
        </p>
        <p>
            <label for="age">age</label> :
            <input value="<?php echo htmlspecialchars($v->getAge()) ?>" type="number" name="age" id="age" required/>
        </p>
        <p>
            <label for="email">email</label> :
            <input value="<?php echo htmlspecialchars($v->getEmailAValider()) ?>" type="text" name="email" id="email"
                   required/>
        </p>
        <?php if (\App\YourVoice\Lib\ConnexionUtilisateur::estConnecte()) { ?>
            <p>
                <label for="mdp_id">Ancien mot de passe</label>
                <input type="password" value="" placeholder="" name="mdp1" id="mdp_id" required>
            </p>
        <?php } else if (\App\YourVoice\Lib\ConnexionAdmin::estConnecte()) { ?>
            <p>
                <label for="mdp_id">Pass admin</label>
                <input type="password" value="" placeholder="" name="mdp1" id="mdp_id" required>
            </p>

        <?php } ?>
        <p>
            <label for="mdp_id">Nouveau mot de passe</label>
            <input type="password" value="" placeholder="" name="mdp2" id="mdp_id">
        </p>
        <p>
            <label for="mdp2_id">Vérification du nouveau mot de passe</label>
            <input type="password" value="" placeholder="" name="mdp3" id="mdp2_id">
        </p>
        <p>
            <input type="submit" value="Envoyer"/>
        </p>
    </fieldset>
</form>

