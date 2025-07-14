<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    /**
     * Display a listing of FAQs
     */
    public function index()
    {
        $faqs = Faq::ordered()->paginate(15);
        return view('admin.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new FAQ
     */
    public function create()
    {
        return view('admin.faqs.create');
    }

    /**
     * Store a newly created FAQ
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_ar' => 'required|string|max:255',
            'question_en' => 'required|string|max:255',
            'answer_ar' => 'required|string',
            'answer_en' => 'required|string',
            'is_active' => 'boolean',
            'order' => 'integer|min:0'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        $data['order'] = $data['order'] ?? 0;

        Faq::create($data);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ created successfully.');
    }

    /**
     * Show the form for editing the specified FAQ
     */
    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    /**
     * Update the specified FAQ
     */
    public function update(Request $request, Faq $faq)
    {
        $validator = Validator::make($request->all(), [
            'question_ar' => 'required|string|max:255',
            'question_en' => 'required|string|max:255',
            'answer_ar' => 'required|string',
            'answer_en' => 'required|string',
            'is_active' => 'boolean',
            'order' => 'integer|min:0'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        $data['order'] = $data['order'] ?? 0;

        $faq->update($data);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ updated successfully.');
    }

    /**
     * Remove the specified FAQ
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ deleted successfully.');
    }

    /**
     * Toggle FAQ status
     */
    public function toggleStatus(Faq $faq)
    {
        $faq->update(['is_active' => !$faq->is_active]);

        return response()->json([
            'success' => true,
            'message' => 'FAQ status updated successfully.',
            'is_active' => $faq->is_active
        ]);
    }

    /**
     * Bulk operations
     */
    public function bulkAction(Request $request)
    {
        $action = $request->input('action');
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return response()->json(['success' => false, 'message' => 'No items selected.']);
        }

        switch ($action) {
            case 'activate':
                Faq::whereIn('id', $ids)->update(['is_active' => true]);
                $message = 'FAQs activated successfully.';
                break;
            case 'deactivate':
                Faq::whereIn('id', $ids)->update(['is_active' => false]);
                $message = 'FAQs deactivated successfully.';
                break;
            case 'delete':
                Faq::whereIn('id', $ids)->delete();
                $message = 'FAQs deleted successfully.';
                break;
            default:
                return response()->json(['success' => false, 'message' => 'Invalid action.']);
        }

        return response()->json(['success' => true, 'message' => $message]);
    }

    /**
     * Update FAQ order
     */
    public function updateOrder(Request $request)
    {
        $orders = $request->input('orders', []);

        foreach ($orders as $order) {
            Faq::where('id', $order['id'])->update(['order' => $order['position']]);
        }

        return response()->json(['success' => true, 'message' => 'Order updated successfully.']);
    }
}
