<?php

use Illuminate\Database\Seeder;

class PerfilesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('perfiles')->insert([
      'nombre' => "Adminitrador",
      'estado' => 1,
      'fk_creador' => 1,
      'created_at' => date('Y-m-d H:m:s'),
      'updated_at' => date('Y-m-d H:m:s'),
    ]);
    DB::table('perfiles')->insert([
      'nombre' => "Usuario",
      'estado' => 1,
      'fk_creador' => 1,
      'created_at' => date('Y-m-d H:m:s'),
      'updated_at' => date('Y-m-d H:m:s'),
    ]);
  }
}
