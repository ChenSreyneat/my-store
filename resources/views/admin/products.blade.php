@extends('layouts.dashboard')

@section('title', 'Global Products - Admin')

@section('content')
<section style="padding-bottom: 5rem; background: var(--bg);">
    <!-- Cohesive Header -->
    <div style="margin-bottom: 4rem; display: flex; justify-content: space-between; align-items: center;" class="header-stack">
        <div>
            <h1 style="font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 900; font-family: 'Outfit'; color: var(--text); letter-spacing: -1.5px; margin-bottom: 0.5rem; line-height: 1.2;">
                Global <span class="text-gradient">Inventory</span>
            </h1>
            <p style="color: var(--text-dim); font-size: 1rem; font-weight: 500;">Monitoring all hardware listings across all registered stores.</p>
        </div>
        <div class="glass" style="padding: 0.6rem 1.5rem; border-radius: 50px; font-size: 0.75rem; font-weight: 800; color: var(--primary); letter-spacing: 1px; border-color: rgba(99,102,241,0.2); background: rgba(99,102,241,0.03);">
            LISTINGS: {{ $products->total() }}
        </div>
    </div>

    <div class="glass-card" style="padding: 2.5rem; background: #ffffff; border-color: rgba(15, 23, 42, 0.05); box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03);">
        <h3 style="margin-bottom: 2rem; font-weight: 900; font-family: 'Outfit'; color: var(--text);">Master Listing Directory</h3>
        <div class="table-container">
            <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 800px;">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(15, 23, 42, 0.05);">
                        <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Hardware</th>
                        <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Store</th>
                        <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Category</th>
                        <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Stock</th>
                        <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Price</th>
                        <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; text-align: right;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr style="border-bottom: 1px solid rgba(15, 23, 42, 0.05); transition: background 0.3s;" onmouseover="this.style.background='rgba(15, 23, 42, 0.01)'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 1.25rem 1.5rem;">
                            <div style="font-weight: 700; font-size: 1.05rem; color: var(--text);">{{ $product->name }}</div>
                            <div style="font-size: 0.8rem; color: var(--text-dim); margin-top: 0.2rem;">{{ $product->brand->name ?? 'Generic' }}</div>
                        </td>
                        <td style="padding: 1.25rem 1.5rem;">
                            <span style="font-weight: 600; color: var(--secondary); font-size: 0.95rem;">{{ $product->store->name ?? 'System' }}</span>
                        </td>
                        <td style="padding: 1.25rem 1.5rem; color: var(--text); font-size: 0.9rem; font-weight: 500;">{{ $product->category->name ?? 'Uncategorized' }}</td>
                        <td style="padding: 1.25rem 1.5rem;">
                            <span style="font-weight: 800; font-size: 0.95rem; color: {{ $product->stock < 5 ? '#ef4444' : '#10b981' }}">{{ $product->stock }}</span>
                        </td>
                        <td style="padding: 1.25rem 1.5rem; font-weight: 900; font-family: 'Outfit'; font-size: 1.1rem; color: var(--text);">${{ number_format($product->price, 2) }}</td>
                        <td style="padding: 1.25rem 1.5rem; text-align: right;">
                            <span style="padding: 0.35rem 0.8rem; border-radius: 50px; font-size: 0.7rem; font-weight: 800; background: rgba(16, 185, 129, 0.08); color: #10b981; letter-spacing: 0.5px;">PUBLISHED</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="margin-top: 2rem;">
            {{ $products->withQueryString()->links() }}
        </div>
    </div>
</section>
@endsection
