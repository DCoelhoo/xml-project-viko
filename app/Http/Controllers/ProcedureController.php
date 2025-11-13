<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProcedureController extends Controller
{
    private function loadXml()
    {
        $xmlPath = storage_path('app/xml/procedures.xml');
        return simplexml_load_file($xmlPath);
    }

    private function saveXml($xml)
    {
        $xmlPath = storage_path('app/xml/procedures.xml');
        $xml->asXML($xmlPath);
    }

    public function index(Request $request)
    {
        $xml = $this->loadXml();

        $procedures = collect($xml->procedure)->map(fn($p) => [
            'code' => (string)$p->code,
            'title' => (string)$p->title,
            'category' => (string)$p->category,
            'duration' => (string)$p->duration,
        ]);

        if ($request->filled('search')) {
            $search = strtolower($request->search);

            $procedures = $procedures->filter(function ($p) use ($search) {
                return str_contains(strtolower($p['title']), $search)
                    || str_contains(strtolower($p['code']), $search)
                    || str_contains(strtolower($p['category']), $search);
            });
        }

        return view('procedures', compact('procedures'));
    }

    // ADMIN INDEX
    public function adminIndex()
    {
        $xml = $this->loadXml();

        $procedures = collect($xml->procedure)->map(fn($p) => [
            'code' => (string)$p->code,
            'title' => (string)$p->title,
            'category' => (string)$p->category,
            'duration' => (string)$p->duration,
        ]);

        return view('admin.index', compact('procedures'));
    }

    // EDIT
    public function edit($code)
    {
        $xml = $this->loadXml();

        foreach ($xml->procedure as $p) {
            if ((string) $p->code === $code) {
                return view('admin.edit', ['procedure' => $p]);
            }
        }

        abort(404);
    }

    // UPDATE
    public function update(Request $request, $code)
    {
        $xml = $this->loadXml();

        foreach ($xml->procedure as $p) {
            if ((string) $p->code === $code) {
                $p->title = $request->title;
                $p->category = $request->category;
                $p->duration = $request->duration;
            }
        }

        $this->saveXml($xml);

        return redirect('/admin')->with('success', 'Procedure updated successfully.');
    }

    // CREATE
    public function create()
    {
        return view('admin.create');
    }

    // STORE
    public function store(Request $request)
    {
        $xml = $this->loadXml();

        $new = $xml->addChild('procedure');
        $new->addChild('code', $request->code);
        $new->addChild('title', $request->title);
        $new->addChild('category', $request->category);
        $new->addChild('duration', $request->duration);

        $this->saveXml($xml);

        return redirect('/admin')->with('success', 'Procedure created successfully.');
    }

    // DELETE
    public function delete($code)
    {
        $xml = $this->loadXml();

        $index = 0;
        foreach ($xml->procedure as $p) {
            if ((string) $p->code === $code) {
                unset($xml->procedure[$index]);
                break;
            }
            $index++;
        }

        $this->saveXml($xml);

        return redirect('/admin')->with('success', 'Procedure deleted successfully.');
    }
}