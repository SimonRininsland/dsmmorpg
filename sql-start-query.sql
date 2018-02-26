CREATE TABLE `user` (`id` INT NOT NULL , PRIMARY KEY (`id`));
ALTER TABLE `user` ADD `username` VARCHAR(40) NOT NULL AFTER `id`, ADD `password` VARCHAR(100) NOT NULL AFTER `username`, ADD `email` VARCHAR(40) NOT NULL AFTER `password`,  ADD `session` VARCHAR(50) NOT NULL AFTER `email`;
ALTER TABLE `user` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `user` ADD UNIQUE(`username`);
ALTER TABLE `user` ADD UNIQUE(`session`);
ALTER TABLE `user` ADD UNIQUE(`email`);
CREATE TABLE `characters` ( `cid` INT(10) NOT NULL AUTO_INCREMENT , `uid` INT(10) NOT NULL , `name` VARCHAR(20) NOT NULL , `type` INT(10) NOT NULL , PRIMARY KEY (`cid`)) ENGINE = InnoDB;
