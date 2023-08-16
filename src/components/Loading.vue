<template>
    <!-- <div class="loading_wrap">
      <div class="loading_inside"></div>
    </div> -->
<div class="toy-train">
  <div class="engine">
    <div class="window">
      <div class="engine-main">
        <div class="smokes">
          <span></span>
        </div>
      </div>
    </div>
    <div class="engine-body">
      <div class="wheels">
        <div class="big-wheel"></div>
        <div class="normal-wheel"></div>
      </div>
    </div>
  </div>
  <div class="locomotive">
    <div class="trash"></div>
    <div class="wheels">
      <div class="normal-wheel"></div>
      <div class="normal-wheel"></div>
    </div>
  </div>
  <div class="tracks">
    <span></span>
    <span></span>
  </div>
</div>
<div class="bg"></div>
  </template>
  
  <style lang="scss" scoped>
  /* .loading_wrap {
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
  } */
$blue-shade: #194488;
$white-shade: #fff;
$black-shade: #000;
$red-shade: #F82510;
$green-shade: #3D9A01;
$yellow-shade: #F69F00;

// html, body {
//   height: 100%;
// }

// body {
//   background: linear-gradient(to right, #56ccf2, #2f80ed);
// }
.bg {
  width: 100%;
  height: 100%;
  position: fixed;
  background-color: #fff;
  opacity: .5;
  z-index: 9998;
}
.toy-train {
  position: fixed;
  left: 50%;
  top: 50%;
  margin-left: -100px;
  width: 109px;
  transform: scale(1.2);
  z-index: 9999;
}

.engine {
  float: right;
  position: relative;
}

.window {
  height: 28px;
  width: 30px;
  background-color: $blue-shade;
  position: relative;
  border: 3px solid $black-shade;
  
  &:before,
  &:after {
    content: "";
    position: absolute;
    left: 50%;
    border: 3px solid $black-shade;
  }
  
  &:before {
    height: 7px;
    background-color: $red-shade;
    width: 45px;
    margin-top: -13px;
    margin-left: -26px;
    border-radius: 8px;
  }
  
  &:after {
    margin-left: -8px;
    margin-top: 3px;
    border-radius: 50%;
    height: 11px;
    width: 11px;
    background-color: $white-shade;
  }
}

.engine-main {
  height: 10px;
  width: 35px;
  border: 3px solid $black-shade;
  background-color: $green-shade;
  position: absolute;
  border-radius: 0 8px 8px 0;
  right: -41px;
  bottom: -3px;
  
  &:before {
    content: "";
    height: 10px;
    width: 8px;
    background-color: $black-shade;
    position: absolute;
    top: -11px;
    left: 4px;
    transform: rotate(180deg);
    border-radius: 50% 50% 50% 50% / 90% 90% 40% 40%;
  }
  
  &:after {
    content: "";
    height: 12px;
    width: 8px;
    position: absolute;
    display: block;
    right: 5px;
    top: -18px;
    border-radius: 50% 50% 50% 50% / 90% 90% 40% 40%;
    transform: rotate(180deg);
    z-index: -1;
    background-color: $blue-shade;
    border: 3px solid $black-shade;
  }
}

.engine-body {
  height: 17px;
  width: 75px;
  position: absolute;
  left: -2px;
  top: 30px;
  background-color: $yellow-shade;
  border: 3px solid $black-shade;
  border-radius: 5px;
  
  .big-wheel {
    top: 3px;
    left: 2px;
  }
  
  .normal-wheel {
    left: 45px;
    top: 5px;
  }
  
  &:before {
    content: "";
    position: absolute;
    height: 5px;
    width: 5px;
    left: -11px;
    bottom: 2px;
    z-index: -1;
    background-color: $white-shade;
    border-radius: 50%;
    border: 3px solid $black-shade;
  }
}

