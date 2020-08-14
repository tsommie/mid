<?php

namespace App\Http\Controllers;

use App\Client;
use App\Contracts\Repositories\ClientRepositoryInterface as ClientRepository;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * @var ClientRepository
     */
    protected $repository;

    /**
     * ClientController constructor.
     *
     * @param ClientRepository $repository
     */
    public function __construct(ClientRepository $repository)
    {
        $this->middleware(['auth']);
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name'                        => ['required', 'string', 'max:255'],
            'last_name'                         => ['required', 'string', 'max:255'],
            'other_names'                       => ['nullable', 'string', 'max:255'],
            'primary_phone_number'              => ['required', 'string', 'max:255'],
//            'email'                             => ['required', 'string', 'email', 'max:255', 'unique:clients'],
            'dob'                               => ['required', 'date'],
            'identification_card.type'          => ['required', 'string', 'max:60'],
            'identification_card.number'        => ['required', 'string', 'max:60'],

            'right_hand.thumb'                  => ['required', 'string'],
            'right_hand.index_finger'           => ['required', 'string'],
            'right_hand.middle_finger'          => ['required', 'string'],
            'right_hand.ring_finger'            => ['required', 'string'],
            'right_hand.pinky'                  => ['required', 'string'],

            'left_hand.thumb'                  => ['required', 'string'],
            'left_hand.index_finger'           => ['required', 'string'],
            'left_hand.middle_finger'          => ['required', 'string'],
            'left_hand.ring_finger'            => ['required', 'string'],
            'left_hand.pinky'                  => ['required', 'string'],

            'location.street'           => ['required', 'string', 'max:255'],
            'location.street_line_2'    => ['nullable', 'string', 'max:255'],
            'location.city'             => ['required', 'string', 'max:255'],
            'location.country'          => ['required', 'string', 'max:255'],
            'location.postal'           => ['required', 'string', 'max:255'],
        ]);

        return $data;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
