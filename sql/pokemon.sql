SELECT * 
FROM pokemon
WHERE is_default = 1 
and LCASE(identifier) like LCASE(:name)