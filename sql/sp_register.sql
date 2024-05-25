DELIMITER //

CREATE PROCEDURE raccoonxpress.`sp_register`
(
	IN `username` varchar(32),
    IN `user_password` varchar(32),
    IN `email` varchar(64),
    IN `fullname` varchar(255),
    IN `birthdate` date,
    IN `genre` tinyint(1),
    IN `is_active` tinyint(1),
    IN `visibility` tinyint(1),
    IN `user_role` tinyint(1),
    IN `profile_image` blob
)
BEGIN
	INSERT INTO raccoonxpress.`users`
    (
    `username`,
    `user_password`,
    `email`,
    `fullname`,
    `birthdate`,
    `genre`,
    `is_active`,
    `visibility`,
    `user_role`,
    `profile_image`
    ) 
    VALUES 
    (
    username,
    user_password,
    email,
    fullname,
    birthdate,
    genre,
    is_active,
    visibility,
    user_role,
    profile_image
    );
END;//

DELIMITER ;