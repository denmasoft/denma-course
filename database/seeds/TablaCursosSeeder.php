<?php

use Illuminate\Database\Seeder;
use App\Curso;
class TablaCursosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$users = factory(App\Curso::class, 15)->create();
		/*foreach ($users as $user) {
			$user->assignRole('basico');
		}*/
    }
}
