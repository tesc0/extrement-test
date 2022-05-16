<?php

namespace App\Repository\Eloquent;

use App\Models\Vaccine;
use App\Repository\VaccineRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class VaccineRepository extends BaseRepository implements VaccineRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param Vaccine $model
     */
    public function __construct(Vaccine $model)
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

    public function getAvailableVaccinesByType(): Collection
    {
        return DB::table('vaccine_types')
        ->select(['vaccine_types.type', 'vaccine_types.id'])
        ->join('vaccines', 'vaccine_types.id', '=', 'vaccines.type_id')
        ->groupBy('vaccine_types.id')
        ->get();
    }

    public function getVaccinesByType(): Collection
    {
        return $this->model
        ->select('vaccine_types.type')
        ->selectRaw('sum(amount) as amount')
        ->join('vaccine_types', 'vaccine_types.id', '=', 'vaccines.type_id')
        ->whereRaw('amount > 0')
        ->groupBy('type')
        ->get();
    }

    public function getList(): Collection
    {
        return $this->model
        ->select(['vaccines.*', 'users.name', 'vaccine_types.type'])
        ->join('users', 'users.id', '=', 'vaccines.user_id')
        ->join('vaccine_types', 'vaccine_types.id', '=', 'vaccines.type_id')
        ->get();
    }
}