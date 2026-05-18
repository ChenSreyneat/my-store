@extends('layouts.dashboard')

@section('title', 'Bakong Accounts - Admin')

@section('content')
<section>
    <div style="margin-bottom: 4rem;">
        <h1 style="font-size: 3rem; font-weight: 800; font-family: 'Outfit';">Bakong <span class="text-gradient">Accounts</span></h1>
        <p style="opacity: 0.5;">Manage merchant payment accounts for KHQR generation.</p>
    </div>

    <!-- Registration Form -->
    <div class="glass" style="padding: 3rem; border-radius: 40px; margin-bottom: 4rem;">
        <h3 style="margin-bottom: 2rem; font-weight: 800;">Register New Account</h3>
        <form action="{{ route('admin.payment_accounts.store') }}" method="POST" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem; align-items: end;">
            @csrf
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-weight: 700; opacity: 0.7;">Bakong ID / Account ID</label>
                <input type="text" name="account_id" required placeholder="name@bank_id" style="background: var(--glass-bg); border: 1px solid var(--glass-border); padding: 1rem; border-radius: 12px; color: var(--text); width: 100%;">
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-weight: 700; opacity: 0.7;">Account Name</label>
                <input type="text" name="account_name" required placeholder="ELITE PC CO., LTD" style="background: var(--glass-bg); border: 1px solid var(--glass-border); padding: 1rem; border-radius: 12px; color: var(--text); width: 100%;">
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-weight: 700; opacity: 0.7;">Currency</label>
                <select name="currency" required style="background: var(--bg); border: 1px solid var(--glass-border); padding: 1rem; border-radius: 12px; color: var(--text); width: 100%;">
                    <option value="USD">USD - US Dollar</option>
                    <option value="KHR">KHR - Khmer Riel</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" style="padding: 1rem;">Register Account</button>
        </form>
    </div>

    <!-- Accounts List -->
    <div class="glass" style="padding: 3rem; border-radius: 40px;">
        <h3 style="margin-bottom: 2rem; font-weight: 800;">Registered Merchant Accounts</h3>
        <div class="table-responsive">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="border-bottom: 1px solid var(--glass-border);">
                        <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Owner</th>
                        <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Bakong Details</th>
                        <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Currency</th>
                        <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Status</th>
                        <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accounts as $account)
                    <tr style="border-bottom: 1px solid var(--glass-border);">
                        <td style="padding: 1.5rem;">
                            <div style="font-weight: 700;">{{ $account->user->name }}</div>
                            <div style="font-size: 0.75rem; opacity: 0.5;">{{ strtoupper($account->user->role) }}</div>
                        </td>
                        <td style="padding: 1.5rem;">
                            <div style="font-weight: 700; color: var(--primary);">{{ $account->account_id }}</div>
                            <div style="font-size: 0.8rem; opacity: 0.7;">{{ $account->account_name }}</div>
                        </td>
                        <td style="padding: 1.5rem;">
                            <span style="font-weight: 800;">{{ $account->currency }}</span>
                        </td>
                        <td style="padding: 1.5rem;">
                            <span style="padding: 0.3rem 0.8rem; border-radius: 50px; font-size: 0.7rem; font-weight: 700; background: rgba(16, 185, 129, 0.1); color: #10b981;">ACTIVE</span>
                        </td>
                        <td style="padding: 1.5rem;">
                            <form action="{{ route('admin.payment_accounts.destroy', $account->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.75rem; color: #ef4444;">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($accounts->isEmpty())
                    <tr>
                        <td colspan="5" style="padding: 4rem; text-align: center; opacity: 0.5;">No payment accounts registered yet.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
