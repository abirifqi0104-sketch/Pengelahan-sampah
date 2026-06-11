<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Withdrawal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    // User: View all withdrawals
    public function index()
    {
        $withdrawals = Withdrawal::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        $saldo = Auth::user()->saldo;
        
        return view('user.withdraw-index', compact('withdrawals', 'saldo'));
    }

    // User: Create withdrawal request
    public function create()
    {
        $saldo = Auth::user()->saldo;
        return view('user.withdraw-create', compact('saldo'));
    }

    // User: Store withdrawal request
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10000',
            'bank_name' => 'required|string',
            'account_number' => 'required|string|regex:/^[0-9]{8,20}$/',
            'account_holder' => 'required|string|max:100',
        ]);

        $user = Auth::user();

        // Check saldo
        if ($user->saldo < $request->amount) {
            return back()->withErrors(['amount' => 'Saldo Anda tidak cukup!']);
        }

        // Deduct saldo
        $user->saldo -= $request->amount;
        $user->save();

        // Create withdrawal request
        Withdrawal::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'account_holder' => $request->account_holder,
            'status' => 'pending',
        ]);

        return redirect()->route('user.withdraw.index')->with('success', 'Permintaan tarik saldo berhasil dikirim!');
    }

    // Admin: View all withdrawal requests
    public function adminIndex()
    {
        $withdrawals = Withdrawal::with('user')
            ->latest()
            ->paginate(10);

        $pendingCount = Withdrawal::where('status', 'pending')->count();
        $approvedCount = Withdrawal::where('status', 'approved')->count();
        $processedCount = Withdrawal::where('status', 'processed')->count();
        $rejectedCount = Withdrawal::where('status', 'rejected')->count();

        return view('admin.withdraw-index', compact(
            'withdrawals',
            'pendingCount',
            'approvedCount',
            'processedCount',
            'rejectedCount'
        ));
    }

    // Admin: Approve withdrawal
    public function approve(Request $request, $id)
    {
        $request->validate([
            'admin_note' => 'nullable|string|max:500',
        ]);

        $withdrawal = Withdrawal::findOrFail($id);
        $withdrawal->approve($request->admin_note);

        return back()->with('success', 'Permintaan tarik saldo disetujui!');
    }

    // Admin: Reject withdrawal
    public function reject(Request $request, $id)
    {
        $request->validate([
            'admin_note' => 'required|string|max:500',
        ]);

        $withdrawal = Withdrawal::findOrFail($id);
        $withdrawal->reject($request->admin_note);

        return back()->with('success', 'Permintaan tarik saldo ditolak dan saldo dikembalikan ke user!');
    }

    // Admin: Mark as processed
    public function process(Request $request, $id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        $withdrawal->process();

        return back()->with('success', 'Tarik saldo berhasil diproses!');
    }
}
