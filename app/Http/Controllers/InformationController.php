<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;
use Illuminate\Support\Facades\Auth;

class InformationController extends Controller
{
    // User: View all published information
    public function userIndex()
    {
        $information = Information::where('is_published', true)
            ->latest()
            ->paginate(10);

        return view('user.information-index', compact('information'));
    }

    // User: View single information detail
    public function userShow($id)
    {
        $info = Information::where('is_published', true)->findOrFail($id);
        $info->incrementViews();

        $relatedInfo = Information::where('is_published', true)
            ->where('id', '!=', $id)
            ->where('category', $info->category)
            ->limit(3)
            ->get();

        return view('user.information-show', compact('info', 'relatedInfo'));
    }

    // Admin: View all information
    public function adminIndex()
    {
        $information = Information::with('creator')
            ->latest()
            ->paginate(10);

        $totalInfo = Information::count();
        $publishedInfo = Information::where('is_published', true)->count();
        $draftInfo = Information::where('is_published', false)->count();

        return view('admin.information-index', compact(
            'information',
            'totalInfo',
            'publishedInfo',
            'draftInfo'
        ));
    }

    // Admin: Create information
    public function create()
    {
        return view('admin.information-create');
    }

    // Admin: Store information
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
        ]);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'created_by' => Auth::id(),
            'is_published' => $request->is_published ?? false,
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('information', 'public');
            $data['image'] = $imagePath;
        }

        Information::create($data);

        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil ditambahkan!');
    }

    // Admin: Edit information
    public function edit($id)
    {
        $info = Information::findOrFail($id);
        return view('admin.information-edit', compact('info'));
    }

    // Admin: Update information
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
        ]);

        $info = Information::findOrFail($id);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'is_published' => $request->is_published ?? false,
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('information', 'public');
            $data['image'] = $imagePath;
        }

        $info->update($data);

        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil diperbarui!');
    }

    // Admin: Delete information
    public function destroy($id)
    {
        $info = Information::findOrFail($id);
        $info->delete();

        return back()->with('success', 'Informasi berhasil dihapus!');
    }
}
