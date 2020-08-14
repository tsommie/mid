<?php

namespace App\Http\Controllers\Trash;

use App\Contracts\Repositories\UserRepositoryInterface as Repository;
use App\Criteria\OnlyTrashed;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use NascentAfrica\EloquentRepository\Exceptions\EloquentRepositoryException;

class DeletedUserController extends Controller
{
    /**
     * @var Repository
     */
    protected $repository;

    /**
     * DeletedUserController constructor.
     *
     * DeletedUserController constructor.
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
        $users = $this->repository->latest()->paginate(30);

        return response()->json([
            'users' => $users
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
        $model = $this->repository->findWhere(['id' => $id])
            ->first();

        $model->restore();

        if (\request()->wantsJson()) {
            return response()->json([
                'message' => __('User restored successfully.')
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
                'message' => __("User deleted successfully.")
            ]);
        }
    }
}
