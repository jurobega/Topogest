<?php

namespace Database\Seeders;

use App\Models\DocumentoProyecto;
use App\Models\DocumentoSolicitud;
use App\Models\LineaPresupuesto;
use App\Models\MensajeProyecto;
use App\Models\MensajeSolicitud;
use App\Models\PerfilCliente;
use App\Models\PerfilEmpresa;
use App\Models\Presupuesto;
use App\Models\Proyecto;
use App\Models\Servicio;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Servicios base
        $this->call(ServicioSeeder::class);

        $servicios = Servicio::all();

        // 2. Usuarios base
        User::factory()->create([
            'name' => 'Admin TopoGest',
            'email' => 'admin@topogest.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $usuariosEmpresa = User::factory(5)->create([
            'role' => 'empresa',
        ]);

        $usuariosCliente = User::factory(10)->create([
            'role' => 'cliente',
        ]);

        // 3. Perfiles de empresa
        foreach ($usuariosEmpresa as $user) {
            $empresa = PerfilEmpresa::factory()->create([
                'user_id' => $user->id,
            ]);

            if ($servicios->isNotEmpty()) {
                $cantidadServicios = min($servicios->count(), rand(2, 4));

                $empresa->servicios()->attach(
                    $servicios->random($cantidadServicios)->pluck('id')->toArray()
                );
            }
        }

        // 4. Perfiles de cliente
        foreach ($usuariosCliente as $user) {
            PerfilCliente::factory()->create([
                'user_id' => $user->id,
            ]);
        }

        $empresas = PerfilEmpresa::all();
        $clientes = PerfilCliente::all();

        if ($empresas->isEmpty() || $clientes->isEmpty()) {
            return;
        }

        // 5. Solicitudes
        foreach ($clientes as $cliente) {
            Solicitud::factory(rand(2, 4))->create([
                'cliente_id' => $cliente->id,
                'empresa_id' => $empresas->random()->id,
                'servicio_id' => $servicios->isNotEmpty() ? $servicios->random()->id : null,
            ]);
        }

        $solicitudes = Solicitud::all();

        // 6. Crear mínimo 2 proyectos por cliente
        foreach ($clientes as $index => $cliente) {
            for ($i = 0; $i < 2; $i++) {
                $empresa = $empresas[($index + $i) % $empresas->count()];

                $solicitud = $solicitudes
                    ->where('cliente_id', $cliente->id)
                    ->where('empresa_id', $empresa->id)
                    ->first();

                Proyecto::factory()->create([
                    'cliente_id' => $cliente->id,
                    'empresa_id' => $empresa->id,
                    'solicitud_id' => $solicitud?->id,
                ]);
            }
        }

        // 7. Asegurar mínimo 2 proyectos por empresa
        foreach ($empresas as $index => $empresa) {
            $proyectosActuales = Proyecto::where('empresa_id', $empresa->id)->count();
            $faltan = max(0, 2 - $proyectosActuales);

            for ($i = 0; $i < $faltan; $i++) {
                $cliente = $clientes[($index + $i) % $clientes->count()];

                $solicitud = $solicitudes
                    ->where('cliente_id', $cliente->id)
                    ->where('empresa_id', $empresa->id)
                    ->first();

                Proyecto::factory()->create([
                    'cliente_id' => $cliente->id,
                    'empresa_id' => $empresa->id,
                    'solicitud_id' => $solicitud?->id,
                ]);
            }
        }

        $proyectos = Proyecto::all();

        MensajeProyecto::factory(30)->create();

        // 8. Documentos de proyecto
        foreach ($proyectos as $proyecto) {
            DocumentoProyecto::factory(rand(2, 5))->create([
                'proyecto_id' => $proyecto->id,
                'subido_por' => User::query()->inRandomOrder()->value('id'),
            ]);
        }

        // 9. Documentos de solicitud
        foreach ($solicitudes as $solicitud) {
            DocumentoSolicitud::factory(rand(1, 3))->create([
                'solicitud_id' => $solicitud->id,
            ]);
        }

        // 10. Mensajes de solicitud
        foreach ($solicitudes as $solicitud) {
            MensajeSolicitud::factory(rand(2, 6))->create([
                'solicitud_id' => $solicitud->id,
            ]);
        }

        // 11. Presupuestos para parte de los proyectos
        if ($proyectos->isNotEmpty()) {
            $proyectosConPresupuesto = $proyectos->random(
                min($proyectos->count(), max(3, intdiv($proyectos->count(), 2)))
            );

            foreach ($proyectosConPresupuesto as $proyecto) {
                $presupuesto = Presupuesto::factory()->create([
                    'proyecto_id' => $proyecto->id,
                ]);

                LineaPresupuesto::factory(rand(2, 5))->create([
                    'presupuesto_id' => $presupuesto->id,
                ]);
            }
        }
    }
}