<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call(PerfilesSeeder::class);
    $this->call(UsuariosSeeder::class);
    $this->call(ModuloTipoSeeder::class);
    $this->call(ModulosSeeder::class);
    $this->call(UsuariosModulosSeeder::class);
    $this->call(PlatosSeeder::class);
    $this->call(PromocionesSeeder::class);
  }
}
