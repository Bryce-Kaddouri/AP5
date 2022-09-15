$(document).ready(function () {

    // changer de couleur la bordure d'un input avec jquery lorsque l'utilisateur saisi du texte
    // et que la regex ne correspond pas
    // et remettre la couleur d'origine lorsque la regex correspond 
    // et que l'utilisateur efface le texte
    // et que l'utilisateur clique sur le bouton valider
    // regex pour le pseudo
    var regexPseudo = /^[a-zA-Z0-9éèêëïîôöûüçàâä-]{2,20}$/;
    $('.login').on('keyup', function () {
        // si la regex ne correspond pas
        if (!regexPseudo.test($(this).val())) {
            // changer la couleur de la bordure
            $(this).css('border', '2px solid red');
        } else {
            // remettre la couleur d'origine
            $(this).css('border', '2px solid green');
        }
    }
    );

    // regex pour le mot de passe avec 
    // au moins une lettre minuscule // au moins une deux majuscule
    // au moins un chiffre //sans espace ni caractere speciaux 
    // et de 8 à 20 caractères 
    var regexMdp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$/;

    $('#mdp').on('keyup', function () {
        // si la regex ne correspond pas
        if (!regexMdp.test($(this).val())) {
            // changer la couleur de la bordure
            $(this).css('border', '2px solid red');
            if ($this.val().length < 8) {
                alert('Le mot de passe doit contenir au moins 8 caractères');
            } else if ($this.val().length > 20) {
                alert('Le mot de passe doit contenir au plus 20 caractères');
            }
        }
        else {
            // remettre la couleur d'origine
            $(this).css('border', '2px solid green');
        }
    }
    );
});

    // faire une action a chaque changement lors de la saisie de valeur de l'input avec class login




    // verif regex pour le login et change la couleur du champ en fonction du regex

