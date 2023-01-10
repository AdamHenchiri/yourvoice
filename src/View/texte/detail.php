
<form method="post" action="#Blank">
    <div class="container">
        <div class="container_creerquestion">
            <div class="titre">
                <h1 class="titre_section">REPONSE</h1>
            </div>
            <div class="question_description">
        <?php

        use App\YourVoice\Model\Repository\SectionRepository;
        use App\YourVoice\Model\Repository\UtilisateurRepository;
        foreach ($textes as $texte){
            $section = (new SectionRepository())->select($texte->getIdSection());
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
                <label for="texte[]">Texte</label>

                <textarea name="texte[]" id="texte[]" cols="90"  rows="6" readonly><?php echo $texte->getTexte() ?></textarea>
                <p>

                </p>
        <?php }} ?>
            </div>
        </div>
</form>



