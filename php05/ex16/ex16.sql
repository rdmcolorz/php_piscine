select count(id_film) as 'movies'
from db_tyang.member_history
where date(date) between '2006-10-30' AND '2007-7-27' or (month(date) = 12 and day(date) = 24);