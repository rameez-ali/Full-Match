<?php

namespace App\Http\Controllers;

use App\Http\Requests\Page\GetAllPagesRequest;
use App\Http\Requests\Page\GetPageRequest;
use App\Http\Requests\Page\UpdatePageRequest;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetAllPagesRequest $request)
    {
        $response = $request->handle();

        return view('admin.cmspages.index',['pages' => $response]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request = new GetPageRequest();

        $request->id = $id;

        $response = $request->handle();

        return view('cmspage',['cmspage' => $response,]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $request = new GetPageRequest();

        $request->id = $id;

        $response = $request->handle();

        $route = route('page.update', ['page' => $response->id]);

        return view('admin.cmspages.form',['pages' => $response, 'route' => $route , 'edit' => true ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePageRequest $request, $id)
    {
            $request->id = $id;

            $response = $request->handle();

        return redirect()->route('page.index')->with('pageditsuccess','Page Edit Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
