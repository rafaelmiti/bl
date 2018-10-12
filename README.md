# Baixar e rodar a imagem docker

`docker pull richarvey/nginx-php-fpm:latest`
`docker run -d -p 8000:80 -e 'WEBROOT=/var/www/html/public/' -v </path/to/project>:/var/www/html richarvey/nginx-php-fpm`

# Acessar via bash o container e rodar os testes unitários

`docker ps`
`docker exec -it <container_id> bash`
`php composer.phar install`
`./phpunit --bootstrap vendor/autoload.php tests`

# Acessar a aplicação via interface

`http://localhost:8000/`

# Rotas

`http://localhost:8000/?r=/cpf/{cpf}` (consulta de CPF)
