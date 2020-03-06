#!/bin/bash

docker container stop dacsite_wordpress_1 dacsite_mysql_1 || true
docker container rm dacsite_wordpress_1 dacsite_mysql_1 || true
docker volume rm dacsite_db_data || true
./npm-start.sh