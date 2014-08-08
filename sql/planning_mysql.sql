# 1. No check for creation
SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `planning_config` (
  `cle` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `valeur` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `commentaire` text COLLATE latin1_general_ci,
  PRIMARY KEY (`cle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `planning_config` VALUES('CURRENT_VERSION', '1.32', 'Internal key for auto upgrade control');
INSERT INTO `planning_config` VALUES('PLANNING_PAGES', '1,5,10,20,50,100', 'rows per page in the planning');
INSERT INTO `planning_config` VALUES('PROJECT_COLORS_POSSIBLE', '', 'color choice limitation for planner (empty for no limit). Exemple :#ff0000,#aa8811,#446622');
INSERT INTO `planning_config` VALUES('DEFAULT_NB_MONTHS_DISPLAYED', '2', 'Default number of months displayed in the planning');
INSERT INTO `planning_config` VALUES('DEFAULT_NB_ROWS_DISPLAYED', '100', 'Default number of rows displayed in the planning');
INSERT INTO `planning_config` VALUES('DEFAULT_NB_PAST_DAYS', '5', 'Default number of past days to display in the planning');
INSERT INTO `planning_config` VALUES('REFRESH_TIMER', '600', 'refresh time for the planning page (time in second)');
INSERT INTO `planning_config` VALUES('LOGOUT_REDIRECT', '', 'Optional redirect url after logout (for exemple to return on your own intranet). ex : http://www.google.com');
INSERT INTO `planning_config` VALUES('DEFAULT_PERIOD_LINK', '', 'Default value for link in a period');
INSERT INTO `planning_config` VALUES('PLANNING_ONE_ASSIGNMENT_MAX_PER_DAY', '0', 'Option to display only one assignment/task per cell/day in the planning (put "1" to activite this option)');
INSERT INTO `planning_config` VALUES('DAYS_INCLUDED', '1,2,3,4,5', 'Define the days included to count duration. IMPORTANT : 0=sunday, 1=monday, 2=tuesday, 3=wenesday, 4=thursday, 5=friday, 6=saturday');
INSERT INTO `planning_config` VALUES('PLANNING_LINE_HEIGHT', '', 'Default line height in the planning. If not specified, it fits the username height');
INSERT INTO `planning_config` VALUES('SOPLANNING_TITLE', 'SOPlanning', 'Change the title of Soplanning for integration in extranet');
INSERT INTO `planning_config` VALUES('SMTP_HOST', 'localhost', '');
INSERT INTO `planning_config` VALUES('SMTP_PORT', '', '');
INSERT INTO `planning_config` VALUES('SMTP_FROM', 'notification@yourdomain.com', '');
INSERT INTO `planning_config` VALUES('SMTP_LOGIN', '', '');
INSERT INTO `planning_config` VALUES('SMTP_PASSWORD', '', '');
INSERT INTO `planning_config` VALUES('SMTP_SECURE', '', '');
INSERT INTO `planning_config` VALUES('SOPLANNING_URL', '', 'Your SOPlanning instance url, to be able to send email with links');
INSERT INTO `planning_config` VALUES('SECURE_KEY', MD5(RAND()), 'String used only for security matters');
INSERT INTO `planning_config` VALUES('PLANNING_REPEAT_HEADER', 0, 'If > 0, repeat header (days/months) in the planning each x lines');
INSERT INTO `planning_config` VALUES('DURATION_AM', '4', 'Morning duration when calculating worked hours');
INSERT INTO `planning_config` VALUES('DURATION_PM', '5', 'Afternoon duration when calculating worked hours');
INSERT INTO `planning_config` VALUES('DURATION_DAY', '9', 'Duration when only one day is selected');
INSERT INTO `planning_config` VALUES('CONTACT_FORM_DEACTIVATE', '', 'Put 1 to deactivate the display of the small button/popin (contact form)');
INSERT INTO `planning_config` VALUES('HOURS_DISPLAYED', '8,9,10,11,14,15,16,17', 'List of hours displayed in the day view');
INSERT INTO `planning_config` VALUES('DEFAULT_NB_DAYS_DISPLAYED', '2', 'Default number of days displayed in the planning view by day');


# 2. Tables creation
CREATE TABLE `planning_ferie` (
  `date_ferie` date NOT NULL default '0000-00-00',
  `libelle` varchar(50) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`date_ferie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

CREATE TABLE `planning_groupe` (
  `groupe_id` int(11) NOT NULL,
  `nom` varchar(30) collate latin1_general_ci NOT NULL,
  `ordre` int(11) default NULL,
  PRIMARY KEY  (`groupe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

CREATE TABLE `planning_projet` (
  `projet_id` varchar(10) collate latin1_general_ci NOT NULL default '',
  `nom` varchar(30) collate latin1_general_ci NOT NULL default '',
  `iteration` varchar(255) collate latin1_general_ci default NULL,
  `couleur` varchar(6) collate latin1_general_ci NOT NULL default '',
  `charge` float default NULL,
  `livraison` DATE NULL DEFAULT NULL,
  `statut` enum('a_faire','en_cours','fait','abandon') collate latin1_general_ci NOT NULL default 'a_faire',
  `groupe_id` int(11) default NULL,
  `createur_id` varchar(10) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`projet_id`),
  KEY `groupe_id` (`groupe_id`),
  CONSTRAINT `planning_projet_ibfk_1` FOREIGN KEY (`groupe_id`) REFERENCES `planning_groupe` (`groupe_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

CREATE TABLE `planning_user` (
  `user_id` varchar(10) collate latin1_general_ci NOT NULL default '',
  `user_groupe_id` int(11) NULL,
  `nom` varchar(50) collate latin1_general_ci NOT NULL default '',
  `login` varchar(20) collate latin1_general_ci default NULL,
  `password` varchar(50) collate latin1_general_ci default NULL,
  `email` varchar(255) collate latin1_general_ci default NULL,
  `visible_planning` enum('oui','non') collate latin1_general_ci NOT NULL default 'oui',
  `couleur` VARCHAR( 6 ) NULL,
  `droits` text default NULL,
  `cle` VARCHAR(40) NOT NULL default '',
  `notifications` enum('oui','non') collate latin1_general_ci NOT NULL default 'non',
  PRIMARY KEY  (`user_id`),
  KEY `user_groupe_id` (`user_groupe_id`),
  CONSTRAINT `planning_user_ibfk_1` FOREIGN KEY (`user_groupe_id`) REFERENCES `planning_user_groupe` (`user_groupe_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

CREATE TABLE `planning_periode` (
  `periode_id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) NULL,
  `projet_id` varchar(10) collate latin1_general_ci NOT NULL default '',
  `user_id` varchar(10) collate latin1_general_ci NOT NULL default '0',
  `date_debut` date NOT NULL default '0000-00-00',
  `date_fin` date default NULL,
  `duree` time default NULL,
  `duree_details` varchar(20) collate latin1_general_ci default NULL,
  `titre` varchar(255) collate latin1_general_ci default NULL,
  `notes` text default NULL,
  `lien` text default NULL,
  `statut_tache` enum('a_faire','en_cours','fait','abandon') collate latin1_general_ci NOT NULL default 'a_faire',
  `livrable` enum('oui','non') collate latin1_general_ci NOT NULL default 'non',
  `createur_id` varchar(10) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`periode_id`),
  KEY `projet_id` (`projet_id`),
  KEY `user_id` (`user_id`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `planning_periode_ibfk_1` FOREIGN KEY (`projet_id`) REFERENCES `planning_projet` (`projet_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `planning_periode_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `planning_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

CREATE TABLE IF NOT EXISTS `planning_user_groupe` (
  `user_groupe_id` int(11) NOT NULL,
  `nom` varchar(150) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`user_groupe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


INSERT INTO `planning_groupe` VALUES ('1', 'Production', null);
INSERT INTO `planning_groupe` VALUES ('2', 'Web', null);
INSERT INTO `planning_groupe` VALUES ('3', 'Mobile', null);
INSERT INTO `planning_user` VALUES ('ADM', null, 'admin', 'admin', 'df5b909019c9b1659e86e0d6bf8da81d6fa3499e', null, 'oui', '000000', '["users_manage_all", "projects_manage_all", "projectgroups_manage_all", "tasks_modify_all", "tasks_view_all_projects", "parameters_all"]', MD5(RAND()), 'non');
