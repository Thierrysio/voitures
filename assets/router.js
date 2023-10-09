import { createRouter, createWebHistory } from 'vue-router';
import Home from './views/Home.vue';
import About from './views/About.vue';

// Définition des routes
const routes = [
    { path: '/', component: Home },
    { path: '/about', component: About },
];

console.log("Routes:", routes);

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;