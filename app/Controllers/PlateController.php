<?php

namespace App\Controllers;

use App\Models\PlateModel;
use App\Models\StoreModel;
use Exception;


class PlateController extends BaseController{

  public function index(){
    $plateModel = new PlateModel();

    try {

      $userRole = session()->get('userRole');
        
      if (!$userRole) return redirect()->to(base_url('/auth/login'));
      

      

      $data['aside'] = view('templates/aside');
      $data['footer'] = view('templates/footer');

      $perPage = $this->request->getGet('perPage') ?? 1;
      $data['perPage'] = $perPage;

      $searchParams = $this->request->getGet('searchParams') ?? [];
      $data['searchParams'] = $searchParams;

      $data = array_merge($data, $plateModel->getPlates($perPage, $searchParams));


      return view('pages/list/plate_list', $data);

    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }
  
  public function savePlate($id = null){
    $plateModel = new PlateModel();

    $validation = \Config\Services::validation();
    $validation->setRules([
      'name' => 'required|min_length[3]|max_length[255]',
      'description' => 'min_length[10]|max_length[500]',
      'price' => 'required|decimal|greater_than_equal_to[0]',
      'category' => 'required|in_list[Entrante,Plato Principal,Postre,Ensalada,Sopa,Guarnición,Desayuno,Almuerzo]',
      'preparation_time' => 'required|integer|greater_than[0]'
    ]);

    try {

      if (!$validation->withRequest($this->request)->run()) {

        $data['validation'] = $validation;
        return view('plate_form', $data);

      }else{

        $plateData = [
          'name' => $this->request->getPost('name'),
          'description' => $this->request->getPost('description'),
          'price' => $this->request->getPost('price'),
          'category' => $this->request->getPost('category'),
          'preparation_time' => $this->request->getPost('preparation_time')
        ];
        

        if ($id) {
          $plateModel->update($id, $plateData);
          $message = 'Plate successfully updated';

        } else {
          $plateModel->save($plateData);
          $message = 'Plate created successfully';
        }
        
        return redirect()->to(uri: '/plates')->with('success', $message);
      }

      
    } catch (Exception $e) {

      echo "Error: " . $e->getMessage();
    }
  }


  public function deletePlate($id){
    $plateModel = new PlateModel();

    try {
      $plateModel->delete($id);
      return redirect()->to('/plates')->with('success', 'Plate successfully deleted');

    }  catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }

  }


  public function ingredientsOfPlate($plateId){

    $plateModel = new PlateModel();
    $storeModel = new StoreModel();

    try {
      $userRole = session()->get('userRole');
        
      if (!$userRole) return redirect()->to(base_url('/auth/login'));
      

      $data['dataUser'] = [
        'userId' => session()->get('userId'),
        'userName' => session()->get('userName'),
        'userLastname' => session()->get('userLastname'),
        'userEmail' => session()->get('userEmail'),
        'userPhone' => session()->get('userPhone'),
        'userCountry' => session()->get('userCountry'),
        'userRole' => $userRole
      ];

      $data['aside'] = view('templates/aside', $data);
      $data['footer'] = view('templates/footer');

      $data['plate'] = $plateModel->select('id, name')->find($plateId);
      $data['ingredients'] = $storeModel->getIngredientsByPlate($plateId);

      return view('pages/list/store_list',$data );
      

    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }

}