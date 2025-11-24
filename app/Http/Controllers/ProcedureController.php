<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProcedureController extends Controller
{
    private function loadXml()
    {
        $xmlPath = storage_path('app/xml/procedures.xml');

        if (! file_exists($xmlPath)) {
            abort(500, 'XML file not found: ' . $xmlPath);
        }

        return simplexml_load_file($xmlPath);
    }

    private function saveXml($xml): void
    {
        $xmlPath = storage_path('app/xml/procedures.xml');
        $xml->asXML($xmlPath);
    }

    /**
     * Converts a <procedure> XML node to a PHP array
     */
    private function mapProcedure(\SimpleXMLElement $p): array
    {
        return [
            'code'        => (string) $p->code,
            'title'       => (string) $p->title,
            'category'    => (string) $p->category,
            'duration'    => (string) $p->duration,
            'description' => (string) $p->description,
            'requirements'=> (string) $p->requirements,
            'level'       => (string) $p->level,
            'equipment'   => (string) $p->equipment,
            'updated_at'  => (string) $p->updated_at,
        ];
    }

    // ============================
    // PUBLIC LIST WITH FILTERS
    // ============================
    public function index(Request $request)
    {
        $xml = $this->loadXml();

        $all = collect($xml->procedure)->map(fn($p) => $this->mapProcedure($p));
        $procedures = $all;

        // SEARCH
        if ($request->filled('search')) {
            $s = strtolower($request->search);
            $procedures = $procedures->filter(function ($p) use ($s) {
                return str_contains(strtolower($p['title']), $s)
                    || str_contains(strtolower($p['code']), $s)
                    || str_contains(strtolower($p['category']), $s)
                    || str_contains(strtolower($p['description']), $s);
            });
        }

        // FILTERS
        if ($request->filled('category')) {
            $procedures = $procedures->where('category', $request->category);
        }

        if ($request->filled('min_duration')) {
            $procedures = $procedures->filter(fn($p) =>
                (int)$p['duration'] >= (int)$request->min_duration
            );
        }

        if ($request->filled('max_duration')) {
            $procedures = $procedures->filter(fn($p) =>
                (int)$p['duration'] <= (int)$request->max_duration
            );
        }

        // unique categories for dropdown
        $categories = $all->pluck('category')->unique()->sort()->values();

        return view('procedures', compact('procedures', 'categories'));
    }

    // ============================
    // SHOW PAGE
    // ============================
    public function show(string $code)
    {
        $xml = $this->loadXml();

        foreach ($xml->procedure as $p) {
            if ((string)$p->code === $code) {
                $procedure = $this->mapProcedure($p);
                return view('procedure-show', compact('procedure'));
            }
        }

        abort(404);
    }

    // ============================
    // ADMIN PANEL
    // ============================
    public function adminIndex()
    {
        $xml = $this->loadXml();
        $procedures = collect($xml->procedure)->map(fn($p) => $this->mapProcedure($p));

        return view('admin.index', compact('procedures'));
    }

    public function edit(string $code)
    {
        $xml = $this->loadXml();

        foreach ($xml->procedure as $p) {
            if ((string)$p->code === $code) {
                return view('admin.edit', ['procedure' => $p]);
            }
        }

        abort(404);
    }

    public function update(Request $request, string $code)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'category'    => 'nullable|string|max:255',
            'duration'    => 'required|string|max:50',
            'description' => 'nullable|string',
            'requirements'=> 'nullable|string',
            'level'       => 'nullable|string|max:100',
            'equipment'   => 'nullable|string',
        ]);

        $xml = $this->loadXml();

        foreach ($xml->procedure as $p) {
            if ((string)$p->code === $code) {

                // UPDATE ALL FIELDS WITHOUT LOSING DATA
                $p->title       = $data['title'];
                $p->category    = $data['category'];
                $p->duration    = $data['duration'];
                $p->description = $data['description'];
                $p->requirements= $data['requirements'];
                $p->level       = $data['level'];
                $p->equipment   = $data['equipment'];
                $p->updated_at  = date('Y-m-d');
            }
        }

        $this->saveXml($xml);

        return redirect()->route('admin.index')->with('success', 'Procedure updated successfully.');
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code'        => 'required|string|max:50',
            'title'       => 'required|string|max:255',
            'category'    => 'nullable|string|max:255',
            'duration'    => 'required|string|max:50',
            'description' => 'nullable|string',
            'requirements'=> 'nullable|string',
            'level'       => 'nullable|string|max:100',
            'equipment'   => 'nullable|string',
        ]);

        $xml = $this->loadXml();

        $new = $xml->addChild('procedure');
        $new->addChild('code', $data['code']);
        $new->addChild('title', $data['title']);
        $new->addChild('category', $data['category']);
        $new->addChild('duration', $data['duration']);
        $new->addChild('description', $data['description']);
        $new->addChild('requirements', $data['requirements']);
        $new->addChild('level', $data['level']);
        $new->addChild('equipment', $data['equipment']);
        $new->addChild('updated_at', date('Y-m-d'));

        $this->saveXml($xml);

        return redirect()->route('admin.index')->with('success', 'Procedure created successfully.');
    }

    public function delete(string $code)
    {
        $xml = $this->loadXml();

        $index = 0;
        foreach ($xml->procedure as $p) {
            if ((string)$p->code === $code) {
                unset($xml->procedure[$index]);
                break;
            }
            $index++;
        }

        $this->saveXml($xml);

        return redirect()->route('admin.index')->with('success', 'Procedure deleted successfully.');
    }
}