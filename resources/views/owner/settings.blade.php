@extends('layouts.dashboard')

@section('title', 'Settings - Owner')

@section('content')
<section style="padding-bottom: 5rem; font-family: 'Inter', sans-serif;">
    <!-- Profile Header -->
    <div style="margin-bottom: 5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h1 style="font-size: 2.5rem; font-weight: 800; color: #1e293b; margin-bottom: 0.5rem; line-height: 1.2;">
                Store Settings ⚙️
            </h1>
            <p style="color: #64748b; font-size: 1.05rem; margin: 0; font-weight: 500;">Manage your profile and store details.</p>
        </div>
        <div style="padding: 0.6rem 1.5rem; border-radius: 50px; font-size: 0.85rem; font-weight: 700; color: #10b981; background: #ecfdf5; border: 1px solid #d1fae5; box-shadow: 0 2px 10px rgba(16,185,129,0.1);">
            STATUS: ACTIVE
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 300px 1fr; gap: 3rem;" class="dynamic-grid">
        <!-- Sidebar Navigation -->
        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
            <div style="padding: 2.5rem; text-align: center; margin-bottom: 1.5rem; background: #ffffff; border-radius: 24px; border: 1px solid #f1f5f9; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                <div style="position: relative; width: 120px; height: 120px; margin: 0 auto 1.5rem;">
                    <img src="{{ Auth::user()->profile_image_url }}" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover; box-shadow: 0 10px 20px rgba(0,0,0,0.05);">
                    <div style="position: absolute; bottom: 0; right: 0; width: 36px; height: 36px; background: white; border: 2px solid #eef2ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #10b981; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"></path></svg>
                    </div>
                </div>
                <h3 style="font-weight: 800; font-size: 1.3rem; margin-bottom: 0.25rem; color: #1e293b; margin-top: 0;">{{ Auth::user()->name }}</h3>
                <p style="color: #64748b; font-size: 0.85rem; font-weight: 700; margin: 0;">STORE OWNER</p>
            </div>

            <button onclick="scrollToSection('info-section')" class="nav-btn active">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                Personal Info
            </button>
            <button onclick="scrollToSection('business-node-section')" class="nav-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                Store Details
            </button>
            <button onclick="scrollToSection('payment-accounts-section')" class="nav-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="5" width="20" height="14" rx="2"></rect><line x1="2" y1="10" x2="22" y2="10"></line></svg>
                Payment Accounts
            </button>
            <button onclick="scrollToSection('elite-support-section')" class="nav-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                Help & Support
            </button>
        </div>

        <!-- Main Content Area -->
        <div style="display: flex; flex-direction: column; gap: 3rem;">
            <!-- Identity Matrix -->
            <div id="info-section" style="padding: 3rem; background: #ffffff; border-radius: 24px; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem;">
                    <h2 style="font-weight: 800; font-size: 1.6rem; display: flex; align-items: center; gap: 1rem; color: #1e293b; margin: 0;">
                        <div style="width: 40px; height: 40px; background: #eef2ff; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #6366f1;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </div>
                        Personal Info
                    </h2>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" style="display: flex; flex-direction: column; gap: 2rem;">
                    @csrf @method('PATCH')
                    <div class="form-row-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                        <div class="input-group">
                            <label style="font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b;">Full Name</label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required style="padding: 1rem 1.2rem; border-radius: 16px; border: 1px solid #e2e8f0; font-size: 0.95rem; outline: none; transition: 0.2s; background: #f8fafc;" onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                            @error('name')
                                <span style="color: #ef4444; font-size: 0.75rem; font-weight: 700; margin-top: 0.5rem;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label style="font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b;">Email Address</label>
                            <input type="email" value="{{ Auth::user()->email }}" disabled style="padding: 1rem 1.2rem; border-radius: 16px; border: 1px solid #e2e8f0; font-size: 0.95rem; color: #94a3b8; background: #f1f5f9; cursor: not-allowed;">
                        </div>
                    </div>
                    <div style="display: flex; justify-content: flex-end; margin-top: 1rem;">
                        <button type="submit" style="padding: 0.9rem 2.5rem; border-radius: 50px; font-weight: 700; background: #6366f1; color: white; border: none; cursor: pointer; transition: 0.2s; box-shadow: 0 4px 15px rgba(99,102,241,0.3);" onmouseover="this.style.background='#4f46e5'" onmouseout="this.style.background='#6366f1'">Save Changes</button>
                    </div>
                </form>
            </div>

            <!-- Business Node -->
            <div id="business-node-section" style="padding: 3rem; background: #ffffff; border-radius: 24px; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem;">
                    <h2 style="font-weight: 800; font-size: 1.6rem; display: flex; align-items: center; gap: 1rem; color: #1e293b; margin: 0;">
                        <div style="width: 40px; height: 40px; background: #ecfdf5; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #10b981;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        </div>
                        Store Details
                    </h2>
                </div>

                <form action="{{ route('owner.settings.update') }}" method="POST" style="display: flex; flex-direction: column; gap: 2rem;">
                    @csrf
                    <div class="input-group">
                        <label style="font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b;">Store Name</label>
                        <input type="text" name="name" value="{{ $store->name }}" required style="padding: 1rem 1.2rem; border-radius: 16px; border: 1px solid #e2e8f0; font-size: 0.95rem; outline: none; transition: 0.2s; background: #f8fafc;" onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                    </div>

                    <div class="form-row-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                        <div class="input-group">
                            <label style="font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b;">Contact Email</label>
                            <input type="email" name="email" value="{{ $store->email }}" style="padding: 1rem 1.2rem; border-radius: 16px; border: 1px solid #e2e8f0; font-size: 0.95rem; outline: none; transition: 0.2s; background: #f8fafc;" onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                        </div>
                        <div class="input-group">
                            <label style="font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b;">Phone Number</label>
                            <input type="text" name="phone" value="{{ $store->phone }}" style="padding: 1rem 1.2rem; border-radius: 16px; border: 1px solid #e2e8f0; font-size: 0.95rem; outline: none; transition: 0.2s; background: #f8fafc;" onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                        </div>
                    </div>

                    <div class="input-group">
                        <label style="font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #6366f1;">Payment Account (Bakong)</label>
                        <select name="payment_account_id" style="padding: 1rem 1.2rem; border-radius: 16px; border: 1px solid #e0e7ff; font-size: 0.95rem; outline: none; transition: 0.2s; background: #f8fafc;" onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.1)'" onblur="this.style.borderColor='#e0e7ff'; this.style.boxShadow='none'">
                            <option value="">Select Payment Account</option>
                            @foreach($paymentAccounts as $account)
                            <option value="{{ $account->id }}" {{ $store->payment_account_id == $account->id ? 'selected' : '' }}>
                                {{ $account->account_id }} - {{ $account->currency }} ({{ $account->account_name }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group">
                        <label style="font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b;">Store Address</label>
                        <input type="text" name="address" value="{{ $store->address }}" style="padding: 1rem 1.2rem; border-radius: 16px; border: 1px solid #e2e8f0; font-size: 0.95rem; outline: none; transition: 0.2s; background: #f8fafc;" onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                    </div>

                    <div class="input-group">
                        <label style="font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b;">Store Description</label>
                        <textarea name="description" style="padding: 1rem 1.2rem; border-radius: 16px; border: 1px solid #e2e8f0; font-size: 0.95rem; outline: none; transition: 0.2s; background: #f8fafc; min-height: 120px; resize: vertical;" onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">{{ $store->description }}</textarea>
                    </div>

                    <div style="display: flex; justify-content: flex-end; margin-top: 1rem;">
                        <button type="submit" style="padding: 0.9rem 2.5rem; border-radius: 50px; font-weight: 700; background: #6366f1; color: white; border: none; cursor: pointer; transition: 0.2s; box-shadow: 0 4px 15px rgba(99,102,241,0.3);" onmouseover="this.style.background='#4f46e5'" onmouseout="this.style.background='#6366f1'">Save Store Details</button>
                    </div>
                </form>
            </div>

            <!-- Payment Accounts -->
            <div id="payment-accounts-section" style="padding: 3rem; background: #ffffff; border-radius: 24px; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem;">
                    <h2 style="font-weight: 800; font-size: 1.6rem; display: flex; align-items: center; gap: 1rem; color: #1e293b; margin: 0;">
                        <div style="width: 40px; height: 40px; background: #e0f2fe; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #0ea5e9;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="5" width="20" height="14" rx="2"></rect><line x1="2" y1="10" x2="22" y2="10"></line></svg>
                        </div>
                        Payment Accounts
                    </h2>
                </div>

                <div style="margin-bottom: 3rem;">
                    <h3 style="margin-bottom: 1.5rem; font-weight: 800; font-size: 1.1rem; color: #1e293b; margin-top: 0;">Add New Account</h3>
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
                        <button type="submit" style="padding: 0.9rem 1.5rem; border-radius: 12px; font-weight: 700; background: #10b981; color: white; border: none; cursor: pointer; transition: 0.2s; box-shadow: 0 4px 15px rgba(16,185,129,0.3); height: 48px; display: flex; align-items: center; justify-content: center;" onmouseover="this.style.background='#059669'" onmouseout="this.style.background='#10b981'">Register</button>
                    </form>
                </div>

                <div>
                    <h3 style="margin-bottom: 1.5rem; font-weight: 800; font-size: 1.1rem; color: #1e293b; margin-top: 0;">My Registered Accounts</h3>
                    <div style="background: #f8fafc; border-radius: 16px; border: 1px solid #e2e8f0; overflow: hidden;">
                        @foreach($paymentAccounts as $account)
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem 1.5rem; border-bottom: 1px solid #e2e8f0;">
                            <div>
                                <div style="font-weight: 700; color: #6366f1; font-size: 1rem;">{{ $account->account_id }}</div>
                                <div style="font-size: 0.85rem; color: #64748b; margin-top: 0.2rem;">{{ $account->account_name }} ({{ $account->currency }})</div>
                            </div>
                            <form action="{{ route('owner.payment_accounts.destroy', $account->id) }}" method="POST" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="padding: 0.5rem 1rem; font-size: 0.8rem; font-weight: 700; border-radius: 8px; color: #ef4444; background: #fef2f2; border: 1px solid #fee2e2; cursor: pointer; transition: 0.2s;" onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fef2f2'">Remove</button>
                            </form>
                        </div>
                        @endforeach
                        @if($paymentAccounts->isEmpty())
                        <div style="padding: 2rem; text-align: center; color: #64748b; font-weight: 600; font-size: 0.9rem;">
                            No payment accounts registered yet.
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Elite Support -->
            <div id="elite-support-section" style="padding: 3rem; background: #fffcfdf8; border-radius: 24px; border: 1px solid #fdf2f8; box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h2 style="font-weight: 800; font-size: 1.6rem; display: flex; align-items: center; gap: 1rem; color: #1e293b; margin: 0;">
                        <div style="width: 40px; height: 40px; background: #fdf2f8; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #ec4899;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                        </div>
                        Help & Support
                    </h2>
                </div>
                
                <p style="font-size: 1.05rem; line-height: 1.6; margin-bottom: 2.5rem; color: #64748b;">Need assistance with your store? Our support team is ready to help you resolve any issues.</p>
                
                <div style="display: flex; justify-content: flex-start;">
                    <a href="{{ route('contact') }}" style="padding: 0.9rem 2.5rem; border-radius: 50px; font-weight: 700; background: #ec4899; color: white; border: none; cursor: pointer; transition: 0.2s; text-decoration: none; box-shadow: 0 4px 15px rgba(236,72,153,0.3);" onmouseover="this.style.background='#db2777'" onmouseout="this.style.background='#ec4899'">Contact Support</a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .nav-btn {
        background: transparent;
        border: none;
        padding: 1.2rem 1.5rem;
        border-radius: 16px;
        color: #64748b;
        font-weight: 700;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 1.2rem;
        cursor: pointer;
        transition: 0.2s;
        text-align: left;
    }
    .nav-btn:hover {
        background: #f8fafc;
        color: #1e293b;
    }
    .nav-btn.active {
        background: #eef2ff;
        color: #6366f1;
    }
    .input-group {
        display: flex;
        flex-direction: column;
        gap: 0.6rem;
    }

    @media (max-width: 992px) {
        .dynamic-grid {
            grid-template-columns: 1fr !important;
            gap: 2rem !important;
        }
    }

    @media (max-width: 768px) {
        .form-row-grid {
            grid-template-columns: 1fr !important;
            gap: 1.5rem !important;
        }
    }
</style>

<script>
    function scrollToSection(id) {
        document.getElementById(id).scrollIntoView({ behavior: 'smooth', block: 'center' });
        
        // Update active nav button
        document.querySelectorAll('.nav-btn').forEach(btn => {
            btn.classList.remove('active');
            if (btn.getAttribute('onclick').includes(id)) {
                btn.classList.add('active');
            }
        });
    }

    // Auto update active nav on scroll
    window.addEventListener('scroll', () => {
        const sections = ['info-section', 'business-node-section', 'payment-accounts-section', 'elite-support-section'];
        let current = '';
        
        sections.forEach(s => {
            const el = document.getElementById(s);
            if (el) {
                const rect = el.getBoundingClientRect();
                if (rect.top <= 250) current = s;
            }
        });

        if (current) {
            document.querySelectorAll('.nav-btn').forEach(btn => {
                btn.classList.remove('active');
                if (btn.getAttribute('onclick').includes(current)) {
                    btn.classList.add('active');
                }
            });
        }
    });
</script>
@endsection
