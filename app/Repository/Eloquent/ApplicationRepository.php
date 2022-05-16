<?php

namespace App\Repository\Eloquent;

use App\Models\Application;
use App\Repository\ApplicationRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ApplicationRepository extends BaseRepository implements ApplicationRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param Application $model
     */
    public function __construct(Application $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    public function delete($eventId): bool
    {
        try {
            $this->model->where(['id' => $eventId])->update(['deleted' => 1]);

            return true;
        } catch(\Exception $e) {
            return false;
        }
    }

    public function getList(): Collection
    {
        return $this->model->select(['applications.*', 'vaccine_types.type'])
        ->join('vaccines', 'applications.vaccine_type_id', '=', 'vaccines.id')
        ->join('vaccine_types', 'vaccine_types.id', '=', 'vaccines.type_id')
        ->get();
    }
}