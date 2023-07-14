<template>
  <BreadCrumbs />
  <router-view />
</template>
<script>
import BreadCrumbs from '@/components/BreadCrumbs.vue'
export default {
  components: { BreadCrumbs }
}
</script>