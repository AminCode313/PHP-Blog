CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `cat_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 10,
  `image` text NOT NULL,
  `image_name` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(191) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(191) NOT NULL,
  `last_name` varchar(191) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `created_at`) VALUES (NULL, 'yourEmail@example.com', '$2y$10$eJ1aMHX6EadszG8nNgFmp.AUpII4CGUw/JLyyaFblStnxkwtoZ2RS', 'mohammad amin', 'forati', '2022-04-28 12:09:36.000000');

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES (NULL, 'Programming', '2022-04-28 12:12:34.000000', NULL), (NULL, 'Design', '2022-04-28 12:12:34.000000', NULL), (NULL, 'Aplication', '2022-04-28 12:12:34.000000', NULL);

INSERT INTO `posts` (`id`, `title`, `body`, `cat_id`, `status`, `image`, `image_name`, `created_at`, `updated_at`) VALUES (NULL, 'Lorem ipsom 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '1', '1', '/assets/images/posts/programming.jpg', '/assets/images/posts/programming.jpg', '2022-04-28 12:14:49.000000', NULL), (NULL, 'Lorem ipsom 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2', '1', '/assets/images/posts/design.jpg', '/assets/images/posts/design.jpg', '2022-04-28 12:14:49.000000', NULL), (NULL, 'Lorem ipsom 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '3', '1', '/assets/images/posts/aplication.jpg', '/assets/images/posts/aplication.jpg', '2022-04-28 12:14:49.000000', NULL);