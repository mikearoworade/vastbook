--
-- Database: `vastbook`
--

--
-- Table Structure: `role`
--
CREATE TABLE `roles` (
    `id` INT(5) NOT NULL AUTO_INCREMENT,
    `rolename` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`id`)
);

INSERT INTO `roles` (`rolename`) VALUES
('admin'),
('user');


--
-- Table Structure: `users`
--
CREATE TABLE `users` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `firstname` VARCHAR(100) NOT NULL,
    `lastname` VARCHAR(100) NOT NULL,
    `username` VARCHAR(100) NOT NULL UNIQUE,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `phone` VARCHAR(25),
    `role_id` INT(5) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO `users` (`firstname`, `lastname`, `username`, `email`, `password`, `role_id`) VALUES
('Vastbook', 'Admin', 'admin', 'it.admin@vastbook.com', '$2y$10$gvn5.Wum5hiMVKzIpQ464.NJJrs2snwQls9HX4qFb7pfWXhLcez.K', 1),
('Test', 'User', 'test', 'test.user@vastbook.com', '$2y$10$gsSOOWkD60YPgngyUvaDiePq.vOJP1vRkTVsQKf68FO9byH95vjoO', 2);

--
-- Table Structure: `bookcategory`
--
CREATE TABLE `bookcategory` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `categoryname` VARCHAR(100) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE (`categoryname`)
);

INSERT INTO `bookcategory` (`categoryname`) VALUES
('Fiction'),
('Non-Fiction'),
('Science'),
('Technology'),
('Biography'),
('History');

CREATE TABLE `authors` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(100) NOT NULL,
    `last_name` VARCHAR(100) NOT NULL,
    `bio` TEXT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

CREATE TABLE `books` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `author_id` INT(11) NOT NULL,
    `isbn` VARCHAR(20) UNIQUE NOT NULL,
    `price` DECIMAL(10,2) NOT NULL,
    `published_date` DATE NOT NULL,
    `category_id` INT(11) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`author_id`) REFERENCES `authors`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`category_id`) REFERENCES `bookcategory`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

ALTER TABLE `books`
ADD COLUMN `times_loaded` INT(11) DEFAULT 0;

ALTER TABLE `users` ADD `image` VARCHAR(255) NULL AFTER `role_id`;

ALTER TABLE `authors` ADD `image` VARCHAR(255) NOT NULL AFTER `bio`;

ALTER TABLE `authors` ADD `email` INT(100) NOT NULL AFTER `last_name`, ADD UNIQUE (`email`);
ALTER TABLE `authors` CHANGE `email` `email` VARCHAR(100) NOT NULL;

ALTER TABLE authors
CHANGE first_name firstname VARCHAR(50) NOT NULL;

ALTER TABLE authors
CHANGE last_name lastname VARCHAR(50) NOT NULL;