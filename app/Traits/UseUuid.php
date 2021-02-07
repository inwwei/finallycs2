<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UseUuid
{
    protected static function bootUseUuid()
    {
        static::creating(function ($model) {
            if (empty($model->getKey())) {
                $model->{$model->getKeyName()} = Str::upper((string) Str::uuid());
            }
            if (empty($model->created_by)) {
                $model->created_by =  request()->user()->id ?? 'System';
            }

            if (empty($model->updated_by)) {
                $model->updated_by = request()->user()->id ?? 'System';
            }
        });

        static::updating(function ($model) {
            $model->updated_by = request()->user()->id ?? 'System';
        });

        static::deleting(function ($model) {
            $model->deleted_by =  request()->user()->id ?? 'System';
            $model->save();
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
