CREATE DATABASE Adam200422676; 
USE Adam200422676;
DROP TABLE IF EXISTS `players`; 
CREATE TABLE `players` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar (100) NOT NULL,
  `profile_img` varchar (100) NOT NULL,
  `phone_number` char (10) NOT NULL,
  `position` varchar (100) NOT NULL,
  PRIMARY KEY (user_id)
);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar (255) NOT NULL,
  PRIMARY KEY (user_id)
);