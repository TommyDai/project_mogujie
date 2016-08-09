-- MySQL dump 10.13  Distrib 5.7.9, for Win32 (AMD64)
--
-- Host: localhost    Database: s48_shop
-- ------------------------------------------------------
-- Server version	5.7.9

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `s48_category`
--

DROP TABLE IF EXISTS `s48_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `s48_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `pid` tinyint(3) unsigned NOT NULL,
  `path` varchar(255) NOT NULL,
  `display` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `s48_category`
--

LOCK TABLES `s48_category` WRITE;
/*!40000 ALTER TABLE `s48_category` DISABLE KEYS */;
INSERT INTO `s48_category` VALUES (1,'上衣',0,'0,',1),(2,'裙子',0,'0,',1),(3,'裤子',0,'0,',1),(4,'内衣',0,'0,',1),(5,'鞋子',0,'0,',1),(6,'男友',0,'0,',1),(7,'包包',0,'0,',1),(8,'美妆',0,'0,',1),(9,'配饰',0,'0,',1),(10,'家居',0,'0,',1),(11,'母婴',0,'0,',1),(12,'零食',0,'0,',1),(13,'百货',0,'0,',1),(14,' 夏爆款',1,'0,1,',1),(15,'时尚套装',1,'0,1,',0),(17,'初夏新品',2,'0,2,',0),(18,'连衣裙',2,'0,2,',0),(19,'蕾丝裙',2,'0,2,',1),(20,'夏上新',3,'0,3,',0),(21,'牛仔裤',3,'0,3,',0),(22,'阔腿裤',3,'0,3,',1),(23,'睡衣套装',4,'0,4,',1),(24,'内裤',4,'0,4,',0),(25,'文胸',4,'0,4,',0),(26,'人气新品',5,'0,5,',0),(27,'凉鞋',5,'0,5,',1),(28,'小白鞋',5,'0,5,',1),(29,'牛仔裤',6,'0,6,',1),(30,'帆布鞋',6,'0,6,',0),(31,'T恤',6,'0,6,',0),(32,'春上新',7,'0,7,',1),(33,'双肩',7,'0,7,',0),(34,'斜挎',7,'0,7,',1),(35,'超值套装',8,'0,8,',0),(36,'面膜',8,'0,8,',0),(37,'BB霜',8,'0,8,',1),(38,'墨镜',9,'0,9,',0),(39,'棒球帽',9,'0,9,',0),(40,'项链',9,'0,9,',1),(41,'新品',10,'0,10,',0),(42,'四件套',10,'0,10,',1),(43,'小家具',10,'0,10,',0),(44,'夏季新品',11,'0,11,',0),(45,'童装',11,'0,11,',1),(46,'孕妇装',11,'0,11,',0),(47,'休闲食品',12,'0,12,',0),(48,'进口美食',12,'0,12,',1),(49,'肉食',12,'0,12,',0),(50,'收纳盒',13,'0,13,',0),(51,'玻璃杯',13,'0,13,',0),(52,'美发棒',13,'0,13,',1),(53,'T恤',1,'0,1,',0);
/*!40000 ALTER TABLE `s48_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `s48_discuss`
--

DROP TABLE IF EXISTS `s48_discuss`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `s48_discuss` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `gid` int(10) unsigned NOT NULL DEFAULT '0',
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  `discuss` text,
  `lock` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `s48_discuss`
--

LOCK TABLES `s48_discuss` WRITE;
/*!40000 ALTER TABLE `s48_discuss` DISABLE KEYS */;
INSERT INTO `s48_discuss` VALUES (1,18,12,1465110817,'东西收到了，很喜欢，做工很好!<br/>[回复]:谢谢，我们的产品就是好',0),(2,18,7,1465110972,'这个衣服质量很好，拿来做抹布最合适了，谢谢，差评<br/>[回复]:这个衣服大家买都是当抹布的，难道你是买来穿的？？？？',0),(3,18,17,1465111131,'很好吃，很有营养，里面还有高蛋白的虫虫，还是活的，我最爱吃了。\r\n\r\n\r\n差评不商量了<br/>[回复]:我的产品都是纯天然的，虫子也是，吃了身体好，我们的员工买来都不吃坚果，都是找虫子吃的',0),(4,28,15,1465128895,'鞋子很骚气，是我想要的感觉，不错，完美。',0),(5,28,8,1465129030,'这个裤子太细了，叫我怎么穿！！垃圾，差评！！<br/>[回复]:看看清楚，这是女士的...............',0),(6,18,16,1465129893,'很好的东西，下次还会来',0),(7,18,11,1465129908,'不错<br/>[回复]:你也很不错',0),(8,18,14,1465129924,'完美<br/>[回复]:我们就是喜欢你这样的高素质客户！',0),(9,28,20,1465200800,'这鞋子真好啊，就是穿不上<br/>[回复]:你该减肥了，小妹儿！！',0),(10,28,21,1465200812,'这衣服完美<br/>[回复]:那必须的',0),(11,35,4,1465712864,'衣服不好看<br/>[回复]:衣服好看的',0),(12,35,4,1465713069,'衣服真的不好看',0);
/*!40000 ALTER TABLE `s48_discuss` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `s48_goods`
--

DROP TABLE IF EXISTS `s48_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `s48_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `cid` int(10) unsigned NOT NULL,
  `pay` decimal(10,2) NOT NULL,
  `stock` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `hot` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `new` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `best` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `time` int(10) unsigned NOT NULL,
  `decribe` text,
  `out` int(10) unsigned NOT NULL DEFAULT '0',
  `look` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `s48_goods`
--

LOCK TABLES `s48_goods` WRITE;
/*!40000 ALTER TABLE `s48_goods` DISABLE KEYS */;
INSERT INTO `s48_goods` VALUES (1,'韩都衣舍 夏装新款女装圆领宽松贴布字母图案T恤',14,129.00,285,1,1,1,0,1464757697,'百搭圆领 宽松显瘦 时尚贴布 字母图案 舒适面料\r\n',3,65),(3,'2016夏季新品摩登系带背心+插袋蕾丝长裙套装',15,122.00,164,1,1,0,1,1464757897,'摩登蕾丝无袖背心+插袋蕾丝长裙打套装, 唯美的镂空蕾丝,想不甜美浪漫都难. 简约的款式背心，经腹部的系带打结的设计， 使得款式看上去更丰富有设计感，无袖的设计展露出手臂的曲线， 下装蕾丝裙的搭配质地轻薄柔软，镂空的设计隐隐约约透露着小性感， 富有层次感的蕾丝花纹,能将小肚腩掩盖。整体效果简\r\n',2,116),(4,'夏季纯色露背低胸短袖t恤女装性感简约修身上衣系带打底衫韩国潮',53,45.00,1456,1,1,0,0,1464758197,'2016春夏新款，很赞的宝贝，上身版型显瘦。面料特别好，很柔软细腻，穿起来很舒服。还是原来的厂家，原来的质量，原来的service。(5、10)\r\n',9,61),(5,'【花臂男票】2016夏季新款日系店主风休闲短袖T恤',53,78.00,145,1,0,1,0,1464789749,'~~~忘了哪年哪月的哪一日，我发现了你，或是衣服，或是裤子，深深吸引了我，爱就爱了，难以拒绝，带上我，让我跟你回家吧~~~',0,75),(6,'【空城计】六色入大码防晒衣新款男士韩版纯色青少年夹克',14,56.00,121,1,0,1,1,1464789889,'空城计推荐：夏季纯色休闲百搭防晒衣。薄款时尚，夏季必备款~~~\r\n\r\n掌柜寄语：祝愿每一位菇凉每天都有好心情(づ￣ 3￣)づ\r\n',2,144),(7,'韩国纯色流苏短袖T恤女夏宽松体恤显瘦半袖上衣服韩版学生闺蜜装',53,25.00,154,1,1,0,0,1464790084,'（超值短袖新品仅售25.9元）提前购买好，百搭打底。面料是好质量的 字母图案是优质印花的哦 。免费试穿。 还有7天超长时间无理由包退换，我们是免费送运费险的。让亲们可以无忧无虑的购买。\r\n',1,41),(8,'宝儿家春夏新款瘦腿神器弹力修身显瘦九分小脚牛仔裤',21,56.00,226,1,1,1,0,1464790217,'宝儿家厂家供货自制款春夏新款九分小脚牛仔裤，铅笔裤，弹力裤，宽松显瘦弹力很大，瘦腿效果很好，九分帅气夏季休闲百搭牛仔裤宝儿大爱推荐呢~~不要太瘦哦！！\r\n',5,14),(9,'达令女王 韩范时尚立领蕾丝旗袍拼接欧根纱高腰连衣裙',18,120.00,120,1,0,1,1,1464790589,'2016夏季新品韩范时尚立领蕾丝旗袍拼接欧根纱高腰连衣裙\r\n',3,10),(10,'祺蕾 夏新品女性感薄厚聚拢文胸无痕无钢圈一片式调整型内衣套装',25,78.00,144,1,1,0,0,1464790752,'一穿聚拢，一穿深V，一穿性感！祺蕾文胸让你速成自然好身材\r\n一件解决外扩，小副乳，下垂，各种变形。还原身体本初之美～\r\n上薄下厚，缔造自然深V的曲线\r\n柔软Q弹，自然贴合胸型自然美\r\n摆脱束缚，轻盈透气舒适无压力',1,8),(11,'【送KT猫抱枕】hello Kitty卡通学生宿舍三四件套',41,178.00,151,1,1,1,0,1464790885,'hello kitty系列-2016新款来啦~~哈哈 看中就下单吧！一套重大6-7斤左右，手感特别棒！ 现市面上出现仿品，仿品的质量非常差，亲们不要被其他家不良商家的同款图片误导，我们的质量是他们的不能比的，如果犹豫的亲们 可以同时购买两家的床品 ，回去进行对比！\r\n1.2规格被套150*200 床单160*230 枕套一个（宿舍床尺寸）\r\n1.5规格被套150*200 床单230*230 枕套两个\r\n1.8-2.0规格被套200*230 床单230*230 枕套两个',2,4),(12,'实木沙发凳板凳茶几凳小凳子凳子时尚创意圆凳矮凳换鞋凳布艺墩子',43,135.00,122,1,1,1,0,1464791425,'厂家直销 天然亚麻 高弹海绵 实木框架 精选榉木 原创设计\r\n',1,8),(13,'【卡奇曼】女童无袖吊带碎花连衣裙',44,77.00,144,1,1,1,1,1464791596,'优质面料，时尚款式，穿着舒适\r\n',1,14),(14,'（可哺乳）彩虹背心裙+背带牛仔裙孕妇哺乳喂奶两件套b268',46,56.00,164,1,0,1,0,1464791725,'爱美的姑娘这款商品 没怀孕也可以穿 不管是产前 产后都可以穿的哦 上身效果超级好。\r\n',1,5),(15,'【男友家】亚麻底懒人帆布鞋',30,67.00,153,1,0,0,0,1464792069,'【男友家】日韩潮流时尚男装馆，潮流时尚夏季凉爽透气欧美风百搭款出游必备 支持7天无理由退换货 5星好评截图给客服可以返现哦 ！！！\r\n',1,6),(16,'夏季韩版棒球帽女士遮阳帽子学生学院风新款百搭',39,17.00,122,1,1,0,0,1464792259,'休闲 时尚 潮流 百搭\r\n头围56-62可调节',1,5),(17,'【口口福-坚果零食组合1296g】碧根果夏威夷果腰果大礼包',47,56.00,1232,1,1,0,0,1464792445,'镇店之宝套餐 产地直选 颗颗饱满 香脆诱人 好吃\r\n',2,13),(18,'2016春夏撞色新品翻转扣迷你手提单肩斜挎小包',7,56.00,338,1,1,0,0,1464792609,'精致的五金扣，容量也是蛮大的，百搭款\r\n',3,43),(19,'慢布 雪纺开叉长裙高腰修身显瘦缕空沙滩裙',19,79.00,121,1,1,1,0,1465181113,'omg，太多亮点集于一身了！！\r\n小编我眼睛都亮了，条纹、透视、开衩、配上蕾丝，对！是男人致命的诱惑，哈哈，会不会太过sexy咯~\r\n姐妹们，这款可以作为晚礼服哦，出席小活动、聚会、约会都是不错的款式~~只要你的男友和旁人hold的住才行哦~',3,11),(20,'森女风麻线厚底休闲凉鞋',26,66.00,1242,1,0,1,0,1465181346,'自然的，才是美好的~花更少的钱，过有品质的生活~底厚4.5cm~\r\n\r\n第二双半价~！！第二双半价~！！第二双半价~！！约闺蜜一起买更优惠哦~！本品第二件半价优惠不参与其他任何优惠活动。（解释权归本店所有）\r\n产品参数\r\n随便拍两张评价领好评返现？？NO~!!懂拍的都在这儿~~买家真实晒图锦集。够酷你就来~！！醉in晒图征集开始啦~！！！凡是定期被选中的买家晒图最多可以获得免单哦~！免单哦~！免单哦~！重要的事情说三遍，亲们收到鞋子后可要好好搭配美拍起来哟~让我找到“懂拍的你” 活动详情。。掌柜WX号：15659322522 的朋友圈会定期进行晒图投票，点赞多的晒图即可入围~亲~~收藏店铺和点亮商品五角星，后再下单可送卡通萌萌哒便利贴一份哟',1,8),(21,'夏季新款潮男V领纯色纯棉短袖T恤',53,77.00,122,1,1,0,0,1465181907,'亲，本店做活动啦!多买多优惠哦 ！！！衣衣时尚休闲，简约大方，立体剪裁，精致的做工，保暖舒适。本店支持7天无理由退换货，亲们可以放心选购\r\n',1,7),(22,'adidas 新款板鞋',26,500.00,123,1,1,1,1,1465712692,'好鞋',0,1);
/*!40000 ALTER TABLE `s48_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `s48_image`
--

DROP TABLE IF EXISTS `s48_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `s48_image` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `gid` int(10) unsigned NOT NULL,
  `face` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `s48_image`
--

LOCK TABLES `s48_image` WRITE;
/*!40000 ALTER TABLE `s48_image` DISABLE KEYS */;
INSERT INTO `s48_image` VALUES (1,'./upload/2016/06/01/20160601574e6dc180a6d9902.jpg',1,0),(2,'./upload/2016/06/01/20160601574e6dd80bdb54204.jpg',1,1),(4,'./upload/2016/06/01/20160601574e6e89938879404.jpg',3,1),(5,'./upload/2016/06/01/20160601574e6e9d2f7127957.jpg',3,0),(6,'./upload/2016/06/01/20160601574e6ea4266d81579.jpg',3,0),(7,'./upload/2016/06/01/20160601574e6eac66d941364.jpg',3,0),(8,'./upload/2016/06/01/20160601574e6eb34e4192821.jpg',3,0),(9,'./upload/2016/06/01/20160601574e6ebacd20f2205.jpg',3,0),(10,'./upload/2016/06/01/20160601574e6fb5535d92346.jpg',4,0),(11,'./upload/2016/06/01/20160601574e70283d0851171.jpg',4,1),(12,'./upload/2016/06/01/20160601574e7030cce634351.jpg',4,0),(13,'./upload/2016/06/01/20160601574e703ab19287692.jpg',4,0),(14,'./upload/2016/06/01/20160601574e7041c2ec35334.jpg',4,0),(15,'./upload/2016/06/01/20160601574e704f708f05781.jpg',4,0),(16,'./upload/2016/06/01/20160601574e70543758c8109.jpg',4,0),(17,'./upload/2016/06/01/20160601574e706c19c4d5884.jpg',4,0),(18,'./upload/2016/06/01/20160601574eeaf5065953904.jpg',5,1),(19,'./upload/2016/06/01/20160601574eeb029b3857905.jpg',5,0),(20,'./upload/2016/06/01/20160601574eeb8198f361111.jpg',6,1),(21,'./upload/2016/06/01/20160601574eeb92587184569.jpg',6,0),(22,'./upload/2016/06/01/20160601574eeb990b1dd7419.jpg',6,0),(23,'./upload/2016/06/01/20160601574eec44511ee45.jpg',7,1),(24,'./upload/2016/06/01/20160601574eec577102c9428.jpg',7,0),(25,'./upload/2016/06/01/20160601574eec5e4fad45410.jpg',7,0),(26,'./upload/2016/06/01/20160601574eecc9c6249626.jpg',8,1),(27,'./upload/2016/06/01/20160601574eed431b2241954.jpg',8,0),(28,'./upload/2016/06/01/20160601574eee3decb423075.jpg',9,1),(29,'./upload/2016/06/01/20160601574eee4b0c5925378.jpg',9,0),(30,'./upload/2016/06/01/20160601574eee531f5bc53.jpg',9,0),(31,'./upload/2016/06/01/20160601574eeee0c9c636836.jpg',10,1),(32,'./upload/2016/06/01/20160601574eef65a942f1751.jpg',11,1),(33,'./upload/2016/06/01/20160601574eef77085ee721.jpg',11,0),(34,'./upload/2016/06/01/20160601574ef18184fa8981.jpg',12,1),(35,'./upload/2016/06/01/20160601574ef22cbf20a1884.jpg',13,1),(36,'./upload/2016/06/01/20160601574ef2ad2bd207187.jpg',14,1),(37,'./upload/2016/06/01/20160601574ef2bac8bc6299.jpg',13,0),(38,'./upload/2016/06/01/20160601574ef2d28cbe32502.jpg',14,0),(39,'./upload/2016/06/01/20160601574ef2d8ba8f78581.jpg',14,0),(40,'./upload/2016/06/01/20160601574ef2df45ecf9292.jpg',14,0),(41,'./upload/2016/06/01/20160601574ef405f2d938759.jpg',15,1),(42,'./upload/2016/06/01/20160601574ef416611981726.jpg',15,0),(43,'./upload/2016/06/01/20160601574ef41c3055a3771.jpg',15,0),(44,'./upload/2016/06/01/20160601574ef4c30ff839623.jpg',16,0),(45,'./upload/2016/06/01/20160601574ef4cca049c8475.jpg',16,1),(46,'./upload/2016/06/01/20160601574ef4d29952f488.jpg',16,0),(47,'./upload/2016/06/01/20160601574ef57d495483613.jpg',17,1),(48,'./upload/2016/06/01/20160601574ef586d53354303.jpg',17,0),(49,'./upload/2016/06/01/20160601574ef58c61ca21576.jpg',17,0),(50,'./upload/2016/06/01/20160601574ef621a78366407.jpg',18,1),(51,'./upload/2016/06/01/20160601574ef62dd44637091.jpg',18,0),(52,'./upload/2016/06/01/20160601574ef633ca0a03903.jpg',18,0),(53,'./upload/2016/06/01/20160601574ef63b5d5193297.jpg',18,0),(54,'./upload/2016/06/06/201606065754e3b9cbbb45924.jpg',19,1),(55,'./upload/2016/06/06/201606065754e3c6584bc4812.jpg',19,0),(56,'./upload/2016/06/06/201606065754e3cd3e1755201.jpg',19,0),(57,'./upload/2016/06/06/201606065754e3d5399d81848.jpg',19,0),(58,'./upload/2016/06/06/201606065754e3dba20753006.jpg',19,0),(59,'./upload/2016/06/06/201606065754e3e19c1654422.jpg',19,0),(60,'./upload/2016/06/06/201606065754e4a2954a36210.jpg',20,1),(61,'./upload/2016/06/06/201606065754e4aebadf24363.jpg',20,0),(62,'./upload/2016/06/06/201606065754e4b7a87b7739.jpg',20,0),(63,'./upload/2016/06/06/201606065754e4bd7eb3a17.jpg',20,0),(64,'./upload/2016/06/06/201606065754e4c3d3edd149.jpg',20,0),(65,'./upload/2016/06/06/201606065754e6d3dec7d4328.jpg',21,1),(66,'./upload/2016/06/06/201606065754e6ddb2d074721.jpg',21,0),(67,'./upload/2016/06/06/201606065754e6e40b97e4740.jpg',21,0),(68,'./upload/2016/06/06/201606065754e6ea260648555.jpg',21,0),(69,'./upload/2016/06/06/201606065754e6f2da38a6571.jpg',21,0),(70,'./upload/2016/06/12/20160612575d003445b8e1318.jpg',22,1),(71,'./upload/2016/06/12/20160612575d003f04ee49668.jpg',22,0);
/*!40000 ALTER TABLE `s48_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `s48_order`
--

DROP TABLE IF EXISTS `s48_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `s48_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `num` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `add` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `post` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL,
  `pay` decimal(10,2) NOT NULL,
  `mess` varchar(255) NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `num` (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `s48_order`
--

LOCK TABLES `s48_order` WRITE;
/*!40000 ALTER TABLE `s48_order` DISABLE KEYS */;
INSERT INTO `s48_order` VALUES (1,'20160605151251357182704','戴军','安徽合肥蜀山区','23456787654',4321,18,135.00,'要全新无瑕疵',5),(2,'20160605151435884181467','的哥','上海上海多福多寿','2543234',1243543,18,25.00,'',5),(3,'20160605151716673184095','骚文','上海上海兄弟连','456987',1243543,18,112.00,'',5),(4,'2016060515225497288299','骚文','上海上海上海','1324325',24525,28,67.00,'',5),(5,'20160605201554403289569','骚文','上海上海闸北3楼7连','124357654',876,28,112.00,'',5),(6,'20160605202735952181882','戴军','上海上海闸北3楼','987498274983245',1243543,18,17.00,'',5),(7,'20160605203020433182768','戴军','上海上海闸北3楼7连','234325345',4321,18,354.00,'',4),(8,'20160606154746703183400','的哥','上海合肥 合肥','12432',1243543,18,178.00,'',2),(9,'20160606155214929286463','骚文','上海上海闸北3楼','234',324325,28,143.00,'速度发货',5),(10,'20160606162235616282471','骚文','上海上海闸北发士大夫','456987',12345,28,385.00,'',1),(11,'20160606162502553289818','骚文','安徽合肥分的','1324325',324,28,45.00,'',5),(12,'2016060618512512228318','人','上海合肥闸北人','43',2142,28,79.00,'',3),(13,'2016060712592132728174','将撒旦','浙江省杭州市萧山区创撒旦','4567890',87980,28,122.00,'',3),(14,'20160607132903963317326','SHNA','SSSSD','12345',9,31,168.00,'',1),(15,'20160607133807627316115','SHANXIANSHENG','SHANGHAI SHISHANHGHIA ZHUABIEQU','1234567',301001,31,56.00,'',1),(16,'20160611214403103183519','搭理','上海上海山海','1234',1234,18,45.00,'',1),(17,'20160612130140444181112','张辉','上海上海上海','12345678',1234,18,114.00,'',2),(18,'20160612141707812234557','老王','上海上海里几个','2345676543',123456789,23,123.00,'',2),(19,'2016061214193153523109','老王','上海上海里几个','02345676543',123456789,23,132.00,'',2),(20,'20160612142658875356771','戴军','上海上海3楼','15955149139',2379867,35,45.00,'',4);
/*!40000 ALTER TABLE `s48_order` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = gbk */ ;
/*!50003 SET character_set_results = gbk */ ;
/*!50003 SET collation_connection  = gbk_chinese_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_ALL_TABLES,NO_AUTO_CREATE_USER' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER DEL_ORDER_GOODS
AFTER
DELETE
ON s48_order
FOR EACH ROW
BEGIN
DELETE FROM s48_order_goods WHERE oid=OLD.ID;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `s48_order_goods`
--

DROP TABLE IF EXISTS `s48_order_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `s48_order_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gid` int(10) unsigned NOT NULL,
  `pay` decimal(10,0) NOT NULL,
  `num` int(10) unsigned NOT NULL,
  `oid` int(10) unsigned NOT NULL,
  `dis` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `s48_order_goods`
--

LOCK TABLES `s48_order_goods` WRITE;
/*!40000 ALTER TABLE `s48_order_goods` DISABLE KEYS */;
INSERT INTO `s48_order_goods` VALUES (1,12,135,1,1,1),(2,7,25,1,2,1),(3,18,56,1,3,1),(4,17,56,1,3,1),(5,15,67,1,4,1),(6,8,56,2,5,1),(7,16,17,1,6,1),(8,14,56,1,7,1),(9,11,178,1,7,1),(10,9,120,1,7,0),(11,3,122,1,8,0),(12,17,56,1,8,0),(13,21,77,1,9,1),(14,20,66,1,9,1),(15,21,77,5,10,0),(16,4,45,1,11,1),(17,19,79,1,12,0),(18,3,122,1,13,0),(19,6,56,3,14,0),(20,6,56,1,15,0),(21,4,45,1,16,0),(22,9,120,1,17,0),(23,18,56,1,18,0),(24,19,79,1,18,0),(25,18,56,1,19,0),(26,19,79,1,19,0),(27,4,45,1,20,0);
/*!40000 ALTER TABLE `s48_order_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `s48_user`
--

DROP TABLE IF EXISTS `s48_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `s48_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` char(32) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '0',
  `lock` tinyint(4) NOT NULL DEFAULT '0',
  `points` int(10) unsigned NOT NULL DEFAULT '10',
  `img` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `name_2` (`name`),
  UNIQUE KEY `name_3` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `s48_user`
--

LOCK TABLES `s48_user` WRITE;
/*!40000 ALTER TABLE `s48_user` DISABLE KEYS */;
INSERT INTO `s48_user` VALUES (1,'daijunooo','9c01aa51d1020aa0d94940c43d352506',2,0,23,'./userhead/2016/06/12/20160612575cbd9e025ed3044.png'),(3,'dladsljl','6e2c8d70d0d33f7255cd41f958c171a9',1,0,45,'./userhead/2016/06/12/20160612575cbd9e025ed3044.png'),(4,'fsldkfjdlifjli','5ff13c06c77d4b0e668372b93b4d4728',1,0,65,'./userhead/2016/06/12/20160612575cbd9e025ed3044.png'),(5,'ljljlijlij','0b73b6dae357cc63ea911fd8045e8100',1,0,78,'./userhead/2016/06/12/20160612575cbd9e025ed3044.png'),(7,'ljlijihhjk','9c01aa51d1020aa0d94940c43d352506',0,0,23,'./userhead/2016/06/12/20160612575cbd9e025ed3044.png'),(9,'ljijhhuh','9c01aa51d1020aa0d94940c43d352506',0,0,43,'./userhead/2016/06/12/20160612575cbd9e025ed3044.png'),(12,'j43jljtl45jtl43j','9c01aa51d1020aa0d94940c43d352506',0,0,23,'./userhead/2016/06/12/20160612575cbd9e025ed3044.png'),(15,'daijujoij','9c01aa51d1020aa0d94940c43d352506',0,0,2,'./userhead/2016/06/12/20160612575cbd9e025ed3044.png'),(18,'daijunlll','9c01aa51d1020aa0d94940c43d352506',0,0,1110,'./userhead/2016/06/07/201606075756dfc78b47d1819.jpg'),(19,'daijunjjj','ab3e1669016597ccaf5d36a11d3f4ebe',0,0,23,'./userhead/2016/06/12/20160612575cbd9e025ed3044.png'),(20,'daijunaaa','f44410550294fc7191b971803675c74e',0,0,234,'./userhead/2016/06/12/20160612575cbd9e025ed3044.png'),(21,'ljnghjkhnm','bc3dc83bb56be07e135413820955aad4',0,0,234,'./userhead/2016/06/12/20160612575cbd9e025ed3044.png'),(22,'desen123456','7837e4393e0fc79a576b2308710e8332',0,0,0,'./userhead/2016/06/12/20160612575cbd9e025ed3044.png'),(23,'nihaoooo','6679d8d7b6f751193ebb8d680222b0ce',0,0,20,'./userhead/2016/06/12/20160612575cbd9e025ed3044.png'),(25,'fhenjvhfed','e121257351452686931a3795262ab35f',0,0,0,'./userhead/2016/06/12/20160612575cbd9e025ed3044.png'),(26,'h453ewgfh','9c01aa51d1020aa0d94940c43d352506',0,0,0,'./userhead/2016/06/12/20160612575cbd9e025ed3044.png'),(27,'nihaoiii','a328ff8a65667de76d40429abd96b549',0,0,0,'./userhead/2016/06/12/20160612575cbd9e025ed3044.png'),(28,'saowenooo','fdc8c7124051b3a2b1c932b3ab1c83f3',0,0,56,'./userhead/2016/06/07/201606075756df92d5fbf8598.jpg'),(29,'wusong','25d55ad283aa400af464c76d713c07ad',0,0,34,'./userhead/2016/06/12/20160612575cbd9e025ed3044.png'),(30,'daijunhhh','08c90f4314fba02d4cedd39f36a4d74f',0,0,0,'./userhead/2016/06/12/20160612575cbd9e025ed3044.png'),(31,'shanbaolai','5bc0de97a7a37bcbf26691003c786f40',0,0,0,'./userhead/2016/06/12/20160612575cbd9e025ed3044.png'),(32,'lfijelijfelij','9c01aa51d1020aa0d94940c43d352506',0,0,0,'./userhead/2016/06/12/20160612575cbd9e025ed3044.png'),(33,'loijfeljfewlij','9c01aa51d1020aa0d94940c43d352506',0,0,0,'./userhead/2016/06/12/20160612575cbd9e025ed3044.png'),(34,'wangwang','89823788b6530348e0eac4c15d124271',1,0,345,'0'),(35,'adidas','9c01aa51d1020aa0d94940c43d352506',0,0,14,'./userhead/2016/06/12/20160612575d007204e913074.jpg');
/*!40000 ALTER TABLE `s48_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-12 14:48:13
