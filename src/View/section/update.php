
<form method="post" action="frontController.php?controller=section&action=updated">
    <div class="container">
        <div class="container_creerquestion">
            <div class="titre">
                <h1 class="titre_section">METTRE A JOUR LA SECTION</h1>
            </div>
        <input id="id_section" name="id_section" type="hidden" value=<?php echo $v->getIdSection() ?> >
        <input id="id_question" name="id_question" type="hidden" value=<?php echo $v->getIdQuestion() ?> >
            <div class="question_description">
            <label for="titre">Titre</label>

            <textarea name="titre" id="titre" cols="9"  rows="6" required><?php echo $v->getTitre(); ?></textarea>


            <label for="texte_explicatif">Texte explicatif</label>

            <textarea name="texte_explicatif" id="texte_explicatif" cols="9"  rows="6" required><?php echo $v->getTexteExplicatif(); ?></textarea>


        <p>
            <input id="valider" type="submit" value="Finir" name="finirBtn" />
        </p>
        <!--<button name="ajouterBtn" onclick="window.location.href = 'frontController.php?controller=section&action=created';">Ajouter une section</button>

        <button name="finirBtn" onclick="window.location.href = 'frontController.php?controller=question&action=readAll';">Finir</button>-->
        </div>
    </div>
</form>


