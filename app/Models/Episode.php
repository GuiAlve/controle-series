<?php

namespace App\Models;

    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $table = 'episode';
    public $timestamps = false;
    protected $casts = ['watched' => 'boolean'];
    protected $fillable = ['number'];


    public function seasons()
    {
        return $this->belongsTo(Seasons::class);
    }

    public function series()
    {
        return $this->belongsTo(Series::class);
    }

}
