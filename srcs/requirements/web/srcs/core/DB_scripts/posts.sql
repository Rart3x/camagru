CREATE TABLE Posts(
    postId INT PRIMARY KEY,
    postName VARCHAR(255) NOT NULL,
    postLikes INT DEFAULT   0,
    postComments TEXT
);