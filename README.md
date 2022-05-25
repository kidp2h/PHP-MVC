# 🌐 PHP MVC Framework

## 🎆 INTRODUCE

This is project was coded base on framework and it was mixed between Laravel Framework (PHP) and Express Framework (NodeJS)

---

## 📶 PROJECT STATUS

[![Build Status](https://img.shields.io/static/v1?label=build&message=passsed&color=success&style=for-the-badge)](https://github.com/kidp2h/php-mvc)
[![Testing Status](https://img.shields.io/static/v1?label=test&message=passsed&color=success&style=for-the-badge)](https://github.com/kidp2h/php-mvc)

---

## 🔣 MAIN LANGUAGE

[![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)](https://php.net) [![PHP](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)](https://www.javascript.com/)

---

## 🔨 OTHER TOOLS

[![Docker](https://img.shields.io/badge/DOCKER-%2320232a.svg?style=for-the-badge&logo=docker&logoColor=%2361DAFB)](https://docker.com) [![Composer](https://img.shields.io/badge/COMPOSER-%2320232a.svg?style=for-the-badge&logo=composer&logoColor=%2361DAFB)](https://getcomposer.org) [![Yarn](https://img.shields.io/badge/Yarn-%2320232a.svg?style=for-the-badge&logo=YARN&logoColor=%2361DAFB)](https://yarnpkg.com/) [![NPM](https://img.shields.io/badge/NPM-%2320232a.svg?style=for-the-badge&logo=npm&logoColor=%2361DAFB)](https://npmjs.com/)

---

## 🔰 Features Project

- **Home**: Show products common, can add product here to cart user
- **Shop**: Show all products, user can add to cart and filter product by price, category and name
- **Detail**: User can see detail of product when click to product and add it to cart
- **Admin**: There is admin can manage shop, staff and decentralization for user. Besides admin can add product to shop and add branch for shop

---

## 🌍 Tech

- **NodeJS** - Server bridge, php can connect to server sms and send sms to authentication sms
- **Socket** - Server sms can listen when server bridge emit message to sms server
- **markdown-it** - Write docs for this project
- **React** - Client for sms server

---

## ⚙️ Installation

### Compulsory

- [![Node](https://img.shields.io/static/v1?label=NODE&message=>=16.14.2&color=success&style=for-the-badge&logo=javascript)](https://nodejs.org)
- [![PHP](https://img.shields.io/static/v1?label=PHP&message=>=8.1&color=success&style=for-the-badge&logo=php)](https://php.net)
- [![Composer](https://img.shields.io/static/v1?label=Composer&message=>=2.3.3&color=success&style=for-the-badge&logo=composer)](https://getcomposer.org/)

### Optional

- [![Yarn](https://img.shields.io/static/v1?label=yarn&message=>=3.2.0&color=success&style=for-the-badge&logo=yarn)](https://yarnpkg.com/)
- [![ReactNative](https://img.shields.io/static/v1?label=React-Native&message=>=0.68&color=success&style=for-the-badge&logo=react)](https://reactnative.dev)

### Install the dependencies

- **Install NodeJS**

  - **Windows**:
    - Step 1: Download file install [NodeJS](https://nodejs.org/dist/v16.15.0/node-v16.15.0-x86.msi)
    - Step 2: Open it and install
  - **Linux**:
    - **Ubuntu** :
      ```sh
      curl -fsSL https://deb.nodesource.com/setup_lts.x | sudo -E bash -
      sudo apt-get install -y nodejs
      ```
    - **Debian** :
      ```sh
      curl -fsSL https://deb.nodesource.com/setup_lts.x | bash -
      sudo apt-get install -y nodejs
      ```

- **Install PHP**
  - **Windows**:
    - Step 1: Download source code [PHP](https://windows.php.net/downloads/releases/php-8.1.6-src.zip)
    - Step 2: Extract it and add path php to $PATH enviroment variable
  - **Linux**:
    ```sh
    sudo apt install software-properties-common
    sudo add-apt-repository ppa:ondrej/php
    sudo apt update
    sudo apt install php libapache2-mod-php
    ```
- **Install Composer**
  - **Windows**:
    - Step 1: Let ensure that you installed **PHP**
    - Step 2: Download file installer [Composer](https://getcomposer.org/download/) and install it
  - **Linux**
    - **Step 1**
      ```sh
      php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
      php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
      php composer-setup.php
      php -r "unlink('composer-setup.php');"
      ```
    - **Step 2 (Optional) If you want to global install composer**
      ```sh
      sudo mv composer.phar /usr/local/bin/composer
      ```
- **Install Yarnpkg (can alternative with npm)**
  - **Windows**
    - **Requirement**
      - **Node**: ^4.8.0 || ^5.7.0 || ^6.2.2 || >=8.0.0
    - **Install via npm**
      ```sh
      npm install --global yarn
      ```
  - **Linux**
    ```sh
    curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | sudo apt-key add -
    echo "deb https://dl.yarnpkg.com/debian/ stable main" | sudo tee /etc/apt/sources.list.d/yarn.list
    sudo apt update && sudo apt install yarn
    ```
- **React Native (Install if you want send SMS)**
  - Read document official from [React Native](https://reactnative.dev/docs/environment-setup)

### Setup enviroment variable for project

- **Step 1**
  - Create file _.env_ in folder src
  - Copy content from file _example.env_ to file _.env_ just create
- **Step 2**
  - Fill variable enviroment
    - SYSTEM
      - BASE_URL: base url your server (like 'http://localhost' or 'https://example.com')
      - OTP_SERVER: IP server otp
    - DB
      - HOSTNAME_DB: host name your database (default: localhost)
      - USERNAME_DB: username your account database (default: root)
      - PASSWORD_DB: password your account database (default: empty)
    - SENDGRID
      - SENDGRID_API_KEY: API key service sendgrid provided
      - FROM_ADDRESS: Email address to send email
      - FROM_NAME: Name email address above
      - TEMPLATE_VERIFY_ACCOUNT: API template verify account
      - TEMPLATE_RESET_PASSWORD: API template reset password
    - CRYPT
      - SALT: salt in bcrypt algorithms
      - SECRET_KEY: secret key for token (Access Token, Refresh Token, ResetToken)
    - CAPTCHA
      - GC_SITE_KEY: site key service captcha google
      - GC_SECRET_KEY: secret key to decode key captcha

### Initialize database (MySQL)

- There is 2 ways to Initialize (you can choose 1 of 2 ways )

  - **Automation**

    - **Docker**

      ```sh
      docker exec php php migrations.php
      ```

    - **Apache**

      ```sh
      php migrations.php
      ```

  - **Manually**
    - **phpMyAdmin**
      - **Step 1**
        - Go to phpMyAdmin (localhost:3306 || localhost/phpMyAdmin)
      - **Step 2**
        - Import file 'shop.sql' in this project

### Start Server

#### 🐧 Start in Linux

> **Note**: Let ensure that you installed dependencies above

- Clone project, can you use with https or ssh (if you have)
  - HTTPS
    ```bash
    git clone https://github.com/kidp2h/PHP-MVC.git
    ```
  - SSH
    ```sh
    git clone git@github.com:kidp2h/PHP-MVC.git
    ```
- Set up project

  - For development enviroments

    ```sh
    cd PHP-MVC
    mv -R [$DIR_APACHE]/htdocs/
    composer install
    cd server/socket
    yarn build && yarn start
    ```

  - For production environments...

    ```sh
    cd PHP-MVC
    cp -R [$DIR_APACHE]/htdocs/
    composer install
    cd server/socket
    yarn build && yarn production
    ```

#### 🐳 Start in Docker **(If you installed Docker)**

This project is very easy to install and deploy in a Docker container.

By default, the Docker will expose port 80 (http), so change this within the
Dockerfile or docker-compose.yml if necessary
When ready, simply use the Dockerfile to build the image.

- Set up enviroment variable docker

  - Like to set up enviroment variable project was mentioned above
    - Fill enviroment variable
      - PASSWORD_MYSQL: Password account database
      - USERNAME_MYSQL: Username account database
      - HOST_MYSQL: Host database

- Build from docker-compose

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

#### 🪟 Windows

```sh
cd PHP-MVC
move src/ [DIR_APACHE]/htdocs/
composer install
cd server
yarn build && yarn start
```

#### Setup in Hosting

#### Setup in VPS

---

## 📦 Libraries

Dillinger is currently extended with the following plugins.
Instructions on how to use them in your own application are linked below.

| Name      | Author   | Repository                                               | Description                                     |
| --------- | -------- | -------------------------------------------------------- | ----------------------------------------------- |
| PHPDotENV | vlucas   | [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv)  | Manipulation ENV                                |
| SendGrid  | sendgrid | [sendgrid/sendgrid](https://github.com/vlucas/phpdotenv) | Send OTP to email user for verification account |

---

## 📄 License

MIT
