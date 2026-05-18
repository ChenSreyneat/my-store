@extends('layouts.main')

@section('title', 'Checkout - ElitePC')

@section('content')
<section style="padding: 10rem 0 8rem 0; position: relative; overflow: hidden;">
    <!-- Abstract Background -->
    <div style="position: absolute; top: 0; left: 0; width: 600px; height: 600px; background: radial-gradient(circle, rgba(99, 102, 241, 0.05) 0%, transparent 70%);"></div>

    <div class="container">
        <div style="margin-bottom: 5rem;">
            <div class="glass" style="display: inline-flex; padding: 0.6rem 2rem; border-radius: 50px; margin-bottom: 2rem; font-weight: 800; color: var(--primary); font-size: 0.9rem; letter-spacing: 2px;">SECURE ACQUISITION</div>
            <h1 style="font-size: clamp(3rem, 8vw, 4.5rem); font-weight: 900; font-family: 'Outfit'; letter-spacing: -2px; line-height: 1;">Complete <span class="text-gradient">Purchase</span></h1>
        </div>

        <form action="{{ route('checkout.place') }}" method="POST" id="checkout-form">
            @csrf
            <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 5rem; align-items: start;">
                <!-- Left: Logistics & Payment -->
                <div style="display: flex; flex-direction: column; gap: 4rem;">
                    <!-- Shipping -->
                    <div class="glass-card" style="padding: 4rem;">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 3rem;">
                            <h3 style="font-weight: 900; font-family: 'Outfit'; font-size: 1.5rem; display: flex; align-items: center; gap: 1.5rem;">
                                <div style="width: 40px; height: 40px; background: var(--primary); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; color: white; font-weight: 900;">1</div>
                                Deployment Logistics
                            </h3>
                            <div class="glass" style="padding: 0.5rem 1rem; border-radius: 50px; font-size: 0.75rem; font-weight: 800; opacity: 0.5;">SHIPPING ADDRESS</div>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 2.5rem;">
                            <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                                <label style="font-size: 0.85rem; font-weight: 800; opacity: 0.6; letter-spacing: 1px;">PRECISE LOCATION ADDRESS</label>
                                <textarea name="shipping_address" required style="background: rgba(255,255,255,0.03); border: 1px solid var(--glass-border); padding: 1.5rem; border-radius: 20px; color: white; resize: none; min-height: 120px; font-size: 1.1rem; font-weight: 600; transition: 0.3s;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--glass-border)'">{{ Auth::user()->address }}</textarea>
                            </div>
                            <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                                <label style="font-size: 0.85rem; font-weight: 800; opacity: 0.6; letter-spacing: 1px;">CONTACT TELEMETRY</label>
                                <input type="text" name="phone_number" value="{{ Auth::user()->phone }}" required style="background: rgba(255,255,255,0.03); border: 1px solid var(--glass-border); padding: 1.25rem; border-radius: 20px; color: white; font-size: 1.1rem; font-weight: 600; transition: 0.3s;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--glass-border)'">
                            </div>
                        </div>
                    </div>

                    <!-- Payment -->
                    <div class="glass-card" style="padding: 4rem;">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 3rem;">
                            <h3 style="font-weight: 900; font-family: 'Outfit'; font-size: 1.5rem; display: flex; align-items: center; gap: 1.5rem;">
                                <div style="width: 40px; height: 40px; background: var(--secondary); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; color: white; font-weight: 900;">2</div>
                                Settlement Protocol
                            </h3>
                            <div class="glass" style="padding: 0.5rem 1rem; border-radius: 50px; font-size: 0.75rem; font-weight: 800; opacity: 0.5;">PAYMENT GATEWAY</div>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem;">
                            <label class="glass-card" style="padding: 2rem 1.5rem; cursor: pointer; text-align: center; transition: 0.4s; display: flex; flex-direction: column; align-items: center; gap: 0.5rem; border-width: 2px;" id="label-cod">
                                <input type="radio" name="payment_method" value="cod" checked style="display: none;" onchange="updatePaymentUI()">
                                <div style="font-size: 1.5rem; margin-bottom: 0.5rem;">💵</div>
                                <div style="font-weight: 900; font-family: 'Outfit'; letter-spacing: 1px;">COD</div>
                                <div style="font-size: 0.7rem; opacity: 0.5; font-weight: 800;">CASH ON DELIVERY</div>
                            </label>
                            <label class="glass-card" style="padding: 2rem 1.5rem; cursor: pointer; text-align: center; transition: 0.4s; display: flex; flex-direction: column; align-items: center; gap: 0.5rem; border-width: 2px;" id="label-card">
                                <input type="radio" name="payment_method" value="card" style="display: none;" onchange="updatePaymentUI()">
                                <div style="font-size: 1.5rem; margin-bottom: 0.5rem;">💳</div>
                                <div style="font-weight: 900; font-family: 'Outfit'; letter-spacing: 1px;">CARD</div>
                                <div style="font-size: 0.7rem; opacity: 0.5; font-weight: 800;">CREDIT / DEBIT</div>
                            </label>
                            <label class="glass-card" style="padding: 2rem 1.5rem; cursor: pointer; text-align: center; transition: 0.4s; display: flex; flex-direction: column; align-items: center; gap: 0.5rem; border-width: 2px;" id="label-bakong">
                                <input type="radio" name="payment_method" value="bakong" style="display: none;" onchange="updatePaymentUI()">
                                <div style="font-size: 1.5rem; margin-bottom: 0.5rem;">🇰🇭</div>
                                <div style="font-weight: 900; font-family: 'Outfit'; letter-spacing: 1px; color: #eab308;">BAKONG</div>
                                <div style="font-size: 0.7rem; opacity: 0.5; font-weight: 800;">KHQR INSTANT</div>
                            </label>
                        </div>

                        <!-- Credit Card Details (Hidden by default) -->
                        <div id="card-details" style="display: none; margin-top: 3rem; padding-top: 3rem; border-top: 1px solid var(--glass-border); flex-direction: column; gap: 3rem;" class="animate-fade-in">
                            <!-- Virtual Card Preview -->
                            <div style="width: 100%; max-width: 400px; height: 240px; margin: 0 auto; perspective: 1000px;">
                                <div id="virtual-card" class="glass" style="width: 100%; height: 100%; border-radius: 24px; padding: 2.5rem; position: relative; background: linear-gradient(135deg, rgba(99, 102, 241, 0.4) 0%, rgba(236, 72, 153, 0.4) 100%); border: 1px solid rgba(255,255,255,0.3); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); display: flex; flex-direction: column; justify-content: space-between; overflow: hidden;">
                                    <div style="position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%); pointer-events: none;"></div>
                                    <div style="display: flex; justify-content: space-between; align-items: flex-start; position: relative; z-index: 2;">
                                        <div style="width: 50px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 8px; position: relative; overflow: hidden;">
                                            <div style="position: absolute; top: 0; left: 15%; width: 1px; height: 100%; background: rgba(255,255,255,0.3);"></div>
                                            <div style="position: absolute; top: 0; left: 35%; width: 1px; height: 100%; background: rgba(255,255,255,0.3);"></div>
                                            <div style="position: absolute; top: 0; left: 65%; width: 1px; height: 100%; background: rgba(255,255,255,0.3);"></div>
                                            <div style="position: absolute; top: 0; left: 85%; width: 1px; height: 100%; background: rgba(255,255,255,0.3);"></div>
                                        </div>
                                        <div style="font-weight: 900; font-family: 'Outfit'; font-size: 1.2rem; color: white; opacity: 0.8;">ELITE<span style="opacity: 0.5;">CARD</span></div>
                                    </div>
                                    
                                    <div id="v-card-number" style="font-size: 1.6rem; font-family: 'Outfit'; font-weight: 800; letter-spacing: 4px; color: white; text-shadow: 0 2px 4px rgba(0,0,0,0.3); position: relative; z-index: 2;">•••• •••• •••• ••••</div>
                                    
                                    <div style="display: flex; justify-content: space-between; align-items: flex-end; position: relative; z-index: 2;">
                                        <div>
                                            <div style="font-size: 0.6rem; font-weight: 800; opacity: 0.6; letter-spacing: 1px; margin-bottom: 0.3rem;">CARDHOLDER</div>
                                            <div id="v-card-name" style="font-weight: 700; font-size: 0.9rem; text-transform: uppercase;">YOUR NAME</div>
                                        </div>
                                        <div style="text-align: right;">
                                            <div style="font-size: 0.6rem; font-weight: 800; opacity: 0.6; letter-spacing: 1px; margin-bottom: 0.3rem;">EXPIRES</div>
                                            <div id="v-card-expiry" style="font-weight: 700; font-size: 0.9rem;">MM/YY</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr; gap: 2rem;">
                                <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                                    <label style="font-size: 0.85rem; font-weight: 800; opacity: 0.6; letter-spacing: 1px;">CARDHOLDER NAME</label>
                                    <input type="text" id="card_name_input" name="card_name" placeholder="JOHN DOE" style="background: rgba(255,255,255,0.03); border: 1px solid var(--glass-border); padding: 1.25rem; border-radius: 20px; color: white; font-size: 1.1rem; font-weight: 600; text-transform: uppercase;">
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                                    <label style="font-size: 0.85rem; font-weight: 800; opacity: 0.6; letter-spacing: 1px;">CARD NUMBER</label>
                                    <input type="text" id="card_number_input" name="card_number" placeholder="0000 0000 0000 0000" maxlength="19" style="background: rgba(255,255,255,0.03); border: 1px solid var(--glass-border); padding: 1.25rem; border-radius: 20px; color: white; font-size: 1.1rem; font-weight: 600;">
                                </div>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                                    <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                                        <label style="font-size: 0.85rem; font-weight: 800; opacity: 0.6; letter-spacing: 1px;">EXPIRY DATE</label>
                                        <input type="text" id="card_expiry_input" name="card_expiry" placeholder="MM/YY" maxlength="5" style="background: rgba(255,255,255,0.03); border: 1px solid var(--glass-border); padding: 1.25rem; border-radius: 20px; color: white; font-size: 1.1rem; font-weight: 600;">
                                    </div>
                                    <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                                        <label style="font-size: 0.85rem; font-weight: 800; opacity: 0.6; letter-spacing: 1px;">CVV / CVC</label>
                                        <input type="password" name="card_cvv" placeholder="***" maxlength="4" style="background: rgba(255,255,255,0.03); border: 1px solid var(--glass-border); padding: 1.25rem; border-radius: 20px; color: white; font-size: 1.1rem; font-weight: 600;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Final Review -->
                <div class="glass-card animate-fade-in" style="padding: 4rem; position: sticky; top: 10rem; border-radius: 40px; border-color: var(--primary);">
                    <h3 style="margin-bottom: 3rem; font-weight: 900; font-family: 'Outfit'; font-size: 1.8rem; letter-spacing: -1px;">Acquisition Review</h3>
                    
                    <div style="display: flex; flex-direction: column; gap: 2rem; margin-bottom: 3.5rem; max-height: 400px; overflow-y: auto; padding-right: 1.5rem;">
                        @foreach($cartItems as $item)
                        <div style="display: flex; justify-content: space-between; align-items: center; gap: 2rem;">
                            <div style="display: flex; align-items: center; gap: 1.5rem;">
                                <div style="width: 60px; height: 60px; border-radius: 12px; overflow: hidden; background: white; padding: 0.5rem; flex-shrink: 0; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                                    @php $pImg = $item->product->images->first(); @endphp
                                    <img src="{{ $pImg ? (str_starts_with($pImg->image_url, 'http') ? $pImg->image_url : asset('storage/'.$pImg->image_url)) : 'https://placehold.co/100x100/F1F5F9/0F172A?text=PC' }}" style="width: 100%; height: 100%; object-fit: contain;">
                                </div>
                                <div style="overflow: hidden;">
                                    <div style="font-weight: 800; font-size: 1rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 180px;">{{ $item->product->name }}</div>
                                    <div style="font-size: 0.8rem; opacity: 0.5; font-weight: 700;">UNIT COUNT: {{ $item->quantity }}</div>
                                </div>
                            </div>
                            <div style="font-weight: 900; font-family: 'Outfit'; font-size: 1.1rem; color: var(--primary);">${{ number_format($item->product->price * $item->quantity, 2) }}</div>
                        </div>
                        @endforeach
                    </div>

                    <div style="border-top: 1px solid var(--glass-border); padding-top: 2.5rem; margin-bottom: 3.5rem;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                            <div style="font-weight: 900; font-size: 1.1rem; opacity: 0.5;">TOTAL INVESTMENT</div>
                            @php $total = $cartItems->sum(fn($i) => $i->product->price * $i->quantity); @endphp
                            <div class="text-gradient" style="font-size: 3rem; font-weight: 900; font-family: 'Outfit'; line-height: 1;">${{ number_format($total, 2) }}</div>
                        </div>
                    </div>

                    <button type="submit" id="submit-btn" class="btn btn-primary" style="width: 100%; padding: 1.5rem; font-size: 1.3rem; font-weight: 900; border-radius: 20px; box-shadow: 0 20px 40px rgba(var(--primary-rgb), 0.3);">Authorize Acquisition</button>
                    
                    <div style="display: flex; align-items: center; justify-content: center; gap: 0.8rem; margin-top: 2.5rem; opacity: 0.4;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        <span style="font-size: 0.8rem; font-weight: 800; letter-spacing: 1px;">ENCRYPTED BY ELITE SECURITY</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Bakong Modal (Elite Redesign) -->
