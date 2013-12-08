CREATE TABLE `users` (
 `user_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
 `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name',
 `user_password_hash` char(60) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
 `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email',
 `user_active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s activation status',
 `user_activation_hash` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s email verification hash string',
 `user_password_reset_hash` char(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s password reset code',
 `user_password_reset_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the password reset request',
 `user_rememberme_token` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s remember-me cookie token',
 `user_registration_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
 `user_registration_ip` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
 PRIMARY KEY (`user_id`),
 UNIQUE KEY `user_name` (`user_name`),
 UNIQUE KEY `user_email` (`user_email`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

CREATE TABLE `Admins` (
 `admin_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing admin_id of each user, unique index',
 `admin_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name',
 `admin_password_hash` char(60) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
 `admin_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email',
 `admin_active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s activation status',
 `admin_activation_hash` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s email verification hash string',
 `admin_password_reset_hash` char(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s password reset code',
 `admin_password_reset_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the password reset request',
 `admin_rememberme_token` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s remember-me cookie token',
 `admin_registration_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
 `admin_registration_ip` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
 PRIMARY KEY (`admin_id`),
 UNIQUE KEY `admin_name` (`admin_name`),
 UNIQUE KEY `admin_email` (`admin_email`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

CREATE TABLE `Config` (
 `admin_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing admin_id of each user, unique index',
 `admin_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name',
 `admin_password_hash` char(60) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
 `admin_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email',
 `admin_active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s activation status',
 `admin_activation_hash` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s email verification hash string',
 `admin_password_reset_hash` char(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s password reset code',
 `admin_password_reset_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the password reset request',
 `admin_rememberme_token` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s remember-me cookie token',
 `admin_registration_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
 `admin_registration_ip` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
 PRIMARY KEY (`admin_id`),
 UNIQUE KEY `admin_name` (`admin_name`),
 UNIQUE KEY `admin_email` (`admin_email`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

CREATE TABLE IF NOT EXISTS Config (
    config_id int(5) NOT NULL AUTO_INCREMENT,
    install_date DATE DEFAULT NULL,
    server varchar(20) DEFAULT NULL,
    db_user varchar(250) DEFAULT NULL,
	db_pass varchar(250) DEFAULT NULL,
	db_name varchar(250) DEFAULT NULL,
    PRIMARY KEY(config_id)
    );