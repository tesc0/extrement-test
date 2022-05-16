<?php
namespace App\Repository;

use App\Models\Vaccine;
use Collator;
use Illuminate\Support\Collection;

interface VaccineRepositoryInterface
{
    public function getAvailableVaccinesByType(): Collection;
    public function getVaccinesByType(): Collection;
    public function getList(): Collection;
}