<template>
  <ol class="flex">
    <li v-for="(item, i) in breadcrumbList" :key="i" class="pl-2">
      <router-link :to="item.path">{{ item.meta.title }}</router-link>
    </li>
  </ol>
</template>

<script>
import { ref, watch, onMounted } from 'vue'
import { useRoute } from 'vue-router'
export default {
  name: 'Breadcrumb',
  props: {
    detailName: String
  },
  setup (props) {
    const route = useRoute()
    const breadcrumbList = ref([])
    const isHome = () => {
      return route.name === 'Home'
    }
    const getBreadcrumbs = () => {
      let matched = route.matched
      if (!isHome(matched[0])) {
        matched = [{ path: '/', meta: { title: '首頁' } }].concat(matched)
      }
      matched[matched.length - 1].meta.title = matched[matched.length - 1].meta.title + props.detailName
      breadcrumbList.value = matched
    }
    watch(route, () => {
      getBreadcrumbs()
    })
    onMounted(() => {
      getBreadcrumbs()
    })
    return { breadcrumbList, getBreadcrumbs }
  }
}
</script>

<style scoped>
  li::after {
    content: '/';
    display: inline-block;
    padding-left: .5rem;
  }
  li:last-child::after {
    content: '';
  }
</style>