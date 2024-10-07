<?php

namespace App\Http\Controllers;

use App\Traits\TokenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StaffController extends Controller
{
    use TokenService;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $token = $this->getToken(); // Get the token from cache or request it

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->withToken($token)
            ->get('host.docker.internal:8020/api/staff');

        $data = $response->json();
//        dd($data);

        if ($response->successful()) {
            return view('staff.index', [
                'staff_list' => $response->json()
            ]);
        } else {
            return view('staff.index', [
                'staff_list' => []
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('staff.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
//        $response = Http::withHeaders([
//            'Content-Type' => 'application/json',
//            'Accept' => 'application/json',
//        ])->withToken('13|b19vSxWhh2AmjEJqMOgn975OpVeNeC2drJDDgnDOc44a5e1a')
//            ->patch('http://127.0.0.1:8010/api/staff/'.$id);
//
//        $data = $response->json();
////        dd($data['data']);
//
//        return view('staff.index')->with('staff', $response->json());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $token = $this->getToken(); // Get the token from cache or request it

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->withToken($token)
            ->get('host.docker.internal:8020/api/staff/' . $id);

        $data = $response->json();
//        dd($data['data']);

        return view('staff.edit')->with('staff', $data['data']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $token = $this->getToken(); // Get the token from cache or request it

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->withToken($token)
            ->patch('host.docker.internal:8020' . '/api/staff/' . $id,
                [
                    'surname' => $request->input('surname'),
                    'other_name' => $request->input('other_name'),
                    'date_of_birth' => $request->input('date_of_birth'),
                    'id_photo' => $request->hasFile('id_photo') ? base64_encode($request->file('id_photo')
                        ->store('staff_images', 'public')) : null
                ]);

        if ($response->successful()) {
            return redirect('dashboard');
        } else {
            dd($response->json());
            return view('staff.edit')->withErrors($response->json());
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $token = $this->getToken(); // Get the token from cache or request it

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->withToken($token)
            ->post('host.docker.internal:8020/api/staff/', [
                'surname' => $request->input('surname'),
                'other_name' => $request->input('other_name'),
                'date_of_birth' => $request->input('date_of_birth'),
                'id_photo' => $request->hasFile('id_photo') ? base64_encode($request->file('id_photo')
                    ->store('staff_images', 'public')) : null,
            ]);

        if ($response->successful()) {
            return redirect('home');
        } else {
            dd($response->json());
            return view('staff.create')->withErrors($response->json());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        dd($id);
        $token = $this->getToken(); // Get the token from cache or request it


        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->withToken($token)->delete('host.docker.internal:8020/api/staff/' . $id);


        if ($response->successful()) {
            return redirect('home');
        } else {
            return view('staff.index')->withErrors($response->json());
        }
    }
}
