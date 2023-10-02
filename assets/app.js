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
//import Exemple from './components/exemple.vue';
//import Exemple from './components/exempleparentvmodele.vue';
//import Exemple from './components/renvoidevaleursdansh1.vue';
//import Exemple from './components/calcul.vue';
//import Exemple from './components/apivue.vue';
//import Exemple from './components/apivuecollection.vue';
//import Exemple from './components/countdown.vue';
import Exemple from './components/apimaj.vue';

createApp(Exemple).mount('#exemple');

