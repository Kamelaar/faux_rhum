-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 08 avr. 2019 à 21:58
-- Version du serveur :  5.7.19
-- Version de PHP :  7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `faux_rhum`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `name`, `created_at`) VALUES
(1, 0, 'Technology', '2017-03-04 13:03:18'),
(2, 0, 'Business', '2017-03-04 13:14:40'),
(4, 4, 'Santé', '2018-10-23 21:57:04');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `validated` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `name`, `email`, `body`, `created_at`, `validated`) VALUES
(1, 2, 'John Doe', 'jdoe@gmail.com', 'Great Post!', '2017-03-17 13:57:29', 0),
(2, 2, 'Jan Doe', 'jane@yahoo.com', 'Thank you for this awesome post', '2017-03-17 14:05:58', 0);

-- --------------------------------------------------------

--
-- Structure de la table `login_history`
--

DROP TABLE IF EXISTS `login_history`;
CREATE TABLE IF NOT EXISTS `login_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `sessionData` text CHARACTER SET utf8 NOT NULL,
  `machineIp` varchar(20) CHARACTER SET utf8 NOT NULL,
  `userAgent` varchar(30) CHARACTER SET utf8 NOT NULL,
  `agentString` text CHARACTER SET utf8 NOT NULL,
  `platform` text CHARACTER SET utf8 NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `login_history`
--

INSERT INTO `login_history` (`id`, `userId`, `sessionData`, `machineIp`, `userAgent`, `agentString`, `platform`, `createdDtm`) VALUES
(13, 4, '{\"user_id\":\"4\",\"username\":\"test\",\"logged_in\":true,\"admin_role\":true}', '::1', 'Firefox 63.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', 'Windows 10', '2018-10-31 22:56:24'),
(14, 4, '{\"user_id\":\"4\",\"username\":\"test\",\"logged_in\":true,\"admin_role\":true}', '::1', 'Firefox 63.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', 'Windows 10', '2018-10-31 22:56:30'),
(15, 4, '{\"user_id\":\"4\",\"username\":\"test\",\"logged_in\":true,\"admin_role\":true}', '::1', 'Firefox 63.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', 'Windows 10', '2018-11-01 19:46:46'),
(16, 4, '{\"user_id\":\"4\",\"username\":\"test\",\"logged_in\":true,\"admin_role\":true}', '::1', 'Firefox 63.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', 'Windows 10', '2018-11-01 19:47:48'),
(17, 4, '{\"user_id\":\"4\",\"username\":\"test\",\"logged_in\":true,\"admin_role\":true}', '::1', 'Firefox 63.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', 'Windows 10', '2018-11-02 10:36:07'),
(18, 4, '{\"user_id\":\"4\",\"username\":\"test\",\"logged_in\":true,\"admin_role\":true}', '::1', 'Firefox 63.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', 'Windows 10', '2018-11-05 21:20:04'),
(19, 5, '{\"user_id\":\"5\",\"username\":\"membre\",\"logged_in\":true}', '::1', 'Firefox 63.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', 'Windows 10', '2018-11-05 21:47:13'),
(20, 4, '{\"user_id\":\"4\",\"username\":\"test\",\"logged_in\":true,\"admin_role\":true}', '::1', 'Firefox 63.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', 'Windows 10', '2018-11-05 21:48:47'),
(21, 4, '{\"user_id\":\"4\",\"username\":\"test\",\"logged_in\":true,\"admin_role\":true}', '::1', 'Firefox 63.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', 'Windows 10', '2018-11-05 22:18:29'),
(22, 4, '{\"user_id\":\"4\",\"username\":\"test\",\"logged_in\":true,\"admin_role\":true}', '::1', 'Firefox 63.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', 'Windows 10', '2018-11-05 22:21:29'),
(23, 6, '{\"user_id\":\"6\",\"username\":\"membre\",\"logged_in\":true}', '::1', 'Firefox 63.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', 'Windows 10', '2018-11-05 22:24:39'),
(24, 7, '{\"user_id\":\"7\",\"username\":\"membre\",\"logged_in\":true}', '::1', 'Firefox 63.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', 'Windows 10', '2018-11-05 22:26:04'),
(25, 4, '{\"user_id\":\"4\",\"username\":\"test\",\"logged_in\":true,\"admin_role\":true}', '::1', 'Firefox 63.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', 'Windows 10', '2018-11-15 14:25:11'),
(26, 4, '{\"user_id\":\"4\",\"username\":\"test\",\"logged_in\":true,\"admin_role\":true}', '::1', 'Firefox 63.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', 'Windows 10', '2018-11-15 14:27:13'),
(27, 4, '{\"user_id\":\"4\",\"username\":\"test\",\"logged_in\":true,\"admin_role\":true}', '::1', 'Firefox 63.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0', 'Windows 10', '2018-12-10 00:01:34'),
(28, 4, '{\"user_id\":\"4\",\"username\":\"test\",\"logged_in\":true,\"admin_role\":true}', '::1', 'Firefox 65.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0', 'Windows 10', '2019-03-07 11:18:40'),
(29, 4, '{\"user_id\":\"4\",\"username\":\"test\",\"logged_in\":true,\"admin_role\":true}', '::1', 'Firefox 66.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:66.0) Gecko/20100101 Firefox/66.0', 'Windows 10', '2019-04-03 22:46:55'),
(30, 9, '{\"user_id\":\"9\",\"username\":\"admin\",\"logged_in\":true}', '::1', 'Firefox 66.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:66.0) Gecko/20100101 Firefox/66.0', 'Windows 10', '2019-04-08 23:55:30'),
(31, 9, '{\"user_id\":\"9\",\"username\":\"admin\",\"logged_in\":true,\"admin_role\":true}', '::1', 'Firefox 66.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:66.0) Gecko/20100101 Firefox/66.0', 'Windows 10', '2019-04-08 23:56:29');

-- --------------------------------------------------------

--
-- Structure de la table `maintenance`
--

DROP TABLE IF EXISTS `maintenance`;
CREATE TABLE IF NOT EXISTS `maintenance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `maintenance_mode` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `maintenance`
--

