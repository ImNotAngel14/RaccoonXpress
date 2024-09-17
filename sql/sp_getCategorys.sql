DELIMITER //

CREATE PROCEDURE raccoonxpress.`sp_getCategorys`()
BEGIN
    SELECT c.`category_id`, c.`name`, c.`description`, u.user_id, u.username FROM `categorys` c
    INNER JOIN `users` u
    ON c.`user_id` = u.`user_id`;
END;//

DELIMITER ;