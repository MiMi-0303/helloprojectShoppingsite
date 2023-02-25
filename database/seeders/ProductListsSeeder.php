<?php

namespace Database\Seeders;

use App\Models\ProductList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductListsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =
        ['name'=>'譜久村聖(モーニング娘。\'22)『<2022 クリスマス>ソロA5クリアファイル+L判写真』','price'=>'500'];
        $user =new ProductList();
        $user->fill($data)->save();
        $data =
        ['name'=>'岡村ほまれ(モーニング娘。\'22)『ソロA4クリアファイル+2L写真<ハロプロまるわかりBOOK 2022 SPRING>','price'=>'750'];
        $user =new ProductList();
        $user->fill($data)->save();
        $data =
        ['name'=>'矢島舞美　2023年カレンダー ★shop限定L判特典写真付き','price'=>'3498'];
        $user =new ProductList();
        $user->fill($data)->save();


    }
}
