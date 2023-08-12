<template>
  <transition>
  <div class="sidebar" v-show="sidebarOpen">
  <!-- <div class="sidebar" :class="{ active: sidebarOpen }" v-show="sidebarOpen"></div> -->
    <slot name="slotheader"></slot>
    <slot name="slotfooter"></slot>
  </div>
</transition>
</template>

<script>
export default {
  //props:從父層繼承的屬性，key為sidebarOpen，型態為Boolean
  // props: ['showSideBar'],
  props: {
    sidebarOpen: Boolean
  },
  methods: {
    closeSidebar() {
      console.log('子層close');
      // emit: 觸發父層的function或js
      this.$emit('close')
    }
  }
}
</script>

<style lang="scss" scoped>

  //進場前
  //退場後
  .v-enter-from,
  .v-leave-to {
    transform: translateX(100%)
  }
  //退場前
  //進場後
  // .v-leave-from,
  .v-enter-to {
    transform: translateX(0)
  }


</style>
