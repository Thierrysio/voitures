/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import "bootstrap";
import { createApp } from 'vue';
import App from './components/app.vue';
createApp(App).mount('#app');

/*import { createApp } from 'vue';
import App from './components/App.vue';
import router from './router';
import store from './store'; 


const app = createApp(App);  // Utilisez le composant App comme composant racine
app.use(router);
app.use(store);
app.mount('#app');*/
