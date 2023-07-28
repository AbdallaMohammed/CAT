# CAT MVC Framework

> Please note that this framework is not intended for use in production environments and may contain security vulnerabilities. It is intended for educational purposes only.

## What?

This is a custom-built MVC framework, and it includes the following components:

- **Request Handler** Handles incoming HTTP requests and passes them to the appropriate controller.
- **Response Handler** Sends HTTP responses back to the client.
- **Routing System** Maps HTTP requests to the appropriate controller and action.
- **Simple ORM** Provides an Object-Relational Mapping layer for interacting with the database.
- **Validation System** Provides a set of validation rules for validating user input.

## Usage

To use this framework, simply clone the repository and edit **.env** file with your appropriate configuration values. You can then use the provided controllers and models to build your own application.

To run the framework, navigate to the public directory and run the following command in the terminal:

```bash
php -S localhost:8000
```

You can then access the application in your web browser at http://localhost:8000.