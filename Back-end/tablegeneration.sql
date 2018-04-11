CREATE TABLE IF NOT EXISTS RottenPotatoes.ARTISTS (
  ID INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(45) NOT NULL,
  genre_ID INT NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY(genre_ID) REFERENCES GENRES(ID))
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS RottenPotatoes.GENRES (
  ID INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(45) NOT NULL
  PRIMARY KEY (ID))
  Engine = InnoDB;

CREATE TABLE IF NOT EXISTS RottenPotatoes.ALBUMS (
  ID INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(45) NOT NULL
  album_artwork VARCHAR(45),
  artist_ID INT NOT NULL,
  genre_ID INT NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY(artist_ID) REFERENCES ARTISTS(ID)
  FOREIGN KEY(genre_ID) REFERENCES GENRES(ID))
  Engine = InnoDB;

CREATE TABLE IF NOT EXISTS RottenPotatoes.SONGS (
  ID INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(45) NOT NULL
  length INT NOT NULL,
  album_ID INT NOT NULL,
  artists_ID INT NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY(album_ID) REFERENCES ALBUMS(ID),
  FOREIGN KEY(artists_ID) REFERENCES ARTISTS(ID))
  Engine = InnoDB;

CREATE TABLE IF NOT EXISTS RottenPotatoes.USERS (
  ID INT NOT NULL AUTO_INCREMENT,
  admin TINYINT DEFAULT 0,
  firstname VARCHAR(45),
  lastname VARCHAR(45),
  email VARCHAR(45) NOT NULL,
  username VARCHAR(45) NOT NULL,
  password VARCHAR(45) NOT NULL,
  PRIMARY KEY (ID))
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS RottenPotatoes.REVIEWS (
  ID INT NOT NULL AUTO_INCREMENT,
  review_text VARCHAR(45) NOT NULL,
  user_ID INT NOT NULL,
  album_ID INT NOT NULL,
  rating INT,
  PRIMARY KEY (ID),
  FOREIGN KEY(user_ID) REFERENCES USERS(ID),
  FOREIGN KEY(album_ID) REFERENCES ALBUMS(ID))
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS RottenPotatoes.STORES (
  ID INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(45) NOT NULL,
  icon VARCHAR(45),
  PRIMARY KEY (ID))
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS RottenPotatoes.LINKS (
  ID INT NOT NULL AUTO_INCREMENT,
  link VARCHAR(45) NOT NULL,
  store_ID INT NOT NULL,
  album_ID INT NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY(store_ID) REFERENCES STORES(ID),
  FOREIGN KEY(album_ID) REFERENCES ALBUMS(ID))
  ENGINE = InnoDB;
