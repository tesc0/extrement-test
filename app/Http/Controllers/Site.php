<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Repository\VaccineRepositoryInterface;
use App\Repository\ApplicationRepositoryInterface;

class Site extends Controller
{
    private $vaccineRepository;
    private $applicationRepository;

    public function __construct(
        VaccineRepositoryInterface $vaccineRepository,
        ApplicationRepositoryInterface $applicationRepository
    ) 
    {
        $this->vaccineRepository = $vaccineRepository;
        $this->applicationRepository = $applicationRepository;
    }


    public function index()
    {
        $data = [];
        $data['vaccines'] = $this->vaccineRepository->getVaccinesByType();
        return view('index', $data);
    }

    public function registrationView()
    {
        $data = [];
        $data['vaccines'] = $this->vaccineRepository->getAvailableVaccinesByType();
        return view('registration', $data);
    }

    public function registration(Request $request)
    {
        $data = [];
        $errors = [];

        $data['success'] = 0;

        $validator = Validator::make($request->all(), [
            'application[email]' => 'required|email',
            'application[name]' => 'required',
            'application[vaccine_id]' => 'required'
        ]);

        if(!empty($validator->failed())) {

            $validatorErrors = $validator->errors();
            foreach ($validatorErrors->getMessages() as $error) {
                $errors[] = $error;
            }
            $data['message'] = 'Érvénytelen adatok kerültek megadásra';
        } else {

            try {
                $applicationData = $request->get('application');
                $this->applicationRepository->create($applicationData);
                
                $data['success'] = 1;

            } catch (\Exception $e) {

            }
        }

        $data['errors'] = $errors;
        return redirect('/');
    }
}
