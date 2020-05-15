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
      'id' => 0,
      'descripcion' => 'N/A',
      'imagen' => 'N/A',
      'estado' => 1,
      'precio' => 0,
      'fk_creador' => 1,
      'created_at' => date('Y-m-d H:m:s'),
      'updated_at' => date('Y-m-d H:m:s'),
    ]);
  }
}
