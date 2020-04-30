## Router Pulse

Router Pulse is a small system, written on Lumen, for remote monitoring router state and gathering statistic about Internet downtime.
It support 2 provider monitoring. Script for Mikrotik routers is included.

![Image alt](https://github.com/satsis/router-pulse/blob/master/img/2016-01-02_17-03-25.png)

![Image alt](https://github.com/satsis/router-pulse/blob/master/img/2016-01-02_17-03-09.png)

## Install

1. Unpack archive or checkout from repository.
2. cd router-pulse root directory
3. Run Composer install:

    composer install

3. Copy .env.example to .env and edit settings in this file.
4. Creat MySQL database from .env config name
5. Migrate database:

    php artisan migrate

6. Web config to router-pulse/public directory
7. Add http auth in https://{YOUR-DOMAIN}/settings directory
8. Add script to scheduler in your router, it must every minute get url in format:

    https://{YOUR-DOMAIN}/ping?key={ROUTER_KEY}&isp1={ISP1-STATUS}&isp2={ISP2-STATUS}

## Router scripts
Sample for Mikrotik: routers/mikrotik.txt

9. Change config notifications in https://{YOUR-DOMAIN}/settings
add telegram or(and) viber APIkey

![Image alt](https://github.com/satsis/router-pulse/blob/master/img/firefox_2020-04-30_16-57-25.jpg)

set webhook:
https://{YOUR-DOMAIN}/telegram/sethook
https://{YOUR-DOMAIN}/viber/sethook

10. Send message to telegram or viber boot and get your id
Insert id in https://{YOUR-DOMAIN}/settings
Save changes

11. Add to crontab curl https://{YOUR-DOMAIN}/scheduler

## Viewing statistic
Current state is available at the page: http://{YOUR-DOMAIN}/
History for last 30 days available at the page: http://{YOUR-DOMAIN}/statistics
