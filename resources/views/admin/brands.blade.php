@extends('layouts.dashboard')

@section('title', 'Manage Brands - Admin')

@section('content')
<section style="padding-bottom: 5rem; background: var(--bg);">
    <!-- Cohesive Header -->
    <div style="margin-bottom: 4rem; display: flex; justify-content: space-between; align-items: center;" class="header-stack">
        <div>
            <h1 style="font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 900; font-family: 'Outfit'; color: var(--text); letter-spacing: -1.5px; margin-bottom: 0.5rem; line-height: 1.2;">
                Manage <span class="text-gradient">Brands</span>
            </h1>
            <p style="color: var(--text-dim); font-size: 1rem; font-weight: 500;">Configure partner hardware brands and reference domains.</p>
        </div>
        <div class="glass" style="padding: 0.6rem 1.5rem; border-radius: 50px; font-size: 0.75rem; font-weight: 800; color: var(--primary); letter-spacing: 1px; border-color: rgba(99,102,241,0.2); background: rgba(99,102,241,0.03);">
            BRANDS: {{ $brands->count() }}
        </div>
    </div>

    <!-- Create/Update Form Top -->
    <div class="glass-card" style="padding: 2.5rem; background: #ffffff; border-color: rgba(15, 23, 42, 0.05); box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03); margin-bottom: 3rem;">
        <h3 style="margin-bottom: 2rem; font-weight: 900; font-family: 'Outfit'; color: var(--text);">
            {{ $editingBrand ? 'Update Brand' : 'Register New Brand' }}
        </h3>
        <form action="{{ $editingBrand ? route('admin.brands.update', $editingBrand->id) : route('admin.brands.store') }}" method="POST" class="form-grid-admin">
            @csrf
            @if($editingBrand) @method('PUT') @endif
            
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.6;">Brand Name</label>
                <input type="text" name="name" value="{{ $editingBrand->name ?? '' }}" required placeholder="e.g. NVIDIA">
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.6;">Official Website (Optional)</label>
                <input type="url" name="website" value="{{ $editingBrand->website ?? '' }}" placeholder="https://...">
            </div>
            <div style="display: flex; gap: 1rem; align-items: flex-end;">
                <button type="submit" class="btn btn-primary" style="padding: 0.8rem 1.8rem; border-radius: 12px; font-weight: 700; height: 48px; flex: 1; justify-content: center;">
                    {{ $editingBrand ? 'Save Changes' : 'Add Brand' }}
                </button>
                @if($editingBrand)
                    <a href="{{ route('admin.brands') }}" class="btn btn-outline" style="padding: 0.8rem 1.8rem; border-radius: 12px; font-weight: 700; height: 48px; flex: 1; display: flex; align-items: center; justify-content: center;">Cancel</a>
                @endif
            </div>
        </form>
    </div>

    <!-- List Bottom -->
    <div class="glass-card" style="padding: 2.5rem; background: #ffffff; border-color: rgba(15, 23, 42, 0.05); box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03);">
        <h3 style="margin-bottom: 2rem; font-weight: 900; font-family: 'Outfit'; color: var(--text);">Partner Brands</h3>
        <div class="table-container">
            <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 600px;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(15, 23, 42, 0.05);">
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Brand</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Website</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Status</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($brands as $brand)
                <tr style="border-bottom: 1px solid rgba(15, 23, 42, 0.05); transition: background 0.3s; {{ ($editingBrand && $editingBrand->id == $brand->id) ? 'background: rgba(99, 102, 241, 0.04);' : '' }}" onmouseover="this.style.background='rgba(15, 23, 42, 0.01)'" onmouseout="this.style.background='{{ ($editingBrand && $editingBrand->id == $brand->id) ? 'rgba(99, 102, 241, 0.04)' : 'transparent' }}'">
                    <td style="padding: 1.25rem 1.5rem; font-weight: 700; font-size: 1.05rem; color: var(--text);">{{ $brand->name }}</td>
                    <td style="padding: 1.25rem 1.5rem;">
                        @if($brand->website)
                            <a href="{{ $brand->website }}" target="_blank" style="color: var(--primary); text-decoration: none; opacity: 0.8; font-weight: 600;">{{ $brand->website }}</a>
                        @else
                            <span style="opacity: 0.5; font-size: 0.9rem;">N/A</span>
                        @endif
                    </td>
                    <td style="padding: 1.25rem 1.5rem;">
                        <span style="padding: 0.35rem 0.8rem; border-radius: 50px; font-size: 0.72rem; font-weight: 800; background: rgba(16, 185, 129, 0.08); color: #10b981; letter-spacing: 0.5px;">ACTIVE</span>
                    </td>
                    <td style="padding: 1.25rem 1.5rem; text-align: right;">
                        <div style="display: flex; gap: 0.5rem; justify-content: flex-end; align-items: center;">
                            <a href="{{ route('admin.brands', ['edit' => $brand->id]) }}" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.75rem; border-radius: 8px; {{ ($editingBrand && $editingBrand->id == $brand->id) ? 'border-color: var(--primary); color: var(--primary);' : '' }}">Edit</a>
                            <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this brand?')" style="margin: 0; display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.75rem; border-radius: 8px; color: #ef4444; border-color: rgba(239,68,68,0.15);">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</section>
@endsection
