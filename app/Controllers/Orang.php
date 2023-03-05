<?php

namespace App\Controllers;

use App\Models\OrangModel;

class Orang extends BaseController
{
    protected $orangkModel;
    protected $helpers = ['form'];
    public function __construct()
    {
        $this->orangkModel = new OrangModel();
    }
    public function index()
    {
        $currentPage = $this->request->getVar('page_orang') ? $this->request->getVar('page_orang') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $orang = $this->orangkModel->search($keyword);
        } else {
            $orang = $this->orangkModel;
        }

        $data = [
            'title' => 'Daftar Orang',
            // 'orang' => $this->orangkModel->findAll()
            'orang' => $orang->paginate(10, 'orang'),
            'pager' => $this->orangkModel->pager,
            'currentPage' => $currentPage
        ];


        return view('orang/index', $data);
    }
}
