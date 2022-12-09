#!/bin/bash
pg_dump app -U app > app_test.sql
psql template1 -c 'DROP DATABASE IF EXISTS app_test;' -U app
psql template1 -c 'CREATE DATABASE app_test with owner app;' -U app
psql app_test -U app < app_test.sql