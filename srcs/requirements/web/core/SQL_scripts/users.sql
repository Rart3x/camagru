CREATE TABLE Users(
    userId INT PRIMARY KEY,
    userName VARCHAR(255) NOT NULL,
    userGallery BLOB,
    userMail VARCHAR(255) NOT NULL,
    userPass VARCHAR(255) NOT NULL,
    notifOn BOOLEAN DEFAULT FALSE,
    linkValidated BOOLEAN DEFAULT FALSE
);