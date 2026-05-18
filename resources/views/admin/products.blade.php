@extends('layouts.dashboard')

@section('title', 'Global Products - Admin')

@section('content')
<section>
    <div style="margin-bottom: 4rem;">
        <h1 style="font-size: 3rem; font-weight: 800; font-family: 'Outfit';">Global <span class="text-gradient">Inventory</span></h1>
        <p style="opacity: 0.5;">Monitoring all hardware listings across all registered stores.</p>
    </div>

    <div class="glass" style="padding: 3rem; border-radius: 40px; overflow-x: auto;">
        <h3 style="margin-bottom: 2rem; font-weight: 800;">Master Listing Directory</h3>
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="border-bottom: 1px solid var(--glass-border);">
                    <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Hardware</th>
                    <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Store</th>
                    <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Category</th>
                    <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Stock</th>
                    <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Price</th>
                    <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr style="border-bottom: 1px solid var(--glass-border);">
                    <td style="padding: 1.5rem;">
                        <div style="font-weight: 700;">{{ $product->name }}</div>
                        <div style="font-size: 0.8rem; opacity: 0.5;">{{ $product->brand->name ?? 'Generic' }}</div>
                    </td>
                    <td style="padding: 1.5rem;">
                        <span style="font-weight: 600; color: var(--secondary);">{{ $product->store->name ?? 'System' }}</span>
                    </td>
                    <td style="padding: 1.5rem; opacity: 0.8;">{{ $product->category->name }}</td>
                    <td style="padding: 1.5rem;">
                        <span style="font-weight: 700; color: {{ $product->stock < 5 ? '#ef4444' : '#10b981' }}">{{ $product->stock }}</span>
                    </td>
                    <td style="padding: 1.5rem; font-weight: 800;">${{ number_format($product->price, 2) }}</td>
                    <td style="padding: 1.5rem;">
                        <span class="glass" style="padding: 0.3rem 0.8rem; border-radius: 50px; font-size: 0.7rem; font-weight: 700; color: #10b981;">PUBLISHED</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="margin-top: 2rem;">
            {{ $products->links() }}
        </div>
    </div>
</section>
@endsection
