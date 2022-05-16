<?php
namespace App\Repository;

use App\Models\Application;
use Illuminate\Support\Collection;

interface ApplicationRepositoryInterface
{
    public function getList(): Collection;
}