<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function index_produk()
    {
        return view('admin.produk');
    }

    public function index_konten()
    {
        return view('admin.konten');
    }

    public function tambah_produk()
    {
        $data_produk = DB::table('m_produk')
            ->leftJoin('m_size', 'm_size.id_produk', '=', 'm_produk.id')
            ->where('m_produk.id', request()->id)
            ->get()
            ->first();

        $sizes = ['s', 'm', 'l', 'xl', 'xxl'];
        foreach ($sizes as $size) {
            $stok[$size] = DB::table('m_produk')
                ->leftJoin('m_size', 'm_size.id_produk', '=', 'm_produk.id')
                ->where('m_size.size', $size)
                ->where('m_produk.id', request()->id)
                ->get()
                ->first();
        }
        // dd($stok);
        return view('admin.tambah', compact('data_produk', 'stok'));
    }

    public function tambah_konten()
    {
        return view('admin.tambah_konten');
    }

    public function data_penjualan(Request $request)
    {
        if ($request->id == '1') {
            $data = DB::table('transaksi')->leftJoin('users', 'users.id', '=', 'transaksi.user_id')->select('transaksi.*', 'users.name', 'm_produk.nama as nama_produk')->leftJoin('m_produk', 'm_produk.id', '=', 'transaksi.id_produk')->get();
        } elseif ($request->id == '2') {
            $data = DB::table('m_produk')->select('m_produk.*', 'm_produk.nama as nama_produk')->where('m_produk.is_hapus', '0')->get();
        } elseif ($request->id == '3') {
            $data = DB::table('berkas_upload')->get();
        }

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('id', function ($row) {
                    return encrypt($row->id);
                })
                ->addColumn('aksi', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-warning btn-sm editProduct"><i class="bi bi-eye-fill"></i> Lihat</a>';
                    return $btn;
                })
                ->addColumn('aksi_b', function ($row) {
                    $btn = '<a href="' . url('admin/tambah/produk?id=' . $row->id) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-warning btn-sm mb-1">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-danger btn-sm deleteProduct">Hapus</a>';
                    return $btn;
                })
                ->addColumn('aksi_c', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-danger btn-sm deleteProduct"><i class="bi bi-trash"></i> Hapus</a>';
                    return $btn;
                })
                ->rawColumns(['aksi', 'aksi_b', 'aksi_c'])
                ->make(true);
        }
    }

    public function detail_transaksi(Request $request)
    {
        $data = DB::table('transaksi')
            ->leftJoin('users', 'users.id', '=', 'transaksi.user_id')
            ->select('transaksi.*', 'users.name', 'm_produk.nama as nama_produk', 'm_produk.gambar', 'm_size.size')
            ->leftJoin('m_size', 'm_size.id', '=', 'transaksi.id_size')
            ->leftJoin('m_produk', 'm_produk.id', '=', 'transaksi.id_produk')
            ->where('transaksi.id', $request->id)
            ->first();

        return $data;
    }

    public function store_(Request $request)
    {
        $validate = [];

        $validator = Validator::make($request->all(), $validate);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ]);
        }

        DB::beginTransaction();
        try {
            $data = [
                'status' => $request->ganti_status_transaksi,
            ];
            DB::table('transaksi')
                ->where('order_id', $request->input_order_id)
                ->update($data);

            DB::commit();

            return redirect()->route('index.admin');
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'toast' => 'Gagal menyimpan data: ' . $e->getMessage(),
            ]);
        }
    }

    public function store_file(Request $request)
    {
        $validate = [
            'input_nama_file' => 'required',
        ];

        $validator = Validator::make($request->all(), $validate);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ]);
        }

        DB::beginTransaction();
        try {
            $file = $request->file('input_nama_file');
            $filename = $file->getClientOriginalName();
            $filename = str_replace(' ', '-', $filename);
            $filename = preg_replace('/[^A-Za-z0-9\-.]/', '', $filename);
            $file->move(public_path('berkas_upload'), $filename);

            if (!$request->id) {
                DB::table('berkas_upload')->insert([
                    'nama_file' => $filename,
                    'urai' => $request->input_urai,
                    'deskripsi' => $request->deskripsi,
                    'tipe_upload' => $request->input_tipe_upload,
                ]);
            } else {
                DB::table('berkas_upload')
                    ->where('id', $request->id)
                    ->update([
                        'nama_file' => $filename,
                        'urai' => $request->input_urai,
                        'deskripsi' => $request->deskripsi,
                        'tipe_upload' => $request->input_tipe_upload,
                    ]);
            }

            DB::commit();

            return redirect('admin/kontem');
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'toast' => 'Gagal menyimpan data: ' . $e->getMessage(),
            ]);
        }
    }

    public function store_produk(Request $request)
    {
        $validate = [
            // 'gambar' => 'required',
        ];

        $validator = Validator::make($request->all(), $validate);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ]);
        }

        DB::beginTransaction();
        try {
            // dd($request->file('gambar'));
            $file = $request->file('gambar');
            $filename = $file->getClientOriginalName();
            $filename = str_replace(' ', '-', $filename);
            $filename = preg_replace('/[^A-Za-z0-9\-.]/', '', $filename);
            $file->move(public_path('assets'), $filename);

            if (!$request->id) {
                $insert = DB::table('m_produk')->insertGetId([
                    'gambar' => $filename,
                    'deskripsi' => $request->deskripsi,
                    'nama' => $request->nama_produk,
                    'created_at' => now(),
                ]);
                $dataToInsert = [];

                foreach ($request->ukuran as $i => $ukuran) {
                    $dataToInsert[] = [
                        'id_produk' => $insert,
                        'size' => $ukuran,
                        'stok' => $request->stok[$i],
                        'harga' => $request->harga_satuan[$i],
                    ];
                }
                $insert_2 = DB::table('m_size')->insert($dataToInsert);
            } else {
                $insert = $request->id;
                DB::table('m_produk')
                    ->where('id', $request->id)
                    ->update([
                        'gambar' => $filename,
                        'deskripsi' => $request->deskripsi,
                        'nama' => $request->nama_produk,
                    ]);

                $hapus = DB::table('m_size')
                    ->where('id_produk', $request->id)
                    ->delete();

                $dataToInsert = [];

                foreach ($request->ukuran as $i => $ukuran) {
                    $dataToInsert[] = [
                        'id_produk' => $request->id,
                        'size' => $ukuran,
                        'stok' => $request->stok[$i],
                        'harga' => $request->harga_satuan[$i],
                    ];
                }
                $insert_2 = DB::table('m_size')->insert($dataToInsert);
            }

            DB::commit();

            return redirect('admin/produk');
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'toast' => 'Gagal menyimpan data: ' . $e->getMessage(),
            ]);
        }
    }

    public function delete_(Request $request){

        DB::beginTransaction();
        try {
            if ($request->table == 'berkas_upload') {
                $delete = DB::table($request->table)
                    ->where('id', $request->id)
                    ->delete();
            } elseif ($request->table == 'm_produk') {
                DB::table($request->table)
                ->where('id', $request->id)
                ->update([
                    'is_hapus' => '1'
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'toast' => 'Gagal menyimpan data: ' . $e->getMessage(),
            ]);
        }
    }
}
