<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = array(
            array('Computadores de Escritorio', 'Equipos para oficina, uso personal, para jugar, multimedia personal y uso general de computadoras en el hogar.'),
            array('Laptops', 'Computadoras portátiles o (PC) pequeñas con pantallas integradas y un teclados alfanuméricos. Las computadoras portátiles se utilizan en una variedad de entornos, como en el trabajo, en la educación, para jugar, navegar por la web, para multimedia personal y uso general de computadoras en el hogar.'),
            array('Accesorios', 'Elementos que forman parte de tu equipo o sistema personal o de trabajo, manipulables con una conexiones electrónicas, USB, etc...'),
            array('Tablets', 'Dispositivos informáticos móviles que tiene una forma plana y rectangular como la de una revista o un bloc de papel, que generalmente se controla mediante una pantalla táctil y que se usa típicamente para acceder a Internet, ver vídeos, jugar juegos, leer libros electrónicos etc.'),
            array('Smartphone', 'Teléfonos móviles que realizan muchas de las funciones de una computadora, por lo general tiene una interfaz de pantalla táctil, acceso a Internet y un sistema operativo capaz de ejecutar aplicaciones descargadas.'),
            array('Barra de Sonidos', 'Altavoces que proyectan audio desde un recinto amplio. Es mucho más ancho que alto, en parte por razones acústicas y en parte para que pueda montarse encima o debajo de un dispositivo de visualización.'),
            array('Parlantes', 'Transductor electroacústicos o dispositivos que convierten una señal eléctrica de audio en ondas mecánicas de sonido.'),
            array('Consolas', 'consolas de videojuegos o videoconsola, dispositivos que ejecutan juegos electrónicos contenidos en discos compactos, cartuchos, tarjetas de memoria u otros formatos.')
        );

        foreach ($names as $value) {
            DB::table('categories')->insert([
                'name' => $value[0],
                'description' => $value[1],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}
