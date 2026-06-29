@extends('layouts.dashboard')

@section('title', 'Store Orders - Admin')

@section('content')
<section style="padding-bottom: 5rem; background: var(--bg);">
    <!-- Cohesive Header -->
    <div style="margin-bottom: 4rem; display: flex; justify-content: space-between; align-items: center;" class="header-stack">
        <div>
            <h1 style="font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 900; font-family: 'Outfit'; color: var(--text); letter-spacing: -1.5px; margin-bottom: 0.5rem; line-height: 1.2;">
                Store <span class="text-gradient">Orders</span>
            </h1>
            <p style="color: var(--text-dim); font-size: 1rem; font-weight: 500;">Auditing transactions for <strong>{{ $store->name }}</strong>.</p>
        </div>
        <div class="glass" style="padding: 0.6rem 1.5rem; border-radius: 50px; font-size: 0.75rem; font-weight: 800; color: var(--primary); letter-spacing: 1px; border-color: rgba(99,102,241,0.2); background: rgba(99,102,241,0.03); display: flex; gap: 1rem; align-items: center;">
            <a href="{{ route('admin.settlement') }}" style="text-decoration: none; color: inherit;">← BACK TO SETTLEMENT</a>
            @php
                $hasPaidOrders = $paidOrders->isNotEmpty();
            @endphp
            @if($hasPaidOrders)
                <button onclick="document.getElementById('payoutModal').style.display='flex'" style="padding: 0.4rem 1rem; font-size: 0.75rem; border-radius: 8px; border: none; background: var(--primary); color: white; font-weight: 700; cursor: pointer; transition: opacity 0.2s;" onmouseover="this.style.opacity=0.9" onmouseout="this.style.opacity=1">Process Payout</button>
            @else
                <button disabled style="padding: 0.4rem 1rem; font-size: 0.75rem; border-radius: 8px; border: none; background: #94a3b8; color: white; font-weight: 700; opacity: 0.6; cursor: not-allowed;" title="No paid orders available">Process Payout</button>
            @endif
        </div>
    </div>

    <div class="glass-card" style="padding: 2.5rem; background: #ffffff; border-color: rgba(15, 23, 42, 0.05); box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03);">
        <h3 style="margin-bottom: 2rem; font-weight: 900; font-family: 'Outfit'; color: var(--text);">Transaction History</h3>
        <div class="table-container">
            <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 800px;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(15, 23, 42, 0.05);">
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Order ID</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Customer</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Amount</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Payment</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Fulfillment</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr style="border-bottom: 1px solid rgba(15, 23, 42, 0.05); transition: background 0.3s;" onmouseover="this.style.background='rgba(15, 23, 42, 0.01)'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 1.25rem 1.5rem; font-weight: 700; font-size: 1rem; color: var(--text);">#EPC-{{ $order->id }}</td>
                    <td style="padding: 1.25rem 1.5rem;">
                        <div style="font-weight: 700; font-size: 1.05rem; color: var(--text);">{{ $order->user->name ?? 'Guest/Deleted' }}</div>
                        <div style="font-size: 0.8rem; color: var(--text-dim); margin-top: 0.2rem;">{{ $order->user->email ?? 'N/A' }}</div>
                    </td>
                    <td style="padding: 1.25rem 1.5rem; font-weight: 900; font-family: 'Outfit'; font-size: 1.1rem; color: var(--text);">${{ number_format($order->total_amount, 2) }}</td>
                    <td style="padding: 1.25rem 1.5rem;">
                        @php
                            $isPaidByCustomer = in_array($order->status, ['paid', 'shipped', 'completed']);
                            if ($order->is_settled) {
                                $paymentText = 'Settled';
                                $paymentStyle = ['bg' => 'rgba(139, 92, 246, 0.08)', 'color' => '#8b5cf6'];
                            } elseif ($isPaidByCustomer) {
                                $paymentText = 'Paid';
                                $paymentStyle = ['bg' => 'rgba(16, 185, 129, 0.08)', 'color' => '#10b981'];
                            } else {
                                $paymentText = 'Unpaid';
                                $paymentStyle = ['bg' => 'rgba(239, 68, 68, 0.08)', 'color' => '#ef4444'];
                            }
                        @endphp
                        <span style="padding: 0.35rem 0.8rem; border-radius: 50px; font-size: 0.72rem; font-weight: 800; background: {{ $paymentStyle['bg'] }}; color: {{ $paymentStyle['color'] }}; text-transform: uppercase; letter-spacing: 0.5px;">
                            {{ $paymentText }}
                        </span>
                    </td>
                    <td style="padding: 1.25rem 1.5rem;">
                        @php
                            $statusStyles = [
                                'pending' => ['bg' => 'rgba(245, 158, 11, 0.08)', 'color' => '#f59e0b'],
                                'paid' => ['bg' => 'rgba(148, 163, 184, 0.08)', 'color' => '#94a3b8'],
                                'shipped' => ['bg' => 'rgba(59, 130, 246, 0.08)', 'color' => '#3b82f6'],
                                'completed' => ['bg' => 'rgba(16, 185, 129, 0.08)', 'color' => '#10b981'],
                                'cancelled' => ['bg' => 'rgba(239, 68, 68, 0.08)', 'color' => '#ef4444']
                            ];
                            $style = $statusStyles[$order->status] ?? ['bg' => 'rgba(148, 163, 184, 0.08)', 'color' => '#94a3b8'];
                        @endphp
                        <span style="padding: 0.35rem 0.8rem; border-radius: 50px; font-size: 0.72rem; font-weight: 800; background: {{ $style['bg'] }}; color: {{ $style['color'] }}; text-transform: uppercase; letter-spacing: 0.5px;">
                            {{ $order->status === 'paid' ? 'processing' : $order->status }}
                        </span>
                    </td>
                    <td style="padding: 1.25rem 1.5rem; color: var(--text-dim); font-size: 0.9rem; font-weight: 500;">{{ $order->created_at->format('M d, Y') }}</td>
                </tr>
                @endforeach
                @if($orders->isEmpty())
                <tr>
                    <td colspan="6" style="padding: 6rem 1.5rem; text-align: center; color: var(--text-dim); font-weight: 700; font-size: 0.95rem;">NO ORDERS FOUND FOR THIS STORE</td>
                </tr>
                @endif
            </tbody>
        </table>
        </div>
        <div style="margin-top: 2rem;">
            {{ $orders->withQueryString()->links() }}
        </div>
    </div>
