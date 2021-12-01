 CREATE TABLE `ibc_employee`
 (
     `ID` int(11) NOT NULL AUTO_INCREMENT,
     `NAME` varchar(30) COLLATE utf8_unicode_ci NULL,
     `DATE_RECEPT` date COLLATE utf8_unicode_ci NULL,
     `ID_POSITION` int(11) COLLATE utf8_unicode_ci NULL,
     PRIMARY KEY (`ID`)
 )
     ENGINE = InnoDB
     DEFAULT CHARSET = utf8
     COLLATE = utf8_unicode_ci;

 CREATE TABLE `ibc_position`
 (
     `ID` int(11) NOT NULL AUTO_INCREMENT,
     `NAME` varchar(30) COLLATE utf8_unicode_ci NULL,
     `TITLE` varchar(30) COLLATE utf8_unicode_ci NULL,
     PRIMARY KEY (`ID`)
 )
     ENGINE = InnoDB
     DEFAULT CHARSET = utf8
     COLLATE = utf8_unicode_ci;

-- CREATE TABLE `ibc_publisher`
-- (
--     `ID` int(11) NOT NULL AUTO_INCREMENT,
--     `TITLE` varchar(30) COLLATE utf8_unicode_ci NULL,
--     `CITY` varchar(30) COLLATE utf8_unicode_ci NULL,
--     `AUTHOR_PROFIT` int(11) COLLATE utf8_unicode_ci NULL,
--     PRIMARY KEY (`ID`)
-- )
--     ENGINE = InnoDB
--     DEFAULT CHARSET = utf8
--     COLLATE = utf8_unicode_ci;