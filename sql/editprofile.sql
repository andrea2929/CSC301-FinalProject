UPDATE user
SET password = :password, 
first_name = :first_name, 
last_name = :last_name, 
email = :email
WHERE id = :id