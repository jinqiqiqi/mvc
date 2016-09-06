-- create database robots;

-- 2016.09.06
-- init the currencies table
CREATE TABLE `currencies` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(15) NOT NULL,
  `rate` float NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
);