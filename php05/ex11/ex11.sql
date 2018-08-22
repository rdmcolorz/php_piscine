SELECT upper(user_card.last_name) as `NAME`, user_card.first_name, subscription.price
FROM db_tyang.subscription
inner join member on subscription.id_sub = member.id_sub
inner join user_card on user_card.id_user = member.id_user_card
WHERE subscription.price > 42
ORDER BY user_card.last_name ASC, user_card.first_name ASC;
