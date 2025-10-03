<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Interest
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @property InterestUser[] $interestUsers
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Interest extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'description'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function interestUsers()
    {
        return $this->hasMany(\App\Models\InterestUser::class, 'id', 'interest_id');
    }
    
}
