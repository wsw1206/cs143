SELECT CONCAT(first,' ', last)
FROM Movie as M, Actor as A, MovieActor as MA
WHERE M.id = MA.mid AND
    MA.aid = A.id AND
    M.title = "Die Another Day";

SELECT CONCAT(first, ' ', last)
FROM Actor
JOIN MovieActor ON Actor.id = MovieActor.aid
JOIN Movie on MovieActor.mid = Movie.id
WHERE Movie.title = 'Die Another Day';

SELECT DISTINCT first, last
FROM Actor
WHERE id IN (
SELECT aid
FROM MovieActor
WHERE mid IN (
SELECT DISTINCT id
FROM Movie
WHERE title="Die Another Day")
);

-- -------------------------------------------
SELECT COUNT(*)
FROM (SELECT COUNT(*) as n
FROM MovieActor GROUP BY aid
) AS counts
WHERE n>1;

SELECT COUNT(*)
FROM (
SELECT Actor.id
FROM Actor
JOIN MovieActor ON Actor.id = MovieActor.aid
GROUP BY Actor.id
HAVING COUNT(MovieActor.aid) > 1
) as tmp;
-- -----------------------------
SELECT COUNT(*)
FROM (
SELECT Actor.id
FROM Actor
JOIN Director on Actor.id = Director.id
JOIN MovieActor on Actor.id = MovieActor.aid
JOIN MovieDirector on Director.id = MovieDirector.did
WHERE MovieActor.mid = MovieDirector.mid
GROUP BY Actor.id
) as tmp;

SELECT COUNT(*)
FROM (
SELECT Director.id
FROM Director
JOIN MovieActor on Director.id = MovieActor.aid
JOIN MovieDirector on Director.id = MovieDirector.did
WHERE MovieActor.mid = MovieDirector.mid
GROUP BY Director.id
) as tmp



