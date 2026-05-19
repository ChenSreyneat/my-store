@extends('layouts.dashboard')

@section('title', 'Customer Matrix - Owner')

@section('content')
<section style="padding: 2rem 0;">
    <div style="margin-bottom: 5rem;" class="flex-wrap-md header-stack">
        <div>
            <h1 style="font-size: clamp(2.5rem, 6vw, 4rem); font-weight: 900; font-family: 'Outfit'; letter-spacing: -2px; line-height: 1; margin-bottom: 1.5rem;">User <span class="text-gradient">Manage</span></h1>
            <p style="opacity: 0.6; font-size: 1.1rem; font-weight: 600;">Monitor customer telemetry and track acquisition patterns across your store network.</p>
        </div>
        <div class="glass" style="padding: 0.6rem 1.5rem; border-radius: 50px; font-size: 0.8rem; font-weight: 800; color: var(--primary); letter-spacing: 1px; border-color: var(--primary);">
            TOTAL CLIENTS: {{ $users->count() }}
        </div>
    </div>

    <!-- Desktop Table View -->
    <div class="glass-card desktop-only" style="padding: 0; overflow: hidden; border-radius: 40px; display: none;">
        <div class="table-container">
            <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 900px;">
                <thead>
                    <tr style="background: rgba(255,255,255,0.02); border-bottom: 1px solid var(--glass-border);">
                        <th style="padding: 2rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">CLIENT IDENTITY</th>
                        <th style="padding: 2rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">ACQUISITIONS</th>
                        <th style="padding: 2rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">CONTACT LOGISTICS</th>
                        <th style="padding: 2rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">JOINED ELITEPC</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr style="border-bottom: 1px solid var(--glass-border); transition: 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.01)'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 2rem;">
                            <div style="display: flex; align-items: center; gap: 1.5rem;">
                                @if($user->profile_image)
                                    <img src="{{ asset('storage/'.$user->profile_image) }}" style="width: 50px; height: 50px; border-radius: 15px; object-fit: cover;">
                                @else
                                    <div style="width: 50px; height: 50px; background: var(--primary); border-radius: 15px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 900; font-size: 1.2rem;">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <div style="font-weight: 800; font-size: 1.1rem;">{{ $user->name }}</div>
                                    <div style="font-size: 0.8rem; opacity: 0.5; font-weight: 600;">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="padding: 2rem;">
                            <div class="glass" style="display: inline-flex; align-items: center; gap: 0.8rem; padding: 0.5rem 1rem; border-radius: 12px; border-color: rgba(99, 102, 241, 0.2);">
                                <span style="font-weight: 900; color: var(--primary);">{{ $user->orders_count }}</span>
                                <span style="font-size: 0.7rem; font-weight: 800; opacity: 0.6; letter-spacing: 0.5px;">ORDERS</span>
                            </div>
                        </td>
                        <td style="padding: 2rem;">
                            <div style="font-weight: 700; font-size: 0.95rem;">{{ $user->phone ?? 'N/A' }}</div>
                            <div style="font-size: 0.8rem; opacity: 0.5; font-weight: 600; max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $user->address ?? 'No Target Address' }}</div>
                        </td>
                        <td style="padding: 2rem;">
                            <div style="font-weight: 700; opacity: 0.8;">{{ $user->created_at->format('M d, Y') }}</div>
                            <div style="font-size: 0.75rem; opacity: 0.4; font-weight: 800;">{{ $user->created_at->diffForHumans() }}</div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="padding: 6rem; text-align: center; opacity: 0.4;">
                            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="margin-bottom: 1.5rem;"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            <div style="font-weight: 800; letter-spacing: 1px;">NO CUSTOMER DATA RECORDED</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Mobile Stacked Card View -->
    <div class="mobile-only" style="display: none;">
        <div style="display: flex; flex-direction: column; gap: 2rem;">
            @forelse($users as $user)
            <div class="glass-card" style="padding: 2.5rem; border-radius: 32px; position: relative;">
                <div style="display: flex; align-items: center; gap: 1.2rem; margin-bottom: 2rem;">
                    @if($user->profile_image)
                        <img src="{{ asset('storage/'.$user->profile_image) }}" style="width: 55px; height: 55px; border-radius: 16px; object-fit: cover;">
                    @else
                        <div style="width: 55px; height: 55px; background: var(--primary); border-radius: 16px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 900; font-size: 1.2rem;">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    @endif
                    <div>
                        <div style="font-weight: 900; font-size: 1.2rem; line-height: 1.2; margin-bottom: 0.3rem;">{{ $user->name }}</div>
                        <div style="font-size: 0.8rem; opacity: 0.5; font-weight: 600; word-break: break-all;">{{ $user->email }}</div>
                    </div>
                </div>
                
                <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 1.5rem; border-top: 1px solid var(--glass-border); margin-bottom: 1.5rem;">
                    <span style="opacity: 0.5; font-size: 0.75rem; font-weight: 800; letter-spacing: 1px;">ACQUISITIONS</span>
                    <div class="glass" style="display: inline-flex; align-items: center; gap: 0.8rem; padding: 0.4rem 0.8rem; border-radius: 10px; border-color: rgba(99, 102, 241, 0.2);">
                        <span style="font-weight: 900; color: var(--primary);">{{ $user->orders_count }}</span>
                        <span style="font-size: 0.65rem; font-weight: 800; opacity: 0.6; letter-spacing: 0.5px;">ORDERS</span>
                    </div>
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.5rem; margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid var(--glass-border);">
                    <span style="opacity: 0.5; font-size: 0.75rem; font-weight: 800; letter-spacing: 1px;">CONTACT LOGISTICS</span>
                    <div style="font-weight: 800; font-size: 0.95rem;">{{ $user->phone ?? 'N/A' }}</div>
                    <div style="font-size: 0.85rem; opacity: 0.5; font-weight: 600; line-height: 1.4;">{{ $user->address ?? 'No Target Address' }}</div>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="opacity: 0.4; font-size: 0.75rem; font-weight: 800; letter-spacing: 0.5px;">JOINED</span>
                    <div style="text-align: right;">
                        <div style="font-weight: 800; opacity: 0.8; font-size: 0.9rem;">{{ $user->created_at->format('M d, Y') }}</div>
                        <div style="font-size: 0.75rem; opacity: 0.4; font-weight: 800;">{{ $user->created_at->diffForHumans() }}</div>
                    </div>
                </div>
            </div>
            @empty
            <div class="glass-card" style="padding: 5rem 3rem; text-align: center; opacity: 0.4;">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom: 1.5rem;"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
                <div style="font-weight: 800; font-size: 0.85rem; letter-spacing: 1px;">NO CUSTOMER DATA RECORDED</div>
            </div>
            @endforelse
        </div>
    </div>

    <style>
        @media (min-width: 769px) {
            .desktop-only { display: block !important; }
            .mobile-only { display: none !important; }
        }
        @media (max-width: 768px) {
            .desktop-only { display: none !important; }
            .mobile-only { display: block !important; }
        }
</section>
@endsection
