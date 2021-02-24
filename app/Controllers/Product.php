<?php

namespace App\Controllers;
// เรียกใช้Model Product และ เรียกใช้API
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductModel;

class Product extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $model = new ProductModel(); //เรียกใช้ model จาก ProductModel เเละกำหนดลง $model
        $data['products'] = $model->orderBy('_id', 'DESC')->findAll(); //กำหนด dataที่มี array product ที่มาจากการ select  ทั้งหมด
        return $this->respond($data); //ส่งค่า$data ออกไป
    }

    //get product id
    public function getProduct($id = null) //กำหนด id ให้เป็น null
    {
        $model = new ProductModel(); //เรียกใช้ model จาก ProductModel เเละกำหนดลง $model
        $data = $model->where('_id', $id)->first(); //กำหนดdata ให้เป็รค่าที่มาจากการ select โดย id โดยรับ idจาก postman
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No Product');
        }
    }
    //create
    public function create()
    {
        $model = new ProductModel(); //เรียกใช้ model จาก ProductModel เเละกำหนดลง $model
        $data = [                   //กำหนดarrayโดยรับข้อมูลที่ถูกส้งเข้ามา 
            "name" => $this->request->getVar('name'),
            "category" => $this->request->getVar('category'),
            "price" => $this->request->getVar('price'),
            "tags" => $this->request->getVar('tags')

        ];
        $model->insert($data); // insertข้อมูล
        $response = [
            'status' => 201,
            'error' => null,
            "message" => [
                'success' => 'Product created success'
            ]
        ];
        return $this->respond($response); // ส่งresponseออกไปเพื่อเเจ้งเตือน
    }
    //update
    public function update($id = null) //กำหนด id ให้เป็น null
    {
        $model = new ProductModel(); //เรียกใช้ model จาก ProductModel เเละกำหนดลง $model
        $data = [                   //กำหนดarrayโดยรับข้อมูลที่ถูกส้งเข้ามา 
            "name" => $this->request->getVar('name'),
            "category" => $this->request->getVar('category'),
            "price" => $this->request->getVar('price'),
            "tags" => $this->request->getVar('tags')

        ];
        // $model->where('_id'),$id)->set($data)->update();
        $model->update($id, $data); //update ข้อมูลให้เป็นข้อมูลของ $data ที่ $id
        $response = [
            'status' => 201,
            'error' => null,
            "message" => [
                'success' => 'Product update success'
            ]
        ];
        return $this->respond($response); // ส่งresponseออกไปเพื่อเเจ้งเตือน
    }
    //delete
    public function delete($id = null) //กำหนด id ให้เป็น null
    {
        $model = new ProductModel(); //เรียกใช้ model จาก ProductModel เเละกำหนดลง $model
        $data = $model->find($id); //กำหนดdata ให้เป็นค่าที่ค้นหามาจากid
        if ($data) { //ถ้าdata มีค่าให้ทำการลบdataทิ้งเเละreturn
            $model->delete($id);
            $response = [
                'status' => 201,
                'error' => null,
                "message" => [
                    'success' => 'Product delete success'
                ]
            ];
            return $this->respond($response); // ส่งresponseออกไปเพื่อเเจ้งเตือน
        } else {
            return $this->failNotFound('No Product'); // ส่งresponseออกไปเพื่อเเจ้งเตือน
        }
    }
}
