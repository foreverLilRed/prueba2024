
PRUEBA 2024
Este proyecto es una aplicación web diseñada para realziar transferencias de dinero entre usuarios. 
La aplicación está construida utilizando Docker.

Se requiere lo siguiente:

Objetivo:
Tenemos 2 tipos de usuarios, comunes y comerciantes, ambos tienen billeteras con dinero y
realizan transferencias entre ellas.
Presta atención al flujo de transferencia entre dos usuarios.
Requerimentos:
1. Para los dos tipos de usuario, necesitamos el nombre completo, documento de
identidad, correo electrónico y contraseña. El documento de identidad y correo
electrónico deben ser únicos en el sistema. Por lo tanto, su sistema sólo debe permitir
un registro con el mismo número de documento de identidad o dirección de correo
electrónico.
2. Los usuarios pueden enviar dinero (transferir) a comerciantes y entre usuarios.
3. Los comerciantes sólo reciben transferencias, no envían dinero a nadie.
4. Validar si el usuario tiene saldo antes de la transferencia.
5. Antes de completar la transferencia, debe consultar un servicio de autorización externo,
utilice este simulacro para simular
(https://run.mocky.io/v3/1f94933c-353c-4ad1-a6a5-a1a5ce2a7abe).
6. La operación de transferencia debe ser una transacción (es decir, revertida en cualquier
caso de inconsistencia) y el dinero debe devolverse a la billetera del usuario emisor.
7. Al recibir el pago, el usuario o comerciante debe recibir una notificación (correo
electrónico, SMS) enviada por un servicio de terceros y este servicio puede
eventualmente no estar disponible o ser inestable. Utilice este enlace para simular el
envío (https://run.mocky.io/v3/6839223e-cd6c-4615-817a-60e06d2b9c82).
8. Este servicio debe ser RESTFul.

## Inicia el proyecto con docker

-   En una terminal ejecuta:

```
docker-compose build
```

-   Una vez que la imagen se haya construido correctamente ejecuta la aplicación utilizando el siguiente comando:

```
docker-compose up
```

-   Ejecuta el comando:

```
docker ps
```

-   Selecciona el Container ID que contenga la imagen de MySQL y luego ejecuta:

```
docker exec -it id_del_contenedor_mysql bash
```

-   Una vez abierto bash, escribe (Como password va "root"):

```
mysql -u root -p
```

-   Copia todo el codigo .sql incluido en el proyecto y pegalo directamente en mysql>, esto creara todas las tablas necesarias para las dos tablas necesarias para las pruebas:


-   Consulta la API de login en http://localhost:8000/api/usuarios/login.php

el formato de registro en json es: 

{
    "nombre": string,
    "documento_identidad": string,
    "correo_electronico": string,
    "clave": string,
    "tipo_usuario": 'comun' o 'comerciante',
    "saldo": float
}

-   Consulta la API de transacciones en http://localhost:8000/api/transferencias/Transaction.php

el formato para realizar una transaccion en json es: 

{
    "value": float,
    "payer": entero,
    "payee": entero
}

