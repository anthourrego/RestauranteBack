<?php

use Illuminate\Database\Seeder;

class UsuariosSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('usuarios')->insert([
      'id' => 1,
      'nro_documento' => "0000",
      'correo' => 'admin@admin.com',
      'nombres' => 'admin',
      'apellidos' => 'admin',
      'direccion' => 'sistema',
      'telefono' => '0000',
      'password' => '0000',
      'fk_perfil' => 1,
      'estado' => 1,
      'fk_creador' => 1,
      'created_at' => date('Y-m-d H:m:s'),
      'updated_at' => date('Y-m-d H:m:s'),
    ]);
  }
}
