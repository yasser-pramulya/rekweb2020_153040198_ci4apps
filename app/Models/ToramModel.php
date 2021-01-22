<?php

namespace App\Models;

use CodeIgniter\Model;

class ToramModel extends Model
{
    protected $table = 'toram';
    protected $useTimestamps = true;
    protected $allowedFields = ['kelas', 'slug', 'senjata', 'sampul'];

    public function getToram($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}
