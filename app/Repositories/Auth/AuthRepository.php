<?php
namespace App\Repositories\Auth;

use App\Models\Admin;
use App\Repositories\EloquentRepository;

class AuthRepository extends EloquentRepository implements AuthInterface
{
    public function getModel() {
        return Admin::class;
    }

}