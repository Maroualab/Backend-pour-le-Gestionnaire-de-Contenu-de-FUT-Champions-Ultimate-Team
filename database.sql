--create a database 
CREATE DATABASE fut_champions

--use database
USE fut_champions

--create table players 
CREATE TABLE players(
    playerID  INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL , 
    photo TEXT NOT NULL , 
    position VARCHAR (50), 
    rating INT NOT NULL , 
    pace INT NOT NULL , 
    shooting INT NOT NULL , 
    passing INT NOT NULL, 
    dribbling INT NOT NULL, 
    defending INT NOT NULL, 
    physical INT NOT NULL, 
    teamID INT NOT NULL , 
    nationalityID INT NOT NULL
);

--create table nationalities 
CREATE TABLE nationalities(
    nationalityID INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL  , 
    flag TEXT NOT NULL 
    );

--create table teams 
CREATE TABLE teams (
    teamID INT AUTO_INCREMENT PRIMARY KEY, 
    name VARCHAR(255) NOT NULL , 
    logo TEXT NOT NULL

);

--add foreign key to players to link to teams table
ALTER TABLE players
ADD CONSTRAINT fk_playerTeam
FOREIGN KEY (teamID) REFERENCES teams(teamID);

--add foreign key to players to link to nationalities table
ALTER TABLE players
ADD CONSTRAINT fk_playerNationality
FOREIGN KEY (nationalityID) REFERENCES nationalities(nationalityID);

ALTER TABLE players
DROP CONSTRAINT fk_playerNationality;

ALTER TABLE players MODIFY nationalityID INT NULL;

ALTER TABLE players 
ADD CONSTRAINT fk_nationID FOREIGN KEY (nationalityID) REFERENCES nationalities(nationalityID) ON DELETE SET NULL;

ALTER table players 
DROP CONSTRAINT fk_playerTeam;

ALTER TABLE players MODIFY teamID INT NULL;

ALTER TABLE players 
ADD CONSTRAINT fk_teamId FOREIGN KEY (teamID) REFERENCES teams(teamID) ON DELETE SET NULL;