# Aggregator

Aggregates RSS feeds.

## Requirements

* Docker

## Installation

```
cp .env.example .env
./vendor/bin/sail up -d
./vendor/bin/sail composer install
./vendor/bin/sail artisan migrate:fresh
```

## Run tests

```
./vendor/bin/sail up -d
./vendor/bin/sail artisan test
```
