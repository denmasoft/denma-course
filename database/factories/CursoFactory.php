<?php

use Faker\Generator as Faker;

$factory->define(App\Curso::class, function (Faker $faker) {
    return [
    /*
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    */
        'nombre' => $faker->sentence(4, true),
        'lugar_celebracion' => $faker->address,
        'fecha_inicio' => $faker->date,
        'fecha_fin' => $faker->date,
        'hora_inicio' => $faker->time,
        'hora_fin' => $faker->time,
        'duracion_horas' => $faker->randomDigit,
        'plazas_total' => $faker->randomDigit,
        'plazas_disponibles' => $faker->randomDigit,
        'edades_recomendadas' => $faker->randomDigit,
        'pertenece_fie' => $faker->boolean,
        'contenido' => $faker->text,
    ];
});
