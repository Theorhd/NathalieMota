/* Gestion Apparition/Disparition Modale Contact */
jQuery(document).ready(function () {
    function openContact() { // Fonction pour ouvrir la modale
        jQuery('.contact-overlay').fadeIn().animate({
            opacity: 1
        }, 600).css('display', 'flex');
    };
    function closeContact() { // Fonction pour fermer la modale
        jQuery('.contact-overlay').fadeOut().animate({
            opacity: 0
        }, 600);
        setTimeout(() => {
            jQuery('.contact-overlay').css('display', 'none');
        }, 650);
    };
    jQuery('.ctaContact').click(function (){ // Ouverture de la modale au clic sur le bouton
        if (jQuery('.contact-overlay').css('display') === 'none') {
            openContact();
        } else {
            closeContact();
        }
    });
    if (refphotoJS) { // Si une réf photo est disponible, on ajoute la valeur dans le champ adapté
        jQuery('.ref-photo-cont span input').val(refphotoJS);
    }
});
/**/
