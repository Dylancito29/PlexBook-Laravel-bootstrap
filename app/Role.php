<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 📛 The Access Badge (Role Model)
 * 
 * This model defines WHO you are in the system (Admin vs. User).
 * It's like the security badge you wear around your neck.
 * - Admin: Has the "Master Key" (Can edit, delete, add books).
 * - User: Has a "Reader Pass" (Can only browse and borrow).
 */
class Role extends Model
{
    /**
     * 🗃️ The Database Table
     * 
     * Explicitly telling Laravel: "Hey, look for the 'roles' table, not 'role's".
     */
    protected $table = 'roles';

    /**
     * 🛡️ The White List ($fillable)
     * 
     * The "VIP List" of attributes.
     * Only the 'Rol_name' (e.g., 'admin', 'user') is allowed to be mass-assigned.
     * This prevents someone from accidentally (or maliciously) changing critical ID fields.
     */
    protected $fillable = [
        'Rol_name'
    ];
}
