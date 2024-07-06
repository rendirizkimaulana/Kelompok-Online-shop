<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class PaymentController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configuration
        Config::$serverKey = 'SB-Mid-server-v0iGwhJvrM2alHJSj7mb03vc';
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function getSnapToken(Request $request)
    {
        // dd($request->first_name);
        // Buat array parameter transaksi
        // $params = [
        //     'transaction_details' => [
        //         'order_id' => uniqid(),
        //         'gross_amount' => $request->amount,
        //     ],
        //     'customer_details' => [
        //         'first_name' => $request->first_name,
        //         'last_name' => $request->last_name,
        //         'email' => $request->email,
        //         'phone' => $request->phone,
        //     ],
        // ];

        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => $request->harga,
            ],
            'customer_details' => [
                'first_name' => $request->nama_depan,
                'last_name' => $request->nama_belakang,
                'email' => $request->email,
                'phone' => $request->no_telp,
                'billing_address' => [
                    'first_name' => $request->nama_depan,
                    'last_name' => $request->nama_belakang,
                    'address' => $request->alamat,
                    'city' => 'Kota Tagihan',
                    'postal_code' => $request->zip,
                    'phone' => $request->no_telp,
                    'country_code' => 'IDN',
                ],
            ],
        ];

        try {
            // Get Snap Payment Page URL
            $snapToken = Snap::getSnapToken($params);
            return response()->json([
                'snap_token' => $snapToken,
                'message' => 'success',
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function handleNotification(Request $request)
    {
        // Handle notification from Midtrans
        $notification = new \Midtrans\Notification();

        $transaction = $notification->transaction_status;
        $type = $notification->payment_type;
        $orderId = $notification->order_id;
        $fraud = $notification->fraud_status;

        // Handle transaction status
        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO: Handle challenge payment
                } else {
                    // TODO: Handle success payment
                }
            }
        } else if ($transaction == 'settlement') {
            // TODO: Handle settlement
        } else if ($transaction == 'pending') {
            // TODO: Handle pending
        } else if ($transaction == 'deny') {
            // TODO: Handle deny
        } else if ($transaction == 'expire') {
            // TODO: Handle expire
        } else if ($transaction == 'cancel') {
            // TODO: Handle cancel
        }

        return response()->json(['status' => 'ok']);
    }

    public function store_(Request $request)
    {
        $validate = [
            'id_produk' => 'required',
            'transaction_id' => 'required',
            'order_id' => 'required',
            'transaction_time' => 'required',
            'total_bayar' => 'required',
            'tipe_bayar' => 'required',
            'status' => 'required',
            'user_id' => 'required',
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
                $data = [
                    'id_produk' => $request->id_produk,
                    'id_size' => $request->id_size,
                    'transaction_id' => $request->transaction_id,
                    'order_id' => $request->order_id,
                    'transaction_time' => $request->transaction_time,
                    'total_bayar' => $request->total_bayar,
                    'tipe_bayar' => $request->tipe_bayar,
                    'status' => $request->status,
                    'user_id' => $request->user_id,
                    'alamat' => $request->alamat,
                    'email' => $request->email,
                ];
                // dd($data);
                DB::table('transaksi')
                ->insert($data);

                DB::table('m_size')
                ->where('id', $request->id_size)
                ->where('id_produk', $request->id_produk)
                ->update([
                    'stok' => DB::raw('stok - 1'),
                ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'toast' => ' berhasil ditambahkan',
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'toast' => 'Gagal menyimpan data: ' . $e->getMessage(),
            ]);
        }
    }
}
