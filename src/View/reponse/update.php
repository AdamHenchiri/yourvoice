
<form method="post" action="frontController.php?controller=reponse&action=updated">

    <div class="container">
        <div class="container_creerquestion">
            <div class="titre">
                <a id="boutonpublic" class="public"><i class="fa-solid fa-eye"></i> Public</a>
                <h1 class="titre_section">MODIFIER UNE REPONSE</h1>
            </div>

        <input type="hidden" value="<?php echo $_GET["id_reponse"]?>" name="id_reponse" >
        <input type="hidden" value="<?php echo $_GET["id_question"]?>" name="id_question" >
            <div class="question_description">
        <?php

        use App\YourVoice\Model\Repository\SectionRepository;
        use App\YourVoice\Model\Repository\UtilisateurRepository;
        $sections = (new SectionRepository())->selectWhere("id_question", $_GET['id_question']);
        if ($sections){
            foreach ($sections as $section){ ?>
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
                <label for="texte">Texte</label>
                <textarea name="texte" id="texte" cols="90"  rows="6"></textarea>



            <?php }}
        ?>
                <p>
                    <input id="valider" type="submit" value="Enregistrer" name="valider" />
                </p>
            </div>


</form>
<script src="../src/js/app.js"></script>

