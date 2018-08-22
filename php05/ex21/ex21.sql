select MD5(concat(replace(distrib.phone_number, '7', '9'), '42')) as 'ft5'
from db_tyang.distrib
where id_distrib = 84
