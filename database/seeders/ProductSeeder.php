<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = array(
            array('81UV009YLM', 'Laptop Portátil LENOVO', 'LENOVO', '2500000', '20', '18', '81UV009YLM', '1637865823.jpg', 'Laptop Portátil LENOVO RYZEN_5_3500U_2.1G_4C_MB 14 Pulgadas 12 GB 512 GB SSD'),

            array('ASUS-PLU: 3057996', 'Portátil ASUS Intel Core i5', 'ASUS', '2378040', '5', '24', 'X415JA-EB1079T', '1637868342.webp', 'Portátil ASUS Intel Core i5-1035G1 14 Pulgadas 8 GB 256 GB SSD X415JA-EB1079T'),

            array('AMD-PLU: 101515406', 'Computador Pc De Escritorio Torre Gamer', 'AMD', '3894900', '15', '5', 'AMD-PLU: 101515406', '1637868677.jpg', 'Computador Pc De Escritorio Torre Gamer Amd Ryzen 5 3600Ssd 480Gb + Hdd 1Tb Ram 16Gb Led 22 Full Hd Nvidia 1030'),

            array('LENOVO-PLU: 3057718', 'Tab P11', 'LENOVO', '1639180', '8', '18', 'LENOVO-PLU: 3057718', '1637868960.jpg', 'Tab P11 Wifi 6Gb + 128Gb LENOVO TB-J606F'),

            array('JBL-PLU: 100420619', 'Parlante Bluetooth', 'JBL', '408500', '7', '21', 'JBL-PLU: 100420619', '1637868961.jpg', 'Parlante Bluetooth Jbl Flip 5 Negro'),

            array('BOSE-PLU: 100121462', 'Parlante Inalambrico Bose', 'BOSE', '1741900', '6', '37', 'BOSE-PLU: 100121462', '1637868962.jpg', 'Parlante Inalambrico Bose Home Speaker 500 Plateado'),

            array('LG-PLU: 100704843', 'Torre De Sonido Lg', 'LG', '999999', '10', '41', 'LG-PLU: 100704843', '1637868963.jpg', 'Torre De Sonido Lg Xboom Rn7 1000W Rms'),

            array('XIAOMI-PLU: 101422619', 'Celular Xiaomi Poco X3', 'XIAOMI', '1120250', '14', '43', 'XIAOMI-PLU: 101422619', '1637868964.jpg', 'Celular Xiaomi Poco X3 Pro 256Gb Negro 8Gb Ram'),

            array('MOTOROLA-PLU: 3021246', 'Celular Motorola Moto G30', 'MOTOROLA', '797900', '9', '33', 'MOTOROLA-PLU: 3021246', '1637868965.jpg', 'Celular Motorola Moto G30 128GB Lila'),
        );

        $relations = array(
            array(2, 2),
            array(2, 1),
            array(1, 3),
            array(4, 4),
            array(7, 5),
            array(7, 6),
            array(7, 7),
            array(5, 8),
            array(5, 9)
        );

        foreach ($products as $value) {
            DB::table('products')->insert([
                'sku' => $value[0],
                'name' => $value[1],
                'brand' => $value[2],
                'price' => $value[3],
                'amount' => $value[4],
                'discount' => $value[5],
                'reference' => $value[6],
                'image' => $value[7],
                'description' => $value[8],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }

        foreach ($relations as $value) {
            DB::table('category_product')->insert([
                'category_id' => $value[0],
                'product_id' => $value[1]
            ]);
        }
    }
}
