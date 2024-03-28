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
// Besoin de charger le fichier block_photo.php pour obtenir l'image aléatoire pour le heroHeader
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
                    <option value="date+">Plus récent</option>
                    <option value="date-">Plus ancien</option>
                </select>
            </div>
        </div>
    </div>
    <div class="posts-container">
        <?php
            // Code présent dans le ficiher assets/js/ajax_pagination.js et functions.php
            // ajax_pagination.js charge les photos en AJAX et permet le fonctionnement du bouton "Afficher plus" et des filtres
            // functions.php contient les fonctions PHP qui permettent de charger les photos en AJAX
        ?>
    </div>
    <div class="load-more">
        <button id="load-more-photos">Afficher plus</button>
    </div>
</div>