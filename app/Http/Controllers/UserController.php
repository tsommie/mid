<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\UserProfileRepositoryInterface as UserProfileRepository;
use App\Contracts\Repositories\UserRepositoryInterface as Repository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use NascentAfrica\EloquentRepository\Exceptions\EloquentRepositoryException;

class UserController extends Controller
{
    /**
     * @var Repository
     */
    protected $repository;

    /**
     * @var UserProfileRepository
     */
    protected $userProfileRepository;

    /**
     * UserController constructor.
     * @param Repository $repository
     * @param UserProfileRepository $userProfileRepository
     */
    public function __construct(Repository $repository, UserProfileRepository $userProfileRepository)
    {
        $this->middleware(['auth']);
        $this->repository = $repository;
        $this->userProfileRepository = $userProfileRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     * @throws BindingResolutionException
     * @throws EloquentRepositoryException
     */
    public function index()
    {
        $users = $this->repository->latest()->paginate(30);

        return response()->json([
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws BindingResolutionException
     * @throws EloquentRepositoryException
     */
    public function store(Request $request)
    {
        $userData = $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $profileData = $request->validate([
            'profile.first_name'  => ['required', 'string', 'max:255'],
            'profile.last_name'   => ['required', 'string', 'max:255'],
            'profile.other_names' => ['nullable', 'string', 'max:255'],
        ]);

        $user = $this->repository->create($userData);

        $user->userProfile()->create($profileData['profile']);

        return \response()->json([
            'user' => $user,
            'message' => __('Created successfully!')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     * @throws BindingResolutionException
     * @throws EloquentRepositoryException
     */
    public function show($id)
    {
        $user = $this->repository->with(['userProfile'])->find($id);

        return \response()->json([
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int|string $id
     * @return JsonResponse
     * @throws BindingResolutionException
     * @throws EloquentRepositoryException
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
        ]);

        $profileData = $request->validate([
            'profile.first_name'  => ['required', 'string', 'max:255'],
            'profile.last_name'   => ['required', 'string', 'max:255'],
            'profile.other_names' => ['nullable', 'string', 'max:255'],
        ]);

        $user = $this->repository->update($id, $data);

        $user->userProfile()->update($profileData['profile']);

        return \response()->json([
            'user' => $user,
            'message' => __('Updated successfully!')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);

            if (\request()->wantsJson()) {
                return response()->json([
                    'message' => __("User deleted successfully.")
                ]);
            }
        } catch (BindingResolutionException|EloquentRepositoryException $exception) {
            if (\request()->wantsJson()) {
                return response()->json([
                    'message' => __('Unable to delete this user!'),
                ]);
            }
        }
    }
}
