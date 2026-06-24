<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');

        $transactions = $user->transactions()
            ->with('category')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('note', 'like', "%{$search}%")
                      ->orWhereHas('category', function ($qc) use ($search) {
                          $qc->where('name', 'like', "%{$search}%");
                      });
                });
            })
            ->orderByDesc('transaction_date')
            ->orderByDesc('id')
            ->paginate(15)
            ->withQueryString();

        $categories = Category::availableFor($user->id)->get();

        return view('transactions.index', compact('transactions', 'categories', 'search'));
    }

    public function show(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $transaction->load('category');
        $categories = Category::availableFor(Auth::id())->get();

        return view('transactions.show', compact('transaction', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => ['required', 'numeric', 'min:1'],
            'type' => ['required', 'in:income,expense'],
            'category_id' => ['required', 'exists:categories,id'],
            'transaction_date' => ['required', 'date'],
            'note' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:5120'],
        ]);

        $user = Auth::user();

        // Pastikan kategori valid dan boleh dipakai user ini
        $category = Category::availableFor($user->id)->findOrFail($request->category_id);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('transactions', 'public');
        }

        Transaction::create([
            'user_id' => $user->id,
            'wallet_id' => $user->wallet->id,
            'category_id' => $category->id,
            'type' => $request->type,
            'amount' => $request->amount,
            'transaction_date' => $request->transaction_date,
            'note' => $request->note,
            'image_path' => $imagePath,
        ]);

        return back()->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function update(Request $request, Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'amount' => ['required', 'numeric', 'min:1'],
            'type' => ['required', 'in:income,expense'],
            'category_id' => ['required', 'exists:categories,id'],
            'transaction_date' => ['required', 'date'],
            'note' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:5120'],
        ]);

        $category = Category::availableFor(Auth::id())->findOrFail($request->category_id);

        $imagePath = $transaction->image_path;
        if ($request->hasFile('image')) {
            if ($imagePath && \Illuminate\Support\Facades\Storage::disk('public')->exists($imagePath)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('transactions', 'public');
        }

        $transaction->update([
            'category_id' => $category->id,
            'type' => $request->type,
            'amount' => $request->amount,
            'transaction_date' => $request->transaction_date,
            'note' => $request->note,
            'image_path' => $imagePath,
        ]);

        return back()->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function destroy(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        if ($transaction->image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($transaction->image_path)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($transaction->image_path);
        }

        $transaction->delete();

        if (url()->previous() === route('transactions.show', $transaction->id)) {
            return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus!');
        }

        return back()->with('success', 'Transaksi berhasil dihapus!');
    }
}
