-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 11, 2018 at 02:47 AM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.2.0RC3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `homestead`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `country` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `country`, `city`, `street`, `number`) VALUES
(1, 1, 'it', 'Milano', 'Via Roma', '4'),
(2, 2, 'it', 'Napoli', 'Via Bromeis', '1'),
(3, 3, 'it', 'Venezia', 'Via delle pecore', '42'),
(4, 4, 'it', 'Padova', 'Via delle pezze', '5'),
(5, 5, 'it', 'Vicenza', 'Via Padova', '17'),
(6, 6, 'it', 'Treviso', 'Via Vicenza', '13'),
(7, 7, 'it', 'Milano', 'Via della fenice', '6'),
(8, 8, 'it', 'Milano', 'Via Santo Polo', '4'),
(9, 9, 'it', 'Treviso', 'Via delle pecore', '24'),
(10, 10, 'it', 'Pordenone', 'Via dei perdenti', '100'),
(11, 11, 'it', 'Genova', 'Porto Antico', '17');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`) VALUES
(1, 'Divani', NULL),
(2, 'Sedie', NULL),
(3, 'Tavoli', NULL),
(4, 'Arredo', NULL),
(5, 'Divani', 1),
(6, 'Divaniletto', 1),
(7, 'Poltrone', 2),
(8, 'Sedie', 2),
(9, 'Pouf', 2),
(10, 'Tavolini', 3),
(11, 'Cassapanche', 3),
(12, 'Tavoli da pranzo', 3),
(13, 'Scrivanie', 3),
(14, 'Armadi', 4),
(15, 'Scaffali', 4),
(16, 'Libreria', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `payment_status` enum('pending','done','failed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `payment_status`, `date`) VALUES
(1, 2, 'pending', '2018-01-13 18:57:00'),
(2, 2, 'done', '2018-01-14 17:14:00'),
(3, 2, 'done', '2018-01-15 11:01:00'),
(4, 3, 'done', '2018-01-15 12:11:00'),
(5, 3, 'done', '2018-01-20 22:26:00'),
(6, 3, 'done', '2018-01-21 08:19:00'),
(7, 4, 'done', '2018-01-23 09:47:00'),
(8, 4, 'done', '2018-01-23 14:32:00'),
(9, 4, 'done', '2018-01-23 19:02:00'),
(10, 5, 'done', '2018-01-25 20:58:00'),
(11, 5, 'failed', '2018-01-26 15:34:00'),
(12, 5, 'done', '2018-01-26 22:35:00'),
(13, 6, 'done', '2018-01-29 07:49:00'),
(14, 6, 'done', '2018-01-30 02:17:00'),
(15, 6, 'done', '2018-01-30 16:24:00'),
(16, 7, 'done', '2018-01-31 14:15:00'),
(17, 7, 'done', '2018-02-01 13:15:00'),
(18, 7, 'done', '2018-02-01 13:29:00'),
(19, 8, 'done', '2018-02-01 19:10:00'),
(20, 8, 'done', '2018-02-03 17:15:00'),
(21, 8, 'done', '2018-02-03 22:44:00'),
(22, 9, 'failed', '2018-02-05 20:53:00'),
(23, 9, 'done', '2018-02-06 14:42:00'),
(24, 9, 'done', '2018-02-08 09:15:00'),
(25, 10, 'done', '2018-02-08 11:13:00'),
(26, 10, 'done', '2018-02-09 17:17:00'),
(27, 10, 'done', '2018-02-10 09:24:00'),
(28, 11, 'done', '2018-02-10 10:23:00'),
(29, 11, 'done', '2018-02-10 16:54:00'),
(30, 11, 'done', '2018-02-10 23:31:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `product_id`, `order_id`, `quantity`) VALUES
(1, 39, 1, 2),
(2, 47, 1, 2),
(3, 39, 1, 1),
(4, 18, 2, 1),
(5, 10, 2, 1),
(6, 29, 3, 1),
(7, 4, 3, 3),
(8, 48, 4, 3),
(9, 6, 5, 2),
(10, 28, 6, 1),
(11, 27, 6, 2),
(12, 23, 7, 3),
(13, 11, 7, 2),
(14, 37, 7, 3),
(15, 46, 8, 2),
(16, 9, 8, 2),
(17, 33, 8, 2),
(18, 39, 8, 1),
(19, 27, 9, 1),
(20, 41, 9, 1),
(21, 28, 10, 3),
(22, 21, 10, 3),
(23, 40, 10, 3),
(24, 8, 10, 1),
(25, 13, 11, 3),
(26, 40, 11, 3),
(27, 30, 12, 1),
(28, 45, 12, 1),
(29, 42, 12, 2),
(30, 6, 12, 1),
(31, 38, 13, 3),
(32, 42, 14, 1),
(33, 39, 14, 2),
(34, 36, 14, 2),
(35, 2, 14, 1),
(36, 45, 15, 2),
(37, 43, 15, 3),
(38, 35, 16, 3),
(39, 41, 16, 1),
(40, 14, 16, 2),
(41, 8, 17, 1),
(42, 33, 17, 2),
(43, 2, 17, 1),
(44, 25, 18, 2),
(45, 3, 18, 2),
(46, 42, 19, 1),
(47, 1, 19, 2),
(48, 5, 19, 1),
(49, 42, 19, 3),
(50, 42, 20, 2),
(51, 45, 20, 1),
(52, 23, 20, 3),
(53, 21, 21, 3),
(54, 36, 21, 1),
(55, 33, 21, 3),
(56, 36, 21, 1),
(57, 28, 21, 3),
(58, 29, 22, 3),
(59, 3, 22, 2),
(60, 1, 23, 3),
(61, 12, 23, 2),
(62, 37, 23, 3),
(63, 15, 24, 3),
(64, 17, 24, 3),
(65, 29, 24, 1),
(66, 32, 25, 3),
(67, 35, 25, 4),
(68, 8, 26, 1),
(69, 43, 26, 2),
(70, 24, 26, 3),
(71, 10, 26, 3),
(72, 4, 27, 1),
(73, 19, 27, 2),
(74, 29, 27, 3),
(75, 47, 28, 3),
(76, 40, 28, 1),
(77, 42, 28, 3),
(78, 3, 28, 2),
(79, 43, 29, 3),
(80, 16, 29, 3),
(81, 45, 29, 3),
(82, 16, 30, 3),
(83, 46, 30, 1),
(84, 40, 30, 3),
(85, 16, 30, 5);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `price` int(10) UNSIGNED NOT NULL,
  `homepage` tinyint(1) NOT NULL DEFAULT '0',
  `image` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `description`, `price`, `homepage`, `image`) VALUES
(1, 'Divano scandinavo 3 posti grigio chiaro', 5, 'Aggiungi al tuo ambiente una nota luminosa grazie al divano grigio chiaro BROOKE dall''aspetto mélange. Il suo colore rilassante regalerà un tocco di dolcezza al salotto. Moderno e valorizzato da una piattaforma in faggio massello, questo divano in tessuto richiama uno stile vintage e scandinavo. La sua tonalità neutra e tenue si armonizzerà, stagione dopo stagione, con tutti gli stili di arredo. Le sue forme semplici ma accoglienti sono l''ideale per un pomeriggio cocooning! La sua struttura solida in faggio massello ti offrirà una seduta comoda e confortevole. Vivacizza il tuo divano con dei morbidi cuscini.', 49900, 0, 'divano1.jpg'),
(2, 'Divano trasformabile in pelle anticata marrone 3 posti', 5, 'Il divano Berlin marrone trasformabile coniuga il confort di un vero e proprio letto con un reale senso estetico.', 165000, 0, 'divano2.jpg'),
(3, 'Divano trasformabile imbottito marrone 3 posti', 5, 'Il divano trasformabile Studio è frutto di un mix ben riuscito tra un mobilio antico e contemporaneo.', 19900, 0, 'divano3.jpg'),
(4, 'Divano trasformabile 3 posti grigio antracite in cotone', 5, 'Elegante, raffinato e ingegnoso, il divano trasformabile 3 posti grigio antracite in cotone LISE si integrerà ', 33000, 0, 'divano4.jpg'),
(5, 'Divano ad angolo trasformabile marrone in microfibra 3/4 posti', 6, 'Crea un salotto caldo con questo divano ad angolo trasformabile marrone in microfibra 3/4 posti MONTRÉAL. Pratico in caso d''invitati imprevisti, questo divano angolare ti offre anche un posto letto supplementare.', 65000, 0, 'divaniletto1.jpg'),
(6, 'Divano panoramico trasformabile 7 posti grigio chiaro', 6, 'Sei abituato a ricevere amici e famiglia al completo? Crea un salotto conviviale scegliendo il divano trasformabile panoramico 7 posti grigio chiaro in microfibra TIMES SQUARE!', 99900, 0, 'divaniletto2.jpg'),
(7, 'Divano-letto 3 posti in tessuto grigio chiaro', 6, 'Con le sue linee contemporanee e il colore grigio chiaro, questo divano-letto a 3 posti creerà un''atmosfera dolce e conviviale.', 69900, 0, 'divaniletto3.jpg'),
(8, 'Divano trasformabile 3 posti grigio antracite in cotone', 6, 'Elegante, raffinato e ingegnoso, il divano trasformabile 3 posti grigio antracite in cotone LISE si integrerà facilmente negli interni dallo stile classico chic!', 33000, 1, 'divaniletto4.jpg'),
(9, 'Poltrona marrone in microfibra', 7, 'Vi piace lo stile poltrona club in pelle, ma cercate il calore di un materiale moderno? La poltrona marrone Baltimore in microfibra soddisferà tutte le vostre esigenze. Rimarrete affascinati dall''esclusività e dalla facilità di pulizia di questa poltrona da salotto classica.', 17000, 0, 'poltrona1.jpg'),
(10, 'Poltrona Club marrone in cuoio', 7, 'Vorreste un''autentica poltrona vintage per impreziosire i vostri interni? La poltrona da salotto Oxford ricorda l''eleganza e la raffinatezza degli ambienti inglesi... Davvero chic!', 59900, 0, 'poltrona2.jpg'),
(11, 'Poltrona Club marrone in microfibra', 7, 'Confortevole ed elegante, la poltrona Club marrone in microfibra ARIZONA vi stupirà per la morbidezza del rivestimento in microfibra. Questa poltrona da salotto dalla forma ergonomica vi garantirà il relax che cercate.', 29900, 0, 'poltrona3.jpg'),
(12, 'Poltrona imbottita Chesterfield marrone in cuoio', 7, 'L''atmosfera di James Bond aleggia attorno all''elegante poltrona in pelle marrone Vintage. Ricca di fascino, questa poltrona in pelle invecchiata regalerà al vostro salotto un''atmosfera da club inglese.', 69900, 0, 'poltrona4.jpg'),
(13, 'Sedia scandinava grigio chiné', 8, 'Perfetta per un arredamento in stile contemporaneo, la sedia in tessuto grigio melange ICE si inserirà perfettamente nel tuo salotto. Questa bella sedia scandinava ha gambe oblique in legno chiaro che aggiungono alla sua forma un tocco di design vintage. La sua ampia seduta in mousse e il suo schienale alto ti permetteranno di sederti comodamente. Posiziona questa sedia vicino a un tavolo rotondo, e, per una maggiore originalità, pensa a variare i colori.', 6999, 0, 'sedia1.jpg'),
(14, 'Sedia vintage in velluto blu pavone e betulla', 8, 'Con i suoi materiali nobili e il suo colore blu pavone, la sedia vintage in velluto blu pavone MAURICETTE mescola l''eleganza di una volta al design di oggi. Rimodernato, il velluto di questa sedia è sublimato da un colore intenso che darà stile agli arredi più sobri. Il suo rivestimento 100% poliestere blu pavone si intona perfettamente con le sue gambe oblique in legno massello di betulla verniciato. Per una sala da pranzo sofisticata, scegli uno dei nostri tavoli da pranzo!', 8999, 0, 'sedia2.jpg'),
(15, 'Sedia marrone stile industriale in cuoio e metallo', 8, 'Dalla forma semplice e iconica, la sedia vintage in pelle marrone Austerlitz è una sedia in plastica munita di seduta rivestita in pelle.', 13000, 0, 'sedia3.jpg'),
(16, 'Sedia bistrot in betulla', 8, 'Voglia di tornare alle cose semplici? La sedia in legno TRADITION è una sedia verniciata con lasure che vanta lo stile naturale dei tempi passati. Questa sedia da tavolo è una sedia da bistrot ispirata allo stile antico.', 8999, 0, 'sedia4.jpg'),
(17, 'Pouf grigio/bianco in cotone', 9, 'Con il suo motivo a zigzag, il pouf a maglia WARM sarà l''accessorio ideale per il salotto o la camera.', 7999, 0, 'pouf1.jpg'),
(18, 'Pouf in cuoio e cotone', 9, 'Aggiungi un tocco di autenticità alla sala con il pouf quadrato Pioniere.', 7999, 1, 'pouf2.jpg'),
(19, 'Pouf in tessuto riciclato', 9, 'Lo spirito vintage di questo pouf quadrato MARSHALL si adatterà sia a una camera che a un salotto.', 7999, 0, 'pouf3.jpg'),
(20, 'Pouf grigio intrecciato in lana', 9, 'Il lavoro a maglia torna in scena nell''arredamento. Questo pouf intrecciato grigio lo prova! Sarà perfetto in camera o vicino al caminetto per creare un''atmosfera coccola.', 7990, 0, 'pouf4.jpg'),
(21, '3 tavoli bassi multicolore estraibili vintage L da 40 cm a 60 cm', 10, 'I colori e le dimensioni diverse di queste 3 tavole rotonde aggiungeranno una bella nota fantasiosa al tuo salotto.', 9999, 0, 'tavolini1.jpg'),
(22, 'Tavolo basso nero in vetro temprato e metallo', 10, 'Geometria e modernità riassumono bene questo tavolino di vetro temprato e metallo nero BLOSSOM!', 14900, 0, 'tavolini2.jpg'),
(23, 'Geometria e modernità riassumono bene questo tavolino di vetro temprato e metallo nero BLOSSOM!', 10, 'Cercate un tavolo basso per il vostro salotto? Scegliete il mix legno/metallo del tavolo basso Long Island modello piccolo.', 12900, 0, 'tavolini3.jpg'),
(24, '3 tavoli bassi estraibili stile industriale in abete massiccio e metallo', 10, 'Per chi ama cambiare la disposizione del mobilio, è impossibile resistere al fascino del tavolino sovrapponibile LONG ISLAND. Pratico ed estetico, questo tavolo da salotto è composto da 3 tavolini di grande design dalle forme semplici e sobrie. Questo set di 3 elementi dà origine a un tavolino in legno originale ed esclusivo per un ambiente dall''arredo ricercato. Il tavolo da salotto in legno Long Island può essere abbinato al mobile TV per un look urbano affermato.', 29900, 1, 'tavolini4.jpg'),
(25, 'Panca portatutto in legno e cotone L 81 cm', 11, 'Aggiungi l''utilità all''estetica con questa cassapanca. La struttura in legno di questa cassapanca evoca l''universo comodo e ospitale della vita di campagna.', 13990, 0, 'cassapanche1.jpg'),
(26, 'Mobile bianco da ingresso in legno L 135 cm', 11, 'Indispensabile e completamente in bianco, il mobile da ingresso Newport è un mobile portatutto in legno munito di numerosi scomparti.', 39900, 0, 'cassapanche2.jpg'),
(27, 'Panca portatutto bianca e cuscino colorato in lino L 130 cm', 11, 'Il banco portatutto COMPTOIR DES EPICES è un mobile davvero geniale, ricco di fascino! Ispirato allo stile antico, può essere utilizzato come panca o soluzione contenitiva. Questo banco portatutto bianco, ricco di grande fascino, si rivela estremamente pratico!', 19900, 0, 'cassapanche3.jpg'),
(28, 'Panca portatutto in legno e cotone L 103 cm', 11, 'Estetico e pratico al tempo stesso, il banco portatutto in legno ELOÏSE si rivela estremamente utile per riporre i giochi dei bambini o nascondere i tesori più preziosi. Particolarmente decorativa grazie a una mano di vernice naturale, questa soluzione contenitiva aiuta a fare ordine, secondo l''ispirazione del momento. Ideale nell''ambiente di casa, questa graziosa consolle portatutto in legno infonde calore e orna qualsiasi stanza.', 17990, 0, 'cassapanche4.jpg'),
(29, 'Tavola per sala da pranzo L200', 12, 'Questa tavola da pranzo ORIGAMI ovale creerà un''atmosfera luminosa con il legno biondo.', 39900, 0, 'tavolidapranzo1.jpg'),
(30, 'Tavolo da pranzo allungabile 6 a 10 persone bianco L 150/220 cm', 12, 'Moderna e intelligente, questa tavola da pranzo bianca si allunga in caso d''invitati imprevisti.', 26000, 0, 'tavolidapranzo2.jpg'),
(31, 'Tavolo stile industriale per sala da pranzo in abete e metallo L 140 cm', 12, 'Stile industrial, ma a prezzi ragionevoli con questa tavola in metallo e legno chiaro DOCKS.', 14900, 0, 'tavolidapranzo3.jpg'),
(32, 'Tavolo per sala da pranzo in massello di legno di sheesham L 180 cm', 12, 'Questo grande tavolo da pranzo semplice e moderno ti farà riscoprire la bellezza del legno di sheesham massiccio.', 48900, 1, 'tavolidapranzo4.jpg'),
(33, 'Scrivania vintage 2 cassetti', 13, 'Sobria e intramontabile, questa scrivania in legno chiaro adotta il minimalismo dello stile nordico.', 22900, 0, 'scrivanie1.jpg'),
(34, 'Scrivania vintage in massello di mango L 115 cm', 13, 'Sobria e pulita, questa scrivania in legno di mango massiccio dispone di un bel piano di lavoro. Montata su una base di metallo, questa scrivania moderna è completata da 2 cassetti in metallo e da un vano centrale per i tuoi oggetti.', 29900, 0, 'scrivanie2.jpg'),
(35, 'Scrivania vintage bianca', 13, 'Montata su piedi di abete sbiancato, questa scrivania bianca darà un grazioso tocco luminoso alla camera del tuo bambino.', 19900, 0, 'scrivanie3.jpg'),
(36, 'Scrivania bianca a 1 cassetto in metallo', 13, 'Con la scrivania bianca in metallo IGLOO, lo stile contemporaneo non è mai a corto d''idee quando si tratta di vestire gli interni in tutta semplicità!', 15900, 0, 'scrivanie4.jpg'),
(37, 'Guardaroba in mango L 190 cm', 14, 'Se desiderate un arredo della camera in stile naturale, lasciatevi sedurre dal fascino autentico dell''appendiabiti in legno biaccato Persiennes.', 199000, 0, 'armadi1.jpg'),
(38, 'Guardaroba bianco in legno L 170 cm', 14, 'Completamente bianco, questo grande guardaroba in legno darà un tocco di freschezza alla tua camera da letto. Per contenere tutti i tuoi abiti e la tua biancheria, questo guardaroba è dotato di una parte appendiabiti al centro e di una parte per la biancheria alle estremità, per un totale di 6 ripiani fissi.', 119000, 0, 'armadi2.jpg'),
(39, 'Guardaroba ad armadietto in metallo L 120 cm', 14, 'Ispirato al design industriale, questo guardaroba in metallo darà un tocco di modernità alla tua camera. Al suo interno questo guardaroba a 3 porte è dotato di 2 parti appendiabiti con un ripiano fisso e una parte biancheria con 4 ripiani fissi.', 39900, 0, 'armadi3.jpg'),
(40, 'Guardaroba vintage in massello di quercia', 14, 'Questa rivisitazione di un guardaroba vintage è tanto estetica quanto capiente. Sobrio e funzionale, questo guardaroba di legno possiede 2 sbarre e 3 mensole amovibili oltre a una mensola fissa.', 99900, 0, 'armadi4.jpg'),
(41, 'Scaffale stile industriale in abete e metallo grigio antracite', 15, 'Sobrio e moderno, questo scaffale stile industriale in abete e metallo grigio antracite STATEN ti offre 5 mensole per organizzare gli oggetti del salotto. Con la sua struttura in metallo, questo scaffale di legnovalorizzerà le tue stoviglie e i tuoi oggetti decorativi. Potrai anche farne una biblioteca adatta a qualsiasi tipo d''interni. Nello stesso stile, scopri anche lo scaffale con rotelle industrial Brooklyn.', 9999, 1, 'scaffali1.jpg'),
(42, 'Scaffale stile industriale in abete massiccio e metallo', 15, 'Per arredare un salotto dallo stile contemporaneo ed elegante, scegliete il magnifico scaffale LONG ISLAND dal design industriale di grande tendenza. Questo scaffale in legno dalle linee semplici vanta ripiani dall''aspetto decapato e due cassetti nella parte inferiore, per un mobile moderno originale e pratico. Per completare l''arredo di un ambiente urbano, scoprite il mobile TV.', 29900, 0, 'scaffali2.jpg'),
(43, '4 scaffali da parete vintage in legno multicolore L 25 à L100 cm', 15, 'Tinte tenui per questi 4 scaffali murali che si riveleranno praticissimi per sistemare i tuoi oggetti.', 9999, 0, 'scaffali3.jpg'),
(44, 'Scaffale in massello di legno di sheesham', 15, 'Ispirato all’arte di vivere nordica, lo scaffale STOCKHOLM crea un''atmosfera zen e accogliente nei vostri interni.', 69900, 0, 'scaffali4.jpg'),
(45, 'Colonna libreria bianca in legno H 192 cm', 16, 'Ora non avrete più scuse per lasciare in disordine i vostri libri grazie alla colonna libreria bianca Osaka.', 9999, 0, 'libreria1.jpg'),
(46, 'Libreria vintage multicolore', 16, 'Con i suoi pannelli colorati sullo sfondo, questa biblioteca vintage multicolore TWIST aggiungerà una nota vivace al tuo salotto.', 11000, 1, 'libreria2.jpg'),
(47, 'Libreria a 3 ante e 6 cassetti in pino riciclato', 16, 'I libri si accumulano e il tuo salotto è strapieno? Opta per la libreria a 3 ante e 6 cassetti in legno di pino riciclato BOTANICA! Sono innumerevoli le funzioni di questo mobile contenitore caldo e autentico. Non sei un grande amante della lettura? Gli scaffali di questa libreria in legno di pino massello ti permetteranno di esporre i tuoi souvenir da viaggio e i tuoi oggetti d''arredo preferiti. Installato in una cucina, potrà accogliere anche tutte le tue stoviglie!', 129000, 0, 'libreria3.jpg'),
(48, 'Libreria stile industriale in massello di mango L 110 cm', 16, 'Pratica per mettere ordine in salotto, questa libreria moderna offre diversi scaffali in metallo e legno dipinto. Concepita in legno di mango massiccio, questa libreria si sposa perfettamente a mobili industriali.', 75500, 0, 'libreria4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` int(10) UNSIGNED NOT NULL,
  `address_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `shipped_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `address_id`, `order_id`, `shipped_at`) VALUES
