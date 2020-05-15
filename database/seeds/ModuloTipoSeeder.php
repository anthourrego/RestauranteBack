<?php

use Illuminate\Database\Seeder;

class ModuloTipoSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('modulo_tipos')->insert([
      'nombre' => "Modulo",
      'estado' => 1,
      'fk_creador' => 1,
      'created_at' => date('Y-m-d H:m:s'),
      'updated_at' => date('Y-m-d H:m:s'),
    ]);
    DB::table('modulo_tipos')->insert([
      'nombre' => "Permisos",
      'estado' => 1,
      'fk_creador' => 1,
      'created_at' => date('Y-m-d H:m:s'),
      'updated_at' => date('Y-m-d H:m:s'),
    ]);
  }
}
