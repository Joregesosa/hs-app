# HS API
HS API es un proyecto DEMO para que los estudiantes practiquen con una API en el mundo real. Las principales funciones son: autenticación, reporte de horas de servicios, revisión de horas de servicio y visualización de las mismas.

## Module Auth
### Login 

#### Endpoint:
Ruta: `api/v1/auth/login`  
Method: `POST`

El proceso de login permite a los usuarios autenticarse en el sistema utilizando sus credenciales (correo electrónico y contraseña). Este proceso es fundamental para garantizar que solo los usuarios autorizados puedan acceder a las funcionalidades protegidas de la aplicación.

#### Request: 
El cliente envía una solicitud de autenticación con las credenciales del usuario en formato JSON. La estructura de la solicitud es la siguiente:
```JSON
{
  "email": "example@mail.com",
  "password": "mipassword"
}
```

#### Response: 
Si las credenciales son correctas, el servidor responde con un mensaje de éxito en formato JSON. La estructura de la respuesta es la siguiente:
```JSON
{
    "status": "success",
    "message": "Login successful"
}
```
En caso de que las credenciales sean incorrectas, el servidor responderá con un mensaje de error indicando que la autenticación ha fallado.
```JSON
{
    "status": "error",
    "message": "Invalid credentials"
}
```
### Profile

#### Endpoint:
Ruta: `api/v1/auth/profile`  
Method: `GET`

El endpoint de perfil permite a los usuarios autenticados obtener la información de su perfil. Devuelve detalles como el nombre del usuario, correo electrónico y otra información relevante del perfil.

#### Request:
El cliente debe enviar un token de autenticación en una cookie de la solicitud:

#### Response:
Si la solicitud es exitosa, el servidor responde con la información del perfil del usuario en formato JSON. La estructura de la respuesta es la siguiente:
```JSON
{
   {
    "id": 8,
    "f_name": "Luffy",
    "m_name": null,
    "f_lastname": "D.",
    "s_lastname": "Monkey",
    "email": "Raul@gmail.com",
    "phone": null,
    "status": "activo",
    "role_id": 4,
    "full_name": "Luffy  D. Monkey",
    "role": {
        "id": 4,
        "name": "Student"
    },
    "schools": [
        {
            "id": 3,
            "name": "eos assumenda",
            "pivot": {
                "user_id": 8,
                "school_id": 3
            }
        }
    ],
    "student": { // solo si el perfil le pertenece a un estudiante
        "id": 6,
        "country": {
            "id": 4,
            "name": "Saint Barthelemy",
            "created_at": "2025-02-09T20:10:11.000000Z",
            "updated_at": "2025-02-09T20:10:11.000000Z"
        },
        "controller": {
            "id": 2,
            "f_name": "Brianne",
            "m_name": "Adrien",
            "f_lastname": "Schroeder",
            "s_lastname": "Waelchi",
            "email": "walsh.elfrieda@gibson.com",
            "phone": "+1 (351) 948-6482",
            "status": "inactivo",
            "role_id": 4,
            "full_name": "Brianne Adrien Schroeder Waelchi"
        },
        "recruiter": {
            "id": 3,
            "f_name": "Sharon",
            "m_name": "Lorenzo",
            "f_lastname": "Bergnaum",
            "s_lastname": "Bosco",
            "email": "mmcclure@gmail.com",
            "phone": "+1-820-773-4899",
            "status": "activo",
            "role_id": 4,
            "full_name": "Sharon Lorenzo Bergnaum Bosco"
        }
    }
}
}
```
En caso de que el token de autenticación sea inválido o esté ausente, el servidor responderá con un mensaje de error indicando que la autenticación ha fallado.
```JSON
{
    "status": "error",
    "message": "Unauthorized"
}
```
Si el perfil del usuario no se encuentra, el servidor responderá con un mensaje de error indicando que el perfil no fue encontrado.
```JSON
{
    "status": "error",
    "message": "User profile not found"
}
```

### Change Password

#### Endpoint:
Ruta: `api/v1/auth/change-password`  
Method: `GET`

El proceso de cambio de contraseña permite a los usuarios actualizar su contraseña actual por una nueva. Este proceso es fundamental para mantener la seguridad de las cuentas de usuario.

#### Request:
El cliente envía una solicitud de cambio de contraseña con la contraseña actual y la nueva contraseña en formato JSON. La estructura de la solicitud es la siguiente:
```JSON
{
  "old_password": "1234567",
  "new_password": "123456"
}
```

#### Response:
Si la contraseña actual es correcta y la nueva contraseña cumple con los criterios requeridos, el servidor responde con un mensaje de éxito en formato JSON. La estructura de la respuesta es la siguiente:
```JSON
{
    "status": "success",
    "message": "Password updated successfully"
}
```
En caso de que la contraseña actual sea incorrecta, el servidor responderá con un mensaje de error indicando que la autenticación ha fallado.
```JSON
{
    "status": "error",
    "message": "Invalid old password",
}
``` 

