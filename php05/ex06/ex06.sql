SELECT title, summary
FROM db_tyang.film
WHERE lower(summary) LIKE "%vincent%"
ORDER BY id_film;