DELIMITER //

CREATE PROCEDURE raccoonxpress.`sp_authLogin`
(
    IN p_username VARCHAR(32), 
    IN p_user_password VARCHAR(32)
)
BEGIN
DECLARE found_user BOOLEAN DEFAULT FALSE;
	SELECT EXISTS
    (
		SELECT username FROM raccoonxpress.users
		WHERE username COLLATE utf8mb4_bin = p_username
		AND user_password COLLATE utf8mb4_bin = p_user_password
	) INTO found_user;
    SELECT found_user;
END;//

DELIMITER ;