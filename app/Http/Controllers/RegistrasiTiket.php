<?php

namespace App\Http\Controllers;

use App\Models\Tikets;
use App\Models\User;
use Illuminate\Http\Request;


class RegistrasiTiket extends Controller
{

    public function index(){
         $collection = Tikets::with('user')->get();  
        return view('listTiket', compact('collection'));
    }
    public function create(){
        $collection = User::all();
        return view('registrasi', compact('collection'));
    }

    public function store(Request $request){

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'asal' => 'required|string|max:100',
            'tujuan' => 'required|string|max:100',
            'no_kursi' => 'required|int|max:100',
            'tgl_berangkat' => 'required|date'
        ]);

        try{
            $data =  $request->all();
            unset($data['_token']);
            Tikets::insert($data);
            return redirect('list')->with('success', 'Data berhasil disimpan.');
        } catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>'Terjadi kesalahan saat menyimpan data.']);
        };
        
    }

    public function relasiOneToOne(){
        return $data = User::with('phones')->get();        
    }

    public function rota(){
        return $data = User::with('ticket')->get();        
    }
}
