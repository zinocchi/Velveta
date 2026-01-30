<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menu = [
            [
                'name' => 'Caffe Latte',
                'price' => 35000,
                'category' => 'hot_coffee',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/bev/CaffeLatte.jpg',
                'stock' => 100,
                'description' => 'Rich espresso with steamed milk'
            ],
            [
                'name' => 'Lavender Oatmilk Latte',
                'price' => 42000,
                'category' => 'hot_coffee',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/bev/LavenderOatmilkLatte.jpg',
                'stock' => 120,
                'description' => 'Floral lavender with oat milk'
            ],
            [
                'name' => 'Cinnamon Dolce Latte',
                'price' => 40000,
                'category' => 'hot_coffee',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/bev/CinnamonDolceLatte.jpg',
                'stock' => 80,
                'description' => 'Sweet cinnamon flavor'
            ],
            [
                'name' => 'Pistachio Latte',
                'price' => 35000,
                'category' => 'hot_coffee',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/bev/FY22Crop_PistachioLatte-onGreen.jpg',
                'stock' => 100,
                'description' => 'Nutty pistachio flavor'
            ],
            [
                'name' => 'Cold Brew',
                'price' => 35000,
                'category' => 'cold_coffee',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/bev/ColdBrew.jpg?impolicy=1by1_wide_topcrop_630',
                'stock' => 200,
                'description' => 'Smooth black coffe'
            ],
            [
                'name' => 'Iced Shaken Espresso',
                'price' => 50000,
                'category' => 'cold_coffee',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/bev/IcedShakenEspresso.jpg?impolicy=1by1_wide_topcrop_630',
                'stock' => 150,
                'description' => 'Cold Brew over ice, bold and smooth'
            ],
            [
                'name' => 'Iced Lavender Oatmilk Latte',
                'price' => 50000,
                'category' => 'cold_coffee',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/bev/IcedLavenderOatmilkLatte.jpg?impolicy=1by1_wide_topcrop_630',
                'stock' => 80,
                'description' => 'Iced Lavender With Oatmilk'
            ],
            [
                'name' => 'Iced Brown Sugar Oatmilk Shaken Espresso',
                'price' => 45000,
                'category' => 'cold_coffee',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/bev/IcedBrownSugarOatmilkShakenEspresso.jpg?impolicy=1by1_wide_topcrop_630',
                'stock' => 100,
                'description' => 'Brown Sugar With Strong Espresso'
            ],
            [
                'name' => 'Chai Latte',
                'price' => 35000,
                'category' => 'hot_tea',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/bev/SBX20220411_ChaiLatte.jpg?impolicy=1by1_wide_topcrop_630',
                'stock' => 150,
                'description' => 'Rich Milk With Tea'
            ],
            [
                'name' => 'Matcha Latte',
                'price' => 60000,
                'category' => 'hot_tea',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/bev/SBX20211115_MatchaTeaLatte.jpg?impolicy=1by1_wide_topcrop_630g',
                'stock' => 50,
                'description' => 'Creamy Ceremonial Grade Matcha'
            ],
            [
                'name' => 'Earl Grey Tea',
                'price' => 20000,
                'category' => 'hot_tea',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/bev/SBX20190624_EarlGreyBlackTea.jpg?impolicy=1by1_wide_topcrop_630',
                'stock' => 200,
                'description' => 'Sweet And Autentict Tea'
            ],
            [
                'name' => 'Honey Citrus Mint Tea',
                'price' => 30000,
                'category' => 'hot_tea',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/bev/HoneyCitrusMintTea.jpg?impolicy=1by1_wide_topcrop_630',
                'stock' => 100,
                'description' => 'Fresh Tea With Sweet Honey'
            ],
            [
                'name' => 'Iced Matcha Latte',
                'price' => 75000,
                'category' => 'cold_tea',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/bev/IcedMatchaTeaLatte.jpg?impolicy=1by1_wide_topcrop_630',
                'stock' => 80,
                'description' => 'Rich And Fresh Ceremonial Grade Matcha'
            ],
            [
                'name' => 'Iced Black Tea',
                'price' => 25000,
                'category' => 'cold_tea',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/bev/IcedBlackTea.jpg?impolicy=1by1_wide_topcrop_630',
                'stock' => 100,
                'description' => 'Iced Tea With a Strong Taste'
            ],
            [
                'name' => 'Iced Peach Green Tea Lemonade',
                'price' => 30000,
                'category' => 'cold_tea',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/bev/IcedPeachGreenTeaLemonade.jpg?impolicy=1by1_wide_topcrop_630',
                'stock' => 100,
                'description' => 'Sweet Tea With a Sour Lemonade'
            ],
            [
                'name' => 'Iced Black Tea Lemonade',
                'price' => 30000,
                'category' => 'cold_tea',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/bev/IcedPeachGreenTeaLemonade.jpg?impolicy=1by1_wide_topcrop_630',
                'stock' => 100,
                'description' => 'Strong Tea With Sour Lemonade'
            ],
            [
                'name' => 'Butter Croisant',
                'price' => 25000,
                'category' => 'bakery',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/food/SBX20210915_Croissant-onGreen.jpg?impolicy=1by1_medium_630',
                'stock' => 80,
                'description' => ''
            ],
            [
                'name' => 'Cinamon Coffe Cake',
                'price' => 30000,
                'category' => 'bakery   ',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/food/SBX20180511_ClassicCoffeeCake.jpg?impolicy=1by1_medium_630',
                'stock' => 50,
                'description' => ''
            ],
            [
                'name' => 'Baked Apple Croissant',
                'price' => 30000,
                'category' => 'bakery',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/food/AppleCroissant.jpg?impolicy=1by1_medium_630',
                'stock' => 50,
                'description' => ''
            ],
            [
                'name' => 'Plain Bagel',
                'price' => 20000,
                'category' => 'bakery',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/food/SBX20190715_PlainBagel.jpg?impolicy=1by1_medium_630',
                'stock' => 50,
                'description' => ''
            ],
            [
                'name' => 'Chocolate Pop',
                'price' => 20000,
                'category' => 'treats',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/food/SBX20181129_ChocolateCakePop.jpg?impolicy=1by1_medium_630',
                'stock' => 100,
                'description' => ''
            ],
            [
                'name' => 'Cookie & Cream Cake Pop',
                'price' => 35000,
                'category' => 'treats',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/food/SBX20220125_CookiesAndCreamCakePop.jpg?impolicy=1by1_medium_630',
                'stock' => 70,
                'description' => ''
            ],
            [
                'name' => 'Chocolate Chip Cookie',
                'price' => 30000,
                'category' => 'treats',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/food/SBX20190129_ChocolateChipCookie.jpg?impolicy=1by1_medium_630',
                'stock' => 50,
                'description' => ''
            ],
            [
                'name' => 'Double Chocolate Brownie',
                'price' => 40000,
                'category' => 'treats',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/food/SBX20190715_DoubleChocolateChunkBrownie.jpg?impolicy=1by1_medium_630',
                'stock' => 50,
                'description' => ''
            ],
            [
                'name' => 'Ham & Swiss on Baguette',
                'price' => 65000,
                'category' => 'lunch',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/food/SBX20221006_HamSwissOnBaguette.jpg?impolicy=1by1_medium_630',
                'stock' => 30,
                'description' => ''
            ],
            [
                'name' => 'Ham & Swiss on Baguette',
                'price' => 65000,
                'category' => 'lunch',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/food/SBX20221006_HamSwissOnBaguette.jpg?impolicy=1by1_medium_630',
                'stock' => 30,
                'description' => ''
            ],
            [
                'name' => 'Jalapeño Chicken Pocket',
                'price' => 60000,
                'category' => 'lunch',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/food/JalapenoChickenPocket.jpg?impolicy=1by1_medium_630',
                'stock' => 40,
                'description' => ''
            ],
            [
                'name' => 'Cheese Trio Protein Box',
                'price' => 85000,
                'category' => 'lunch',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/food/SBX20221206_CheeseTrioProteinBox.jpg?impolicy=1by1_medium_630',
                'stock' => 20,
                'description' => ''
            ],
            [
                'name' => 'Healthy Fiber and Fruit',
                'price' => 70000,
                'category' => 'lunch',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/food/SBX20221206_CheeseFruitProteinBox.jpg?impolicy=1by1_medium_630  ',
                'stock' => 30,
                'description' => ''
            ],

            [
                'name' => 'Egg, Pesto & Mozzarella Sandwich',
                'price' => 80000,
                'category' => 'breakfast',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/food/EggPestoMozzarellaSandwich.jpg?impolicy=1by1_medium_630',
                'stock' => 50,
                'description' => 'Egg, pesto, and mozzarella sandwich on a ciabatta roll'
            ],
            [
                'name' => 'Bacon, Sausage & Egg Wrap',
                'price' => 65000,
                'category' => 'breakfast',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/food/SBX20191018_BaconSausageCageFreeEggWrap.jpg?impolicy=1by1_medium_630',
                'stock' => 50,
                'description' => 'Bacon, sausage, and egg wrap with a crispy texture'
            ],
            [
                'name' => 'Avocado Spread',
                'price' => 60000,
                'category' => 'breakfast',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/food/SBX20190814_AvocadoSpread.jpg?impolicy=1by1_medium_630',
                'stock' => 50,
                'description' => 'Creamy avocado spread on toasted bread'
            ],
            [
                'name' => 'Bacon, Gouda & Egg Sandwich',
                'price' => 70000,
                'category' => 'breakfast',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/food/SBX20210915_BaconGoudaEggSandwich.jpg?impolicy=1by1_medium_630',
                'stock' => 50,
                'description' => 'Bacon, gouda, and egg sandwich on a brioche bun'
            ],
            [
                'name' => 'Hot Chocolate',
                'price' => 30000,
                'category' => 'hot_chocolate',
                'image_url' => 'https://globalassets.starbucks.com/digitalassets/products/bev/HotChocolate.jpg?impolicy=1by1_wide_topcrop_630',
                'stock' => 150,
                'description' => 'Rich and creamy hot chocolate'
            ]
        ];

        foreach ($menu as $menu) {
            Menu::create($menu);
        }
    }
}
