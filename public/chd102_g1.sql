-- 建立一個新的資料庫
CREATE DATABASE chd102_g1;

-- 選擇你剛剛建立的資料庫
USE chd102_g1;



-- 🔥 管理員帳號 cms_staff

-- 創建資料表並定義欄位
CREATE TABLE cms_staff (
  staff_no INT AUTO_INCREMENT PRIMARY KEY,
  staff_name VARCHAR(10) NOT NULL,
  staff_pwd VARCHAR(10) NOT NULL,
  staff_email VARCHAR(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 插入內容資料
INSERT INTO cms_staff (staff_name, staff_pwd, staff_email)
VALUES 
('test', 'test', 'test@gmali.com');

-- 查看表格資料
-- SELECT * FROM cms_staff;

-- 查看表格結構
-- DESCRIBE cms_staff;



-- 🔥 會員 member

-- 創建資料表並定義欄位
CREATE TABLE member (
  mem_no INT AUTO_INCREMENT PRIMARY KEY,
  mem_name VARCHAR(10) NOT NULL,
  mem_salutation CHAR(2),
  mem_email VARCHAR(30) NOT NULL,
  mem_mobile VARCHAR(10),
  mem_addr VARCHAR(40),
  mem_acc VARCHAR(8) NOT NULL,
  mem_pwd VARCHAR(8) NOT NULL,
  pattern_file VARCHAR(60)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 插入內容資料
INSERT INTO member (mem_name, mem_email, mem_acc, mem_pwd)
VALUES 
('小明', 'aaa@gmail.com', 'aaa', 'aaa'),
('小花', 'bbb@gmail.com', 'bbb', 'bbb'),
('老王', 'ccc@gmail.com', 'ccc', 'ccc')
;

-- 查看表格資料
-- SELECT * FROM member;

-- 查看表格結構
-- DESCRIBE member;



-- 🔥 行程 package

-- 創建資料表並定義欄位
CREATE TABLE package (
  pkg_no INT AUTO_INCREMENT PRIMARY KEY,
  pkg_price INT NOT NULL,
  pkg_status TINYINT NOT NULL,
  pkg_name VARCHAR(30) NOT NULL,
  pkg_desc TEXT NOT NULL,
  -- sch_no INT, 班次編號（無該表格）
  train_no INT,
  conductor VARCHAR(10),
  -- departure_station VARCHAR(10),
  -- arrival_station VARCHAR(10),
  remarks VARCHAR(40),
  cover_file VARCHAR(60)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- 插入內容資料(在FK後面新增)
-- 插入內容資料
INSERT INTO `package` (`pkg_no`, `pkg_price`, `pkg_status`, `pkg_name`, `pkg_desc`, `train_no`, `conductor`, `remarks`) VALUES
(1, 36888, 1, '島嶼探索之旅，搭乘尊爵的ROYAL豪華列車二日遊', '在ROYAL列車上享受舒適的旅程，欣賞海岸線的壯麗美景。中午，列車停靠在一個迷人的小鎮，讓您參加島嶼導覽活動，品嘗當地的特色美食。傍晚時分，您將入住豪華的度假酒店，享受尊爵式的招待與頂級的設施。', 1, '克勞德', NULL),
(2, 41888, 1, '探尋星空之美，搭乘耀眼的七星豪華列車二日遊', '登上七星豪華列車，開啟探尋星空之美的旅途。列車內舒適奢華的環境，讓您盡情享受旅途的舒適。夜幕降臨時，列車穿越幽暗的森林與山川，讓您在星光的映照下感受大自然的神秘魅力。', 2, '文森特', NULL),
(3, 31888, 1, '搭乘閃耀的GOLDEN豪華列車放鬆身心一日遊', '登上GOLDEN豪華列車，迎接這美好的一日遊。列車的內部環境豪華舒適，讓您感受尊榮的待遇，放下一切煩憂。,列車緩緩行駛，穿梭於美麗的風景中。您可以透過列車車窗欣賞外面壯麗的自然風光，或在車廂內享用美味的餐點，嘆一口新鮮的空氣，感受輕鬆愉悅的氛圍。,在這悠閒的一日遊中，您還可以選擇參加列車上的特色活動，例如品酒會、休閒放鬆的SPA體驗，或是聆聽現場音樂表演。您可以依照自己的喜好，度過這愜意的時光。,傍晚時分，列車將帶著您回到出發地，結束這一天的GOLDEN豪華列車之旅。帶著放鬆愉悅的心情，您將帶著美好的回憶回家，並享受這段難忘的一日遊所帶來的愉悅感受。', 3, '巴雷特', NULL);

-- 查看表格資料
-- SELECT * FROM package;

-- 查看表格結構
-- DESCRIBE package;



-- 🔥 開團 organize

-- 創建資料表並定義欄位
CREATE TABLE organize (
  org_no INT AUTO_INCREMENT PRIMARY KEY,
  pkg_no INT NOT NULL,
  pkg_limit INT NOT NULL,
  pkg_sale DECIMAL,
  dept_date DATE NOT NULL,
  enrolled INT,
  reg_start DATE NOT NULL,
  reg_end DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 插入內容資料
INSERT INTO `organize` (`org_no`, `pkg_no`, `pkg_limit`, `pkg_sale`, `dept_date`, `enrolled`, `reg_start`, `reg_end`) VALUES
(1, 2, 40, '0', '2025-03-18', 30, '2025-01-18', '2025-03-11'),
(2, 1, 40, '0', '2025-04-18', 20, '2025-02-18', '2025-04-11'),
(3, 3, 40, '5000', '2025-05-08', 5, '2025-03-18', '2025-05-11'),
(4, 3, 40, '5000', '2025-05-18', 7, '2025-04-08', '2025-06-01'),
(5, 2, 40, '5000', '2025-06-18', 5, '2025-04-18', '2025-06-11'),
(6, 1, 40, '5000', '2025-07-18', 0, '2025-05-18', '2025-07-11');
-- 查看表格資料
-- SELECT * FROM organize;

-- 查看表格結構
-- DESCRIBE organize;



-- 🔥 開團訂單 package_order

-- 創建資料表並定義欄位
CREATE TABLE package_order (
  order_no INT AUTO_INCREMENT PRIMARY KEY,
  order_date DATETIME NOT NULL,
  order_total DECIMAL NOT NULL,
  mem_no INT NOT NULL,
  recipient_tele INT NOT NULL,
  recipient_address VARCHAR(40),
  org_no INT NOT NULL,
  pattern_newfile  VARCHAR(60)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 插入內容資料


-- 查看表格資料
-- SELECT * FROM package_order;

-- 查看表格結構
-- DESCRIBE package_order;



-- 🔥 客製車票圖案 pattern

-- 創建資料表並定義欄位
CREATE TABLE pattern (
  pattern_no INT AUTO_INCREMENT PRIMARY KEY,
  pattern_name VARCHAR(10) NOT NULL,
  pattern_file VARCHAR(60) NOT NULL,
  pattern_desc TEXT NOT NULL,
  creation_date DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 插入內容資料
INSERT INTO pattern (pattern_name, pattern_file, pattern_desc, creation_date)
VALUES 
('1', 'images/pattern/1.svg', '楓葉', '2023-07-20'),
('2', 'images/pattern/2.svg', '太陽', '2023-07-21'),
('3', 'images/pattern/3.svg', '月亮', '2023-07-22'),
('4', 'images/pattern/4.svg', '笑哭', '2023-07-23'),
('5', 'images/pattern/5.svg', '溫泉', '2023-08-08');
;

-- 查看表格資料
-- SELECT * FROM pattern;

-- 查看表格結構
-- DESCRIBE pattern;



-- 🔥 行程收藏 package_trace

-- 創建資料表並定義欄位
CREATE TABLE package_trace (
  mem_no INT NOT NULL,
  pkg_no INT NOT NULL,
    
	PRIMARY KEY (mem_no, pkg_no),
    FOREIGN KEY (mem_no) REFERENCES member(mem_no),
    FOREIGN KEY (pkg_no) REFERENCES package(pkg_no)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 查看表格資料
-- SELECT * FROM package_trace;

-- 查看表格結構
-- DESCRIBE package_trace;


-- 🔥 景點 spot

-- 創建資料表並定義欄位
CREATE TABLE spot (
  spot_no INT AUTO_INCREMENT PRIMARY KEY,
  spot_name VARCHAR(10),
  spot_info VARCHAR(255),
  spot_status TINYINT,
  spot_file VARCHAR(500)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- 插入內容資料
INSERT INTO `spot` (`spot_no`, `spot_name`, `spot_info`, `spot_status`, `spot_file`) VALUES
(1, '高原遺跡', '一個充滿歷史色彩的神秘之地。隱藏在高山脊梁上的古老遺址，它見證了遠古時代的文明興衰和人類智慧的薪火相傳。這片遺跡位於雄偉壯麗的高原地帶，被廣闊的草原和壯麗的山脈所環繞。當您踏足在這片土地上時，可以感受到歷史的洪流在這裡流轉。', 1, 'images/spot/01.jpg'),
(2, '銀月山脈', '在銀月山脈的脈動中，您將發現一個神秘而令人著迷的景色。這座山脈綿延起伏，山巒疊翠，彷彿置身於一幅宏偉的山水畫中。銀月山脈以其壯麗的景色和原始的自然美景而聞名，而當夜幕降臨時，更有極光的奇景為您帶來驚喜。', 1, 'images/spot/02.jpg'),
(3, '綠野牧場', '綠野牧場是一個讓您放鬆心靈、與自然和諧共處的絕佳地點。來到這裡,漫步於綠野牧場，與小動物親密接觸，感受自然生態，特別的農場體驗,讓您在這片綠意盎然的土地上感受到原野自然的美好。', 1, 'images/spot/03.jpg'),
(4, '海底餐廳', '這座根基位於海底的餐廳猶如一座透明的水晶殿堂，四周被璀璨的海底生物和色彩繽紛的珊瑚所環繞。當您坐在餐桌旁，透過透明的落地窗欣賞著游動的熱帶魚群和優雅的海龜，仿佛置身於一個夢幻般的海底世界。', 1, 'images/spot/04.png'),
(5, '忘卻之湖', '於青山綠谷之中，忘卻之湖猶如一個神秘的秘境。湖面平靜如鏡，周圍群山環繞，湖水清澈見底。在湖邊散步深藏,您將被自然的寧靜與美麗所包圍。湖泊四季變幻的景色，從春日的綠意盎然到秋天的落葉彩繪，都令人陶醉其中，是探索大自然和追尋心靈寧靜的理想之地。', 1, 'images/spot/05.jpg'),
(6, '景觀公園', '景觀公園是一個令人著迷的地方，這裡的樹林擁有著美麗的秋天景色，萬紅橙黃的楓葉在微風中輕輕飄落。漫步在景觀公園彷彿置身於一個夢幻般的童話故事中。這裡的靜謐與寧靜讓您的心靈得到放鬆和平靜，同時享受著大自然所賦予的美妙。', 1, 'images/spot/08.webp');

-- 查看表格資料
-- SELECT * FROM spot;

-- 查看表格結構
-- DESCRIBE spot;



-- 🔥 行程景點 package_pass

-- 創建資料表並定義欄位
CREATE TABLE package_pass (
  pkg_no INT NOT NULL,
  spot_no INT NOT NULL,
  spot_sort INT NOT NULL,
  pkg_howday INT NOT NULL,
    
	PRIMARY KEY (pkg_no, spot_no),
    FOREIGN KEY (pkg_no) REFERENCES package(pkg_no),
    FOREIGN KEY (spot_no) REFERENCES spot(spot_no)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 插入內容資料


-- 查看表格資料
-- SELECT * FROM package_pass;

-- 查看表格結構
-- DESCRIBE package_pass;




-- 🔥 開團座位 seat -- XXX

-- 創建資料表並定義欄位
CREATE TABLE seat (
  seat_no INT PRIMARY KEY,
  order_no INT
  -- car_no INT,
  -- org_no INT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 插入內容資料


-- 查看表格資料
-- SELECT * FROM seat;

-- 查看表格結構
-- DESCRIBE seat;



-- 🔥 列車 train

-- 創建資料表並定義欄位
CREATE TABLE train (
  train_no INT AUTO_INCREMENT PRIMARY KEY,
  train_name VARCHAR(10) NOT NULL,
  train_qty INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 插入內容資料
INSERT INTO train (train_name, train_qty)
VALUES 
('royal', 40),
('seven star', 40),
('golden', 40);

-- 查看表格資料
-- SELECT * FROM train;

-- 查看表格結構
-- DESCRIBE train;



-- 🔥 商品 product

-- 創建資料表並定義欄位
CREATE TABLE product (
  prod_no INT AUTO_INCREMENT PRIMARY KEY,
  prod_name VARCHAR(20) NOT NULL,
  prod_summary VARCHAR(200) NOT NULL,
  prod_price INT NOT NULL,
  prod_status TINYINT,
  prod_file VARCHAR(255),
  prod_type VARCHAR(20) NOT NULL,
  prod_hot TINYINT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 插入內容資料
INSERT INTO product (prod_name, prod_summary, prod_price, prod_status, prod_file, prod_type, prod_hot)
VALUES 
('火車懷錶', '超時尚的火車主題懷錶，精緻設計，可隨身攜帶，是時尚愛好者的最佳時尚配件。', 600, 1, 'p1.png', '周邊', 1),
('火車叉叉', '精美餐具，與火車造型設計，為用餐增添樂趣，品質優良，適合日常使用。', 200, 1, 'fork.png', '周邊', 0),
('車車模型', '細緻車車模型，適合小朋友收藏與遊戲，啟發想像力與探索精神。', 300, 1, 'Train_model.png', '玩具', 1),
('車車吊牌', '可愛吊牌飾品，以車車為主題，掛在包包或鑰匙上，為日常增添俏皮風格。', 100, 1, 'Keychain_pendant_B.png', '周邊', 0),
('超讚大獎章', '獨特設計的大獎章，凸顯特別身份或慶祝時刻，讓你成為焦點。', 100, 1, 'Badge.png', '周邊', 0),
('車車手帕', '柔軟手帕，印有可愛車車圖案，清新色彩，是時尚配件或禮物的絕佳選擇。', 80, 1, 'Towel.png', '周邊', 0),
('車車便當', '美味便當，融合車車元素，讓用餐時光更有趣，口感與外觀兼具。', 100, 1, 'Train_bento_box.png', '食品', 1),
('車車吊飾', '精緻吊飾，可懸掛於車內或房間，為空間增添可愛氛圍。', 150, 1, 'Keychain_pendant_A.png', '周邊', 0),
('漫遊御飯糰', '嚴選食材製成的美味御飯糰，方便攜帶，是上班族或學生的理想選擇。', 50, 1, 'onigiri.png', '食品', 0),
('ROYAL火車模型', '尊貴的ROYAL火車模型，精工製作，是收藏家們的珍貴收藏。', 1599, 1, 'royal.jpg', '玩具', 0),
('SEVEN STARS火車模型', '罕見的SEVEN STARS火車模型，造型獨特，展現獨特品味的收藏品。', 1299, 1, 'seven_star.jpg', '玩具', 0)
;

-- 查看表格資料
-- SELECT * FROM product;

-- 查看表格結構
-- DESCRIBE product;



-- 🔥 商品訂單 order

-- 創建資料表並定義欄位
CREATE TABLE product_order (
  order_no INT AUTO_INCREMENT PRIMARY KEY,
  order_date DATETIME NOT NULL,
  mem_no INT NOT NULL,
  order_total DECIMAL NOT NULL,
  order_status TINYINT,
  recipient VARCHAR(10) NOT NULL,
  recipient_tele CHAR(10) NOT NULL,
  recipient_address VARCHAR(40) NOT NULL,
  pay TINYINT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 插入內容資料


-- 查看表格資料
-- SELECT * FROM product_order;

-- 查看表格結構
-- DESCRIBE product_order;



-- 🔥 商品訂單項目 order_item

-- 創建資料表並定義欄位
CREATE TABLE order_item (
  order_no INT NOT NULL,
  prod_no INT NOT NULL,
  price INT NOT NULL,
  quantity INT NOT NULL,
    
	PRIMARY KEY (order_no, prod_no),
    FOREIGN KEY (order_no) REFERENCES product_order(order_no),
    FOREIGN KEY (prod_no) REFERENCES product(prod_no)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 插入內容資料


-- 查看表格資料
-- SELECT * FROM order_item;

-- 查看表格結構
-- DESCRIBE order_item;



-- 🔥 商品收藏 prod_trace

-- 創建資料表並定義欄位
CREATE TABLE prod_trace (
  mem_no INT NOT NULL,
  prod_no INT NOT NULL,
  
	PRIMARY KEY (mem_no, prod_no),
    FOREIGN KEY (mem_no) REFERENCES member(mem_no),
    FOREIGN KEY (prod_no) REFERENCES product(prod_no)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 插入內容資料
INSERT INTO prod_trace (mem_no, prod_no)
VALUES 
('1', '3'),
('2', '7')
;

-- 查看表格資料
-- SELECT * FROM prod_trace;

-- 查看表格結構
-- DESCRIBE prod_trace;



-- 🔥 論壇文章 forum

-- 創建資料表並定義欄位
CREATE TABLE forum (
  article_no INT AUTO_INCREMENT PRIMARY KEY,
  article_title VARCHAR(20) NOT NULL,
  article_content VARCHAR(100) NOT NULL,
  mem_no INT NOT NULL,
  article_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  article_views INT DEFAULT 0,
  article_likes INT DEFAULT 0,
  platform_online TINYINT DEFAULT 0,
  article_image VARCHAR(50)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- 查看表格資料
-- SELECT * FROM forum;

-- 查看表格結構
DESCRIBE forum;



-- 🔥 留言 comment

-- 創建資料表並定義欄位
CREATE TABLE comment (
  comment_no INT AUTO_INCREMENT PRIMARY KEY,
  article_no INT NOT NULL,
  mem_no INT NOT NULL,
  commen_content TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- 查看表格資料
-- SELECT * FROM comment;

-- 查看表格結構
-- DESCRIBE comment;



-- 🔥 文章檢舉 report

-- 創建資料表並定義欄位
CREATE TABLE report (
  report_no INT AUTO_INCREMENT PRIMARY KEY,
  article_no INT NOT NULL,
  mem_no INT NOT NULL,
  report_content VARCHAR(100),
  report_type TINYINT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




-- 查看表格資料
-- SELECT * FROM report;

-- 查看表格結構
-- DESCRIBE report;



-- 🔥 公告 announcement

-- 創建資料表並定義欄位
CREATE TABLE announcement (
  -- title-name INT數值資料 UNSIGNED存放非負數 AUTO_INCREMENT值會自動增加 PRIMARY KEY主鍵
  anno_no INT AUTO_INCREMENT PRIMARY KEY,
  anno_title VARCHAR(20) NOT NULL,
  anno_type VARCHAR(10) NOT NULL,
  anno_content VARCHAR(300) NOT NULL,
  anno_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  anno_file VARCHAR(50)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 插入內容資料
INSERT INTO announcement (anno_title, anno_type, anno_content, anno_date, anno_file)
VALUES 
('全新的蒸汽火車旅程上線', '重要', '我們非常榮幸地宣布，“湖光山色”全新蒸汽火車之旅現已開放預訂！這個行程將帶領您從城市的喧囂中抽身，進入壯麗的大自然，穿越秀美的山脈，欣賞湖光山色的美景。在這次旅程中，您將有機會體驗古老的蒸汽火車，聆聽其叮叮噹噹的旋律，感受時光倒流的魔力。不要錯過這次與大自然親近的絕佳機會，現在就開始預訂吧！', '2023-07-21 12:34:56', 'a1.png'),
('特別節日優惠', '活動', '中秋節即將來臨，為慶祝這個重要的節日，我們決定提供特別優惠！從今日起至下月15日，只要預訂任何一個我們提供的行程，都將可以享受10%的折扣。這是我們首次提供如此大幅度的折扣，希望您能把握住這個難得的機會。讓我們在中秋月圓人團圓的美好時刻，一起享受迷人的蒸汽火車旅行吧！', '2023-07-12 09:11:22', 'a2.png'),
('全新合作夥伴-當地手工藝品體驗', '活動', '當地手工藝品體驗：我們相信旅行不只是眼睛的饗宴，也應該是深入當地文化的體驗。為此，我們很高興地宣布，我們與當地的手工藝品製作師傅達成了合作關係！在我們的蒸汽火車之旅中，您將有機會直接參與製作當地獨特的手工藝品，如陶瓷、編織或是木雕等。這不僅可以讓您帶回家一份富有當地特色的紀念品，更是讓您更深入體驗當地的文化與工藝。別錯過這個獨一無二的機會，現在就開始預訂您的蒸汽火車之旅！', '2023-06-23 15:34:22', 'a3.png'),
('永續旅遊的承諾', '重要', '在"漫遊列車之旅"，我們深知旅遊活動對環境的影響，因此我們決心致力於永續旅遊。我們很高興地宣布，我們已經開始進行一項新的計劃，這個計劃旨在降低我們的碳足跡，並支持當地的環保工作。每預訂一個行程，我們將捐出一部分的收益用於植樹活動，以抵消我們的碳排放。同時，我們也正在積極與當地的環保組織合作，提供更多的支援和幫助。我們期待您的參與，一起為了更美好的地球做出努力！', '2023-05-29 07:22:58', 'a4.png')
;


-- 查看表格資料
-- SELECT * FROM announcement;

-- 查看表格結構
-- DESCRIBE announcement;



-- 🤝 
-- example.
-- ALTER TABLE Orders ADD FOREIGN KEY (customer_id) REFERENCES Customers(customer_id);

ALTER TABLE package ADD FOREIGN KEY (train_no) REFERENCES train(train_no);

ALTER TABLE organize ADD FOREIGN KEY (pkg_no) REFERENCES package(pkg_no);

ALTER TABLE package_order ADD FOREIGN KEY (mem_no) REFERENCES member(mem_no);

ALTER TABLE package_order ADD FOREIGN KEY (org_no) REFERENCES organize(org_no);

ALTER TABLE seat ADD FOREIGN KEY (order_no) REFERENCES package_order(order_no);

ALTER TABLE product_order ADD FOREIGN KEY (mem_no) REFERENCES member(mem_no);

ALTER TABLE forum ADD FOREIGN KEY (mem_no) REFERENCES member(mem_no);

ALTER TABLE comment ADD FOREIGN KEY (article_no) REFERENCES forum(article_no);

ALTER TABLE comment ADD FOREIGN KEY (mem_no) REFERENCES member(mem_no);

ALTER TABLE report ADD FOREIGN KEY (article_no) REFERENCES forum(article_no);

ALTER TABLE report ADD FOREIGN KEY (mem_no) REFERENCES member(mem_no);



-- 插入表格資料


-- 插入 行程 package 內容資料(要先插入列車才能)
-- INSERT INTO `package` (`pkg_price`, `pkg_status`, `pkg_name`, `pkg_desc`, `train_no`, `conductor`, `remarks`) VALUES
-- (36888, 1, '島嶼探索之旅，搭乘尊爵的ROYAL豪華列車二日遊', '在ROYAL列車上享受舒適的旅程，欣賞海岸線的壯麗美景。中午，列車停靠在一個迷人的小鎮，讓您參加島嶼導覽活動，品嘗當地的特色美食。傍晚時分，您將入住豪華的度假酒店，享受尊爵式的招待與頂級的設施。', 1, '克勞德', NULL),
-- (41888, 1, '探尋星空之美，搭乘耀眼的七星豪華列車二日遊', '登上七星豪華列車，開啟探尋星空之美的旅途。列車內舒適奢華的環境，讓您盡情享受旅途的舒適。夜幕降臨時，列車穿越幽暗的森林與山川，讓您在星光的映照下感受大自然的神秘魅力。', 2, '文森特', NULL),
-- (31888, 1, '搭乘閃耀的GOLDEN豪華列車放鬆身心一日遊', '登上GOLDEN豪華列車，迎接這美好的一日遊。列車的內部環境豪華舒適，讓您感受尊榮的待遇，放下一切煩憂。,列車緩緩行駛，穿梭於美麗的風景中。您可以透過列車車窗欣賞外面壯麗的自然風光，或在車廂內享用美味的餐點，嘆一口新鮮的空氣，感受輕鬆愉悅的氛圍。,在這悠閒的一日遊中，您還可以選擇參加列車上的特色活動，例如品酒會、休閒放鬆的SPA體驗，或是聆聽現場音樂表演。您可以依照自己的喜好，度過這愜意的時光。,傍晚時分，列車將帶著您回到出發地，結束這一天的GOLDEN豪華列車之旅。帶著放鬆愉悅的心情，您將帶著美好的回憶回家，並享受這段難忘的一日遊所帶來的愉悅感受。', 3, '巴雷特', NULL);



-- 插入 行程收藏 package_trace 內容資料
INSERT INTO package_trace (mem_no, pkg_no)
VALUES 
('1', '2'),
('1', '3')
;

-- 插入 forum 內容資料
INSERT INTO forum (article_title, article_content, mem_no, article_date, article_image)
VALUES 
('首次的蒸汽火車體驗', '這是我第一次參加蒸汽火車之旅，體驗真是太棒了！從車窗外看著湖光山色，我感受到了旅行的悠閒與寧靜。整個行程由專業的導遊詳細解說，使我對這段旅程有更深的理解。我會向所有人推薦『漫遊列車之旅』。', '1', '2023-07-21 12:34:56', '/img/f1.png'),
('蒸汽火車與手工藝品的完美結合', '這次的旅程不僅讓我體驗了蒸汽火車的迷人魅力，還有機會參與當地的手工藝品製作。這種獨特的體驗讓我深深感受到當地的文化和傳統。', '2', '2023-07-20 16:34:57', '/img/f2.jpg'),
('永續旅遊的承諾', '我非常欣賞『漫遊列車之旅』對於永續旅遊的承諾。知道我的旅程能夠為保護地球出一份力，我覺得非常的開心和有意義。', '3', '2023-07-15 19:37:27', '/img/f3.jpg'),
('美食與美景的雙重享受', '參加了『漫遊列車之旅』的美食之旅，我體驗到了美食與美景的完美結合。優美的風景和美味的食物，讓我在這次的旅程中得到了前所未有的快樂。', '2', '2023-07-08 17:08:22', '/img/f4.jpg')
;

-- 插入 comment 內容資料
INSERT INTO `comment` (`article_no`, `mem_no`, `commen_content`) VALUES
(1, 2, '我完全同意你的感受！我上個月也參加了這個旅程，從湖泊到草原的風景真的令人難以忘懷。導遊的專業解說也增添了旅程的樂趣。'),
(1, 3, '看了你的分享，我也很期待自己的蒸汽火車之旅！已經在計劃中了，希望能和你一樣有個美好的體驗。'),
(2, 3, '我非常同意你的看法！我也是第一次體驗蒸汽火車旅行，感覺就像被帶回了過去。那種獨特的懷舊風情讓人難以忘懷。'),
(3, 1, '讚讚'),
(4, 3, '希望能和你一樣有個美好的體驗。'),
(4, 1, '真的讚讚');

-- 插入 report 內容資料
INSERT INTO `report` (`article_no`, `mem_no`, `report_content`) VALUES 
('1', '2', '這片文章的內容十分不當'),
('3', '1', '這片文章的圖片十分不當'),
('3', '2', '這片文章的用詞十分不當'),
('4', '3', '這片文章的圖片十分不當'),
('4', '1', '這片文章的圖片十分不當')
;
