@extends('layouts.dashboard')

@section('title', 'Manage Stores - Admin')

@section('content')
<section style="padding: 2rem 0;">
    <div class="container">
        <div style="margin-bottom: 4rem;">
            <h1 style="font-size: 3rem; font-weight: 800; font-family: 'Outfit';">Manage <span class="text-gradient">Stores</span></h1>
        </div>

        <!-- Create/Update Form Top -->
        <div class="glass" style="padding: 2rem; border-radius: 32px; margin-bottom: 3rem;">
            <h3 style="margin-bottom: 2rem; font-weight: 800;">
                {{ $editingStore ? 'Update Store' : 'Launch New Store' }}
            </h3>
            <form action="{{ $editingStore ? route('admin.stores.update', $editingStore->id) : route('admin.stores.store') }}" method="POST" class="dynamic-form form-grid-admin" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 2rem; align-items: end;">
                @csrf
                @if($editingStore) @method('PUT') @endif
                
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-weight: 700; opacity: 0.7;">Store Name</label>
                    <input type="text" name="name" value="{{ $editingStore->name ?? '' }}" required placeholder="e.g. ElitePC Central" style="background: var(--glass-bg); border: 1px solid var(--glass-border); padding: 1rem; border-radius: 12px; color: var(--text); width: 100%;">
                </div>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-weight: 700; opacity: 0.7;">Business Email</label>
                    <input type="email" name="email" value="{{ $editingStore->email ?? '' }}" required placeholder="store@example.com" style="background: var(--glass-bg); border: 1px solid var(--glass-border); padding: 1rem; border-radius: 12px; color: var(--text); width: 100%;">
                </div>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-weight: 700; opacity: 0.7;">Promote Owner</label>
                    <select name="owner_id" required style="background: var(--glass-bg); border: 1px solid var(--glass-border); padding: 1rem; border-radius: 12px; color: var(--text); width: 100%;">
                        @if($editingStore && $editingStore->owner)
                            <option value="{{ $editingStore->owner->id }}">{{ $editingStore->owner->name }} (Current)</option>
                        @endif
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>
                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn btn-primary" style="padding: 1rem 2rem; flex: 1;">
                        {{ $editingStore ? 'Save Changes' : 'Launch Store' }}
                    </button>
                    @if($editingStore)
                        <a href="{{ route('admin.stores') }}" class="btn btn-outline" style="padding: 1rem 2rem; display: flex; align-items: center; justify-content: center; flex: 1; color: var(--text);">Cancel</a>
                    @endif
                </div>
            </form>
        </div>

        <!-- List Bottom -->
        <div class="glass" style="padding: 2rem; border-radius: 40px;">
            <h3 style="margin-bottom: 2rem; font-weight: 800;">Registered Stores</h3>
            <div class="table-responsive">
                <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 600px;">
                <thead>
                    <tr style="border-bottom: 1px solid var(--glass-border);">
                        <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Store Name</th>
                        <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Owner</th>
                        <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Contact</th>
                        <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stores as $store)
                    <tr style="border-bottom: 1px solid var(--glass-border); {{ ($editingStore && $editingStore->id == $store->id) ? 'background: rgba(var(--primary-rgb), 0.1);' : '' }}">
                        <td style="padding: 1.5rem; font-weight: 700; font-size: 1.1rem;">{{ $store->name }}</td>
                        <td style="padding: 1.5rem;">
                            <div style="font-weight: 600;">{{ $store->owner->name ?? 'No Owner' }}</div>
                        </td>
                        <td style="padding: 1.5rem; opacity: 0.7;">{{ $store->email }}</td>
                        <td style="padding: 1.5rem;">
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="{{ route('admin.stores', ['edit' => $store->id]) }}" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.75rem; {{ ($editingStore && $editingStore->id == $store->id) ? 'border-color: var(--primary); color: var(--primary);' : '' }}">Edit</a>
                                @if($store->owner)
                                <form action="{{ route('admin.users.impersonate', $store->owner->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn" style="padding: 0.5rem 1rem; font-size: 0.75rem; background: var(--primary); color: white; border: none; border-radius: 8px;">Login As</button>
                                </form>
                                @endif
                                <form action="{{ route('admin.stores.destroy', $store->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this store? This will demote the owner.')">
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
    </div>
</section>
@endsection
