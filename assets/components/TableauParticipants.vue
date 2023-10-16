<template>
    <table>
      <thead>
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Total des points</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="participant in participantsClasses" :key="participant.id">
          <td>{{ participant.nom }}</td>
          <td>{{ participant.prenom }}</td>
          <td>{{ participant.points }}</td>
        </tr>
      </tbody>
    </table>
  </template>
  
  <script>
export default {
  name: 'TableauParticipants',
  data() {
    return {
      participants: [] // données initiales vide
    }
  },
  computed: {
    participantsClasses() {
      // Tri des participants par points (du plus grand au plus petit)
      return this.participants.sort((a, b) => b.points - a.points);
    }
  },
  mounted() {
    this.fetchData();
  },
  methods: {
    async fetchData() {
      try {
        const response = await fetch('URL_DE_VOTRE_API');
        const data = await response.json();
        this.participants = data; // suppose que l'API renvoie directement un tableau de participants
      } catch (err) {
        console.error("Erreur lors de la récupération des données:", err);
      }
    }
  }
}
</script>

<style scoped>
/* Ajoutez ici le style de votre tableau si nécessaire */
</style>