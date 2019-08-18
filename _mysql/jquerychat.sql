SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_id` varchar(255) NOT NULL DEFAULT '',
  `to_id` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `sent` bigint(19) NOT NULL,
  `recd` int(10) unsigned NOT NULL DEFAULT '0',
  `system_message` varchar(3) DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `typing` (
  `typing_from` int(11) NOT NULL,
  `typing_to` int(11) NOT NULL,
  `typing_ornot` int(11) NOT NULL,
  UNIQUE KEY `typing_from` (`typing_from`,`typing_to`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `chat_status` varchar(255) DEFAULT 'offline',
  `offlineshift` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;


INSERT INTO `users` (`id`, `username`, `chat_status`,`offlineshift`) VALUES
(1, 'John', 'offline','0'),
(2, 'Elizabeth', 'offline','0'),
(3, 'Joseph', 'offline','0'),
(4, 'Martin', 'offline','0'),
(5, 'Steve', 'offline','0'),
(6, 'Nicolet', 'offline','0');
