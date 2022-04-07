# PHP MVC Framework

## INTRODUCE

This is project was coded base on framework and it was mixed between Laravel Framework (PHP) and Express Framework (NodeJS)

---

## PROJECT STATUS

[![Build Status](https://img.shields.io/static/v1?label=build&message=passsed&color=success&style=for-the-badge)](https://github.com/kidp2h/php-mvc)
[![Testing Status](https://img.shields.io/static/v1?label=test&message=passsed&color=success&style=for-the-badge)](https://github.com/kidp2h/php-mvc)

---

## MAIN LANGUAGE

[![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)](https://php.net) [![PHP](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)](https://www.javascript.com/)

---

## OTHER TOOLS

[![Docker](https://img.shields.io/badge/DOCKER-%2320232a.svg?style=for-the-badge&logo=docker&logoColor=%2361DAFB)](https://docker.com) [![Composer](https://img.shields.io/badge/COMPOSER-%2320232a.svg?style=for-the-badge&logo=composer&logoColor=%2361DAFB)](https://getcomposer.org) [![Yarn](https://img.shields.io/badge/Yarn-%2320232a.svg?style=for-the-badge&logo=YARN&logoColor=%2361DAFB)](https://yarnpkg.com/) [![NPM](https://img.shields.io/badge/NPM-%2320232a.svg?style=for-the-badge&logo=npm&logoColor=%2361DAFB)](https://npmjs.com/)

---

## Features

- **Home**: Show products common, can add product here to cart user
- **Shop**: Show all products, user can add to cart and filter product by price, category and name
- **Detail**: User can see detail of product when click to product and add it to cart
- **Admin**: There is admin can manage shop, staff and decentralization for user. Besides admin can add product to shop and add branch for shop

---

## Tech

- **NodeJS** - Server bridge, php can connect to server sms and send sms to authentication sms
- **Socket** - Server sms can listen when server bridge emit message to sms server
- **markdown-it** - Write docs for this project
- **React** - Send message to user

---

## Installation

**This project has the following requirements:**

- [![Node](https://img.shields.io/static/v1?label=NODE&message=>=16.14.2&color=success&style=for-the-badge&logo=javascript)](https://nodejs.org)
- [![PHP](https://img.shields.io/static/v1?label=PHP&message=>=8.1&color=success&style=for-the-badge&logo=php)](https://php.net)
- [![ReactNative](https://img.shields.io/static/v1?label=React-Native&message=>=0.68&color=success&style=for-the-badge&logo=react)](https://reactnative.dev)
- [![Composer](https://img.shields.io/static/v1?label=Composer&message=>=2.3.3&color=success&style=for-the-badge&logo=composer)](https://getcomposer.org/)
- [![Yarn](https://img.shields.io/static/v1?label=yarn&message=>=3.2.0&color=success&style=for-the-badge&logo=yarn)](https://yarnpkg.com/)

### CONFIG PHP

- Ensure module rewrite always enable

### Install the dependencies and start the server.

#### OS Linux

For development enviroments

```sh
cd PHP-MVC
mv -R [$DIR_APACHE]/htdocs/
composer install
cd server
yarn build && yarn start
```

For production environments...

```sh
cd PHP-MVC
cp -R [$DIR_APACHE]/htdocs/
composer install
cd server
yarn build && yarn production
```

#### Docker

This project is very easy to install and deploy in a Docker container.

By default, the Docker will expose port 80 (http), so change this within the
Dockerfile or docker-compose.yml if necessary. When ready, simply use the Dockerfile to build the image.

```sh
cd PHP-MVC
docker-compose build
docker-compose up -d
```

This will pull image (if do not have) and create the containers then you access server with port 80 (**can you change it if this port is duplicated**)

> Note: Remove `-d` if you want show logs containers to debug

Verify the deployment by navigating to your server address in
your preferred browser.

```sh
localhost:80
```

or

```sh
127.0.0.1:80
```

#### Windows

```sh
cd PHP-MVC
move src/ [DIR_APACHE]/htdocs/
composer install
cd server
yarn build && yarn start
```

---

## Libraries

Dillinger is currently extended with the following plugins.
Instructions on how to use them in your own application are linked below.

| Name      | Author   | Version                                                  | Description                                     |
| --------- | -------- | -------------------------------------------------------- | ----------------------------------------------- |
| PHPDotENV | vlucas   | [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv)  | Manipulation ENV                                |
| SendGrid  | sendgrid | [sendgrid/sendgrid](https://github.com/vlucas/phpdotenv) | Send OTP to email user for verification account |

---

## License

MIT
