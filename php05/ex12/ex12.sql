SELECT last_name, first_name 
FROM db_tyang.user_card
WHERE first_name like "%-%" OR last_name like "%-%"
ORDER BY last_name ASC, first_name ASC;