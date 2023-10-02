<template>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nom</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="leproprietaire in lesproprietaires" :key="leproprietaire.id" :class="rowClasses(leproprietaire)">
          <td>{{ leproprietaire.id }}</td>
          <td contenteditable @keydown.enter="handleInput($event, leproprietaire, 'nomproprietaire')">
            {{ leproprietaire.nom }}
          </td>
        </tr>
      </tbody>
    </table>
  </template>
  
  <script>
  export default {
    data() {
      return {
        lesproprietaires: [],
      };
    },
    methods: {
      async miseajour() {
        try {
          const response = await fetch('/api/entitys');
          this.lesproprietaires = await response.json();
        } catch (error) {
          console.error("Erreur lors de la mise à jour:", error);
        }
      },
      rowClasses(row) {
        return {
          'bg-green': row.id > 5,
          'bg-blue': row.id > 10
        };
      },
      async handleInput(e, row, column) {
        e.preventDefault();
        try {
          const response = await fetch(`/api/maj/${row.id}/${e.target.innerText}`, { method: "POST" });
          this.hello = await response.json();
        } catch (error) {
          console.error("Erreur lors de la mise à jour:", error);
        }
      }
    },
    created() {
      setInterval(this.miseajour, 10000);
    }
  };
  </script>
  
  <style>
  .bg-green {
    background-color: green;
  }
  
  .bg-blue {
    background-color: blue;
  }
  </style>
  