</section>

<!-- Payout Modal -->
<div id="payoutModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(5px); z-index: 1000; align-items: center; justify-content: center;">
    <div class="glass-card" style="background: var(--bg); width: 90%; max-width: 600px; max-height: 90vh; overflow-y: auto; border-radius: 20px; padding: 2rem; border: 1px solid var(--glass-border);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 style="font-family: 'Outfit'; font-weight: 800; font-size: 1.5rem; color: var(--text);">Payout Summary</h3>
            <button onclick="document.getElementById('payoutModal').style.display='none'" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: var(--text-dim);">&times;</button>
        </div>
        
        <div id="payoutList" style="margin-bottom: 1.5rem;">
            <p style="color: var(--text-dim); margin-bottom: 1rem;">The following items have been paid and are pending payout to the store:</p>
            <div style="background: rgba(15, 23, 42, 0.03); border: 1px solid rgba(15, 23, 42, 0.05); border-radius: 10px; padding: 1rem; margin-bottom: 1.5rem;">
                @foreach($paidOrders as $order)
                    @foreach($order->items as $item)
                        @if($item->product->store_id == $store->id)
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; padding-bottom: 0.5rem; border-bottom: 1px dashed rgba(15,23,42,0.1);">
                                <div style="font-size: 0.9rem; font-weight: 600; color: var(--text);">
                                    #EPC-{{ $order->id }} - {{ $item->product->name }} (x{{ $item->quantity }})
                                </div>
                                <div style="font-weight: 800; color: var(--primary);">
                                    ${{ number_format($item->price * $item->quantity, 2) }}
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
                <div style="display: flex; justify-content: space-between; margin-top: 1rem; padding-top: 0.5rem;">
                    <strong style="font-size: 1.1rem; color: var(--text);">Total Payout:</strong>
                    <strong style="font-size: 1.2rem; color: var(--primary);">${{ number_format($payoutTotal, 2) }}</strong>
                </div>
            </div>
            
            <button id="generateQrBtn" onclick="generatePayoutQr({{ $store->id }})" style="width: 100%; padding: 0.8rem; font-size: 1rem; border-radius: 10px; font-weight: 700; border: none; background: var(--primary); color: white; cursor: pointer;">Confirm & Generate QR</button>
        </div>
        
        <div id="qrResult" style="display: none; text-align: center;">
            <h4 style="font-weight: 800; font-family: 'Outfit'; color: var(--primary); margin-bottom: 1rem;">Scan to Transfer Funds</h4>
            <div style="background: white; padding: 1rem; border-radius: 15px; display: inline-block; margin-bottom: 1rem; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);">
                <img id="qrImage" src="" alt="Payout QR Code" style="width: 100%; max-width: 320px; height: auto; object-fit: contain;" />
            </div>
            <div style="font-size: 0.9rem; font-weight: 600; color: var(--text-dim); margin-bottom: 0.5rem;">Account: <span id="accName" style="color: var(--text);"></span></div>
            <div style="font-size: 0.85rem; color: var(--text-dim); margin-bottom: 1.5rem;">ID: <span id="accId" style="color: var(--text);"></span></div>
            <button id="verifyQrBtn" onclick="verifyPayoutTransaction({{ $store->id }})" style="width: 100%; padding: 0.8rem; border-radius: 10px; font-weight: 700; background: var(--primary); color: white; border: none; cursor: pointer; margin-bottom: 0.5rem;">Verify Transaction</button>
            <button onclick="document.getElementById('payoutModal').style.display='none'" style="width: 100%; padding: 0.8rem; border-radius: 10px; font-weight: 700; background: transparent; border: 1px solid var(--glass-border); color: var(--text); cursor: pointer;">Close</button>
        </div>
    </div>
