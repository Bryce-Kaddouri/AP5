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
            // changer la couleur de la brdure en vert
            $(this).css('border', '2px solid green');
        }
    }
    );


    var myInput = document.getElementById('mdp'); 	//stocker le input mdp dans une variable
    var letter = document.getElementById('lettre');  //Stocker le texte lettre dans une variable
    var capital = document.getElementById('capital');  //Stocker le texte capital dans une variable
    var nombre = document.getElementById('nombre');  //Stocker le texte nombre dans une variable
    var length = document.getElementById('lenght'); //Stocker le texte length dans une variable



    myInput.onfocus = function () {

        document.getElementById("box1").style.display = "block"


    }


    myInput.onblur = function () {

        document.getElementById('box1').style.display = "none"

    }

    myInput.onkeyup = function () {

        var lowerCase = /[a-z]/g

        if (myInput.value.match(lowerCase)) {

            letter.classList.remove('invalid');
            letter.classList.add('valid');

        } else {
            letter.classList.remove('valid');
            letter.classList.add('invalid');
        }

        var upperCase = /[A-Z]/g

        if (myInput.value.match(upperCase)) {
            capital.classList.remove('invalid');
            capital.classList.add('valid');

        } else {

            capital.classList.remove('valid');
            capital.classList.add('invalid');
        }

        var nombres = /[0-9]/g

        if (myInput.value.match(nombres)) {
            nombre.classList.remove('invalid');
            nombre.classList.add('valid');


        } else {

            nombre.classList.remove('valid');
            nombre.classList.add('invalid');
        }

        if (myInput.value.length >= 8) {

            length.classList.remove('invalid');
            length.classList.add('valid');

        } else {

            length.classList.remove('valid');
            length.classList.add('invalid');

        }


    }


});

    // faire une action a chaque changement lors de la saisie de valeur de l'input avec class login




    // verif regex pour le login et change la couleur du champ en fonction du regex

