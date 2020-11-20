####Running instruction
1. First start up containers with `docker-compose up`
2. Then in separate terminal window run `docker-compose run --rm -u www-data --no-deps php-comments-api php ../bin/console doctrine:migration:migrate --no-interaction` to migrate database

####URLs
1. Application is available at port 80(http://localhost)
2. API is available on port 81(http://localhost:81) 
