DELIMITER //

CREATE PROCEDURE raccoonxpress.`sp_register`
(
    
)
BEGIN
-- DECLARE found_user BOOLEAN DEFAULT FALSE;
	SELECT EXISTS
    (
		SELECT username FROM raccoonxpress.users
		WHERE username COLLATE utf8mb4_bin = p_Username
		AND user_password COLLATE utf8mb4_bin = p_User_pass
	) INTO found_user;
    SELECT found_user;
END;//

DELIMITER ;