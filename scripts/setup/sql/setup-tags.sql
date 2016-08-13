/**
 * tags information
 */

UPDATE `software_portal`.`vos_packages` SET `tag` = 'devel' WHERE `vos_packages`.`section` = 'libdevel';
UPDATE `software_portal`.`vos_packages` SET `tag` = 'fonts' WHERE `vos_packages`.`section` ='fonts';
UPDATE `software_portal`.`vos_packages` SET `tag` = 'games' WHERE `vos_packages`.`section` = 'games';
UPDATE `software_portal`.`vos_packages` SET `tag` = 'internet' WHERE `vos_packages`.`section` = 'web';
UPDATE `software_portal`.`vos_packages` SET `tag` = 'sound-video' WHERE `vos_packages`.`section` ='sound';
UPDATE `software_portal`.`vos_packages` SET `tag` = 'sound-video' WHERE `vos_packages`.`section` ='video';
UPDATE `software_portal`.`vos_packages` SET `tag` = 'themes' WHERE `vos_packages`.`section` = 'gnome';