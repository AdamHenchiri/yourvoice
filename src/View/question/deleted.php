
<form method="post" action="frontController.php?controller=question&action=deleted">
    <div class="container">
        <div class="container_connexion">
            <input class="hidden" type="hidden" name="id_question" id="id_question" value=<?php echo $id_question ?>required/>
            <h1>Êtes-vous sûre de vouloir supprimer cette question ?</h1>
            <input class="text" type="password" placeholder="Mot de passe*" name="mdp" id="mdp" required/>
            <div class="champ1">
                <p id="champsrequis">* champs requis</p>
            </div>
            <input id="envoyer" type="submit" value="Supprimer"/>

        </div>
    </div>
</form>
