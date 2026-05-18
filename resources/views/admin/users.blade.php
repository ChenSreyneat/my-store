@extends('layouts.dashboard')

@section('title', 'User Management - Admin')

@section('content')
<section>
    <div style="margin-bottom: 5rem;" class="flex-wrap-md header-stack">
        <div>
            <h1 style="font-size: clamp(2.5rem, 6vw, 4rem); font-weight: 900; font-family: 'Outfit'; letter-spacing: -2px; line-height: 1; margin-bottom: 1.5rem;">
                Manage <span class="text-gradient">{{ request()->role ? ucfirst(request()->role).'s' : 'All Operatives' }}</span>
            </h1>
            <p style="opacity: 0.6; font-size: 1.1rem; font-weight: 600;">Oversee platform accounts and calibrate user access protocols.</p>
        </div>
        <div class="glass" style="padding: 0.6rem 1.5rem; border-radius: 50px; font-size: 0.8rem; font-weight: 800; color: var(--primary); letter-spacing: 1px; border-color: var(--primary);">
            TOTAL: {{ $users->total() }}
        </div>
    </div>

    @if($editingUser)
        <!-- User Update Form -->
        <div class="glass" style="padding: 2.5rem; border-radius: 32px; margin-bottom: 3rem; border: 1px solid var(--primary);">
            <h3 style="margin-bottom: 2rem; font-weight: 800; color: var(--primary);">Update User: {{ $editingUser->name }}</h3>
            <form action="{{ route('admin.users.update', $editingUser->id) }}" method="POST" class="form-grid-admin">
                @csrf
                @method('PUT')
                
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-weight: 700; opacity: 0.7;">Full Name</label>
                    <input type="text" name="name" value="{{ $editingUser->name }}" required style="background: var(--glass-bg); border: 1px solid var(--glass-border); padding: 1rem; border-radius: 12px; color: var(--text); width: 100%;">
                </div>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-weight: 700; opacity: 0.7;">Email Address</label>
                    <input type="email" name="email" value="{{ $editingUser->email }}" required style="background: var(--glass-bg); border: 1px solid var(--glass-border); padding: 1rem; border-radius: 12px; color: var(--text); width: 100%;">
                </div>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-weight: 700; opacity: 0.7;">Account Role</label>
                    <select name="role" required style="background: var(--bg); border: 1px solid var(--glass-border); padding: 1rem; border-radius: 12px; color: var(--text); width: 100%;">
                        <option value="user" {{ $editingUser->role == 'user' ? 'selected' : '' }}>User</option>
                        <option value="owner" {{ $editingUser->role == 'owner' ? 'selected' : '' }}>Store Owner</option>
                        <option value="admin" {{ $editingUser->role == 'admin' ? 'selected' : '' }}>Administrator</option>
                    </select>
                </div>
                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn btn-primary" style="padding: 1rem 2rem; flex: 1;">Save</button>
                    <a href="{{ route('admin.users') }}" class="btn btn-outline" style="padding: 1rem 2rem; flex: 1; display: flex; align-items: center; justify-content: center;">Cancel</a>
                </div>
            </form>
        </div>
    @endif

    <div class="glass" style="padding: 2rem; border-radius: 40px;">
        <h3 style="margin-bottom: 2rem; font-weight: 800;">Registered Accounts</h3>
        <div class="table-responsive">
            <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 700px;">
            <thead>
                <tr style="border-bottom: 1px solid var(--glass-border);">
                    <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">User Info</th>
                    <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Role</th>
                    <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Joined Date</th>
                    <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr style="border-bottom: 1px solid var(--glass-border); {{ ($editingUser && $editingUser->id == $user->id) ? 'background: rgba(var(--primary-rgb), 0.1);' : '' }}">
                    <td style="padding: 1.5rem;">
                        <div style="font-weight: 700; font-size: 1.1rem;">{{ $user->name }}</div>
                        <div style="font-size: 0.8rem; opacity: 0.6;">{{ $user->email }}</div>
                    </td>
                    <td style="padding: 1.5rem;">
                        @php
                            $roleColors = [
                                'admin' => '#ef4444',
                                'owner' => '#10b981',
                                'user' => '#3b82f6'
                            ];
                            $color = $roleColors[$user->role] ?? '#94a3b8';
                        @endphp
                        <span style="padding: 0.3rem 0.8rem; border-radius: 50px; font-size: 0.75rem; font-weight: 800; border: 1px solid {{ $color }}; color: {{ $color }}; text-transform: uppercase;">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td style="padding: 1.5rem; opacity: 0.6;">{{ $user->created_at->format('M d, Y') }}</td>
                    <td style="padding: 1.5rem;">
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('admin.users', ['edit' => $user->id]) }}" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.75rem; {{ ($editingUser && $editingUser->id == $user->id) ? 'border-color: var(--primary); color: var(--primary);' : '' }}">Edit</a>
                            @if($user->id !== Auth::id())
                            <form action="{{ route('admin.users.impersonate', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn" style="padding: 0.5rem 1rem; font-size: 0.75rem; background: var(--primary); color: white; border: none; border-radius: 8px;">Login As</button>
                            </form>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.75rem; color: #ef4444; border-color: rgba(239,68,68,0.2);">Delete</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="margin-top: 2rem;">
            {{ $users->links() }}
        </div>
    </div>
</section>
@endsection
