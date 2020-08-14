<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\OrganizationRepositoryInterface as Repository;
use App\Contracts\Repositories\UserRepositoryInterface as UserRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use NascentAfrica\EloquentRepository\Exceptions\EloquentRepositoryException;

class OrganizationController extends Controller
{
    /**
     * @var Repository
     */
    protected $repository;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * OrganizationController constructor.
     *
     * @param Repository $repository
     * @param UserRepository $userRepository
     */
    public function __construct(Repository $repository, UserRepository $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $organizations = $this->repository->latest()->paginate(30);

        return response()->json([
            'organizations' => $organizations
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
        $data = $request->validate([
            'name'                      => ['required', 'string', 'max:255'],
            'email'                     => ['required', 'string', 'email', 'max:255', 'unique:organizations'],
            'description'               => ['required', 'string', 'max:600'],
            'phone_number'              => ['required', 'string', 'max:12'],
            'website'                   => ['nullable', 'string', 'max:255'],

            'administrator.name'        => ['required', 'string', 'max:255'],
            'administrator.email'       => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'administrator.password'    => ['required', 'string', 'min:8', 'confirmed'],

            'profile.first_name'        => ['required', 'string', 'max:255'],
            'profile.last_name'         => ['required', 'string', 'max:255'],
            'profile.other_names'       => ['nullable', 'string', 'max:255'],

            'location.street'           => ['required', 'string', 'max:255'],
            'location.street_line_2'    => ['nullable', 'string', 'max:255'],
            'location.city'             => ['required', 'string', 'max:255'],
            'location.country'          => ['required', 'string', 'max:255'],
            'location.postal'           => ['required', 'string', 'max:255'],
        ]);

        $organizationData = [
            'name'            => $data['name'],
            'email'           => $data['email'],
            'description'     => $data['description'],
            'phone_number'    => $data['phone_number'],
            'website'         => $data['website'],
        ];

        $user = $this->userRepository->create($data['administrator']);

        $profile = $user->userProfile()->create($data['profile']);

        $organization = $user->organizations()->create($organizationData);

        $address = $organization->address()->create($data['location']);

        return \response()->json([
            'organization' => $organization,
            'message' => __('Organization created successfully!')
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
        $organization = $this->repository->with(['user', 'address'])->find($id);
        $organization->user->load('userProfile');

        return \response()->json([
            'organization' => $organization
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
            'name'                      => ['required', 'string', 'max:255'],
            'email'                     => ['required', 'string', 'email', 'max:255', Rule::unique('organizations')->ignore($id)],
            'description'               => ['required', 'string', 'max:600'],
            'phone_number'              => ['required', 'string', 'max:12'],
            'website'                   => ['nullable', 'string', 'max:255'],

            'location.street'           => ['required', 'string', 'max:255'],
            'location.street_line_2'    => ['nullable', 'string', 'max:255'],
            'location.city'             => ['required', 'string', 'max:255'],
            'location.country'          => ['required', 'string', 'max:255'],
            'location.postal'           => ['required', 'string', 'max:255'],
        ]);

        $organizationData = [
            'name'            => $data['name'],
            'email'           => $data['email'],
            'description'     => $data['description'],
            'phone_number'    => $data['phone_number'],
            'website'         => $data['website'],
        ];

        $organization = $this->repository->update($id, $organizationData);

        $address = $organization->address()->update($data['location']);

        return \response()->json([
            'organization' => $organization,
            'message' => __('Organization updated successfully!')
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
                    'message' => __("Organization deleted successfully.")
                ]);
            }
        } catch (BindingResolutionException|EloquentRepositoryException $exception) {
            if (\request()->wantsJson()) {
                return response()->json([
                    'message' => __('Unable to delete this organization!'),
                ]);
            }
        }
    }
}
