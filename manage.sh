#!/bin/bash

if [ "$1" == "prepare" ]
then 
    # Install Docker
    sudo apt-get update
    sudo apt-get install -y docker.io

    # # Install Certbot
    # sudo apt-get install -y software-properties-common
    # sudo apt-get update
    # sudo apt-get install -y certbot python3-certbot-nginx

    # # Generate SSL certificates
    # sudo certbot certonly --nginx -d housingdir.com

    # # # Move certificates to the correct location
    # sudo mv /etc/letsencrypt/live/housingdir.com/fullchain.pem ./Docker/nginx/ssl/cert.pem
    # sudo mv /etc/letsencrypt/live/housingdir.com/privkey.pem ./Docker/nginx/ssl/key.pem
    exit 1
fi


if [ "$1" == "start" ]
then 
    docker compose up -d
    exit 1
fi

if [ "$1" == "list:containers" ]
then 
    docker ps
    exit 1
fi

if [ "$1" == "stop" ]
then 
    docker compose down
    exit 1
fi

if [ "$1" == "tests" ]
then 
    docker container exec -t housing-app php bin/phpunit
    exit 1
fi

if [ "$1" == "terminal" ]
then 
    if [ "$2" ]
    then
        docker container exec -it $2 bash
    else
        docker container exec -it housing-app bash
    fi
    exit 1
fi


echo "You can use any of the following commands:"
echo "$0 prepare"
echo "$0 start"
echo "$0 stop"
echo "$0 list:containers"
echo "$0 terminal [service_name]"
echo "$0 tests"