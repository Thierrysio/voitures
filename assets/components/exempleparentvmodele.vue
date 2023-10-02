<template>
  <div>
    <h1>{{ message }}</h1>
    <h1>{{ message }}</h1>
    <Exemple2 v-model="message"></Exemple2>
  </div>
</template>

<script>
import Exemple2 from './exempleenfantvmodele.vue';

export default {
  components: {
    Exemple2
  },
  data() {
    return {
      message: 'Salut initialement !'
    };
  }
};
</script>