<div id="bakong-modal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.9); backdrop-filter: blur(25px); z-index: 9999; align-items: center; justify-content: center; padding: 2rem;">
    <div class="glass-card" style="background: white; color: black; padding: 4rem; text-align: center; max-width: 500px; width: 100%; box-shadow: 0 40px 100px -20px rgba(0,0,0,0.8); border-radius: 50px; border-color: #eab308;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
            <div style="color: #eab308; font-weight: 900; font-size: 2.2rem; font-family: 'Outfit'; letter-spacing: -1px;">BAKONG <span style="color: #cbd5e1; font-weight: 400;">CORE</span></div>
            <button onclick="closeBakongModal()" style="background: #f1f5f9; border: none; width: 44px; height: 44px; border-radius: 12px; font-size: 1.5rem; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: 0.3s;" onmouseover="this.style.background='#fee2e2'; this.style.color='#ef4444'">&times;</button>
        </div>
        
        <p style="opacity: 0.6; margin-bottom: 3rem; font-size: 1.1rem; font-weight: 600; line-height: 1.5;">Execute secure KHQR scan via your financial institution to finalize the acquisition.</p>
        
        <div id="qr-container" style="width: 320px; height: 320px; background: white; margin: 0 auto 3rem auto; padding: 1.5rem; border: 2px solid #f1f5f9; border-radius: 32px; display: flex; align-items: center; justify-content: center; position: relative; box-shadow: 0 20px 40px rgba(0,0,0,0.05);">
            <div id="qr-loader" style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; background: white; border-radius: 30px;">
                <div class="loader"></div>
            </div>
            <img id="qr-image" src="" style="width: 100%; height: 100%; object-fit: contain; display: none;">
        </div>

        <div style="background: #f8fafc; padding: 2.5rem; border-radius: 24px; margin-bottom: 3rem; border: 1px solid #f1f5f9;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <span style="font-size: 0.8rem; font-weight: 800; color: #64748b; letter-spacing: 1px;">TOTAL SETTLEMENT</span>
                <span id="payment-status-badge" style="background: #eab308; color: white; padding: 0.5rem 1.2rem; border-radius: 50px; font-size: 0.75rem; font-weight: 900; letter-spacing: 1px;">POLLING...</span>
            </div>
            <div style="font-weight: 900; font-size: 2.5rem; font-family: 'Outfit'; color: #0f172a; text-align: left;" id="display-amount">$0.00</div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <a id="bakong-deeplink" href="#" class="btn btn-primary" style="width: 100%; background: #eab308; padding: 1.5rem; font-size: 1.1rem; font-weight: 900; border-radius: 20px; box-shadow: 0 15px 30px rgba(234, 179, 8, 0.3); display: none;">Open Merchant App</a>
            
            @if(config('app.debug'))
            <button type="button" onclick="simulateBakongSuccess()" style="background: transparent; border: 1px dashed #cbd5e1; color: #94a3b8; padding: 1rem; border-radius: 16px; font-size: 0.8rem; font-weight: 800; cursor: pointer; transition: 0.3s;" onmouseover="this.style.borderColor='#eab308'; this.style.color='#eab308';">
                [DEV] SIMULATE SUCCESSFUL ACQUISITION
            </button>
            @endif

            <p style="font-size: 0.85rem; font-weight: 700; color: #94a3b8; letter-spacing: 0.5px;">ElitePC Secure Transaction Node: ACTIVE</p>
        </div>
    </div>
