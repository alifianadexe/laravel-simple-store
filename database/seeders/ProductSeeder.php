<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            [
                'id' => 1,
                'name' => 'Nike',
            ],
            [
                'id' => 2,
                'name' => 'Adidas',
            ],
            [
                'id' => 3,
                'name' => 'New Balance',
            ],
            [
                'id' => 4,
                'name' => 'Lacoste',
            ],
            [
                'id' => 5,
                'name' => 'Vans',
            ],
            [
                'id' => 6,
                'name' => 'Converse',
            ],
            [
                'id' => 7,
                'name' => 'Diadora',
            ],
            [
                'id' => 8,
                'name' => 'Sketchers',
            ],
        ];

        foreach ($brands as $brand) {
            ProductBrand::create([
                'id' => $brand['id'],
                'name' => $brand['name'],
                'slug' => Str::slug($brand['name']),
                'logo' => '/images/brands/' . Str::slug($brand['name']) . '.png',
            ]);
        }

        $categories = [
            [
                'name' => 'Lifestyle',
                'products' => [
                    [
                        'name' => 'Nike Air Force 1 07',
                        'sell_price' => 1_909_000,
                        'brand_id' => 1,
                    ],
                    [
                        'name' => 'Nike Dunk Low Retro Pure',
                        'sell_price' => 1_549_000,
                        'brand_id' => 1,
                    ],
                    [
                        'name' => 'Nike Air Force 1 Mid React',
                        'sell_price' => 2_199_000,
                        'brand_id' => 1,
                    ],
                    [
                        'name' => "Nike Blazer Mid '77 Vintage",
                        'sell_price' => 1_429_000,
                        'brand_id' => 1,
                    ],

                    [
                        'name' => 'Adidas Rivalry Low',
                        'sell_price' => 1_909_000,
                        'brand_id' => 2,
                    ],
                    [
                        'name' => 'Adidas Originals Superstar',
                        'sell_price' => 1_549_000,
                        'brand_id' => 2,
                    ],
                    [
                        'name' => 'Adidas Originals Oztral',
                        'sell_price' => 2_199_000,
                        'brand_id' => 2,
                    ],
                    [
                        'name' => "Adidas Originals Ozelia",
                        'sell_price' => 1_429_000,
                        'brand_id' => 2,
                    ],
                    [
                        'name' => "New Balance 550",
                        'sell_price' => 2_099_000,
                        'brand_id' => 3,
                    ],
                ]
            ],
            [
                'name' => 'Classic',
                'products' => [
                    [
                        'name' => "Vans Classic Slip On",
                        'sell_price' => 319_600,
                        'brand_id' => 5,
                    ],
                    [
                        'name' => "Vans Old Skool Black",
                        'sell_price' => 1_099_000,
                        'brand_id' => 5,
                    ],
                    [
                        'name' => "Vans Old Skool White",
                        'sell_price' => 1_099_000,
                        'brand_id' => 5,
                    ],
                    [
                        'name' => "Vans SK8-HI",
                        'sell_price' => 839_400,
                        'brand_id' => 5,
                    ],
                ]
            ],
            [
                'name' => 'Running'
            ],
            [
                'name' => 'Gym and Training'
            ],
            [
                'name' => 'Basketball'
            ],
            [
                'name' => 'Football'
            ],
        ];

        $this->insertCategories($categories);
    }

    private function insertCategories($categories, $parent_id = null) {
        foreach ($categories as $category) {
            $cat = ProductCategory::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'parent_id' => $parent_id,
            ]);
            if (isset($category['children'])) {
                $this->insertCategories($category['children'], $cat->id);
            }
            if (isset($category['products'])) {
                $this->insertProducts($category['products'], $cat->id);
            }
        }
    }

    private function insertProducts($products, $category_id) {
        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'sell_price' => $product['sell_price'],
                'brand_id' => $product['brand_id'],
                'buy_price' => $product['sell_price'] - ($product['sell_price'] * 0.15),
                'stock' => fake()->numberBetween(50, 200),
                'image' => '/images/products/' . $product['name'] . '.jpeg',
                'description' => fake()->sentence(20),
                'category_id' => $category_id,
            ]);
        }
    }
}
