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
    return response()->json(['id'=>'awit']);
});

Route::post('/webhook/done', function(Request $request){
    if($request->action['data']['listAfter']['name']=='Done') {
        $doneList = "5cc2d3a575581b10e34bb9a4";
        $doingList = "5cc2d3a575581b10e34bb9a3";
        $boardId = "5cc2d3a575581b10e34bb9a1";
        $key = "8fcba441e3a5ad8120bb895853d73ff1";
        $token = "140d7ab96e3ae835e1192ca7c7afc61a5393a971eda51367a0af42889858e317";
        $url = "https://api.trello.com/1/lists/%s/moveAllCards?idBoard=%s&idList=%s&key=%s&token=%s";


        $client = new \GuzzleHttp\Client();
        $endpoint = sprintf($url, $doneList, $boardId, $doingList, $key, $token);
        $response = $client->request('POST', $endpoint, []);
        $statusCode = $response->getStatusCode();
        $content = $response->getBody();

        dd($statusCode);
    }
});

// Route::get('/testinglang', function(){
//     $doneList = "5cc2d3a575581b10e34bb9a4";
//     $doingList = "5cc2d3a575581b10e34bb9a3";
//     $boardId = "5cc2d3a575581b10e34bb9a1";
//     $key = "8fcba441e3a5ad8120bb895853d73ff1";
//     $token = "140d7ab96e3ae835e1192ca7c7afc61a5393a971eda51367a0af42889858e317";
//     $url = "https://api.trello.com/1/lists/%s/moveAllCards?idBoard=%s&idList=%s&key=%s&token=%s";
//     $url = sprintf($url, $doneList, $boardId, $doingList, $key, $token);

//     // $client = new \GuzzleHttp\Client();
//     // $endpoint = sprintf($url, $doneList, $boardId, $doingList, $key, $token);
//     // $response = $client->request('POST', $endpoint, [ ]);
//     // $statusCode = $response->getStatusCode();
//     // $content = $response->getBody();

//     // dd($statusCode);


//     $curlString = "curl --request POST \ --url 'https://api.trello.com/1/lists/5cc2d3a575581b10e34bb9a4/moveAllCards?idBoard=5cc2d3a575581b10e34bb9a1&idList=5cc2d3a575581b10e34bb9a3&key=8fcba441e3a5ad8120bb895853d73ff1&token=140d7ab96e3ae835e1192ca7c7afc61a5393a971eda51367a0af42889858e317'";

//     // dd($curlString);
//     exec($curlString,$result);
//     dd($result);
// });

function arrayToObject($conArray)
{
    if(is_array($conArray)){
        /*
        * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        return (object) array_map(__FUNCTION__, $conArray);
    }else{
        // Return object
        return $conArray;
    }
}
