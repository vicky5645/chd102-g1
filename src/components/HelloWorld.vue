<template>
  <section :class="sectionBg">
    <h1>{{ sctionTitle }}</h1>
    
    {{ sectionBg }}
  </section>
</template>

<script>
export default {
  props: {
    sctionTitle: String,
    sectionBg: String
  }
}

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
section{
  //垂直置中
  display: flex;
  justify-content: center;
  align-items: center;

  color: white;
  height: 100vh;
  //預設底色
  background-color: rgb(84, 96, 97);
  &.red{
    background-color: rgb(126, 35, 35);
  }
  &.black{
    background-color: rgb(8, 8, 8);
  }
  &.grayGreen{
    color: #333;
    background-color: rgb(165, 178, 166);
  }
}
</style>
