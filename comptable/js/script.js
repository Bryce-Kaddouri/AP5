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
                'transition': 'transform 1.5s'
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
                'transition': 'transform 1.5s'
            });
        }
    });
    // fin de gestion de la sidebar 

    // début de la gestion du bouton valider une fiche de frais pour le module comptable
    $('#validerFiche').on('click', function () {
        let idVisiteurFiche = $(this).attr('dt-idVisiteur');
        let $moisFiche = $(this).attr('dt-idmoisfiche');
        alert($moisFiche + " " + idVisiteurFiche);

    });


    // fonction pour afficher un modal et supprimer une ligne hors forfait

    $('#supprimerLigne').on('click', function () {
        $('.deleteAction').toggleClass('d-none')

        // recup le texte du bouton qui permet d'afficher les boutons pour supprimer une ligne 
        // si le texte est égale a "Supprimer une ligne" alors on change le texte en "Annuler"
        // sinon on change le texte en "Supprimer une ligne"

        var text = $("#supprimerLigne").text();
        $(this).text(
            text === "Supprimer une ligne" ? "Annuler" : "Supprimer une ligne"
        );
    });

    //fonction sweetAlert pour confirmer la suppression au click sur un bouton qui la class btn-suppr

    $('.btn-suppr').on('click', function () {
        const idVisiteur = $(this).attr('dt-idVisiteur');
        const moisFiche = $(this).attr('dt-moisFiche');
        const idFrais = $(this).attr('dt-idFrais');
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
                    // window.location.href = "index.php?uc=validerFrais&action=rejeterFrais&idFrais=" + idFrais + "&idVisiteur=" + idVisiteur + "&moisFiche=" + moisFiche;
                    window.location.href = "index.php?uc=validerFrais&action=rejeterFrais&idFrais=" + idFrais + "&idVisiteur=" + idVisiteur + "&moisFiche=" + moisFiche;

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

