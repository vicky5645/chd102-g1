<template>
  <div class="home">
    <!-- <img alt="Vue logo" src="../assets/logo.png"> -->
    <HelloWorld :sctionTitle="title" sectionBg="grayGreen"/>
    <HelloWorld sctionTitle="Welcome to Your Vue.js App"  sectionBg="gray"/>
    <HelloWorld sctionTitle="sction 2" sectionBg="red"/>
  </div>
</template>

<script>
// @ is an alias to /src
import HelloWorld from '@/components/HelloWorld.vue'

export default {
  components: {
    HelloWorld
  },
  created() {
    fetch('https://api.json-generator.com/templates/GW6mr0Of9PaC/data', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify({
          "access_token": "b8wzvaq6cgmkwejpcje480eagic9074mo9rf7hyj"
      })
    })
    .then( (response) => {
        return response.json()
    })
    .then( (myJson) => {
        console.log(myJson)
    })
  },
  data(){
    return {
       title: '好想睡一下'
    }
  }
}
</script>
