# ElitePC Store - Design System & Style Guide

This document captures the design system, layout standards, and visual tokens used across the ElitePC application. It covers rules for margins, paddings, widths, typography (fonts and sizes), and color palettes (light/dark modes).

---

## 1. Grid & Layout Widths

The website restricts elements to keep content clean, readable, and aligned across different viewports.

| Element | CSS Rule | Purpose / Context |
| :--- | :--- | :--- |
| **Max Content Width** | `max-width: 1200px;` | Applied to the public `.container` and the `.dashboard-content` wrapper to constrain layout growth. |
| **Desktop Navbar Width** | `max-width: 1200px; width: calc(100% - 4rem);` | Centers the navigation header on screen size `>= 1200px`. |
| **Sidebar Width** | `width: var(--sidebar-width);` | `300px` by default. Scales down to `260px` (screens `<=` 1280px) and folds away on screens `<=` 1200px. |
| **Mobile Sidebar** | `width: 85%; max-width: 350px;` | Slides in from the left on mobile devices. |
| **Standard Search Box** | `width: 400px;` | Constrained to `280px` on small laptops, and hidden on tablets. |
| **Confirmation Modals** | `width: 300px;` | Fixed-width iOS-style dialogs. |
| **Forms / Controls** | `width: 100%;` | Inputs, selects, and textareas stretch to fill their grid cell or container. |

---

## 2. Margin System

Margins are structured to guarantee consistent spatial rhythm between blocks and columns.

| Context | Margin Style | Usage / Description |
| :--- | :--- | :--- |
| **Page Centering** | `margin: 0 auto;` | Automatically centers the main content column. |
| **Floating Navbar** | `margin: 1.5rem auto !important;` | Positions the top header above public content. |
| **Form Groups** | `margin-bottom: 2rem;` | Standard spacing between separate form inputs. |
| **Labels** | `margin-bottom: 0.8rem;` | Space between the field name label and the input field. |
| **Nav Links (Sidebar)** | `margin-bottom: 0.5rem;` | Vertical separation in the side navigation panel. |
| **Nav Groups (Sidebar)** | `margin-bottom: 2.5rem;` | Separation between sidebar header sections. |
| **Main Header Spacing**| `margin-bottom: 4rem;` | Vertical gap between headers and layouts (drops to `2.5rem` on mobile). |
| **Product Card Price** | `margin-top: auto; margin-bottom: 1.5rem;` | Aligns price rows to the bottom of the card content block. |

---

## 3. Padding System

Padding ensures card containers, lists, inputs, and buttons maintain proper density and tap target sizes.

| Selector / Element | Padding Style | Responsive Rules |
| :--- | :--- | :--- |
| **Main Container** | `padding: 0 2rem;` | Drops to `0 1.5rem;` at `1024px` and `0 1rem;` at `768px`. |
| **Dashboard Wrapper** | `padding: 2.5rem 4rem;` | Drops to `2rem 1.5rem-3rem` at `1280px`, and `1rem` on mobile. |
| **Glass Cards / Blocks** | `padding: 2.5rem;` | Drops to `2rem` at `768px` and `1.25rem` on mobile. |
| **Buttons (`.btn`)** | `padding: 0.8rem 1.5rem;` | Smaller buttons (e.g. card actions) use `0.8rem;`. |
| **Form Controls** | `padding: 1rem 1.25rem;` | Custom input override uses `0.8rem 1.2rem;` inside dashboards. |
| **Sidebar Container** | `padding: 2.5rem;` | Drops to `2rem` at `1200px`. |
| **Table Cells (`th`/`td`)** | Default table padding | Custom responsive rules: `1rem 1.25rem` below `768px`, and `0.75rem 1rem` on mobile. |
| **Toast Message** | `padding: 1rem 2rem;` | Generous space around alerts. |
| **Pagination Buttons** | `padding: 0.5rem 1rem;` | Clean padding for numeric page links. |

