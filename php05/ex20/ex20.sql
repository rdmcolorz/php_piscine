use db_tyang;
select genre.id_genre, genre.name as 'name_genre', distrib.id_distrib, distrib.name as 'name_distrib', film.title as 'title_film'
from film
inner join distrib on distrib.id_distrib = film.id_distrib
inner join genre on genre.id_genre = film.id_genre
where genre.id_genre between 4 and 8;