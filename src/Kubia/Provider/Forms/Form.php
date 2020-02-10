<?php

namespace Kubia\Provider\Forms;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = ['uuid', 'template_id', 'client_id', 'state_id', 'data'];
    protected $guarded = ['id'];
    protected $dateFormat = 'Y-m-d H:i:sP';
    protected $connection = 'forms';

    public static function boot()
    {
        parent::boot();

        self::creating(function ($form) {
            do {
                $uuid = Uuid::uuid4()->toString();
            } while (Form::where('uuid', $uuid)->exists());

            $form->uuid = $uuid;
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

    public function state()
    {
        return $this->belongsTo('Kubia\Provider\Forms\State');
    }

    public function template()
    {
        return $this->belongsTo('Kubia\Provider\Forms\Template');
    }
}
