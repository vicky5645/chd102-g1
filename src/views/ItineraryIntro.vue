<!-- ItineraryIntro.vue -->
<template>
  <div>
    <div class="ItineraryBanner">
      <div class="bannerTxt">
        <h2>搭上漫遊列車</h2>
        <span>開啟您的旅途風光</span>
      </div>
    </div>
    <div class="container">
      <div class="ItineraryDesc">
        <div class="ItineraryDetail1">
          <div class="bgi">
            <img src="@/assets/images/about/IB1_1.jpg" alt="" />
          </div>
          <div class="ItinerarySwitch">
            <!-- {{ tabActive }} -->
            <button
              v-for="(item, key) in airticles"
              :style="{ color: key == tabActive ? red : blue }"
              @click="updateTab(key)"
            >
              {{ item.title }}
            </button>

            <!-- -------------------------------- -->

            <!-- <div class="button_list">
              <button
                @click="selectType('銀月山脈的浪漫之旅')"
                :class="{
                  'selected-button': selectedType === '銀月山脈的浪漫之旅',
                }"
                :key="'銀月山脈的浪漫之旅'"
              >
                銀月山脈的浪漫之旅
              </button>

              <button
                @click="selectType('湖光山色的奇幻之旅')"
                :class="{
                  'selected-button': selectedType === '湖光山色的奇幻之旅',
                }"
                :key="'湖光山色的奇幻之旅'"
              >
                湖光山色的奇幻之旅
              </button>

              <button
                @click="selectType('海底餐廳的冒險之旅')"
                :class="{
                  'selected-button': selectedType === '海底餐廳的冒險之旅',
                }"
                :key="'海底餐廳的冒險之旅'"
              >
                海底餐廳的冒險之旅
              </button>
            </div> -->
            <template v-if="tabActive == 0">
              <!-- 暫時沒有相關內容 -->
            </template>
            <template v-else>
              <div
                v-for="article in filteredArticles"
                :key="article.id"
                class="article_card"
              >
                <div class="pic">
                  <Images :imgURL="`${article.image}`" :alt="`Article Image`" />
                  <!-- <img :src="article.image" alt="Article Image" /> -->
                </div>
                <div class="article_card_txt">
                  <p
                    class="type"
                    :class="article.type === '重要' ? 'important' : 'normal'"
                  >
                    {{ article.type }} <span>{{ article.date }}</span>
                  </p>
                  <h3>{{ article.title }}</h3>
                  <p class="card_txt_content">{{ article.content }}</p>
                  <router-link
                    :to="`/announcement-details/${article.id}`"
                    class="more"
                    >查看更多</router-link
                  >
                </div>
              </div>
            </template>

            <!-- ------------------------------------ -->
            <!-- <button>湖光山色的奇幻之旅</button>
            <button>海底餐廳的冒險之旅</button> -->
          </div>
          <div class="ItineraryHeader">
            <h2>{{ airticles[tabActive].title }}</h2>
            <p>
              {{ `"${airticles[tabActive].content1}"` }}
            </p>
          </div>
        </div>
        <template v-if="tabActive == 0">
          <div class="ItineraryDetail2">
            <div class="ItineraryTxt">
              <h3>綠野牧場</h3>
              <p>
                您的旅程開始於美麗的綠野牧場。這片廣闊的牧場位於鄉村風景中，為您帶來大自然的奇妙體驗。漫步於綠野牧場，您將感受到清新的空氣和綠意盎然的環境。這裡有可愛的動物們等著與您親密互動，您可以親手餵食溫馴的羊群，感受牛群的溫暖擁抱，甚至體驗騎馬的刺激與自由。
              </p>
              <p>
                綠野牧場也是一個適合全家大小的度假勝地。孩子們可以參加豐富多樣的農場活動，學習生態環保和農業知識。如果您追求更多刺激，綠野牧場也提供各種戶外遊樂設施，讓您盡情挑戰自我。在這片美麗的綠野之中，您將找回與自然共鳴的感覺，享受放鬆和冒險的雙重快樂。
              </p>
            </div>
            <div class="ItineraryMix">
              <img src="@/assets/images/about/IB1_2.png" alt="" />
              <div class="txtBox">
                <p>
                  除了悠閒的自然環境外,綠野牧場還提供各式各樣的美食選擇,讓您品味當地的農產品和特色美食。在舒適的餐廳中,品嚐新鮮的乳製品、有機蔬果和道地的農家菜,給您的味蕾帶來無限驚喜。
                </p>
              </div>
            </div>
          </div>
          <div class="ItineraryDetail3">
            <div class="ItineraryTxt">
              <h3>景觀公園</h3>
              <p>
                用完午餐後，您將前往景觀公園。這個美麗的地方隨著秋風而舞的楓葉將您帶入夢幻的世界。在楓葉幻境谷中，您將置身於壯麗的景色之中。紅、黃、橙色的楓葉點綴著青翠的樹林，猶如繪畫般的美景令人陶醉。這個谷地散發著神秘而寧靜的氛圍，讓您彷彿置身於一個童話世界。
              </p>
              <p>
                進入楓葉夢幻森，您將感受到森林的神秘力量。參天的楓樹遮蔽了陽光，給人一種幽暗而神秘的感覺。在楓葉幻境中，您將見證大自然最璀璨的繪畫，沉浸在奧義的神秘氛圍中。而楓葉樂園則結合了自然美景和遊樂娛樂，為您帶來一場夢幻般的體驗。
              </p>
              <p>
                在這個楓葉幻境中，您將創造美麗的回憶，留下永恆的印象。無論是與摯愛分享浪漫時刻，還是與家人朋友一同體驗神秘的楓葉世界，景觀公園都將成為您探索大自然神奇之美的絕佳選擇。
              </p>
            </div>
            <div class="ItineraryMix">
              <img src="@/assets/images/about/IB1_3.png" alt="" />
              <div class="txtBox">
                <p>
                  在景觀公園，您將同時感受到大自然的魅力和充滿奇幻的氛圍。這裡是您追尋美麗楓葉的最佳去處，也是您展開童話之旅的理想之地。無論是與家人共度美好時光，還是與摯愛享受浪漫之旅，景觀公園都將為您帶來一場難忘的奇幻之旅。讓我們一同走進這片楓葉幻境，感受秋天的魔法，享受大自然的饗宴。在景觀公園中，您將創造美麗的回憶，留下永恆的印象。
                </p>
              </div>
            </div>
          </div>
          <div class="ItineraryDetail4">
            <div class="text">
              <h3>銀月山脈</h3>
              <p>
                在參觀完，景觀公園的景觀公園後，您將搭乘列車前往銀月山脈。這個奧義之夢將您帶入星際奇觀的魔幻之境！位於偏遠地區的銀月山脈是觀賞極光的絕佳地點，讓您感受宇宙中最令人著迷的現象。
              </p>
              <p>
                在銀月山脈的寧靜中，當夜幕降臨，美麗的奧羅拉綻放出無盡的魅力。無數綠色、粉紅色和紫色的光束在黑暗的天空中舞動，像是神秘的幻影穿梭於宇宙之間。這一刻，您將親眼見證大自然最璀璨的繪畫，沉浸在奧羅拉的神秘氛圍中。
              </p>
              <p>
                銀月山脈也提供舒適的住宿和專業的導覽服務，確保您的奧羅拉之旅更加舒適和難忘。在這個與宇宙交相輝映的地方，您將獲得一段令人難以忘懷的銀河之旅。
              </p>
            </div>
            <div class="pic">
              <img src="@/assets/images/about/IB1_4.png" alt="" />
            </div>
          </div>
          <div class="ItineraryDetail5">
            <div class="text">
              <h3>高原遺跡</h3>
              <p>
                翌日的早晨，搭乘列車前往中世紀的幽谷神秘村，其位於受保護的自然環境中心,座落於“Grèsd'Annot”自然遺址的腳下。這個村莊保存了幾個世紀以來的建築瑰寶,呈現著高原遺跡的神秘面紗。
              </p>
              <p>
                在村莊的步行街上漫步,您會發現高原遺跡散發著古老歷史的魅力。精雕細琢的巨石都向您展示著這個地方的特色和豐富的歷史。除了自然景觀,安諾村莊還以其攀岩點聞名,吸引了來自歐洲各地的登山者。您可以挑戰岩壁,體驗刺激的攀岩冒險,領略高原遺跡背後的秘密。
              </p>
              <p>
                此外,安諾村莊也將傳統和文化保留下來,讓遊客更好地了解這個地方。您可以品嚐當地的美食特產,參與聖福爾圖納特和其他節慶活動,深入體驗高原遺跡周邊地區的熱情和友善。
              </p>
              <p>
                在高原遺跡中,古老歷史的光芒綻放,帶您穿越時光,感受這個神秘地方的獨特魅力。不論您是歷史愛好者還是探索者,這裡都將成為您一段難忘旅程中的重要一站。
              </p>
            </div>
            <div class="pic">
              <img src="@/assets/images/about/IB1_5.jpg" alt="" />
            </div>
          </div>
          <div class="ItineraryDetail6">
            <h3>海之幻境 - 海底餐廳</h3>
            <div class="pic">
              <img src="@/assets/images/about/IB1_6.png" alt="" />
            </div>
            <div class="text">
              <p>
                中午時分，您將來到海之幻境-海底餐廳。在這個浩瀚的海底世界中，您將迎接一場獨一無二的美食體驗！踏進海底餐廳，您將沉浸於令人夢幻的海洋奇境。
              </p>
              <p>
                海底餐廳猶如一座透明的水晶殿堂，四周被璀璨的海底生物和色彩繽紛的珊瑚所環繞。坐在餐桌旁，透過透明的落地窗欣賞著游動的熱帶魚群和優雅的海龜，仿佛置身於一個夢幻般的海底世界。
              </p>
              <p>
                海底餐廳以新鮮、精緻的海鮮美食為您提供最優質的餐飲體驗。廚師們精心烹調來自海洋的珍饈美味，融入創意和精湛的烹飪技巧，為您帶來一場舌尖上的盛宴。無論是鮮嫩多汁的龍蝦、鮭魚刺身的鮮美，還是濃郁香滑的海鮮湯，每道菜品都是獨一無二的味覺饗宴。
              </p>
              <p>
                在這個與海洋融為一體的環境中，您可以放鬆身心，享受美食的同時欣賞著海底生態的奇妙景色。我們的服務團隊將用心照顧您的需求，確保您在海底餐廳中獲得一流的用餐體驗。無論是與摯愛分享浪漫的晚餐，與家人共享溫馨的聚餐，或是與好友一同探索這片海底魔幻世界，海底餐廳都將成為一場難忘的美食之旅。
              </p>
              <p>
                除了美食享受，海底餐廳也提供各種海底探險活動，讓您更深入地了解海洋的神秘之美。您可以參與潛水、浮潛和海洋生物觀察，一窺海洋世界的奧秘。潛入蔚藍海水中，與海豚共舞，觀察珊瑚礁生態，探索深邃的海底世界，這些探險活動將給您帶來難以忘懷的回憶。
              </p>
              <p>
                在這片海底魔幻世界中，您將同時感受到大自然的魅力和美食的誘惑。海底餐廳將為您打造一場令人心醉神迷的旅程，讓您的心靈和味蕾同時沉浸在無盡的驚奇和美好之中。
              </p>
              <p>
                結束了本次浪漫之旅的探索，您將帶著一腔熱情和美好的回憶返回家園。這趟旅程不僅讓您感受到大自然的美妙，也讓您體驗到各種刺激和快樂。從綠野牧場的活力，到景觀公園的夢幻，再到銀月山脈的星際奇觀，高原遺跡的歷史光芒，最後來到海底餐廳的海底奇境，每一站都帶給您獨特的感動和體驗。
              </p>
              <p>
                這趟觀光列車的旅遊行程將成為您一生中難忘的回憶，讓您深刻感受到大自然的奧妙和多樣性。無論是與家人共度美好時光，還是與摯愛享受浪漫之旅，這個行程都將是一段難以磨滅的美好回憶。
              </p>
            </div>
          </div>
          <div class="buyTickets">
            <router-link to="/online-booking">購買行程</router-link>
          </div>
        </template>
        <template v-else-if="tabActive == 1">
          <div class="ItineraryDetail2">
            <div class="ItineraryTxt">
              <h3>忘卻之湖</h3>
              <p>
                踏入忘卻之湖，進入一個隱世仙境的奇幻之旅！忘卻之湖位於遠離塵囂的絕美地帶，將您帶入一個讓心靈沉澱、身心放鬆的寧靜世界。湖泊周圍環繞著壯麗的山脈，湖水如翡翠般清澈，湖面倒影著蔚藍天空和青翠的樹木。置身於這片自然環境中，您將感受到大自然的奧秘與純粹，彷彿置身於一幅動人的畫卷中。
              </p>
              <p>
                忘卻之湖是一個遠離塵囂的避世之地，讓您逃離日常煩囂，重新與自然連結。您可以漫步於湖邊的迴廊，呼吸著新鮮的空氣，欣賞著四季變幻的美景。在這個寧靜的環境中，您可以深度放鬆、擁抱內心的寧靜。
              </p>
              <p>
                無論您是想放鬆身心，還是渴望與自然親密接觸，忘卻之湖將成為您的避世天堂。讓我們一同進入這個仙境般的湖泊，與大自然共舞，感受身心的寧靜與美好。在忘卻之湖，重拾對生活的熱愛，追尋內心的寧靜和平衡。
              </p>
            </div>
            <div class="ItineraryMix">
              <img src="@/assets/images/about/ac02.png" alt="" />
              <div class="txtBox">
                <p>
                  忘卻之湖也提供各種戶外活動，滿足探險家的渴望。您可以划船遊湖，感受湖水的柔軟觸感，並欣賞湖畔的風光。在湖邊野餐、垂釣，與家人朋友共度美好時光。對於愛好攝影的您，這裡更是一個絕佳的拍攝地點，捕捉湖泊在不同時間和光線下的獨特美景。
                </p>
              </div>
            </div>
          </div>
          <div class="ItineraryDetail3">
            <div class="ItineraryTxt">
              <h3>亞瑟山口</h3>
              <p>
                穿越壯麗的亞瑟山口，揭開大自然的神秘面紗！這個位於新西蘭南島的迷人景點，結合了壯麗的山脈、蔚藍的天空和原始的自然美景，為您帶來難以置信的探險之旅。
              </p>
              <p>
                亞瑟山口擁有令人屏息的景觀，山巒疊翠、峽谷深邃，風光壯麗。當您穿越遼闊的草原和茂密的原始森林時，會發現令人驚嘆的瀑布、湖泊和湖泊倒映著周圍壯麗的山脈，為您打造一幅絕美的自然畫卷。
              </p>
              <p>
                亞瑟山口不僅提供驚人的自然風光，還是探險活動的天堂。您可以嘗試登山、追踪、露營等刺激的戶外活動，挑戰自己的體能和勇氣。在山區的迴廊中探險，您有機會遇見珍稀的野生動物，例如凱庫鳥和野生山羊，讓您與自然更為親近。此外，亞瑟山口還擁有迷人的生態遊覽路線，供您沿著山脊漫步，欣賞壯觀的景色和多樣的植被。在這裡，您可以感受到大自然的力量和平靜，沉浸於無垠的天空和清新的空氣中。
              </p>
              <p>
                無論您是想追求冒險，還是尋找寧靜與放鬆，亞瑟山口都能滿足您的期待。來到這個令人心醉神迷的地方，讓我們一同探索大自然的奧秘，感受亞瑟山口的美麗和靈感的湧現。這裡，自然的奇蹟等著您去發現！
              </p>
            </div>
            <div class="ItineraryMix">
              <img src="@/assets/images/about/IB2_3.webp" alt="" />
              <div class="txtBox">
                <p>
                  亞瑟山口是攝影愛好者的天堂。無論是日出時的山脈薄霧，還是黃昏時分的夕陽餘暉，每個角落都是絕佳的拍攝點。捕捉這些獨特的瞬間，您將帶回一生難忘的回憶和驚人的照片。
                </p>
              </div>
            </div>
          </div>
          <div class="ItineraryDetail4">
            <div class="text">
              <h3>海底餐廳</h3>
              <p>
                在這浩瀚的海底世界中，迎接一場獨一無二的美食體驗！踏進海底餐廳，您將沉浸於令人夢幻的海洋奇境。這個位於海底深處的餐廳猶如一座透明的水晶殿堂，四周被璀璨的海底生物和色彩繽紛的珊瑚所環繞。當您坐在餐桌旁，透過透明的落地窗欣賞著游動的熱帶魚群和優雅的海龜，仿佛置身於一個夢幻般的海底世界。
              </p>
              <p>
                海底餐廳以新鮮、精緻的海鮮美食為您提供最優質的餐飲體驗。廚師們精心烹調來自海洋的珍饈美味，融入創意和精湛的烹飪技巧，為您帶來一場舌尖上的盛宴。無論是鮮嫩多汁的龍蝦、鮭魚刺身的鮮美，還是濃郁香滑的海鮮湯，每道菜品都是獨一無二的味覺饗宴。
              </p>
              <p>
                在這個與海洋融為一體的環境中，您可以放鬆身心，享受美食的同時欣賞著海底生態的奇妙景色。我們的服務團隊將用心照顧您的需求，為您提供一流的用餐體驗。您可以選擇與摯愛共度浪漫的晚餐，與家人共享溫馨的聚餐，或是與好友一同探索這片海底魔幻世界。
              </p>
            </div>
            <div class="pic">
              <img src="@/assets/images/about/IB1_6.png" alt="" />
            </div>
          </div>
          <div class="ItineraryDetail5">
            <div class="text">
              <h3>銀狐溫泉</h3>
              <p>
                銀狐溫泉位於山谷深處，被翠綠的森林所環繞，是一個充滿神秘與寧靜氛圍的溫泉勝地。這裡以其豪華的設施和優美的自然環境而聞名，為遊客提供了放鬆身心的完美場所。
              </p>
              <p>
                步入銀狐溫泉，您將感受到溫泉的療癒力量。溫泉水源來自於地底深處的天然溫泉泉眼，含有豐富的礦物質，據說對皮膚有極大的益處。您可以沉浸在溫暖的湯池中，讓溫泉的溫柔浸潤您的身體，舒緩疲勞、放鬆壓力。
              </p>
              <p>
                銀狐溫泉也提供多種不同風格的湯池，每一個湯池都有獨特的特色，如露天湯、木造湯屋和岩石湯等，讓您盡情享受不同的溫泉體驗。無論是在寒冷的冬季還是溫暖的夏季，銀狐溫泉都能帶給您恢復活力的感覺。
              </p>
              <p>
                此外，銀狐溫泉還提供舒適的住宿設施，您可以選擇傳統的日式客房或現代風格的套房，每個房間都設有私人溫泉浴缸，讓您在享受湯泉的同時擁有隱私和舒適。
              </p>
            </div>
            <div class="pic">
              <img src="@/assets/images/about/ac04.png" alt="" />
            </div>
          </div>
          <div class="ItineraryDetail6">
            <h3>景觀公園</h3>
            <div class="pic">
              <img src="@/assets/images/about/IB1_3.png" alt="" />
            </div>
            <div class="text">
              <p>
                景觀公園是一個充滿詩意和浪漫的地方，將您帶入一個宛如夢幻的童話世界。景觀公園位於山谷之中，被滿山遍野的楓樹所包圍，每逢秋季，楓葉的綻放將這片土地染成一片火紅，猶如畫卷般的美景令人陶醉。
              </p>
              <p>
                漫步在景觀公園，您會感受到大自然的恩賜，置身於無盡的美麗和寧靜之中。湖泊映襯著滿天的楓葉，倒影出如詩如畫的景象，讓您彷彿置身於一幅充滿著愛和浪漫的水墨畫中。
              </p>
              <p>
                景觀公園也是攝影師的天堂，每年的秋季都吸引著來自世界各地的攝影愛好者前來捕捉這壯麗的楓葉景色。在金色的陽光映照下，楓葉如火焰般燃燒，成為了最美麗的自然畫作。
              </p>
              <p>
                除了楓葉，景觀公園還擁有多樣的植被和野生動物。您可以沿著森林小徑散步，聆聽著悠然的鳥鳴聲，感受著大自然的生機。這裡也是觀鳥者的天堂，您可以目睹到各種野生動物在這片天然棲息地中自由自在地生活。來到景觀公園，您將被大自然的美麗和神秘所征服。讓我們一同沉浸在這片充滿詩意和愛的土地，尋找心靈的寧靜和平衡。
              </p>
              <p>
                透過這趟漫遊列車之旅，將帶給您前所未有的探險和體驗。從忘卻之湖和亞瑟山口的壯麗美景，到海底餐廳的海洋奇境，再到銀狐溫泉和景觀公園的寧靜與浪漫，每個景點都將為您帶來獨一無二的旅程。讓我們一同踏上這段神奇的旅程，創造屬於您的珍貴回憶。
              </p>
            </div>
          </div>
          <div class="buyTickets">
            <router-link to="/online-booking">購買行程</router-link>
          </div>
        </template>
        <template v-else
          ><div class="ItineraryDetail2">
            <div class="ItineraryTxt">
              <h3>景觀公園</h3>
              <p>
                景觀公園是一個充滿詩意和浪漫的地方，將您帶入一個宛如夢幻的童話世界。景觀公園位於山谷之中，被滿山遍野的楓樹所包圍，每逢秋季，楓葉的綻放將這片土地染成一片火紅，猶如畫卷般的美景令人陶醉。
              </p>
              <p>
                漫步在景觀公園，您會感受到大自然的恩賜，置身於無盡的美麗和寧靜之中。湖泊映襯著滿天的楓葉，倒影出如詩如畫的景象，讓您彷彿置身於一幅充滿著愛和浪漫的水墨畫中。
              </p>
              <p>
                景觀公園也是攝影師的天堂，每年的秋季都吸引著來自世界各地的攝影愛好者前來捕捉這壯麗的楓葉景色。在金色的陽光映照下，楓葉如火焰般燃燒，成為了最美麗的自然畫作。
              </p>
              <p>
                除了楓葉，景觀公園還擁有多樣的植被和野生動物。您可以沿著森林小徑散步，聆聽著悠然的鳥鳴聲，感受著大自然的生機。這裡也是觀鳥者的天堂，您可以目睹到各種野生動物在這片天然棲息地中自由自在地生活。來到景觀公園，您將被大自然的美麗和神秘所征服。讓我們一同沉浸在這片充滿詩意和愛的土地，尋找心靈的寧靜和平衡。
              </p>
              <p>
                透過這趟漫遊列車之旅，將帶給您前所未有的探險和體驗。從忘卻之湖和亞瑟山口的壯麗美景，到海底餐廳的海洋奇境，再到銀狐溫泉和景觀公園的寧靜與浪漫，每個景點都將為您帶來獨一無二的旅程。讓我們一同踏上這段神奇的旅程，創造屬於您的珍貴回憶。
              </p>
            </div>
            <div class="ItineraryMix">
              <img src="@/assets/images/about/IB1_3.png" alt="" />
              <div class="txtBox">
                <p>
                  景觀公園是一個充滿夢幻色彩和自然魅力的地方。無論是楓葉谷的絢爛景色、森林的神秘氛圍還是楓葉樂園的歡樂時光，這個地方將為您帶來難忘的美好體驗。在景觀公園中，您將彷彿與大自然融為一體，感受自然的神奇之美。
                </p>
              </div>
            </div>
          </div>
          <div class="ItineraryDetail3">
            <div class="ItineraryTxt">
              <h3>銀狐溫泉</h3>
              <p>
                銀狐溫泉位於山谷深處，被翠綠的森林所環繞，是一個充滿神秘與寧靜氛圍的溫泉勝地。這裡以其豪華的設施和優美的自然環境而聞名，為遊客提供了放鬆身心的完美場所。
              </p>
              <p>
                步入銀狐溫泉，您將感受到溫泉的療癒力量。溫泉水源來自於地底深處的天然溫泉泉眼，含有豐富的礦物質，據說對皮膚有極大的益處。您可以沉浸在溫暖的湯池中，讓溫泉的溫柔浸潤您的身體，舒緩疲勞、放鬆壓力。
              </p>
              <p>
                此外，銀狐溫泉還提供舒適的住宿設施，您可以選擇傳統的日式客房或現代風格的套房，每個房間都設有私人溫泉浴缸，讓您在享受湯泉的同時擁有隱私和舒適。
              </p>
            </div>
            <div class="ItineraryMix">
              <img src="@/assets/images/about/ac04.png" alt="" />
              <div class="txtBox">
                <p>
                  銀狐溫泉也提供多種不同風格的湯池，每一個湯池都有獨特的特色，如露天湯、木造湯屋和岩石湯等，讓您盡情享受不同的溫泉體驗。無論是在寒冷的冬季還是溫暖的夏季，銀狐溫泉都能帶給您恢復活力的感覺。
                </p>
              </div>
            </div>
          </div>
          <div class="ItineraryDetail4">
            <div class="text">
              <h3>海底餐廳</h3>
              <p>
                在這浩瀚的海底世界中，迎接一場獨一無二的美食體驗！踏進海底餐廳，您將沉浸於令人夢幻的海洋奇境。這個位於海底深處的餐廳猶如一座透明的水晶殿堂，四周被璀璨的海底生物和色彩繽紛的珊瑚所環繞。當您坐在餐桌旁，透過透明的落地窗欣賞著游動的熱帶魚群和優雅的海龜，仿佛置身於一個夢幻般的海底世界。
              </p>
              <p>
                海底餐廳以新鮮、精緻的海鮮美食為您提供最優質的餐飲體驗。廚師們精心烹調來自海洋的珍饈美味，融入創意和精湛的烹飪技巧，為您帶來一場舌尖上的盛宴。無論是鮮嫩多汁的龍蝦、鮭魚刺身的鮮美，還是濃郁香滑的海鮮湯，每道菜品都是獨一無二的味覺饗宴。
              </p>
              <p>
                在這個與海洋融為一體的環境中，您可以放鬆身心，享受美食的同時欣賞著海底生態的奇妙景色。我們的服務團隊將用心照顧您的需求，為您提供一流的用餐體驗。您可以選擇與摯愛共度浪漫的晚餐，與家人共享溫馨的聚餐，或是與好友一同探索這片海底魔幻世界。
              </p>
            </div>
            <div class="pic">
              <img src="@/assets/images/about/IB1_6.png" alt="" />
            </div>
          </div>
          <div class="ItineraryDetail5">
            <div class="text">
              <h3>忘卻之湖</h3>
              <p>
                踏入忘卻之湖，進入一個隱世仙境的奇幻之旅！忘卻之湖位於遠離塵囂的絕美地帶，將您帶入一個讓心靈沉澱、身心放鬆的寧靜世界。湖泊周圍環繞著壯麗的山脈，湖水如翡翠般清澈，湖面倒影著蔚藍天空和青翠的樹木。置身於這片自然環境中，您將感受到大自然的奧秘與純粹，彷彿置身於一幅動人的畫卷中。
              </p>
              <p>
                忘卻之湖是一個遠離塵囂的避世之地，讓您逃離日常煩囂，重新與自然連結。您可以漫步於湖邊的迴廊，呼吸著新鮮的空氣，欣賞著四季變幻的美景。在這個寧靜的環境中，您可以深度放鬆、擁抱內心的寧靜。
              </p>
              <p>
                無論您是想放鬆身心，還是渴望與自然親密接觸，忘卻之湖將成為您的避世天堂。讓我們一同進入這個仙境般的湖泊，與大自然共舞，感受身心的寧靜與美好。在忘卻之湖，重拾對生活的熱愛，追尋內心的寧靜和平衡。
              </p>
            </div>
            <div class="pic">
              <img src="@/assets/images/about/ac02.png" alt="" />
            </div>
          </div>
          <div class="buyTickets">
            <router-link to="/online-booking">購買行程</router-link>
          </div></template
        >
      </div>
    </div>
  </div>
  <div class="back-top hide" title="回頂部"></div>
