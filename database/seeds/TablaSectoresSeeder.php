<?php

use Illuminate\Database\Seeder;
use App\Sector;
class TablaSectoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Sector::create([
            'nombre' => 'Actividades administrativas e servizos auxiliares',
        ]);
        $user = Sector::create([
            'nombre' => 'Actividades artísticas, recreativas e de entretemento',
        ]);
        $user = Sector::create([
            'nombre' => 'Actividades financeiras e de seguros',
        ]);
        $user = Sector::create([
            'nombre' => 'Actividades profesionais, científicas e técnicas',
        ]);
        $user = Sector::create([
            'nombre' => 'Actividades sanitarias e de servizos sociais',
        ]);
        $user = Sector::create([
            'nombre' => 'Administración pública',
        ]);
        $user = Sector::create([
            'nombre' => 'Agricultura, gandería, silvicultura, pesca',
        ]);
        $user = Sector::create([
            'nombre' => 'Comercio',
        ]);
        $user = Sector::create([
            'nombre' => 'Educación',
        ]);
        $user = Sector::create([
            'nombre' => 'Hostelaría',
        ]);
        $user = Sector::create([
            'nombre' => 'Industria',
        ]);
        $user = Sector::create([
            'nombre' => 'Información e comunicacións',
        ]);
        $user = Sector::create([
            'nombre' => 'Transporte',
        ]);

    }
}
