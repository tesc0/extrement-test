<?php

namespace App\Repository\Eloquent;

use App\Models\VaccineType;
use App\Repository\VaccineTypeRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class VaccineTypeRepository extends BaseRepository implements VaccineTypeRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param VaccineType $model
     */
    public function __construct(VaccineType $model)
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
}