</template>

<script>
export default {
  data() {
    return {
      tabActive: 2,
      airticles: [
        {
          title: "銀月山脈的浪漫之旅",
          content1:
            "沉浸在五大奇境：景觀公園、綠野牧場、銀月山脈星際奇觀、高原遺跡古老光芒及海底餐廳奇幻海洋，五站五種感官饗宴！美食、美景與刺激冒險交織，探索大自然的魅力。與家人、摯愛或好友共赴美好時光，景觀公園觀光列車，讓您尋找寧靜與快樂。",
          ItineraryDetail_html: "",
        },
        {
          title: "湖光山色的奇幻之旅 ",
          content1:
            "沉浸於湖光山色的奇幻之旅！探訪忘卻之湖，尋覓大自然的純粹與寧靜；徜徉亞瑟山口，感受山巒峽谷的壯麗景致。探索海底餐廳的奇幻海洋，品味美食與海底生態交融。再來到銀狐溫泉放鬆身心，享受溫暖的泉水。最後，來到景觀公園，被楓葉的色彩所陶醉。乘坐列車漫遊五重奇境，給您留下難忘的奇幻體驗！",
          ItineraryDetail_html: "",
        },
        {
          title: "海底餐廳的冒險之旅 ",
          content1:
            "這趟列車之旅將帶您穿越仙境、湖泊和溫泉，最後探索海底奇幻世界的美食饗宴。首先，景觀公園帶您沉浸在紅黃楓葉的絢麗色彩。接著，銀狐溫泉提供療癒的湯池體驗。來到海底餐廳品嚐海洋美食，觀賞游動的生物。最後忘卻之湖為您帶來清澈湖水的寧靜。這趟冒險之旅將帶您體驗大自然的魅力，以及獨一無二的海底餐廳美食體驗，讓您留下難忘的回憶。",
          ItineraryDetail_html: "",
        },
      ],
    };
  },
  methods: {
    changeBackground(url) {
      const attractions = document.querySelector(".attractions");
      attractions.style.backgroundImage = `url(${url})`;
    },
    // 分類按鈕
    updateTab(index) {
      this.tabActive = index;
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@/assets/scss/style.scss";
.ItineraryBanner {
  background-image: url(@/assets/images/about/ST3114.jpg);
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-position: center;
  background-size: cover;
  height: 100vh;
  color: white;
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center;
  .bannerTxt {
    h2 {
      font-size: 48px;
    }
    span {
      color: white;
      font-size: 32px;
    }
  }
}

.ItineraryDesc {
  h2 {
    font-size: 36px;
  }
  h3 {
    font-size: 28px;
    margin-bottom: 8px;
  }
  p {
    font-size: 20px;
    line-height: 2em;
  }
  img {
    width: 100%;
  }

  .ItineraryDetail1 {
    position: relative;
    .bgi {
      img {
        width: 100%;
      }
    }
    .ItinerarySwitch {
      position: absolute;

      top: 40px;
      @include pc {
        top: 80px;
      }

      left: 50%;
      transform: translateX(-50%);

      width: 100%;
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      @include pc {
        width: 750px;
      }

      button {
        margin: 0 -1px;
        padding: 10px;
        border: 1px solid;
        font-size: 24px;
      }
    }
    .ItineraryHeader {
      position: relative;
      @include pad {
        position: absolute;
      }

      bottom: 0;
      @include pc {
        bottom: 160px;
      }

      left: 0;

      background-color: #fff;

      opacity: 0.8;

      width: 100%;
      @include pc {
        width: 60%;
      }
      padding: 16px;
    }
  }

  .ItineraryDetail2 {
    margin-top: 40px;

    .ItineraryMix {
      margin-top: 40px;

      position: relative;

      .txtBox {
        position: relative;
        @include pad {
          position: absolute;
        }

        bottom: 0;
        @include pc {
          bottom: 40px;
        }
        right: 0px;
        p {
          display: inline-block;

          width: 100%;
          @include pc {
            width: 60%;
          }
          background-color: #a6a6a6;
          opacity: 0.9;
          padding: 16px;
        }
      }
    }
  }
  .ItineraryDetail3 {
    margin-top: 40px;
    .ItineraryMix {
      margin-top: 40px;

      position: relative;

      .txtBox {
        position: relative;
        @include pad {
          position: absolute;
        }
        bottom: 0;
        @include pc {
          bottom: 40px;
        }
        right: 0px;
        p {
          display: inline-block;
          width: 100%;
          @include pc {
            width: 60%;
          }
          background-color: #a6a6a6;
          opacity: 0.9;
          padding: 16px;
        }
      }
    }
  }
  .ItineraryDetail4 {
    margin-top: 40px;
    .pic {
      margin-top: 40px;
    }
  }
  .ItineraryDetail5 {
    margin-top: 40px;
    .pic {
      margin-top: 40px;
    }
  }
  .ItineraryDetail6 {
    margin-top: 40px;
    .pic {
      margin-top: 40px;
    }
    .text {
      margin-top: 40px;
    }
  }
  .buyTickets {
    margin-bottom: 40px;
    a {
      text-decoration: none;
      font-size: 28px;
      color: black;
      display: block;
      text-align: right;
      margin-top: 16px;
      &:hover {
        color: #7aacbf;
      }
    }
  }
}

.back-top {
  z-index: 99999;
  position: fixed;
  bottom: 15px;
  right: 15px;
  cursor: pointer;
  opacity: 0.5;
  filter: Alpha(opacity=50);
  width: 35px;
  height: 35px;
  background: #000 center no-repeat
    url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+CjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4KCjxzdmcKICAgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIgogICB4bWxuczpjYz0iaHR0cDovL2NyZWF0aXZlY29tbW9ucy5vcmcvbnMjIgogICB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiCiAgIHhtbG5zOnN2Zz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciCiAgIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIKICAgeG1sbnM6c29kaXBvZGk9Imh0dHA6Ly9zb2RpcG9kaS5zb3VyY2Vmb3JnZS5uZXQvRFREL3NvZGlwb2RpLTAuZHRkIgogICB4bWxuczppbmtzY2FwZT0iaHR0cDovL3d3dy5pbmtzY2FwZS5vcmcvbmFtZXNwYWNlcy9pbmtzY2FwZSIKICAgdmVyc2lvbj0iMS4xIgogICBpZD0iQ2FwYV8xIgogICB4PSIwcHgiCiAgIHk9IjBweCIKICAgd2lkdGg9IjUxMnB4IgogICBoZWlnaHQ9IjUxMnB4IgogICB2aWV3Qm94PSIwIDAgNDUxLjg0NiA0NTEuODQ3IgogICBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA0NTEuODQ2IDQ1MS44NDc7IgogICB4bWw6c3BhY2U9InByZXNlcnZlIgogICBpbmtzY2FwZTp2ZXJzaW9uPSIwLjQ4LjUgcjEwMDQwIgogICBzb2RpcG9kaTpkb2NuYW1lPSJhcnJvdy1wb2ludC10by1yaWdodC5zdmciPjxtZXRhZGF0YQogICBpZD0ibWV0YWRhdGE0MSI+PHJkZjpSREY+PGNjOldvcmsKICAgICAgIHJkZjphYm91dD0iIj48ZGM6Zm9ybWF0PmltYWdlL3N2Zyt4bWw8L2RjOmZvcm1hdD48ZGM6dHlwZQogICAgICAgICByZGY6cmVzb3VyY2U9Imh0dHA6Ly9wdXJsLm9yZy9kYy9kY21pdHlwZS9TdGlsbEltYWdlIiAvPjwvY2M6V29yaz48L3JkZjpSREY+PC9tZXRhZGF0YT48ZGVmcwogICBpZD0iZGVmczM5IiAvPjxzb2RpcG9kaTpuYW1lZHZpZXcKICAgcGFnZWNvbG9yPSIjZmZmZmZmIgogICBib3JkZXJjb2xvcj0iIzY2NjY2NiIKICAgYm9yZGVyb3BhY2l0eT0iMSIKICAgb2JqZWN0dG9sZXJhbmNlPSIxMCIKICAgZ3JpZHRvbGVyYW5jZT0iMTAiCiAgIGd1aWRldG9sZXJhbmNlPSIxMCIKICAgaW5rc2NhcGU6cGFnZW9wYWNpdHk9IjAiCiAgIGlua3NjYXBlOnBhZ2VzaGFkb3c9IjIiCiAgIGlua3NjYXBlOndpbmRvdy13aWR0aD0iMTYwMCIKICAgaW5rc2NhcGU6d2luZG93LWhlaWdodD0iODM3IgogICBpZD0ibmFtZWR2aWV3MzciCiAgIHNob3dncmlkPSJmYWxzZSIKICAgaW5rc2NhcGU6em9vbT0iMC40NjA5Mzc1IgogICBpbmtzY2FwZTpjeD0iMjU2IgogICBpbmtzY2FwZTpjeT0iMjU2IgogICBpbmtzY2FwZTp3aW5kb3cteD0iLTgiCiAgIGlua3NjYXBlOndpbmRvdy15PSItOCIKICAgaW5rc2NhcGU6d2luZG93LW1heGltaXplZD0iMSIKICAgaW5rc2NhcGU6Y3VycmVudC1sYXllcj0iQ2FwYV8xIiAvPgo8ZwogICBpZD0iZzMiCiAgIHN0eWxlPSJmaWxsOiNmZmZmZmYiCiAgIHRyYW5zZm9ybT0ibWF0cml4KDAsLTEsLTEsMCw0NTEuODQ2NSw0NTEuODQ2NSkiPgoJPHBhdGgKICAgZD0iTSAzNDUuNDQxLDI0OC4yOTIgMTUxLjE1NCw0NDIuNTczIGMgLTEyLjM1OSwxMi4zNjUgLTMyLjM5NywxMi4zNjUgLTQ0Ljc1LDAgLTEyLjM1NCwtMTIuMzU0IC0xMi4zNTQsLTMyLjM5MSAwLC00NC43NDQgTCAyNzguMzE4LDIyNS45MiAxMDYuNDA5LDU0LjAxNyBjIC0xMi4zNTQsLTEyLjM1OSAtMTIuMzU0LC0zMi4zOTQgMCwtNDQuNzQ4IDEyLjM1NCwtMTIuMzU5IDMyLjM5MSwtMTIuMzU5IDQ0Ljc1LDAgbCAxOTQuMjg3LDE5NC4yODQgYyA2LjE3Nyw2LjE4IDkuMjYyLDE0LjI3MSA5LjI2MiwyMi4zNjYgMCw4LjA5OSAtMy4wOTEsMTYuMTk2IC05LjI2NywyMi4zNzMgeiIKICAgaWQ9InBhdGg1IgogICBzdHlsZT0iZmlsbDojZmZmZmZmIgogICBpbmtzY2FwZTpjb25uZWN0b3ItY3VydmF0dXJlPSIwIiAvPgo8L2c+CjxnCiAgIGlkPSJnNyI+CjwvZz4KPGcKICAgaWQ9Imc5Ij4KPC9nPgo8ZwogICBpZD0iZzExIj4KPC9nPgo8ZwogICBpZD0iZzEzIj4KPC9nPgo8ZwogICBpZD0iZzE1Ij4KPC9nPgo8ZwogICBpZD0iZzE3Ij4KPC9nPgo8ZwogICBpZD0iZzE5Ij4KPC9nPgo8ZwogICBpZD0iZzIxIj4KPC9nPgo8ZwogICBpZD0iZzIzIj4KPC9nPgo8ZwogICBpZD0iZzI1Ij4KPC9nPgo8ZwogICBpZD0iZzI3Ij4KPC9nPgo8ZwogICBpZD0iZzI5Ij4KPC9nPgo8ZwogICBpZD0iZzMxIj4KPC9nPgo8ZwogICBpZD0iZzMzIj4KPC9nPgo8ZwogICBpZD0iZzM1Ij4KPC9nPgo8L3N2Zz4=);
  background-size: 24px 24px;
  border-radius: 12px;
  border: 1px rgba(255, 255, 255, 0.6) solid;
  box-shadow: 0px 0px 3px #ffffff;
  transform: translateY(0%);
  transition: all 0.2s linear;
}

.back-top:hover {
  opacity: 0.8;
  filter: Alpha(opacity=80);
  box-shadow: 0px 0px 6px #ffffff;
}

.back-top.hide {
  opacity: 0;
  filter: Alpha(opacity=0);
  transform: translateY(150%);
}

@media all and (max-width: 1200px) {
  .ItineraryHeader {
    position: absolute;
    bottom: 0px;
    left: 0;
    // background-color: #111 !important;
    opacity: 0.8;
    width: 60%;
    padding: 16px;
  }
}
</style>
