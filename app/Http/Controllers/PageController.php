<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Backup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PageController extends Controller
{
    function create(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:50|unique:pages',
            "body" => 'required'
        ]);

        if ($_SERVER["REMOTE_ADDR"]) {
            $ip = $_SERVER["REMOTE_ADDR"];
        } else {
            $ip = "Unknown";
        }

        $title = $request->title;
        $body = $request->body;

        $pagedata = Page::create([
            'user_ip' => $ip,
            'title' => $title,
            'body' => $body,
        ]);



        Backup::create([
            'page_id' => $pagedata->id,
            'user_ip' => $ip,
            'title' => $title,
            'body' => $body,
        ]);

        return response()->json($pagedata->title);
    }

    function view()
    {
        $id = request("id");
        $page = Page::select("id", "title", "body")->where('title', $id)->orderBy('created_at', 'ASC')->first();
        return response()->json($page);
    }

    function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:50',
            "body" => 'required'
        ]);

        $id = $request->id;
        $title = $request->title;
        $body = $request->body;


        if ($_SERVER["REMOTE_ADDR"]) {
            $ip = $_SERVER["REMOTE_ADDR"];
        } else {
            $ip = "Unknown";
        }

        $page = Page::where("id", "=", $id)->first();


        $page->user_ip = $ip;
        $page->title = $title;
        $page->body = $body;
        $page->save();


        Backup::create([
            'page_id' => $page->id,
            'user_ip' => $ip,
            'title' => $title,
            'body' => $body,
        ]);

        return response()->json($page->title);
    }

    function count()
    {
        $data = Page::count();

        return response()->json($data);
    }

    function new()
    {
        $data = Page::select("title")->orderBy('created_at', 'desc')->take(10)->get();
        return response()->json($data);
    }

    function up()
    {
        $data = Page::select("title")->orderBy('updated_at', 'desc')->take(10)->get();
        return response()->json($data);
    }
}
