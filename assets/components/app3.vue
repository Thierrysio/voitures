<template>
    <div class="solar-system">
      <div class="sun"></div>
      <div class="orbit">
        <div class="planet"></div>
      </div>
    </div>
  </template>
  
  <style scoped>
  .solar-system {
    position: relative;
    width: 250px;
    height: 250px;
    margin: 50px auto;
  }
  
  .sun {
    position: absolute;
    width: 50px;
    height: 50px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: gold;
    border-radius: 50%;
  }
  
  .orbit {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    border: dotted 1px rgba(0, 0, 0, 0.1);  /* Just to visualize the orbit */
    animation: rotate 10s infinite linear;
  }
  
  .planet {
    position: absolute;
    width: 30px;
    height: 30px;
    top: 0;
    left: 50%;
    transform: translateY(-50%);
    background-color: blue;
    border-radius: 50%;
  }
  
  @keyframes rotate {
    from {
      transform: rotate(0deg);
    }
    to {
      transform: rotate(360deg);
    }
  }
  </style>
  