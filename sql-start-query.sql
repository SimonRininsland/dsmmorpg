CREATE TABLE `user` (`id` INT NOT NULL , PRIMARY KEY (`id`));
ALTER TABLE `user` ADD `username` VARCHAR(40) NOT NULL AFTER `id`, ADD `password` VARCHAR(40) NOT NULL AFTER `username`, ADD `email` VARCHAR(40) NOT NULL AFTER `password`;
ALTER TABLE `user` ADD UNIQUE(`id`);
ALTER TABLE `user` ADD UNIQUE(`username`);
ALTER TABLE `user` ADD UNIQUE(`email`);
ALTER TABLE `user` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;