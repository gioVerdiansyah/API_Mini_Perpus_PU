<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Rent extends Model
{
    use HasFactory;

    public $incrementing = false, $keyType = "string";
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty ($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    public function customer():BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
    public function book():BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
