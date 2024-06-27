<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function userdetails()
    {
        $path = storage_path('users.json');

        // Check if the file exists
        if (!File::exists($path)) {
            abort(404, 'File not found');
        }

        // Get the file content
        $file = File::get($path);
        // dd($file);

        // Decode the JSON data
        $data = json_decode($file, true);

        // Return JSON response
        return view('displayjson', ['data' => $data]);
    }

    public function fetchUsers()
    {
        // // URL of the JSON data
        // $url = 'https://gurkhaseatery.dvl.to:83/api/user';

        // // Fetch JSON data from the URL
        // $response = Http::get($url);

        // // Check if the request was successful
        // if ($response->successful()) {
        //     // Decode the JSON data
        //     $fetchdata = $response->json();

        //     // Pass the data to the view
        //     return view('fetchjson', ['fetchdata' => $fetchdata]);
        // } else {
        //     // Handle error
        //     abort(500, 'Failed to fetch data from the URL');
        // }

        // URL of the JSON data
        $url = 'http://gurkhaseatery.dvl.to:83/api/user';
        // dd($url);

        try {
            // Attempt to fetch JSON data from the URL with a retry mechanism
            $response = Http::retry(3, 100)->get($url);
            dd($response);

            // Check if the request was successful
            if ($response->successful()) {
                // Decode the JSON data
                $data = $response->json();

                // Check if the response data is empty
                if (empty($data)) {
                    abort(500, 'Received an empty response from the server');
                }

                // Pass the data to the view
                return view('displayjson', ['users' => $data]);
            } else {
                // Log the response error
                Log::error('Failed to fetch data from the URL', ['url' => $url, 'status' => $response->status()]);
                abort(500, 'Failed to fetch data from the URL');
            }
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Error fetching data from the URL', ['url' => $url, 'error' => $e->getMessage()]);
            abort(500, 'Error fetching data from the URL: ' . $e->getMessage());
        }
    }
}
