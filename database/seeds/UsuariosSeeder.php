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
      'password' => '$2y$15$Pbu7Qq9uCceP7wAJ/ZGW3uaJklO89Xk5.ZzKeFfJ63NPdUvbPzxaO',
      'fk_perfil' => 1,
      'estado' => 1,
      'fk_creador' => 1,
      'created_at' => date('Y-m-d H:m:s'),
      'updated_at' => date('Y-m-d H:m:s'),
    ]);
  }
}
