ARG POSTGRES_VERSION

FROM postgres:${POSTGRES_VERSION}-alpine

COPY ./generate_database_test.sh /docker-entrypoint-initdb.d/generate_database_test.sh
RUN chmod 0755 /docker-entrypoint-initdb.d/generate_database_test.sh