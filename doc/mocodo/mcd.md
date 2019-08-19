tag : id, name, created_at, updated_at
have, 0N tag, 1N question
havee, 0N question, 11 response

question : id, title, content, nb_likes, created_at, updated_at
reply, 0N user, 11 response
response : id, content, nb_likes, created_at, updated_at

ask, 0N user, 11 question
user : id, username, password, email

role : name, code
haave, 11 user, 0N role
