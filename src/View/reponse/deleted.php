
<form method="post" action="frontController.php?controller=reponse&action=delete">
    <div class="container">
        <div class="container_connexion">
            <h1>Êtes-vous sûre de vouloir supprimer cette réponse ?</h1>
            <?php

            use App\YourVoice\Lib\ConnexionUtilisateur;
            use App\YourVoice\Lib\MotDePasse;

            var_dump($v);
            echo 'login ' . ConnexionUtilisateur::getLoginUtilisateurConnecte();
            echo $m = (ConnexionUtilisateur::getUtilisateurConnecte())->getMdpHache();
            //echo MotDePasse::verifier($_POST['mdp'],$m );
            ?>
            <input class="text" type="password" placeholder="Mot de passe*" name="mdp" id="mdp" required/>
            <div class="champ1">
                <p id="champsrequis">* champs requis</p>
            </div>
            <input type="hidden" name="id_reponse" id="id_reponse" value="<?php echo $v->getIdRponses(); ?>" />
            <input id="envoyer" type="submit" value="Supprimer"/>

        </div>
    </div>
</form>
