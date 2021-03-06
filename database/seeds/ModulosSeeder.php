<?php

use Illuminate\Database\Seeder;

class ModulosSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('modulos')->insert([
      'nombre' => "usuarios",
      'tag' => 'Usuarios',
      'icono' => 'fas fa-users',
      'ruta' => 'usuarios',
      'fk_modulo_tipo' => 1,
      'fk_modulo' => 0,
      'estado' => 1,
      'fk_creador' => 1,
      'created_at' => date('Y-m-d H:m:s'),
      'updated_at' => date('Y-m-d H:m:s'),
    ]);
    DB::table('modulos')->insert([
      'nombre' => "platos",
      'tag' => 'Platos',
      'icono' => 'fas fa-hamburger',
      'ruta' => 'platos',
      'fk_modulo_tipo' => 1,
      'fk_modulo' => 0,
      'estado' => 1,
      'fk_creador' => 1,
      'created_at' => date('Y-m-d H:m:s'),
      'updated_at' => date('Y-m-d H:m:s'),
    ]);
    DB::table('modulos')->insert([
      'nombre' => "pedidos",
      'tag' => 'Pedidos',
      'icono' => 'fas fa-shopping-cart',
      'ruta' => 'pedidos',
      'fk_modulo_tipo' => 1,
      'fk_modulo' => 0,
      'estado' => 1,
      'fk_creador' => 1,
      'created_at' => date('Y-m-d H:m:s'),
      'updated_at' => date('Y-m-d H:m:s'),
    ]);
  }
}
