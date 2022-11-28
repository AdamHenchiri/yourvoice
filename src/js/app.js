/*
document.getElementById("creationQuestion").addEventListener("focus",function (e) {
    var dateDebut_redaction;
    var dateFin_redaction;
    document.getElementById("dateDebut_redaction").addEventListener("focusout", function (e) {
        dateDebut_redaction = e.target.value;
        //alert(dateDebut_redaction);
        //var dateDebut_redaction =document.getElementById("dateDebut_redaction");

    })
    document.getElementById("dateFin_redaction").addEventListener("focusout", function (e) {
        dateFin_redaction = e.target.value;
        //alert(dateFin_redaction);
        //var dateDebut_redaction =document.getElementById("dateDebut_redaction");

    })
    alert(dateFin_redaction + " " + dateFin_redaction);
})
*/
var d = new Date();
document.getElementById("dateDebut_redaction").valueAsDate=d;

function validation()
{

    var dateDebut_redaction = document.forms["creationQuestion"]["dateDebut_redaction"];
    var dateFin_redaction = document.forms["creationQuestion"]["dateFin_redaction"];
    var dateDebut_vote = document.forms["creationQuestion"]["dateDebut_vote"];
    var dateFin_vote = document.forms["creationQuestion"]["dateFin_vote"];

    if (dateFin_redaction.value<dateDebut_redaction.value){
        alert("la date de fin de rédaction doit être postérieur à la date de début de rédaction!!");
        dateFin_redaction.focus();
        return false;
    }
    if (dateDebut_vote.value<dateFin_redaction.value){
        alert("la date de debut de vote doit être postérieur à la date de fin de rédaction!!");
        dateDebut_vote.focus();
        return false;
    }
    if (dateFin_vote.value<dateDebut_vote.value){
        alert("la date de fin de vote doit être postérieur à la date de début de vote!!");
        dateFin_vote.focus();
        return false;
    }

    var elementsC = document.getElementsByName("idContributeur[]");
    var elementsW = document.getElementsByName("idOrganisateur[]");
    var elementsV = document.getElementsByName("idVotant[]");
        countOrganisateur = 0;
        countContributeurs = 0;
        countVotants = 0;

    for (var i = 0; i < elementsC.length; i++){
        if (elementsC[i].checked){
            countContributeurs++;
        }
    }
    for (var j = 0; j < elementsV.length; j++){
        if (elementsV[j].checked){
            countVotants++;
        }
    }
   /* for (var l = 0; j < elementsW.length; l++){
        if (elementsV[l].checked){
            countOrganisateur++;
        }
    }
    if (countOrganisateur === 0){
        alert("vous devez choisir au minimum un organisateurs");
        return false;
    }*/
    if (countContributeurs === 0){
        alert("vous devez choisir au minimum un contributeurs");
        return false;
    }
    if (countVotants <= 4){
        alert("vous devez choisir au minimum cinq votants");
        return false;
    }

    //alert(dateDebut_redaction.value+" "+dateFin_redaction.value+" "+dateDebut_vote.value+" "+dateFin_vote.value);
}

function confirmation(){
    var res = confirm("Êtes-vous sûr de vouloir supprimer cette question?");
    if(! res){
        return false;
    }


}

function confirmationSection() {
    var res = confirm("Êtes-vous sûr de vouloir supprimer cette section?");
    if (!res) {
        return false;
    }
}
let i = 1;
function createSectionRemoveButton() {
    let removeButton = document.createElement("input")
    removeButton.setAttribute("type", "button");
    removeButton.setAttribute("value", "supprimer cette section");
    removeButton.setAttribute("onclick", "removeSection(" + i + ")");
    document
        .getElementById("section-" + i)
        .appendChild(removeButton);
}

function removeSection(a) {
    document.getElementById("section-" + a).remove();
}

function ajouterBtn(){
    ++i;
    const sectionClone = document
        .getElementById("section")
        .cloneNode(true);
    sectionClone.setAttribute("id", "section-"+i );
    const sections = document.getElementById("sections");
    sections.appendChild(sectionClone);
   createSectionRemoveButton();
}
