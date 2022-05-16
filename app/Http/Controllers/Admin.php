<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Repository\VaccineRepositoryInterface;
use App\Repository\ApplicationRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use App\Repository\VaccineTypeRepositoryInterface;
use Illuminate\Support\Facades\Redis;

class Admin extends Controller
{
    private $vaccineRepository;
    private $applicationRepository;
    private $userRepository;
    private $vaccineTypeRepository;

    public function __construct(
        VaccineRepositoryInterface $vaccineRepository,
        ApplicationRepositoryInterface $applicationRepository,
        UserRepositoryInterface $userRepository,
        VaccineTypeRepositoryInterface $vaccineTypeRepository
    ) 
    {
        $this->vaccineRepository = $vaccineRepository;
        $this->applicationRepository = $applicationRepository;
        $this->userRepository = $userRepository;
        $this->vaccineTypeRepository = $vaccineTypeRepository;
    }

    public function login(Request $request)
    {
        $data = [];
        $errors = [];

        $data['success'] = 0;

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(!empty($validator->failed())) {

            $validatorErrors = $validator->errors();
            foreach ($validatorErrors->getMessages() as $error) {
                $errors[] = $error;
            }
            $data['message'] = 'Érvénytelen adatok kerültek megadásra';
        } else {

            try {
                $email = $request->get('email');
                $password = $request->get('password');

                $user = $this->userRepository->getUserByEmail($email);

                if(empty($user)) {
                    $errors[] = 'no-user-for-email';
                    $data['message'] = 'Nem található felhasználó evvel az email-címmel!';
                } else if(Hash::check($password, $user->password)) {

                    $request->session()->put('user', $user->id);

                    $data['userId'] = $user->id;
                    $data['message'] = 'Sikeres belépés!';
                    $data['success'] = 1;
                }

            } catch (\Exception $e) {

            }
        }

        $data['errors'] = $errors;
        return redirect('/admin/landing');
    }

    public function landing()
    {
        $data = [];
        return view('admin/landing', $data);
    }

    public function vaccines()
    {
        $data = [];
        $data['vaccines'] = $this->vaccineRepository->getList();
        return view('admin/vaccines', $data);
    }

    public function vaccine($id = null)
    {
        $data = [];
        $data['vaccines'] = $this->vaccineTypeRepository->all();
        if (!empty($id)) {
            $data["id"] = $id;
        }
        return view('admin/vaccine', $data);
    }

    public function applications()
    {
        $data = [];
        $data['applications'] = $this->applicationRepository->getList();
        return view('admin/applications', $data);
    }

    public function vaccineSave(Request $request)
    {
        $data = [];
        $errors = [];

        $validator = Validator::make($request->all(), [
            'vaccine[type_id]' => 'required',
            'vaccine[sku]' => 'required',
            'vaccine[arrival]' => 'required',
            'vaccine[amount]' => 'required'
        ]);

        if(!empty($validator->failed())) {

            $validatorErrors = $validator->errors();
            foreach ($validatorErrors->getMessages() as $error) {
                $errors[] = $error;
            }
            $data['message'] = 'Érvénytelen adatok kerültek megadásra';
        } else {

            try {

                $vaccineData = $request->get('vaccine');
                $vaccineData['user_id'] = $request->session()->get('user');

                if (!empty($vaccineData['id'])) {
                    $this->vaccineRepository->update(["id" => $vaccineData["id"]], $vaccineData);
                } else {
                    print_R($vaccineData);
                    $this->vaccineRepository->create($vaccineData);
                }
        
                $data['success'] = 1;

            } catch (\Exception $e) {

            }
        }

        $data['errors'] = $errors;
        return redirect('/admin/vaccines');
    }
}
