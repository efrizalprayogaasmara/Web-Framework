<?php

namespace App\Controllers;

use App\Models\DataClient;
use CodeIgniter\Controller;

class ClientController extends Controller
{
    protected $mbooks;
    protected $table = 'dataclient';

    public function __construct()
    {
        $this->mbooks = new DataClient();
    }

    public function index()
    {
        // Fetch data from the DataClient model
        $data['dataclient'] = $this->mbooks->findAll();
        return view('layout/index', $data);
    }

    public function send()
    {
        $name = $this->request->getPost("name");
        $email = $this->request->getPost("email");
        $messages = $this->request->getPost("messages");

        $data = [
            'name' => $name,
            'email' => $email,
            'messages' => $messages
        ];

        try {
            $send = $this->mbooks->insert($data);
            if ($send) {
                // Data saved successfully
                return redirect()->to(base_url('/'))->with('success', 'Data has been saved.');
            } else {
                // Data couldn't be saved
                return redirect()->to(base_url('/'))->with('error', 'Data could not be saved.');
            }
        } catch (\Exception $e) {
            // Exception occurred (possible duplicate entry)
            return redirect()->to(base_url('/'))->with('error', 'Data already exists.');
        }
    }
}
