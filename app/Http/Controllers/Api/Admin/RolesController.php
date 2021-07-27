<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Models\Tenant\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Role $role)
    {
        return response()->json([
            'success' => true,
            'role' => $role
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user, Role $role)
    {
        //Premier code
        /* if ($role = $user->assignRole($request->input('role'))) {
            return response()->json([
                'success' => true,
                'role' => $role
            ]);
        } */
        //Mais je me suis demandé s'il n'y aura pas verification du role du user encours.
        //En espérant aussi qu'il y aurait un user a qui attribué le role dans le request.
        //donc j'ai fait ceci:
        if ($user->hasRole('Super admin'))
        {
            if ($role = $request->input('user')->assignRole($request->input('role'))) {
                return response()->json([
                    'success' => true,
                    'role' => $role
                ]);
            }
        }
    }
}
