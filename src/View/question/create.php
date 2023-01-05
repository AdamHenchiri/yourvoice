<form method="post" action="frontController.php?controller=question&action=created" name="creationQuestion"
      id="creationQuestion" onsubmit="return validation()">
    <div class="container">
        <div class="container_creerquestion">
            <div class="titre">
                <h1>CRÉER UNE QUESTION</h1>
            </div>
            <div class="separateur1">
            </div>
            <div class="container_date">
                <div class="date_redac">
                    <div class="date_all">
                        <label for="dateDebut_redaction">Début de la rédaction de la réponse :</label>
                        <input type="date" placeholder="" name="dateDebut_redaction" id="dateDebut_redaction" required/>
                        <?php if (isset($_POST["message_11"])) {
                            echo $_POST["message_11"];
                        }
                        if (isset($_POST["message_12"])) {
                            echo $_POST["message_12"];
                        }

                        ?>
                    </div>
                    <div class="date_all">
                        <label for="dateFin_redaction">Fin de la rédaction de la réponse :</label>
                        <input type="date" placeholder="" name="dateFin_redaction" id="dateFin_redaction" required/>
                    </div>
                </div>

                <div class="date_redac">
                    <div class="date_all">
                        <label for="dateDebut_vote">Début du vote :</label>
                        <input type="date" placeholder="" name="dateDebut_vote" id="dateDebut_vote" required/>
                    </div>
                    <div class="date_all">
                        <label for="dateFin_vote">Fin du vote : </label>
                        <input type="date" placeholder="" name="dateFin_vote" id="dateFin_vote" required/>
                    </div>
                </div>
            </div>

            <div class="separateur1">
            </div>


            <div class="container_votant_contributeur">
                <div class="container_contributeur">
                    <label for="contributeurs">Choisissez les responsables</label>
                    <div id="affichecontributeur">
                        <div id="surpluscontributeur">

                        </div>
                    </div>
                    <div class="scroll_votant">

                        <?php

                        use App\YourVoice\Model\Repository\UtilisateurRepository;
                        use App\YourVoice\Lib\ConnexionUtilisateur;
                        $users = (new UtilisateurRepository())->selectAll();
                        if ($users) {
                            foreach ($users as $user) {
                                if ($user != ConnexionUtilisateur::getUtilisateurConnecte()){
                                ?>
                                <div class="checkbox">
                                    <input type="checkbox" name="idContributeur[]"
                                           value="<?php echo $user->getIdUtilisateur() ?>"
                                           id="<?php echo $user->getLogin() ?>">
                                    <?php echo $user->getLogin() ?>
                                </div>
                            <?php }}
                        } ?>

                    </div>
                    <p id="minimum">Min : 1 Responsable</p>
                </div>


                <div class="container_votant">
                    <label for="votants ">Choisissez les votants</label>
                    <div id="affichevotant">
                        <div id="surplusvotant">

                        </div>
                    </div>
                    <div class="scroll_votant">


                        <?php


                        $users = (new UtilisateurRepository())->selectAll();
                        if ($users) {
                            foreach ($users as $user) {
                                if ($user != ConnexionUtilisateur::getUtilisateurConnecte()){

                                    ?>
                                <div class="checkbox">
                                    <input type="checkbox" name="idVotant[]"
                                           value="<?php echo $user->getIdUtilisateur() ?>"
                                           id="<?php echo $user->getLogin() ?>">
                                    <?php echo $user->getLogin() ?>
                                </div>
                            <?php }}
                        } ?>

                    </div>
                    <p id="minimum">Min : 2 votants</p>
                </div>
            </div>

            <div class="separateur2">
            </div>

            <div class="question_description">
                <label for="intitule">Intitulé</label>
                <textarea placeholder=" Titre de la question" name="intitule" id="intitule" rows="10"
                          required></textarea>

                <label for="explication">Développement de la question</label>
                <textarea placeholder=" Pour aller plus loin..." name="explication" id="explication" cols="10" rows="10"
                          required></textarea>
            </div>

            <div class="separateur1">
            </div>


            <div class="section_main">
                <div class="soussection" id="sections">
                    <h1>CRÉER UNE SECTION</h1>
                    <div class="soussection1" id="section">
                        <div class="container_section">
                            <label for="titre">Titre</label>
                            <textarea placeholder="Je vais bien " name="titre[]" id="titre[]" rows="8"
                                      required></textarea>
                        </div>
                        <div class="container_section">
                            <label for="texte_explicatif">Texte explicatif</label>
                            <textarea placeholder="Pourquoi je vais bien" name="texte_explicatif[]"
                                      id="texte_explicatif[]" rows="8" required></textarea>
                        </div>
                    </div>

                </div>
                <script type="text/javascript" src="../src/js/app.js"></script>
                <a onclick="ajouterBtn()"><i class="fa-solid fa-plus"></i></a>
            </div>


            <input id="valider" type="submit" value="Créer" name="valider"/>
        </div>
    </div>
</form>

<script src="../src/js/app.js"></script>
<script>
    var public = true;
    var boutton = document.getElementById("boutonpublic")
    boutton.addEventListener("click", () => {
        if (public) {
            boutton.classList.add("priver");
            boutton.classList.remove("public");
            public = false;
            boutton.innerHTML = '<i class="fa-solid fa-eye-slash"></i> Privé';

        } else {
            boutton.classList.add("public");
            boutton.classList.remove("priver");
            public = true;
            boutton.innerHTML = '<i class="fa-solid fa-eye"></i> Public';
        }
    });


</script>



