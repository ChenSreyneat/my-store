@extends('layouts.dashboard')

@section('title', 'Profile Hub - ElitePC')

@section('content')
<section style="padding-bottom: 5rem; max-width: 1000px; margin: 0 auto; font-family: 'Inter', sans-serif;">
    
    <!-- Profile Header (Like Image: Welcome, Name) -->
    <div style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 style="font-size: 1.8rem; font-weight: 700; color: #1e293b; margin-bottom: 0.3rem; letter-spacing: -0.5px;">Welcome, {{ explode(' ', Auth::user()->name)[0] }}</h1>
            <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">{{ now()->format('D, d F Y') }}</p>
        </div>
    </div>

    <!-- Main Card Container -->
    <div style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 25px rgba(0,0,0,0.03); border: 1px solid #f1f5f9;">
        
        <!-- Gradient Banner -->
        <div style="height: 160px; background: linear-gradient(100deg, #dbeafe 0%, #fef08a 50%, #fdf4ff 100%); width: 100%; opacity: 0.8;"></div>
        
        <div style="padding: 2rem 3rem 4rem 3rem;">
            
            <!-- Hidden Image Form -->
            <form id="avatar-form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                @csrf @method('PATCH')
                <input type="file" id="profile_image_input" name="profile_image" accept="image/*" onchange="document.getElementById('avatar-form').submit()">
                <input type="hidden" name="name" value="{{ Auth::user()->name }}">
            </form>

            <!-- Profile Info Row -->
            <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; gap: 1rem; margin-top: -65px; margin-bottom: 3.5rem;">
                <div style="display: flex; gap: 1.5rem; align-items: flex-end;">
                    <div style="position: relative; width: 110px; height: 110px;">
                        <img src="{{ Auth::user()->profile_image_url }}" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover; border: 4px solid white; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                        <label for="profile_image_input" style="position: absolute; bottom: 5px; right: 0px; width: 30px; height: 30px; background: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                        </label>
                    </div>
                    <div style="padding-bottom: 12px;">
                        <h2 style="font-weight: 700; font-size: 1.3rem; color: #0f172a; margin: 0 0 0.2rem 0; letter-spacing: -0.5px;">{{ Auth::user()->name }}</h2>
                        <p style="color: #64748b; font-size: 0.9rem; margin: 0;">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                
                <button form="profile-update-form" type="submit" class="btn-edit" style="margin-top: 65px;">
                    Edit
                </button>
            </div>

            <!-- Identity & Logistics Form -->
            <form id="profile-update-form" action="{{ route('profile.update') }}" method="POST">
                @csrf @method('PATCH')
                
                <div class="responsive-grid-2">
                    
                    <div class="input-field">
                        <label>Operative Name</label>
                        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" placeholder="Your Name">
                        @error('name')<span class="error-text">{{ $message }}</span>@enderror
                    </div>
                    
                    <div class="input-field">
                        <label>Role</label>
                        <input type="text" value="{{ strtoupper(Auth::user()->role) }}" disabled style="cursor: not-allowed; opacity: 0.7;">
                    </div>
                    
                    <div class="input-field">
                        <label>Contact Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}" placeholder="Your Phone Number">
                        @error('phone')<span class="error-text">{{ $message }}</span>@enderror
                    </div>
                    
                    <div class="input-field">
                        <label>Deployment Target (Address)</label>
                        <input type="text" name="address" value="{{ old('address', Auth::user()->address) }}" placeholder="Your Address">
                        @error('address')<span class="error-text">{{ $message }}</span>@enderror
                    </div>

                </div>
            </form>

            <div style="margin-top: 3.5rem;">
                <h3 style="font-size: 0.95rem; font-weight: 600; color: #1e293b; margin-bottom: 1.5rem;">My email Address</h3>
                
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: #eff6ff; display: flex; align-items: center; justify-content: center; color: #3b82f6;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    </div>
                    <div>
                        <div style="color: #0f172a; font-weight: 500; font-size: 0.9rem; margin-bottom: 0.2rem;">{{ Auth::user()->email }}</div>
                        <div style="color: #94a3b8; font-size: 0.8rem;">Primary</div>
                    </div>
                </div>

                <div style="margin-bottom: 3.5rem;">
                    <button style="background: #eff6ff; color: #3b82f6; border: none; padding: 0.6rem 1.2rem; border-radius: 8px; font-weight: 500; font-size: 0.85rem; cursor: pointer;">
                        +Add Email Address
                    </button>
                </div>
            </div>

            <!-- Security Protocols Form -->
            <form action="{{ route('profile.password.update') }}" method="POST" style="border-top: 1px solid #f1f5f9; padding-top: 3.5rem;">
                @csrf @method('PATCH')
                
                <h3 style="font-size: 0.95rem; font-weight: 600; color: #1e293b; margin-bottom: 1.5rem;">Security Protocols</h3>
                
                <div class="responsive-grid-2">
                    <div class="input-field">
                        <label>Current Key</label>
                        <input type="password" name="current_password" placeholder="Current Password">
                        @error('current_password')<span class="error-text">{{ $message }}</span>@enderror
                    </div>
                    
                    <div class="input-field">
                        <!-- Empty spacer to align next fields to the left -->
                    </div>
                    
                    <div class="input-field">
                        <label>New Key</label>
                        <input type="password" name="password" placeholder="New Password">
                        @error('password')<span class="error-text">{{ $message }}</span>@enderror
                    </div>
                    
                    <div class="input-field">
                        <label>Confirm Key</label>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password">
                    </div>
                </div>
                
                <div style="margin-top: 2rem;">
                    <button type="submit" class="btn-edit" style="background: #f8fafc; color: #475569;">
                        Update Security
                    </button>
                </div>
            </form>

        </div>
    </div>
</section>

<style>
    /* Styling to match the clean, soft reference image */
    .btn-edit {
        background: #3b82f6;
        color: white;
        border: none;
        padding: 0.6rem 2rem;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.9rem;
        cursor: pointer;
        transition: 0.2s;
    }
    .btn-edit:hover {
        opacity: 0.9;
    }

    .input-field {
        display: flex;
        flex-direction: column;
    }
    .input-field label {
        font-size: 0.85rem;
        font-weight: 500;
        color: #475569;
        margin-bottom: 0.6rem;
        text-transform: capitalize;
        letter-spacing: normal;
        opacity: 1;
    }
    .input-field input, .input-field select {
        width: 100%;
        background: #f8fafc;
        border: none;
        padding: 0.9rem 1.2rem;
        border-radius: 8px;
        font-size: 0.9rem;
        color: #64748b;
        transition: background 0.2s;
        outline: none;
    }
    .input-field input::placeholder {
        color: #cbd5e1;
    }
    .input-field input:focus {
        background: #f1f5f9;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
    }
    
    .error-text {
        color: #ef4444;
        font-size: 0.75rem;
        font-weight: 500;
        margin-top: 0.4rem;
    }

    /* Reset some global layout styles locally */
    .glass { background: transparent; border: none; box-shadow: none; backdrop-filter: none; }
</style>

@endsection

