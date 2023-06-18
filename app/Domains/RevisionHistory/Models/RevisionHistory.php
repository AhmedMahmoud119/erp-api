<?php

namespace App\Domains\RevisionHistory\Models;

use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RevisionHistory extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'revision_historyable_id',
        'revision_historyable_type',
        'edited_by',
        'old_data',
        'new_data',
        'reason',
    ];

    public function editedBy()
    {
        return $this->belongsTo(User::class, 'edited_by');
    }

    public function getOldDataAttribute($value)
    {
        return json_decode($value,true);
    }
    public function getNewDataAttribute($value)
    {
        return json_decode($value,true);
    }


}
