const { defineConfig } = require("@vue/cli-service");
module.exports = defineConfig({
  publicPath: process.env.NODE_ENV === "production" 
  ? "/chd102/g1/" 
  : "/",
  transpileDependencies: true,
  filenameHashing: false,

  css: {
    sourceMap: true,
  },

  chainWebpack: (config) => {
    config.module
      .rule("vue")
      .use("vue-loader")
      .tap((options) => ({
        ...options,
        compilerOptions: {
          // 將所有帶 swiper- 的標籤名都視為自定義元素
          isCustomElement: (tag) => tag.startsWith("swiper-"),
        },
      }));
  },
});
