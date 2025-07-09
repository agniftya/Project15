<?php

// database/seeders/ProductSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Cat Air Sakura',
                'description' => 'Cat air premium untuk hasil lukisan tajam dan tahan lama.',
                'price' => 45000,
                'image' => 'https://down-id.img.susercontent.com/file/id-11134201-23030-n31lbfj8h8nvc3',
            ],
            [
                'name' => 'Kuas Lukis Set Lengkap',
                'description' => 'Set kuas lukis berbagai ukuran dan bentuk.',
                'price' => 60000,
                'image' => 'https://down-id.img.susercontent.com/file/10d4689b5d174b63d19ede55701e0f93',
            ],
            [
                'name' => 'Palet Cat Plastik',
                'description' => 'Palet tahan air untuk mencampur cat.',
                'price' => 15000,
                'image' => 'https://images.tokopedia.net/img/cache/500-square/VqbcmM/2022/4/27/8ba953af-87e1-4b6e-bd40-898348462299.jpg?ect=4g',
            ],
             [
                'name' => 'Kanvas',
                'description' => 'wasdasdwq.',
                'price' => 30000,
                'image' => 'https://cf.shopee.co.id/file/92799eeeb7b5a25aa2f3dc50527bfab6',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