---

## 4. Typography (Fonts & Text Sizes)

ElitePC employs a premium sans-serif typography hierarchy for clean readability and high visual impact.

### Font Families
- **Global / Form Controls / Body**: `'Inter', -apple-system, BlinkMacSystemFont, sans-serif;`
- **Headings / Badges / Display Titles**: `'Outfit', sans-serif;`

### Font Sizes Hierarchy
- **Hero / Welcome Titles**: `font-size: clamp(2.5rem, 6vw, 4rem);` (smooth viewport scaling)
- **Primary Section Headings**: `font-size: 1.8rem;` (used for Profile headers and main card titles)
- **Sidebar Brand Logo**: `font-size: 1.5rem;`
- **Component Subheadings / Modals**: `font-size: 1.25rem;` / `1.15rem;` (product titles, dialog headers)
- **Sub-hero Description**: `font-size: 1.1rem;`
- **Body / Main Inputs**: `font-size: 0.95rem;`
- **Pagination Links**: `font-size: 0.9rem;`
- **Product description / Details**: `font-size: 0.85rem;`
- **Form Labels**: `font-size: 0.75rem;` (always uppercase, `800` weight, `1.5px` tracking)
- **Small Utilities (Sidebar Roles/Tags)**: `font-size: 0.7rem;`
- **Card Badges / Cart Counter**: `font-size: 0.65rem;` / `10px;`

---

## 5. Theme Color Palette

The project supports both **Dark Mode** (default) and **Light Mode** through a dynamic `[data-theme]` attribute.

### Core Variables

| Color Variable | Dark Mode (Default) | Light Mode | Description |
| :--- | :--- | :--- | :--- |
| **Background (`--bg`)** | `#1A2368` (Deep Midnight Blue) | `#f8fafc` (Slate White) | Main page backdrop |
| **Text Color (`--text`)**| `#f8fafc` (White Slate) | `#0f172a` (Slate Dark) | Main body font color |
| **Primary Theme** | `#6366f1` (Indigo) | `#6366f1` (Indigo) | Accents, active links, primary buttons |
| **Primary Hover** | `#4f46e5` (Darker Indigo) | `#4f46e5` (Darker Indigo) | Button hover state |
| **Primary Glow** | `rgba(99, 102, 241, 0.5)` | `rgba(99, 102, 241, 0.5)` | Shadows halos, focus glows |
| **Secondary Accent** | `#ec4899` (Hot Pink) | `#ec4899` (Hot Pink) | Special badges, likes, notifications |
| **Glass Background** | `rgba(255, 255, 255, 0.05)` | `rgba(15, 23, 42, 0.04)` | Semi-transparent card backdrops |
| **Glass Border** | `rgba(255, 255, 255, 0.1)` | `rgba(15, 23, 42, 0.1)` | Glassmorphic panel borders |
| **Text Dim** | `#94a3b8` (Slate Muted) | `#64748b` (Slate Gray) | Sub-captions, placeholders, disabled text |
| **Card Shadow** | `0 8px 32px 0 rgba(0,0,0,0.3)`| `0 8px 32px 0 rgba(15,23,42,0.08)` | Floating panel drop shadow |

### Special Colors
- **Sidebar Background (Dark)**: `rgba(26, 35, 104, 0.85)`
- **Sidebar Background (Light)**: `rgba(255, 255, 255, 0.8)`
- **Linear Text Gradient**: `linear-gradient(135deg, #6366f1 0%, #ec4899 100%)`
- **Laravel Status Badges**:
  - *Red/Danger*: `background: rgba(239, 68, 68, 0.1); color: #ef4444;`
  - *Green/Success*: `background: rgba(16, 185, 129, 0.1); color: #10b981;`
  - *Yellow/Highlight* (e.g. Add to Cart): `#facc15` (hover `#fde047`, text `#111827`)
- **Secure Logouts & Deletions**: `#ef4444` / `#ff3b30`
