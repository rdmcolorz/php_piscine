select floor_number as 'floor', sum(nb_seats) as 'seats'
from db_tyang.cinema
group by floor_number
order by sum(nb_seats) desc;