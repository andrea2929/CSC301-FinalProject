SELECT *
FROM pokemon_stats ps JOIN stats s ON ps.stat_id = s.id
WHERE pokemon_id = :id