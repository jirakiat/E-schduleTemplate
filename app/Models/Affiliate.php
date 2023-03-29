<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Affiliate
 * @package App\Models
 * @property string affiliate_name;
 * @property string affiliate_description;
 */
class Affiliate extends Model
{
    use HasFactory;
    public $primaryKey="affiliate_id";
}
