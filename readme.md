## Router Pulse

Router Pulse is a small system, written on Lumen, for remote monitoring router state and gathering statistic about Internet downtime.
It support 2 provider monitoring. Script for Mikrotik routers is included.

## Install

1. Unpack archive or checkout from repository.
2. Run Composer install:

    composer install

3. Copy .env.example to .env and edit settings in this file.
4. Migrate database:

    php artisan migrate

5. Add script to scheduler in your router, it must every minute get url in format:

    http://{YOUR-DOMAIN}/ping?key={ROUTER_KEY}&isp1={ISP1-STATUS}&isp2={ISP2-STATUS}

## Router scripts
Sample for Mikrotik: routers/mikrotik.txt

## Viewing statistic
Current state is available at the page: http://{YOUR-DOMAIN}/
History for last 30 days available at the page: http://{YOUR-DOMAIN}/statistics