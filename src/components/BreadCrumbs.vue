<template>
  <ol class="bread_crumbs">
    <router-link to="/roaming-orbit">
      <i class="fa-solid fa-house"></i>
    </router-link>
    <li v-for="(item, i) in breadcrumbList" :key="i" class="pl-2">
      <router-link :to="item.path" v-if="item.title !== detailName">{{ item.title }}</router-link>
      <router-link :to="item.path" v-if="item.title === detailName">{{ detailName }}</router-link>
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
  setup(props) {
    const route = useRoute()
    const breadcrumbList = ref([])
    const getBreadcrumbs = () => {
      const matched = route.matched
      const isHome = () => route.name === 'home'
      const isProductPage = matched.some(route => route.name === 'online-mall')
      const isProductDetailPage = matched.some(route => route.name === 'productDetail')
      if (!isHome()) {
        if (isProductPage || isProductDetailPage) {
          breadcrumbList.value.push({ title: '所有商品', path: '/online-mall' })
        }
        if (isProductDetailPage) {
          breadcrumbList.value.push({ title: `物品-${props.detailName}`, path: '' })
        }
      }
    }
    watch(route, () => {
      getBreadcrumbs()
    })
    onMounted(() => {
      console.log('getBreadcrumbs')
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
    &::before {
      content: " > ";
      color: #9ca3af;
    }

    list-style: none;
    display: inline;
    a {
      text-decoration: none;
      color: #9ca3af;
    }
    & + li a {
      color: #f29c50;
    }
  }
}
</style>
