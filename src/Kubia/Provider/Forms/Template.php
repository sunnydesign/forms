<?php

namespace Kubia\Provider\Forms;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = ['name', 'active', 'data'];
    protected $guarded = ['id'];
    protected $dateFormat = 'Y-m-d H:i:sP';
    protected $connection = 'forms';

    public static function boot()
    {
        parent::boot();

        self::creating(function ($template) {
            do {
                $uuid = Uuid::uuid4()->toString();
            } while (Template::where('uuid', $uuid)->exists());

            $template->uuid = $uuid;
        });
    }

    public function setDataAttribute($value)
    {
        $this->attributes['data'] = json_encode($value);
    }

    public function getDataAttribute()
    {
        return json_decode($this->attributes['data']);
    }

    public function forms()
    {
        return $this->hasMany('Kubia\Provider\Forms\Form');
    }
}
