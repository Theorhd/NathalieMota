/* Gestion Apparition/Disparition Modale Contact */
$(document).ready(function () {
    $('.ctaContact').click(function (){ 
        if ($('.contact-overlay').css('display') === 'none') {
            openContact();
        } else {
            closeContact();
        }
    });
    function openContact() {
        $('.contact-overlay').fadeIn().animate({
            opacity: 1
        }, 600).css('display', 'flex');
    }

    function closeContact() {
        $('.contact-overlay').fadeOut().animate({
            opacity: 0
        }, 600);
        setTimeout(() => {
            $('.contact-overlay').css('display', 'none');
        }, 650);
    };
});
/**/