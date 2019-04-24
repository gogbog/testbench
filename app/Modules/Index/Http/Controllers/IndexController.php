<?php

namespace App\Modules\Index\Http\Controllers;

use App\Http\Controllers\Controller;
use CoinGecko\Helpers\CoinGecko;

class IndexController extends Controller {
    public function index() {
        $api = new CoinGecko();
        dd($api->coin('bitcoin'));
    }
}
