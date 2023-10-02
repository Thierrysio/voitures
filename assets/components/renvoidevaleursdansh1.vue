<template>
    <div>
      <h1>{{ message }}</h1>
      <input :value="tempMessage" @input="updateTempMessage" @keyup.enter="updateMessage">
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        message: 'Salut initialement !',
        tempMessage: 'Salut initialement !'
      };
    },
    methods: {
      updateTempMessage(event) {
        this.tempMessage = event.target.value;
      },
      updateMessage() {
        this.message = this.tempMessage;
      }
    }
  };
  </script>
  