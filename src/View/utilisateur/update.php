<form method="post" action="frontController.php?controller=utilisateur&action=updated">
    <div class="container">
        <div class="container-modification-user">
        <h1 id="titre_modification_user">Modifier mes informations</h1>
        <input type="hidden" name="id" id="id" value="<?php echo htmlspecialchars($v->getIdUtilisateur()); ?>"
               required/>


            <input class="text" placeholder="Login*" type="text" name="login" id="login_id" value="<?php echo htmlspecialchars($v->getLogin()); ?>"
                   required/>



            <input class="text" placeholder="Nom*" value="<?php echo htmlspecialchars($v->getNom()) ?>" type="text" name="nom" id="nom" required/>


            <input class="text" placeholder="Prénom*" value="<?php echo htmlspecialchars($v->getPrenom()) ?>" type="text" name="prenom" id="prenom"
                   required/>


            <input class="text" placeholder="Age" value="<?php echo htmlspecialchars($v->getAge()) ?>" type="number" name="age" id="age" required/>


            <input class="text" placeholder="Email*" value="<?php echo htmlspecialchars($v->getEmailAValider()) ?>" type="text" name="email" id="email"
                   required/>

        <?php if (\App\YourVoice\Lib\ConnexionUtilisateur::estConnecte()) { ?>


                <input class="text" type="password" value="" placeholder="Ancien mot de passe" name="mdp1" id="mdp_id" required>

        <?php } else if (\App\YourVoice\Lib\ConnexionAdmin::estConnecte()) { ?>


                <input class="text" type="password" value="" placeholder="Mot de passe admin" name="mdp1" id="mdp_id" required>


        <?php } ?>


            <input class="text" type="password" value="" placeholder="Nouveau mot de passe" name="mdp2" id="mdp_id">



            <input class="text" type="password" value="" placeholder="Tapez à nouveau votre mot de passe" name="mdp3" id="mdp2_id">

            <input class="boutton-modifier-2" type="submit" value="Modifier mes informations"/>
        </div>
    </div>
</form>

