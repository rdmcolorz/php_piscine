SELECT film.title AS `Title`, film.summary AS `Summary`, film.prod_year
FROM db_tyang.film
inner join genre on film.id_genre = genre.id_genre
WHERE genre.name = 'erotic'
ORDER BY prod_year DESC;
