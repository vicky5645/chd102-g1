<template>
  <footer id="mainFooter">

 
    
    <div class="left-section-wrap ">
      
     <div class="left-section">
        <router-link to="/roaming-orbit">
          <div class="logo">
            <img src="/images/logo/logoBig.png" alt="logo" />
          </div>
        </router-link>
      </div>


      <div class="image-row">
        <router-link
          v-for="image in trvelImages"
          :to="image.link"
          :key="image.id">
        
          <img :src="image.src" :alt="image.alt" />
        </router-link>
      </div>

      <ul class="contact-info">
        <li v-for="contact in contactInfo" :key="contact.id">
          <i :class="contact.iconClass"></i>
          <span>{{ contact.label }}:</span>
          <span>{{ contact.value }}</span>
        </li>
      </ul>

    </div>

    <div class="right-section-wrap">
      <p class="SHARE">SHARE</p>

      <div class="social-links">
        <a href="https://www.facebook.com"> <i class="fab fa-facebook"></i> </a>
        <a href="https://www.google.com/maps">
          <i class="fas fa-map"></i>
        </a>
        <a href="https://www.instagram.com">
          <i class="fab fa-instagram"></i>
        </a>
      </div>

      <div class="item button-pressure">
        <router-link :to="buttonLinkto">
          <marquee class="scroll" scrollamount="2">
            <span>LOG IN LOG IN LOG IN </span>
          </marquee>
        </router-link>
      </div>

      <div class="footer-table">
        <router-link
          v-for="item in tableData"
          :key="item.id"
          :to="item.link"
          class="table-cell"
        >
          {{ item.content }}
        </router-link>
      </div>
    </div>


  </footer>
</template>

<script>
export default {
  data() {
    return {
      trvelImages: [
        {
          id: 1,
          src: "/images/travel/star/star1.jpg",
          alt: "star1",
          link: "/online-booking",
        },
        {
          id: 2,
          src: "/images/travel/lake/lake5.jpg",
          alt: "lake2",
          link: "/online-booking",
        },
        {
          id: 3,
          src: "/images/travel/mountain/mountain2.jpg",
          alt: "mountain2",
          link: "/online-booking",
        },
        {
          id: 4,
          src: "/images/travel/spa/spa8.jpg",
          alt: "spa8",
          link: "/online-booking",
        },
        {
          id: 5,
          src: "/images/travel/history/history11.jpg",
          alt: "history11",
          link: "/online-booking",
        },
        {
          id: 6,
          src: "/images/travel/park/park2.jpg",
          alt: "park2",
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

      buttonLinkto: "/login",

      tableData: [
        { id: 1, content: "介紹", link: "/link1" },
        { id: 2, content: "公告", link: "/link2" },
        { id: 3, content: "論壇", link: "/link3" },
        { id: 4, content: "商城", link: "/link4" },
        { id: 5, content: "線上訂票", link: "/link5" },
        { id: 6, content: "會員專區", link: "/link6" },

        { id: 2 - 1, content: "行程介紹", link: "/link1" },
        { id: 2 - 2, content: "所有公告", link: "/link2" },
        { id: 2 - 3, content: "所有論壇", link: "/link3" },
        { id: 2 - 4, content: "購物商城", link: "/link4" },
        { id: 2 - 5, content: "", link: "/link5" },
        { id: 2 - 6, content: "", link: "/link6" },

        { id: 3 - 1, content: "景點介紹", link: "/link1" },
        { id: 3 - 2, content: "", link: "/link2" },
        { id: 3 - 3, content: "", link: "/link3" },
        { id: 3 - 4, content: "", link: "/link4" },
        { id: 3 - 5, content: "", link: "/link5" },
        { id: 3 - 6, content: "", link: "/link6" },

        { id: 4 - 1, content: "小火車介紹", link: "/link1" },
        { id: 4 - 2, content: "", link: "/link2" },
        { id: 4 - 3, content: "", link: "/link3" },
        { id: 4 - 4, content: "", link: "/link4" },
        { id: 4 - 5, content: "", link: "/link5" },
        { id: 4 - 6, content: "", link: "/link6" },
      ],
    };
  },
};
</script>

<style lang="scss"></style>
