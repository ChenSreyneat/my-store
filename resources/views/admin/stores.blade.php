@extends('layouts.dashboard')

@section('title', 'Manage Stores - Admin')

@section('content')
<section style="padding-bottom: 5rem; background: var(--bg);">
    <!-- Cohesive Header -->
    <div style="margin-bottom: 4rem; display: flex; justify-content: space-between; align-items: center;" class="header-stack">
        <div>
            <h1 style="font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 900; font-family: 'Outfit'; color: var(--text); letter-spacing: -1.5px; margin-bottom: 0.5rem; line-height: 1.2;">
                Manage <span class="text-gradient">Stores</span>
            </h1>
            <p style="color: var(--text-dim); font-size: 1rem; font-weight: 500;">Calibrate store entities and merchant authorizations.</p>
        </div>
        <div class="glass" style="padding: 0.6rem 1.5rem; border-radius: 50px; font-size: 0.75rem; font-weight: 800; color: var(--primary); letter-spacing: 1px; border-color: rgba(99,102,241,0.2); background: rgba(99,102,241,0.03);">
            TOTAL: {{ $stores->count() }}
        </div>
    </div>

    <!-- Create/Update Form Top -->
    <div class="glass-card" style="padding: 2.5rem; background: #ffffff; border-color: rgba(15, 23, 42, 0.05); box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03); margin-bottom: 3rem;">
        <h3 style="margin-bottom: 2rem; font-weight: 900; font-family: 'Outfit'; color: var(--text);">
            {{ $editingStore ? 'Update Store' : 'Launch New Store' }}
        </h3>
        <form action="{{ $editingStore ? route('admin.stores.update', $editingStore->id) : route('admin.stores.store') }}" method="POST" class="form-grid-admin">
            @csrf
            @if($editingStore) @method('PUT') @endif
            
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.6;">Store Name</label>
                <input type="text" name="name" value="{{ $editingStore->name ?? '' }}" required placeholder="e.g. ElitePC Central">
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.6;">Business Email</label>
                <input type="email" name="email" value="{{ $editingStore->email ?? '' }}" required placeholder="store@example.com">
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.6;">Promote Owner</label>
                <select name="owner_id" required>
                    @if($editingStore && $editingStore->owner)
                        <option value="{{ $editingStore->owner->id }}">{{ $editingStore->owner->name }} (Current)</option>
                    @endif
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>
            <div style="display: flex; gap: 1rem; align-items: flex-end;">
                <button type="submit" class="btn btn-primary" style="padding: 0.8rem 1.8rem; border-radius: 12px; font-weight: 700; height: 48px; flex: 1; justify-content: center;">
                    {{ $editingStore ? 'Save Changes' : 'Launch Store' }}
                </button>
                @if($editingStore)
                    <a href="{{ route('admin.stores') }}" class="btn btn-outline" style="padding: 0.8rem 1.8rem; border-radius: 12px; font-weight: 700; height: 48px; flex: 1; display: flex; align-items: center; justify-content: center;">Cancel</a>
                @endif
            </div>
        </form>
    </div>

    <!-- List Bottom -->
    <div class="glass-card" style="padding: 2.5rem; background: #ffffff; border-color: rgba(15, 23, 42, 0.05); box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03);">
        <h3 style="margin-bottom: 2rem; font-weight: 900; font-family: 'Outfit'; color: var(--text);">Registered Stores</h3>
        <div class="table-container">
            <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 600px;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(15, 23, 42, 0.05);">
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Store Name</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Owner</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Contact</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stores as $store)
                <tr style="border-bottom: 1px solid rgba(15, 23, 42, 0.05); transition: background 0.3s; {{ ($editingStore && $editingStore->id == $store->id) ? 'background: rgba(99, 102, 241, 0.04);' : '' }}" onmouseover="this.style.background='rgba(15, 23, 42, 0.01)'" onmouseout="this.style.background='{{ ($editingStore && $editingStore->id == $store->id) ? 'rgba(99, 102, 241, 0.04)' : 'transparent' }}'">
                    <td style="padding: 1.25rem 1.5rem; font-weight: 700; font-size: 1.05rem; color: var(--text);">{{ $store->name }}</td>
                    <td style="padding: 1.25rem 1.5rem;">
                        <div style="font-weight: 600; color: var(--text);">{{ $store->owner->name ?? 'No Owner' }}</div>
                    </td>
                    <td style="padding: 1.25rem 1.5rem; color: var(--text-dim); font-size: 0.9rem; font-weight: 500;">{{ $store->email }}</td>
                    <td style="padding: 1.25rem 1.5rem; text-align: right;">
                        <div style="display: flex; gap: 0.5rem; justify-content: flex-end; align-items: center;">
                            <a href="{{ route('admin.stores', ['edit' => $store->id]) }}" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.75rem; border-radius: 8px; {{ ($editingStore && $editingStore->id == $store->id) ? 'border-color: var(--primary); color: var(--primary);' : '' }}">Edit</a>
                            @if($store->owner)
                            <form action="{{ route('admin.users.impersonate', $store->owner->id) }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.75rem; border-radius: 8px; font-weight: 700; height: 32px;">Login As</button>
                            </form>
                            @endif
                            <form action="{{ route('admin.stores.destroy', $store->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this store? This will demote the owner.')" style="margin: 0;">
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
