<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use PDF;
// use App\User;

class LaporanController extends Controller
{
    public function index() {
        $data = array('title' => 'Form Laporan Penjualan');
        return view('penjual.laporan.index', $data);
    }

    public function proses(Request $request) {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $bulan_transaksi = date('Y-m', strtotime($request->tahun.'-'.$request->bulan));
        $itemtransaksi = Order::whereHas('cart', function($q) use ($bulan_transaksi) {
            $q->where('status_pembayaran', 'sudah');
            $q->where('user_id', 'like', $bulan_transaksi.'%');
        })
        ->get();
        $data = array('title' => 'Laporan Penjualan',
                    'itemtransaksi' => $itemtransaksi,
                    'bulan' => $this->cetakbulan($bulan),
                    'tahun' => $tahun);
        return view('penjual.laporan.proses', $data)->with('no', 1);

        // $itemorder = Order::whereHas('cart', function($q) use ($itemuser) {
        //     $q->where('status_cart', 'checkout');
        //     $q->where('user_id', $itemuser->id);
        // })
        // ->orderBy('id')
        // ->paginate(5);
    }

    // export PDF
    // public function cetak_pdf(Request $request) {
    // 	$pdf = PDF::loadview('penjual\laporan\proses')->setOptions(['defaultFont' => 'sans-serif']);
    // 	return $pdf->stream();
        
    //   }

    public function cetakbulan($bulan) {
        switch ($bulan) {
            case '1':
                return "Januari";
                break;
            case '2':
                return "Februari";
                break;
            case '3':
                return "Maret";
                break;
            case '4':
                return "April";
                break;
            case '5':
                return "Mei";
                break;
            case '6':
                return "Juni";
                break;
            case '7':
                return "Juli";
                break;
            case '8':
                return "Agustus";
                break;
            case '9':
                return "September";
                break;
            case '10':
                return "Oktober";
                break;
            case '11':
                return "Nopember";
                break;
            case '12':
                return "Desember";
                break;

            default:
                return "";
                break;
        }
    }
}
