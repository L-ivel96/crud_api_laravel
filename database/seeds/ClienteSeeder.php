<?php

use App\model\Cliente;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();
            $clientes = factory(App\model\Cliente::class, 15)->make()->toArray();
            foreach($clientes as $cliente) {
                $retorno = Cliente::create($cliente);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        
    }
}
