# simple-bank-php
API RESTFul responsible for realize create accounts, deposit, withdraws and transfer amount between accounts. 

### Technologies

- PHP 8
- Laravel/Lumen
- Docker
- MySQL 5.7

### Configuration

Clone the project on your machine and after cloning create the `.env` in the `/src` directory based on the `.env.example`.

After that, run the command `docker-compose build` to build the imagens and right after `docker-compose up -d` to create and start the containers.

After that, run the command `docker-compose exec app_php php artisan migrate` to run the database migrations.

To configure swagger run the command `docker exec -it api_php php artisan swagger-lume:generate`.

Okay, now we have our system running at http://localhost:8000. :smile:

### Tests

  * Testes automatizados - Em desenvolvimento
  * Testes na plataforma adicionada - Em desenvolvimento

### Diagram of Architecture

The flow and architecture of the project was created based on a clean architecture adaptation as shown in the figure below.

![Simple Bank Php](https://user-images.githubusercontent.com/26749585/159628756-e15dea54-0000-47dd-b7ce-e8ad3ad52594.jpg)


### Diagram of Database

The relational project is structured according to the creation of four tables represented as follows:

![simple_bank_php@localhost](https://user-images.githubusercontent.com/26749585/159618055-82711913-4f06-41de-9b69-cf0991130175.png)

### Documentation

The documentation of the endpoints of this API can be seen either using the port http://localhost:8000 or accessing Swagger web:
[Swagger Hub - API](https://app.swaggerhub.com/apis-docs/carlos12antoni/SimpleBankPhp/1.0.0).

### References

- [Docker](https://docs.docker.com/)
- [Lumen](https://lumen.laravel.com/docs/9.x)
