@extends('layouts.dashboard')

@section('title', 'User Management - Admin')

@section('content')
<section style="padding-bottom: 5rem; background: var(--bg);">
    <!-- Cohesive Header -->
    <div style="margin-bottom: 4rem; display: flex; justify-content: space-between; align-items: center;" class="header-stack">
        <div>
            <h1 style="font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 900; font-family: 'Outfit'; color: var(--text); letter-spacing: -1.5px; margin-bottom: 0.5rem; line-height: 1.2;">
                Manage <span class="text-gradient">{{ request()->role ? ucfirst(request()->role).'s' : 'All Operatives' }}</span>
            </h1>
            <p style="color: var(--text-dim); font-size: 1rem; font-weight: 500;">Oversee platform accounts and calibrate user access protocols.</p>
        </div>
        <div class="glass" style="padding: 0.6rem 1.5rem; border-radius: 50px; font-size: 0.75rem; font-weight: 800; color: var(--primary); letter-spacing: 1px; border-color: rgba(99,102,241,0.2); background: rgba(99,102,241,0.03);">
            TOTAL: {{ $users->total() }}
        </div>
    </div>

    @if($editingUser)
        <!-- User Update Form -->
        <div class="glass-card" style="padding: 2.5rem; background: #ffffff; border-color: rgba(15, 23, 42, 0.05); box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03); margin-bottom: 3rem;">
            <h3 style="margin-bottom: 2rem; font-weight: 900; font-family: 'Outfit'; color: var(--text);">Update User: <span class="text-gradient">{{ $editingUser->name }}</span></h3>
            <form action="{{ route('admin.users.update', $editingUser->id) }}" method="POST" class="form-grid-admin">
                @csrf
                @method('PUT')
                
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.6;">Full Name</label>
                    <input type="text" name="name" value="{{ $editingUser->name }}" required>
                </div>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.6;">Email Address</label>
                    <input type="email" name="email" value="{{ $editingUser->email }}" required>
                </div>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.6;">Account Role</label>
                    <select name="role" required>
                        <option value="user" {{ $editingUser->role == 'user' ? 'selected' : '' }}>User</option>
                        <option value="owner" {{ $editingUser->role == 'owner' ? 'selected' : '' }}>Store Owner</option>
                        <option value="admin" {{ $editingUser->role == 'admin' ? 'selected' : '' }}>Administrator</option>
                    </select>
                </div>
                <div style="display: flex; gap: 1rem; align-items: flex-end;">
                    <button type="submit" class="btn btn-primary" style="padding: 0.8rem 1.8rem; border-radius: 12px; font-weight: 700; height: 48px; flex: 1; justify-content: center;">Save</button>
                    <a href="{{ route('admin.users') }}" class="btn btn-outline" style="padding: 0.8rem 1.8rem; border-radius: 12px; font-weight: 700; height: 48px; flex: 1; display: flex; align-items: center; justify-content: center;">Cancel</a>
                </div>
            </form>
        </div>
    @endif

    <div class="glass-card" style="padding: 2.5rem; background: #ffffff; border-color: rgba(15, 23, 42, 0.05); box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03);">
        <h3 style="margin-bottom: 2rem; font-weight: 900; font-family: 'Outfit'; color: var(--text);">Registered Accounts</h3>
        <div class="table-container">
            <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 700px;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(15, 23, 42, 0.05);">
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">User Info</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Role</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Joined Date</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr style="border-bottom: 1px solid rgba(15, 23, 42, 0.05); transition: background 0.3s; {{ ($editingUser && $editingUser->id == $user->id) ? 'background: rgba(99, 102, 241, 0.04);' : '' }}" onmouseover="this.style.background='rgba(15, 23, 42, 0.01)'" onmouseout="this.style.background='{{ ($editingUser && $editingUser->id == $user->id) ? 'rgba(99, 102, 241, 0.04)' : 'transparent' }}'">
                    <td style="padding: 1.25rem 1.5rem;">
                        <div style="font-weight: 700; font-size: 1.05rem; color: var(--text);">{{ $user->name }}</div>
                        <div style="font-size: 0.8rem; color: var(--text-dim); margin-top: 0.2rem;">{{ $user->email }}</div>
                    </td>
                    <td style="padding: 1.25rem 1.5rem;">
                        @php
                            $roleStyles = [
                                'admin' => ['bg' => 'rgba(239, 68, 68, 0.08)', 'color' => '#ef4444'],
                                'owner' => ['bg' => 'rgba(16, 185, 129, 0.08)', 'color' => '#10b981'],
                                'user' => ['bg' => 'rgba(59, 130, 246, 0.08)', 'color' => '#3b82f6']
                            ];
                            $style = $roleStyles[$user->role] ?? ['bg' => 'rgba(148, 163, 184, 0.08)', 'color' => '#94a3b8'];
                        @endphp
                        <span style="padding: 0.35rem 0.8rem; border-radius: 50px; font-size: 0.72rem; font-weight: 800; background: {{ $style['bg'] }}; color: {{ $style['color'] }}; text-transform: uppercase; letter-spacing: 0.5px;">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td style="padding: 1.25rem 1.5rem; color: var(--text-dim); font-size: 0.9rem; font-weight: 500;">{{ $user->created_at->format('M d, Y') }}</td>
                    <td style="padding: 1.25rem 1.5rem; text-align: right;">
                        <div style="display: flex; gap: 0.5rem; justify-content: flex-end; align-items: center;">
                            <a href="{{ route('admin.users', ['edit' => $user->id]) }}" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.75rem; border-radius: 8px; {{ ($editingUser && $editingUser->id == $user->id) ? 'border-color: var(--primary); color: var(--primary);' : '' }}">Edit</a>
                            @if($user->id !== Auth::id())
                            <form action="{{ route('admin.users.impersonate', $user->id) }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.75rem; border-radius: 8px; font-weight: 700; height: 32px;">Login As</button>
                            </form>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.75rem; border-radius: 8px; color: #ef4444; border-color: rgba(239,68,68,0.15);">Delete</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div style="margin-top: 2rem;">
            {{ $users->withQueryString()->links() }}
        </div>
    </div>
</section>
@endsection
