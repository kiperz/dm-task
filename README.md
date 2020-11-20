## DobryMechanik task

#### Running instruction
- First start up containers with `docker-compose up`
- Then in separate terminal window run `docker-compose run --rm -u www-data --no-deps php-comments-api php ../bin/console doctrine:migration:migrate --no-interaction` to migrate database
- Run tests with `docker-compose run --rm --no-deps php-comments-app sh -c "cd .. && php bin/phpunit"`
#### URLs

- Application is available at port 80(http://localhost)
- API is available on port 81(http://localhost:81) 