.wheels {
  > div {
    position: absolute;
    background-color: $red-shade;
    border-radius: 50%;
    border: 3px solid $black-shade;
    animation: wheel-rotate 1s linear infinite;
    
    &:before {
      content: "";
      position: absolute;
      width: 100%;
      border-bottom: 1px solid $black-shade;
      top: 50%;
      margin-top: -1px;
    }
    
    &:after {
      content: "";
      height: 8px;
      width: 8px;
      position: absolute;
      background-color: $black-shade;
      border-radius: 50%;
      left: 50%;
      top: 50%;
      margin-left: -4px;
      margin-top: -4px;
    }
  }

  .big-wheel {
    width: 22px;
    height: 22px;
    animation-delay: -0.3s;
  }

  .normal-wheel {
    height: 20px;
    width: 20px;
    animation-delay: -0.6s;
  }
}

.locomotive {
  height: 35px;
  width: 60px;
  border: 3px solid $black-shade;
  background-color: $yellow-shade;
  border-radius: 5px;
  position: relative;
  float: left;
  margin-top: 13px;
  
  &:before {
    content: "";
    width: 100%;
    background: linear-gradient(to right, #000000 0%,#000000 8%,#f69f00 8%,#f69f00 15%,#000000 15%,#000000 28%,#000000 34%,#f69f00 34%,#f69f00 65%,#000000 65%,#000000 65%,#000000 100%);
    height: 3px;
    position: absolute;
    top: 6px;
    left: 0;
  }
  
  &:after {
    content: "";
    width: 100%;
    background: linear-gradient(to right, #000000 0%,#000000 24%,#f69f00 24%,#f69f00 65%,#f69f00 65%,#000000 65%,#000000 85%,#f69f00 85%,#f69f00 90%,#000000 90%, #000000 100%);
    height: 3px;
    position: absolute;
    top: 14px;
    left: 0;
  }
  
  .wheels {
    > div {
      top: 22px;
      animation-delay: -0.6s;
      
      &:first-child {
        animation-delay: -0.9s;
      }
    }
  }
  
  .normal-wheel:first-of-type {
    left: 2px;
  }
  
  .normal-wheel:last-of-type {
    right: 2px;
  }
  
  
  .trash {
    height: 35px;
    width: 50px;
    position: absolute;
    top: -18px;
    border: 3px solid $black-shade;
    background-color: $green-shade;
    border-radius: 50%;
    left: 2px;
    z-index: -1;
  }
}

.tracks {
  position: relative;
  width: 200px;
  bottom: -10px;
  overflow: hidden;
  height: 3px;
  
  span {
    display: inline-block;
    height: 3px;
    width: 200px;
    position: absolute;
    left: 200px;
    background: linear-gradient(to right, rgba(0,0,0,1) 0%,rgba(0,0,0,1) 30%,rgba(0,0,0,0) 30%,rgba(0,0,0,0) 39%,rgba(0,0,0,1) 39%,rgba(0,0,0,1) 61%,rgba(0,0,0,1) 65%,rgba(0,0,0,0) 65%,rgba(0,0,0,0) 70%,rgba(0,0,0,1) 71%,rgba(0,0,0,1) 100%);
    animation: track 2s linear infinite;
    animation-fill-mode: forwards;
   
    &:nth-child(2) {
      animation-delay: -1s;
    }
  }
}

.smokes {
  &:before, 
  &:after,
  span:before {
    display: block;
    content: "";
    height: 8px;
    width: 8px;
    background-color: $white-shade;
    border-radius: 50%;
    position: absolute;
    right: 8px;
    top: 15px;
    z-index: -1;
  }
  
  &:before {
    animation: smoke 1s linear infinite;
  }
  
  span:before {
    animation: smoke 1s linear infinite;
    animation-delay: -0.6s;
  }
  
  &:after {
    animation: smoke 1s linear infinite;
    animation-delay: -0.3s;
  }
}

@keyframes smoke {
  100% {
   top: -50px;
   opacity: 0.5;
  }
}

@keyframes wheel-rotate {
  100% {
    transform: rotate(360deg);
  }
}

@keyframes track {
  100% {
   left: -200px;
  }
}
  </style>
  