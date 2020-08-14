<?php

namespace App\Http\Controllers\Trash;

use App\Contracts\Repositories\OrganizationRepositoryInterface as Repository;
use App\Criteria\OnlyTrashed;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use NascentAfrica\EloquentRepository\Exceptions\EloquentRepositoryException;

/**
 * Class DeletedOrganizationController
 *
 * @package App\Http\Controllers\Trash
 * @author Anitche Chisom
 */
class DeletedOrganizationController extends Controller
{
    /**
     * @var Repository
     */
    protected $repository;

    /**
     * DeletedOrganizationController constructor.
     *
     * @param Repository $repository
     * @throws EloquentRepositoryException
     */
    public function __construct(Repository $repository)
    {
        $this->middleware(['auth']);
        $this->repository = $repository;
        $this->repository->pushCriteria(OnlyTrashed::class);
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
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @throws BindingResolutionException
     * @throws EloquentRepositoryException
     */
    public function update(Request $request, $id)
    {
        $organization = $this->repository->findWhere(['id' => $id])
            ->first();

        $organization->restore();

        if (\request()->wantsJson()) {
            return response()->json([
                'organization' => $organization,
                'message' => __('Organization restored successfully.')
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     * @throws BindingResolutionException
     * @throws EloquentRepositoryException
     */
    public function destroy($id)
    {
        $this->repository->forceDelete($id);

        if (\request()->wantsJson()) {
            return response()->json([
                'message' => __("Organization deleted successfully.")
            ]);
        }
    }
}
