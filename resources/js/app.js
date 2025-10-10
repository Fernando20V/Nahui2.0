import './bootstrap';
import Alpine from 'alpinejs';

//  Estilos SCSS
import '../js/scss/login.scss';
import '../js/scss/UserStyle/home.scss';
import '../js/scss/UserStyle/Mapa.scss';
import '../js/scss/UserStyle/location.scss';
import '../js/scss/UserStyle/catalogo.scss';
import '../js/scss/ViewProp/CreatePlace.scss';
import '../js/scss/UserStyle/registro.scss';
import '../js/scss/ViewProp/ShowPlaces.scss';
import '../js/scss/ViewProp/Index.scss';
import '../js/scss/Principal.scss';
import './scss/_variables.scss';

// 🧠 Scripts personalizados
import '../js/Scripts/Delete.js';

// 🗺️ Leaflet
import 'leaflet/dist/leaflet.css';
import L from 'leaflet';
window.L = L;

// ⭐ Font Awesome
import '@fortawesome/fontawesome-free/css/all.min.css';
import '@fortawesome/fontawesome-free/js/all.min.js';

// 🔼 Iniciar Alpine
window.Alpine = Alpine;
Alpine.start();

// ✅ Asegurar que Leaflet refresque bien el tamaño del mapa tras renderizado
window.addEventListener('load', () => {
    const map = document.getElementById('map');
    if (map && window.L) {
        setTimeout(() => window.dispatchEvent(new Event('resize')), 500);
    }
});
