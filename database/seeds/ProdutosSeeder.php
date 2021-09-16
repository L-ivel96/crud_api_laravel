<?php

use App\model\Produto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProdutosSeeder extends Seeder
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
            $produtos = factory(App\model\Produto::class, 15)->make()->toArray();
            foreach($produtos as $produto) {
                $retorno = Produto::create($produto);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
}
