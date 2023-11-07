<?php

declare(strict_types=1);

namespace App\Model;

use Carbon\Carbon;
use App\Model\Navigation;
use App\Model\Alarm\Alarm;
use App\Model\Cargo\Cargo;
use App\Model\EngineLimit;
use App\Model\Engine\Engine;
use App\Model\Cargo\CargoTrait;
use App\Model\Engine\EngineTrait;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Model\Model;
use App\Model\CargoPump\CargoPumpTrait;
use Hyperf\Database\Model\Events\Updated;

/**
 */
class Fleet extends Model
{
    use CargoPumpTrait, EngineTrait, CargoTrait;
    
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'fleets';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [
        'name', 'image', 'fleet_status', 'last_port', 'connected', 'last_connection'
    ];

    public function navigation()
    {
        return $this->hasOne(Navigation::class, 'fleet_id');
    }

    public function engine()
    {
        $model = Engine::table($this->id);
        if(Schema::hasTable($model->getTable())) {
            $cargo = $model->where('fleet_id', $this->id)->first();
            return $cargo;
        }
        return null;
    }
    
    public function cargo()
    {   
        $model = Cargo::table($this->id);
        if(Schema::hasTable($model->getTable())) {
            $cargo = $model->where('fleet_id', $this->id)->first();
            return $cargo;
        }
        return null;
    }

    public function cargo_pump()
    {   
        $model = CargoPump::table($this->id);
        if(Schema::hasTable($model->getTable())) {
            $cargo = $model->where('fleet_id', $this->id)->first();
            return $cargo;
        }
        return null;
    }

    public function setNav(array $data)
    {
        if(isset($data['nav'])) {
            
            $m = (array) $data['nav'];
            $m = array_merge($m, ['terminal_time' => Carbon::now()->format('Y-m-d H:i:s')]);
            $log = $this->navigation()->updateOrCreate([
                'fleet_id' => $this->id
            ], $m);

            // $this->connected = 1;
            // $this->last_connection = Carbon::now();
            // $this->save();

            $this->logger('navigation', $log);
            
            return $log;
        }
    }

    public function logger($group, $data)
    {
        $date = $data->updated_at; // get last update data
        $model = Logger::table($this->id, $date);
        $last = $model->where('group', $group)->orderBy('terminal_time', 'desc')->first();
        $now = Carbon::parse($date);
        
        // delete data log
        Logger::table($this->id, $date)->where('terminal_time', '<', Carbon::now()->subHour()->format('Y-m-d H:i:s'))->delete();
        
        $data = $data->makeHidden(['id', 'fleet_id', 'created_at', 'updated_at'])->toArray();
    
        // save interval 5 detik
        if($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 5) ) {   
            return;
        }

        // submit to event
        websocket_emit("fleet-{$this->id}", "{$group}_{$this->id}", $data);

        return $model->updateOrCreate([
            'group' => $group,
            'fleet_id' => $this->id,
            'terminal_time' => $date,
        ], [
            'data' => (array) $data
        ]);
    }

    public function alarms() 
    {
        $model = Alarm::table($this->id);
        if(Schema::hasTable($model->getTable())) {
            return $model;
        }
        return null;
    }
    
    public function voyages()
    {
        return $this->hasMany(Voyage::class, 'fleet_id');
    }


    public function avarages()
    {
        return $this->hasMany(FleetAverage::class, 'fleet_id');
    }

    public function status_durations() 
    {
        return $this->hasMany(FleetStatusDuration::class, 'fleet_id');
    }

    public function updated(Updated $event)
    {
        $fleet = $event->getModel();
        
        // save duration fleet status
        $hi = FleetStatusDuration::where([
                'fleet_id' => $fleet->id,
                'fleet_status' => $fleet->fleet_status,
                'status' => 1
            ])->first();
        if($hi) {
            $hi->finished_at = Carbon::now()->format('Y-m-d H:i:s');
            $hi->save(); 
        }else{
            FleetStatusDuration::update(['status' => 0]);
            FleetStatusDuration::create([
                'fleet_id' => $fleet->id,
                'fleet_status' => $fleet->fleet_status,
                'status' => 1,
                'started_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
