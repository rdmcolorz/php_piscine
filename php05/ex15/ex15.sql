select left(reverse(phone_number), char_length(phone_number) -1) as 'rebmunenohp'
from db_tyang.distrib
where phone_number like "05%";