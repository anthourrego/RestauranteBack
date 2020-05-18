<?php

use Illuminate\Database\Seeder;

class PromocionesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('promociones')->insert([
      'fk_plato' => 1,
      'descripcion' => 'N/A',
      'precio' => 0,
      'estado' => 1,
      'fk_creador' => 1,
      'created_at' => date('Y-m-d H:m:s'),
      'updated_at' => date('Y-m-d H:m:s'),
    ]);
  }
}
