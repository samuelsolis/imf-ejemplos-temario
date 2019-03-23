<?php

class Schema {

  public function getSchema() {
    $tables = array();
    $tables['usuarios'] = array(
      'email' => 'varchar(255) NOT NULL UNIQUE',
	    'nombre' => 'varchar(255) NOT NULL',
	    'apellidos' => 'varchar(255)',
	    'telefono' => 'char(9)',
      'primary key' => '(email)',
    );

    $tables['colores'] = array(
      'nombre' => 'varchar(255) NOT NULL UNIQUE',
      'valor_hex' => 'char(7) NOT NULL UNIQUE',
      'precio' => 'float',
      'primary key' => '(valor_hex)',
    );

    $tables['coches'] = array(
      'id' => 'int NOT NULL UNIQUE AUTO_INCREMENT',
      'marca' => 'varchar(255) NOT NULL UNIQUE',
      'modelo' => 'varchar(255) NOT NULL',
      'matricula' => 'varchar(255) NOT NULL',
      'color' => 'char(7)',
      'propietario' => 'varchar(255) NOT NULL',
      'primary key' => '(id)',
    );

    $tables['conductores'] = array(
      'id' => 'int NOT NULL UNIQUE AUTO_INCREMENT',
      'email' => 'varchar(255) NOT NULL',
      'coche' => 'int NOT NULL',
      'primary key' => '(id)',

    );
    return $tables;
  }
}