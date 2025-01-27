<?php

namespace App\Controllers;

use App\Models\PlateModel;
use Exception;


class PlateController extends BaseController{

  public function index(){
    $plateModel = new PlateModel();

    try {

      $data['plates'] = $plateModel->findAll();
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

}