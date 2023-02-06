<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Voters extends Model
{
    use HasFactory;

    protected $fillable = ['election_id','matric', 'name', 'email', 'voter_id', 'voted'];

    public function election(): BelongsTo
    {
        return $this->belongsTo(Election::class);
    }

}
