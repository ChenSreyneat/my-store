@extends('layouts.main')

@section('title', 'Order Successful - ElitePC')

@section('content')
<section style="min-height: 90vh; display: flex; align-items: center; justify-content: center; padding: 2rem;">
    <div class="animate-fade-in" style="width: 100%; max-width: 650px; text-align: center;">
        <div class="glass-card" style="padding: 6rem 4rem; border-radius: 50px; border-color: #10b981;">
            <div style="width: 120px; height: 120px; background: #10b981; border-radius: 40px; margin: 0 auto 3.5rem auto; display: flex; align-items: center; justify-content: center; color: white; box-shadow: 0 30px 60px -15px rgba(16, 185, 129, 0.4); transform: rotate(5deg);">
                <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            
            <h1 style="font-size: clamp(2.5rem, 6vw, 3.5rem); font-weight: 900; margin-bottom: 1.5rem; font-family: 'Outfit'; letter-spacing: -2px;">Acquisition <span class="text-gradient">Finalized!</span></h1>
            <p style="opacity: 0.7; font-size: 1.2rem; margin-bottom: 4rem; line-height: 1.6;">Precision logistics initialized. Your order <span style="color: var(--primary); font-weight: 900;">#EPC-{{ $order->id }}</span> is now being prepared by our elite technicians.</p>
            
            <div class="glass" style="padding: 2.5rem; border-radius: 24px; text-align: left; margin-bottom: 4rem; display: flex; flex-direction: column; gap: 1.5rem; border: 1px solid rgba(16, 185, 129, 0.2);">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="opacity: 0.5; font-weight: 800; font-size: 0.8rem; letter-spacing: 1px;">SETTLEMENT AMOUNT</span>
                    <span style="font-weight: 900; font-size: 1.3rem; font-family: 'Outfit'; color: var(--primary);">${{ number_format($order->total_amount, 2) }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="opacity: 0.5; font-weight: 800; font-size: 0.8rem; letter-spacing: 1px;">SETTLEMENT PROTOCOL</span>
                    <span style="font-weight: 900; text-transform: uppercase; letter-spacing: 1px; font-size: 0.9rem;">{{ $order->payment_method }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <span style="opacity: 0.5; font-weight: 800; font-size: 0.8rem; letter-spacing: 1px;">DEPLOYMENT TARGET</span>
                    <span style="font-weight: 800; text-align: right; max-width: 250px; font-size: 0.95rem; line-height: 1.4;">{{ $order->shipping_address }}</span>
                </div>
            </div>

            <div style="display: flex; gap: 1.5rem;">
                <a href="{{ route('orders.my') }}" class="btn btn-outline" style="flex: 1; padding: 1.25rem; font-weight: 800; border-radius: 16px;">Track Deployment</a>
                <a href="{{ route('home') }}" class="btn btn-primary" style="flex: 1; padding: 1.25rem; font-weight: 800; border-radius: 16px;">Return to Hub</a>
            </div>
        </div>
        <p style="margin-top: 3rem; opacity: 0.5; font-size: 0.9rem; font-weight: 700;">DIGITAL RECEIPT TRANSMITTED TO: <span style="color: var(--text);">{{ strtoupper(Auth::user()->email) }}</span></p>
    </div>
</section>
@endsection
