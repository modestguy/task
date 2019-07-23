<?php
namespace App\Model;

use App\Model\Traits\HasTableName;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BasePivot extends Pivot
{
    use HasTableName;
}