<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products'; // กำหนดtable
    protected $primaryKey = '_id';//กำหนด key หลัก
    protected $allowedFields = ['_id', 'name', 'category', 'price', 'tags']; //กำหนดfiewที่อนุณาติให้เปลั้ยนแปลง
}
