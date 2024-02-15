CREATE TABLE Comments(
    commentId INT PRIMARY KEY,
    imageId INT,
    postId INT,
    commentText TEXT NOT NULL,
    FOREIGN KEY (imageId) REFERENCES Images(imageId),
    FOREIGN KEY (postId) REFERENCES Posts(postId)
);