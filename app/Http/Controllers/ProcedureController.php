<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProcedureController extends Controller
{
    public function index(Request $request)
    {
        $xmlPath = public_path('xml/procedures.xml');
        $xml = simplexml_load_file($xmlPath);

        $procedures = collect($xml->procedure)->map(fn($p) => [
            'code' => (string)$p->code,
            'title' => (string)$p->title,
            'category' => (string)$p->category,
            'duration' => (string)$p->duration,
        ]);

        if ($request->filled('search')) {
            $search = strtolower($request->search);

            $procedures = $procedures->filter(
                fn($p) =>
                str_contains(strtolower($p['title']), $search) ||
                    str_contains(strtolower($p['code']), $search) ||
                    str_contains(strtolower($p['category']), $search)
            );
        }

        return view('procedures', compact('procedures'));
    }

    // ================================
    // ADMIN: LIST
    // ================================
    public function adminIndex()
    {
        $xmlPath = public_path('xml/procedures.xml');
        $xml = simplexml_load_file($xmlPath);

        $procedures = collect($xml->procedure)->map(fn($p) => [
            'code' => (string)$p->code,
            'title' => (string)$p->title,
            'category' => (string)$p->category,
            'duration' => (string)$p->duration,
        ]);

        return view('admin.index', compact('procedures'));
    }

    // ================================
    // ADMIN: EDIT FORM
    // ================================
    public function edit($code)
    {
        $xmlPath = public_path('xml/procedures.xml');
        $xml = simplexml_load_file($xmlPath);

        foreach ($xml->procedure as $p) {
            if ((string)$p->code === $code) {
                return view('admin.edit', ['procedure' => $p]);
            }
        }

        abort(404);
    }

    // ================================
    // ADMIN: UPDATE
    // ================================
    public function update(Request $request, $code)
    {
        $xmlPath = public_path('xml/procedures.xml');
        $xml = simplexml_load_file($xmlPath);

        foreach ($xml->procedure as $p) {
            if ((string)$p->code === $code) {
                $p->title = $request->title;
                $p->category = $request->category;
                $p->duration = $request->duration;
            }
        }

        $xml->asXML($xmlPath);

        return redirect('/admin')->with('success', 'Procedure updated successfully.');
    }

    // ================================
    // ADMIN: CREATE FORM
    // ================================
    public function create()
    {
        return view('admin.create');
    }

    // ================================
    // ADMIN: STORE NEW PROCEDURE
    // ================================
    public function store(Request $request)
    {
        $xmlPath = public_path('xml/procedures.xml');
        $xml = simplexml_load_file($xmlPath);

        $new = $xml->addChild('procedure');
        $new->addChild('code', $request->code);
        $new->addChild('title', $request->title);
        $new->addChild('category', $request->category);
        $new->addChild('duration', $request->duration);

        $xml->asXML($xmlPath);

        return redirect('/admin')->with('success', 'Procedure created successfully.');
    }

    // ================================
    // ADMIN: DELETE
    // ================================
    public function delete($code)
    {
        $xmlPath = public_path('xml/procedures.xml');
        $xml = simplexml_load_file($xmlPath);

        $index = 0;
        foreach ($xml->procedure as $p) {
            if ((string)$p->code === $code) {
                unset($xml->procedure[$index]);
                break;
            }
            $index++;
        }

        $xml->asXML($xmlPath);

        return redirect('/admin')->with('success', 'Procedure deleted successfully.');
    }
}
