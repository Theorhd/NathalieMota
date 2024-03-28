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
    jQuery('.close-contact').click(function (){ // Fermeture de la modale au clic sur le bouton
        closeContact();
    });
    if (refphotoJS) { // Si une réf photo est disponible, on ajoute la valeur dans le champ adapté
        jQuery('.ref-photo-cont span input').val(refphotoJS);
    }
});
/**/
/* Menu Nav Mobile */
$(document).ready(function() {
    let mobileMenu = document.querySelector('.mobile-menu');
    let menuToggle = document.querySelector('.menu-toggle');
    function menuOpen() {
        menuToggle.classList.add('open');
        mobileMenu.style.display = 'flex';
            setTimeout(() => {
                mobileMenu.classList.add('open');
            }, 100);
    }
    function menuClose() {
        menuToggle.classList.remove('open');
        mobileMenu.classList.remove('open');
        setTimeout(() => {
            mobileMenu.style.display = 'none';
        }, 500);
    }
    $('.menu-toggle').click(function() {
        if (mobileMenu.style.display === 'none') {
            menuOpen();
        }
        else {
            menuClose();
        }
    });
});
/**/
/* Gestion filtres page accueil */
document.addEventListener("DOMContentLoaded", function() {
  if (window.location.pathname === '/') { // Exécution du script uniquement sur la page d'accueil
    // Sélecteur de catégories
    var categoriesDropdown = document.getElementById("filter-categories-dropdown");
    var categoriesContainer = document.querySelector(".filter-categories");

    // Création du nouveau sélecteur stylisé pour les catégories
    var categoriesSelect = document.createElement("div");
    categoriesSelect.classList.add("custom-select");
    categoriesSelect.innerHTML = '<span class="placeholder">Catégories</span><ul><li data-value="all">Toutes</li><li data-value="concert">Concert</li><li data-value="mariage">Mariage</li><li data-value="reception">Réception</li><li data-value="television">Télévision</li></ul>';

    // Insérer le nouveau sélecteur stylisé avant l'ancien sélecteur
    categoriesContainer.insertBefore(categoriesSelect, categoriesDropdown);

    // Sélecteur de formats
    var formatsDropdown = document.getElementById("filter-formats-dropdown");
    var formatsContainer = document.querySelector(".filter-formats");

    // Création du nouveau sélecteur stylisé pour les formats
    var formatsSelect = document.createElement("div");
    formatsSelect.classList.add("custom-select");
    formatsSelect.innerHTML = '<span class="placeholder">Formats</span><ul><li data-value="all">Tous</li><li data-value="portrait">Portrait</li><li data-value="paysage">Paysage</li></ul>';

    // Insérer le nouveau sélecteur stylisé avant l'ancien sélecteur
    formatsContainer.insertBefore(formatsSelect, formatsDropdown);

    // Sélecteur de tri
    var sortDropdown = document.getElementById("sort-dropdown");
    var sortContainer = document.querySelector(".sort");

    // Création du nouveau sélecteur stylisé pour le tri
    var sortSelect = document.createElement("div");
    sortSelect.classList.add("custom-select");
    sortSelect.innerHTML = '<span class="placeholder">Trier par</span><ul><li data-value="all">Tous</li><li data-value="date+">Plus récent</li><li data-value="date-">Plus ancien</li></ul>';

    // Insérer le nouveau sélecteur stylisé avant l'ancien sélecteur
    sortContainer.insertBefore(sortSelect, sortDropdown);

    // Fonction pour ouvrir/fermer le menu déroulant
    document.querySelectorAll(".custom-select").forEach(function(select) {
      var placeholder = select.querySelector(".placeholder");
      var options = select.querySelectorAll("li");
      const selectBase = document.querySelector('.filterstyle');


      placeholder.addEventListener("click", function() {
        select.classList.toggle("open");
      });

      options.forEach(function(option) {
        option.addEventListener("click", function() {
          placeholder.textContent = option.textContent;
          select.classList.remove("open");
          option.classList.add("selected");

          // Mettre à jour la valeur du sélecteur d'origine
          var originalSelect;
          if (select === categoriesSelect) {
            originalSelect = categoriesDropdown;
          } else if (select === formatsSelect) {
            originalSelect = formatsDropdown;
          } else if (select === sortSelect) {
            originalSelect = sortDropdown;
          }
          originalSelect.value = option.dataset.value;
          selectBase.dataset.value = option.dataset.value;
        });
      });
});

// Fermer le menu déroulant si l'utilisateur clique en dehors
document.addEventListener("click", function(e) {
  if (!e.target.closest(".custom-select")) {
    document.querySelectorAll(".custom-select").forEach(function(select) {
      select.classList.remove("open");
    });
  }
});
  }
});

/* */