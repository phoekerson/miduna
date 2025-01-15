const continentsData = {
    afrique: {
        title: 'Afrique',
        link:'afrique.php',
        images: [
            'https://images.unsplash.com/photo-1604329760661-e71dc83f8f26?auto=format&fit=crop&w=800',
            'https://images.unsplash.com/photo-1511910849309-0dffb8785146?auto=format&fit=crop&w=800',
            'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?auto=format&fit=crop&w=800'
        ]
    },
    asie: {
        title: 'Asie',
        images: [
            'https://images.unsplash.com/photo-1617093727343-374698b1b08d?auto=format&fit=crop&w=800',
            'https://images.unsplash.com/photo-1553163147-622ab57be1c7?auto=format&fit=crop&w=800',
            'https://images.unsplash.com/photo-1512058564366-18510be2db19?auto=format&fit=crop&w=800'
        ]
    },
    europe: {
        title: 'Europe',
        images: [
            'https://images.unsplash.com/photo-1608039829572-78524f79c4c7?auto=format&fit=crop&w=800',
            'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?auto=format&fit=crop&w=800',
            'https://images.unsplash.com/photo-1473093295043-cdd812d0e601?auto=format&fit=crop&w=800'
        ]
    },
    amerique: {
        title: 'Amérique',
        images: [
            'https://images.unsplash.com/photo-1551782450-17144efb9c50?auto=format&fit=crop&w=800',
            'https://images.unsplash.com/photo-1565299507177-b0ac66763828?auto=format&fit=crop&w=800',
            'https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=800'
        ]
    }
};

document.addEventListener('DOMContentLoaded', () => {
    const continentGrid = document.getElementById('continentGrid');
    
    // Créer les cartes de continent
    Object.entries(continentsData).forEach(([key, data]) => {
        const card = document.createElement('div');
        card.className = 'continent-card';
        
        const slideshowContainer = document.createElement('div');
        slideshowContainer.className = 'slideshow';
        
        const content = document.createElement('div');
        content.className = 'card-content';
        content.innerHTML = `<h2 class="card-title">${data.title}</h2>`;
        
        card.appendChild(slideshowContainer);
        card.appendChild(content);
        continentGrid.appendChild(card);
        
        // Initialiser le diaporama
        new Slideshow(slideshowContainer, data.images);
    });
});

class Slideshow {
    constructor(container, images) {
        this.container = container;
        this.images = images;
        this.currentSlide = 0;
        this.interval = null;
        this.init();
    }

    init() {
        // Créer les éléments du diaporama
        this.images.forEach((image, index) => {
            const slide = document.createElement('img');
            slide.src = image;
            slide.alt = `Slide ${index + 1}`;
            slide.className = `slide ${index === 0 ? 'active' : ''}`;
            this.container.appendChild(slide);
        });

        // Créer les points de navigation
        const dotsContainer = document.createElement('div');
        dotsContainer.className = 'slide-dots';
        
        this.images.forEach((_, index) => {
            const dot = document.createElement('button');
            dot.className = `dot ${index === 0 ? 'active' : ''}`;
            dot.addEventListener('click', () => this.goToSlide(index));
            dotsContainer.appendChild(dot);
        });

        this.container.parentElement.appendChild(dotsContainer);

        // Démarrer le diaporama automatique
        this.startSlideshow();
    }

    startSlideshow() {
        this.interval = setInterval(() => {
            this.nextSlide();
        }, 5000);
    }

    stopSlideshow() {
        clearInterval(this.interval);
    }

    nextSlide() {
        this.goToSlide((this.currentSlide + 1) % this.images.length);
    }

    goToSlide(index) {
        // Mettre à jour les classes des slides
        const slides = this.container.querySelectorAll('.slide');
        slides[this.currentSlide].classList.remove('active');
        slides[index].classList.add('active');

        // Mettre à jour les points
        const dots = this.container.parentElement.querySelectorAll('.dot');
        dots[this.currentSlide].classList.remove('active');
        dots[index].classList.add('active');

        this.currentSlide = index;
    }
}

function loadFile(event) {
    const image = document.getElementById('profileImage');
    const file = event.target.files[0]; // Récupère le fichier sélectionné

    if (file) {
        const reader = new FileReader(); // Crée un nouvel objet FileReader

        reader.onload = function(e) {
            image.src = e.target.result; // Définit la source de l'image
            image.style.display = 'block'; // Affiche l'image
        };

        reader.readAsDataURL(file); // Lit le fichier comme une URL de données
    } else {
        image.src = ''; // Réinitialise la source si aucun fichier n'est sélectionné
        image.style.display = 'none'; // Cache l'image
    }
}
