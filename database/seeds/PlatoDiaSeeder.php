<?php

use Illuminate\Database\Seeder;

class PlatoDiaSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('plato_dias')->insert([
      'fk_plato' => 1,
      'descripcion' => 'N/A',
      'precio' => 0,
      'fecha_aplicacion' => date('Y-m-d'),
      'fk_creador' => 1,
      'created_at' => date('Y-m-d H:m:s'),
      'updated_at' => date('Y-m-d H:m:s'),
    ]);
  }
}
