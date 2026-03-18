<?php

namespace App\Actions\Fortify;

use App\Models\PerfilCliente;
use App\Models\PerfilEmpresa;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input): User
    {
        // Validación común
        $rules = [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'role' => ['required', 'in:cliente,empresa'],
        ];

        // Validación según rol
        if ($input['role'] === 'empresa') {

            $rules['nombre_fiscal'] = ['required', 'string', 'max:255'];
            $rules['nif_cif'] = ['required', 'string', 'max:20'];
            $rules['provincia'] = ['required', 'string', 'max:100'];
        } else {
            $rules['name'] = ['required', 'string', 'max:255'];
            $rules['nif_nie'] = ['nullable', 'string', 'max:20'];
            $rules['telefono'] = ['nullable', 'string', 'max:20'];
            $rules['direccion'] = ['nullable', 'string', 'max:255'];
            $rules['provincia'] = ['nullable', 'string', 'max:100'];
        }

        Validator::make($input, $rules)->validate();

        return DB::transaction(function () use ($input) {

            $user = User::create([
                'name' => $input['role'] === 'empresa' ? $input['nombre_fiscal'] : $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'role' => $input['role'],
            ]);

            if ($input['role'] === 'empresa') {
                PerfilEmpresa::create([
                    'user_id' => $user->id,
                    'nombre_fiscal' => $input['nombre_fiscal'],
                    'nif_cif' => $input['nif_cif'],
                    'descripcion' => $input['descripcion'] ?? null,
                    'provincia' => $input['provincia'],
                    'telefono' => $input['telefono'] ?? null,
                    'logo_path' => null,
                    'visible_directorio' => isset($input['visible']) ? true : false,
                ]);
            } else {
                PerfilCliente::create([
                    'user_id' => $user->id,
                    'nombre_completo' => $input['name'],
                    'nif_nie' => $input['nif_nie'] ?? null,
                    'telefono' => $input['telefono'] ?? null,
                    'direccion' => $input['direccion'] ?? null,
                    'provincia' => $input['provincia'] ?? null,
                ]);
            }

            return $user;
        });
    }
}