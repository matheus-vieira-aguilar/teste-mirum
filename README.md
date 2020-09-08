# README - teste Mirum

Como levantar o docker configurado:

```jsx
docker-compose up -d --build
```

Como instalar dependências composer: 

```jsx
docker-compose run --rm php74-service composer install
```

Como criar o banco de dados necessário:

```jsx
docker-compose run --rm php74-service php bin/console doctrine:database:create
```

Executar migrations necessárias:

```jsx
bin/console doctrine:migrations:migrate
```

Link para acesso:

```jsx
http://localhost:8080
```

Como executar testes:

```jsx
docker-compose run --rm php74-service php bin/phpunit
```