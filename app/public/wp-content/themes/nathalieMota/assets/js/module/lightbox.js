class Lightbox {

    static init() { // Gestion de l'initialisation de la lightbox
        const btns_fullscreen = document.querySelectorAll('.overlay-fullscreen');
        const links = Array.from(document.querySelectorAll('button[data-photourl$=".jpg"], button[data-photourl$=".png"], button[data-photourl$=".jpeg"], button[data-photourl$=".gif"]'));
        const images = links.map(link => ({
            url: link.getAttribute('data-photourl'),
            ref: link.getAttribute('data-ref'),
            category: link.getAttribute('data-category')
        }));

        btns_fullscreen.forEach((btn_fullscreen, index) => {
            btn_fullscreen.addEventListener('click', (e) => {
                e.preventDefault();
                const { url, ref, category } = images[index];
                new Lightbox(url, ref, category, images, index); 
            });
        });
    }
    constructor(url, ref, category, images, initialIndex) { // Gestion de la construction de la lightbox
        this.images = images;
        this.currentIndex = initialIndex;
        this.element = this.buildDOM(url, ref, category);
        document.body.appendChild(this.element);
        this.onKeyUp = this.onKeyUp.bind(this);
        document.addEventListener('keyup', this.onKeyUp);
    }
    close(e) { // Gestion de la fermeture de la lightbox
        e.preventDefault();
        this.element.classList.add('fadeOut');
        window.setTimeout(() => {
            this.element.parentElement.removeChild(this.element);
        }, 500);
        document.removeEventListener('keyup', this.onKeyUp);
    }
    onKeyUp(e) { // Gestion d'attributs de touche clavier
        if (e.key === 'Escape') { // fermeture de la lightbox avec la touche "Escape"
            this.close(e);
        }
        if (e.key === 'ArrowRight') { // Navigation suivante avec la touche "ArrowRight"
            this.next(e);
        }
        if (e.key === 'ArrowLeft') { // Navigation précédente avec la touche "ArrowLeft"
            this.prev(e);
        }
    }
    next(e) { // Gestion de la navigation suivante
        e.preventDefault();
        this.currentIndex = (this.currentIndex + 1) % this.images.length;
        const { url, ref, category } = this.images[this.currentIndex];
        this.updateImage(url, ref, category);
    }
    prev(e) { // Gestion de la navigation précédente
        e.preventDefault();
        this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
        const { url, ref, category } = this.images[this.currentIndex];
        this.updateImage(url, ref, category);
    }
    updateImage(url, ref, category) { // Gestion de la mise à jour de l'image pour la navigation
        // Mise à jour de l'image
        const imageDiv = this.element.querySelector('.lightbox-img');
        imageDiv.style.backgroundImage = `url(${url})`;
        // Mise à jour des informations
        const refElement = this.element.querySelector('.lightbox-infos p:nth-child(1)');
        const categoryElement = this.element.querySelector('.lightbox-infos p:nth-child(2)');
        refElement.textContent = ref;
        categoryElement.textContent = category;
    }
    buildDOM(url, ref, category) { // Gestion de la construction du DOM
        const dom = document.createElement('div');
        dom.classList.add('lightbox');
        dom.innerHTML = `
            <div class="arrow">
                <div class="arrow_left"></div>
            </div>
            <button class="lightbox-close"></button>
            <div class="lightbox-content">
                <div class="lightbox-img" style="background: url(${url})"></div>
                <div class="lightbox-infos">
                    <p>${ref}</p>
                    <p>${category}</p>
                </div>
            </div>
            <div class="arrow">
                <div class="arrow_right"></div>
            </div>
        `;
        // Event Listener de la lightbox
        dom.querySelector('.lightbox-close').addEventListener('click', this.close.bind(this));
        dom.querySelector('.arrow_left').addEventListener('click', this.prev.bind(this));
        dom.querySelector('.arrow_right').addEventListener('click', this.next.bind(this));
        dom.style.display = 'flex';
        return dom;
    }
}

function load_lightbox() { // Gestion du chargement de la lightbox
    setTimeout(() => {  // Attend 0.5 seconde pour que les images soient chargées en Ajax
        Lightbox.init();
    }, 500);
}   
const load_more_photos = document.querySelectorAll('#load-more-photos');
const filters = document.querySelectorAll('.filterstyle');
const custom_select = document.querySelectorAll('.custom-select ul li');
/* Event Listener */
document.addEventListener('DOMContentLoaded', () => { // Initialisation de la lightbox au chargement de la page
    load_lightbox();

    filters.forEach(element => { // Boucle pour appliqué l'eventListerner sur chaque filtre
        element.addEventListener('change', function() { // Recharge la lightbox après avoir changé un filtre
            load_lightbox();
        });
    });
    $('.custom-select ul li').on('click', function() { // Ecouter le clic sur les filtres personnalisés
        load_lightbox();
    });
    load_more_photos.forEach(element => { // Boucle pour appliqué l'eventListerner sur chaque bouton de chargement
        element.addEventListener('click', function() { // Recharge la lightbox après avoir chargé plus d'images
            load_lightbox();
        });
    });

});
/* * */