// ce document gere la side bar , et les boutons pour valider une fiche de frais, la mettre en attente et supprimer une ligne hors forfait

$(document).ready(function () {
    // fonction pour afficher changer le background color de l
    $('#sidebar .sideBarItem').on('mouseover', function () {
        //supprimer le background color de l'element precedent
        $(this).css('background-color', '#3c8dbc');
    });
    // fonction pour supprimer le background color de l'element
    $('#sidebar .sideBarItem').on('mouseout', function () {
        $('#sidebar .sideBarItem').css('background-color', 'transparent');
    });

    // début gestion de la sidebar
    $('#btn-menuSVG').on('click', function () {
        // verification si #sidebar est possede la classe largeSidebar
        // Si vrai Alors on la retire et on ajoute la classe smallSidebar ainsi que cacher .infoUser et reduire la taille de #sidebar a 80px
        if ($('#sidebar').hasClass('largeSidebar')) {
            $('#sidebar').removeClass('largeSidebar');
            $('#sidebar').addClass('smallSidebar');
            $('#btn-menu').removeClass('mr-5');
            $('#btn-menu').addClass('mr-auto');
            $('#btn-menu').addClass('ml-auto');
            $('.infoUser').hide();
            $('#sidebar').animate({
                width: '80px'
            });
            // rotation du bouton
            $('#btn-menuSVG').css({
                'transform': 'rotate(180deg)',
                'transition': 'transform 0.8s'
            });

        } else {
            // Sinon on retire la classe smallSidebar et on ajoute la classe largeSidebar ainsi que afficher .infoUser et agrandir la taille de #sidebar a 250px
            $('#sidebar').removeClass('smallSidebar');
            $('#sidebar').addClass('largeSidebar');
            $('.infoUser').show();
            $('#sidebar').animate({
                width: '250px'
            });
            $('#btn-menu').removeClass('mr-auto');
            $('#btn-menu').addClass('mr-5');
            $('#btn-menu').addClass('ml-auto');
            // rotation du bouton
            $('#btn-menuSVG').css({
                'transform': 'rotate(0deg)',
                'transition': 'transform 0.8s'
            });
        }
    });
    // fin de gestion de la sidebar 

    // début de la gestion du bouton valider une fiche de frais pour le module comptable
    $('#validerFiche').on('click', function () {
        let idVisiteurFiche = $(this).attr('dt-idVisiteur');
        let moisFiche = $(this).attr('dt-idmoisfiche');

        Swal.fire({
            title: 'Confirmer la validation de la fiche ?',
            text: "Vous allez confirmer cette fiche de frais ! ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, valider !'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'valider avec succés!',
                    'La fiche de frais a été validée..',
                    'success'
                ).then(() => {
                    // window.location.href = "index.php?uc=validerFrais&action=rejeterFrais&idFrais=" + idFrais + "&idVisiteur=" + idVisiteur + "&moisFiche=" + moisFiche;
                    window.location.href = "index.php?uc=validerFrais&action=validerFicheFrais&idVisiteur=" + idVisiteurFiche + "&moisFiche=" + moisFiche;

                })
            } else {
                Swal.fire(
                    'Annulé',
                    'La fiche de frais n\'a pas été validée',
                    'error'
                )
            }
        })


    });




    // fonction pour afficher un modal et supprimer une ligne hors forfait

    // $('#supprimerLigne').on('click', function () {
    //     $('.deleteAction').toggleClass('d-none')

    //     // recup le texte du bouton qui permet d'afficher les boutons pour supprimer une ligne 
    //     // si le texte est égale a "Supprimer une ligne" alors on change le texte en "Annuler"
    //     // sinon on change le texte en "Supprimer une ligne"

    //     var text = $("#supprimerLigne").text();
    //     $(this).text(
    //         text === "Supprimer une ligne" ? "Annuler" : "Supprimer une ligne"
    //     );
    // });

    //fonction sweetAlert pour confirmer la suppression au click sur un bouton qui la class btn-suppr

    $('.btn-suppr').on('click', function () {
        const idVisiteur = $(this).attr('dt-idVisiteur');
        const moisFiche = $(this).attr('dt-moisFiche');
        const idFrais = $(this).attr('dt-idFrais');
        const idEtat = $(this).attr('dt-etatligne');

        console.log(idVisiteur + " " + moisFiche + " " + idFrais + " " + idEtat);
        // tableau idEtat et libelleEtat
        var etatLigne = {
            1: 'Valider le frais',
            2: 'Mettre en attente',
            3: 'rejeter le frais'
        }

        var option = '';
        //boucle de 1 à 3 
        for (let i = 1; i <= 3; i++) {

            console.log($('.option' + i).val());
            if (i != idEtat) {
                // on supprime l'option qui a la valeur de l'etat de la ligne
                option = option + '<option class="option' + i + '"value="' + i + '">' + etatLigne[i] + '</option>';

            }

        }
        // si 
        Swal.fire({
            title: 'Choisir une action ',
            text: "Vous allez modifier ce frais ! ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Suivant',
            html: '<select class="form-control" id="selectEtatFrais" name="selectEtatFrais">' + option + '</select>'
        }).then((result) => {
            if (result.isConfirmed) {
                let idDeEtat = $('#selectEtatFrais').val();
                console.log(idDeEtat);
                if (idDeEtat == 1) {
                    Swal.fire(
                        'validé avec succés!',
                        'Le frais a été validé !',
                        'success'
                    ).then(() => {
                        // window.location.href = "index.php?uc=validerFrais&action=rejeterFrais&idFrais=" + idFrais + "&idVisiteur=" + idVisiteur + "&moisFiche=" + moisFiche;
                        window.location.href = "index.php?uc=validerFrais&action=majFrais&idFrais=" + idFrais + "&idVisiteur=" + idVisiteur + "&moisFiche=" + moisFiche + "&idEtat=" + idDeEtat;

                    })
                }
                else if (idDeEtat == 2) {
                    Swal.fire(
                        'mis en attente avec succés!',
                        'Le frais a été reporté au mois prochain !',
                        'success'
                    ).then(() => {
                        // window.location.href = "index.php?uc=validerFrais&action=rejeterFrais&idFrais=" + idFrais + "&idVisiteur=" + idVisiteur + "&moisFiche=" + moisFiche;
                        window.location.href = "index.php?uc=validerFrais&action=majFrais&idFrais=" + idFrais + "&idVisiteur=" + idVisiteur + "&moisFiche=" + moisFiche + "&idEtat=" + idDeEtat;

                    })
                } else if (idDeEtat == 3) {
                    Swal.fire(
                        'rejeté avec succés!',
                        'Le frais a été rejeté !',
                        'success'
                    ).then(() => {
                        // window.location.href = "index.php?uc=validerFrais&action=rejeterFrais&idFrais=" + idFrais + "&idVisiteur=" + idVisiteur + "&moisFiche=" + moisFiche;
                        window.location.href = "index.php?uc=validerFrais&action=majFrais&idFrais=" + idFrais + "&idVisiteur=" + idVisiteur + "&moisFiche=" + moisFiche + "&idEtat=" + idDeEtat;
                    })
                }
            } else {
                Swal.fire(
                    'Annulé',
                    'Le frais n\'a pas été modifié',
                    'error'
                )
            }
        })
    });

    // fonction qui permt de récupérer l'url de la page et de retourner un titre en fonction de l'url
    function getAction(url) {
        // recupération de l'action avec une expression régulière qui renvoi tous les parametre de l'url dans un tableau et on recupere le parametre action
        const uc = url.match(/uc=([^&]*)/)[1];
        const action = url.match(/action=([^&]*)/)[1];
        // on retourne le titre en fonction de l'action
        if (uc == 'validerFrais') {
            return 'Validation fiche de frais';
        } else if (uc == 'suivrePaiement') {
            return 'Suivi paiement fiches de frais';
        } else if (uc == 'connexion') {
            if (action == 'valideConnexion') {
                return 'Accueil Comptable'
            } else if (action == 'deconnexion') {
                return 'Authentification Comptable'
            }
        } else {
            return 'Authentification Comptable'

        }

    }
    // recuperation url page
    const url = window.location.href;
    const testParamUrl = url.split('?');
    // explode url avec ? si taille > 1 ==> url a des prametres sinon pas de parametre
    var titre = '';
    if (testParamUrl.length > 1) {
        titre = getAction(url);
    } else {

        titre = "Authentification Comptable"

    }
    // affichge la variable titre dans le h1 de v_entete
    $('#titrePage').text(titre);

    // fonction pour fermer le pop up d'affichage des erreurs avec une class toogle
    // verif regex number 
    $regex = /^[0-9]+$/;

    $('.delete').on('click', function () {
        let numNotif = $(this).attr('dt-numNotif');
        $('.notification.numNotif' + numNotif).remove();
    });

});


