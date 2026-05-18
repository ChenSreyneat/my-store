@extends('layouts.dashboard')

@section('title', 'Hardware Taxonomies - Admin')

@section('content')
<section style="padding: 2rem 0;">
    <div style="margin-bottom: 5rem;">
        <h1 style="font-size: clamp(2.5rem, 6vw, 4rem); font-weight: 900; font-family: 'Outfit'; letter-spacing: -2px; line-height: 1; margin-bottom: 1.5rem;">Hardware <span class="text-gradient">Taxonomies</span></h1>
        <p style="opacity: 0.6; font-size: 1.1rem; font-weight: 600;">Define and manage computer classifications across the ElitePC ecosystem.</p>
    </div>

    <!-- Create/Update Form -->
    <div class="glass-card" style="padding: 3rem; margin-bottom: 4rem; border-color: var(--primary);">
        <h3 style="margin-bottom: 2.5rem; font-weight: 900; font-family: 'Outfit';">{{ $editingType ? 'Update Classification' : 'Define New Classification' }}</h3>
        <form action="{{ $editingType ? route('admin.product_types.update', $editingType->id) : route('admin.product_types.store') }}" method="POST" style="display: flex; gap: 2rem; align-items: flex-end;">
            @csrf
            @if($editingType) @method('PUT') @endif
            <div style="flex: 1; display: flex; flex-direction: column; gap: 0.8rem;">
                <label style="font-size: 0.75rem; font-weight: 800; letter-spacing: 1.5px; opacity: 0.6;">CLASSIFICATION IDENTITY</label>
                <input type="text" name="name" value="{{ $editingType->name ?? '' }}" required placeholder="e.g. Workstation" style="background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); padding: 1.2rem; border-radius: 16px; color: white; width: 100%; outline: none; transition: 0.3s;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--glass-border)'">
            </div>
            <button type="submit" class="btn btn-primary" style="padding: 1.2rem 3rem; border-radius: 16px; font-weight: 800;">
                {{ $editingType ? 'Sync Changes' : 'Register Type' }}
            </button>
            @if($editingType)
                <a href="{{ route('admin.product_types') }}" class="btn" style="background: var(--glass-bg); padding: 1.2rem 3rem; border-radius: 16px;">Abort</a>
            @endif
        </form>
    </div>

    <!-- Types Matrix -->
    <div class="glass-card" style="padding: 0; overflow: hidden; border-radius: 40px;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: rgba(255,255,255,0.02); border-bottom: 1px solid var(--glass-border);">
                    <th style="padding: 2rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">TAXONOMY IDENTITY</th>
                    <th style="padding: 2rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">DATA ARCHIVE</th>
                    <th style="padding: 2rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; text-align: right;">OPERATIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($types as $type)
                <tr style="border-bottom: 1px solid var(--glass-border); transition: 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.01)'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 2rem;">
                        <div style="font-weight: 800; font-size: 1.1rem; letter-spacing: -0.5px;">{{ $type->name }}</div>
                        <div style="font-size: 0.75rem; opacity: 0.4; font-weight: 700; margin-top: 0.3rem;">ID: #{{ str_pad($type->id, 4, '0', STR_PAD_LEFT) }}</div>
                    </td>
                    <td style="padding: 2rem;">
                        <div style="font-size: 0.85rem; opacity: 0.6; font-weight: 600;">Registered: {{ $type->created_at->format('M d, Y') }}</div>
                    </td>
                    <td style="padding: 2rem; text-align: right;">
                        <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                            <a href="{{ route('admin.product_types', ['edit' => $type->id]) }}" class="glass" style="padding: 0.8rem 1.5rem; border-radius: 12px; text-decoration: none; font-size: 0.8rem; font-weight: 800; transition: 0.3s; border-color: rgba(99, 102, 241, 0.2); color: var(--primary);">EDIT</a>
                            <form action="{{ route('admin.product_types.destroy', $type->id) }}" method="POST" style="display: inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="glass" style="padding: 0.8rem 1.5rem; border-radius: 12px; border: 1px solid rgba(239, 68, 68, 0.2); color: #ef4444; background: none; font-size: 0.8rem; font-weight: 800; cursor: pointer; transition: 0.3s;" onmouseover="this.style.background='rgba(239, 68, 68, 0.1)'" onmouseout="this.style.background='none'">DELETE</button>
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
