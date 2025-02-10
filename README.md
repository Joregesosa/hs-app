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

