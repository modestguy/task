<?php
namespace App\Model;

use App\Model\Traits\HasTableName;
use Illuminate\Database\Eloquent\Model;

/**
 * Base model class
 * @property int $id
 */
abstract class BaseModel extends Model
{
    use HasTableName;
}