</div>

<style>
    .loader {
        width: 56px;
        height: 56px;
        border: 6px solid #f1f5f9;
        border-bottom-color: #eab308;
        border-radius: 50%;
        display: inline-block;
        box-sizing: border-box;
        animation: rotation 1s linear infinite;
    }
    @keyframes rotation {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .glass-card input[type="radio"]:checked + div {
        color: var(--primary) !important;
    }
</style>

<script>
    let pollInterval = null;
    const paymentAccountId = "{{ $paymentAccount->id ?? '' }}";

    // Virtual Card Live Sync
    const cardNameInput = document.getElementById('card_name_input');
    const cardNumberInput = document.getElementById('card_number_input');
    const cardExpiryInput = document.getElementById('card_expiry_input');
    
    const vCardName = document.getElementById('v-card-name');
    const vCardNumber = document.getElementById('v-card-number');
    const vCardExpiry = document.getElementById('v-card-expiry');

    if(cardNameInput) {
        cardNameInput.addEventListener('input', (e) => {
            vCardName.innerText = e.target.value || 'YOUR NAME';
        });
    }

    if(cardNumberInput) {
        cardNumberInput.addEventListener('input', (e) => {
            let val = e.target.value.replace(/\D/g, '');
            let formatted = val.match(/.{1,4}/g)?.join(' ') || '';
            e.target.value = formatted;
            vCardNumber.innerText = formatted || '•••• •••• •••• ••••';
        });
    }

    if(cardExpiryInput) {
        cardExpiryInput.addEventListener('input', (e) => {
            let val = e.target.value.replace(/\D/g, '');
            if(val.length >= 2) {
                val = val.substring(0, 2) + '/' + val.substring(2, 4);
            }
            e.target.value = val;
            vCardExpiry.innerText = val || 'MM/YY';
        });
    }

    function updatePaymentUI() {
        const methods = ['cod', 'card', 'bakong'];
        const cardDetails = document.getElementById('card-details');
        
        methods.forEach(m => {
            const label = document.getElementById(`label-${m}`);
            const input = label.querySelector('input');
            if (input.checked) {
                label.style.borderColor = (m === 'bakong') ? '#eab308' : 'var(--primary)';
                label.style.background = (m === 'bakong') ? 'rgba(234, 179, 8, 0.05)' : 'rgba(99, 102, 241, 0.05)';
                label.style.transform = 'translateY(-5px)';
                
                if (m === 'card') {
                    cardDetails.style.display = 'flex';
                } else {
                    cardDetails.style.display = 'none';
                }
            } else {
                label.style.borderColor = 'var(--glass-border)';
                label.style.background = 'transparent';
                label.style.transform = 'translateY(0)';
            }
        });
    }
    updatePaymentUI();

    function closeBakongModal() {
        document.getElementById('bakong-modal').style.display = 'none';
        if (pollInterval) clearInterval(pollInterval);
        const submitBtn = document.getElementById('submit-btn');
        submitBtn.disabled = false;
        submitBtn.innerHTML = 'Authorize Acquisition';
    }

    document.getElementById('checkout-form').onsubmit = async function(e) {
        e.preventDefault();
        const method = document.querySelector('input[name="payment_method"]:checked').value;
        const submitBtn = document.getElementById('submit-btn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="loader" style="width: 20px; height: 20px; border-width: 3px; border-bottom-color: white;"></span> Syncing...';

        const formData = new FormData(this);
        
        try {
            const response = await fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: { 
                    'Accept': 'application/json', 
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const data = await response.json();
            console.log("[EPC] Tactical Handshake Data:", data);

            if (data.status === 'pay_now') {
                console.log("[EPC] Activating Bakong Modal for Order:", data.order_id);
                initiateBakongPayment(data.order_id);
            } else if (method === 'card') {
                submitBtn.innerHTML = '<span class="loader" style="width: 20px; height: 20px; border-width: 3px; border-bottom-color: white;"></span> Verifying...';
                setTimeout(() => {
                    window.location.href = data.redirect || "{{ route('order.success', ':id') }}".replace(':id', data.order_id || '');
                }, 2000);
            } else if (data.redirect) {
                window.location.href = data.redirect;
            } else if (response.ok) {
                 window.location.href = "{{ route('home') }}";
            }
        } catch (err) {
            console.error("[EPC] Handshake Error:", err);
            alert('Security handshake failed. Please check console for telemetry.');
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Authorize Acquisition';
        }
    };

    async function initiateBakongPayment(orderId) {
        const modal = document.getElementById('bakong-modal');
        modal.style.display = 'flex'; // ACTIVATE IMMEDIATELY
        document.getElementById('qr-loader').style.display = 'flex';
        document.getElementById('qr-image').style.display = 'none';
        document.getElementById('bakong-deeplink').style.display = 'none';

        try {
            console.log("[EPC] Requesting QR from Bakong Node...");
            const response = await fetch("{{ route('bakong.generate') }}", {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json', 
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    order_id: orderId,
                    currency: 'USD',
                    payment_account_id: paymentAccountId
                })
            });
            const result = await response.json();

            if (result.success) {
                const data = result.data;
                document.getElementById('qr-image').src = data.qr_image;
                document.getElementById('qr-image').style.display = 'block';
                document.getElementById('qr-loader').style.display = 'none';
                document.getElementById('display-amount').innerHTML = (data.currency === 'USD' ? '$' : '៛') + parseFloat(data.amount).toLocaleString();
                
                if (data.deeplink) {
                    const deeplinkBtn = document.getElementById('bakong-deeplink');
                    deeplinkBtn.href = data.deeplink;
                    deeplinkBtn.style.display = 'block';
                }

                startPolling(data.md5, orderId);
            }
        } catch (err) {
            console.error(err);
            alert('Bakong node connection lost.');
        }
    }

    async function simulateBakongSuccess() {
        const orderId = document.getElementById('display-amount').dataset.orderId;
        if (!confirm('DEBUG: Simulate successful payment for order #' + orderId + '?')) return;
        
        clearInterval(pollInterval);
        document.getElementById('payment-status-badge').innerHTML = 'SIMULATING...';
        
        try {
            const response = await fetch("{{ route('bakong.simulate') }}", {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json', 
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ order_id: orderId })
            });
            const result = await response.json();
            
            if (result.success) {
                document.getElementById('payment-status-badge').innerHTML = 'VERIFIED [DEV]';
                document.getElementById('payment-status-badge').style.background = '#10b981';
                setTimeout(() => {
                    window.location.href = `/order/success/${orderId}`;
                }, 1500);
            }
        } catch (err) {
            console.error(err);
            alert('Simulation failed.');
        }
    }

    function startPolling(md5, orderId) {
        document.getElementById('display-amount').dataset.orderId = orderId;
        if (pollInterval) clearInterval(pollInterval);
        
        pollInterval = setInterval(async () => {
            try {
                const response = await fetch("{{ route('bakong.check') }}", {
                    method: 'POST',
                    headers: { 
                        'Content-Type': 'application/json', 
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ md5: md5 })
                });
                const result = await response.json();

                if (result.success && result.status === 'success') {
                    clearInterval(pollInterval);
                    document.getElementById('payment-status-badge').innerHTML = 'VERIFIED';
                    document.getElementById('payment-status-badge').style.background = '#10b981';
                    
                    setTimeout(() => {
                        window.location.href = `/order/success/${orderId}`;
                    }, 1500);
                }
            } catch (err) {
                console.error('Network latency:', err);
            }
        }, 3000);
    }
</script>
@endsection