</div>

<script>
let currentPayoutMd5 = null;

async function generatePayoutQr(storeId) {
    const btn = document.getElementById('generateQrBtn');
    btn.textContent = 'Generating...';
    btn.disabled = true;
    
    try {
        const response = await fetch(`/admin/settlement/store/${storeId}/payout`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        });
        const data = await response.json();
        
        if (data.success) {
            currentPayoutMd5 = data.md5;
            document.getElementById('payoutList').style.display = 'none';
            document.getElementById('qrImage').src = data.qr_url;
            document.getElementById('accName').textContent = data.account_name;
            document.getElementById('accId').textContent = data.account_id;
            document.getElementById('qrResult').style.display = 'block';
        } else {
            alert(data.message || 'Error generating QR');
            btn.textContent = 'Confirm & Generate QR';
            btn.disabled = false;
        }
    } catch (error) {
        alert('Network error');
        btn.textContent = 'Confirm & Generate QR';
        btn.disabled = false;
    }
}

async function verifyPayoutTransaction(storeId) {
    if (!currentPayoutMd5) return;
    
    const btn = document.getElementById('verifyQrBtn');
    btn.textContent = 'Verifying...';
    btn.disabled = true;
    
    try {
        const response = await fetch(`/admin/settlement/store/${storeId}/check-payout`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ md5: currentPayoutMd5 })
        });
        const data = await response.json();
        
        if (data.success) {
            alert('Payout successful! Orders marked as completed.');
            window.location.reload();
        } else {
            alert(data.message || 'Transaction not found. Try again.');
            btn.textContent = 'Verify Transaction';
            btn.disabled = false;
        }
    } catch (error) {
        alert('Network error while verifying');
        btn.textContent = 'Verify Transaction';
        btn.disabled = false;
    }
}
</script>
@endsection
