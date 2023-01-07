<form method="post" action="frontController.php?controller=reponse&action=updated">
    <div class="container">
        <div class="container_creerquestion">
            <div class="titre">
                <h1 class="titre_section">MODIFIER UNE REPONSE</h1>
            </div>
            <div class="question_description">
                <?php

                use App\YourVoice\Lib\ConnexionUtilisateur;
                use App\YourVoice\Model\Repository\SectionRepository;
                use App\YourVoice\Model\Repository\UtilisateurRepository;

                foreach ($textes as $texte) {
                    $section = (new SectionRepository())->select($texte->getIdSection());

                    if ($section) { ?>

                        <input type="hidden" value="<?php echo $section->getIdQuestion() ?>" name="id_question">
                        <input type="hidden" value="<?php echo $_GET["id_reponse"] ?>" name="id_reponse">
                        <input type="hidden" value="<?php echo $section->getIdSection() ?>" name="id_section[]">

                        <label class="ecart_texte" for="titre">Section :
                            <NOBR class="texte_des"><?php
                                echo $section->getTitre();
                                ?>
                            </NOBR>
                        </label>
                        <label class="ecart_texte" for="description">Description :
                            <NOBR class="texte_des"><?php
                                echo $section->getTexteExplicatif();
                                ?>
                            </NOBR>
                        </label>
                        <label for="texte[]">Texte</label>

                        <textarea name="texte[]" id="texte[]" cols="90"
                                  rows="6"><?php echo $texte->getTexte() ?></textarea>
                        <?php $coauteurs = (new \App\YourVoice\Model\Repository\CoauteurRepository())->selectWhere("id_reponse", $texte->getIdReponse());

                    }
                }
                $reponse =(new \App\YourVoice\Model\Repository\ReponseRepository)->select($texte->getIdReponse());
                if (ConnexionUtilisateur::estResponsableReponse($reponse) || \App\YourVoice\Lib\ConnexionAdmin::estConnecte()) {
                ?>

                <div class="separateur1"></div>


                <div class="container_votant">
                    <label for="idCoAuteur ">Choisissez les co-auteurs</label>
                    <div id="affichevotant">
                    </div>
                    <div class="scroll_votant">


                        <?php
                        $users = (new UtilisateurRepository())->selectAll();
                        if ($users) {
                            foreach ($users as $user) {
                                if ($user != ConnexionUtilisateur::getUtilisateurConnecte() ){

                                    $aux = false;
                                foreach ($coauteurs as $coauteur) {
                                    if ($user->getIdUtilisateur() == $coauteur->getIdUtilisateur()) {
                                        ?>
                                        <div>
                                            <input type="checkbox" name="idCoAuteur[]"
                                                   value="<?php echo $user->getIdUtilisateur() ?>" checked>
                                            <?php echo $user->getLogin();
                                            $aux = true; ?>
                                        </div>
                                    <?php }
                                }
                                if ($aux === false) { ?>
                                    <div>
                                        <input type="checkbox" name="idCoAuteur[]"
                                               value="<?php echo $user->getIdUtilisateur() ?>">
                                        <?php echo $user->getLogin(); ?>
                                    </div>
                                <?php } ?>
                            <?php }
                        }}
                        echo "</div></div>";
                        }
                        ?>
                        <p>
                            <input id="valider" type="submit" value="Enregistrer" name="valider"/>
                        </p>
                    </div>
                </div>
            </div>
</form>

