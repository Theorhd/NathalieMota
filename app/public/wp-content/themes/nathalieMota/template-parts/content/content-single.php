
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
// Code de focntionnement de la page Single
include './wp-content/themes/nathalieMota/assets/php/block_photo.php'; 
?>

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
                            <div class="nextImage" style="background-image: url();">
                            </div>
                            <div class="arrows">
                                <a class="prev-arrow" href="<?php echo $prev_post_url ; ?>"><span class="dashicons dashicons-arrow-left-alt2"></span></a>
                                <a class="next-arrow" href="<?php echo $next_post_url ; ?>"><span class="dashicons dashicons-arrow-right-alt2"></span></a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="alsoLike-container">
                    <h3>Vous aimerez aussi</h3>
                    <div class="alsoLike-photos">
                        <?php
                        if ($same_image1) {
                            echo '<a href="' . $same_image1_link . '" class="alsoLike-photo1" style="background-image: url(' . $same_image1 . ')"><div class="image-overlay"><button class="overlay-fullscreen" data-photourl="' . $same_image1_link . '" data-ref="' . $same_image1_ref . '" data-category="' . $same_image1_cat . '"></button><div class="overlay-logo"></div><div class="overlay-infos"><p>' . $same_image1_ref . '</p><p>' . $same_image1_cat . '</p></div></div></a>';
                        }
                        if ($same_image2) {
                            echo '<a href="' . $same_image2_link . '" class="alsoLike-photo2" style="background-image: url(' . $same_image2 . ')"><div class="image-overlay"><button class="overlay-fullscreen" data-photourl="' . $same_image2_link . '" data-ref="' . $same_image2_ref . '" data-category="' . $same_image2_cat . '"></button><div class="overlay-logo"></div><div class="overlay-infos"><p>' . $same_image2_ref . '</p><p>' . $same_image2_cat . '</p></div></div></a>';
                        }
                        ?>
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
                            <div class="nextImage" style="background-image: url();">
                            </div>
                            <div class="arrows">
                                <a class="prev-arrow" href="<?php echo $prev_post_url ; ?>"><span class="dashicons dashicons-arrow-left-alt2"></span></a>
                                <a class="next-arrow" href="<?php echo $next_post_url ; ?>"><span class="dashicons dashicons-arrow-right-alt2"></span></a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                    <div class="alsoLike-container">
                        <h3>Vous aimerez aussi</h3>
                        <div class="alsoLike-photos">
                        <?php
                        if ($same_image1) {
                            echo '<a href="' . $same_image1_link . '" class="alsoLike-photo1" style="background-image: url(' . $same_image1 . ')"><div class="image-overlay"><button class="overlay-fullscreen" data-photourl="' . $same_image1_link . '" data-ref="' . $same_image1_ref . '" data-category="' . $same_image1_cat . '"></button><div class="overlay-logo"></div><div class="overlay-infos"><p>' . $same_image1_ref . '</p><p>' . $same_image1_cat . '</p></div></div></a>';
                        }
                        if ($same_image2) {
                            echo '<a href="' . $same_image2_link . '" class="alsoLike-photo2" style="background-image: url(' . $same_image2 . ')"><div class="image-overlay"><button class="overlay-fullscreen" data-photourl="' . $same_image2_link . '" data-ref="' . $same_image2_ref . '" data-category="' . $same_image2_cat . '"></button><div class="overlay-logo"></div><div class="overlay-infos"><p>' . $same_image2_ref . '</p><p>' . $same_image2_cat . '</p></div></div></a>';
                        }
                        ?>
                        </div>
                    </div>
            <?php } endif; ?>

        <?php
        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nathalieMota' ),
            'after'  => '</div>',
        ) );
        ?>
    </div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
