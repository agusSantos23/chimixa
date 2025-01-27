<?php

namespace App\Controllers;

use App\Models\IngredientModel;
use Exception;



class IngredientController extends BaseController{

  public function index() {
    $ingredientModel = new IngredientModel();

    try {
      
      $data['ingredients'] = $ingredientModel->findAll();
      $data['aside'] = view('templates/aside');
      $data['footer'] = view('templates/footer');



      return view('pages/list/ingredient_list', $data);

    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }



  public function saveIngredient($id = null){
    $ingredientModel = new IngredientModel();

    $validation = \Config\Services::validation();
    $validation->setRules([
      'name' => 'required|min_length[3]|max_length[255]',
      'category' => 'required|in_list[ vegetal, carne, pescado, especia, lacteos, frutas, granos, bebidas, condimentos, panaderia ]',
      'quantity_available' => 'required|decimal|greater_than_equal_to[0]',
      'unit' => 'required|in_list[ g, ml, kg, l, oz, lb, cda, unidad ]',
      'expiration_date' => 'required|valid_date[Y-m-d]',
      'price' => 'required|decimal|greater_than_equal_to[0]',
      'allergens' => 'permit_empty|in_list[ gluten, crustáceos, huevos, pescado, cacahuetes, soja, leche, frutos secos, apio, mostaza, sesamo, sulfitos, altramuces, moluscos ]'
    ]);

    try {

      if (!$validation->withRequest($this->request)->run()) {

        $data['validation'] = $validation;
        return view('ingredient_form', $data);

      }else{

        $ingredientData = [
          'name' => $this->request->getPost('name'),
          'category' => $this->request->getPost('category'),
          'quantity_available' => $this->request->getPost('quantity_available'),
          'unit' => $this->request->getPost('unit'),
          'expiration_date' => $this->request->getPost('expiration_date'),
          'price' => $this->request->getPost('price'),
          'allergens' => $this->request->getPost('allergens')
        ];

        
        if ($id) {
          $ingredientModel->update($id, $ingredientData);
          $message = 'Ingredient successfully updated';

        } else {
          $ingredientModel->save($ingredientData);
          $message = 'Ingredient created successfully';
        }

        return redirect()->to(uri: 'ingredients')->with('success', $message);
      }

      
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }


  public function deleteIngredient($id){
    $ingredientModel = new IngredientModel();

    try {
      $ingredientModel->delete($id);
      return redirect()->to('/ingredients')->with('success', 'Ingredient successfully deleted');

    }  catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }


}