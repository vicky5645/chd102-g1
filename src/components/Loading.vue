<template>
    <div class="loading_wrap">
      <div class="loading_inside"></div>
    </div>
  </template>
  
  <style scoped>
  .loading_wrap {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    width: 100%;
    position: absolute;
    top: 0;
    left: 0;
    background-color: #000000a7;
  }
  
  .loading_inside {
    border: 10px solid rgba(0, 0, 0, 0.1); 
    border-left: 10px solid #000;
    border-radius: 50%;
    width: 100px; 
    height: 100px; 
    animation: circle_run 1s linear infinite;
  }
  
  @keyframes  circle_run {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
  </style>
  