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
    function getTitrePage(url) {
        if (url == 'http://localhost/ap5TailLocal_v0.3/visiteur/index.php' || url == 'http://localhost/ap5TailLocal_v0.3/visiteur/index.php?uc=connexion&action=deconnexion') {
            return 'Authentification - GSB';
        } else if (url == "http://localhost/ap5TailLocal_v0.3/visiteur/index.php" || url == "http://localhost/ap5TailLocal_v0.3/visiteur/index.php?uc=connexion&action=valideConnexion") {
            return 'Accueil Visiteur - GSB';
        } else if (url == "http://localhost/ap5TailLocal_v0.3/visiteur/index.php?uc=etatFrais&action=selectionnerMois" || url == "http://localhost/ap5TailLocal_v0.3/visiteur/index.php?uc=etatFrais&action=voirEtatFrais") {
            return 'Consulter mes fiches de frais - GSB';
        }
        else if (url == 'http://localhost/ap5TailLocal_v0.3/visiteur/index.php?uc=gererFrais&action=saisirFrais' || url == 'http://localhost/ap5TailLocal_v0.3/visiteur/index.php?uc=gererFrais&action=validerMajFraisForfait' || url == 'http://localhost/ap5TailLocal_v0.3/visiteur/index.php?uc=gererFrais&action=validerCreationFrais' || url == 'http://localhost/ap5TailLocal_v0.3/visiteur/index.php?uc=gererFrais&action=supprimerFrais') {
            return 'Saisir les frais - GSB';
        }
    }
    // fonction qui permet de changer le titre de la page en fonction de la page ou on se trouve
    $("#titrePage").html(getTitrePage(window.location.href));


});
