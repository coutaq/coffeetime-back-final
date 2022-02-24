<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text',
        'to_id',
        'from_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'to_id' => 'integer',
        'from_id' => 'timestamp',
    ];

    public function /App/Models/User()
    {
        return $this->belongsTo(/App/Models/User::class);
    }

    public function /App/Models/User()
    {
        return $this->belongsTo(/App/Models/User::class);
    }

    public function to()
    {
        return $this->belongsTo(User::class);
    }

    public function from()
    {
        return $this->belongsTo(User::class);
    }
}
