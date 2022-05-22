CREATE DATABASE planificador;
    USE planificador;

    
    CREATE TABLE roles
        (
            idRol INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            rol   VARCHAR(10)
        )
        ENGINE=INNODB
    ;
    
    CREATE TABLE usuarios
        (
            idUsuario INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            nombre    VARCHAR(35),
            apellido  VARCHAR(35),
            correo    VARCHAR(50),
            telefono  VARCHAR(9),
            usuario   VARCHAR(20),
            clave     VARCHAR(255),
            idRol     INT,
            FOREIGN KEY (idRol) REFERENCES roles(idRol)
        )
        ENGINE=INNODB
    ;

    CREATE TABLE grados
        (
            idGrado INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            nivel  INT(2),
            tipo   VARCHAR(2), -- tipo Varchar(2) ['P','B','M'] "En la vista usaremos un combobox con el nombre real y solo se envía el símbolo a seleccionar"
            seccion VARCHAR(50) -- Varchar(15) [Usando el nombre completo del grupo: Primer Grado A, Segundo Grado B, Tercer Grado C,...General A, General B, Contador A,...]
        )
        ENGINE=INNODB
    ;

    CREATE TABLE materias
        (
            idMateria INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            materia    VARCHAR(45)
        )
        ENGINE=INNODB
    ;

    CREATE TABLE materiasNiveles(
        idMateriaNivel INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
        idGrado INT,
        idMateria INT,
        FOREIGN KEY (idGrado) REFERENCES grados(idGrado),
        FOREIGN KEY (idMateria) REFERENCES materias(idMateria)
    )ENGINE=InnoDB;

    CREATE TABLE unidades(
        idUnidad INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
        idMateriaNivel INT,
        unidad INT(2),
        nombreUnidad VARCHAR(60),
        FOREIGN KEY (idMateriaNivel) REFERENCES materiasNiveles(idMateriaNivel)
    )ENGINE=InnoDB;

    CREATE TABLE contenidos(
        idContenido INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
        idUnidad INT,
        correlativo VARCHAR(10),
        tema VARCHAR(100),
        FOREIGN KEY (idUnidad) REFERENCES unidades(idUnidad)
    )ENGINE=InnoDB;

    CREATE TABLE asignaciones(
        idAsignacion INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
        idUsuario INT,
        idMateriaNivel INT,
        FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario),
        FOREIGN KEY (idMateriaNivel) REFERENCES materiasNiveles(idMateriaNivel)
    )ENGINE=InnoDB;
    
    CREATE TABLE planificaciones
        (
            idPlanificacion INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            idAsignacion INT,
            anio INT(4),
            FOREIGN KEY (idAsignacion) REFERENCES asignaciones(idAsignacion)
        )
        ENGINE=INNODB
    ;
    
    CREATE TABLE planDetalles
        (
            idPlanDetalle INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            idPlanificacion INT,
            desde DATE,
            hasta DATE,
            idContenido INT, 
            ejecutado DATE,
            FOREIGN KEY (idPlanificacion) REFERENCES planificaciones(idPlanificacion),
            FOREIGN KEY (idContenido) REFERENCES contenidos(idContenido)
        )
        ENGINE=INNODB
    ;

    CREATE TABLE recursos
        (
            idRecurso INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            idPlanDetalle INT,
            recurso VARCHAR(255),
            tipo ENUM('enlace','archivo'),
            FOREIGN KEY (idPlanDetalle) REFERENCES planDetalles(idPlanDetalle)
        )
        ENGINE=INNODB
    ;