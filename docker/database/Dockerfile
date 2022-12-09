ARG POSTGRES_VERSION

FROM postgres:${POSTGRES_VERSION}-alpine

COPY ./testing.sql /docker-entrypoint-initdb.d/testing.sql