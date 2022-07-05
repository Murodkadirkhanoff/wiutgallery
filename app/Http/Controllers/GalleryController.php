<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('gallery_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gallery_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'photo' => 'required',
            ]
        );

        $status = $request->status == "on" ? 1 : 0;
        if ($request->hasFile('photo')) {
            $path = $this->upload($request->file('photo'), 'galleries');

        }

        Gallery::create([
            'title' => $request->title,
            'status' => $status,
            'photo' => $path
        ]);
        return redirect()->to('galleries');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Gallery $gallery
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Gallery $gallery)
    {
        return view('gallery_edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Gallery $gallery
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Gallery $gallery)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'photo' => 'sometimes',
            ]
        );

        $path = $gallery->photo;
        $status = $request->status == "on" ? 1 : 0;
        if ($request->hasFile('photo')) {
            $path = $this->upload($request->file('photo'), 'galleries');
        }

        $gallery->update([
            'title' => $request->title,
            'status' => $status,
            'photo' => $path
        ]);

        return redirect()->to('galleries');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Gallery $gallery
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Gallery $gallery)
    {
        File::delete($gallery->photo);
        $gallery->delete();
        return redirect()->to('galleries');
    }
}
