# HS API

This project is an API for reporting hours of services provided by students.

## Installation

1. Clone the repository:
    ```sh
    git clone <repository-url>
    cd hs-app
    ```

2. Install dependencies:
    ```sh
    composer install
    ```

3. Copy the `.env.example` to [.env](http://_vscodecontentref_/43) and configure your environment variables:
    ```sh
    cp .env.example .env
    ```

4. Initialize the database:
    ```sh
    composer run migrate
    composer run seed
    ```

## Usage

Start the server:
```sh
php -S localhost:8000 -t .
```

##Routes

###User Routes
GET /users - List all users
GET /users/{id} - Get a specific user
POST /users - Create a new user
PUT /users/{id} - Update a user
DELETE /users/{id} - Delete a user

###Role Routes

GET /roles - List all roles
GET /roles/{id} - Get a specific role

###School Routes

GET /schools - List all schools
GET /schools/{id} - Get a specific school
POST /schools - Create a new school
PUT /schools/{id} - Update a school
DELETE /schools/{id} - Delete a school

###Country Routes

GET /countries - List all countries
GET /countries/{id} - Get a specific country
POST /countries - Create a new country
PUT /countries/{id} - Update a country
DELETE /countries/{id} - Delete a country

###Category Routes

GET /categories - List all categories
GET /categories/{id} - Get a specific category
POST /categories - Create a new category
PUT /categories/{id} - Update a category
DELETE /categories/{id} - Delete a category

###Service Routes

GET /services - List all services
GET /services/{id} - Get a specific service
POST /services - Create a new service
PUT /services/{id} - Update a service
DELETE /services/{id} - Delete a service

##Middleware

###VerifyToken
This middleware verifies the JWT token from the request cookies.

##Database

###Migrations
Run the migrations:

```sh
composer run migrate
```

Rollback the migrations:

```sh
composer run migrate:down
```
Refresh the migrations:

```sh
composer run migrate:refresh
```
###Seeders
Seed the database:

```sh
composer run seed
```
Refresh the seeders:

```sh
composer run seed:refresh
```

##License
This project is licensed under the MIT License.
