CREATE DATABASE  IF NOT EXISTS `proyecto_final` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `proyecto_final`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: proyecto_final
-- ------------------------------------------------------
-- Server version	5.6.10

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
-- Table structure for table `autor`
--

DROP TABLE IF EXISTS `autor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `autor` (
  `id_autor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(245) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_autor`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autor`
--

LOCK TABLES `autor` WRITE;
/*!40000 ALTER TABLE `autor` DISABLE KEYS */;
INSERT INTO `autor` VALUES (1,'Bill Willingham'),(2,'Alan Moore'),(3,'Brian Michael Bendis'),(4,'Geoff Johns'),(5,'Scott Snyder'),(6,'Greg Pak'),(7,'Jason Aaron'),(8,'Mark Millar');
/*!40000 ALTER TABLE `autor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carrito`
--

DROP TABLE IF EXISTS `carrito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carrito` (
  `id_carrito` int(11) NOT NULL AUTO_INCREMENT,
  `comic` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id_carrito`),
  KEY `usuario_idx` (`usuario`),
  KEY `comic_idx` (`comic`),
  CONSTRAINT `comic` FOREIGN KEY (`comic`) REFERENCES `comics` (`id_comic`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `usuario` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrito`
--

LOCK TABLES `carrito` WRITE;
/*!40000 ALTER TABLE `carrito` DISABLE KEYS */;
/*!40000 ALTER TABLE `carrito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comics`
--

DROP TABLE IF EXISTS `comics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comics` (
  `id_comic` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(2550) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `precio` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad_en_almacen` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `editorial` int(11) NOT NULL,
  `autor` int(11) NOT NULL,
  `genero` int(11) NOT NULL,
  PRIMARY KEY (`id_comic`),
  UNIQUE KEY `id_comic_UNIQUE` (`id_comic`),
  KEY `autor_id_idx` (`autor`),
  KEY `editorial_id_idx` (`editorial`),
  KEY `genero_id_idx` (`genero`),
  CONSTRAINT `autor_id` FOREIGN KEY (`autor`) REFERENCES `autor` (`id_autor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `editorial_id` FOREIGN KEY (`editorial`) REFERENCES `editorial` (`id_editorial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `genero_id` FOREIGN KEY (`genero`) REFERENCES `editorial` (`id_editorial`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comics`
--

LOCK TABLES `comics` WRITE;
/*!40000 ALTER TABLE `comics` DISABLE KEYS */;
INSERT INTO `comics` VALUES (1,'Fables Vol. 1: Legends in Exile','La introducciÃ³n a Fabletown. El sheriff Bigby Wolf investiga el aparente asesinato de Rose Red.','https://images-na.ssl-images-amazon.com/images/I/61Z-mjxK%2BzL.jpg','150','2',2,1,2),(2,'Fables Vol. 2: Animal Farm','Se produce una revuelta en la Granja, un lugar para FÃ¡bulas no humanas','https://images-na.ssl-images-amazon.com/images/I/51nxHPNCJWL._SY346_.jpg','150','24',2,1,2),(3,'Fables Vol. 3: Storybook Lover','Bluebeard trama un complot para deshacerse de Bigby y Snow al hechizarlos, y Goldilocks intenta matar a la pareja. Prince Charming decide postularse para alcalde de Fabletown.','https://images-na.ssl-images-amazon.com/images/I/51Rq%2BSvfQwL.jpg','180','10',2,1,2),(4,'WATCHMEN','En un mundo alternativo donde la mera presencia de superhÃ©roes estadounidenses cambiÃ³ la historia, EE. UU. GanÃ³ la guerra de Vietnam, Nixon sigue siendo presidente y la guerra frÃ­a estÃ¡ en plena vigencia. WATCHMEN comienza como un misterio de asesinato, pero pronto se convierte en una conspiraciÃ³n que altera el planeta. A medida que la resoluciÃ³n llega a un punto crÃ­tico, el improbable grupo de hÃ©roes reunidos: Rorschach, Nite Owl, Silk Spectre, el Dr. Manhattan y Ozymandias, tienen que poner a prueba los lÃ­mites de sus convicciones y preguntarse dÃ³nde estÃ¡ la verdadera lÃ­nea entre el bien y el mal.','https://images-na.ssl-images-amazon.com/images/I/61LjaI0m2TL._SX321_BO1,204,203,200_.jpg','550','20',1,2,1),(5,'Fables 4: March of the Wooden Soldiers','Sigue las aventuras de los personajes de cuentos y rimas infantiles que viven lado a lado con los humanos.','https://images.gr-assets.com/books/1327870401l/21325.jpg','200','100',2,1,2),(6,'Civil War II','Aparece un nuevo Inhumano, con la capacidad de perfilar el futuro, y las ramificaciones se extienden en cada rincÃ³n del Universo Marvel. Las lÃ­neas se dibujan, los cuerpos caen y el Universo Marvel se balancearÃ¡ hasta su nÃºcleo.','https://upload.wikimedia.org/wikipedia/en/thumb/3/38/Civil_War_II.jpg/250px-Civil_War_II.jpg','600','42',3,3,3),(7,'Doomsday Clock','En un universo muy lejano y totalmente distinto al de DC, al otro lado del Limite del Todo; estamos en el 22 de noviembre del aÃ±o de 1992, han pasado 7 aÃ±os despuÃ©s de los acontecimientos de Watchmen. Nos encontramos con un melancÃ³lico Ozymandias, ya que su Plan de la Paz fracasÃ³ rotundamente cuando el Diario de Rorscharch fue publicado y ahora es un fugitivo, mientras tanto el gobierno de Estados Unidos esta al borde de una guerra nuclear con la UniÃ³n SoviÃ©tica.','https://upload.wikimedia.org/wikipedia/en/thumb/c/ca/Dooomsday_clock_01variant.jpg/250px-Dooomsday_clock_01variant.jpg','600','80',1,4,3),(8,'Dark Nights: Metal','Â¡Dark Knight ha descubierto uno de los misterios perdidos del universo ... uno que podrÃ­a destruir la estructura misma del Universo DC! Â¡Los rincones oscuros de la realidad que nunca se han visto hasta ahora! The Dark Multiverse se revela en todo su peligro devastador: Â¡un equipo de versiones retorcidas y malvadas de Batman empeÃ±ado en destruir el Universo DC!','https://images-na.ssl-images-amazon.com/images/I/61497r1EdpL.jpg','400','59',1,5,3),(9,'Planet Hulk','Salvaje planeta alienÃ­gena. Tribus bÃ¡rbaras oprimidas. Emperador corrupto Mujer guerrera mortal. Gladiadores y esclavos. Hachas de batalla y blÃ¡steres manuales. Â¡Monstruos y hÃ©roes ... y el IncreÃ­ble Hulk!','https://images-na.ssl-images-amazon.com/images/I/51vwyoQisaL._SY346_.jpg','200','70',3,6,3),(11,'Punisher MAX','Â¡Experimenta el castigador e inflexible Punisher MAX desde el principio! Cuando un ataque de la mafia matÃ³ a su amada esposa e hijos, Frank Castle se convirtiÃ³ en el Punisher, un ejÃ©rcito de un solo hombre imparable haciendo la guerra a cada pedazo de escoria criminal que plaga las calles de Nueva York. Pero, Â¿los orÃ­genes del Punisher se remontan aÃºn mÃ¡s? En 1971 Vietnam, el pelotÃ³n del CapitÃ¡n Castle se enfrenta a un ataque del Viet Cong ... y para sobrevivir, debe tomar una decisiÃ³n sombrÃ­a. Entonces, el viejo socio de Punisher, Microchip, durante mucho tiempo considerado como una vÃ­ctima de la guerra de Castle, resurge con una oferta sorprendente.\r\n','https://images-na.ssl-images-amazon.com/images/I/51hU-jHS1zL._SX323_BO1,204,203,200_.jpg','180','80',3,7,1),(12,'Civil War','El paisaje del Universo Marvel estÃ¡ cambiando, y es hora de elegir: Â¿De quÃ© lado estÃ¡s? Un conflicto se viene gestando desde hace mÃ¡s de un aÃ±o, amenazando con enfrentar a un amigo contra un amigo, a un hermano contra otro, Â¡y todo lo que se necesita es un solo paso en falso para costarles miles de vidas y encender el fusible! A medida que la guerra reclama sus primeras vÃ­ctimas, nadie estÃ¡ a salvo ya que los equipos, las amistades y las familias comienzan a desmoronarse. Â¡El crossover que reescribe las reglas, las estrellas de la Guerra Civil Spider-Man, los New Avengers, los Fantastic Four, los X-Men y la totalidad del panteÃ³n de Marvel! Colecta Civil War # 1-7, mÃ¡s extras.','https://images-na.ssl-images-amazon.com/images/I/51ATs-DRbeL._SX327_BO1,204,203,200_.jpg','400','70',3,8,3),(13,'Wolverine: Old Man Logan ','Nadie sabe lo que sucediÃ³ la noche en que cayeron los hÃ©roes. Todo lo que sabemos es que desaparecieron y el mal triunfÃ³ y los malos han estado llamando a los tiros desde entonces. Lo que le sucediÃ³ a Wolverine es el mayor misterio de todos. Durante 50 aÃ±os, nadie ha escuchado ocultar ni pelo de Ã©l ... y en su lugar se encuentra un viejo hombre llamado Logan. Un hombre preocupado solo por su familia. Un hombre empujado al borde por HULK GANG. Un hombre obligado a ayudar a un viejo amigo, el arquero ciego, HAWKEYE, conduce tres mil millas para asegurar la seguridad de su familia. PrepÃ¡rate para el viaje de tu vida, Logan.','https://images-na.ssl-images-amazon.com/images/I/51LoG5uYr7L._SX323_BO1,204,203,200_.jpg','450','70',3,8,3),(14,'Superman','Esta colecciÃ³n reÃºne cuentos intemporales del Hombre de Acero, desde el adiÃ³s de Superman hasta la Tierra, hasta el relato personal de Lois Lane de una vida cambiada para siempre por Big Blue Boy Scout.\r\n\r\nExplore el corazÃ³n de Superman y la raÃ­z de la obsesiÃ³n de Lex Luthor con Ã©l, en las historias de Millar en Eisner, nominado para Superman Adventures.\r\n\r\nVuelva a imaginar al Hombre del MaÃ±ana, en un mundo donde el Detective Harvey Dent sufre una metamorfosis del hombre a Superman.','https://images-na.ssl-images-amazon.com/images/I/5104LiscnOL._SX311_BO1,204,203,200_.jpg','500','70',1,8,3),(15,'V for Vendetta ','Una poderosa historia sobre la pÃ©rdida de la libertad y la individualidad, V FOR VENDETTA tiene lugar en una Inglaterra totalitaria despuÃ©s de una guerra devastadora que cambiÃ³ la faz del planeta.\r\n\r\nEn un mundo sin libertad polÃ­tica, libertad personal y poca fe en nada, viene un hombre misterioso con una mÃ¡scara de porcelana blanca que lucha contra los opresores polÃ­ticos a travÃ©s del terrorismo y actos aparentemente absurdos. Es una historia apasionante de las lÃ­neas borrosas entre el bien y el mal ideolÃ³gico','https://images-na.ssl-images-amazon.com/images/I/51oGEuD2CHL._SX333_BO1,204,203,200_.jpg','300','40',2,2,1),(16,'Batman Killing Joke','De acuerdo con el motor de la locura y el caos que se conoce como The Joker, eso es lo Ãºnico que separa lo cuerdo de lo psicÃ³tico. Liberado una vez mÃ¡s de los confines de Arkham Asylum, estÃ¡ dispuesto a demostrar su punto desquiciado. Y va a utilizar al policÃ­a de Ciudad GÃ³tica, el comisionado Jim Gordon, y su brillante y hermosa hija BÃ¡rbara para hacerlo.\r\n\r\nAhora Batman debe competir para detener su archienemiga antes de que su reinado de terror reclame a dos de los amigos mÃ¡s cercanos del Caballero Oscuro. Â¿Puede finalmente poner fin al ciclo de sed de sangre y locura que une a estos dos enemigos icÃ³nicos antes de que lleve a su conclusiÃ³n fatal? Y como finalmente se revela el horrible origen del PrÃ­ncipe del Crimen Payaso, Â¿se romperÃ¡ de una vez y para siempre la delgada lÃ­nea que separa la nobleza de Batman y la locura del Joker?','https://images-na.ssl-images-amazon.com/images/I/51cHA75nA3L._SX319_BO1,204,203,200_.jpg','400','70',1,2,1),(17,'Justice League: The Darkseid War Saga Omnibus','La Liga de la Justicia se uniÃ³ hace aÃ±os para evitar que Darkseid y su ejÃ©rcito parademon invadieran nuestra Tierra. Ahora, el SeÃ±or de Apokolips volverÃ¡ a convertir al planeta en una zona de guerra, a medida que la Tierra se convierta en la primera lÃ­nea en la batalla de Darkseid con el Anti-Monitor, una criatura devoradora de universo que puede reducir a escombros a planetas enteros.\r\nÂ \r\nPara evitar que su planeta se convierta en daÃ±o colateral en una guerra de dioses, la Liga de la Justicia debe profundizar en los secretos de los Nuevos Dioses y aprender la verdad oculta de la identidad del Anti-Monitor y su historia con Darkseid.','https://images-na.ssl-images-amazon.com/images/I/61LNBr2knPL._SX342_BO1,204,203,200_.jpg','800','80',1,4,3),(18,'Dc Universe Rebirth','Wally West estÃ¡ atrapado en el tiempo y el espacio, perdido en los recovecos del sangrado dimensional debido al punto de inflamaciÃ³n causado por su mentor, Barry Allen. A la deriva en esta nada, solo Wally, el hombre una vez conocido como Kid Flash y luego el Flash, puede ver el misterio que impregna el universo. Â¿QuiÃ©n ha robado 10 aÃ±os?\r\n\r\nWally ahora debe regresar a la Tierra y a los seres queridos que siempre han actuado como su pararrayos, pero no importa con quiÃ©n contacte, se desliza cada vez mÃ¡s lejos, mÃ¡s cerca de la nada.\r\n\r\nEl destino del universo depende de la RENACIMIENTO de Wally West ...','https://images-na.ssl-images-amazon.com/images/I/51DRxzrRL9L._SX328_BO1,204,203,200_.jpg','300','30',1,4,3),(19,'Flashpoint','No es un sueÃ±o, no es una historia imaginaria, no es otro mundo. Esto es un Hecho Flash: cuando Barry Allen se despierta en su escritorio, descubre que el mundo ha cambiado. La familia estÃ¡ viva, los seres queridos son extraÃ±os, y los amigos cercanos son diferentes, se han ido o son peores. Es un mundo al borde de una guerra cataclÃ­smica, pero Â¿dÃ³nde estÃ¡n los Grandes HÃ©roes de la Tierra para detenerlo? Es un lugar donde la Ãºltima esperanza de Estados Unidos es Cyborg, que espera reunir las fuerzas de The Outsider, The Secret 7, S! H! A! Z! A! M !, Â¡Citizen Cold y otras caras nuevas y familiares! Es un mundo que se estarÃ­a quedando sin tiempo, Â¡si The Flash no puede encontrar al villano que modificÃ³ la lÃ­nea de tiempo!','https://images-na.ssl-images-amazon.com/images/I/61CQ6NauJ0L._SX323_BO1,204,203,200_.jpg','200','20',1,4,3),(20,'The Man of Steel','Una nueva era comienza para Superman como una amenaza de sus orÃ­genes mÃ¡s tempranos que resurge para destruir al Ãšltimo Hijo de Krypton. Mientras Superman lucha para entender lo que le sucediÃ³ a su esposa e hijo, tambiÃ©n debe enfrentar una nueva amenaza que estÃ¡ decidida a quemar MetrÃ³polis.','https://images-na.ssl-images-amazon.com/images/I/512feq6pmKL._SX319_BO1,204,203,200_.jpg','500','10',1,3,1),(21,'The Road To Civil War','ExtraÃ­do de las pÃ¡ginas de New Avengers, el equipo ganador de premios Eisner de Brian Bendis y Alex Maleev presenta una historia explosiva y oculta del pasado secreto de Marvel, la historia secreta del equipo mÃ¡s secreto de Marvel: cÃ³mo se juntaron y cÃ³mo se desgarraron. AdemÃ¡s: Spidey tiene un nuevo contrato de vida, nuevos poderes y un nuevo disfraz, cortesÃ­a de su nuevo mejor amigo, Tony Stark. Entonces, Â¿quÃ© podrÃ­a salir mal? Con las nubes creciendo rÃ¡pidamente en el horizonte, los lazos que ahora Spider-Man forja pueden muy bien determinar su capacidad para resistir una tormenta inminente. Â¡El Universo Marvel estÃ¡ a punto de dividirse en el medio, y la lÃ­nea se dibuja aquÃ­! Se le preguntarÃ¡: Â¿de quÃ© lado estÃ¡ usted? Colecciona Nuevos Vengadores: Illuminati & Amazing Spider-Man # 529-531.','https://images-na.ssl-images-amazon.com/images/I/51wUyluTdJL._SX319_BO1,204,203,200_.jpg','200','40',3,3,3),(22,'Batman 1: The Court Of Owls','DespuÃ©s de una serie de asesinatos brutales en Gotham City, Batman comienza a darse cuenta de que tal vez estos crÃ­menes son mucho mÃ¡s profundos de lo que sugieren las apariencias. A medida que el Cruzado Caped comienza a desentraÃ±ar este misterio mortal, descubre una conspiraciÃ³n que se remonta a su juventud y mÃ¡s allÃ¡ de los orÃ­genes de la ciudad que ha jurado proteger. Â¿PodrÃ­a el Tribunal de los BÃºhos, que una vez se pensÃ³ que no era mÃ¡s que una leyenda urbana, estar detrÃ¡s del crimen y la corrupciÃ³n? Â¿O Bruce Wayne estÃ¡ perdiendo la cordura y siendo presa de las presiones de su guerra contra el crimen?','https://images-na.ssl-images-amazon.com/images/I/519WI43vu3L._SX333_BO1,204,203,200_.jpg','250','70',1,5,3),(23,'All-Star Batman 1: My Own Worst Enemy','Batman se encuentra tratando de ayudar al viejo amigo Harvey Dent ... Â¡ahora conocido como el villano Two-Face! The Dark Knight acompaÃ±a a su enemigo en un viaje a campo traviesa para arreglar su cara con cicatrices y con suerte terminar con la identidad de las dos caras para siempre. Pero cuando el antiguo Gotham City D.A. pone en marcha un plan para liberarse, el camino se llena de baches y cada asesino, cazarrecompensas y ciudadano comÃºn con algo que esconder sale a la luz con un objetivo: Â¡matar a Batman! Esposados juntos en el camino a Bat-hell, Â¡este es Batman y Two-Face como nunca antes los has visto!','https://images-na.ssl-images-amazon.com/images/I/51tXAzDse6L._SX322_BO1,204,203,200_.jpg','300','60',1,5,3),(24,'Batman 1: I Am Gotham','Hay dos nuevos hÃ©roes en la ciudad: un par de metahumanos enmascarados con los poderes de Superman y una devociÃ³n por preservar todo lo bueno de esta ciudad retorcida. LlamÃ¡ndose a sÃ­ mismos Gotham y Gotham Girl, salvaron la vida de Batman, lucharon a su lado y aprendieron de su ejemplo.\r\nÂ \r\nPero, Â¿quÃ© sucede si los nuevos guardianes de Gotham van mal? Â¿Y si culpan al Caballero Oscuro por la oscuridad que amenaza con ahogar a su ciudad?','https://images-na.ssl-images-amazon.com/images/I/51y4QXVhGFL._SX319_BO1,204,203,200_.jpg','200','70',1,5,3),(25,'World War Hulk Omnibus','Hulk versus el mundo, en una historia Ã©pica de ira desatada! Exiliado por sus supuestos amigos, Hulk se enfureciÃ³, sangrÃ³ y conquistÃ³ en el planeta alienÃ­gena Sakaar. Ahora, Ã©l regresa a la Tierra para vengarse terriblemente de Iron Man, Mr. Fantastic, Doctor Strange y Black Bolt, Â¡y cualquier otra persona que se cruce en el camino! MÃ¡s loco que nunca, mÃ¡s fuerte que nunca, y acompaÃ±ado de sus monstruosos aliados de la Guerra de la Guerra, Â¡esta vez Hulk puede simplemente derribar a este estÃºpido planeta por la mitad!','https://images-na.ssl-images-amazon.com/images/I/51z0IXVttdL._SX337_BO1,204,203,200_.jpg','700','60',3,6,3),(26,'The Mighty Thor 1: Thunder in Her Veins','Cuando la Dra. Jane Foster levanta el martillo mÃ­stico Mjolnir, se transforma en la Diosa del Trueno, Â¡el Poderoso Thor! Sus enemigos son muchos, ya que Asgard desciende aÃºn mÃ¡s hacia el caos y los disturbios amenazan con extenderse a lo largo de los Diez Reinos. Sin embargo, su mayor batalla es contra un enemigo mucho mÃ¡s personal: el cÃ¡ncer que estÃ¡ matando a su forma mortal. Cuando Loki retroceda a la vida de Thor, Â¿le facilitarÃ¡ sus problemas o solo aumentarÃ¡ su dolor? Â¡Es hora de descubrir si el prÃ³ximo capÃ­tulo de la retorcida historia del Tramposo serÃ¡ uno del bien o el mal! Sin embargo, no hay tal pregunta sobre Malekith, Â¡ya que Ã©l y su Consejo Oscuro continÃºan avivando las llamas de una inminente Guerra de Reinos! Jason Aaron continÃºa su sorprendente saga del poderoso Thor. COLECCIONANDO: THOR PODEROSO 1-5','https://images-na.ssl-images-amazon.com/images/I/51yPqSw1k0L._SX330_BO1,204,203,200_.jpg','300','70',3,7,3),(27,'Wolverine Goes to Hell Omnibus','Â¡Una organizaciÃ³n misteriosa conspira para poseer el cuerpo de Wolverine con demonios, y enviar su alma al inframundo! Esperar a Logan son las almas de familiares y amigos inesperados, Â¡y el mismÃ­simo diablo! Naturalmente, Wolverine planea abrirse camino de nuevo y vengarse ... Â¡pero eso podrÃ­a ser exactamente lo que quiere el grupo sombrÃ­o! Â¿El giro final en su plan harÃ¡ aÃ±icos a Wolverine por completo? AdemÃ¡s: Wolverine y Spider-Man deben sobrevivir a un viaje en el tiempo sin matar el uno al otro, Wolverine enfrenta a Cyclops en un cisma sobre el futuro de los X-Men, Â¡y Logan regresa a JapÃ³n para evitar una toma del poder del inframundo por su enemigo mÃ¡s viejo!','https://images-na.ssl-images-amazon.com/images/I/517t9Fr%2BMoL._SX332_BO1,204,203,200_.jpg','500','70',3,7,3),(28,'Blackest Night ','\r\n463/5000\r\nA lo largo de las dÃ©cadas, la muerte ha plagado el Universo DC y ha tomado la vida de hÃ©roes y villanos por igual. Pero, Â¿para quÃ©? Mientras la Guerra entre los Cuerpos de Linterna de diferentes colores continÃºa, desciende la profecÃ­a de la Noche mÃ¡s negra y depende de Hal Jordan y del Green Lantern Corps liderar a los mejores campeones de DC en una batalla para salvar el Universo de un ejÃ©rcito de Black Lanterns muertos vivientes. hasta de los Lanterns Verdes caÃ­dos y los hÃ©roes y villanos fallecidos de DC.','https://images-na.ssl-images-amazon.com/images/I/61KIFuypqkL._SX336_BO1,204,203,200_.jpg','200','60',1,4,3),(29,'The Flash: Rebirth','The epic story of Barry Allenâ€™s return from the dead to reclaim his title as The Fastest Man Alive is collected in hardcover.','https://images-na.ssl-images-amazon.com/images/I/61go5bvgxxL._SX332_BO1,204,203,200_.jpg','200','10',1,4,3),(30,'Batman Earth One','En una ciudad de Gotham donde el amigo y el enemigo son indistinguibles, el camino de Bruce Wayne para convertirse en el Caballero Oscuro estÃ¡ plagado de mÃ¡s obstÃ¡culos que nunca. Centrado en castigar a los verdaderos asesinos de sus padres, y en la policÃ­a corrupta que les permitiÃ³ salir libres, la sed de venganza de Bruce Wayne alimenta su loca cruzada y nadie, ni siquiera Alfred, puede detenerlo','https://images-na.ssl-images-amazon.com/images/I/512sOeBDyOL._SX321_BO1,204,203,200_.jpg','400','20',1,4,3),(31,'Dark Days: The Road to Metal','Durante aÃ±os, Batman ha estado siguiendo un misterio. Silenciosamente ha estado tirando de un hilo, realizando investigaciones en laboratorios secretos de todo el mundo y guardando pruebas en las profundidades de la Baticueva, ocultos incluso de sus aliados mÃ¡s cercanos. Ahora, en una historia Ã©pica que abarca generaciones, los hÃ©roes y villanos del Universo DC, incluidos Green Lantern, The Joker, Wonder Woman y mÃ¡s, estÃ¡n a punto de descubrir lo que descubrieron, y podrÃ­a amenazar la existencia misma del Multiverso. !','https://images-na.ssl-images-amazon.com/images/I/61Cl4QeFbBL._SX332_BO1,204,203,200_.jpg','300','30',1,5,1);
/*!40000 ALTER TABLE `comics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `editorial`
--

DROP TABLE IF EXISTS `editorial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `editorial` (
  `id_editorial` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_editorial` varchar(255) NOT NULL,
  PRIMARY KEY (`id_editorial`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `editorial`
--

LOCK TABLES `editorial` WRITE;
/*!40000 ALTER TABLE `editorial` DISABLE KEYS */;
INSERT INTO `editorial` VALUES (1,'DC Comics'),(2,'Vertigo Comics'),(3,'Marvel');
/*!40000 ALTER TABLE `editorial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genero`
--

DROP TABLE IF EXISTS `genero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genero` (
  `id_genero` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_genero` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_genero`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genero`
--

LOCK TABLES `genero` WRITE;
/*!40000 ALTER TABLE `genero` DISABLE KEYS */;
INSERT INTO `genero` VALUES (1,'Misterio'),(2,'Fantasia'),(3,'SuperhÃ©roe ');
/*!40000 ALTER TABLE `genero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_compras`
--

DROP TABLE IF EXISTS `historial_compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historial_compras` (
  `id_historial_compras` int(11) NOT NULL AUTO_INCREMENT,
  `id_comic` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id_historial_compras`),
  UNIQUE KEY `id_historial_compras_UNIQUE` (`id_historial_compras`),
  KEY `id_usuario_idx` (`id_usuario`),
  KEY `id_comic_idx` (`id_comic`),
  CONSTRAINT `id_comic` FOREIGN KEY (`id_comic`) REFERENCES `comics` (`id_comic`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_compras`
--

LOCK TABLES `historial_compras` WRITE;
/*!40000 ALTER TABLE `historial_compras` DISABLE KEYS */;
INSERT INTO `historial_compras` VALUES (1,1,1,1),(2,2,1,2),(3,3,2,1),(4,1,2,3),(5,5,3,1),(6,6,2,4),(7,4,2,1),(8,1,2,1),(9,4,1,10),(10,1,1,1),(11,8,1,1),(12,1,1,1),(13,6,1,8);
/*!40000 ALTER TABLE `historial_compras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(45) NOT NULL,
  `correo` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `contra` varchar(45) NOT NULL,
  `fecha_de_nacimiento` varchar(255) NOT NULL,
  `tarjeta` varchar(45) NOT NULL,
  `direccion_postal` varchar(45) NOT NULL,
  `esAdmin` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `id_usuarios_UNIQUE` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Cesar Palazuelos Higuera','cesar_96_ph@hotmail.com','prueba','1996-12-08','5556515151551','Arquitectura 7Bis',0),(2,'Carlos','carlosh@gmail.com','carlosh','1995-12-31','5555555555555555','interlomas',0),(3,'Carlos','carlosh5@gmail.com','prueba','1995-12-31','5555555555555555','interlomas',0),(4,'Carlos','carlosh65@gmail.com','prueba','1995-12-31','5555555555555555','interlomas',0),(5,'admin','admin','admin','1996-12-08','','',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-21 12:01:11
