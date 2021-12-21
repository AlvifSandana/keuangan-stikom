<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\ItemPaket;
use App\Models\Paket;

class PaketController extends BaseController
{
    public function index()
    {
        // create model instance
        $m_paket = new Paket();
        // get data paket
        $data['data_paket'] = $m_paket->findAll();
        // create request instance
        $request = \Config\Services::request();
        // get uri segment for dynamic sidebar active item
        $data['uri_segment'] = $request->uri->getSegment(2);
        // show view
        return view('pages/master/keuangan/index', $data);
    }

    /**
     * get item paket by paket_id
     */
    public function get_item_paket(String $paket_id)
    {
        try {
            // create model instance
            $m_itempaket = new ItemPaket();
            // get item paket by paket_id
            $item_paket = $m_itempaket->where('paket_id', $paket_id)->findAll();
            if (sizeOf($item_paket) > 0) {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Data item paket ditemukan.',
                    'data' => $item_paket,
                ]);
            } else {
                return json_encode([
                    'status' => 'failed',
                    'message' => 'Data item paket tidak ditemukan.',
                    'data' => [],
                ]);
            }
        } catch (\Throwable $th) {
            return json_encode([
                'status' => 'error',
                'message' => $th->getMessage(),
                'data' => $th->getTrace(),
            ]);
        }
    }
}
