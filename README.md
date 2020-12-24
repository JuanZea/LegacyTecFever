
# Reto Desarrolladores Junior
## Instalación
![Laravel 7.x](https://img.shields.io/badge/Laravel-7.x-f4645f.svg) ![Laravel 7.x](https://img.shields.io/badge/Php-7.4.x-8892BF.svg)
### Requisitos:

Necesita **php 7.4.x** en su sistema, encuentre las instrucciones de instalación haciendo [click aquí](https://www.php.net/downloads).

Necesita el framework **Laravel** en su versión **7.x** para ejecutar este proyecto, mire las instrucciones de instalación haciendo [click aquí](https://laravel.com/docs).

Para alojar el proyecto, y cargar una base de datos puede usar Laragon, descárguelo haciendo [click aquí](https://laragon.org/download/).


### Laravel 7.x:
 Puede descargar el proyecto en formato .zip o puede usar el siguiente comando desde git bash:
```shell
gh repo clone JuanZea/TecFever
```

## Inicialización
Para empezar debe correr las migraciones las cuales contienen los roles y permisos del proyecto, use el siguiente comando:
```shell
php artisan migrate:fresh --seed
```
Esto también creara **700 productos** en la tienda y **30 usuarios** de los cuales el primero tendrá el rol de administrador y sus credenciales serán:
```json
email: j@admin.com
password: password
```
Todos los usuarios creados con el comando anterior tendrán la contraseña: password.
## Requerimientos
El reto cuenta con requerimientos asignados para todas las **4 etapas**, a continuación se muestran los implementados en TecFever:
## Requerimientos técnicos para todas las etapas del reto
- [x] Usar GIT como sistema de gestión de versiones.
- [x] Formato de código usando PSR (PHP Standards Recommendations) :
  - [x] PSR 1: Basic Coding Standard.
  - [x] PSR 12: Extended Coding Style Guide.
- [x] Usar COMPOSER como herramienta de gestión de dependencias.
- [x] Usar separación por capas (mínimo MVC).
- [x] Usar Laravel como framework de desarrollo.
- [x] Flujo de trabajo basado en GIT-FLOW.
- [x] Desarrollo guiado por pruebas - TDD (Opcional en las etapas 1 y 2, requerido en las etapas 3 y 4).
- [x] Especificar los tipos de dato y tipo de retorno en la declaración de funciones y métodos.

## Etapa #1: PHP Básico (10 puntos)
>fecha de entrega: 29 de Junio
### Requerimientos funcionales:
- [x] Un cliente podrá registrarse y loguearse en el sistema.
- [x] Para evitar el ataque de bots o usuarios fake, el cliente deberá verificar su correo electrónico para completar el registro.
- [x] El administrador podrá gestionar sus clientes de tal manera que pueda verlos, actualizarlos, habilitarlos e inhabilitarlos.
### Requerimientos técnicos:
- [x] Uso de migraciones para la creación de la estructura de base de datos.
### Ítems que otorgan puntos extra
- [x] Uso de preprocesadores para la construcción de las vistas de usuario (SASS) ​(2 puntos) .
- [x] Uso de Laravel Mix para la construcción de los assets del proyecto (CSS, JS) ​(2 puntos) .
- [x] Adoptar la especificación ​“Conventional Commits”​ en el manejo del repositorio GIT (2 puntos) .

## Etapa #2: PHP Intermedio
>fecha de entrega: 2 de Agosto
### Requerimientos funcionales:
- [x] El administrador podrá gestionar sus productos de tal manera que pueda crearlos, actualizarlos, habilitarlos e inhabilitarlos.
- [x] Los clientes registrados podrán ver la lista de productos creados, de tal manera que puedan ver una vitrina de productos separados por páginas y sus datos como foto y precio.
- [x] Los clientes también podrán realizar una búsqueda personalizada de dichos productos para encontrar con rapidez lo que se está buscando.
### Requerimientos técnicos:
- [x] Hacer uso de variables de entorno
- [x] Validar todos los datos ingresados por el usuario al sistema
### Ítems que otorgan puntos extra
- [x] Uso de preprocesadores para la construcción de las vistas de usuario (SASS) ​(2 puntos) .
- [x] Uso de Laravel Mix para la construcción de los assets del proyecto (CSS, JS) ​(2 puntos) .
- [x] Adoptar la especificación ​“Conventional Commits”​ en el manejo del repositorio GIT (2 puntos) .
- [x] Implementación de herramientas de análisis estático (PHPStan) ​(3 puntos) .
- [x] Documentación de código (DocBlock) ​(2 puntos) .

## Etapa #3: PHP Avanzado
>fecha de entrega: 4 de Octubre
### Requerimientos funcionales:
- [x] Los clientes podrán visualizar los productos disponibles y adicionarlos a un carrito de compra.
- [x] El cliente podrá consultar su pedido y realizar modificaciones antes de confirmar la orden y proceder con el pago.
- [x] El pago debe realizarse con la pasarela de pagos de Placetopay. El sistema debe redireccionar al cliente al página de pagos de la pasarela. Una vez el usuario retorne al sistema este debe mostrarle el resultado del pago.
- [x] Las órdenes en el sistema deben tener un estado consistente con el estado de la transacción en la pasarela de pagos.
- [x] Los clientes deben poder revisar su historial de compras, y reintentar el pago de aquellas que no fueron satisfactorias.
### Requerimientos técnicos:
- [x] Integración con Web Checkout de Placetopay
### Ítems que otorgan puntos extra
- [x] Uso de preprocesadores para la construcción de las vistas de usuario (SASS) ​(2 puntos) .
- [x] Uso de Laravel Mix para la construcción de los assets del proyecto (CSS, JS) ​(2 puntos) .
- [x] Adoptar la especificación ​“Conventional Commits”​ en el manejo del repositorio GIT (2 puntos) .
- [x] Implementación de herramientas de análisis estático (PHPStan) ​(3 puntos) .
- [x] Documentación de código (DocBlock) ​(2 puntos) .
- [x] Implementar al menos un patrón de diseño ​(4 puntos).

## Etapa #4:
>fecha de entrega: 6 de Diciembre
### Requerimientos funcionales:
- [x] El administrador podrá importar al sistema de manera masiva una lista de productos en excel.
- [x] El administrador podrá descargar una lista en excel de los productos registrados para realizar su modificación y subirlos nuevamente al sistema de manera masiva.
- [x] El administrador podrá generar reportes del sistema con información relevante para la gestión de su negocio.
- [x] El uso de las funcionalidades del sistema debe estar permitido únicamente para aquellos usuarios con permisos (ACL).
- [x] El sistema debe permitir gestionar productos desde una API REST.
### Requerimientos técnicos:
- [x] La generación de reportes debe hacerse mediante trabajos encolados.
### Ítems que otorgan puntos extra
- [x] Uso de preprocesadores para la construcción de las vistas de usuario (SASS) ​(2 puntos) .
- [x] Uso de Laravel Mix para la construcción de los assets del proyecto (CSS, JS) ​(2 puntos) .
- [x] Implementar al menos un patrón de diseño ​(4 puntos).
- [x] Adoptar la especificación ​“Conventional Commits”​ en el manejo del repositorio GIT (2 puntos) .
- [x] Documentación de código (DocBlock) ​(2 puntos) .
- [x] Implementación de herramientas de análisis estático (PHPStan) ​(3 puntos) .
- [x] Implementación de herramientas de integración continua (Travis CI)​ (2 puntos) .
