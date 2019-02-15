<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Site $site)
    {
        //
    }

    public function edit(Site $site)
    {
        //
    }

    public function update(Request $request, Site $site)
    {
        //
    }

    public function destroy(Site $site)
    {
        //
    }
}
