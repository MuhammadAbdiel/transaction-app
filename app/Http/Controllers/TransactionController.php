<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Customer;
use App\Models\Sales;
use App\Models\SalesDet;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Sales::with('customer')->latest()->get();

            return response()->json($data);
        }

        return view('pages.transaction.index');
    }

    public function create()
    {
        $barangs = Barang::latest()->get();
        $customers = Customer::latest()->get();

        return view('pages.transaction.create', compact('barangs', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tgl' => 'required|date',
            'cust_id' => 'required|exists:m_customer,id',
            'barang_id.*' => 'required|exists:m_barang,id',
            'qty.*' => 'required|integer|min:1',
            'diskon_pct.*' => 'required|numeric|min:0',
            'diskon_nilai.*' => 'required|numeric|min:0',
            'harga_diskon.*' => 'required|numeric|min:0',
            'total.*' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
            'diskon' => 'required|numeric|min:0',
            'ongkir' => 'required|numeric|min:0',
            'total_bayar' => 'required|numeric|min:0',
        ]);

        $transaksi = new Sales();
        $transaksi->kode = 'TS' . time();
        $transaksi->tgl = $request->tgl;
        $transaksi->cust_id = $request->cust_id;
        $transaksi->subtotal = $request->subtotal;
        $transaksi->diskon = $request->diskon;
        $transaksi->ongkir = $request->ongkir;
        $transaksi->total_bayar = $request->total_bayar;
        $transaksi->save();

        foreach ($request->barang_id as $index => $barang_id) {
            $qty = $request->qty[$index];
            $harga = Barang::find($barang_id)->harga;
            $diskonPersen = $request->diskon_pct[$index];
            $diskonRupiah = $request->diskon_nilai[$index];
            $hargaDiskon = $request->harga_diskon[$index];
            $total = $request->total[$index];

            $detail = new SalesDet();
            $detail->sales_id = $transaksi->id;
            $detail->barang_id = $barang_id;
            $detail->qty = $qty;
            $detail->harga_bandrol = $harga;
            $detail->diskon_pct = $diskonPersen;
            $detail->diskon_nilai = $diskonRupiah;
            $detail->harga_diskon = $hargaDiskon;
            $detail->total = $total;
            $detail->save();
        }

        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil disimpan.');
    }
}
