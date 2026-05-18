@extends('layouts.dashboard')

@section('title', 'Manage Brands - Admin')

@section('content')
<section style="padding: 2rem 0;">
    <div class="container">
        <div style="margin-bottom: 4rem;">
            <h1 style="font-size: 3rem; font-weight: 800; font-family: 'Outfit';">Manage <span class="text-gradient">Brands</span></h1>
        </div>

        <!-- Create/Update Form Top -->
        <div class="glass" style="padding: 2rem; border-radius: 32px; margin-bottom: 3rem;">
            <h3 style="margin-bottom: 2rem; font-weight: 800;">
                {{ $editingBrand ? 'Update Brand' : 'Register New Brand' }}
            </h3>
            <form action="{{ $editingBrand ? route('admin.brands.update', $editingBrand->id) : route('admin.brands.store') }}" method="POST" class="dynamic-form" style="display: grid; grid-template-columns: 1fr 2fr auto auto; gap: 2rem; align-items: end;">
                @csrf
                @if($editingBrand) @method('PUT') @endif
                
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-weight: 700; opacity: 0.7;">Brand Name</label>
                    <input type="text" name="name" value="{{ $editingBrand->name ?? '' }}" required placeholder="e.g. NVIDIA" style="background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); padding: 1rem; border-radius: 12px; color: white; width: 100%;">
                </div>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-weight: 700; opacity: 0.7;">Official Website (Optional)</label>
                    <input type="url" name="website" value="{{ $editingBrand->website ?? '' }}" placeholder="https://..." style="background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); padding: 1rem; border-radius: 12px; color: white; width: 100%;">
                </div>
                <button type="submit" class="btn btn-primary" style="padding: 1rem 2rem;">
                    {{ $editingBrand ? 'Save Changes' : 'Add Brand' }}
                </button>
                @if($editingBrand)
                    <a href="{{ route('admin.brands') }}" class="btn btn-outline" style="padding: 1rem 2rem; display: flex; align-items: center; justify-content: center;">Cancel</a>
                @endif
            </form>
        </div>

        <!-- List Bottom -->
        <div class="glass" style="padding: 2rem; border-radius: 40px;">
            <h3 style="margin-bottom: 2rem; font-weight: 800;">Partner Brands</h3>
            <div class="table-responsive">
                <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 600px;">
                <thead>
                    <tr style="border-bottom: 1px solid var(--glass-border);">
                        <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Brand</th>
                        <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Website</th>
                        <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Status</th>
                        <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($brands as $brand)
                    <tr style="border-bottom: 1px solid var(--glass-border); {{ ($editingBrand && $editingBrand->id == $brand->id) ? 'background: rgba(var(--primary-rgb), 0.1);' : '' }}">
                        <td style="padding: 1.5rem; font-weight: 700; font-size: 1.1rem;">{{ $brand->name }}</td>
                        <td style="padding: 1.5rem;">
                            <a href="{{ $brand->website }}" target="_blank" style="color: var(--primary); text-decoration: none; opacity: 0.8;">{{ $brand->website ?: 'N/A' }}</a>
                        </td>
                        <td style="padding: 1.5rem;">
                            <span style="color: #10b981; font-weight: 700; font-size: 0.8rem;">ACTIVE</span>
                        </td>
                        <td style="padding: 1.5rem;">
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="{{ route('admin.brands', ['edit' => $brand->id]) }}" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.75rem; {{ ($editingBrand && $editingBrand->id == $brand->id) ? 'border-color: var(--primary); color: var(--primary);' : '' }}">Edit</a>
                                <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this brand?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.75rem; color: #ef4444; border-color: rgba(239,68,68,0.2);">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</section>
@endsection
