<?php

namespace App\Http\Controllers\API;

use App\Test;
use App\Http\Controllers\Controller;
use App\Http\Resources\TestResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Tests = Test::all();
        return response([ 'Tests' => TestResource::collection($Tests), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'year' => 'required|max:255',
            'company_headquarters' => 'required|max:255',
            'what_company_does' => 'required'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $Test = Test::create($data);

        return response([ 'Test' => new TestResource($Test), 'message' => 'Created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Test  $Test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $Test)
    {
        return response([ 'Test' => new TestResource($Test), 'message' => 'Retrieved successfully'], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Test  $Test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $Test)
    {

        $Test->update($request->all());

        return response([ 'Test' => new TestResource($Test), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Test $Test
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Test $Test)
    {
        $Test->delete();

        return response(['message' => 'Deleted']);
    }
}