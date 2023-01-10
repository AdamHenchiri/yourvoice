
<?php
echo '<div class="container">';
echo '<div class="container_creerquestion">';
echo '<div class="container-detail-user">';
echo '<h1 id="moncompte">Mon Compte</h1>';
echo '</div>';
echo '<div class="moncompte_description">';
echo '<div class="login_container1" id="login_container"><p id="login"> Login </p>' . '<p id="login_contain1" class="login_contain">' . htmlspecialchars($user->getLogin()) . '</p></div>';
echo '<div class="separateur_user" id="separateur_user1"></div>';
echo '<div class="login_container2" id="login_container"><p id="login"> Nom  </p>' . '<p id="login_contain2" class="login_contain">' . htmlspecialchars($user->getNom()) . '</p></div>';
echo '<div class="separateur_user" id="separateur_user2" ></div>';
echo '<div class="login_container3" id="login_container"><p id="login"> Prénom  </p>' . '<p id="login_contain3" class="login_contain">' . htmlspecialchars($user->getPrenom()) . '</p></div>';
echo '<div class="separateur_user" id="separateur_user3" ></div>';
echo '<div class="login_container5" id="login_container"><p id="login"> Age  </p>' . '<p id="login_contain5" class="login_contain">' . htmlspecialchars($user->getAge()) . '</p></div>';
echo '<div class="separateur_user" id="separateur_user5" ></div>';
echo '<div class="login_container4" id="login_container"><p id="login"> Email  </p>' . '<p id="login_contain4" class="login_contain">' . htmlspecialchars($user->getEmailAValider()) . '</p></div>';
echo '<div class="separateur_user" id="separateur_user4" ></div>';
echo '<a href="frontController.php?controller=utilisateur&action=update&login= '.rawurldecode($user->getIdUtilisateur()). ' "> <input class="boutton-modifier" type="button" value="Modifier"> </a>';
echo '</div>';
echo '</div>';
echo '</div>';


?>
<script>

    const border1 = document.getElementById('separateur_user1');
    const border2 = document.getElementById('separateur_user2');
    const border3 = document.getElementById('separateur_user3');
    const border4 = document.getElementById('separateur_user4');
    const border5 = document.getElementById('separateur_user5');
    const mouse1 = document.getElementsByClassName('login_container1');
    const mouse2 = document.getElementsByClassName('login_container2');
    const mouse3 = document.getElementsByClassName('login_container3');
    const mouse4 = document.getElementsByClassName('login_container4');
    const mouse5 = document.getElementsByClassName('login_container5');
    const titre1 = document.getElementById('login_contain1');
    const titre2 = document.getElementById('login_contain2');
    const titre3 = document.getElementById('login_contain3');
    const titre4 = document.getElementById('login_contain4');
    const titre5 = document.getElementById('login_contain5');

    for (let i = 0 ; i < mouse1.length; i++) {
        mouse1[i].addEventListener("mouseover", ()=>{
            border1.style.opacity = "1";
            border1.style.width = "90%";
            border1.style.marginTop = "20px";
            border1.style.borderRadius = "0px";
            border1.style.height = "0px";
            border1.style.borderBottom = "1px solid #8b3dff";
            border1.style.backgroundColor = "none";
            titre1.style.fontSize = "20px";
        });

        mouse1[i].addEventListener("mouseout", ()=>{
            border1.style.opacity = "1";
            border1.style.width = "10px";
            border1.style.marginTop = "10px";
            border1.style.height = "10px";
            border1.style.borderRadius = "100%";
            border1.style.border ="none";
            border1.style.backgroundColor = "#8b3dff";
            titre1.style.fontSize = "17px";
        });
    }

    for (let i = 0 ; i < mouse2.length; i++) {
        mouse2[i].addEventListener("mouseover", ()=>{
            border2.style.opacity = "1";
            border2.style.width = "90%";
            border2.style.marginTop = "20px";
            border2.style.borderRadius = "0px";
            border2.style.height = "0px";
            border2.style.borderBottom = "1px solid #8b3dff";
            border2.style.backgroundColor = "none";
            titre2.style.fontSize = "20px";
        });

        mouse2[i].addEventListener("mouseout", ()=>{
            border2.style.opacity = "1";
            border2.style.width = "10px";
            border2.style.marginTop = "10px";
            border2.style.height = "10px";
            border2.style.borderRadius = "100%";
            border2.style.border ="none";
            border2.style.backgroundColor = "#8b3dff";
            titre2.style.fontSize = "17px";
        });
    }

    for (let i = 0 ; i < mouse3.length; i++) {
        mouse3[i].addEventListener("mouseover", ()=>{
            border3.style.opacity = "1";
            border3.style.width = "90%";
            border3.style.marginTop = "20px";
            border3.style.borderRadius = "0px";
            border3.style.height = "0px";
            border3.style.borderBottom = "1px solid #8b3dff";
            border3.style.backgroundColor = "none";
            titre3.style.fontSize = "20px";
        });

        mouse3[i].addEventListener("mouseout", ()=>{
            border3.style.opacity = "1";
            border3.style.width = "10px";
            border3.style.marginTop = "10px";
            border3.style.height = "10px";
            border3.style.borderRadius = "100%";
            border3.style.border ="none";
            border3.style.backgroundColor = "#8b3dff";
            titre3.style.fontSize = "17px";
        });
    }

    for (let i = 0 ; i < mouse4.length; i++) {
        mouse4[i].addEventListener("mouseover", ()=>{
            border4.style.opacity = "1";
            border4.style.width = "90%";
            border4.style.marginTop = "20px";
            border4.style.borderRadius = "0px";
            border4.style.height = "0px";
            border4.style.borderBottom = "1px solid #8b3dff";
            border4.style.backgroundColor = "none";
            titre4.style.fontSize = "20px";
        });

        mouse4[i].addEventListener("mouseout", ()=>{
            border4.style.opacity = "1";
            border4.style.width = "10px";
            border4.style.marginTop = "10px";
            border4.style.height = "10px";
            border4.style.borderRadius = "100%";
            border4.style.border ="none";
            border4.style.backgroundColor = "#8b3dff";
            titre4.style.fontSize = "17px";
        });
    }

    for (let i = 0 ; i < mouse5.length; i++) {
        mouse5[i].addEventListener("mouseover", ()=>{
            border5.style.opacity = "1";
            border5.style.width = "90%";
            border5.style.marginTop = "20px";
            border5.style.borderRadius = "0px";
            border5.style.height = "0px";
            border5.style.borderBottom = "1px solid #8b3dff";
            border5.style.backgroundColor = "none";
            titre5.style.fontSize = "20px";
        });

        mouse5[i].addEventListener("mouseout", ()=>{
            border5.style.opacity = "1";
            border5.style.width = "10px";
            border5.style.marginTop = "10px";
            border5.style.height = "10px";
            border5.style.borderRadius = "100%";
            border5.style.border ="none";
            border5.style.backgroundColor = "#8b3dff";
            titre5.style.fontSize = "17px";
        });
    }
</script>



