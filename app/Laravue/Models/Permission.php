<?php
/**
 * File Permission.php
 *
 * @author HaiDT
 * @package Laravue
 * @version 1.0
 */

namespace App\Laravue\Models;
use App\Laravue\Acl;
use Illuminate\Database\Query\Builder;
use Maklad\Permission\Models\Permission as PermissionM;
/**
 * Class Permission
 *
 * @package App\Laravue\Models
 */
class Permission extends PermissionM
{
    public $guard_name = 'api';

    /**
     * To exclude permission management from the list
     *
     * @param $query
     * @return Builder
     */
    public function scopeAllowed($query)
    {
        return $query->where('name', '!=', Acl::PERMISSION_PERMISSION_MANAGE);
    }
}
