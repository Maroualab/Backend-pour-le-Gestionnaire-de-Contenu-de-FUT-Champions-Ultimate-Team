CREATE DATABASE Fut_Champions;

USE Fut_Champions; 

CREATE TABLE player_stats (
    statsID INT AUTO_INCREMENT PRIMARY KEY,
    pace INT NOT NULL,
    shooting INT NOT NULL,
    passing INT NOT NULL,
    dribbling INT NOT NULL,
    defending INT NOT NULL,
    physical INT NOT NULL
);

CREATE TABLE goalkeeper_stats (
    statsID INT AUTO_INCREMENT PRIMARY KEY,
    diving INT NOT NULL,
    handling INT NOT NULL,
    kicking INT NOT NULL,
    reflexes INT NOT NULL,
    speed INT NOT NULL,
    positioning INT NOT NULL
);


CREATE TABLE players (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    photo TEXT NOT NULL,
    position VARCHAR(50) NOT NULL,
    nationality VARCHAR(100) NOT NULL,
    flag TEXT NOT NULL,
    club VARCHAR(255) NOT NULL,
    logo TEXT NOT NULL,
    rating INT NOT NULL,
    statsID INT NOT NULL,
    statsType VARCHAR(50) CHECK (statsType IN ('player', 'goalkeeper')),
);


ALTER table players
ADD CONSTRAINT FOREIGN KEY (statsID) REFERENCES  player_stats(statsID);


ALTER table players
ADD CONSTRAINT FOREIGN KEY (statsID) REFERENCES  goalkeeper_stats(statsID);
