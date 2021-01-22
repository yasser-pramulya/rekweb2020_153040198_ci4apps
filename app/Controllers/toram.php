<?php

namespace App\Controllers;

use App\Models\ToramModel;

class toram extends BaseController
{
    protected $toramModel;
    public function __construct()
    {
        $this->toramModel = new ToramModel();
    }

    public function index()
    {
        // $toram = $this->toramModel->findAll();

        $data = [
            'title' => 'Daftar kelas Toram',
            'toram' => $this->toramModel->getToram()
        ];

        // $toramModel = new \App\Models\ToramModel();
        // $toramModel = new ToramModel();

        return view('toram/index', $data);
    }

    public function detail($slug)
    {

        $data = [
            'title' => 'kelas',
            'toram' => $this->toramModel->getToram($slug)
        ];

        // jika job toram tidak ada di tabel
        if (empty($data['toram'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('kelas' . $slug . 'tidak ditemukan');
        }

        return view('toram/detail', $data);
    }
    public function create()
    {
        // session();
        $data = [
            'title' => 'form tambah data kelas',
            'validation' => \Config\Services::validation()

        ];
        return view('toram/create', $data);
    }

    public function save()
    {
        //validasi input
        if (!$this->validate([
            'kelas' => [
                'rules' => 'required|is_unique[toram.kelas]',
                'errors' => [
                    'required' => '{field} toram harus diisi.',
                    'is_unique' => '{field} toram sudah terdaftar'
                ]

            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [

                    'max_size' => 'ukuran gambar terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar'

                ]
            ]

        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/toram/create')->withInput()->with('validation', $validation);
            return redirect()->to('/toram/create')->withInput();
        }

        //ambil gambar
        $fileSampul = $this->request->getFile('sampul');
        //apakah tidak ada gambar yang di upload
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpg';
        } else {

            //generate naa sapul random
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan file ke folder img
            $fileSampul->move('img', $namaSampul);
            //ambil nama file
            // $namaSampul = $fileSampul->getName();

        }


        $slug = url_title($this->request->getVar('kelas'), '-', true);
        $this->toramModel->save([
            'kelas' => $this->request->getVar('kelas'),
            'slug' => $slug,
            'senjata' => $this->request->getVar('senjata'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil di Tambahkan');

        return redirect()->to('/toram');
    }

    public function delete($id)
    {
        //cari gambar
        $toram = $this->toramModel->find($id);

        //cek jika file gambarnya default
        if ($toram['sampul'] != 'default.jpg') {

            //hapus gambar
            unlink('img/' . $toram['sampul']);
        }


        $this->toramModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil di Hapus');
        return redirect()->to('/toram');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'form ubah data kelas',
            'validation' => \Config\Services::validation(),
            'toram' => $this->toramModel->getToram($slug)

        ];
        return view('toram/edit', $data);
    }

    public function update($id)
    {
        $toramlama = $this->toramModel->getToram($this->request->getVar('slug'));
        if ($toramlama['kelas'] == $this->request->getVar('kelas')) {
            $rule_kelas = 'required';
        } else {
            $rule_kelas = 'required|is_unique[toram.kelas]';
        }

        if (!$this->validate([
            'kelas' => [
                'rules' => $rule_kelas,
                'errors' => [
                    'required' => '{field} toram harus diisi.',
                    'is_unique' => '{field} toram sudah terdaftar'
                ]

            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [

                    'max_size' => 'ukuran gambar terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar'

                ]
            ]

        ])) {

            return redirect()->to('/toram/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $fileSampul = $this->request->getFile('sampul');

        //cek gambar
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            //generate nama file random
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan gambar
            $fileSampul->move('img', $namaSampul);
            //hapus file lama
            unlink('img/' . $this->request->getVar('sampulLama'));
        }

        $slug = url_title($this->request->getVar('kelas'), '-', true);
        $this->toramModel->save([
            'id' => $id,
            'kelas' => $this->request->getVar('kelas'),
            'slug' => $slug,
            'senjata' => $this->request->getVar('senjata'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil di Ubah');

        return redirect()->to('/toram');
    }
}
