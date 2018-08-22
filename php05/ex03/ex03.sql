INSERT INTO db_tyang.ft_table (login, `group`, creation_date)
SELECT last_name, 'other', birthdate 
FROM db_tyang.user_card
WHERE CHAR_LENGTH(last_name) < 9 AND last_name LIKE "%a%"
ORDER BY last_name asc
LIMIT 10;