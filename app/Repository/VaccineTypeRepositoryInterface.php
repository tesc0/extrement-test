<?php
namespace App\Repository;

use App\Models\VaccineType;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface VaccineTypeRepositoryInterface
{
    public function all(): Collection;
}