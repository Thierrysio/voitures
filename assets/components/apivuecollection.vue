<template>
    <div>
        <ul v-if="entitys && entitys.length">
            <li v-for="entity in entitys" :key="entity.id">{{ entity.nom }}</li>
        </ul>
        <p v-else>Loading...</p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            entitys: []
        };
    },
    created() {
        fetch('/api/entitys')
    .then(response => {
        if (!response.ok) {
            throw new Error('Erreur réseau ou côté serveur');
        }
        return response.json();
    })
    .then(data => {
        this.entitys = data;
    })
    .catch(error => {
        console.error('Erreur lors de la récupération des données:', error);
        // Vous pouvez également mettre à jour une variable pour afficher un message d'erreur à l'utilisateur
    });
    }
};
</script>
