use function \wp_get_post_categories;
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
$custom_field_name = 'image';
$categories = get_the_category();
// Déclaration des variables
$same_image1 = '';
$same_image1_link = '';
$same_image2 = '';
$same_image2_link = '';
// Obtient l'ID de l'article actuel
$current_post_id = get_the_ID();

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
            $image_url = get_field($custom_field_name);
            // Vérifie si l'identifiant de l'article correspond à l'article actuel
            if ($image_url && get_the_ID() !== $current_post_id) {
                // Stocke l'URL de l'image et l'URL de l'article dans un tableau
                $images_and_links[] = array(
                    'image_url' => $image_url['url'],
                    'article_link' => $article_url,
                );
                // Assignation des valeurs
                if (isset($images_and_links[0])) {
                    $same_image1 = $images_and_links[0]['image_url'];
                    $same_image1_link = $images_and_links[0]['article_link'];
                }
                if (isset($images_and_links[1])) {
                    $same_image2 = $images_and_links[1]['image_url'];
                    $same_image2_link = $images_and_links[1]['article_link'];
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
    // Récupérer la valeur des images en JavaScript pour les afficher en BgImage
    let sameImage1 = <?php echo json_encode($same_image1); ?>;
    let sameImage2 = <?php echo json_encode($same_image2); ?>;
/*^^^^^^------------ Code fonctionnement Single Page  ------------^^^^^^>*/
</script>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">
            <?php if ( $format === 'paysage') : { // Si la photo est au format paysage ?>
                <div class="content-container">
                    <div class="left-side-paysage">
                        <h2><?php echo $titre; ?></h2>
                        <p>Référence : <?php echo $refphoto; ?></p>
                        <p>Catégorie : <?php echo $categorie[0]; ?></p>
                        <p>Format : <?php echo $format; ?></p>
                        <p>Type : <?php echo $type; ?></p>
                        <p>Année : <?php echo $annee; ?></p>
                        <div class="ctaphoto-contact">
                            <h5>Cette photo vous intéresse ?</h5>
                            <button class="ctaContact">Contact</button>
                        </div>
                    </div>
                    <div class="right-side-paysage">
                        <div class="post-image-paysage" style="background-image: url('<?php echo $image['url']; ?>')">
                        </div>
                        <div class="nextPhoto">
                            <div class="nextImage" style="background: black;">
                            </div>
                            <div class="arrows">
                                <span class="dashicons dashicons-arrow-left-alt2"></span>
                                <span class="dashicons dashicons-arrow-right-alt2"></span>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="alsoLike-container">
                    <h3>Vous aimerez aussi</h3>
                    <div class="alsoLike-photos">
                        <a href="<?php echo $same_image1_link ; ?>" class="alsoLike-photo1"></a>
                        <a href="<?php echo $same_image2_link ; ?>" class="alsoLike-photo2"></a>
                    </div>
                </div>
            </div>
            <?php } endif; ?>

            <?php if ( $format === 'portrait') : { // Si photo format portrait ?> 
                <div class="content-container">
                    <div class="left-side-portrait">
                        <h2><?php echo $titre; ?></h2>
                        <p>Référence : <?php echo $refphoto; ?></p>
                        <p>Catégorie : <?php echo $categorie[0]; ?></p>
                        <p>Format : <?php echo $format; ?></p>
                        <p>Type : <?php echo $type; ?></p>
                        <p>Année : <?php echo $annee; ?></p>
                        <div class="ctaphoto-contact">
                            <h5>Cette photo vous intéresse ?</h5>
                            <button class="ctaContact">Contact</button>
                        </div>
                    </div>
                    <div class="right-side-portrait">
                        <div class="post-image-portrait" style="background-image: url('<?php echo $image['url']; ?>')">
                        </div>
                        <div class="nextPhoto">
                            <div class="nextImage" style="background: black;">
                            </div>
                            <div class="arrows">
                                <span class="dashicons dashicons-arrow-left-alt2"></span>
                                <span class="dashicons dashicons-arrow-right-alt2"></span>
                            </div>
                            
                        </div>
                    </div>
                </div>
                    <div class="alsoLike-container">
                        <h3>Vous aimerez aussi</h3>
                        <div class="alsoLike-photos">
                            <a href="<?php echo $same_image1_link ; ?>" class="alsoLike-photo1"></a>
                            <a href="<?php echo $same_image2_link ; ?>" class="alsoLike-photo2"></a>
                        </div>
                    </div>
            <?php } endif; ?>

        <?php
        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'your-theme-text-domain' ),
            'after'  => '</div>',
        ) );
        ?>
    </div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->