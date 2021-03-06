<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Rules\ValidFeed;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feeds = Feed::all();

        return view('feeds.index')->with('feeds', $feeds);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('feeds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'link' => ['required', new ValidFeed]
        ]);

        $feed = Feed::create([
            'name' => $validated['name'],
            'link' => $validated['link'],
        ]);

        return redirect()->route('feeds.show', [$feed]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function show(Feed $feed)
    {
        $count = $feed->entries()->count();

        return view('feeds.show')
            ->with('count', $count)
            ->with('feed', $feed);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function edit(Feed $feed)
    {
        return view('feeds.edit')->with('feed', $feed);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feed $feed)
    {
        $validated = $request->validate([
            'name' => 'required',
            'link' => ['required', new ValidFeed]
        ]);

        $feed->name = $validated['name'];
        $feed->link = $validated['link'];

        $feed->save();

        return redirect()->route('feeds.show', [$feed]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feed $feed)
    {
        //
    }
}
