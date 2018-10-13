## Baixar e rodar a imagem docker

- Extrair o projeto para uma pasta
- `docker pull richarvey/nginx-php-fpm:latest`
- `docker run -d -p 8000:80 -e 'WEBROOT=/var/www/html/public/' -v </path/to/extracted/project>:/var/www/html richarvey/nginx-php-fpm`

## Acessar via bash o container e rodar os testes unitários

- `docker ps`
- `docker exec -it <container_id> bash`
- `php composer.phar install`
- `./phpunit --bootstrap vendor/autoload.php tests`

## Acessar a aplicação via interface

- `http://localhost:8000`

## Rotas

- `GET http://localhost:8000/?r=/status`
(Rota de suporte)
- `GET http://localhost:8000/?r=/cpf/{cpf}` (Consulta de CPF)
- `POST http://localhost:8000/?r=/cpf/block` (Bloqueio de CPF)
  - Body: `x-www-form-urlencoded`. Ex: `cpf=48809715020`
- `POST http://localhost:8000/?r=/cpf/free` (Liberação de CPF)
  - Body: `x-www-form-urlencoded`. Ex: `cpf=48809715020`

## Dependências

- `miti/lib`: para validação de CPF

## Estrutura

- `public`: arquivos públicos como: html, css e js;
- `src`: arquivos das camadas da aplicação;
- `tests`: testes unitários (utilização de TDD como pode ser conferido pelo histórico de commits)
- `vendor`: arquivos de dependências e autoload (após instalação do `composer`);
