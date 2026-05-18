@extends('layouts.dashboard')

@section('title', 'Hardware Inventory - Owner')

@section('content')
<section style="padding-bottom: 5rem;">
    <!-- Adaptive Header -->
    <div style="margin-bottom: 5rem;" class="flex-wrap-md header-stack">
        <div>
            <h1 style="font-size: clamp(2.5rem, 6vw, 4rem); font-weight: 900; font-family: 'Outfit'; letter-spacing: -2px; line-height: 1; margin-bottom: 1.5rem;">Hardware <span class="text-gradient">Inventory</span></h1>
            <p style="opacity: 0.6; font-size: 1.1rem; font-weight: 600;">Manage your store's supply chain and calibrate product telemetry.</p>
        </div>
        <div class="glass" style="padding: 0.6rem 1.5rem; border-radius: 50px; font-size: 0.8rem; font-weight: 800; color: var(--primary); letter-spacing: 1px; border-color: var(--primary);">
            TOTAL UNITS: {{ $products->count() }}
        </div>
    </div>

    <!-- Deployment Console (Add/Edit Form) -->
    <div class="glass-card" style="padding: 3.5rem; border-radius: 40px; margin-bottom: 4rem; border-color: var(--primary);">
        <h3 style="margin-bottom: 3rem; font-weight: 900; font-family: 'Outfit'; font-size: 1.8rem; letter-spacing: -0.5px;">
            {{ $editingProduct ? 'Calibrate Hardware Node' : 'Deploy New Hardware' }}
        </h3>
        <form action="{{ $editingProduct ? route('owner.products.update', $editingProduct->id) : route('owner.products.store') }}" method="POST" enctype="multipart/form-data" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 2.5rem; align-items: end;">
            @csrf
            @if($editingProduct) @method('PUT') @endif
            
            <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                <label style="font-size: 0.75rem; font-weight: 800; letter-spacing: 1.5px; opacity: 0.6;">PRODUCT IDENTITY</label>
                <input type="text" name="name" value="{{ $editingProduct->name ?? '' }}" required placeholder="e.g. RTX 4090 TI" style="background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); padding: 1.2rem; border-radius: 16px; color: white; width: 100%;">
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                <label style="font-size: 0.75rem; font-weight: 800; letter-spacing: 1.5px; opacity: 0.6;">PRICE (USD)</label>
                <input type="number" name="price" value="{{ $editingProduct->price ?? '' }}" step="0.01" required style="background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); padding: 1.2rem; border-radius: 16px; color: white; width: 100%;">
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                <label style="font-size: 0.75rem; font-weight: 800; letter-spacing: 1.5px; opacity: 0.6;">STOCK CAPACITY</label>
                <input type="number" name="stock" value="{{ $editingProduct->stock ?? '' }}" required style="background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); padding: 1.2rem; border-radius: 16px; color: white; width: 100%;">
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                <label style="font-size: 0.75rem; font-weight: 800; letter-spacing: 1.5px; opacity: 0.6;">TAXONOMY (CATEGORY)</label>
                <select name="category_id" required style="background: var(--dark); border: 1px solid var(--glass-border); padding: 1.2rem; border-radius: 16px; color: white; width: 100%;">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ ($editingProduct && $editingProduct->category_id == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                <label style="font-size: 0.75rem; font-weight: 800; letter-spacing: 1.5px; opacity: 0.6;">MANUFACTURER (BRAND)</label>
                <select name="brand_id" required style="background: var(--dark); border: 1px solid var(--glass-border); padding: 1.2rem; border-radius: 16px; color: white; width: 100%;">
                    @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ ($editingProduct && $editingProduct->brand_id == $brand->id) ? 'selected' : '' }}>{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                <label style="font-size: 0.75rem; font-weight: 800; letter-spacing: 1.5px; opacity: 0.6;">HARDWARE TYPE</label>
                <select name="product_type_id" required style="background: var(--dark); border: 1px solid var(--glass-border); padding: 1.2rem; border-radius: 16px; color: white; width: 100%;">
                    @foreach($productTypes as $type)
                    <option value="{{ $type->id }}" {{ ($editingProduct && $editingProduct->product_type_id == $type->id) ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                <label style="font-size: 0.75rem; font-weight: 800; letter-spacing: 1.5px; opacity: 0.6;">VISUAL TELEMETRY (IMAGE)</label>
                <input type="file" name="image" accept="image/*" {{ $editingProduct ? '' : 'required' }} style="background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); padding: 1rem; border-radius: 16px; color: white; width: 100%;">
            </div>
            <div style="display: flex; gap: 1.5rem;">
                <button type="submit" class="btn btn-primary" style="flex: 2; padding: 1.2rem; border-radius: 16px; font-weight: 900;">
                    {{ $editingProduct ? 'SYNC CHANGES' : 'DEPLOY UNIT' }}
                </button>
                @if($editingProduct)
                    <a href="{{ route('owner.products') }}" class="btn btn-outline" style="flex: 1; padding: 1.2rem; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-weight: 800;">ABORT</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Inventory Matrix -->
    <div class="glass-card" style="padding: 0; border-radius: 40px; overflow: hidden;">
        <div style="padding: 2.5rem 3.5rem; border-bottom: 1px solid var(--glass-border); background: rgba(255,255,255,0.02);">
            <h3 style="font-weight: 900; font-family: 'Outfit'; font-size: 1.5rem; letter-spacing: -0.5px;">Current <span class="text-gradient">Archive</span></h3>
        </div>
        <div class="table-responsive">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: rgba(255,255,255,0.01); border-bottom: 1px solid var(--glass-border);">
                    <th style="padding: 2rem 3.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px;">HARDWARE IDENTITY</th>
                    <th style="padding: 2rem 3.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px;">TAXONOMY</th>
                    <th style="padding: 2rem 3.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px;">CAPACITY</th>
                    <th style="padding: 2rem 3.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px;">VALUATION</th>
                    <th style="padding: 2rem 3.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px; text-align: right;">OPERATIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr style="border-bottom: 1px solid var(--glass-border); transition: 0.3s; {{ ($editingProduct && $editingProduct->id == $product->id) ? 'background: rgba(var(--primary-rgb), 0.1);' : '' }}" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='{{ ($editingProduct && $editingProduct->id == $product->id) ? 'rgba(var(--primary-rgb), 0.1)' : 'transparent' }}'">
                    <td style="padding: 2rem 3.5rem;">
                        <div style="font-weight: 800; font-size: 1.1rem; letter-spacing: -0.5px;">{{ $product->name }}</div>
                        <div style="font-size: 0.75rem; opacity: 0.4; font-weight: 700; margin-top: 0.3rem;">{{ $product->brand->name ?? 'Generic' }} | {{ $product->productType->name ?? 'System' }}</div>
                    </td>
                    <td style="padding: 2rem 3.5rem;">
                        <span style="font-size: 0.85rem; font-weight: 700; opacity: 0.7;">{{ $product->category->name }}</span>
                    </td>
                    <td style="padding: 2rem 3.5rem;">
                        <span style="font-weight: 900; font-family: 'Outfit'; font-size: 1.1rem; color: {{ $product->stock < 5 ? '#ef4444' : '#10b981' }}">{{ $product->stock }}</span>
                    </td>
                    <td style="padding: 2rem 3.5rem; font-weight: 900; font-family: 'Outfit'; font-size: 1.2rem; color: var(--primary);">${{ number_format($product->price, 2) }}</td>
                    <td style="padding: 2rem 3.5rem; text-align: right;">
                        <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                            <a href="{{ route('owner.products', ['edit' => $product->id]) }}" class="glass" style="padding: 0.8rem 1.5rem; border-radius: 12px; font-size: 0.75rem; font-weight: 900; text-decoration: none; color: var(--primary); border-color: rgba(99, 102, 241, 0.2);">CALIBRATE</a>
                            <form action="{{ route('owner.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this hardware node?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="glass" style="padding: 0.8rem 1.5rem; border-radius: 12px; font-size: 0.75rem; font-weight: 900; color: #ef4444; border-color: rgba(239, 68, 68, 0.2); background: none; cursor: pointer;">PURGE</button>
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
