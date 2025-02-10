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

## Module Usuarios 
### Listar usuarios

#### Endpoint:
Ruta: `api/v1/users`
Query:  `api/v1/users?r=1 or 2 or 3` 
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
Ruta: `api/v1/users/id`
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
Ruta: `api/v1/users`
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
    "role_id":4,
    "controller_id": 2, // solo para estudiantes
    "country_id": 4, // solo para estudiantes
    "recruiter_id": 3, // solo para estudiantes
    "schools": [  // cuando es un estudiantes solo puede tener una escuela asignada
        3
    ]// El administrador no tiene escuelas asignadas
}
```
**Nota:** La contraseña tiene su propia area de actualizacion en /auth/change-password.
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
### Actualizar Usuario

#### Endpoint:
Ruta: `api/v1/users/1`
Method: `PUT`
Roles: `Admin y Owner`

#### Descripción:
Este endpoint permite a los administradores y propietarios actualizar la información de un usuario específico utilizando su identificador único. Los administradores pueden actualizar cualquier usuario, mientras que los propietarios solo pueden actualizar su propio perfil.

#### Request:
El cliente debe enviar un token de autenticación en una cookie de la solicitud y proporcionar los datos actualizados del usuario en formato JSON. La estructura de la solicitud es la siguiente:
```JSON
{
    "f_name": "Luffy",
    "s_name": "",
    "f_lastname": "D.",
    "s_lastname": "Monkey",
    "email": "Raul@gmail.com",
    "password": "123456",
    "role_id": 4,
    "controller_id": 2, // solo para estudiantes
    "country_id": 4, // solo para estudiantes
    "recruiter_id": 3, // solo para estudiantes
    "schools": [  // cuando es un estudiante solo puede tener una escuela asignada
        3
    ] // El administrador no tiene escuelas asignadas
}

```

#### Response:
Si la solicitud es exitosa, el servidor responde en formato JSON. La estructura de la respuesta es la siguiente:
```JSON
{
    "status": "success",
    "message": "User updated successfully"
}
```
En caso de que haya un error en la solicitud, el servidor responderá con un mensaje de error indicando la causa del fallo.
```JSON
{
    "status": "error",
    "message": "Error message"
}
```
### Eliminar Usuario

#### Endpoint:
Ruta: `api/v1/users/1`
Method: `DELETE`
Roles: `Admin`

### Eliminar Usuario (Borrado Lógico)

#### Endpoint:
Ruta: `api/v1/users/1`
Method: `DELETE`
Roles: `Admin`

#### Descripción:
Este endpoint permite a los administradores realizar un borrado lógico de un usuario específico utilizando su identificador único. En lugar de eliminar el usuario de la base de datos, se marca como eliminado.

#### Request:
El cliente debe enviar un token de autenticación en una cookie de la solicitud y proporcionar el `user_id` en la ruta.

#### Response:
Si la solicitud es exitosa, el servidor responde en formato JSON. La estructura de la respuesta es la siguiente:
```JSON
{
    "status": "success",
    "message": "User marked as deleted successfully"
}
```
En caso de que haya un error en la solicitud, el servidor responderá con un mensaje de error indicando la causa del fallo.
```JSON
{
    "status": "error",
    "message": "Error message"
}
```

## Module Roles 
### Listar Roles

Este módulo permite listar y ver roles específicos. Hay 4 roles disponibles: Admin, Student, Recruiter, Controller.

Los Controllers y Los recruiter solo tienen acceso a ver la lista de estudiantes y sus horas de servicio cuando inician session en plataforma. 

#### Endpoint:
Ruta: `api/v1/roles`
Roles: `Admin, Student`
Method: `GET`

Este endpoint permite listar todos los roles disponibles en el sistema. Es útil para obtener una visión general de los diferentes roles y sus permisos asociados.

#### Request:
El cliente debe enviar un token de autenticación en una cookie de la solicitud.

#### Response:
Si la solicitud es exitosa, el servidor responde con un arreglo que contiene todos los roles en formato JSON. La estructura de la respuesta es la siguiente:
```JSON
[
    {
        "id": 1,
        "name": "Admin"
    },
    {
        "id": 2,
        "name": "Student"
    },
    {
        "id": 3,
        "name": "Recruiter"
    },
    {
        "id": 4,
        "name": "Controller"
    }
]
```
En caso de que haya un error en la solicitud, el servidor responderá con un mensaje de error indicando la causa del fallo.
```JSON
{
    "status": "error",
    "message": "Error message"
}
```

### Mostrar un Role

#### Endpoint:
Ruta: `api/v1/roles/1`
Roles: `Admin, Student`
Method: `GET`

#### Descripción:
Este endpoint permite obtener la información de un rol específico identificado por su ID.

#### Request:
El cliente debe enviar un token de autenticación en una cookie de la solicitud.

#### Response:
Si la solicitud es exitosa, el servidor responde con un objeto que contiene el role especificado formato JSON. La estructura de la respuesta es la siguiente:
```JSON

