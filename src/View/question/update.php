
    <form method="post" action="frontController.php?controller=question&action=updated" name="creationQuestion" id="creationQuestion" onsubmit="return validation()">
        <div class="container">
            <div class="container_creerquestion">

                <div class="titre">
                    <a id="boutonpublic" class="public"><i class="fa-solid fa-eye"></i> Public</a>
                    <h1>Modifier une question</h1>
                </div>
                <?php

                use App\YourVoice\Lib\ConnexionUtilisateur;
                use App\YourVoice\Model\Repository\ReponseRepository;
                use App\YourVoice\Model\Repository\UtilisateurRepository;
                use App\YourVoice\Model\Repository\VotantRepository;

                ?>
                <input type="hidden" name="id_question" id="id_question" value="<?php echo $v->getIdQuestion(); ?>" />

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
                            <input type="date" value=<?php echo $v->getDateDebutRedaction(); ?> name="dateDebut_redaction"  readonly/>
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

                <!--<label for="id_utilisateur">Serra rempli automatiquement avec les sessions</label>
                <input type="int" value=<?php /*echo $v->getIdUtilisateur(); */?> name="id_utilisateur" id="id_utilisateur" readonly/>
-->             <?php
                $u = $v->getIdUtilisateur();
                 ?>
                <input type="hidden" name="id_utilisateur" id="id_utilisateur" value="<?php $u ?>" />



                <div class="container_votant_contributeur">
                    <div class="container_contributeur">
                        <label for="organisateurs ">Choisissez les responsables</label>
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
                        <p id="minimum">Min : 1 responsable</p>
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
                        <p id="minimum">Min : 2 votants</p>
                    </div>
                </div>
                <div class='separateur1'></div>
                <div>



                    <?php


                    //var_dump($question);
                    $dateDebutRedaction = htmlspecialchars($v->getDateDebutRedaction());

                    $num=0;
                    //var_dump($sections);
                    foreach ($sections as $section) {
                    $num++;
                    //$questNonFormater = $question->getIdQuestion();
                    //$questFormater = rawurlencode($questNonFormater);
                    $titreSection = $section->getTitre();
                    $idQuestion = $section->getIdQuestion();
                    $sectionFormater = rawurlencode($section->getIdSection());
                    ?>

                    <div class="titre">
                        <?php echo "<h1> Section: {$num} \n".  htmlspecialchars ( $titreSection ) . " </h1> "; ?>
                    </div>
                    <div class="question_description">
                        <div > <?php  echo " Titre : " . htmlspecialchars($section->getTitre()); ?> </div>
                        <div > <?php  echo " Description :  " . htmlspecialchars($section->getTexteExplicatif()) ; ?> </div>
                    <?php
                    if(date('Y-m-d H:i:s') < $dateDebutRedaction) {
                        echo "<div class='question_update'>";
                        echo "<a href=\"frontController.php?controller=section&action=update&id_section={$sectionFormater}&id_question={$idQuestion}\"> <i class='fa-solid fa-pencil'></i> </a>";
                        echo "<a id=\"confirmation\" onclick=\"return confirmationSection()\" href=\"frontController.php?controller=section&action=delete&id_section={$sectionFormater}&id_question={$idQuestion}\"> <i class='fa-solid fa-trash'></i></a>";
                        echo "</div>";
                        //echo "<div class='separateur1'></div>";
                    }

                    echo "<div class='separateur1'></div>";
                    echo "</div>";
                    }


                    echo "<div class='question_description'>";
                    //echo "<div class='separateur1'></div>";
                        echo "<a href=\"frontController.php?controller=section&action=create&id_question={$idQuestion}\"> Ajouter une section </a> ";
                    echo "<div class='separateur1'></div>";
                    echo "</div>";


                    echo "</div>";


                    ?>
                        <input id="valider" type="submit" value="valider" name="valider" />

                </div>

            </div>
        </div>
    </form>
    <script src="../src/js/app.js"></script>


