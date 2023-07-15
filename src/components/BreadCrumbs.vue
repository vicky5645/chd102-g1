<template>
  <ol class="bread_crumbs">
    <router-link to="/">
      <i class="fa-solid fa-house"></i>
    </router-link>
    <li v-for="(item, i) in breadcrumbList" :key="i" class="pl-2">
      <router-link :to="item.path" >{{ item.meta.title }}</router-link>
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
        matched = [{ path: '/', meta: { title: '/' } }].concat(matched)
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

<style lang="scss" scoped>
.bread_crumbs {
  margin: 12px 0;

  i {
    color: #f29c50;
    margin-right: 10px;
  }

  li {
    & + li::before {
      content: " > ";
      color: #9ca3af;
    }

    list-style: none;
    display: inline;

    a {
      text-decoration: none;
    }
  }
}
</style>