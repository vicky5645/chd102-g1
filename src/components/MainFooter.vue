<template>
  <footer id="mainFooter">

    <div class="left-section">
      <div class="logo">
        <img src="/images/logo/logoBig.png" alt="logo" />
      </div>
    </div>

    <div class="image-row">
      <router-link v-for="image in trvelImages" :to="image.link" :key="image.id">
        <img :src="image.src" :alt="image.alt" />
      </router-link>
    </div>

    <ul class="contact-info">
      <li v-for="contact in contactInfo" :key="contact.id">
        <i :class="contact.iconClass"></i>{{ contact.label }}:
        {{ contact.value }}
      </li>
    </ul>

    <div class="social-links">
      <a href="https://www.facebook.com">
        <div class="icon-24"><i class="fab fa-facebook"></i></div>
      </a>
      <a href="https://www.google.com/maps">
        <div class="icon-24"><i class="fas fa-map"></i></div>
      </a>
      <a href="https://www.instagram.com">
        <div class="icon-24"><i class="fab fa-instagram"></i></div>
      </a>
    </div>

  </footer>
</template>

<script>
export default {
  data() {
    return {
      trvelImages: [
        {
          id: 2,
          src: "/images/travel/star/star1.jpg",
          alt: "star1",
          link: "/online-booking",
        },
        {
          id: 3,
          src: "/images/travel/mountain/mountain2.jpg",
          alt: "Lake1",
          link: "/online-booking",
        },
        {
          id: 4,
          src: "/images/travel/spa/spa8.jpg",
          alt: "Image 4",
          link: "/online-booking",
        },
        {
          id: 5,
          src: "/images/travel/history/history11.jpg",
          alt: "Image 5",
          link: "/online-booking",
        },
        {
          id: 6,
          src: "/images/travel/park/park2.jpg",
          alt: "Image 6",
          link: "/online-booking",
        },
      ],

      contactInfo: [
        {
          id: 1,
          label: "地址",
          value: "公司地址",
          iconClass: "fas fa-map-marker-alt",
        },
        {
          id: 2,
          label: "Email",
          value: "company@example.com",
          iconClass: "far fa-envelope",
        },
        {
          id: 3,
          label: "電話號碼",
          value: "123-456-7890",
          iconClass: "fas fa-phone",
        },
      ],
    };
  },
};
</script>

<style lang="scss"></style>
