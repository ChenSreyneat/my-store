@extends('layouts.dashboard')

@section('title', 'Bakong Accounts - Admin')

@section('content')
<section style="padding-bottom: 5rem; background: var(--bg);">
    <!-- Cohesive Header -->
    <div style="margin-bottom: 4rem; display: flex; justify-content: space-between; align-items: center;" class="header-stack">
        <div>
            <h1 style="font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 900; font-family: 'Outfit'; color: var(--text); letter-spacing: -1.5px; margin-bottom: 0.5rem; line-height: 1.2;">
                Payment <span class="text-gradient">Protocols</span>
            </h1>
            <p style="color: var(--text-dim); font-size: 1rem; font-weight: 500;">Manage merchant payment accounts for KHQR generation.</p>
        </div>
        <div class="glass" style="padding: 0.6rem 1.5rem; border-radius: 50px; font-size: 0.75rem; font-weight: 800; color: var(--primary); letter-spacing: 1px; border-color: rgba(99,102,241,0.2); background: rgba(99,102,241,0.03);">
            BAKONG ENDPOINTS
        </div>
    </div>

    <!-- Registration Form -->
    <div class="glass-card" style="padding: 2.5rem; background: #ffffff; border-color: rgba(15, 23, 42, 0.05); box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03); margin-bottom: 3rem;">
        <h3 style="margin-bottom: 2rem; font-weight: 900; font-family: 'Outfit'; color: var(--text);">Register New Account</h3>
        <form action="{{ route('admin.payment_accounts.store') }}" method="POST" class="form-grid-admin">
            @csrf
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.6;">Bakong ID / Account ID</label>
                <input type="text" name="account_id" required placeholder="name@bank_id">
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.6;">Account Name</label>
                <input type="text" name="account_name" required placeholder="ELITE PC CO., LTD">
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.6;">Currency</label>
                <select name="currency" required>
                    <option value="USD">USD - US Dollar</option>
                    <option value="KHR">KHR - Khmer Riel</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" style="padding: 0.8rem 1.8rem; border-radius: 12px; font-weight: 700; height: 48px; justify-content: center;">Register Account</button>
        </form>
    </div>

    <!-- Accounts List -->
    <div class="glass-card" style="padding: 2.5rem; background: #ffffff; border-color: rgba(15, 23, 42, 0.05); box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03);">
        <h3 style="margin-bottom: 2rem; font-weight: 900; font-family: 'Outfit'; color: var(--text);">Registered Merchant Accounts</h3>
        <div class="table-container">
            <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 800px;">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(15, 23, 42, 0.05);">
                        <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Owner</th>
                        <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Bakong Details</th>
                        <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Currency</th>
                        <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Status</th>
                        <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accounts as $account)
                    <tr style="border-bottom: 1px solid rgba(15, 23, 42, 0.05); transition: background 0.3s;" onmouseover="this.style.background='rgba(15, 23, 42, 0.01)'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 1.25rem 1.5rem;">
                            <div style="font-weight: 700; font-size: 1.05rem; color: var(--text);">{{ $account->user->name ?? 'Deleted Owner' }}</div>
                            <div style="font-size: 0.75rem; color: var(--text-dim); margin-top: 0.2rem; text-transform: uppercase; font-weight: 700;">{{ $account->user ? $account->user->role : 'N/A' }}</div>
                        </td>
                        <td style="padding: 1.25rem 1.5rem;">
                            <div style="font-weight: 700; color: var(--primary); font-size: 1rem;">{{ $account->account_id }}</div>
                            <div style="font-size: 0.8rem; color: var(--text-dim); margin-top: 0.15rem;">{{ $account->account_name }}</div>
                        </td>
                        <td style="padding: 1.25rem 1.5rem;">
                            <span style="font-weight: 800; color: var(--text); font-size: 0.95rem;">{{ $account->currency }}</span>
                        </td>
                        <td style="padding: 1.25rem 1.5rem;">
                            <span style="padding: 0.35rem 0.8rem; border-radius: 50px; font-size: 0.72rem; font-weight: 800; background: rgba(16, 185, 129, 0.08); color: #10b981; letter-spacing: 0.5px;">ACTIVE</span>
                        </td>
                        <td style="padding: 1.25rem 1.5rem; text-align: right;">
                            <form action="{{ route('admin.payment_accounts.destroy', $account->id) }}" method="POST" style="margin: 0; display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.75rem; border-radius: 8px; color: #ef4444; border-color: rgba(239,68,68,0.15);">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($accounts->isEmpty())
                    <tr>
                        <td colspan="5" style="padding: 6rem 1.5rem; text-align: center; color: var(--text-dim); font-weight: 700; font-size: 0.95rem;">No payment protocols registered yet.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
