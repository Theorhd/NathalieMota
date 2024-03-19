jQuery(document).ready(function($) {
    var page = 1;
    var canLoad = true;
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
                    $('.posts-container').append(response);
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
});