{
    "id": 2,
    "name": "Student"
},

```
En caso de que haya un error en la solicitud, el servidor responderá con un mensaje de error indicando la causa del fallo.
```JSON
{
    "status": "error",
    "message": "Error message"
}
```

## Module Services 
 
### Lista de Servicios
#### Endpoint:
Ruta: `api/v1/services`  
Roles: `Admin o Estudiantes`  
Query: `/api/v1/services/?status= 0 or 1 or 2 or  &&user=user_id`
Method: `GET`

#### Descripción:
Este endpoint permite a los administradores y estudiantes obtener una lista de todos los servicios disponibles en el sistema. Los servicios representan las actividades o tareas que los estudiantes pueden realizar y reportar sus horas de servicio.

El query param es opcional para filtrar las solicitudes, en caso de que no se facilite ningun parametro, todas los servicios seran retornados.

##### Estados
**Pending:** 0
**Approved:** 1
**Rejected:** 2
#### Request:
El cliente debe enviar un token de autenticación en una cookie de la solicitud.

#### Response:
Si la solicitud es exitosa, el servidor responde con un arreglo que contiene todos los servicios en formato JSON. La estructura de la respuesta es la siguiente:
```JSON
[
     {
        "id": 2,
        "amount_reported": 12,
        "amount_approved": 15,
        "evidence": "https://via.placeholder.com/640x480.png/00ff55?text=rerum",
        "description": "Quidem pariatur cumque dolores modi nihil odit nisi. Sit amet consectetur fuga autem ratione non voluptatem. Impedit architecto blanditiis voluptatibus qui consequatur corrupti.",
        "comment": "Est voluptas modi fuga omnis vitae ut enim tempora. Sit sequi quam ab quo quibusdam. Rerum culpa velit sed. Quas enim rem qui et vitae. Soluta eius consequatur quia ut laudantium.",
        "status": "Approved",
        "created_at": "2025-02-09T20:10:13.000000Z",
        "updated_at": "2025-02-09T20:10:13.000000Z",
        "category": {
            "id": 2,
            "name": "LemonChiffon",
            "description": "Quisquam tenetur deserunt est."
        },
        "user": {
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
        "reviewer": {
            "id": 4,
            "f_name": "Abdul",
            "m_name": "Laurine",
            "f_lastname": "VonRueden",
            "s_lastname": "Dicki",
            "email": "beier.lizzie@king.org",
            "phone": "812-381-0062",
            "status": "activo",
            "role_id": 3,
            "full_name": "Abdul Laurine VonRueden Dicki"
        }
    }
]
```
En caso de que haya un error en la solicitud, el servidor responderá con un mensaje de error indicando la causa del fallo.
```JSON
{
    "status": "error",
    "message": "Error message"
}
```
### Mostrar un Servicio
#### Endpoint:
Ruta: `api/v1/services/1`  
Roles: `Admin o Estudiantes`  
Method: `GET`

#### Descripción:
Este endpoint permite a los administradores y estudiantes obtener un servicio especificado por su id. Los servicios representan las actividades o tareas que los estudiantes pueden realizar y reportar sus horas de servicio.

#### Request:
El cliente debe enviar un token de autenticación en una cookie de la solicitud.

#### Response:
Si la solicitud es exitosa, el servidor responde con un arreglo que contiene todos los servicios en formato JSON. La estructura de la respuesta es la siguiente:
```JSON

{
        "id": 2,
        "amount_reported": 12,
        "amount_approved": 15,
        "evidence": "https://via.placeholder.com/640x480.png/00ff55?text=rerum",
        "description": "Quidem pariatur cumque dolores modi nihil odit nisi. Sit amet consectetur fuga autem ratione non voluptatem. Impedit architecto blanditiis voluptatibus qui consequatur corrupti.",
        "comment": "Est voluptas modi fuga omnis vitae ut enim tempora. Sit sequi   quam ab quo quibusdam. Rerum culpa velit sed. Quas enim rem qui et vitae. Soluta eius consequatur quia ut laudantium.",
        "status": "Approved",
        "created_at": "2025-02-09T20:10:13.000000Z",
        "updated_at": "2025-02-09T20:10:13.000000Z",
        "category": {
            "id": 2,
            "name": "LemonChiffon",
            "description": "Quisquam tenetur deserunt est."
        },
        "user": {
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
        "reviewer": {
            "id": 4,
            "f_name": "Abdul",
            "m_name": "Laurine",
            "f_lastname": "VonRueden",
            "s_lastname": "Dicki",
            "email": "beier.lizzie@king.org",
            "phone": "812-381-0062",
            "status": "activo",
            "role_id": 3,
            "full_name": "Abdul Laurine VonRueden Dicki"
        }
}

```
En caso de que haya un error en la solicitud, el servidor responderá con un mensaje de error indicando la causa del fallo.
```JSON
{
    "status": "error",
    "message": "Error message"
}
```






