/* svg icon 路徑檔案 換色--------------------------------- */
function svg_icon(className, colorValue) {
  let imgs = document.querySelectorAll(className);
  if (imgs.length > 0) {
    imgs.forEach((img) => {
      // console.log('抓到檔案', img);
      let imgSrc = img.getAttribute('src');
      fetch(imgSrc)
        .then(response => response.text())
        .then(svgText => {
          let parser = new DOMParser();
          let svgDoc = parser.parseFromString(svgText, 'image/svg+xml');
          let paths = svgDoc.querySelectorAll('path');
          if (paths.length > 0) {
            paths.forEach((path, index) => {
              // 逐個更改每個路徑的填充顏色
                path.style.fill = colorValue;
            });
            img.parentNode.insertBefore(svgDoc.documentElement, img);
            img.remove();
          }
        })
        .catch(error => {
          console.log('無法獲取 SVG 文件：', error);
        });
    });
  }
};