CREATE TABLE Images(
    imageId INT PRIMARY KEY,
    imageName VARCHAR(255) NOT NULL,
    imageDate DATE NOT NULL,
    imageLikes INT DEFAULT  0,
    imageComment TEXT
);