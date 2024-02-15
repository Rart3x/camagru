CREATE TABLE Users(
    userId INT PRIMARY KEY,
    userName VARCHAR(255) NOT NULL,
    userGallery BLOB,
    userMail VARCHAR(255) NOT NULL,
    userPass VARCHAR(255) NOT NULL,
    notifOn BOOLEAN DEFAULT FALSE,
    linkValidated BOOLEAN DEFAULT FALSE
);

CREATE TABLE Posts(
    postId INT PRIMARY KEY,
    postName VARCHAR(255) NOT NULL,
    postLikes INT DEFAULT  0,
    postComments TEXT
);

CREATE TABLE Images(
    imageId INT PRIMARY KEY,
    imageName VARCHAR(255) NOT NULL,
    imageDate DATE NOT NULL,
    imageLikes INT DEFAULT  0,
    imageComment TEXT
);

CREATE TABLE Comments(
    commentId INT PRIMARY KEY,
    imageId INT,
    postId INT,
    commentText TEXT NOT NULL,
    FOREIGN KEY (imageId) REFERENCES Images(imageId),
    FOREIGN KEY (postId) REFERENCES Posts(postId)
);