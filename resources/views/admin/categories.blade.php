@extends('layouts.dashboard')

@section('title', 'Manage Categories - Admin')

@section('content')
<section style="padding: 2rem 0;">
    <div class="container">
        <div style="margin-bottom: 4rem;">
            <h1 style="font-size: 3rem; font-weight: 800; font-family: 'Outfit';">Manage <span class="text-gradient">Categories</span></h1>
        </div>

        <!-- Create/Update Form Top -->
        <div class="glass" style="padding: 2rem; border-radius: 32px; margin-bottom: 3rem;">
            <h3 style="margin-bottom: 2rem; font-weight: 800;">
                {{ $editingCategory ? 'Update Category' : 'Create New Category' }}
            </h3>
            <form action="{{ $editingCategory ? route('admin.categories.update', $editingCategory->id) : route('admin.categories.store') }}" method="POST" class="dynamic-form" style="display: grid; grid-template-columns: 1fr 2fr auto auto; gap: 2rem; align-items: end;">
                @csrf
                @if($editingCategory) @method('PUT') @endif
                
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-weight: 700; opacity: 0.7;">Category Name</label>
                    <input type="text" name="name" value="{{ $editingCategory->name ?? '' }}" required placeholder="e.g. Graphics Cards" style="background: var(--glass-bg); border: 1px solid var(--glass-border); padding: 1rem; border-radius: 12px; color: var(--text); width: 100%;">
                </div>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-weight: 700; opacity: 0.7;">Description</label>
                    <input type="text" name="description" value="{{ $editingCategory->description ?? '' }}" placeholder="Short description..." style="background: var(--glass-bg); border: 1px solid var(--glass-border); padding: 1rem; border-radius: 12px; color: var(--text); width: 100%;">
                </div>
                <button type="submit" class="btn btn-primary" style="padding: 1rem 2rem;">
                    {{ $editingCategory ? 'Save Changes' : 'Add Category' }}
                </button>
                @if($editingCategory)
                    <a href="{{ route('admin.categories') }}" class="btn btn-outline" style="padding: 1rem 2rem; display: flex; align-items: center; justify-content: center;">Cancel</a>
                @endif
            </form>
        </div>

        <!-- List Bottom -->
        <div class="glass" style="padding: 2rem; border-radius: 40px;">
            <h3 style="margin-bottom: 2rem; font-weight: 800;">Existing Categories</h3>
            <div class="table-responsive">
                <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 600px;">
                <thead>
                    <tr style="border-bottom: 1px solid var(--glass-border);">
                        <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Category Name</th>
                        <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Description</th>
                        <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Products</th>
                        <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr style="border-bottom: 1px solid var(--glass-border); {{ ($editingCategory && $editingCategory->id == $category->id) ? 'background: rgba(var(--primary-rgb), 0.1);' : '' }}">
                        <td style="padding: 1.5rem; font-weight: 700;">{{ $category->name }}</td>
                        <td style="padding: 1.5rem; opacity: 0.7;">{{ $category->description ?: 'No description' }}</td>
                        <td style="padding: 1.5rem;">
                            <span class="glass" style="padding: 0.3rem 0.8rem; border-radius: 50px; font-size: 0.8rem; font-weight: 700;">{{ $category->products_count }} Products</span>
                        </td>
                        <td style="padding: 1.5rem;">
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="{{ route('admin.categories', ['edit' => $category->id]) }}" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.75rem; {{ ($editingCategory && $editingCategory->id == $category->id) ? 'border-color: var(--primary); color: var(--primary);' : '' }}">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
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
</section>
@endsection