### Logout 

#### Endpoint:
Ruta: `api/v1/auth/change-password`  
Method: `GET`

El proceso de cierre de sesión permite a los usuarios autenticados cerrar su sesión de manera segura. Este proceso es fundamental para garantizar que las sesiones no autorizadas no permanezcan activas.

#### Request:
El cliente debe enviar una solicitud de cierre de sesión. No se requiere ningún dato adicional en el cuerpo de la solicitud.

#### Response:
Si la solicitud es exitosa, el servidor responde con un mensaje de éxito en formato JSON. La estructura de la respuesta es la siguiente:
```JSON
{
    "status": "success",
    "message": "Logout successful"
}
``` 

## Usuarios 
### Listar usuarios

#### Endpoint:
Ruta: `api/v1/auth/users`
Query:  `api/v1/auth/users?r=1 or 2 or 3` 
Roles: `Admin or Students`
Method: `GET`

Esta enspoint se encarga de listar todos los usuarios registrados en el sistema. Realiza una consulta a la base de datos para obtener la información de cada usuario y la devuelve en un formato estructurado. Es útil para mostrar un resumen de los usuarios existentes y sus detalles relevantes.

Aceptar query params que te permiten filtrar segun el rol si ningun rol es facilitado devolvera todos los usuarios. 

#### Request:
El cliente debe enviar un token de autenticación en una cookie de la solicitud:

#### Response:
Si la solicitud es exitosa, el servidor responde con un mensaje de éxito en formato JSON. La estructura de la respuesta es la siguiente:

```JSON
[
    {
        "id": 1,
        "f_name": "Osvaldo",
        "m_name": "Minerva",
        "f_lastname": "Lueilwitz",
        "s_lastname": "Lebsack",
        "email": "imclaughlin@blanda.net",
        "phone": "361.857.2775",
        "status": "activo",
        "role_id": 1,
        "full_name": "Osvaldo Minerva Lueilwitz Lebsack",
        "role": {
            "id": 1,
            "name": "Admin"
        }
    },
]
```
En el caso de los estudiantes, es obligatorio incluir el parámetro `?r=role_id` en la petición.

**Nota:** Los usuarios con roles de **Controllers** y **Recruiters** no pueden acceder a esta información.

### Mostrar un usuario

#### Endpoint:
Ruta: `api/v1/auth/users/id`
Method: `GET`
Roles: `Admin`

#### Descripción:
Este endpoint permite a los administradores obtener la información detallada de un usuario específico utilizando su identificador único.

#### Request:
El cliente debe enviar un token de autenticación en una cookie de la solicitud y proporcionar el `user_id` en la ruta.

#### Response:
Si la solicitud es exitosa, el servidor responde con la información del usuario en formato JSON. La estructura de la respuesta es la siguiente:
```JSON
{
        "id": 1,
        "f_name": "Osvaldo",
        "m_name": "Minerva",
        "f_lastname": "Lueilwitz",
        "s_lastname": "Lebsack",
        "email": "imclaughlin@blanda.net",
        "phone": "361.857.2775",
        "status": "activo",
        "role_id": 1,
        "full_name": "Osvaldo Minerva Lueilwitz Lebsack",
        "role": {
            "id": 1,
            "name": "Admin"
        }
    }
```
En caso de que el usuario con el `user_id` especificado no sea encontrado, el servidor responderá con un mensaje de error indicando que el usuario no fue encontrado.
```JSON
{
    "status": "error",
    "message": "User not found"
}
```
 
### Crear Usuario

#### Endpoint:
Ruta: `api/v1/auth/users`
Method: `POST`
Roles: `Admin`


#### Descripción:
Este endpoint permite a los administradores crear un nuevo usuario en el sistema proporcionando la información necesaria en el cuerpo de la solicitud.

#### Request:
El cliente debe enviar un token de autenticación en una cookie de la solicitud y proporcionar los datos del usuario en formato JSON. La estructura de la solicitud es la siguiente:
```JSON
{
    "f_name": "Luffy",
    "s_name": "",
    "f_lastname": "D.",
    "s_lastname": "Monkey",
    "email": "Raul@gmail.com",
    "password": "123456",
    "role_id":4,
    "controller_id": 2, // solo para estudiantes
    "country_id": 4, // solo para estudiantes
    "recruiter_id": 3, // solo para estudiantes
    "schools": [  // cuando es un estudiantes solo puede tener una escuela asignada
        3
    ]// El administrador no tiene escuelas asignadas
}
```

#### Response:
Si la solicitud es exitosa, el servidor responde en formato JSON. La estructura de la respuesta es la siguiente:
```JSON
{
    "status": "success",
    "message": "User created successfully"
}
```
En caso de que haya un error en la solicitud, el servidor responderá con un mensaje de error indicando la causa del fallo.
```JSON
{
        "status": "error",
        "message": "Error message"
}
```




