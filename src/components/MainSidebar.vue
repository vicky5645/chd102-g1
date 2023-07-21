<template>
  <div class="sidebar" :class="{ active: sidebarOpen }">
    <slot name="slotheader"></slot>
    ==========
    <slot name="slotfooter"></slot>
  </div>
</template>

<script>
export default {
  //props:從父層繼承的屬性，key為sidebarOpen，型態為Boolean
  props: {
    sidebarOpen: Boolean
  },
  methods: {
    closeSidebar() {
      console.log('子層close');
      // emit: 觸發父層的function或js
      this.$emit('close')
    }
  },
  mounted() {
    const script = document.createElement('script');
    script.src = '/js/svgcolor.js';
    script.onload = () => {
      svg_icon('.custom-svg', 'currentColor');
    };
    document.body.appendChild(script);
  },
}
</script>

<style lang="scss" scoped>
</style>
