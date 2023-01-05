#!/bin/bash

# Declare functions

install_dependencies() {
    # Add to $PATH
    echo "export PATH=$PATH:$(dirname $0)" >> ~/.bashrc
    source ~/.bashrc

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
}

start_services() {
    docker compose up -d
}

stop_services() {
    docker compose down
}

list_containers() {
    docker ps
}

run_tests() {
    docker container exec -t housing-app php bin/phpunit
}

open_terminal() {
    local service_name=${1:-housing-app}
    docker container exec -it $service_name bash
}

load_fixtures() {
    docker container exec -t housing-app php bin/console hautelook:fixtures:load
}

# Define main logic
case "$1" in
    "prepare")
        install_dependencies
        ;;
    "start")
        start_services
        ;;
    "stop")
        stop_services
        ;;
    "list:containers")
        list_containers
        ;;
    "tests")
        run_tests
        ;;
    "terminal")
        open_terminal "$2"
        ;;
    "load-fixtures")
        load_fixtures
        ;;
    *)
        echo "You can use any of the following commands:"
        echo "$0 prepare"
        echo "$0 start"
        echo "$0 stop"
        echo "$0 list:containers"
        echo "$0 terminal [service_name]"
        echo "$0 tests"
        echo "$0 load-fixtures"
esac