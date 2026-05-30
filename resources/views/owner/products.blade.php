@extends('layouts.dashboard')

@section('title', 'Hardware Inventory - Owner')

@section('content')
<section style="padding-bottom: 5rem; font-family: 'Inter', sans-serif;">
    <!-- Cohesive Header -->
    <div style="margin-bottom: 3rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h1 style="font-size: 2.2rem; font-weight: 800; color: #1e293b; margin-bottom: 0.5rem; line-height: 1.2;">
                Hardware Inventory 📦
            </h1>
            <p style="color: #64748b; font-size: 1rem; margin: 0;">Manage your store's supply chain and products.</p>
        </div>
        <div style="padding: 0.6rem 1.5rem; border-radius: 50px; font-size: 0.85rem; font-weight: 700; color: #6366f1; background: #eef2ff; border: 1px solid #e0e7ff; box-shadow: 0 2px 10px rgba(99,102,241,0.1);">
            TOTAL UNITS: {{ $products->count() }}
        </div>
    </div>

    <!-- Deployment Console (Add/Edit Form) -->
    <div style="background: #ffffff; border-radius: 24px; padding: 2.5rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px rgba(0,0,0,0.03); margin-bottom: 3rem;">
        <h3 style="margin-bottom: 2rem; font-weight: 800; font-size: 1.3rem; color: #1e293b; margin-top: 0;">
            {{ $editingProduct ? 'Update Product' : 'Add New Product' }}
        </h3>
        <form action="{{ $editingProduct ? route('owner.products.update', $editingProduct->id) : route('owner.products.store') }}" method="POST" enctype="multipart/form-data" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; align-items: end;">
            @csrf
            @if($editingProduct) @method('PUT') @endif
            
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b;">Product Name</label>
                <input type="text" name="name" value="{{ $editingProduct->name ?? '' }}" required placeholder="e.g. RTX 4090 TI" style="padding: 0.8rem 1rem; border-radius: 12px; border: 1px solid #e2e8f0; font-size: 0.95rem; outline: none; transition: 0.2s;" onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b;">Price (USD)</label>
                <input type="number" name="price" value="{{ $editingProduct->price ?? '' }}" step="0.01" required style="padding: 0.8rem 1rem; border-radius: 12px; border: 1px solid #e2e8f0; font-size: 0.95rem; outline: none; transition: 0.2s;" onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b;">Stock Capacity</label>
                <input type="number" name="stock" value="{{ $editingProduct->stock ?? '' }}" required style="padding: 0.8rem 1rem; border-radius: 12px; border: 1px solid #e2e8f0; font-size: 0.95rem; outline: none; transition: 0.2s;" onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b;">Category</label>
                <select name="category_id" required style="padding: 0.8rem 1rem; border-radius: 12px; border: 1px solid #e2e8f0; font-size: 0.95rem; outline: none; transition: 0.2s; background: white;" onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ ($editingProduct && $editingProduct->category_id == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b;">Brand</label>
                <select name="brand_id" required style="padding: 0.8rem 1rem; border-radius: 12px; border: 1px solid #e2e8f0; font-size: 0.95rem; outline: none; transition: 0.2s; background: white;" onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                    @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ ($editingProduct && $editingProduct->brand_id == $brand->id) ? 'selected' : '' }}>{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b;">Hardware Type</label>
                <select name="product_type_id" required style="padding: 0.8rem 1rem; border-radius: 12px; border: 1px solid #e2e8f0; font-size: 0.95rem; outline: none; transition: 0.2s; background: white;" onfocus="this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                    @foreach($productTypes as $type)
                    <option value="{{ $type->id }}" {{ ($editingProduct && $editingProduct->product_type_id == $type->id) ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.5rem; grid-column: 1 / -1;">
                <label style="font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b;">Product Images</label>
                <input type="file" name="images[]" multiple accept="image/*" {{ $editingProduct ? '' : 'required' }} style="padding: 0.8rem 1rem; border-radius: 12px; border: 1px dashed #cbd5e1; font-size: 0.95rem; outline: none; transition: 0.2s; background: #f8fafc;" onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#cbd5e1';">
                <small style="color: #64748b; font-size: 0.75rem; font-weight: 500;">You can select multiple images. The first image will be used as the primary thumbnail.</small>
            </div>
            <div style="display: flex; gap: 1rem; align-items: flex-end; grid-column: 1 / -1; margin-top: 0.5rem;">
                <button type="submit" style="padding: 0.8rem 1.8rem; border-radius: 50px; font-weight: 700; background: #6366f1; color: white; border: none; cursor: pointer; transition: 0.2s; box-shadow: 0 4px 15px rgba(99,102,241,0.3);" onmouseover="this.style.background='#4f46e5'" onmouseout="this.style.background='#6366f1'">
                    {{ $editingProduct ? 'Save Changes' : 'Add Product' }}
                </button>
                @if($editingProduct)
                    <a href="{{ route('owner.products') }}" style="padding: 0.8rem 1.8rem; border-radius: 50px; font-weight: 700; color: #475569; background: #f1f5f9; text-decoration: none; border: 1px solid #e2e8f0; transition: 0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">Cancel</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Desktop Table View -->
    <div class="desktop-only" style="background: #ffffff; border-radius: 24px; padding: 2.5rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px rgba(0,0,0,0.03); display: none;">
        <h3 style="margin-bottom: 2rem; font-weight: 800; font-size: 1.3rem; color: #1e293b; margin-top: 0;">Current Inventory</h3>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: separate; border-spacing: 0; text-align: left; min-width: 800px;">
            <thead>
                <tr>
                    <th style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9;">Product Name</th>
                    <th style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9;">Category</th>
                    <th style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9;">Stock</th>
                    <th style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9;">Price</th>
                    <th style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr style="transition: background 0.3s; {{ ($editingProduct && $editingProduct->id == $product->id) ? 'background: #eef2ff;' : '' }}" onmouseover="this.style.background='{{ ($editingProduct && $editingProduct->id == $product->id) ? '#eef2ff' : '#f8fafc' }}'" onmouseout="this.style.background='{{ ($editingProduct && $editingProduct->id == $product->id) ? '#eef2ff' : 'transparent' }}'">
                    <td style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9;">
                        <div style="font-weight: 700; font-size: 1.05rem; color: #1e293b;">{{ $product->name }}</div>
                        <div style="font-size: 0.8rem; color: #64748b; margin-top: 0.2rem;">{{ $product->brand->name ?? 'Generic' }} | {{ $product->productType->name ?? 'System' }}</div>
                    </td>
                    <td style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9;">
                        <span style="font-size: 0.85rem; font-weight: 600; color: #6366f1; background: #eef2ff; padding: 0.3rem 0.8rem; border-radius: 50px;">{{ $product->category->name ?? 'Uncategorized' }}</span>
                    </td>
                    <td style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9;">
                        <span style="font-weight: 800; font-size: 0.95rem; color: {{ $product->stock < 5 ? '#ef4444' : '#10b981' }}">{{ $product->stock }}</span>
                    </td>
                    <td style="padding: 1.25rem 1.5rem; font-weight: 800; font-size: 1.1rem; color: #0f172a; border-bottom: 1px solid #f1f5f9;">${{ number_format($product->price, 2) }}</td>
                    <td style="padding: 1.25rem 1.5rem; text-align: right; border-bottom: 1px solid #f1f5f9;">
                        <div style="display: flex; gap: 0.5rem; justify-content: flex-end; align-items: center;">
                            <a href="{{ route('owner.products', ['edit' => $product->id]) }}" style="padding: 0.5rem 1rem; font-size: 0.75rem; border-radius: 50px; font-weight: 700; color: #6366f1; background: #f8fafc; border: 1px solid #e2e8f0; text-decoration: none; transition: 0.2s;" onmouseover="this.style.background='#eef2ff'" onmouseout="this.style.background='#f8fafc'">Edit</a>
                            <form action="{{ route('owner.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this product?')" style="margin: 0; display: inline-block;">
                                @csrf @method('DELETE')
                                <button type="submit" style="padding: 0.5rem 1rem; font-size: 0.75rem; border-radius: 50px; font-weight: 700; color: #ef4444; background: #fef2f2; border: 1px solid #fecaca; text-decoration: none; cursor: pointer; transition: 0.2s;" onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fef2f2'">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>

    <!-- Mobile Stacked Card View -->
    <div class="mobile-only" style="display: none;">
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            @foreach($products as $product)
            <div style="background: #ffffff; border-radius: 20px; padding: 1.5rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 15px rgba(0,0,0,0.02); position: relative; {{ ($editingProduct && $editingProduct->id == $product->id) ? 'border-color: #6366f1; background: #eef2ff;' : '' }}">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.25rem;">
                    <div>
                        <div style="font-weight: 700; font-size: 1.1rem; line-height: 1.2; color: #1e293b;">{{ $product->name }}</div>
                        <div style="font-size: 0.75rem; color: #64748b; margin-top: 0.2rem; font-weight: 500;">{{ $product->brand->name ?? 'Generic' }} | {{ $product->productType->name ?? 'System' }}</div>
                    </div>
                    <span style="padding: 0.35rem 0.8rem; border-radius: 50px; font-size: 0.72rem; font-weight: 800; background: #eef2ff; color: #6366f1; letter-spacing: 0.5px;">
                        {{ $product->category->name ?? 'Uncategorized' }}
                    </span>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem 0; border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9; margin-bottom: 1.5rem;">
                    <div>
                        <div style="color: #64748b; font-size: 0.7rem; font-weight: 700; letter-spacing: 1px; margin-bottom: 0.2rem;">STOCK</div>
                        <span style="font-weight: 800; font-size: 1rem; color: {{ $product->stock < 5 ? '#ef4444' : '#10b981' }}">{{ $product->stock }} UNITS</span>
                    </div>
                    <div style="text-align: right;">
                        <div style="color: #64748b; font-size: 0.7rem; font-weight: 700; letter-spacing: 1px; margin-bottom: 0.2rem;">PRICE</div>
                        <span style="font-weight: 800; font-size: 1.1rem; color: #0f172a;">${{ number_format($product->price, 2) }}</span>
                    </div>
                </div>

                <div style="display: flex; gap: 0.8rem; justify-content: stretch;">
                    <a href="{{ route('owner.products', ['edit' => $product->id]) }}" style="flex: 1; display: flex; align-items: center; justify-content: center; padding: 0.6rem; border-radius: 50px; font-size: 0.75rem; font-weight: 700; color: #6366f1; background: #f8fafc; border: 1px solid #e2e8f0; text-decoration: none; transition: 0.2s;" onmouseover="this.style.background='#eef2ff'" onmouseout="this.style.background='#f8fafc'">Edit</a>
                    <form action="{{ route('owner.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this product?')" style="flex: 1; display: flex; margin: 0;">
                        @csrf @method('DELETE')
                        <button type="submit" style="width: 100%; display: flex; align-items: center; justify-content: center; padding: 0.6rem; border-radius: 50px; font-size: 0.75rem; font-weight: 700; color: #ef4444; background: #fef2f2; border: 1px solid #fecaca; text-decoration: none; cursor: pointer; transition: 0.2s;" onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fef2f2'">Delete</button>
                    </form>
                </div>
            </div>
            @endforeach
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
    </style>
</section>
@endsection
