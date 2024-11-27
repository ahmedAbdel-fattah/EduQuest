<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;


class FaqController extends Controller
{
    // Display a listing of the FAQs
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $faqs = Faq::all();
        return view('admin.faqs', compact('faqs'));
    }

    public function showFaq(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $faqs = Faq::all();
        return view('website.faqs', compact('faqs'));
    }


    // Show the form for creating a new FAQ
    public function create()
    {
        return view('admin.faqs-create');
    }

    // Store a newly created FAQ in the database
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        Faq::create($request->all());

        return redirect()->route('faqs.index')->with('success', 'FAQ created successfully.');
    }

    // Display the specified FAQ
    public function show(Faq $faq)
    {
        return view('admin.faqs.show', compact('faq'));
    }

    // Show the form for editing the specified FAQ
    public function edit(Faq $faq)
    {
        return view('admin.faqs-edit', compact('faq'));
    }

    // Update the specified FAQ in the database
    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faq->update($request->all());

        return redirect()->route('faqs.index')->with('success', 'FAQ updated successfully.');
    }

    // Remove the specified FAQ from the database
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('faqs.index')->with('success', 'FAQ deleted successfully.');
    }
}
