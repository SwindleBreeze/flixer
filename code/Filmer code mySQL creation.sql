/* TESTING PURPOUSES */


CREATE TABLE Uporabnik(
idUporabnik INT NOT NULL AUTO_INCREMENT,
username VARCHAR(50) NOT NULL,
email VARCHAR(50) NOT NULL,
password VARCHAR(45) NOT NULL,
PASS_HASH VARCHAR(200) NOT NULL,
PRIMARY KEY(idUporabnik)
);

CREATE TABLE Movie(
idMovie INT NOT NULL,
MovieTitle VARCHAR(45) NOT NULL,
MovieGenre VARCHAR(45) NOT NULL,
Summary VARCHAR(500) NOT NULL,
PRIMARY KEY(idMovie)
);

CREATE TABLE LikedMovies(
idUporabnik INT NOT NULL,
idMovie INT NOT NULL,
FOREIGN KEY(idUporabnik) REFERENCES Uporabnik(idUporabnik),
FOREIGN KEY(idMovie) REFERENCES Movie(idMovie)
);
----------------------------------------------------------------------------------------------
ALTER TABLE Uporabnik
ADD password VARCHAR(45) NOT NULL;

ALTER TABLE Uporabnik
ADD PASS_HASH VARCHAR(200) NOT NULL;

ALTER TABLE MatchedMovies
ADD CHK_Key VARCHAR(200);

ALTER TABLE LikedMovies
ADD AddDate DATETIME NOT NULL;


SELECT * FROM LikedMovies WHERE(idMovie='524047' AND CHK_Key='g5i7579be6')

CREATE TABLE MatchedMovies(
idUporabnik INT NOT NULL,
idMovie INT NOT NULL,
FOREIGN KEY(idUporabnik) REFERENCES Uporabnik(idUporabnik),
FOREIGN KEY(idMovie) REFERENCES Movie(idMovie)
);


DELETE FROM LikedMovies WHERE (idUporabnik='$userID' AND CHK_Key='$key' AND (DATEDIFF(MI,AddDate,NOW())>1))