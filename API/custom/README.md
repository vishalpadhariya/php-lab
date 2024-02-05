# API's Example

This repository contains straightforward examples and tutorials geared towards beginners, aiming to demystify API integration using PHP. 

Explore step-by-step guides and sample code snippets to help newcomers understand and implement API interactions effortlessly within their projects. Ideal for those starting their journey into API development with PHP.

## Author

- Website: [vishalpadhariya.in](https://www.vishalpadhariya.in)

## Environment Variables

To run this project, you will need to add the following environment variables to your config.php file at root

For eg., define("key","value");

***Basic Authentication***

`USERNAME`
`PASSWORD`

***Key Validate***

`API_KEY`

***Tokenize Validation***

`BEARER_TOKEN_ACCESS_KEY`
`BEARER_TOKEN_SECRET_KEY`

***JWT Token Validation***

`JWT_SECRET`

## API Reference

```
// Include the controller file and call the action
require_once __DIR__ . '/controllers/UserController.php'

// Create controller instance
$controllerInstance = new UserController();

```

### Basic ( without any Authentication )

```http
  GET /basic
```

### Based on Admin crendetials authentication

```http
  POST /basic-auth
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `username`      | `string` | **Required**. Environment Variable |
| `password`      | `string` | **Required**. Environment Variable |

``` 
$controllerInstance->basicAuthentication($username, $password);
```

### Based on API key

```http
  POST /key-validate
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `apikey`      | `string` | **Required**. Environment Variable |

```  
$controllerInstance->validateAPIKey($apiKey);
```

### Based on Bearer Token

```http
  GET /bearer-token
```

**Headers**
| Parameter | Type     | Description                       | Example |
| :-------- | :------- | :-------------------------------- | :------- |
| `Authorization`      | `string` | **Required**. Pass Bearer token at the request header | Authorization: Bearer `TOKEN`  | 

```
 $controllerInstance->validateBearerToken($token);
 ```

### Based on JWT Token

```
composer install
```
***Run composer installation commnad at the `jwt-token` directory to install all JWT related libraries***

```http
  GET /jwt-token/authenticate.php
```

```http
  GET /jwt-token
```

**Headers**
| Parameter | Type     | Description                       | Example |
| :-------- | :------- | :-------------------------------- | :------- |
| `Authorization`      | `string` | **Required**. Pass received token at above api. | Authorization: `TOKEN`  | 

## Tech Stack

**Client:** Thunder Client (Use in vscode to fetch data from api) `You can use postman if not using a vscode. *`

**Server:** PHP

