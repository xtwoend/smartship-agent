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
namespace App\Model\Alarm;

use Carbon\Carbon;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;

class Alarm extends Model
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
     * all.
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
        $model = new self();
        $tableName = $model->getTable() . "_{$fleetId}";

        if (! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fleet_id')->index();
                $table->string('property')->nullable();
                $table->string('property_key')->nullable();
                $table->string('message')->nullable();
                $table->boolean('status')->default(false); // 0 => open, 1 => close
                $table->datetime('started_at')->nullable();
                $table->datetime('finished_at')->nullable();
                $table->timestamps();
            });
        }

        return $model->setTable($tableName);
    }

    public function setAlarm($data, $fleetId)
    {
        foreach ($data as $alarm) {
            $al = self::table($fleetId)
                ->firstOrCreate([
                    'fleet_id' => $fleetId,
                    'property' => $alarm['property'],
                    'property_key' => $alarm['property_key'],
                    'message' => $alarm['message'],
                    'status' => 1,
                ]);
            if (is_null($al->started_at)) {
                $al->started_at = Carbon::now()->format('Y-m-d H:i:s');
            }
            $al->finished_at = Carbon::now()->format('Y-m-d H:i:s');
            $al->save();
        }
    }

    /**
     * get duration attribute.
     */
    public function getDurationAttribute()
    {
        $duration = (isset($this->finished_at, $this->started_at)) ? Carbon::parse($this->finished_at)->diffInSeconds(Carbon::parse($this->started_at)) : 0;
        if ($duration > 0) {
            return gmdate('H:i:s', $duration);
        }
        return 0;
    }

    /**
     * get duration in hours.
     */
    public function getDurationInHourAttribute()
    {
        $duration = (isset($this->finished_at, $this->started_at)) ? Carbon::parse($this->finished_at)->diffInSeconds(Carbon::parse($this->started_at)) : 0;
        if ($duration > 0) {
            return (float) $duration / (60 * 60);
        }
        return 0;
    }

    /**
     * get duration in hours.
     */
    public function getDurationInMinuteAttribute()
    {
        $duration = (isset($this->finished_at, $this->started_at)) ? Carbon::parse($this->finished_at)->diffInSeconds(Carbon::parse($this->started_at)) : 0;
        if ($duration > 0) {
            return (float) $duration / 60;
        }
        return 0;
    }
}
