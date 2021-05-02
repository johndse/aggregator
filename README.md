# Aggregator

A simple web application that allows you to aggregate RSS feeds into one feed.

## Requirements

* Docker

## Installation

```
cp .env.example .env
./vendor/bin/sail up -d
./vendor/bin/sail composer install
./vendor/bin/sail artisan migrate:fresh
```

### Links

Feed: http://localhost/api/entries

## Run tests

```
./vendor/bin/sail up -d
./vendor/bin/sail artisan test
```
