<?php

namespace App\Traits;

use Illuminate\Support\Str;

use App\Models\Log;
use Illuminate\Support\Facades\Schema;

trait UseLog
{
    protected static function bootUseLog()
    {
        static::updated(function ($model) {

            $beforeDatacollection = collect($model->beforeData());
            $beforeData = $beforeDatacollection->diffAssoc($model->toArray());
            $afterDatacollection = collect($model->toArray());
            $afterData = $afterDatacollection->diffAssoc($model->beforeData());
            $temp = [
                'ref_id'=>$model->id,
                'table_name'=>$model->getTable(),
                'before_data'=>$beforeData,
                'after_data'=>$afterData,
                'time'=>Log::where('ref_id',$model->id)->count()+1,
            ];
            Log::create($temp);
        });
    }

    public function beforeData()
    {
        $ans = [];
        foreach ($this->getAttributes() as $key => $value) {
            $ans[$key] = $this->getOriginal($key);
        }
        return $ans;
    }
}
