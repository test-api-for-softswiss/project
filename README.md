Test API
========

## Dependencies

This project requires following dependencies to be installed:

* PHP 7.0
* Phing 2.16
* Composer 1.5
* Laravel Framework 5.5

## Installation

Configuration and deployment of the project could be done using `Phing` build utility. There few Phing tasks available to set up project:

1. `configure`
    This task could be used to create or update configuration file of Laravel framework.

2. `composer`
    This task could be used to install framework and all depended bundles. It calls `composer install` with current version of lock file.

3. `migrate`
    This task perform migration of database.

4. `build`
    This task includes sequence of `composer` and `migrate` tasks

To set up project for the first time, use following steps:

1. Rename file `build.properties.example` to `build.properties`
2. Edit `build.properties` with system specific data, such as database connection (MySQL database and database user should be created before project configuration)
3. Launch `php bin/phing configure` command from project root. That should create `.env` file with configuration of Laravel Framework.
4. Launch `php bin/phing build` command from project root. That should install all dependencies and synchronize database structure.
5. On *nix system change permissions of files and folders of the project to user and group of your web-server.
6. Set up your web server with document root: `${PROJECT_ROOT}/public`

## API Methods

Every response contains `success` attribute. It's boolean and contains result of execution of the method.
In the case of positive response result data will be returned in `results` attribute.
In the case of error `errors` attribute contains a list of errors related to request.

**Success response example**

```
{
    "success": true,
    "results": ...
}
```

**Error response example**

```
{
    "success": false,
    "errors": [
        "Error message #1",
        ... 
        "Error message #N"
    ]
}
```

------------------------------------------------------------------------

**GET** /api/v1/balance?user={user_id}

**Request attributes:**
* `user_id` - ID of the user in the system.

**Response attributes:**
* `user` - ID of the user
* `balance` - current amount of the balance of the user

------------------------------------------------------------------------

**POST** /api/v1/deposit

**Request attributes:**
* `user` - ID of the user in the system. New user will be created if not exists
* `amount` - amount of deposit transaction 

**Response attributes:**
* `user` - ID of the user
* `balance` - current amount of the balance of the user

------------------------------------------------------------------------

**POST** /api/v1/withdraw

**Request attributes:**
* `user` - ID of the user in the system
* `amount` - amount of withdraw transaction 

**Response attributes:**
* `user` - ID of the user
* `balance` - current amount of the balance of the user

------------------------------------------------------------------------

**POST** /api/v1/transfer

**Request attributes:**
* `from` - ID of the user that transfer money
* `to` - ID of the user that receives money
* `amount` - amount of transfer transaction 

**Response attributes:**
* `sender.user` - ID of the user that issue transfer
* `sender.balance` - current amount of the balance of the user that issue transfer
* `recipient.user` - ID of the user that receives transfer
* `recipient.balance` - current amount of the balance of the user that receives transfer

