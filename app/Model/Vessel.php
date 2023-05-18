<?php

declare(strict_types=1);

namespace App\Model;

use Carbon\Carbon;
use App\Model\Engine;
use App\Model\Logger;
use App\Model\Navigation;
use App\Model\Cargo\Cargo;
use Hyperf\DbConnection\Db;
use Hyperf\DbConnection\Model\Model;

/**
 */
class Vessel extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'vessels';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [
        'name', 'image', 'connected', 'last_connection'
    ];

    public function navigation()
    {
        return $this->hasOne(Navigation::class, 'vessel_id');
    }

    public function engine()
    {
        return $this->hasOne(Engine::class, 'vessel_id');
    }

    public function cargo()
    {   
        return Cargo::table($this->id)->where('vessel_id', $this->id)->first();
    }

    public function setNav(array $data)
    {
        if(isset($data['nav'])) {
            
            $m = (array) $data['nav'];
            $m = array_merge($m, ['terminal_time' => Carbon::now()->format('Y-m-d H:i:s')]);
            $log = $this->navigation()->updateOrCreate([
                'vessel_id' => $this->id
            ], $m);

            $this->connected = 1;
            $this->last_connection = Carbon::now();
            $this->save();

            $this->logger('vdr', $log);
            
            return $log;
        }
    }
    
    public function setEngine(array $data)
    {   
        if(isset($data['engine'])) {
            
            $log = $this->engine()->updateOrCreate([
                'vessel_id' => $this->id
            ], $data['engine']);
        
            // $this->connected = 1;
            // $this->last_connection = Carbon::now();
            // $this->save();

            $this->logger('ecr', $log);

            return $log;
        }
    }

    public function setCargo($model, array $data)
    {
        
        if(isset($data['cargo'])) {
            $model = (new $model)->table($this->id);
            $log = $model->updateOrCreate([
                'vessel_id' => $this->id
            ], $data['cargo']);
            
            $this->logger('ccr', $log);

            return $log;
        }
    }

    public function logger($group, $data)
    {
        $date = $data->terminal_time; // get last update data
        $model = Logger::table($this->id, $date);
        $last = $model->where('group', $group)->orderBy('terminal_time', 'desc')->first();
        $now = Carbon::parse($date);

        // save interval 60 detik
        if($last && $now->diffInSeconds($last->terminal_time) < config('mqtt.interval_save', 60) ) {   
            return;
        }
        
        return $model->updateOrCreate([
            'group' => $group,
            'vessel_id' => $this->id,
            'terminal_time' => $date,
        ], [
            'data' => (array) $data->makeHidden(['id', 'vessel_id', 'created_at', 'updated_at'])->toArray()
        ]);
    }
}
