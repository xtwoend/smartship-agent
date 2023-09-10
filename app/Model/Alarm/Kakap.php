<?php

namespace App\Model\Alarm;

use Hyperf\DbConnection\Model\Model;

class Kakap extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'alarm';

    /**
     * The connection name for the model.
     */
    protected ?string $connection = 'default';

    /**
     * all 
     */
    protected array $guarded = ['id']; 

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    // create table cargo if not found table
    public static function table($fleetId)
    {
        $model = new self;
        $tableName = $model->getTable() . "_{$fleetId}";
        
        if(! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fleet_id')->index();
                $table->string('property')->nullable();
                $table->integer('property_index')->nullable();
                $table->string('message')->nullable();
                $table->boolean('status')->default(false); // 0 => open, 1 => close
                $table->datetime('started_at')->index();
                $table->datetime('finished_at')->index();
                $table->timestamps();
            });
        }
        
        return $model->setTable($tableName);
    }
}