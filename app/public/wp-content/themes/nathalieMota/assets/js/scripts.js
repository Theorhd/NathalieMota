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
    if (window.location.pathname.includes('/photo/')) { // exécution du script uniquement sur les pages de photos
      if (refphotoJS) { // Si une référence photo est définie
        jQuery('.ref-photo-cont span input').val(refphotoJS); // Mettre à jour la valeur de l'input avec la référence photo dans la modale de contact
      }
    }
});
/**/
/* Menu Nav Mobile */
jQuery(document).ready(function() {
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
    jQuery('.menu-toggle').click(function() {
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
    const categoriesDropdown = document.getElementById("filter-categories-dropdown");
    const categoriesContainer = document.querySelector(".filter-categories");
    // Création du nouveau sélecteur stylisé pour les catégories
    const categoriesSelect = document.createElement("div");
    categoriesSelect.classList.add("custom-select");
    categoriesSelect.innerHTML = '<span class="placeholder">Catégories</span><ul><li data-value="all">Toutes</li><li data-value="concert">Concert</li><li data-value="mariage">Mariage</li><li data-value="reception">Réception</li><li data-value="television">Télévision</li></ul>';
    // Insérer le nouveau sélecteur stylisé avant l'ancien sélecteur
    categoriesContainer.insertBefore(categoriesSelect, categoriesDropdown);

    // Sélecteur de formats
    const formatsDropdown = document.getElementById("filter-formats-dropdown");
    const formatsContainer = document.querySelector(".filter-formats");
    // Création du nouveau sélecteur stylisé pour les formats
    const formatsSelect = document.createElement("div");
    formatsSelect.classList.add("custom-select");
    formatsSelect.innerHTML = '<span class="placeholder">Formats</span><ul><li data-value="all">Tous</li><li data-value="portrait">Portrait</li><li data-value="paysage">Paysage</li></ul>';
    // Insérer le nouveau sélecteur stylisé avant l'ancien sélecteur
    formatsContainer.insertBefore(formatsSelect, formatsDropdown);

    // Sélecteur de tri
    const sortDropdown = document.getElementById("sort-dropdown");
    const sortContainer = document.querySelector(".sort");
    // Création du nouveau sélecteur stylisé pour le tri
    const sortSelect = document.createElement("div");
    sortSelect.classList.add("custom-select");
    sortSelect.innerHTML = '<span class="placeholder">Trier par</span><ul><li data-value="all">Tous</li><li data-value="date+">Plus récent</li><li data-value="date-">Plus ancien</li></ul>';
    // Insérer le nouveau sélecteur stylisé avant l'ancien sélecteur
    sortContainer.insertBefore(sortSelect, sortDropdown);



    // Fonction pour ouvrir/fermer le menu déroulant
    document.querySelectorAll(".custom-select").forEach(function(select) {
      let placeholder = select.querySelector(".placeholder");
      let options = select.querySelectorAll("li");
      const selectBase = document.querySelector('.filterstyle');

      placeholder.addEventListener("click", function() { // EventListener ouverture/fermeture du menu déroulant
        select.classList.toggle("open");
      });

      options.forEach(function(option) {
        option.addEventListener("click", function() { // EventListener selection d'une option
          placeholder.textContent = option.textContent;
          select.classList.remove("open");
          option.classList.add("selected");
          if (option.classList.contains("selected")) { // Désélectionner les autres options si une autre option est sélectionnée
            options.forEach(function(otherOption) {
              if (otherOption !== option) {
                otherOption.classList.remove("selected");
              }
            });
          }

          // Mettre à jour la valeur du sélecteur d'origine pour permettre le filtrage en Ajax
          let originalSelect;
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
}
});
/* */