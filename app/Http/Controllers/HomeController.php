<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data_baju = DB::table('m_produk')->where('is_hapus', '0')->get();
        $berkas_upload = DB::table('berkas_upload')->where('tipe_upload', 'Slider')->get();
        // dd($data_baju);
        return view('home', compact('data_baju', 'berkas_upload'));
    }

    public function products()
    {
        $data_baju = DB::table('m_produk')->where('is_hapus', '0')->get();
        // dd($data_baju);
        return view('product', compact('data_baju'));
    }


    public function index_about()
    {
        $data_tentang = DB::table('berkas_upload')->where('tipe_upload', 'Tentang')->get()->first();
        // dd('about');
        return view('about', compact('data_tentang'));
    }

    public function profile_index()
    {
        // mengecek apakah user sudah login atau belum
        if (!Auth::check()) {
            // jika belum login, maka arahkan ke halaman login
            return redirect()->route('login');
        }

        $data_transaksi = DB::table('transaksi')
        ->leftJoin('m_produk', 'm_produk.id', '=', 'transaksi.id_produk')
        ->leftJoin('m_size', 'm_size.id', '=', 'transaksi.id_size')
        ->where('user_id', auth()->user()->id)->get();
        // dd($data_transaksi);
        return view('profile', compact('data_transaksi'));
    }

    public function detail_p($id)
    {

        $data_baju = DB::table('m_produk')->where('id', decrypt($id))->get()->first();
        $size = DB::table('m_size')->where('id_produk', decrypt($id))->get();
        // dd($size);
        return view('detail_p', compact('data_baju', 'size'));
    }

    public function checkout_p($id, $size, $id_2)
    {
        $this->middleware('auth');

        $data_baju = DB::table('m_produk')->where('id', decrypt($id))->get()->first();
        $size = DB::table('m_size')->where('id_produk', decrypt($id))->where('size', $size)->get()->first();
        // dd($size);
        return view('checkout_p', compact('data_baju', 'size'));
    }


}
