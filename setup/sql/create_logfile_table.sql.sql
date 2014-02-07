CREATE TABLE `app_logfile` (
  `log_id` int(11) NOT NULL auto_increment,
  `log_dt` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `priority` varchar(100) NOT NULL,
  `log_message` mediumtext NOT NULL,
  PRIMARY KEY  (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1
