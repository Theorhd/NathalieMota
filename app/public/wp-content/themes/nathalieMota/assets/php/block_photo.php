<?php
if (is_singular('photo')) {
    /*<----------------- Code fonctionnement Single Page  ----------------->*/
    // Variables ACF
    $image = get_field('image');
    $titre = get_field('titre');
    $refphoto = get_field('ref_photo');
    $categorie = wp_get_post_categories($post->ID, array('fields' => 'names'));
    $annee = get_field('annee');
    $format = get_post_meta($post->ID, 'format', true);
    $type = get_field('type');

    /* Gestion des photos apparentées */
    $categories = get_the_category();
    // Déclaration des variables
    $same_image1 = '';
    $same_image1_link = '';
    $same_image2 = '';
    $same_image2_link = '';
    // Obtient l'ID de l'article actuel
    $current_post_id = get_the_ID();

    //* Requête pour récupérer le post suivant avec l'image *//
    $next_post = get_next_post();
    if ($next_post) {
        $next_post_id = $next_post->ID;
        $next_post_image = get_field('image', $next_post_id)['url'];
        // Get the URL of the next post
        $next_post_url = get_permalink($next_post_id);
    }
    else { // Si next post n'existe pas alors montré le premier article
        $next_post = get_posts(array(
            'post_type' => 'photo',
            'posts_per_page' => 1,
            'orderby' => 'date',
            'order' => 'ASC',
        ));
        $next_post_id = $next_post[0]->ID;
        $next_post_image = get_field('image', $next_post_id)['url'];
        // Obtient l'url du post suivant
        $next_post_url = get_permalink($next_post_id);
    }
    //* Requête pour récupérer le post précédent avec l'image *//
    $prev_post = get_previous_post();
    if ($prev_post) {
        $prev_post_id = $prev_post->ID;
        $prev_post_image = get_field('image', $prev_post_id)['url'];
        // Obtient l'url du post précédent
        $prev_post_url = get_permalink($prev_post_id);
    }
    ?>
    <script> // Gestion de l'affichage des images suivantes et précédentes au hover des fleches
        document.addEventListener('DOMContentLoaded', function() {
            const prevArrow = document.querySelector('.prev-arrow');
            const nextArrow = document.querySelector('.next-arrow');
            const nextImage = document.querySelector('.nextImage');

            prevArrow.addEventListener('mouseover', function() {
                nextImage.style.backgroundImage = 'url(<?php if($prev_post_image) { echo $prev_post_image; } else { echo 'no image found'; } ?>)';
            });

            nextArrow.addEventListener('mouseover', function() {
                nextImage.style.backgroundImage = 'url(<?php if($next_post_image) { echo $next_post_image; } else { echo 'no image found'; } ?>)';
            });
        });
    </script>
    <?php
    //* Chargement des photos associées aux images *//
    if ($categories) {
        // Obtient le slug de la première catégorie
        $category_slug = $categories[0]->slug;
        // Requête pour récupérer les deux posts les plus récents de la catégorie du post actuel
        $args = array(
            'post_type'      => 'photo',
            'posts_per_page' => -1,
            'category_name'  => $category_slug,
            'orderby'        => 'date',
            'order'          => 'DESC',
        );
        $query = new WP_Query($args);
        // Boucle pour recuperer les infos des posts
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();

                // Récupère l'URL de l'article
                $article_url = get_permalink();
                // Récupère l'URL de l'image à partir du champ personnalisé 'image'
                $image_url = get_field('image');
                // Récupère la référence de la photo
                $refphoto = get_field('ref_photo');
                // Récupère le slug de la première catégorie
                $categories = get_the_category();
                $category_slug = $categories[0]->slug;

                // Vérifie si l'identifiant de l'article correspond à l'article actuel
                if ($image_url && get_the_ID() !== $current_post_id) {
                    // Stocke l'URL de l'image, l'URL de l'article, la catégorie et la référence dans un tableau
                    $images_and_links[] = array(
                        'image_url' => $image_url['url'],
                        'article_link' => $article_url,
                        'category' => $category_slug,
                        'ref' => $refphoto,
                    );
                    // Assignation des valeurs
                    if (isset($images_and_links[0])) {
                        $same_image1 = $images_and_links[0]['image_url'];
                        $same_image1_link = $images_and_links[0]['article_link'];
                        $same_image1_ref = $images_and_links[0]['ref'];
                        $same_image1_cat = $images_and_links[0]['category'];
                    }
                    if (isset($images_and_links[1])) {
                        $same_image2 = $images_and_links[1]['image_url'];
                        $same_image2_link = $images_and_links[1]['article_link'];
                        $same_image2_ref = $images_and_links[1]['ref'];
                        $same_image2_cat = $images_and_links[1]['category'];
                    }
                } else {
                    continue;
                }
            }
            wp_reset_postdata();
        }
    }
    ?>
<script>
    // Récupérer la valeur de $refphoto en JavaScript
    let refphotoJS = <?php echo json_encode($refphoto); ?>;
/*^^^^^^____________ Code fonctionnement Single Page  ____________^^^^^^>*/
</script>
<?php
}
?>
<?php
if (is_home() || is_front_page()) {
    // Chargement d'une image aléoatoire pour heroHeader
    /* Page Accueil */
    $random_posts = get_posts(array(
        'post_type' => 'photo',
        'posts_per_page' => 1,
        'orderby' => 'rand',
    ));
    if ($random_posts) {
        $random_post_id = $random_posts[0]->ID;
        $random_post_image = get_field('image', $random_post_id)['url'];
    }
}
?>