<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\Database\Model\Relations\BelongsTo;

/**
 * @property int $id 
 * @property string $title 
 * @property string $content 
 * @property int $sort 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class Board extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'boards';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'admin_id',
        'sort',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'sort' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];

    public function admin():BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }


}