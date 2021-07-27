<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'roles' => $this->userRoles(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    private function userRoles()
    {
        $roles = $this->getRoleNames();
        $permissions = $this->getAllPermissions()->pluck('name');

        return array_merge($roles->toArray(), $permissions->toArray());
    }
}
