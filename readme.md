# MovieApp
Movies app made with Laravel and Vue JS 2 and Mysql DB

# Requirements
* PHP 7 >=
* Composer
* Node JS

# Setup
You need to clone the project to create a local copy on your system.
Run the following on your terminal:
```
git clone https://github.com/emuroiwa/movies_app.git
```
Then change into the project's directory by running the following on your terminal:
```
cd movies_app

```
As you already have composer installed, run the following on your terminal:
```
composer install
```
or:
```
composer update
```
NPM
```
npm install
```
Then
```
npm run dev
```
# Configurations

After complete setup process you have to configure you database credentials. First copy `temp.env.txt` as `.env`

```shell
cp temp.env.txt .env
```

To generate key please run this:

```
php artisan key:generate
```

Now open `.env` file and write database informations. Then run migrate from you terminal

```shell
php artisan migrate
```
NB there is a sql file backup in the database folder


# Running the project
Run the following on your on your terminal:
```
php artisan serve --port=9090
```
and access the website on your local website with this url localhost:9090.