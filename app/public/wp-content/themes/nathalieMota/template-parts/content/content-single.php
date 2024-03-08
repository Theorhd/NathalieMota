<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Your_Theme_Name
 */

?>

<?php
$image = get_field('image');
$titre = get_field('titre');
$refphoto = get_field('ref_photo');
$categorie = get_field('categorie');
$annee = get_field('annee');
$format = get_field('format');
$type = get_field('type');
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">
        <?php if ( $format === 'paysage') : { ?>
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
                        <button>Contact</button>
                    </div>
                </div>
                <div class="right-side-paysage">
                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                </div>
            </div>
            <div class="alsoLike-container">
                <h3>Vous aimerez aussi</h3>
                <div class="alsoLike-photos">
                    <div class="alsoLike-photo1"></div>
                    <div class="alsoLike-photo2"></div>
                    <div class="alsoLike-photo3"></div>
                </div>
            </div>
        </div>
        <?php } endif; ?>


        <?php if ( $format === 'portrait') : { ?> 
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
                        <button>Contact</button>
                    </div>
                </div>
                <div class="right-side-portrait">
                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                </div>
            </div>
                <div class="alsoLike-container">
                    <h3>Vous aimerez aussi</h3>
                    <div class="alsoLike-photos">
                        <div class="alsoLike-photo1"></div>
                        <div class="alsoLike-photo2"></div>
                        <div class="alsoLike-photo3"></div>
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