INSERT INTO `maintenance` (`id`, `maintenance_mode`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `post_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` varchar(40) NOT NULL,
  `validated` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `user_id`, `title`, `slug`, `body`, `post_image`, `created_at`, `author`, `validated`) VALUES
(1, 1, 1, '<?= \'$test\' ?> Blog Post 1', 'Blog-Post-1', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut et molestie eros. Maecenas dignissim, erat at faucibus finibus, nunc nibh finibus lacus, sed gravida leo urna at erat. Proin et efficitur dolor, eget interdum enim. Cras nec ante quis tellus gravida ornare. Duis arcu lacus, elementum quis iaculis id, mattis ut turpis. Pellentesque id dignissim dolor. Curabitur finibus facilisis pulvinar. Nullam urna arcu, malesuada a purus a, pharetra pulvinar lacus. Curabitur quis ornare felis, ut ultrices nulla.</p>\r\n\r\n<p>Fusce placerat aliquam erat, et sagittis diam accumsan vitae. In elementum vel augue sit amet bibendum. Nulla cursus elit metus. Ut auctor nisl quis bibendum tincidunt. Integer gravida nisi id urna rhoncus, nec tristique magna efficitur. Mauris non blandit ipsum, ut tempus purus. Praesent rhoncus gravida aliquam. Nulla finibus mi id fermentum fringilla. Morbi volutpat, massa eget sodales tempus, est risus elementum leo, pulvinar fermentum diam nibh a mi. Phasellus porttitor vitae mauris non elementum. Sed ut lacinia sapien. Proin a metus ullamcorper lectus ultricies euismod. Donec vitae turpis eros. Morbi at imperdiet ligula. Mauris sed rutrum lectus. Phasellus eget nulla congue, dictum dolor ac, dapibus justo.</p>\r\n', 'OS_Ubuntu.png', '2017-03-17 13:22:28', 'brad', 0),
(2, 2, 1, 'Blog Post 2', 'Blog-Post-2', '<p>. Cras nec ante quis tellus gravida ornare. Duis arcu lacus, elementum quis iaculis id, mattis ut turpis. Pellentesque id dignissim dolor. Curabitur finibus facilisis pulvinar. Nullam urna arcu, malesuada a purus a, pharetra pulvinar lacus. Curabitur quis ornare felis, ut ultrices nulla.</p>\r\n\r\n<p>Fusce placerat aliquam erat, et sagittis diam accumsan vitae. In elementum vel augue sit amet bibendum. Nulla cursus elit metus. Ut auctor nisl quis bibendum tincidunt. Intes elementum leo, pulvinar fermentum diam nibh a mi. Phasellus porttitor vitae mauris non elementum. Sed ut lacinia sapien. Proin a metus ullamcorper lectus ultricies euismod. Donec vitae turpis eros. Morbi at imperdiet ligula. Mauris sed rutrum lectus. Phasellus eget nulla congue, dictum dolor ac, dapibus justo.</p>\r\n', 'ci.png', '2017-03-17 13:23:23', 'brad', 0),
(3, 2, 2, 'Test Post', 'Test-Post', '<p>Test</p>\r\n', 'noimage.png', '2017-04-10 14:15:59', 'john', 0),
(6, 2, 3, 'Test numero 2', 'Test-numero-2', '<p>Test numero 2</p>\r\n', 'noimage.png', '2018-10-18 19:41:10', 'patou', 0),
(7, 4, 4, 'Manger 5 fruits ou légumes par jour!', 'Manger-5-fruits-ou-legumes-par-jour', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sagittis in mi id aliquet. Sed convallis at tellus et fringilla. Praesent euismod placerat ipsum, quis commodo magna tincidunt vitae. Maecenas pharetra magna ut tempor ullamcorper. Vivamus consequat tempus velit, in ornare lacus volutpat vitae. Proin et sem eget ligula iaculis condimentum. Donec malesuada blandit nibh, varius luctus mauris porta quis. Phasellus rutrum eu nulla eu ultricies. Quisque id sodales lorem, in placerat massa. Morbi sed lorem convallis, dignissim neque sit amet, pharetra metus. Vivamus quis ipsum id lectus feugiat congue pulvinar sit amet nisl. Quisque porttitor sem sed accumsan sagittis.</p>\r\n\r\n<p>Aenean pulvinar posuere ligula in ultrices. Phasellus hendrerit fermentum ligula. Quisque nec mi consectetur, vestibulum orci nec, blandit dui. Aenean ac lorem ligula. Suspendisse porta erat leo, in fermentum est semper eget. Aenean sed nunc vitae neque malesuada convallis. Mauris faucibus augue tellus, eu laoreet nunc lacinia id. Aliquam et condimentum lorem, vitae ornare nisl. Etiam semper porttitor ante quis placerat. In id ornare tellus. In sed risus varius, laoreet justo eget, feugiat massa. Etiam volutpat fermentum ante, et fermentum nibh gravida at.</p>\r\n\r\n<p>Praesent rhoncus pellentesque arcu at malesuada. Etiam ut sodales est. Praesent in nisi velit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer et mauris molestie, rutrum urna vel, euismod justo. Morbi a enim et ipsum gravida laoreet. Quisque lacinia ex sapien, in eleifend erat condimentum at. In vel lorem sed justo vulputate pulvinar vitae vitae orci.</p>\r\n\r\n<p>Vestibulum ornare dui quis eros vulputate, at volutpat est scelerisque. Cras mattis mauris ligula, vitae efficitur velit aliquet non. Duis lobortis neque dui, eget tristique dolor pulvinar eu. Phasellus eget nisi ac lacus consectetur auctor. Donec tempus est commodo metus congue cursus. Quisque pellentesque non nisl vitae hendrerit. Sed eget ipsum lacus. Pellentesque convallis lobortis ex, in suscipit risus ornare sit amet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam sagittis augue a mi varius, non ultrices odio pulvinar.</p>\r\n\r\n<p>Nulla ac sapien viverra metus faucibus faucibus non eget felis. Suspendisse viverra ultricies dui, vitae cursus augue luctus vel. Nam laoreet ullamcorper elit quis placerat. Sed at augue eu ligula ultricies accumsan. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas in dui magna. Aliquam convallis bibendum dui sit amet luctus. Cras scelerisque sagittis nulla, non dapibus arcu efficitur ac. Nullam aliquet porttitor justo, vitae maximus urna tincidunt ut. Duis vel est nec dolor vestibulum consequat vitae id augue.</p>\r\n', 'fruits.jpg', '2018-10-24 16:30:44', 'test', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `zipcode`, `email`, `username`, `password`, `register_date`, `role_id`) VALUES
(1, 'Brad Traversy', '11111', 'brad@gmail.com', 'brad', 'e10adc3949ba59abbe56e057f20f883e', '2017-04-10 13:14:31', 0),
(2, 'John Doe', '90210', 'jdoe@gmail.com', 'john', 'e10adc3949ba59abbe56e057f20f883e', '2017-04-10 14:12:14', 0),
(3, 'Patrick', '75000', 'kammusique@gmail.com', 'Patou', '098f6bcd4621d373cade4e832627b4f6', '2018-10-17 21:49:12', 0),
(4, 'test', '93160', 'test@gmail.com', 'test', '098f6bcd4621d373cade4e832627b4f6', '2018-10-23 21:47:14', 1),
(7, 'membre', '93160', 'membre@gmail.com', 'membre', '5a99c8cac333affeed05a24fe0d6f61c', '2018-11-05 21:25:43', 0),
(8, 'kamel', '00000', 'kamel.serka@gmail.com', 'kam', 'd968a18370429ceee4e7fb0268ec50bf', '2019-03-07 10:18:02', 0),
(9, 'admin', '00000', 'admin@admin.admin', 'admin', '$2y$10$I/XuFW15mnLT8a.dIuTs0ufvFxJr5nZez/EjFNlQVt1x6804zqDQm', '2019-04-08 21:55:23', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
