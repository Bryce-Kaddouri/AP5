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
                )
            }
        })
    });

});
