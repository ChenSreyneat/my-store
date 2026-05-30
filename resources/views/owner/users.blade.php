@extends('layouts.dashboard')

@section('title', 'Customer Management - Owner')

@section('content')
<section style="padding-bottom: 5rem; font-family: 'Inter', sans-serif; background: #fafafa; min-height: 100vh;">
    <div style="max-width: 1200px; margin: 0 auto; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 12px; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
        
        <!-- Header -->
        <div style="margin-bottom: 1.5rem;">
            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">
                <h1 style="font-size: 1.5rem; font-weight: 700; color: #111827; margin: 0; letter-spacing: -0.02em;">Customer management</h1>
                <span style="background: #f3f4f6; color: #374151; font-size: 0.8rem; font-weight: 600; padding: 0.2rem 0.6rem; border-radius: 12px;">{{ $users->count() }}</span>
            </div>
            <p style="color: #6b7280; font-size: 0.95rem; margin: 0;">Manage your customers and track their acquisitions here.</p>
        </div>

        <!-- Controls Row 1 -->
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid #f3f4f6;">
            <!-- Tabs -->
            <div style="display: flex; gap: 1.5rem; color: #6b7280; font-size: 0.9rem; font-weight: 500;">
                <div style="display: flex; align-items: center; gap: 0.5rem; color: #111827; cursor: pointer;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                    Table
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; transition: color 0.2s;" onmouseover="this.style.color='#111827'" onmouseout="this.style.color='#6b7280'">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                    Board
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; transition: color 0.2s;" onmouseover="this.style.color='#111827'" onmouseout="this.style.color='#6b7280'">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
                    List
                </div>
            </div>

            <!-- Actions -->
            <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.85rem; font-weight: 500; color: #4b5563;">
                <div style="display: flex; align-items: center; gap: 0.4rem; cursor: pointer; transition: color 0.2s;" onmouseover="this.style.color='#111827'" onmouseout="this.style.color='#4b5563'">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    Search
                </div>
                <div style="display: flex; align-items: center; gap: 0.4rem; cursor: pointer; transition: color 0.2s;" onmouseover="this.style.color='#111827'" onmouseout="this.style.color='#4b5563'">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle><line x1="3" y1="3" x2="21" y2="21"></line></svg>
                    Hide
                </div>
                <div style="display: flex; align-items: center; gap: 0.4rem; cursor: pointer; transition: color 0.2s;" onmouseover="this.style.color='#111827'" onmouseout="this.style.color='#4b5563'">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                    Customize
                </div>
                <div style="padding: 0 0.5rem; color: #d1d5db;">•••</div>
                <button style="background: white; border: 1px solid #e5e7eb; padding: 0.4rem 0.8rem; border-radius: 6px; color: #374151; font-size: 0.85rem; font-weight: 500; cursor: pointer; box-shadow: 0 1px 2px rgba(0,0,0,0.05); transition: 0.2s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='white'">Export</button>
                <button style="background: white; border: 1px solid #e5e7eb; padding: 0.4rem 0.8rem; border-radius: 6px; color: #374151; font-size: 0.85rem; font-weight: 500; cursor: pointer; box-shadow: 0 1px 2px rgba(0,0,0,0.05); transition: 0.2s; display: flex; align-items: center; gap: 0.4rem;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='white'">
                    Add Customer
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
            </div>
        </div>

        <!-- Controls Row 2 -->
        <div style="display: flex; gap: 0.75rem; margin-bottom: 1.5rem;">
            <button style="background: white; border: 1px solid #e5e7eb; padding: 0.4rem 0.8rem; border-radius: 6px; color: #374151; font-size: 0.85rem; font-weight: 500; cursor: pointer; display: flex; align-items: center; gap: 0.4rem; transition: 0.2s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='white'">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                Orders
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </button>
            <button style="background: white; border: 1px solid #e5e7eb; padding: 0.4rem 0.8rem; border-radius: 6px; color: #374151; font-size: 0.85rem; font-weight: 500; cursor: pointer; display: flex; align-items: center; gap: 0.4rem; transition: 0.2s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='white'">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                Contact
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </button>
            <button style="background: transparent; border: none; color: #6b7280; font-size: 0.85rem; font-weight: 500; cursor: pointer; display: flex; align-items: center; gap: 0.4rem; transition: 0.2s;" onmouseover="this.style.color='#111827'" onmouseout="this.style.color='#6b7280'">
                + Add filter
            </button>
        </div>

        <!-- Table -->
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 900px;">
                <thead>
                    <tr style="border-bottom: 1px solid #f3f4f6; border-top: 1px solid #f3f4f6;">
                        <th style="padding: 0.75rem 1rem; width: 40px;">
                            <input type="checkbox" style="width: 16px; height: 16px; border-radius: 4px; border: 1px solid #d1d5db; cursor: pointer;">
                        </th>
                        <th style="padding: 0.75rem 1rem; color: #4b5563; font-size: 0.8rem; font-weight: 600;">Full name</th>
                        <th style="padding: 0.75rem 1rem; color: #4b5563; font-size: 0.8rem; font-weight: 600;">
                            <span style="color: #9ca3af; margin-right: 0.2rem;">@</span> Email
                        </th>
                        <th style="padding: 0.75rem 1rem; color: #4b5563; font-size: 0.8rem; font-weight: 600;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 0.2rem; display: inline-block; vertical-align: middle;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            Orders
                        </th>
                        <th style="padding: 0.75rem 1rem; color: #4b5563; font-size: 0.8rem; font-weight: 600;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 0.2rem; display: inline-block; vertical-align: middle;"><circle cx="12" cy="12" r="10"></circle><path d="M12 8v4l3 3"></path></svg>
                            Status
                        </th>
                        <th style="padding: 0.75rem 1rem; color: #4b5563; font-size: 0.8rem; font-weight: 600;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 0.2rem; display: inline-block; vertical-align: middle;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            Joined date
                        </th>
                        <th style="padding: 0.75rem 1rem; color: #4b5563; font-size: 0.8rem; font-weight: 600;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 0.2rem; display: inline-block; vertical-align: middle;"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                            Contact
                        </th>
                        <th style="padding: 0.75rem 1rem; color: #4b5563; font-size: 0.8rem; font-weight: 600;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 0.2rem; display: inline-block; vertical-align: middle;"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                    <tr style="border-bottom: 1px solid #f3f4f6; transition: background 0.2s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 1rem;">
                            <input type="checkbox" style="width: 16px; height: 16px; border-radius: 4px; border: 1px solid #d1d5db; cursor: pointer;">
                        </td>
                        <td style="padding: 1rem;">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <img src="{{ $user->profile_image_url }}" style="width: 28px; height: 28px; border-radius: 50%; object-fit: cover;">
                                <div style="font-weight: 600; font-size: 0.9rem; color: #111827;">{{ $user->name }}</div>
                            </div>
                        </td>
                        <td style="padding: 1rem;">
                            <a href="mailto:{{ $user->email }}" style="color: #4f46e5; font-size: 0.9rem; text-decoration: underline; text-underline-offset: 2px;">{{ $user->email }}</a>
                        </td>
                        <td style="padding: 1rem; color: #4b5563; font-size: 0.9rem;">
                            {{ $user->orders_count }} Orders
                        </td>
                        <td style="padding: 1rem;">
                            <div style="display: inline-flex; align-items: center; gap: 0.4rem; border: 1px solid #e5e7eb; padding: 0.2rem 0.6rem; border-radius: 50px; font-size: 0.8rem; color: #374151; font-weight: 500;">
                                <div style="width: 6px; height: 6px; background: #10b981; border-radius: 50%;"></div>
                                Active
                            </div>
                        </td>
                        <td style="padding: 1rem; color: #4b5563; font-size: 0.9rem;">
                            {{ $user->created_at->format('d M Y, g:i a') }}
                        </td>
                        <td style="padding: 1rem; color: #4b5563; font-size: 0.9rem;">
                            {{ $user->phone ?? 'N/A' }}
                        </td>
                        <td style="padding: 1rem;">
                            <div style="display: flex; gap: 0.5rem;">
                                <button style="background: white; border: 1px solid #e5e7eb; padding: 0.3rem 0.6rem; border-radius: 6px; color: #374151; font-size: 0.8rem; font-weight: 500; cursor: pointer; display: flex; align-items: center; gap: 0.3rem; transition: 0.2s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='white'">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    Edit
                                </button>
                                <button style="background: white; border: 1px solid #e5e7eb; padding: 0.3rem 0.6rem; border-radius: 6px; color: #374151; font-size: 0.8rem; font-weight: 500; cursor: pointer; display: flex; align-items: center; gap: 0.3rem; transition: 0.2s;" onmouseover="this.style.background='#fef2f2'; this.style.color='#ef4444'; this.style.borderColor='#fca5a5'" onmouseout="this.style.background='white'; this.style.color='#374151'; this.style.borderColor='#e5e7eb'">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="padding: 4rem; text-align: center; color: #6b7280;">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom: 1rem; opacity: 0.6; display: block; margin: 0 auto 1rem;"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
                            <div style="font-weight: 600; font-size: 0.95rem;">No customers found.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 1.5rem; margin-top: 1rem; border-top: 1px solid #e5e7eb; flex-wrap: wrap; gap: 1rem;">
            <div style="display: flex; align-items: center; gap: 1.5rem; color: #4b5563; font-size: 0.85rem;">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    Rows per page
                    <select style="border: 1px solid #e5e7eb; border-radius: 6px; padding: 0.2rem 1.5rem 0.2rem 0.5rem; font-size: 0.85rem; color: #111827; background: white; appearance: none; outline: none; cursor: pointer;">
                        <option>15</option>
                        <option>30</option>
                        <option>50</option>
                    </select>
                </div>
                <div>
                    1-{{ min($users->count(), 15) }} of {{ $users->count() }} rows
                </div>
            </div>
            
            <div style="display: flex; gap: 0.2rem;">
                <button style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: white; border: 1px solid #e5e7eb; border-radius: 6px; color: #9ca3af; cursor: not-allowed;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 17l-5-5 5-5M18 17l-5-5 5-5"></path></svg>
                </button>
                <button style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: white; border: 1px solid #e5e7eb; border-radius: 6px; color: #9ca3af; cursor: not-allowed;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </button>
                
                <button style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: white; border: 1px solid #e5e7eb; border-radius: 6px; color: #111827; font-size: 0.85rem; font-weight: 500; cursor: pointer;">1</button>
                <button style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: transparent; border: none; color: #4b5563; font-size: 0.85rem; font-weight: 500; cursor: pointer;">2</button>
                <div style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; color: #4b5563; font-size: 0.85rem;">...</div>
                <button style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: transparent; border: none; color: #4b5563; font-size: 0.85rem; font-weight: 500; cursor: pointer;">5</button>
                
                <button style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: white; border: 1px solid #e5e7eb; border-radius: 6px; color: #4b5563; cursor: pointer; transition: 0.2s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='white'">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </button>
                <button style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: white; border: 1px solid #e5e7eb; border-radius: 6px; color: #4b5563; cursor: pointer; transition: 0.2s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='white'">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 17l5-5-5-5M6 17l5-5-5-5"></path></svg>
                </button>
            </div>
        </div>

    </div>
</section>
@endsection
