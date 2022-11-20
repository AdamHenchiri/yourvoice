<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Créer Question</title>
</head>
<body>
<form method="post" action="frontController.php?controller=question&action=created" name="creationQuestion" id="creationQuestion" onsubmit="return validation()">
<div class="container">
    <div class="container_creerquestion">
        <div class="titre">
            <a id="boutonpublic" class="public"><i class="fa-solid fa-eye"></i> Public</a>
            <h1>Créer une question :</h1>
        </div>

        <div class="question_description">
            <label for="intitule">Intitulé</label>
            <textarea placeholder="Titre de la question" name="intitule" id="intitule" rows="10" required></textarea>

            <label for="explication">Développement de la question</label>
            <textarea placeholder="Pour aller plus loin..." name="explication" id="explication" cols="10" rows="10" required></textarea>
        </div>

        <div class="separateur1">
        </div>

        <div class="container_date">
            <div class="date_redac">
                <div class="date_all">
                <label for="dateDebut_redaction">Début de la rédaction :</label>
                <input type="date" placeholder="" name="dateDebut_redaction" id="dateDebut_redaction" readonly/>
                <?php  if(isset($_POST["message_11"] )){ echo $_POST["message_11"]; }
                   if(isset($_POST["message_12"] )){ echo $_POST["message_12"]; }

                ?>
                </div>
                <div class="date_all">
                <label for="dateFin_redaction">Fin de la rédaction :</label>
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


          <!--  <label for="id_utilisateur">Serra rempli automatiquement avec les sessions</label> :
            <input type="int" placeholder="serra rempli automatiquement avec les sessions" name="id_utilisateur" id="id_utilisateur" required/>-->


        <div class="container_votant_contributeur">
            <div class="container_contributeur">
            <label for="contributeurs">Choisissez les contributeurs</label>
            <div id="affichecontributeur">

            </div>
            <div class="scroll_votant">

                <?php
            use App\YourVoice\Model\Repository\UtilisateurRepository;
            $users = (new UtilisateurRepository())->selectAll();
            if ($users){
            foreach($users as $user)
            {
            ?>
        <div class="checkbox">
            <input type="checkbox" name="idContributeur[]" value="<?php echo $user->getLogin()?>">
            <?php echo $user->getLogin()?>
        </div>
    <?php } }?>

            </div>
                <p id="minimum">Min : 5 contributeurs</p>
            </div>



        <div class="container_votant">
        <label for="votants ">Choisissez les votants</label>
        <div id="affichevotant">
        </div>
        <div class="scroll_votant">


            <?php


            $users = (new UtilisateurRepository())->selectAll();
            if ($users){
            foreach($users as $user)
            {
            ?>
        <div class="checkbox">
            <input type="checkbox"  name="idVotant[]" value="<?php echo $user->getLogin()?>">
            <?php echo $user->getLogin()?>
        </div>
    <?php } }?>

        </div>
            <p id="minimum">Min : 5 votants</p>
        </div>
        </div>

    </fieldset>

    <fieldset id="sections">
        <legend>Creer une section :</legend>
        <div id="section">
        <p>
            <label for="titre">Titre</label> :
            <textarea placeholder="Je vais bien " name="titre[]" id="titre[]" required></textarea>
        </p>
        <p>
            <label for="texte_explicatif">Texte explicatif</label> :
            <textarea placeholder="Pourquoi je vais bien" name="texte_explicatif[]" id="texte_explicatif[]" required></textarea>
        </p>
        </div>
    </fieldset>
        <p>
            <script type="text/javascript" src="../src/js/app.js"></script>
            <input type="button" value="Ajouter une nouvelle section" onclick="ajouterBtn()"/>
        </p>


    <p>
        <input type="submit" value="Créer" name="valider" />
    </p>
</form>
<script src="../src/js/app.js"></script>

<script src="../src/js/app.js"></script>
<script>
    var public = true;
    var boutton = document.getElementById("boutonpublic")
    boutton.addEventListener("click", ()=>{
        if(public){
            boutton.classList.add("priver");
            boutton.classList.remove("public");
            public = false;
            boutton.innerHTML = '<i class="fa-solid fa-eye-slash"></i> Privé';

        }else{
            boutton.classList.add("public");
            boutton.classList.remove("priver");
            public = true;
            boutton.innerHTML = '<i class="fa-solid fa-eye"></i> Public';
        }
    });

    const listevotant = document.querySelectorAll("input[type=checkbox][name='idVotant[]']");
    const listecontributeur = document.querySelectorAll("input[type=checkbox][name='idContributeur[]']");

    function ajoutVotant(name){
        const div = document.createElement("div");
        div.innerHTML = name;
        div.id = name;
        document.getElementById("affichevotant").appendChild(div);

    }

    function ajoutContributeur(name){
        const div = document.createElement("div");
        div.innerHTML = name;
        div.id = name;
        document.getElementById("affichecontributeur").appendChild(div);

    }


    for(e of listevotant){
        const contient = e;
        contient.addEventListener("change", ()=>{
            if(contient.checked){
                ajoutVotant(contient.value);
            }else{
                document.getElementById(contient.value).remove();
            }
        });
    }

    for(c of listecontributeur){
        const contient1 = c;
        contient1.addEventListener("change", ()=>{
            if(contient1.checked){
                ajoutContributeur(contient1.value);
            }else{
                document.getElementById(contient1.value).remove();
            }
        });
    }

</script>

</body>
</html>

