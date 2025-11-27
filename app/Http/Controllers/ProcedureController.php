<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ProcedureController extends Controller
{
    private function loadXml()
    {
        $xmlPath = storage_path('app/xml/procedures.xml');

        $raw = file_get_contents($xmlPath);

        // Remove text nodes, whitespaces, indentation inside XML
        $clean = preg_replace('/>\s+</', '><', $raw);

        return simplexml_load_string($clean);
    }

    private function saveXml($xml): void
    {
        $xmlPath = storage_path('app/xml/procedures.xml');

        $clean = preg_replace('/>\s+</', '><', $xml->asXML());

        file_put_contents($xmlPath, $clean);
    }

    private function mapProcedure(\SimpleXMLElement $p): array
    {
        return [
            'code'        => trim((string)$p->code),
            'title'       => trim((string)$p->title),
            'category'    => trim((string)$p->category),
            'duration'    => (int) filter_var((string)$p->duration, FILTER_SANITIZE_NUMBER_INT),
            'description' => trim((string)$p->description),
            'requirements' => trim((string)$p->requirements),
            'level'       => trim((string)$p->level),
            'equipment'   => trim((string)$p->equipment),
            'updated_at'  => trim((string)$p->updated_at),
        ];
    }

    // ===========================================
    // ADMIN PANEL
    // ===========================================
    public function adminIndex(Request $request)
    {
        // Loads XML
        $xml = $this->loadXml();

        // All procedures mapped
        $all = collect($xml->xpath('//procedure'))
            ->map(fn($p) => $this->mapProcedure($p));

        // ==========================================
        // APPLY SEARCH + FILTERS
        // ==========================================


        $filtered = $all;

        // SEARCH
        if ($request->filled('search')) {
            $search = strtolower($request->search);

            $filtered = $filtered->filter(function ($p) use ($search) {
                return str_contains(strtolower($p['title']), $search)
                    || str_contains(strtolower($p['code']), $search)
                    || str_contains(strtolower($p['category']), $search);
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $filtered = $filtered->where('category', $request->category);
        }

        // Filter by min duration
        if ($request->filled('min_duration')) {
            $filtered = $filtered->where('duration', '>=', (int) $request->min_duration);
        }

        // Filter by max duration
        if ($request->filled('max_duration')) {
            $filtered = $filtered->where('duration', '<=', (int) $request->max_duration);
        }


        // ==========================================
        // PAGINATION (using filtered list)
        // ==========================================

        $page = request()->get('page', 1);
        $perPage = 10;

        $procedures = new \Illuminate\Pagination\LengthAwarePaginator(
            $filtered->slice(($page - 1) * $perPage, $perPage)->values(),
            $filtered->count(),
            $perPage,
            $page,
            ['path' => route('admin.index')]
        );


        // ==========================================
        // STATS (FULL DATASET, NOT FILTERED)
        // ==========================================

        $stats = [
            'count'        => $filtered->count(),
            'avgDuration'  => $filtered->avg('duration'),
            'min'          => $filtered->min('duration'),
            'max'          => $filtered->max('duration'),
            'byCategory'   => $filtered->groupBy('category')->map->count(),
            'titles'       => $filtered->pluck('title'),
            'durations'    => $filtered->pluck('duration'),
            'updatedDates' => $filtered->pluck('updated_at'),
        ];

        // For dropdown
        $categories = $all->pluck('category')->unique()->sort()->values();


        return view('admin.index', [
            'procedures' => $procedures,
            'stats'      => $stats,
            'categories' => $categories,
            'all'        => $all,
        ]);
    }

    // EDIT FORM
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

    // UPDATE (SAVE EDITED)
    public function update(Request $request, string $code)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'category'    => 'nullable|string|max:255',
            'duration'    => 'required|string|max:50',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'level'       => 'nullable|string|max:100',
            'equipment'   => 'nullable|string',
        ]);

        $xml = $this->loadXml();

        foreach ($xml->procedure as $p) {
            if ((string)$p->code === $code) {
                foreach ($data as $key => $value) {
                    $p->{$key} = $value;
                }
                $p->updated_at = date('Y-m-d');
            }
        }

        $this->saveXml($xml);

        return redirect()->route('admin.index')->with('success', 'Procedure updated successfully.');
    }

    // CREATE FORM
    public function create()
    {
        return view('admin.create');
    }

    // STORE NEW PROCEDURE
    public function store(Request $request)
    {
        $data = $request->validate([
            'code'        => 'required|string|max:50',
            'title'       => 'required|string|max:255',
            'category'    => 'nullable|string|max:255',
            'duration'    => 'required|string|max:50',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'level'       => 'nullable|string|max:100',
            'equipment'   => 'nullable|string',
        ]);

        $xml = $this->loadXml();

        $new = $xml->addChild('procedure');
        foreach ($data as $k => $v) {
            $new->addChild($k, $v);
        }
        $new->addChild('updated_at', date('Y-m-d'));

        $this->saveXml($xml);

        return redirect()->route('admin.index')->with('success', 'Procedure created successfully.');
    }

    // DELETE PROCEDURE
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

    // UPLOAD EXTERNAL XML
    public function uploadXml(Request $request)
    {
        $request->validate([
            'xml_file' => ['required', 'file', 'mimes:xml']
        ]);

        $uploadedXml = simplexml_load_file(
            $request->file('xml_file')->getRealPath()
        );

        if (!isset($uploadedXml->procedure)) {
            return redirect()->back()->withErrors(['Invalid XML format.']);
        }

        $mainXml = $this->loadXml();

        foreach ($uploadedXml->procedure as $p) {
            $exists = collect($mainXml->procedure)
                ->contains(fn($x) => (string)$x->code === (string)$p->code);

            if ($exists) continue;

            $new = $mainXml->addChild('procedure');
            foreach ($p->children() as $key => $value) {
                $new->addChild($key, (string)$value);
            }
        }

        $this->saveXml($mainXml);

        return redirect()->back()->with('success', 'XML imported successfully!');
    }
}
