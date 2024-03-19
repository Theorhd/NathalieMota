<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage NathalieMota
 */

?>

<?php
include './wp-content\themes\nathalieMota\assets\php\block_photo.php'; 
?>

<div class="heroHeader" style="background-image: url(<?php echo $random_post_image; ?>)">
    <h1>PHOTOGRAPHE EVENT</h1>
</div>
<div class="main-page">
    <div class="filter-container">
        <div class="filter-left">
            <div class="filter-categories">
                <select class="filterstyle" id="filter-categories-dropdown">
                    <option value="all">Catégories</option>
                    <option value="concert">Concert</option>
                    <option value="mariage">Mariage</option>
                    <option value="reception">Réception</option>
                    <option value="television">Télévision</option>
                </select>
            </div>
            <div class="filter-formats">
                <select class="filterstyle" id="filter-formats-dropdown">
                    <option value="all">Formats</option>
                    <option value="portrait">Portrait</option>
                    <option value="paysage">Paysage</option>
                </select>
            </div>
        </div>
        <div class="filter-right">
            <div class="sort">
                <select class="filterstyle" id="sort-dropdown">
                    <option value="all">Tirer par</option>
                    <option value="date">Date</option>
                    <option value="title">Titre</option>
                </select>
            </div>
        </div>
    </div>
    <div class="posts-container">
    <?php
$args = array(
    'post_type' => 'photo', 
    'posts_per_page' => 8,
);

$custom_query = new WP_Query($args);

// Boucle WordPress pour afficher les images
if ($custom_query->have_posts()) :
    while ($custom_query->have_posts()) :
        $custom_query->the_post();
        // Récupérer l'URL de l'image en vedette
        $image_url = get_field('image')['url'];
        // Récupérer l'url du post
        $post_url = get_permalink();
        // Vérifier si l'image existe
        if ($image_url) {
            echo '<a href="' . $post_url . '"><img src="' . esc_url($image_url) . '" alt="' . esc_attr(get_the_title()) . '"></a>';
        }
    endwhile;
    // Réinitialiser les données de post
    wp_reset_postdata();
else :
    // Si aucun post trouvé
    echo 'Aucune photo trouvée.';
endif;
?>
    </div>
    <div class="load-more">
        <button id="load-more-photos">Afficher plus</button>
    </div>
</div>