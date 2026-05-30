@extends('layouts.dashboard')

@section('title', 'Hardware Taxonomies - Admin')

@section('content')
<section style="padding-bottom: 5rem; background: var(--bg);">
    <!-- Cohesive Header -->
    <div style="margin-bottom: 4rem; display: flex; justify-content: space-between; align-items: center;" class="header-stack">
        <div>
            <h1 style="font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 900; font-family: 'Outfit'; color: var(--text); letter-spacing: -1.5px; margin-bottom: 0.5rem; line-height: 1.2;">
                Hardware <span class="text-gradient">Taxonomies</span>
            </h1>
            <p style="color: var(--text-dim); font-size: 1rem; font-weight: 500;">Define and manage computer classifications across the ElitePC ecosystem.</p>
        </div>
        <div class="glass" style="padding: 0.6rem 1.5rem; border-radius: 50px; font-size: 0.75rem; font-weight: 800; color: var(--primary); letter-spacing: 1px; border-color: rgba(99,102,241,0.2); background: rgba(99,102,241,0.03);">
            TAXONOMIES
        </div>
    </div>

    <!-- Create/Update Form Top -->
    <div class="glass-card" style="padding: 2.5rem; background: #ffffff; border-color: rgba(15, 23, 42, 0.05); box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03); margin-bottom: 3rem;">
        <h3 style="margin-bottom: 2rem; font-weight: 900; font-family: 'Outfit'; color: var(--text);">
            {{ $editingType ? 'Update Classification' : 'Define New Classification' }}
        </h3>
        <form action="{{ $editingType ? route('admin.product_types.update', $editingType->id) : route('admin.product_types.store') }}" method="POST" class="form-grid-admin">
            @csrf
            @if($editingType) @method('PUT') @endif
            
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.6;">Classification Identity</label>
                <input type="text" name="name" value="{{ $editingType->name ?? '' }}" required placeholder="e.g. Workstation">
            </div>
            
            <div style="display: flex; gap: 1rem; align-items: flex-end;">
                <button type="submit" class="btn btn-primary" style="padding: 0.8rem 1.8rem; border-radius: 12px; font-weight: 700; height: 48px; flex: 1; justify-content: center;">
                    {{ $editingType ? 'Sync Changes' : 'Register Type' }}
                </button>
                @if($editingType)
                    <a href="{{ route('admin.product_types') }}" class="btn btn-outline" style="padding: 0.8rem 1.8rem; border-radius: 12px; font-weight: 700; height: 48px; flex: 1; display: flex; align-items: center; justify-content: center;">Abort</a>
                @endif
            </div>
        </form>
    </div>

    <!-- List Bottom -->
    <div class="glass-card" style="padding: 2.5rem; background: #ffffff; border-color: rgba(15, 23, 42, 0.05); box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03);">
        <h3 style="margin-bottom: 2rem; font-weight: 900; font-family: 'Outfit'; color: var(--text);">Existing Classifications</h3>
        <div class="table-container">
            <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 600px;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(15, 23, 42, 0.05);">
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Taxonomy Identity</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Data Archive</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; text-align: right;">Operations</th>
                </tr>
            </thead>
            <tbody>
                @foreach($types as $type)
                <tr style="border-bottom: 1px solid rgba(15, 23, 42, 0.05); transition: background 0.3s; {{ ($editingType && $editingType->id == $type->id) ? 'background: rgba(99, 102, 241, 0.04);' : '' }}" onmouseover="this.style.background='rgba(15, 23, 42, 0.01)'" onmouseout="this.style.background='{{ ($editingType && $editingType->id == $type->id) ? 'rgba(99, 102, 241, 0.04)' : 'transparent' }}'">
                    <td style="padding: 1.25rem 1.5rem;">
                        <div style="font-weight: 800; font-size: 1.05rem; color: var(--text);">{{ $type->name }}</div>
                        <div style="font-size: 0.75rem; color: var(--text-dim); font-weight: 700; margin-top: 0.2rem;">ID: #{{ str_pad($type->id, 4, '0', STR_PAD_LEFT) }}</div>
                    </td>
                    <td style="padding: 1.25rem 1.5rem;">
                        <div style="font-size: 0.85rem; color: var(--text-dim); font-weight: 600;">Registered: {{ $type->created_at->format('M d, Y') }}</div>
                    </td>
                    <td style="padding: 1.25rem 1.5rem; text-align: right;">
                        <div style="display: flex; gap: 0.5rem; justify-content: flex-end; align-items: center;">
                            <a href="{{ route('admin.product_types', ['edit' => $type->id]) }}" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.75rem; border-radius: 8px; {{ ($editingType && $editingType->id == $type->id) ? 'border-color: var(--primary); color: var(--primary);' : '' }}">Edit</a>
                            <form action="{{ route('admin.product_types.destroy', $type->id) }}" method="POST" style="margin: 0; display: inline-block;">
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
