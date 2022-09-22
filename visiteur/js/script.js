$(document).ready(function () {
    // fonction qui gere la side bar
    $('#btn-menu').click(function () {
        $(".infoUser").toggle(
            function () {
                $(".infoUser").addClass('d-none')
                $("#sidebar").addClass('w-18')
                // $('#btn-menuSVG').addClass('rotate180')
                $('#btn-menuSVG').css('transform', 'rotate(180deg)')
            },
            function () {
                $(".infoUser").removeClass('d-none')
                $("#sidebar").removeClass('w-64')
                $('#btn-menuSVG').addClass('rotate180')
                console.log('test retour')

            }
        );
    })
    // fin fonction qui gere la side bar

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


});
