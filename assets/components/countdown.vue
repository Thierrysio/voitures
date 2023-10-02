<template>
    <div>
        <!-- Affiche le compte à rebours -->
        <p v-if="countdown > 0">{{ countdown }}</p>

        <!-- Affiche "Loading..." si countdown est à 0 -->
        <p v-else>Loading...</p>

        <!-- Bouton pour démarrer le compte à rebours -->
        <button @click="startCountdown">Démarrer le compte à rebours</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            countdown: 0
        };
    },
    methods: {
        startCountdown() {
            this.countdown = 10; // Durée initiale du compte à rebours
            const interval = setInterval(() => {
                if (this.countdown > 0) {
                    this.countdown--;
                } else {
                    clearInterval(interval); // Arrête le compte à rebours une fois qu'il atteint 0
                }
            }, 1000); // Met à jour le compte à rebours toutes les secondes
        }
    }
};
</script>