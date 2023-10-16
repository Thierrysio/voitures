<template>
  <div class="countdown-container">
    <div v-if="circleSize > 0" class="circle" :style="{ width: circleSize + 'px', height: circleSize + 'px' }">
      <div class="count">{{ count }}</div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      count: 10,
      circleSize: 150, // j'ai modifié cette valeur pour être en pixels plutôt qu'en pourcentage
    };
  },
  methods: {
    startCountdown() {
      const decreaseAmount = 15; // cela déterminera la fluidité de la transition
      const interval = setInterval(() => {
        this.circleSize -= decreaseAmount;

        if (this.circleSize <= 0) {
          if (this.count === 0) {
            clearInterval(interval);
          } else {
            this.count--;
            this.circleSize = 150; // réinitialiser la taille du cercle
          }
        }
      }, 100); // réduire cet intervalle pour rendre la transition plus fluide
    },
  },
  mounted() {
    this.startCountdown();
  },
};
</script>

<style scoped>
.countdown-container {
  position: relative;
  width: 150px;
  height: 150px;
}

.circle {
  background-color: yellow;
  border-radius: 50%;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  display: flex;
  align-items: center;
  justify-content: center;
}

.count {
  font-size: 24px;
  font-weight: bold;
  color: black; 
}
</style>
