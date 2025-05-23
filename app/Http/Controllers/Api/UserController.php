<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $orderColumn = request('order_column', 'created_at');
        if (!in_array($orderColumn, ['id', 'name', 'created_at'])) {
            $orderColumn = 'created_at';
        }
        $orderDirection = request('order_direction', 'desc');
        if (!in_array($orderDirection, ['asc', 'desc'])) {
            $orderDirection = 'desc';
        }
        $users = User::
        when(request('search_id'), function ($query) {
            $query->where('id', request('search_id'));
        })
            ->when(request('search_title'), function ($query) {
                $query->where('name', 'like', '%'.request('search_title').'%');
            })
            ->when(request('search_global'), function ($query) {
                $query->where(function($q) {
                    $q->where('id', request('search_global'))
                        ->orWhere('name', 'like', '%'.request('search_global').'%');

                });
            })
            ->orderBy($orderColumn, $orderDirection)
            ->paginate(50);

        return UserResource::collection($users);
    }

    public function store(StoreUserRequest $request)
    {
        $role = Role::find($request->role_id);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->telefono = $request->telefono;
        $user->nombre_comercial = $request->nombre_comercial;
        $user->direccion = $request->direccion;
        $user->codigo_postal = $request->codigo_postal;
        $user->localidad = $request->localidad;
        $user->tipo = $request->tipo;
        $user->fondo = $request->fondo;
        $user->logo = $request->logo;
        $user->descripcion = $request->descripcion;

        $user->password = Hash::make($request->password);

        if ($user->save()) {
            if ($role) {
                $user->assignRole($role);
            }
            return new UserResource($user);
        }
    }

    // Cargrar la imagen del logo
    public function uploadFondo(Request $request)
    {
        $user = Auth::user();

        if ($request->hasFile('fondo')) {

            $user->clearMediaCollection('fondo');

            $media = $user->addMediaFromRequest('fondo')->toMediaCollection('fondo');


            $user->fondo = $media->getUrl();
            $user->save();
        }

        return response()->json([
            'message' => 'Fondo image uploaded successfully.',
            'fondo_url' => $user->fondo,
        ]);
    }
    
    public function uploadLogo(Request $request)
    {
        $user = Auth::user();

        if ($request->hasFile('logo')) {
            
            $user->clearMediaCollection('logo');
            
            $media = $user->addMediaFromRequest('logo')->toMediaCollection('logo');

            
            $user->logo = $media->getUrl();
            $user->save();
        }

        return response()->json([
            'message' => 'Logo image uploaded successfully.',
            'logo_url' => $user->logo,
        ]);
    }
        public function getTipo($userId)
    {
        $user = User::findOrFail($userId);
        return response()->json([
            'tipo' => $user->tipo,
            'logo' => $user->logo,
        ]);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return UserResource
     */
    public function show(User $user)
    {
        $user->load('roles')->get();
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return UserResource
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $role = Role::find($request->role_id);

        $user->name = $request->name;
        $user->email = $request->email;
        

        if(!empty($request->password)) {
            $user->password = Hash::make($request->password) ?? $user->password;
        }

        if ($user->save()) {
            if ($role) {
                $user->syncRoles($role);
            }
            return new UserResource($user);
        }
    }


    public function updateimg(Request $request)
    {

        $user = User::find($request->id);

        if($request->hasFile('picture')) {
            $user->media()->delete();
            $media = $user->addMediaFromRequest('picture')->preservingOriginal()->toMediaCollection('images-users');

        }
        $user =  User::with('media')->find($request->id);
        return  $user;
    }

    public function getUserData()
    {
        return response()->json(Auth::user());
    }

    public function destroy(User $user)
    {
        $this->authorize('user-delete');
        $user->delete();

        return response()->json(['message' => 'Usuario eliminado correctamente.']);
    }
    
}
