-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 11 Gru 2018, 00:10
-- Wersja serwera: 10.1.32-MariaDB
-- Wersja PHP: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `stronkamemka`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ban_cancellation`
--

CREATE TABLE `ban_cancellation` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `proposal` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `liked_posts`
--

CREATE TABLE `liked_posts` (
  `post_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `liked_posts`
--

INSERT INTO `liked_posts` (`post_id`, `user_id`) VALUES
(2, 7),
(7, 7),
(8, 7);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `observed_tags`
--

CREATE TABLE `observed_tags` (
  `user_id` int(10) NOT NULL,
  `tag_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posts`
--

CREATE TABLE `posts` (
  `id` int(10) NOT NULL,
  `tekst` text COLLATE utf8_polish_ci,
  `image` text COLLATE utf8_polish_ci,
  `up_vote` int(15) NOT NULL DEFAULT '0',
  `user_id` int(10) NOT NULL,
  `post_id` int(10) DEFAULT NULL,
  `accepted` int(1) NOT NULL DEFAULT '1',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `anon` int(1) NOT NULL DEFAULT '0',
  `postStatus` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `posts`
--

INSERT INTO `posts` (`id`, `tekst`, `image`, `up_vote`, `user_id`, `post_id`, `accepted`, `create_date`, `anon`, `postStatus`) VALUES
(1, '#elo elodka leci na wolno', '', 0, 5, NULL, 1, '2018-11-13 13:40:06', 1, 0),
(2, 'Hari pota...\r\n\r\n', 'https://www.wykop.pl/cdn/c3201142/comment_qv7f6FDir5g0gsP0xwKEWNjajCPOH9gX.jpg', 0, 7, NULL, 1, '2018-11-13 17:26:40', 0, 1),
(3, '#hari pota', '', 0, 7, NULL, 1, '2018-11-13 17:54:20', 0, 1),
(4, '#hari elo mordo', '', 0, 7, NULL, 1, '2018-11-13 18:02:44', 1, 1),
(5, 'testowaOdp', 'anon.png', 0, 7, 2, 1, '2018-11-13 18:56:04', 0, 0),
(6, 'asdasdasdasd', '', 0, 7, 4, 1, '2018-12-07 19:22:27', 0, 0),
(7, 'asdasdasdasdasd', '', 0, 7, NULL, 1, '2018-12-07 19:22:43', 0, 1),
(8, 'asdasdasdasd', '', 0, 7, 7, 1, '2018-12-07 19:22:54', 0, 0),
(9, 'aaaaaaaaaaaaaaa', '', 0, 7, 7, 1, '2018-12-07 19:23:08', 0, 0),
(10, 'dddddddddddddddddddddddddddddddd', '', 0, 7, NULL, 1, '2018-12-07 19:23:21', 0, 1),
(11, 'asdfasffasf', '', 0, 7, 7, 1, '2018-12-07 19:29:50', 0, 0),
(12, 'komentujemy', '', 0, 7, NULL, 1, '2018-12-07 19:30:00', 0, 1),
(13, 'koment', '', 0, 7, 12, 1, '2018-12-07 19:30:10', 0, 0),
(14, 'komentkom', '', 0, 7, NULL, 1, '2018-12-07 19:30:29', 0, 1),
(15, 'komentkom', '', 0, 7, NULL, 1, '2018-12-07 19:32:31', 0, 1),
(16, 'asdasdasdasd', '', 0, 7, NULL, 1, '2018-12-07 19:32:55', 0, 1),
(17, 'asdasdasdasd', '', 0, 7, NULL, 1, '2018-12-07 19:33:16', 0, 1),
(18, 'asdasdasdasd', '', 0, 7, NULL, 1, '2018-12-07 19:33:17', 0, 1),
(19, 'asdasdasdasd', '', 0, 7, NULL, 1, '2018-12-07 19:33:40', 0, 1),
(20, 'asdasdasdasd', '', 0, 7, NULL, 1, '2018-12-07 19:33:45', 0, 1),
(21, 'asdasdasdasd', '', 0, 7, 7, 1, '2018-12-07 19:34:00', 0, 0),
(22, 'komentkomenta', '', 0, 7, 7, 1, '2018-12-07 19:34:14', 0, 0),
(23, 'komkomkom', '', 0, 7, 7, 1, '2018-12-07 19:34:27', 0, 0),
(24, 'komkomkom', '', 0, 7, 7, 1, '2018-12-07 19:35:05', 0, 0),
(25, 'elo mordo', '', 0, 5, NULL, 1, '2018-12-09 09:50:25', 1, 1),
(26, 'asdasd', '', 0, 5, 20, 0, '2018-12-09 10:15:43', 0, 1),
(27, 'asdasdasdasd', '', 0, 5, 25, 1, '2018-12-09 10:16:01', 0, 0),
(28, 'sadasdasdasd', '', 0, 7, NULL, 1, '2018-12-09 10:50:58', 0, 1),
(29, 'czxczxczczczxczxczxczxc', '', 0, 7, NULL, 1, '2018-12-09 10:51:03', 0, 1),
(30, '#bolek', 'https://scontent-waw1-1.xx.fbcdn.net/v/t1.15752-9/47578419_2355163828104225_3838402926586363904_n.jpg?_nc_cat=105&_nc_ht=scontent-waw1-1.xx&oh=02106b63cd23141919c30be0e1ba5a95&oe=5CA1E8FE', 0, 7, NULL, 1, '2018-12-09 14:51:37', 0, 0),
(31, NULL, NULL, 0, 7, NULL, 1, '2018-12-09 15:26:21', 0, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `post_tag`
--

CREATE TABLE `post_tag` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `post_tag`
--

INSERT INTO `post_tag` (`post_id`, `tag_id`) VALUES
(1, 5),
(3, 6),
(4, 6),
(30, 7);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `report`
--

CREATE TABLE `report` (
  `id` int(10) NOT NULL,
  `post_id` int(10) NOT NULL,
  `destription` int(10) DEFAULT NULL,
  `violation_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tags`
--

CREATE TABLE `tags` (
  `id` int(10) NOT NULL,
  `tag` varchar(40) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `tags`
--

INSERT INTO `tags` (`id`, `tag`) VALUES
(1, '#halo'),
(2, '#kurwa'),
(3, '#brawo'),
(4, '#działa'),
(5, '#elo'),
(6, '#hari'),
(7, '#bolek');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `upvoted_posts`
--

CREATE TABLE `upvoted_posts` (
  `post_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `upvoted_posts`
--

INSERT INTO `upvoted_posts` (`post_id`, `user_id`) VALUES
(7, 7),
(8, 7),
(9, 7),
(11, 7),
(25, 7),
(30, 7);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(9) NOT NULL,
  `login` varchar(35) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_polish_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `image` varchar(60) COLLATE utf8_polish_ci DEFAULT 'anon.png',
  `about_me` text COLLATE utf8_polish_ci,
  `warned` int(2) NOT NULL DEFAULT '0',
  `create_account_data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `banned_form` timestamp NULL DEFAULT NULL,
  `banned_to` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `status`, `image`, `about_me`, `warned`, `create_account_data`, `banned_form`, `banned_to`) VALUES
(5, 'Anonim', 'anonim', 'anonim@anonim.anonim', 2, 'anon.png', 'I\'m Anonymous', 0, '2018-11-09 17:39:16', NULL, NULL),
(6, '123456', '$2y$11$EnnS4Q4.Goz7Ps7UWxbQS.jIfdp7mnjWZhtgFkywCLYFwLsM8aZZ2', 'nosaczita@nos.nos', 0, 'anon.png', NULL, 0, '2018-11-09 17:39:16', NULL, NULL),
(7, '111111', '$2y$11$EqpGezwwQ1LHIDzUuN0cje1Oi.gMOTyh4A549AIGHOnfCxc7Yqs.C', '1@1.1', 3, 'anon.png', NULL, 0, '2018-11-09 17:39:16', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `violationtypes`
--

CREATE TABLE `violationtypes` (
  `id` int(10) NOT NULL,
  `description` varchar(100) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `violationtypes`
--

INSERT INTO `violationtypes` (`id`, `description`) VALUES
(1, 'Obraza uczuć religijnych'),
(2, 'Inne');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `ban_cancellation`
--
ALTER TABLE `ban_cancellation`
  ADD PRIMARY KEY (`id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `liked_posts`
--
ALTER TABLE `liked_posts`
  ADD PRIMARY KEY (`post_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `observed_tags`
--
ALTER TABLE `observed_tags`
  ADD PRIMARY KEY (`user_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indeksy dla tabeli `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `posts_ibfk_1` (`post_id`);

--
-- Indeksy dla tabeli `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`post_id`,`tag_id`),
  ADD KEY `post_tag_ibfk_3` (`tag_id`);

--
-- Indeksy dla tabeli `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`,`post_id`,`violation_id`,`user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `violation_id` (`violation_id`),
  ADD KEY `report_ibfk_3` (`post_id`);

--
-- Indeksy dla tabeli `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `upvoted_posts`
--
ALTER TABLE `upvoted_posts`
  ADD PRIMARY KEY (`post_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Indeksy dla tabeli `violationtypes`
--
ALTER TABLE `violationtypes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `ban_cancellation`
--
ALTER TABLE `ban_cancellation`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT dla tabeli `report`
--
ALTER TABLE `report`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `violationtypes`
--
ALTER TABLE `violationtypes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `ban_cancellation`
--
ALTER TABLE `ban_cancellation`
  ADD CONSTRAINT `ban_cancellation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `liked_posts`
--
ALTER TABLE `liked_posts`
  ADD CONSTRAINT `liked_posts_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `liked_posts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `observed_tags`
--
ALTER TABLE `observed_tags`
  ADD CONSTRAINT `observed_tags_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `observed_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

--
-- Ograniczenia dla tabeli `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `post_tag_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_tag_ibfk_3` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE NO ACTION;

--
-- Ograniczenia dla tabeli `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `report_ibfk_3` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `report_ibfk_4` FOREIGN KEY (`violation_id`) REFERENCES `violationtypes` (`id`);

--
-- Ograniczenia dla tabeli `upvoted_posts`
--
ALTER TABLE `upvoted_posts`
  ADD CONSTRAINT `upvoted_posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `upvoted_posts_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
