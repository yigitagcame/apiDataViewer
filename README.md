

# apiDataViewer

Installing instructions are below.

## Install
- Install composer (https://getcomposer.org/)
- And run following command
```
composer install
```
- import apiData.sql file on root folder to your DB
- rename .env.example file on root folder to .env file and fill the file with necessary info (DB cridentials, api key, etc.. )

## Run
```
php fetchData
```

## Test

```
php vendor/bin/phpunit
```

## Notebook for Improvements


- A single page vue app for showing data
- Additional db functions to DBService for fetching and filtering data from DB.

*Making the app production ready*
- Applying singletion pattern to db connection.
- implementing entity model to system for managing data flows between db and front controller
- adding an orm most probably DoctrineOrm
- adding more feature test