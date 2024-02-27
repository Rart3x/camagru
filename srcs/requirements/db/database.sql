CREATE TABLE Posts(
    postId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    postName VARCHAR(255) NOT NULL,
    postLikes INT DEFAULT  0,

    userId INT,

    postComments INT
);

CREATE TABLE Users(
    userId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    userName VARCHAR(255) NOT NULL,
    userMail VARCHAR(255) NOT NULL,
    userPass VARCHAR(255) NOT NULL,

    notifOn BOOLEAN DEFAULT FALSE,
    
    linkValidated BOOLEAN DEFAULT FALSE
);

CREATE TABLE UserSessions(
    userSessionId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    userId INT,
    
    userSession VARCHAR(255) NOT NULL,
    userAgent VARCHAR(255) NOT NULL,

    FOREIGN KEY (userId) REFERENCES Users(userId)
);

CREATE TABLE Comments(
    commentId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    commentText TEXT NOT NULL,
    
    postId INT,
    userId INT, 

    FOREIGN KEY (postId) REFERENCES Posts(postId),
    FOREIGN KEY (userId) REFERENCES Users(userId)
);

CREATE TABLE PostComments (
    postId INT, 
    commentID INT,

    PRIMARY KEY (postId, commentId),

    FOREIGN KEY (postId) REFERENCES Posts(postId),
    FOREIGN KEY (commentId) REFERENCES Comments(commentId)
);

CREATE TABLE Images(
    imageId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    imageName VARCHAR(255) NOT NULL,
    imageDate DATE NOT NULL,
    imageLikes INT DEFAULT  0,
    
    userId INT,

    FOREIGN KEY (userId) REFERENCES Users(userId)
);


CREATE TABLE CommentImages (
    imageId INT, 
    commentID INT,

    PRIMARY KEY (imageId, commentId),

    FOREIGN KEY (imageId) REFERENCES Images(imageId),
    FOREIGN KEY (commentId) REFERENCES Comments(commentId)
);