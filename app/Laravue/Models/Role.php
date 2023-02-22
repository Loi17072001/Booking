<?php
/**
 * File Role.php
 *
 * @author HaiDT
 * @package Laravue
 * @version
 */
namespace App\Laravue\Models;

use App\Laravue\Acl;
use Maklad\Permission\Models\Role as RoleM;

/**
 * Class Role
 *
 * @property Permission[] $permissions
 * @property string $name
 * @package App\Laravue\Models
 */
class Role extends RoleM
{
    public $guard_name = 'api';

    /**
     * Check whether current role is admin
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->name === Acl::ROLE_ADMIN;
    }
}
