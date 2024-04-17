<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('notification.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'type' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $notification = new notification();
        $notification->title = $request->title;
        $notification->content = $request->content;
        $notification->type = $request->type;
        $notification->start_date = $request->start_date;
        $notification->end_date = $request->end_date;

        $notification->save();

        return \Redirect::route('notification.all')->with('success', __('notification Created Successfully'));
    }

    public function edit($id)
    {
        $notification = Notification::find($id);

        return view('notification.edit', ['notification' => $notification]);
    }

    public function all()
    {
        // $notifications = Notification::OrderBy('id', 'desc')->paginate(get_option('pagination'));
        $notifications = Notification::OrderBy('id', 'desc')->paginate(25);

        return view('notification.all', ['notifications' => $notifications]);
    }

    public function store_edit(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'type' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $notification = Notification::find($request->notification_id);

        $notification->title = $request->title;
        $notification->content = $request->content;
        $notification->type = $request->type;
        $notification->start_date = $request->start_date;
        $notification->end_date = $request->end_date;

        $notification->save();

        return \Redirect::route('notification.all')->with('success', __('notification Edited Successfully'));
    }

    public function destroy($id)
    {
        Notification::destroy($id);

        return \Redirect::route('notification.all')->with('success', __('notification Deleted Successfully'));
    }
}
