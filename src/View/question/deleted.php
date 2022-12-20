
<form method="post" action="frontController.php?controller=question&action=delete">
    <div class="container">
        <div class="container_connexion">
            <h1>Êtes-vous sûre de vouloir supprimer cette question ?</h1>
            <input class="text" type="password" placeholder="Mot de passe*" name="mdp" id="mdp" required/>
            <div class="champ1">
                <p id="champsrequis">* champs requis</p>
            </div>
            <input type="hidden" name="id_question" id="id_question" value="<?php echo $v->getIdQuestion(); ?>" />
            <input id="envoyer" type="submit" value="Supprimer"/>

        </div>
    </div>
</form>
