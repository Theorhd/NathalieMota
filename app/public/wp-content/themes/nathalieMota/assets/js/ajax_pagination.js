jQuery(document).ready(function($) {
    var page = 1;
    var canLoad = true;
    // Gestionnaire d'événement pour les changements de filtres
    $('.filterstyle').change(function() {
        // Réinitialiser la page à 1 à chaque changement de filtre
        page = 1;
        loadPhotos();
    });
    $('.custom-select ul li').on('click', function() {
        page = 1;
        loadPhotos();
    });
    $('#load-more-photos').on('click', function() {
        if(canLoad) {
            page++;
            loadPhotos();
        }
    });
    function loadPhotos() {
        $.ajax({
            url: ajaxpagination.ajaxurl,
            type: 'post',
            data: {
                action: 'load_more_photos',
                page: page,
                categories: $('#filter-categories-dropdown').val(),
                formats: $('#filter-formats-dropdown').val(),
                sort: $('#sort-dropdown').val()
            },
            beforeSend: function() {
                canLoad = false;
                $('#load-more-photos').text('Chargement en cours...');
            },
            success: function(response) {
                if(response) {
                    if (page === 1) {
                        // Si c'est la première page, vider le contenu existant
                        $('.posts-container').html(response);
                    } else {
                        // Ajouter les nouvelles photos à la fin des photos existantes
                        $('.posts-container').append(response);
                    }
                    $('#load-more-photos').text('Afficher plus');
                    canLoad = true;
                } else {
                    $('#load-more-photos').text('Toutes les photos ont été chargées.');
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log(xhr.responseText);
            }
        });
    }
    // Charger les photos au chargement initial de la page
    loadPhotos();
});