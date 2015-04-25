CREATE TABLE Movie(
    id INT NOT NULL, -- (PK1) every movie has a unique identification number
    title VARCHAR(100),
    year INT,
    rating VARCHAR(10),
    company VARCHAR(50),
    CHECK (year > 0), -- (CHECK1) no movies made before jesus was born
    PRIMARY KEY(id))
ENGINE = INNODB;

CREATE TABLE Actor(
    id INT NOT NULL,
    last VARCHAR(20),
    first VARCHAR(20),
    sex VARCHAR(6),
    dob DATE,
    dod DATE,
    CHECK(sex = "male" OR sex = "female"),
    PRIMARY KEY(id)
)
ENGINE = INNODB;

CREATE TABLE Director(
    id INT NOT NULL,
    last VARCHAR(20),
    first VARCHAR(20),
    dob DATE,
    dod DATE,
    PRIMARY KEY(id)
)
ENGINE = INNODB;

CREATE TABLE MovieGenre(
    mid INT NOT NULL,  -- NOT NULL not the same
    genre VARCHAR(20),
    FOREIGN KEY(mid) references Movie(id)
)
ENGINE = INNODB;

CREATE TABLE MovieDirector(
    mid INT,
    did INT,
    FOREIGN KEY(mid) REFERENCES Movie(id),
    FOREIGN KEY(did) REFERENCES Director(id)
)
ENGINE = INNODB;

CREATE TABLE MovieActor(
mid INT,
aid INT,
role VARCHAR(50),
FOREIGN KEY(mid) REFERENCES Movie(id),
FOREIGN KEY(aid) REFERENCES Actor(id)
)
ENGINE = INNODB;

CREATE TABLE Review(
    name VARCHAR(20),
    time TIMESTAMP,
    mid INT,
    rating INT,
    comment VARCHAR(500),
    FOREIGN KEY (mid) REFERENCES Movie(id)
)
ENGINE = INNODB;

CREATE TABLE MaxPersonID(
    id INT
)
ENGINE = INNODB;

CREATE TABLE MaxMovieID(
    id INT
)
ENGINE = INNODB;