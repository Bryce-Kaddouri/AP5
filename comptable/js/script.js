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

    // toogleclass sur le bouton supprimer ligne qui permet d'afficher les petit rond rouge pour supprimer une ligne
    $('#supprimerLigne').on('click', function () {
        $('.deleteAction').toggleClass('d-none')

        //permet de changer le texte du bouton de suppression des lignes 
        // ? permet de verifier si le bouton contient le texte supprimer ou annuler
        // : permet de faire un if else
        // $(this).text() permet de recuperer le texte du bouton
        // $(this).text($(this).text() == 'Supprimer' ? 'Annuler' : 'Supprimer') permet de changer le texte du bouton
        // $(this).text() == 'Supprimer' ? 'Annuler' : 'Supprimer' permet de verifier si le texte du bouton est supprimer ou annuler
        $('#supprimerLigne').text() == 'Supprimer une ligne' ? $('#supprimerLigne').text('Annuler') : $('#supprimerLigne').text('Supprimer une ligne')
    });

    //fonction sweetAlert pour confirmer la suppression au click sur un bouton qui la class btn-suppr

    $('.btn-suppr').on('click', function () {
        const idFrais = $(this).attr('dt-idFrais');
        const idVisiteur = $(this).attr('dt-idVisiteur');
        console.log(idFrais)
        console.log(idVisiteur)

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
                    window.location.href = "index.php?uc=validerFrais&action=rejeterFrais&idFrais=" + idFrais + "&idVisiteur=" + idVisiteur;

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


    // fonction valider fiche de frais pour un visiteur 
    $('.btn-suppr').on('click', function () {
        const idFrais = $(this).attr('dt-idFrais');
        const idVisiteur = $(this).attr('dt-idVisiteur');
        console.log(idFrais)
        console.log(idVisiteur)

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
                    window.location.href = "index.php?uc=validerFrais&action=rejeterFrais&idFrais=" + idFrais + "&idVisiteur=" + idVisiteur;

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

});
