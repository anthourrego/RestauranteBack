<?php

use Illuminate\Database\Seeder;

class PlatosSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('platos')->insert([
      'nombre' => 'N/A',
      'descripcion' => 'N/A',
      'imagen' => 'N/A',
      'estado' => 1,
      'plato_dia' => 0,
      'promocion' => 0,
      'precio' => 0,
      'fk_creador' => 1,
      'created_at' => date('Y-m-d H:m:s'),
      'updated_at' => date('Y-m-d H:m:s'),
    ]);
  }
}
