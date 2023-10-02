<template>
    <div>
      <h1>{{ entity.nom }}</h1> <!-- Exemple de champ que pourrait avoir votre entité -->
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        entity: {}
      };
    },
    mounted() {
      this.fetchData();
  
      // Appelle la méthode fetchData toutes les 5 secondes (5000 millisecondes)
      setInterval(this.fetchData, 5000);
    },
    methods: {
      fetchData() {
        fetch('/api/entity/1')
          .then(response => response.json())
          .then(data => {
            this.entity = data;
          });
      }
    }
  };
  </script>
  