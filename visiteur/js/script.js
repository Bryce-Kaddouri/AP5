// ce document gere la side bar , et les boutons pour valider une fiche de frais, la mettre en attente et supprimer une ligne hors forfait

$(document).ready(function () {

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

    // toogleclass sur le bouton supprimer ligne qui permet d'afficher les petiti rond rouge pour supprimer une ligne
    $('#supprimerLigne').on('click', function () {
        $('.deleteAction').toggleClass('d-none')
    });

    //fonction sweetAlert pour confirmer la suppression au click sur un bouton qui la class btn-suppr

    $('.btn-suppr').on('click', function () {
        const id = $(this).attr('dt-idVisiteur');
        Swal.fire({
            title: 'Confirmer la suppression ?',
            text: "Vous allez supprimer ce frais ! ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, Supprimer'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Supprimé avec succés!',
                    'Le frais a été supprimé..',
                    'success'
                ).then(() => {
                    window.location.href = "index.php?uc=gererFrais&action=supprimerFrais&idFrais=" + id;

                })
            } else {
                Swal.fire(
                    'Annulé',
                    'Le frais n\'a pas été supprimé',
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
        if (uc == 'gererFrais') {
            return 'Saisie fiche de frais';
        } else if (uc == 'etatFrais') {
            return 'Consultation de mes fiches de frais';
        } else if (uc == 'connexion') {
            if (action == 'valideConnexion') {
                return 'Accueil Visiteur'
            } else if (action == 'deconnexion') {
                return 'Authentification Visiteur'
            }
        } else {
            return 'Authentification Visiteur'

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
        titre = "Authentification Visiteur"
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


