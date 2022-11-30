    <!DOCTYPE html>
    <form method="post" action="frontController.php?controller=question&action=updated" name="creationQuestion" id="creationQuestion" onsubmit="return validation()">
        <div class="container">
            <div class="container_creerquestion">

                <div class="titre">
                    <a id="boutonpublic" class="public"><i class="fa-solid fa-eye"></i> Public</a>
                    <h1>Modifier une question</h1>
                </div>

            <input type="hidden" name="id_question" id="id_question" value="<?php use App\YourVoice\Model\Repository\ReponseRepository; use App\YourVoice\Model\Repository\UtilisateurRepository; use App\YourVoice\Model\Repository\VotantRepository; echo $v->getIdQuestion(); ?>" />

                <div class="question_description">
                    <label for="intitule">Intitulé</label>
                    <textarea name="intitule" id="intitule" cols="10"  rows="10" required><?php echo $v->getIntitule(); ?></textarea>


                    <label for="explication">Développement de la question</label>
                    <textarea name="explication" id="explication" cols="10"  rows="10" required><?php echo $v->getExplication(); ?></textarea>
                </div>

                <div class="separateur1">
                </div>

                <div class="container_date">
                    <div class="date_redac">
                        <div class="date_all">
                            <label for="dateDebut_redaction">Début de la rédaction</label> :
                            <input type="date" value=<?php echo $v->getDateDebutRedaction(); ?> name="dateDebut_redaction" id="dateDebut_redaction" required/>
                        </div>
                        <div class="date_all">
                            <label for="dateFin_redaction">Fin de la rédaction</label> :
                            <input type="date" value=<?php echo $v->getDateFinRedaction(); ?> name="dateFin_redaction" id="dateFin_redaction" required/>

                        </div>
                    </div>
                    <div class="date_redac">
                        <div class="date_all">
                            <label for="dateDebut_vote">Début du vote</label> :
                            <input type="date" value=<?php echo $v->getDateDebutVote(); ?> name="dateDebut_vote" id="dateDebut_vote" required/>
                        </div>
                        <div class="date_all">
                            <label for="dateFin_vote">Fin du vote</label> :
                            <input type="date" value=<?php echo $v->getDateFinVote(); ?> name="dateFin_vote" id="dateFin_vote" required/>
                        </div>
                    </div>
                </div>

                <div class="separateur1">
                </div>

                <label for="id_utilisateur">Serra rempli automatiquement avec les sessions</label>
                <input type="int" value=<?php echo $v->getIdUtilisateur(); ?> name="id_utilisateur" id="id_utilisateur" readonly/>


                <div class="separateur1">
                </div>

                <div class="container_votant_contributeur">
                    <div class="container_contributeur">
                        <label for="organisateurs ">Choisissez les organisateurs</label>
                        <div id="affichecontributeur">

                        </div>
                        <div class="scroll_votant">

                <?php
                $tabOrganisateur =(new ReponseRepository())->selectWhere("id_question",$v->getIdQuestion());
                $tabUsers = (new UtilisateurRepository())->selectAll();
                foreach ($tabUsers as $user){
                $aux=false;
                foreach ($tabOrganisateur as $organisateur){
                        if($user->getIdUtilisateur() == $organisateur->getIdUtilisateur()){
                    ?>
                            <div class="checkbox">
                <input type="checkbox" name="idContributeur[]" id="<?php echo $user->getIdUtilisateur()?>" value="<?php echo $user->getIdUtilisateur()?>" checked>
                <?php $aux=true;?>
                <label for="<?php echo $user->getIdUtilisateur()?>"><?php echo $user->getLogin()?></label>
                            </div>
            <?php }}
                    if($aux===false ){ ?>
                        <div class="checkbox">
                    <input type="checkbox" name="idContributeur[]" id="<?php echo $user->getIdUtilisateur()?>" value="<?php echo $user->getIdUtilisateur()?>">

                    <label for="<?php echo $user->getIdUtilisateur()?>"><?php echo $user->getLogin()?></label>
                        </div>
            <?php }}?>
                        </div>
                        <p id="minimum">Min : 5 contributeurs</p>
                    </div>


                    <div class="container_votant">
                <label for="votants ">Choisissez les votants</label>
                        <div id="affichevotant">
                        </div>
                        <div class="scroll_votant">
                <?php
                $tabVotanats =(new VotantRepository())->selectWhere("id_question",$v->getIdQuestion());
                $tabUsers = (new UtilisateurRepository())->selectAll();
                foreach ($tabUsers as $user){
                $aux=false;
                foreach ($tabVotanats as $votanat){
                if($user->getIdUtilisateur() == $votanat->getIdUtilisateur()){
                ?>
                    <div class="checkbox">
                <input type="checkbox" name="idVotant[]" id="<?php echo $user->getIdUtilisateur()?>" value="<?php echo $user->getIdUtilisateur()?>" checked>
                <?php $aux=true;?>
                <label for="<?php echo $user->getIdUtilisateur()?>"><?php echo $user->getLogin()?></label>
            </div>
            <?php break;}}if($aux===false){ ?>
                        <div class="checkbox">
                <input type="checkbox" name="idVotant[]" id="<?php echo $user->getIdUtilisateur()?>" value="<?php echo $user->getIdUtilisateur()?>">

                <label for="<?php echo $user->getIdUtilisateur()?>"><?php echo $user->getLogin()?></label>
            </div>
            <?php }} ?>
                        </div>
                        <p id="minimum">Min : 5 votants</p>
                    </div>
                </div>

                <input id="valider" type="submit" value="valider" name="valider" />
            </div>
        </div>
    </form>
    <script src="../src/js/app.js"></script>


