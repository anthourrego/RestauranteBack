<?php

use Illuminate\Database\Seeder;

class UsuariosModulosSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('usuarios_modulos')->insert([
      'fk_modulo' => 1,
      'fk_usuario' => 1,
      'fk_creador' => 1,
      'estado' => 1,
      'fk_creador' => 1,
      'created_at' => date('Y-m-d H:m:s'),
      'updated_at' => date('Y-m-d H:m:s'),
    ]);
    DB::table('usuarios_modulos')->insert([
      'fk_modulo' => 2,
      'fk_usuario' => 1,
      'fk_creador' => 1,
      'estado' => 1,
      'fk_creador' => 1,
      'created_at' => date('Y-m-d H:m:s'),
      'updated_at' => date('Y-m-d H:m:s'),
    ]);
    DB::table('usuarios_modulos')->insert([
      'fk_modulo' => 3,
      'fk_usuario' => 1,
      'fk_creador' => 1,
      'estado' => 1,
      'fk_creador' => 1,
      'created_at' => date('Y-m-d H:m:s'),
      'updated_at' => date('Y-m-d H:m:s'),
    ]);
  }
}
