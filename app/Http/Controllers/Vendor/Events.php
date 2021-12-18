<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class Events extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('status', 1)->where(function ($query) {
            $query->where('type', 'service')->orWhere('type', 'both');
        })->get();
        $events = Event::with(['category'])->where('user_id', '=', auth()->user()->id)->orderByDesc('created_at')->get();
        return view('vendor.events.manage', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)->where(function ($query) {
            $query->where('type', 'service')->orWhere('type', 'both');
        })->get();
        return view('vendor.events.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'category' => 'required|numeric',
            'start_date' => 'required',
            'end_date' => 'required',
            'organizer_name' => 'required|string|max:255',
            'organizer_phone' => 'required|numeric',
            'organizer_email' => 'required|email',
            'organizer_website' => 'required|url',
        ]);
        $slug = $this->createSlug($request->title);

        $event = new Event();
        $event->title = $request->title;
        $event->slug = $slug;
        $event->description = $request->description;
        $event->location = $request->location;
        $event->price = $request->price;
        $event->sale_price = $request->sale_price;
        $event->category_id = $request->category;
        $event->start_date = $request->start_date;
        $event->video = $request->video;
        $event->end_date = $request->end_date;
        $event->o_name = $request->organizer_name;
        $event->o_phone = $request->organizer_phone;
        $event->o_email = $request->organizer_email;
        $event->o_website = $request->organizer_website;
        $event->booking_status = $request->booking_status;
        $event->user_id = auth()->user()->id;
        $event->status = 0;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/events'), $imageName);
            $event->image = $imageName;
        }
        $event->save();
        return redirect()->route('vendor.events')->with('success', 'Event Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        $categories = Category::where('status', 1)->where(function ($query) {
            $query->where('type', 'service')->orWhere('type', 'both');
        })->get();
        return view('vendor.events.edit', compact('categories', 'event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category' => 'required|numeric',
            'start_date' => 'required',
            'end_date' => 'required',
            'organizer_name' => 'required|string|max:255',
            'organizer_phone' => 'required|numeric',
            'organizer_email' => 'required|email',
            'organizer_website' => 'required|url',
        ]);

        $event = Event::find($id);
        $event->title = $request->title;
        $event->description = $request->description;
        $event->location = $request->location;
        $event->price = $request->price;
        $event->sale_price = $request->sale_price;
        $event->category_id = $request->category;
        $event->video = $request->video;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->o_name = $request->organizer_name;
        $event->o_phone = $request->organizer_phone;
        $event->o_email = $request->organizer_email;
        $event->o_website = $request->organizer_website;
        $event->booking_status = $request->booking_status;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/events'), $imageName);
            $event->image = $imageName;
        }
        $event->save();
        return redirect()->route('vendor.events')->with('success', 'Event Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete event
        $event = Event::find($id);
        $event->delete();
        return redirect()->route('vendor.events')->with('success', 'Event Deleted Successfully');
    }

    public function createSlug($title, $id = 0)
    {
        $slug = str_slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        if (!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }

        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Event::select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }
}
