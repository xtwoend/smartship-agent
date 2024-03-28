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

use App\Model\Alarm\Alarm;
use App\Model\Cargo\Cargo;
use App\Model\Cargo\CargoTrait;
use App\Model\CargoPump\CargoPumpTrait;
use App\Model\Engine\Engine;
use App\Model\Engine\EngineTrait;
use Carbon\Carbon;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;

class Fleet extends Model
{
    use CargoPumpTrait;
    use EngineTrait;
    use CargoTrait;

    /**
     * The table associated with the model.
     */
    protected ?string $table = 'fleets';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [
        'name', 'image', 'fleet_status', 'last_port', 'connected', 'last_connection',
    ];

    public function navigation()
    {
        return $this->hasOne(Navigation::class, 'fleet_id');
    }

    public function engine()
    {
        $model = Engine::table($this->id);
        if (Schema::hasTable($model->getTable())) {
            return $model->where('fleet_id', $this->id)->first();
        }
        return null;
    }

    public function cargo()
    {
        $model = Cargo::table($this->id);
        if (Schema::hasTable($model->getTable())) {
            return $model->where('fleet_id', $this->id)->first();
        }
        return null;
    }

    public function cargo_pump()
    {
        $model = CargoPump::table($this->id);
        if (Schema::hasTable($model->getTable())) {
            return $model->where('fleet_id', $this->id)->first();
        }
        return null;
    }

    public function setNav(array $data)
    {
        if (isset($data['nav']) && is_array($data['nav'])) {
            $m = (array) $data['nav'];
            $m = array_merge($m, ['terminal_time' => Carbon::now()->format('Y-m-d H:i:s')]);
            
            $log = $this->navigation()->updateOrCreate([
                'fleet_id' => $this->id,
            ], $m);

            return $log;
        }
    }

    public function logger($group, $data)
    {
        $emit_data = clone $data;

        // submit to event
        websocket_emit("fleet-{$this->id}", "{$group}_{$this->id}", $emit_data->makeHidden(['id', 'fleet_id', 'created_at', 'updated_at'])->toArray());

        $date = $data->updated_at; // get last update data
        $model = Logger::table($this->id);
        $last = $model->where('group', $group)->orderBy('terminal_time', 'desc')->first();
        $now = Carbon::parse($date);

        // save interval 5 detik
        // if($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 5) ) {
        //     return;
        // }

        // delete data log
        Logger::table($this->id)->where('terminal_time', '<', Carbon::now()->subHours(2)->format('Y-m-d H:i:s'))->delete();

        $data = $data->makeHidden(['id', 'fleet_id', 'created_at', 'updated_at'])->toArray();

        return $model->updateOrCreate([
            'group' => $group,
            'fleet_id' => $this->id,
            'terminal_time' => $date,
        ], [
            'data' => (array) $data,
        ]);
    }

    public function alarms()
    {
        $model = Alarm::table($this->id);
        if (Schema::hasTable($model->getTable())) {
            return $model;
        }
        return null;
    }

    public function voyages()
    {
        return $this->hasMany(Voyage::class, 'fleet_id');
    }

    public function status_durations()
    {
        return $this->hasMany(FleetStatusDuration::class, 'fleet_id');
    }
}
