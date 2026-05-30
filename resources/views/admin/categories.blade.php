@extends('layouts.dashboard')

@section('title', 'Manage Categories - Admin')

@section('content')
<section style="padding-bottom: 5rem; background: var(--bg);">
    <!-- Cohesive Header -->
    <div style="margin-bottom: 4rem; display: flex; justify-content: space-between; align-items: center;" class="header-stack">
        <div>
            <h1 style="font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 900; font-family: 'Outfit'; color: var(--text); letter-spacing: -1.5px; margin-bottom: 0.5rem; line-height: 1.2;">
                Manage <span class="text-gradient">Categories</span>
            </h1>
            <p style="color: var(--text-dim); font-size: 1rem; font-weight: 500;">Define hardware taxonomies and product hierarchies.</p>
        </div>
        <div class="glass" style="padding: 0.6rem 1.5rem; border-radius: 50px; font-size: 0.75rem; font-weight: 800; color: var(--primary); letter-spacing: 1px; border-color: rgba(99,102,241,0.2); background: rgba(99,102,241,0.03);">
            CATEGORIES: {{ $categories->count() }}
        </div>
    </div>

    <!-- Create/Update Form Top -->
    <div class="glass-card" style="padding: 2.5rem; background: #ffffff; border-color: rgba(15, 23, 42, 0.05); box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03); margin-bottom: 3rem;">
        <h3 style="margin-bottom: 2rem; font-weight: 900; font-family: 'Outfit'; color: var(--text);">
            {{ $editingCategory ? 'Update Category' : 'Create New Category' }}
        </h3>
        <form action="{{ $editingCategory ? route('admin.categories.update', $editingCategory->id) : route('admin.categories.store') }}" method="POST" class="form-grid-admin" enctype="multipart/form-data">
            @csrf
            @if($editingCategory) @method('PUT') @endif
            
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.6;">Category Name</label>
                <input type="text" name="name" value="{{ $editingCategory->name ?? '' }}" required placeholder="e.g. Graphics Cards">
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.6;">Description</label>
                <input type="text" name="description" value="{{ $editingCategory->description ?? '' }}" placeholder="Short description...">
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.6;">Category Image</label>
                <input type="file" name="image" accept="image/*" style="padding: 0.6rem; border-radius: 8px; border: 1px solid rgba(15,23,42,0.1);">
                @if($editingCategory && $editingCategory->image)
                    <div style="font-size: 0.75rem; color: var(--text-dim); margin-top: 0.2rem;">Current: <img src="{{ asset('storage/' . $editingCategory->image) }}" style="height: 30px; border-radius: 4px; vertical-align: middle; margin-left: 0.5rem;"></div>
                @endif
            </div>
            <div style="display: flex; gap: 1rem; align-items: flex-end;">
                <button type="submit" class="btn btn-primary" style="padding: 0.8rem 1.8rem; border-radius: 12px; font-weight: 700; height: 48px; flex: 1; justify-content: center;">
                    {{ $editingCategory ? 'Save Changes' : 'Add Category' }}
                </button>
                @if($editingCategory)
                    <a href="{{ route('admin.categories') }}" class="btn btn-outline" style="padding: 0.8rem 1.8rem; border-radius: 12px; font-weight: 700; height: 48px; flex: 1; display: flex; align-items: center; justify-content: center;">Cancel</a>
                @endif
            </div>
        </form>
    </div>

    <!-- List Bottom -->
    <div class="glass-card" style="padding: 2.5rem; background: #ffffff; border-color: rgba(15, 23, 42, 0.05); box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03);">
        <h3 style="margin-bottom: 2rem; font-weight: 900; font-family: 'Outfit'; color: var(--text);">Existing Categories</h3>
        <div class="table-container">
            <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 600px;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(15, 23, 42, 0.05);">
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Category Name</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Description</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Products</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr style="border-bottom: 1px solid rgba(15, 23, 42, 0.05); transition: background 0.3s; {{ ($editingCategory && $editingCategory->id == $category->id) ? 'background: rgba(99, 102, 241, 0.04);' : '' }}" onmouseover="this.style.background='rgba(15, 23, 42, 0.01)'" onmouseout="this.style.background='{{ ($editingCategory && $editingCategory->id == $category->id) ? 'rgba(99, 102, 241, 0.04)' : 'transparent' }}'">
                    <td style="padding: 1.25rem 1.5rem; font-weight: 700; font-size: 1.05rem; color: var(--text); display: flex; align-items: center; gap: 1rem;">
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" style="width: 40px; height: 40px; border-radius: 8px; object-fit: cover;">
                        @else
                            <div style="width: 40px; height: 40px; border-radius: 8px; background: rgba(15,23,42,0.05); display: flex; align-items: center; justify-content: center; font-size: 0.7rem; color: var(--text-dim); font-weight: 800;">N/A</div>
                        @endif
                        {{ $category->name }}
                    </td>
                    <td style="padding: 1.25rem 1.5rem; color: var(--text-dim); font-size: 0.9rem; font-weight: 500;">{{ $category->description ?: 'No description' }}</td>
                    <td style="padding: 1.25rem 1.5rem;">
                        <span style="padding: 0.35rem 0.8rem; border-radius: 50px; font-size: 0.72rem; font-weight: 800; background: rgba(99, 102, 241, 0.06); color: var(--primary); letter-spacing: 0.5px;">{{ $category->products_count }} Products</span>
                    </td>
                    <td style="padding: 1.25rem 1.5rem; text-align: right;">
                        <div style="display: flex; gap: 0.5rem; justify-content: flex-end; align-items: center;">
                            <a href="{{ route('admin.categories', ['edit' => $category->id]) }}" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.75rem; border-radius: 8px; {{ ($editingCategory && $editingCategory->id == $category->id) ? 'border-color: var(--primary); color: var(--primary);' : '' }}">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="margin: 0; display: inline-block;">
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
