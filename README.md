# PlanificadorDesarrollo de un sistema web para la creación y control de las planificaciones docentes## Mapa de la carpeta del proyecto[poner aquí el archivo generado para mostrar el árbol de directorios]### Base de datosMostramos las tablas utilizadas dentro de las base de datos:* roles* usuarios* grados* materias* materiasniveles* unidades* contenidos* asignaciones* planificaciones* plandetalles* recursos## Carpeta \application### views* comun* errors* inicio* perfiles* roles* profesores#### inicioEste archivo es una sola vista de la página principal para iniciar sesión, por lo cual no depende de los archivos **header** y **footer** contenido en la carpeta **comun**.Estilos personalizados:<pre><code>línea 47<br>&lt;style&gt; .estilos{} &lt;/style&gt;</code></pre><hr>Vista del **Login**:<pre><code>línea 115<br>&lt;div class="container"&gt;	&lt;!-- VISTA LOGIN --&gt;	&lt;?php $this->load->view('inicio/login'); ?&gt;&lt;/div&gt;</code></pre><hr>