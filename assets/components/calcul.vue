<template>
    <div>
      <input type="number" v-model.number="number1">
      <input type="number" v-model.number="number2">
      <h1>Total: {{ total }}</h1>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        number1: 0,
        number2: 0
      };
    },
    computed: {
      total() {
        return this.number1 + this.number2;
      }
    }
  };
  </script>
  