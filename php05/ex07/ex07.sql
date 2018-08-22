SELECT title, summary
FROM db_tyang.film
WHERE summary like "%42%" OR title LIKE "%42%"
ORDER BY duration;