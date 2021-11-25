<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait UtilTrait
{
    /**
     * Resetear el id autoincremental en la tabla especificada
     * @param string $tabla
     */
    private function resetAutoIncrementTable(string $table) : void
    {
        DB::update("ALTER TABLE $table AUTO_INCREMENT = 1;");
    }
}
