create database bookmarks;
use bookmarks;

CREATE TABLE `user` (
  `username` varchar(16) CHARACTER SET utf8 NOT NULL,
  `passwd` char(40) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

create table bookmark (
  id int(11) NOT NULL AUTO_INCREMENT,
  username varchar(16) CHARACTER SET utf8 NOT NULL,
  bm_URL varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  index (username),
  index (bm_URL)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

grant select, insert, update, delete
on bookmarks.*
to bm_user identified by 'password';
