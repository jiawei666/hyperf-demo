<?php

declare (strict_types=1);
namespace App\Model;

/**
 * @property int $id 
 * @property string $account 
 * @property string $phone 
 * @property string $name 
 * @property string $id_card_num 
 * @property string $gender 
 * @property string $address 
 * @property string $nationality 
 * @property string $birth 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account',
        'phone',
        'is_auth',
        'power',
        'pending_power',
        'filecoin',
        'pending_filecoin',
        'name',
        'id_card_num',
        'gender',
        'address',
        'nationality',
        'birth',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'power' => 'float',
        'pending_power' => 'float',
        'filecoin' => 'float',
        'pending_filecoin' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    const GENDER_UNKNOWN = 'unknown';
    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';
    const GENDER_READABLE = [
        self::GENDER_UNKNOWN => '未知',
        self::GENDER_MALE => '男',
        self::GENDER_FEMALE => '女',
    ];


    public function getGenderReadableAttribute()
    {
        return self::GENDER_READABLE[$this->gender] ?? '未知';
    }
}