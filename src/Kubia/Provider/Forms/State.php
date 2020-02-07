<?php

namespace Kubia\Provider\Forms;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = ['name'];
    protected $guarded = ['id'];
    protected $connection = 'forms';
    public $timestamps = false;

    public function forms()
    {
        return $this->hasMany('Kubia\Provider\Forms\Form');
    }
}
