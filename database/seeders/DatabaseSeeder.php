<?php

namespace Database\Seeders;

use App\Models\PerfilCliente;
use App\Models\PerfilEmpresa;
use App\Models\Proyecto;
use App\Models\Servicio;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         // Servicios
        $this->call(ServicioSeeder::class);

        // Usuario administrador
        User::create([
            'name'     => 'Administrador',
            'email'    => 'admin@topogest.com',
            'password' => bcrypt('password'),
            'role'     => 'admin',
        ]);

        // 5 empresas con su usuario cada una
        User::factory(5)->create(['role' => 'empresa'])->each(function ($user) {
            $perfil = PerfilEmpresa::factory()->create(['user_id' => $user->id]);

            // Asignar entre 2 y 4 servicios aleatorios a cada empresa
            $servicios = Servicio::inRandomOrder()->take(rand(2, 4))->pluck('id');
            $perfil->servicios()->attach($servicios);
        });

        // 10 clientes con su usuario cada uno
        User::factory(10)->create(['role' => 'cliente'])->each(function ($user) {
            PerfilCliente::factory()->create(['user_id' => $user->id]);
        });

        // Seeders de solicitudes y proyectos
        Solicitud::factory(15)->create();
        Proyecto::factory(10)->create();
    }
}
