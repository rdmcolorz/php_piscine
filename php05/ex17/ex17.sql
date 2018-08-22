select count(name) as 'nb_susc', floor(AVG(price)) as 'av_susc', sum(mod(duration_sub, 42)) as 'ft'
from db_tyang.subscription;