
# PRUEBA PHP NATIVO

A continuación explicaré brevemente lo que se ha logrado completar de la prueba.
- Se ha realizado un CRUD funcional de la base de datos permitiendo al usuario editar, leer y eliminar libros.
- Si se desea eliminar un libro siempre se le preguntará al ususario si está seguro.
- Los formularios tienen consultas prametrizadas para prevenir vulnerabilidades.
- La inserción se realiza siempre desde la API mediante el ISBN para prevenir duplicidad en este código.
- La petición a la API se hace mediante CURL.
- Se tienen en cuenta diversos errores como añadir un ISBN que no existe en la API o añadir uno que ya existe en nuestra DB.



## INSTALACIÓN

He tenido problemas con la virtualización de docker y no he podido desplegarlo en este, de todas formas he dejado ejemplos del dockerfile y el docker-compose.yml.

Por ello he tenido que realizar el proyecto utilizando XAMPP, si desea probarlo de esta manera siga los siguientes pasos.

- Dirijase a la ruta donde tiene instalado XAMPP y entre en la carpeta htdocs (suele ser C:\xampp\htdocs).
- Despliegue tanto apache como MySQL.
- En el apartado de admid de MYSQL deberá importar la base de datos library.sql 
- Para poder ver la aplicación en funcionamiento deberá escribir en el en el navegador localhost/php-exam (si ha mantenido ese nombre para la carpeta raíz).




## Funcionamiento
- ![image](https://github.com/user-attachments/assets/79dc30c2-7f01-4aa8-bbd0-e14eb2018467)
  
En esta primera imagen puede ver dos formularios y una tabla, la tabla aparecerá siempre de manera predefinida una vez abierto el proyecto.
El primer formulario pedirá un ISBN, se hará una petición a la API y si devuelve algo lo intentará almacenar los datos en la base de datos en caso de que no exista.
(He tomado la decisión de almacenar estos datos en vez de la descripción puesto que dependiendo de libros, muchos tenian una estructura de JSON distinta)
No he utilizado ninguna librería externa y he decidido hacer este apartado con una petición CURL para hacerlo más rápido y sencillo.
- ![image](https://github.com/user-attachments/assets/66b622da-c0e9-468b-a80d-3f0e1e7d65ec)
- ![image](https://github.com/user-attachments/assets/0e317605-3f02-4fa5-87ec-d44da920e48e)
- ![image](https://github.com/user-attachments/assets/b44c2805-dfc6-462e-b9b6-c456b3f4aaf7)
  
El segundo formulario hace una busqueda en la base de datos por nombre, autor o isbn indistintamente.
- ![image](https://github.com/user-attachments/assets/18ecc684-5bfb-41b6-9bbf-72687773304e)
  
El botón de eliminar hace accionar un alert para confirmar q quieres eliminar ese libro.
- ![image](https://github.com/user-attachments/assets/51e66ee2-0ccd-4f5f-884c-04b0eee9296e)
  
Por último, el botón editar nos redirige a una nueva página con un formulario para editar el libro, una vez hecho volverá a la página principal.
- ![image](https://github.com/user-attachments/assets/ade794f7-7d6f-4559-9bed-ecd71a154232)


## BLOCKERS
Ahora expondré cuales han sido los mayores blockers que me han impedido acabar la tarea en el tiempo asignado:
- El Docker no se ha podido desplegar por un error en la virtualización de mi máquina, les he dejado los dos archivos de Docker como muestra.
- Este error ha desencadenado en otro con el PHPUNIT el cual me ha impedido realizar pruebas, puesto que detectaba q el mysqli no estaba instalado.

## CONCLUSIÓN
Me habría gustado acabar esta prueba sin errores, pero me ha pillado desprevenido la largaría de la misma, unido a incidencias que han aparecido en el trabajo y me han retrasado aún más.
De todas formas agradezco la oporunidad y espero que valoren el trabajo realizado :D
En cuanto a feedback por mi parte hacia la prueba, estaría bien que ya se diera un entorno desplegado o listo para ello para agilizar los ejercicios a los candidatos.

Muchas gracias, Javier Hermoso.


