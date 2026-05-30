@extends('layouts.dashboard')

@section('title', 'Payment Accounts - Owner')

@section('content')
<section style="padding-bottom: 5rem; font-family: 'Inter', sans-serif;">
    <!-- Cohesive Header -->
    <div style="margin-bottom: 3rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h1 style="font-size: 2.2rem; font-weight: 800; color: #1e293b; margin-bottom: 0.5rem; line-height: 1.2;">
                Payment Accounts 💳
            </h1>
            <p style="color: #64748b; font-size: 1rem; margin: 0;">Register your Bakong details to receive payments for your store sales.</p>
        </div>
    </div>

    <!-- Registration Form -->
    <div style="background: #ffffff; border-radius: 24px; padding: 2.5rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px rgba(0,0,0,0.03); margin-bottom: 3rem;">
        <h3 style="margin-bottom: 2rem; font-weight: 800; font-size: 1.3rem; color: #1e293b; margin-top: 0;">Add New Account</h3>
        <form action="{{ route('owner.payment_accounts.store') }}" method="POST" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; align-items: end;">
            @csrf
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b;">Bakong ID</label>
                <input type="text" name="account_id" required placeholder="yourname@bank" style="padding: 0.8rem 1.2rem; border-radius: 12px; border: 1px solid #e2e8f0; font-size: 0.95rem; outline: none; transition: 0.2s; background: #f8fafc;" onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b;">Account Name</label>
                <input type="text" name="account_name" required placeholder="Full Name" style="padding: 0.8rem 1.2rem; border-radius: 12px; border: 1px solid #e2e8f0; font-size: 0.95rem; outline: none; transition: 0.2s; background: #f8fafc;" onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b;">Currency</label>
                <select name="currency" required style="padding: 0.8rem 1.2rem; border-radius: 12px; border: 1px solid #e2e8f0; font-size: 0.95rem; outline: none; transition: 0.2s; background: #f8fafc;" onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                    <option value="USD">USD - US Dollar</option>
                    <option value="KHR">KHR - Khmer Riel</option>
                </select>
            </div>
            <button type="submit" style="padding: 0.9rem 1.5rem; border-radius: 12px; font-weight: 700; background: #10b981; color: white; border: none; cursor: pointer; transition: 0.2s; box-shadow: 0 4px 15px rgba(16,185,129,0.3); height: 48px; display: flex; align-items: center; justify-content: center;" onmouseover="this.style.background='#059669'" onmouseout="this.style.background='#10b981'">Register Account</button>
        </form>
    </div>

    <!-- My Accounts List -->
    <div style="background: #ffffff; border-radius: 24px; padding: 2.5rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
        <h3 style="margin-bottom: 2rem; font-weight: 800; font-size: 1.3rem; color: #1e293b; margin-top: 0;">My Registered Accounts</h3>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: separate; border-spacing: 0; text-align: left; min-width: 600px;">
                <thead>
                    <tr>
                        <th style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9;">Bakong Details</th>
                        <th style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9;">Currency</th>
                        <th style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9;">Status</th>
                        <th style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9; text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accounts as $account)
                    <tr style="transition: background 0.3s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9;">
                            <div style="font-weight: 700; color: #6366f1; font-size: 1.05rem;">{{ $account->account_id }}</div>
                            <div style="font-size: 0.85rem; color: #64748b; margin-top: 0.25rem;">{{ $account->account_name }}</div>
                        </td>
                        <td style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9;">
                            <span style="font-weight: 800; color: #1e293b; font-size: 0.95rem; background: #f1f5f9; padding: 0.4rem 0.8rem; border-radius: 8px;">{{ $account->currency }}</span>
                        </td>
                        <td style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9;">
                            <span style="padding: 0.35rem 0.8rem; border-radius: 50px; font-size: 0.72rem; font-weight: 800; background: #d1fae5; color: #059669; letter-spacing: 0.5px;">ACTIVE</span>
                        </td>
                        <td style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; text-align: right;">
                            <form action="{{ route('owner.payment_accounts.destroy', $account->id) }}" method="POST" style="margin: 0; display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="padding: 0.5rem 1.2rem; font-size: 0.8rem; font-weight: 700; border-radius: 8px; color: #ef4444; background: #fef2f2; border: 1px solid #fee2e2; cursor: pointer; transition: 0.2s;" onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fef2f2'">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($accounts->isEmpty())
                    <tr>
                        <td colspan="4" style="padding: 6rem 1.5rem; text-align: center; color: #64748b; font-weight: 700; font-size: 0.95rem;">You haven't registered any payment accounts yet.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
