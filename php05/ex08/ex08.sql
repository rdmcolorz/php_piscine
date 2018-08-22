SELECT last_name, first_name, date(birthdate) as 'birthdate'
FROM db_tyang.user_card
WHERE year(birthdate) = 1989
ORDER BY last_name;