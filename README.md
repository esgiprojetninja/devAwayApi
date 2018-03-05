# devAwayApi [![Build Status](https://travis-ci.org/esgiprojetninja/devAwayApi.svg?branch=master)](https://travis-ci.org/esgiprojetninja/devAwayApi)

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/d831f6fe4a964316b90eed05a46a3f99)](https://www.codacy.com/app/GoRFy/devAwayApi?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=esgiprojetninja/devAwayApi&amp;utm_campaign=Badge_Grade)

# Getting started using docker

First, use the docker-compose.yml file to get the containers running.

`docker-compose up`

Then, in another terminal, install the composer dependencies.

`docker exec devawayapi_app_1 composer install`

Finally, your app needs a secret key.

`docker exec devawayapi_app_1 php artisan key:generate`
>>>>>>> f6831dc342d9ae8982c484214c2192e6dbc8be53

#Set up

`php artisan migrate`

`php artisan db:seed`