(1, 2, 1, NULL),
(2, 8, 2, '2018-01-15 09:00:00'),
(3, 3, 3, '2018-01-16 09:00:00'),
(4, 9, 4, '2018-01-17 09:00:00'),
(5, 10, 5, '2018-01-21 09:00:00'),
(6, 11, 6, '2018-01-22 09:00:00'),
(7, 6, 7, '2018-01-24 09:00:00'),
(8, 10, 8, '2018-01-24 09:00:00'),
(9, 11, 9, '2018-01-24 09:00:00'),
(10, 2, 10, '2018-01-26 09:00:00'),
(11, 5, 11, NULL),
(12, 5, 12, '2018-01-27 09:00:00'),
(13, 3, 13, '2018-01-30 09:00:00'),
(14, 2, 14, '2018-01-31 09:00:00'),
(15, 3, 15, '2018-01-31 09:00:00'),
(16, 4, 16, '2018-02-01 09:00:00'),
(17, 4, 17, '2018-02-02 09:00:00'),
(18, 8, 18, '2018-02-02 09:00:00'),
(19, 10, 19, '2018-02-02 09:00:00'),
(20, 5, 20, '2018-02-04 09:00:00'),
(21, 11, 21, '2018-02-04 09:00:00'),
(22, 9, 22, NULL),
(23, 6, 23, '2018-02-07 09:00:00'),
(24, 4, 24, '2018-02-09 09:00:00'),
(25, 6, 25, '2018-02-09 09:00:00'),
(26, 7, 26, '2018-02-10 09:00:00'),
(27, 7, 27, '2018-02-11 09:00:00'),
(28, 7, 28, '2018-02-11 09:00:00'),
(29, 9, 29, '2018-02-11 09:00:00'),
(30, 11, 30, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='					';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `surname`, `password`, `email`, `admin`) VALUES
(1, 'admin', 'Mario', 'Rossi', '$2a$10$Os9/WLF2LbGUFUMJoHiVXeQkRtOXl8rFym22GWM/mt1iwX9rCSX82', 'admin@example.com', 1),
(2, 'user', 'Franco', 'Cavolo', '$2a$10$64zpJ5yrc5MoHLLfayFWre2BUcuDcDtISpG.e6GsNqTliA0g..GOu', 'user@example.com', 0),
(3, 'usr2', 'Gastani', 'Frizzi', '$2a$10$u43axLrtb8CLTqV.zIzl/.OzEQnp/hdm4i1IfrM5l..F6DdGzKCx.', 'usr2@example.com', 0),
(4, 'usr3', 'Aldo', 'Baldo', '$2a$10$u43axLrtb8CLTqV.zIzl/.OzEQnp/hdm4i1IfrM5l..F6DdGzKCx.', 'usr3@example.com', 0),
(5, 'usr4', 'Giovanni', 'Storti', '$2a$10$u43axLrtb8CLTqV.zIzl/.OzEQnp/hdm4i1IfrM5l..F6DdGzKCx.', 'usr4@example.com', 0),
(6, 'usr5', 'Giacomo', 'Poretti', '$2a$10$u43axLrtb8CLTqV.zIzl/.OzEQnp/hdm4i1IfrM5l..F6DdGzKCx.', 'usr5@example.com', 0),
(7, 'usr6', 'Stanley', 'Laurel', '$2a$10$u43axLrtb8CLTqV.zIzl/.OzEQnp/hdm4i1IfrM5l..F6DdGzKCx.', 'example@usr6.com', 0),
(8, 'usr7', 'Ollie', 'Babe', '$2a$10$u43axLrtb8CLTqV.zIzl/.OzEQnp/hdm4i1IfrM5l..F6DdGzKCx.', 'usr7@example.com', 0),
(9, 'usr8', 'Mario', 'Girotti', '$2a$10$u43axLrtb8CLTqV.zIzl/.OzEQnp/hdm4i1IfrM5l..F6DdGzKCx.', 'usr8@example.com', 0),
(10, 'usr9', 'Carlo', 'Pedersoli', '$2a$10$u43axLrtb8CLTqV.zIzl/.OzEQnp/hdm4i1IfrM5l..F6DdGzKCx.', 'usr9@example.com', 0),
(11, 'usr10', 'Jack', 'Black', '$2a$10$u43axLrtb8CLTqV.zIzl/.OzEQnp/hdm4i1IfrM5l..F6DdGzKCx.', 'usr10@example.com', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_shipping_addresses_users1_idx` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categories_categories1_idx` (`parent_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_users1_idx` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_items_products1_idx` (`product_id`),
  ADD KEY `fk_order_items_orders1_idx` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_categories1_idx` (`category_id`),
  ADD KEY `homepage_products` (`homepage`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_shippings_shipping_addresses1_idx` (`address_id`),
  ADD KEY `fk_shippings_orders1_idx` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `fk_shipping_addresses_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fk_categories_categories1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_order_items_orders1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order_items_products1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_categories1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shippings`
--
ALTER TABLE `shippings`
  ADD CONSTRAINT `fk_shippings_orders1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_shippings_shipping_addresses1` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
