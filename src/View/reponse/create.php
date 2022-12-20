
<form method="post" action="frontController.php?controller=reponse&action=created">
    <div class="container">
        <div class="container_creerquestion">
            <div class="titre">
                <a id="boutonpublic" class="public"><i class="fa-solid fa-eye"></i> Public</a>
                <h1 class="titre_section">CRÉER UNE REPONSE</h1>
            </div>

            <input type="hidden" value="<?php echo $_GET["id_reponse"]?>" name="id_reponse" >
            <input type="hidden" value="<?php echo $_GET["id_question"]?>" name="id_question" >
            <div class="question_description">
            <?php

            use App\YourVoice\Lib\ConnexionUtilisateur;
            use App\YourVoice\Model\Repository\SectionRepository;
            use App\YourVoice\Model\Repository\UtilisateurRepository;
            $sections = (new SectionRepository())->selectWhere("id_question", $_GET['id_question']);
            if ($sections){
                foreach ($sections as $section){ ?>
                    <input type="hidden" value="<?php echo $section->getIdSection()?>" name="id_section[]" >

                    <label class="ecart_texte" for="titre">Section : <NOBR class = "texte_des"><?php
                            echo $section->getTitre();
                            ?>
                            </NOBR>
                        </label>
                        <!--                <input type="text" placeholder="macrone" name="titre" id="titre" required/>-->



            <label class="ecart_texte" for="description">Description : <NOBR class = "texte_des"><?php
                            echo $section->getTexteExplicatif();
                            ?>
                        </NOBR>
                        </label>

                        <!--<input type="text" placeholder="macron" name="description" id="description" required/>-->




                        <label for="texte[]">Texte</label>


                    <textarea name="texte[]" id="texte[]" cols="90"  rows="6"></textarea>

                <?php }}
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
                if ($users){
                foreach($users as $user)
                {
                ?>
            <div>
                <input type="checkbox"  name="idCoAuteur[]" value="<?php echo $user->getIdUtilisateur()?>">
                <?php echo $user->getLogin()?>
            </div>
        <?php } }?>

                </div>
                </div>

            <!--<p>
                <label for="id_utilisateur">Serra rempli automatiquement avec les sessions</label> :
                <input type="int" placeholder="serra rempli automatiquement avec les sessions" name="id_utilisateur" id="id_utilisateur" required/>
            <p>-->


                <p>
                    <input id="valider" type="submit" value="Créer" name="valider" />
            </p>
        </div>
    </div>



</form>
<script src="../src/js/app.js"></script>

