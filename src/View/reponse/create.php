
<form method="post" action="frontController.php?controller=reponse&action=created">
    <div class="container">
        <div class="container_creerquestion">
            <div class="titre">
                <h1 class="titre_section">CRÉER UNE REPONSE</h1>
            </div>

            <input type="hidden" value="<?php echo $_GET["id_reponse"]?>" name="id_reponse" >
            <input type="hidden" value="<?php echo $_GET["id_question"]?>" name="id_question" >
            <div class="question_description">
            <?php

            use App\YourVoice\Lib\ConnexionUtilisateur;
            use App\YourVoice\Model\Repository\SectionRepository;
            use App\YourVoice\Model\Repository\UtilisateurRepository;
            $q = (new \App\YourVoice\Model\Repository\QuestionRepository())->select($_GET["id_question"]);
            $sections = (new SectionRepository())->selectWhere("id_question", $_GET['id_question']);
            if ($sections){
                foreach ($sections as $section){
                    if (!$section->isActif()){
                        ?>
                    <input type="hidden" value="<?php echo $section->getIdSection()?>" name="id_section[]" >

                    <label class="ecart_texte" for="titre">Section : <NOBR class = "texte_des"><?php
                            echo $section->getTitre();
                            ?>
                            </NOBR>
                        </label>




            <label class="ecart_texte" for="description">Description : <NOBR class = "texte_des"><?php
                            echo $section->getTexteExplicatif();
                            ?>
                        </NOBR>
                        </label>

                        <!--<input type="text" placeholder="macron" name="description" id="description" required/>-->




                        <label for="texte[]">Texte</label>


                    <textarea name="texte[]" id="texte[]" cols="90"  rows="6"></textarea>

                <?php }}}
            ?>

                <div class="separateur1"></div>


                <div class="container_votant">
                    <label for="idCoAuteur ">Choisissez les
                        co-auteurs</label>
                    <div id="affichevotant">
                    </div>
                    <div class="scroll_votant">

                <?php


                $users = (new UtilisateurRepository())->selectAll();
                $responsables = (new \App\YourVoice\Model\Repository\ReponseRepository())->selectWhere("id_question",$_GET["id_question"]);
                $tabRes=[];
                foreach ($responsables as $r){
                    array_push($tabRes,(new UtilisateurRepository())->select($r->getIdUtilisateur())) ;
                }
                if ($users){
                foreach($users as $user){
                    if ($user != ConnexionUtilisateur::getUtilisateurConnecte() && !in_array($user,$tabRes)){
                ?>
            <div>
                <input type="checkbox"  name="idCoAuteur[]" value="<?php echo $user->getIdUtilisateur()?>">
                <?php echo $user->getLogin()?>
            </div>
        <?php } }}?>

                </div>
                </div>




                <p>
                    <input id="valider" type="submit" value="Créer" name="valider" />
            </p>
        </div>
    </div>



</form>
<script src="../src/js/app.js"></script>

