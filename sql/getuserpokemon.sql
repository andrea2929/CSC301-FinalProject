SELECT *, up.id as bridge_id
FROM user_pokemon up JOIN pokemon p ON up.pokemon_id = p.id
WHERE up.user_id = :id
ORDER BY p.id, up.is_shiny