CREATE DATABASE bdbalon;
USE bdbalon;

CREATE TABLE proveedor (
  id_prov int(11) PRIMARY KEY AUTO_INCREMENT,
  ruc_prov varchar(11) NOT NULL,
  razsoc_prov varchar(50) NOT NULL,
  direccion_prov varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE balon (
  id_bal int(11) PRIMARY KEY AUTO_INCREMENT,
  nombre_bal varchar(50) NOT NULL,
  total_bal int NOT NULL,
  cantidad_bal int NOT NULL,
  marca_bal varchar(50) NOT NULL,
  peso_bal decimal(6,2) NOT NULL,
  color_bal varchar(20),
  precio_bal decimal(6,2) NOT NULL,
  tipo_bal varchar(4) NOT NULL,
  categoria_bal varchar(7) NOT NULL,
  estado_bal int(1) NOT NULL,
  codigo_fac CHAR(5) NOT NULL,
  barcode_bal CHAR(8) NOT NULL,
  id_prov int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*
estado_bal = 1 => activo
estado_bal = 2 => inactivo
estado_bal = 3 => agotado
*/
ALTER TABLE balon
ADD CONSTRAint fk_prov_bal
FOREIGN KEY (id_prov)
REFERENCES proveedor(id_prov);

CREATE TABLE balon_prestamo (
  id_balpre int(11) PRIMARY KEY AUTO_INCREMENT,
  fecini_balpre datetime NOT NULL,
  fecfin_balpre datetime NULL,
  total_balpre int NOT NULL,
  cantidad_balpre int NOT NULL,
  estado_balpre int(1) NOT NULL,
  id_bal int(11) NOT NULL,
  id_pre int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE cliente (
  id_cli int(11) PRIMARY KEY AUTO_INCREMENT,
  nombres_cli varchar(100) NOT NULL,
  tipdoc_cli int(1) NOT NULL,
  numdoc_cli varchar(11) NOT NULL,
  direccion_cli varchar(300) NOT NULL,
  correo_cli varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE personal (
  id_per int(11) PRIMARY KEY AUTO_INCREMENT,
  nombre_per varchar(50) NOT NULL,
  apellido_per varchar(50) NOT NULL,
  nacionalidad_per varchar(20) NOT NULL,
  tipo_per VARCHAR(20) NOT NULL,
  tipdoc_per varchar(10) NOT NULL,
  numdoc_per varchar(11) NOT NULL,
  tipo_user char(5) NOT NULL,
  usuario_per VARCHAR(20) NULL,
  clave_per VARCHAR(30) NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE prestamo (
  id_pre int(11) PRIMARY KEY AUTO_INCREMENT,
  tipo_pre int(11) NOT NULL,
  fecha_pre datetime NOT NULL,
  fecreg_pre datetime,
  total_pre int(11) NOT NULL,
  cantidad_pre int(11) NOT NULL,
  motivo_pre varchar(100) NOT NULL,
  id_cli int(11) NOT NULL,
  id_per int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE registrobalon (
  id_regbal int(11) PRIMARY KEY AUTO_INCREMENT,
  fecha_regbal datetime NOT NULL,
  cantidad_regbal int(11) NOT NULL,
  id_bal int(11) NOT NULL,
  id_per int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE registrobalon_prestamo (
  id_regbalpre int(11) PRIMARY KEY AUTO_INCREMENT,
  fecha_regbalpre datetime NOT NULL,
  cantidad_regbalpre int(11) NOT NULL,
  id_balpre int(11) NOT NULL,
  id_per int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE vehiculo (
  id_veh int(11) PRIMARY KEY AUTO_INCREMENT,
  descripcion_veh VARCHAR(20) NOT NULL,
  placa_veh VARCHAR(10) NOT NULL,
  tipo_veh VARCHAR(10) NOT NULL,
  kilometraje_veh DECIMAL(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE salidas (
  id_sal int(11) PRIMARY KEY AUTO_INCREMENT,
  chofer_sal VARCHAR(30) NOT NULL,
  ayudante_sal VARCHAR(30) NOT NULL,
  promotor_sal VARCHAR(30) NOT NULL,
  kilini_sal DECIMAL(10,2) NULL,
  kilfin_sal DECIMAL(10,2) NULL,
  fecini_sal DATETIME NOT NULL,
  fecfin_sal DATETIME NULL,
  id_veh int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/* NUEVO */
CREATE TABLE movimiento (
  id_mov int(11) PRIMARY KEY AUTO_INCREMENT,
  cantidad_mov int(11) NOT NULL,
  regreso_mov int(11) NULL,
  id_bal int(11) NOT NULL,
  id_sal int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE venta (
  id_ven int(11) PRIMARY KEY AUTO_INCREMENT,
  fecini_ven DATETIME NOT NULL,
  fecfin_ven DATETIME,
  moneda_ven INT(1) NOT NULL,
  tipo_comprobante INT(1) NOT NULL,
  tipo_pago INT(1) NOT NULL,
  tipo_operacion INT (1) NOT NULL,
  serie_ven CHAR(4) NOT NULL,
  correlativo_ven INT NOT NULL,
  importe_ven DECIMAL(10,2) NOT NULL,
  igv_ven DECIMAL(10,2) NOT NULL,
  total_ven DECIMAL(10,2) NOT NULL,
  estado_ven INT NOT NULL,
  nota_credito INT NULL,
  id_cli INT NOT NULL,
  id_per INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE balon_venta (
  id_balven int(11) PRIMARY KEY AUTO_INCREMENT,
  fecreg_balven DATETIME NOT NULL,
  descripcion_balven VARCHAR(50),
  cantidad_balven DECIMAL(10,2) NOT NULL,
  igv_balven DECIMAL(10,2) NOT NULL,
  valor_unitario DECIMAL(10,2) NOT NULL,
  precio_unitario DECIMAL(10,2) NOT NULL,
  descuento_balven DECIMAL(10,2) NOT NULL,
  valor_balven DECIMAL(10,2) NOT NULL,
  id_bal INT NOT NULL,
  id_ven INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE proforma (
  id_pro int(11) PRIMARY KEY AUTO_INCREMENT,
  fecini_ven DATETIME NOT NULL,
  fecfin_ven DATETIME,
  moneda_ven INT(1) NOT NULL,
  tipo_comprobante INT(1) NOT NULL,
  tipo_pago INT(1) NULL,
  tipo_operacion INT (1) NOT NULL,
  serie_ven CHAR(4) NOT NULL,
  correlativo_ven INT NOT NULL,
  importe_ven DECIMAL(10,2) NOT NULL,
  igv_ven DECIMAL(10,2) NOT NULL,
  total_ven DECIMAL(10,2) NOT NULL,
  estado_pro INT(1) NOT NULL,
  id_cli INT NOT NULL,
  id_per INT NOT NULL,
  id_ven INT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE balon_proforma (
  id_balpro int(11) PRIMARY KEY AUTO_INCREMENT,
  fecreg_balven DATETIME NOT NULL,
  descripcion_balven VARCHAR(50),
  cantidad_balven DECIMAL(10,2) NOT NULL,
  igv_balven DECIMAL(10,2) NOT NULL,
  valor_unitario DECIMAL(10,2) NOT NULL,
  precio_unitario DECIMAL(10,2) NOT NULL,
  descuento_balven DECIMAL(10,2) NOT NULL,
  valor_balven DECIMAL(10,2) NOT NULL,
  id_bal INT NOT NULL,
  id_pro INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE ubigeo (
  id_ubi int(11) PRIMARY KEY AUTO_INCREMENT,
  nombre_ubi varchar(255) NOT NULL,
  acronimo_ubi varchar(45) NOT NULL,
  estado_ubi int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE guiaremision (
  id_gui int(11) PRIMARY KEY AUTO_INCREMENT,
  serie_gui char(4) NOT NULL,
  correlativo_gui  int NOT NULL,
  fecemi_gui date NOT NULL,
  observacion_gui varchar(100) NOT NULL,
  ubigeoori_gui int NOT NULL,
  direccionori varchar(150) NOT NULL,
  ubigeodes_gui int NOT NULL,
  direcciondes varchar(150) NOT NULL,
  tipoenvio int NOT NULL,
  fecenvio date NOT NULL,
  cantbultos int NOT NULL,
  peso int NOT NULL,
  movilidad varchar(5) NOT NULL,
  transportista int NOT NULL,
  id_cli int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE balon_guia (
  id_balgui int(11) PRIMARY KEY AUTO_INCREMENT,
  cantidad_balgui int NOT NULL,
  detalle_balgui varchar(150) NOT NULL,
  id_bal int NOT NULL,
  id_gui int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE guiatransportista (
  id_guitra int(11) PRIMARY KEY AUTO_INCREMENT,
  fecha_guitra datetime NOT NULL,
  nombres_guitra varchar(50) NOT NULL,
  puntopartida_guitra varchar(150) NOT NULL,
  ruc_guitra CHAR(11) NULL,
  puntollegada_guitra varchar(150) NOT NULL,
  placa_guitra VARCHAR(10) NOT NULL,
  nconstancia_guitra char(20) NOT NULL,
  nlicencia_guitra char(20) NOT NULL,
  serie_ven CHAR(5) NOT NULL,
  numero_ven INT NOT NULL,
  tipo_producto CHAR(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE clientemaps (
  id_climap INT PRIMARY KEY AUTO_INCREMENT,
  fecha_climap DATETIME NOT NULL,
  lat_climap VARCHAR(20),
  long_climap VARCHAR(20),
  id_cli INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE repartidormaps (
  id_repmap INT PRIMARY KEY AUTO_INCREMENT,
  fecha_repmap DATETIME NOT NULL,
  lat_repmap VARCHAR(20),
  long_repmap VARCHAR(20),
  id_per INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE rutasmaps (
  id_rutmap INT PRIMARY KEY AUTO_INCREMENT,
  fecha_rutmap DATETIME NOT NULL,
  lat_ori VARCHAR(20) NOT NULL,
  lng_ori VARCHAR(20) NOT NULL,
  lat_des VARCHAR(20) NOT NULL,
  lng_des VARCHAR(20) NOT NULL,
  id_repmap INT NOT NULL,
  id_ven INT NOT NULL,
  id_per INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE estadoventa(
  id_estven INt PRIMARY KEY AUTO_INCREMENT,
    nombre_estven VARCHAR(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE movimiento
  ADD CONSTRAint fk_bal_mov FOREIGN KEY (id_bal) REFERENCES balon (id_bal),
  ADD CONSTRAint fk_sal_mov FOREIGN KEY (id_sal) REFERENCES salidas (id_sal);

/* FIN NUEVO */

ALTER TABLE balon_prestamo
  ADD CONSTRAint fk_bal_balpre FOREIGN KEY (id_bal) REFERENCES balon (id_bal),
  ADD CONSTRAint fk_pre_pre FOREIGN KEY (id_pre) REFERENCES prestamo (id_pre);

ALTER TABLE prestamo
  ADD CONSTRAint fk_cli_pre FOREIGN KEY (id_cli) REFERENCES cliente (id_cli),
  ADD CONSTRAint fk_per_pre FOREIGN KEY (id_per) REFERENCES personal (id_per);

ALTER TABLE registrobalon
  ADD CONSTRAint fk_bal_regbal FOREIGN KEY (id_bal) REFERENCES balon (id_bal),
  ADD CONSTRAint fk_per_regbal FOREIGN KEY (id_per) REFERENCES personal (id_per);

ALTER TABLE salidas
  ADD CONSTRAint fk_veh_sal FOREIGN KEY (id_veh) REFERENCES vehiculo (id_veh);

ALTER TABLE venta
  ADD CONSTRAint fk_cli_ven FOREIGN KEY (id_cli) REFERENCES cliente (id_cli),
  ADD CONSTRAint fk_per_ven FOREIGN KEY (id_per) REFERENCES personal (id_per);

ALTER TABLE balon_venta
  ADD CONSTRAint fk_bal_balven FOREIGN KEY (id_bal) REFERENCES balon (id_bal),
  ADD CONSTRAint fk_ven_balven FOREIGN KEY (id_ven) REFERENCES venta (id_ven);

ALTER TABLE proforma
  ADD CONSTRAint fk_cli_pro FOREIGN KEY (id_cli) REFERENCES cliente (id_cli),
  ADD CONSTRAint fk_per_pro FOREIGN KEY (id_per) REFERENCES personal (id_per);

ALTER TABLE balon_proforma
  ADD CONSTRAint fk_bal_balpro FOREIGN KEY (id_bal) REFERENCES balon (id_bal),
  ADD CONSTRAint fk_pro_balpro FOREIGN KEY (id_pro) REFERENCES proforma (id_pro);

ALTER TABLE balon_guia
  ADD CONSTRAint fk_gui_balgui FOREIGN KEY (id_gui) REFERENCES guiaremision (id_gui);

ALTER TABLE rutasmaps
  ADD CONSTRAint fk_repmap_rutmap FOREIGN KEY (id_repmap) REFERENCES repartidormaps (id_repmap),
  ADD CONSTRAint fk_ven_rutmap FOREIGN KEY (id_ven) REFERENCES venta (id_ven);

ALTER TABLE venta
  ADD CONSTRAint fk_estven_ven FOREIGN KEY (estado_ven) REFERENCES estadoventa (id_estven);

INSERT into personal(id_per, nombre_per, apellido_per, nacionalidad_per, tipo_per, tipdoc_per, numdoc_per, usuario_per, clave_per)
VALUES (NULL,'Admin','Admin',' ','administrador','DNI',' ','admin','123');

INSERT INTO estadoventa (id_estven, nombre_estven) VALUES
  (1, 'anulado'),
  (2, 'creado'),
  (3, 'anulado por nota'),
  (4, 'asignado'),
  (5, 'entregado');





/* cambios en vehiculo */
ALTER TABLE `vehiculo` ADD `polemi_veh` DATE NOT NULL AFTER `kilometraje_veh`, ADD `polven_veh` DATE NOT NULL AFTER `polemi_veh`, ADD `moncob_pol` DECIMAL(6,2) NOT NULL AFTER `polven_veh`, ADD `soatemi_veh` DATE NOT NULL AFTER `moncob_pol`, ADD `soatven_veh` DATE NOT NULL AFTER `soatemi_veh`;

CREATE TABLE pago (
  id_pago INT PRIMARY KEY AUTO_INCREMENT,
  fecha_pago TIMESTAMP,
    modo_pago INT NOT NULL,
    nutarjeta_pago INT(4) NULL,
    observacion_pago VARCHAR(50),
    monto_pago DECIMAL(8,2) NOT NULL,
    id_ven INT NOT NULL,
    id_per INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE pago
  ADD CONSTRAint fk_ven_pag FOREIGN KEY (id_ven) REFERENCES venta (id_ven),
  ADD CONSTRAint fk_per_pag FOREIGN KEY (id_per) REFERENCES personal (id_per);


CREATE TABLE balon_guitra (
  id_balguitra INT PRIMARY KEY AUTO_INCREMENT,
  cantidad_balguitra INT NOT NULL,
  id_guitra INT NOT NULL,
  id_bal INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE balon_guitra
  ADD CONSTRAint fk_guitra_balguitra FOREIGN KEY (id_guitra) REFERENCES guiatransportista (id_guitra),
  ADD CONSTRAint fk_bal_balguitra FOREIGN KEY (id_bal) REFERENCES balon (id_bal);

CREATE TABLE templeado (
  id_temp INT PRIMARY KEY AUTO_INCREMENT,
  nota_temp VARCHAR(20) NOT NULL
)

ALTER TABLE empleado ADD CONSTRAint fk_temp_emp FOREIGN KEY (id_temp) REFERENCES templeado (id_temp),