<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Model;

use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;

trait HasColumnTrait
{
    public function addColumn($myTable, $columns)
    {
        foreach ($columns as $column) {
            if (! Schema::hasColumn($myTable, $column['name'])) {
                Schema::table($myTable, function (Blueprint $table) use ($column) {
                    $table->{$column['type']}($column['name'], 10, 3)->nullable()->after($column['after'] ?? 'id');
                });
            }
        }
    }
}
