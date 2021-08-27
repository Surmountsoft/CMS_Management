<?php
/**
 * @package CSoftech\Cms\Models
 *
 * @class Upload
 *
 * @author Rahul Sharma <rahul.sharma@surmountsoft.in>
 *
 * @copyright 2021 SurmountSoft Pvt. Ltd. All rights reserved.
 */
namespace CSoftech\Cms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'file_name',
        'thumbnail',
        'display_name',
        'file_type',
        'uploadable_id',
        'uploadable_type',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function uploadable()
    {
        return $this->morphTo();
    }
}
