<?php
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/webhook/done', function(Request $request){
    return response()->json(['message'=>'Hello World!']);
});

Route::post('/webhook/done', function(Request $request){
    if($request->action['data']['listAfter']['name']=='Done') {
        $doneList = env('TRELLO_LIST_SOURCE');
        $doingList = env('TRELLO_LIST_DESTINATION');
        $boardId = env('TRELLO_BOARD_ID');
        $key = env('TRELLO_API_KEY');
        $token = env('TRELLO_TOKEN');
        $url = "https://api.trello.com/1/lists/%s/moveAllCards?idBoard=%s&idList=%s&key=%s&token=%s";


        $client = new \GuzzleHttp\Client();
        $endpoint = sprintf($url, $doneList, $boardId, $doingList, $key, $token);
        $response = $client->request('POST', $endpoint, []);
        $statusCode = $response->getStatusCode();
        $content = $response->getBody();

        dd($statusCode);
    }
});


