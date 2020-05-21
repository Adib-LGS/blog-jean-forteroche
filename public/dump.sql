-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  lun. 18 mai 2020 à 23:19
-- Version du serveur :  5.7.26
-- Version de PHP :  7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `blogpoo`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `article_id` int(11) NOT NULL,
  `reports_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `pseudo`, `content`, `created_at`, `article_id`, `reports_id`) VALUES
(106, 'alexandre.thibault', '<p>Est quod qui nisi consequatur voluptatem accusantium voluptate. Enim aut veniam dolor veritatis quis. Velit rerum aliquam dolorem aperiam enim debitis.</p><p>Inventore ducimus nisi omnis rerum nemo facere nihil neque. Consectetur est delectus natus dolor veniam voluptatem sit est. Laudantium sit totam unde dolor. Omnis rerum sapiente quia nihil aut. Corrupti molestiae nisi hic voluptatem repudiandae.</p><p>Labore eum ipsa quam asperiores molestiae pariatur. Sed at voluptas dignissimos sint ut assumenda. Labore deserunt deserunt quia iure facilis qui.</p><p>Sequi est id voluptate unde distinctio doloremque non sequi. Qui omnis temporibus non eum nesciunt. Sunt vel ipsam quisquam explicabo magni alias. Qui non ut et occaecati. Reiciendis excepturi minus aut qui beatae non soluta.</p><p>Pariatur aperiam dolore aut. Eos minima harum sed nobis placeat molestias dolor assumenda. Atque sed nisi sit ratione occaecati unde ad. Ad dolores corrupti sit quo consequatur qui.</p>', '2019-06-17 05:03:02', 122, 0),
(107, 'delahaye.augustin', '<p>Et laborum ut ducimus eum odio est ut. Eos aspernatur aut sit id et sed. Rerum est molestiae pariatur deleniti sapiente rerum nesciunt.</p><p>Temporibus ullam quia expedita veritatis dolor in. Deserunt et corporis omnis quis autem reprehenderit. Doloribus et similique ea accusamus rerum nihil quo.</p><p>Repellendus aperiam ut in quaerat cum. Dolores exercitationem veniam adipisci qui. Non quia aut dolores a quae rerum. Consectetur ut laboriosam fuga minima harum. Et quia et rerum possimus veritatis voluptatum delectus omnis.</p><p>Praesentium et nam ad quis repudiandae ut. Cupiditate delectus qui modi aut. Iusto et facere voluptas ad.</p><p>Aperiam sit qui dolore qui et. Ut quo sit dolores consequuntur. Rerum animi mollitia nostrum qui. Voluptas dolorem aut placeat nisi.</p>', '2019-06-13 14:40:15', 122, 0),
(109, 'abouvier', '<p>Impedit repellendus et velit enim qui. Aut nobis et veritatis qui suscipit consectetur. Et ad est ut omnis dolores. Occaecati iure quos molestiae quidem soluta cupiditate minima esse.</p><p>Iusto error alias tempore. Animi eius molestias voluptas dolore voluptates est. Reprehenderit dicta quisquam ducimus id eum omnis repellendus. Ullam velit asperiores repellat autem.</p><p>Iure at possimus dolor odit. Aspernatur sed et et omnis nisi vero eos. Rerum et voluptas sapiente aut. Quia doloribus cupiditate consequatur assumenda et.</p><p>Reiciendis inventore aut rem aspernatur nihil eaque soluta molestiae. Et sed consectetur est quasi aut quam commodi. Eos nesciunt aspernatur nobis est cupiditate.</p><p>Voluptate vitae fuga ab ipsam molestiae optio. Aperiam perferendis sed earum. Omnis vel non sint id. Ducimus illum aut quis maiores sapiente quaerat impedit.</p>', '2019-06-14 17:49:58', 123, 0),
(110, 'marin.ines', '<p>Non voluptatem voluptatem est voluptatem molestiae. Consectetur quis hic quasi. Eos voluptate placeat asperiores. Quae sit et dolor nam et.</p><p>Quo voluptates consequatur id pariatur voluptate. Necessitatibus non praesentium provident atque nulla quis voluptatem. Odit aut incidunt debitis eos delectus est sed. Est beatae facilis repellendus omnis dolore sint qui autem.</p><p>Esse recusandae ipsa qui sed voluptatem. Quo impedit eos velit. Suscipit officiis magni nobis labore et. Nesciunt consequatur quis voluptates ipsa eveniet. Totam magnam commodi voluptas dolorem voluptatem.</p><p>Molestiae omnis consequuntur nihil aut. Et eius quas illum. Qui modi earum et et quia. Beatae est odio ad consequatur explicabo.</p><p>Rerum alias quidem quidem distinctio odio quis beatae. Unde perferendis optio expedita autem veritatis rerum ea. Animi sint unde voluptas velit voluptas. Enim recusandae expedita sequi consequatur quam.</p>', '2019-06-18 08:49:23', 123, 0),
(114, 'martin41', '<p>Totam et ab vel et saepe. Veritatis neque culpa earum. Adipisci inventore rem qui cupiditate inventore tenetur nam nostrum. Fugit ad dolor est omnis labore.</p><p>Dolore qui quia consequatur minus temporibus. Harum numquam necessitatibus et officiis. Et sint est doloribus temporibus.</p><p>Enim nesciunt quidem eligendi eligendi. Iusto et vel qui veniam. Numquam vitae modi eos sequi et non. Aut vel consequatur molestiae. Voluptatum voluptatem ab dignissimos et quia sed asperiores itaque.</p><p>Voluptas nam voluptas aut ut debitis. Amet doloribus delectus aut. Reiciendis fuga officia exercitationem et quae.</p><p>Tempora perferendis dolores dolores molestiae consectetur. Aperiam id nobis quia adipisci deleniti. Labore et mollitia consequatur amet sit omnis. Quia ea fugiat nostrum consequatur est commodi. Error molestiae sit corrupti voluptatem natus expedita animi omnis.</p>', '2019-06-08 05:54:59', 123, 0),
(116, 'dominique96', '<p>Aliquam fugiat aut quos qui quis nulla ut. Sit numquam velit sequi est. Hic itaque odio quia facere. Sed consequuntur id modi.</p><p>Odio repudiandae tempora doloremque similique tenetur. Provident velit mollitia eum consequatur qui aliquam. Rem et sed fugiat aliquam.</p><p>Ut qui eveniet voluptatem adipisci est minima. Aut sint nesciunt temporibus molestias occaecati dolor odio. Commodi aut impedit sed fuga non qui. Explicabo et quam aliquid incidunt nesciunt doloremque iusto.</p><p>Numquam aperiam dolor quis aut culpa officiis quis omnis. Dolorum sequi delectus nemo sit ut aperiam itaque molestiae. Alias beatae eveniet velit ipsa nemo inventore id sed. Et est sunt deserunt culpa laborum repellat. Dicta exercitationem earum voluptatum distinctio maxime distinctio ullam.</p><p>Autem quidem quidem ex ab vel voluptas amet eos. Vel est ullam id dolor ut nisi quis. Aperiam aut aut illo eligendi est.</p>', '2019-06-29 04:28:19', 124, 0),
(176, 'leblanc.jules', '<p>Voluptates consequatur ea ut quia et rerum. Quasi totam praesentium est dolorum ipsam fugit voluptatem. Repellendus maiores at minus unde labore. Facilis sed laboriosam est ab repudiandae et. Ut similique et sunt sed in perspiciatis quos.</p><p>Eius et provident necessitatibus blanditiis. Repudiandae quam quaerat libero eum. Quos facere nostrum est quibusdam quisquam quo quos.</p><p>Placeat eligendi nisi expedita sint. Aut nobis culpa est deserunt natus cumque. Repudiandae atque rerum aliquid.</p><p>Numquam qui accusamus quasi rem. Praesentium quasi consequatur et ab occaecati. Assumenda blanditiis rerum quidem dolorem quis. Est neque non et perspiciatis consequatur eum temporibus.</p><p>Dolores quaerat ex aspernatur labore ipsam. Et perferendis totam suscipit voluptatem sint explicabo error. Alias sunt sit et tenetur necessitatibus. Facilis autem temporibus est quis quam facere quibusdam. Qui illum quia earum.</p>', '2019-06-03 00:56:27', 136, 0),
(179, 'noel58', '<p>Delectus et voluptatem aut nesciunt sed numquam repellendus. Voluptate aliquam non est inventore sequi consequatur vero sit. Ut accusantium quis ipsa sint in molestiae. Et totam temporibus perferendis rem.</p><p>Qui sit numquam minima ad repellat tempore in. Eaque labore corporis quas quaerat autem animi blanditiis. Voluptas dolores a sed. Architecto et eum aut enim magni ea sed eos.</p><p>Cupiditate adipisci nihil quos rerum. Eveniet maxime praesentium ut officiis dolorum. Animi id debitis laboriosam eligendi sunt voluptate. Quidem at voluptatem aut nesciunt incidunt eius.</p><p>Voluptates autem illum tenetur repellat officiis et eveniet. Hic aspernatur et error qui quam. In nulla tempora fugit reprehenderit laudantium in fugit. Et quo officiis perferendis aperiam nemo perferendis veniam.</p><p>Reiciendis minus quo impedit. Possimus soluta beatae magnam assumenda delectus voluptatem aut eos. Fuga ea minus omnis nam. Quam ut quasi beatae dolore minus itaque ad numquam. Quasi ut nihil repudiandae nam omnis aperiam non.</p>', '2019-04-27 15:43:07', 137, 0),
(231, 'Jean Forto', 'Qui est l\'admin de ce blog pourri ?', '2020-05-02 14:22:24', 137, 0),
(232, 'Larry Flint', 'Qui a dit Escroc ?!', '2020-05-02 16:24:31', 135, 0),
(235, 'Jean Forto', 'Cette article est très plaisant ', '2020-05-03 01:18:44', 136, 0),
(243, 'GHJHGGF', 'sdfghj', '2020-05-04 13:07:05', 136, 0),
(244, 'Luc', 'bernard', '2020-05-06 14:03:26', 136, 0),
(270, 'Jean', 'Super', '2020-05-10 23:27:17', 128, 0),
(325, 'django', 'Django', '2020-05-14 01:59:48', 129, 0),
(336, 'X', 'ouais c vrai ca !', '2020-05-15 16:41:39', 123, 0),
(341, 'PSG', 'Youpii', '2020-05-18 14:34:17', 128, 0),
(346, 'jean', 'sss', '2020-05-18 21:03:50', 235, 0),
(347, 'jean', 'vvv', '2020-05-18 21:27:20', 235, 0),
(348, 'jean', 'gg', '2020-05-18 22:56:49', 235, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ARTICLES` (`created_at`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=349;
