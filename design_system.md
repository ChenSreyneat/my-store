/* =========================================================
   5. TYPOGRAPHY - UPDATED FONT SIZE
   ========================================================= */

/* Global Body */
body {
    font-family: 'Inter', sans-serif;
    font-size: 15px;
    font-weight: 400;
    line-height: 1.6;

    background: var(--bg);
    color: var(--text);

    overflow-x: hidden;
    min-height: 100vh;
}

/* Hero Title */
.hero-title,
h1 {
    font-family: 'Outfit', sans-serif;

    font-size: clamp(2rem, 4vw, 2.8rem);

    font-weight: 700;

    line-height: 1.2;

    letter-spacing: -1px;

    color: var(--title-color);

    margin-bottom: 1rem;
}

/* Section Title */
.section-title,
h2 {
    font-family: 'Outfit', sans-serif;

    font-size: 1.6rem;

    font-weight: 700;

    letter-spacing: -0.5px;

    color: var(--title-color);

    margin-bottom: 1rem;
}

/* Card Title */
.card-title,
h3 {
    font-size: 1.05rem;

    font-weight: 600;

    color: var(--text);

    line-height: 1.4;
}

/* Paragraph */
p {
    font-size: 0.92rem;

    font-weight: 400;

    color: var(--text-dim);

    line-height: 1.7;
}

/* Small Text */
.small-text {
    font-size: 0.82rem;
    color: var(--text-dim);
}

/* Labels */
.form-label {
    display: block;

    margin-bottom: 0.7rem;

    font-size: 0.82rem;

    font-weight: 600;

    letter-spacing: 0.3px;

    color: var(--text);
}

/* Navbar Links */
.nav-links a {
    color: var(--text);

    text-decoration: none;

    font-size: 0.92rem;

    font-weight: 500;

    transition: var(--transition);
}

/* Buttons */
.btn-primary,
.btn-outline {
    font-size: 0.92rem;
    font-weight: 600;
}

/* Product Title */
.product-title {
    font-size: 1rem;

    font-weight: 600;

    color: var(--title-color);

    margin-bottom: 0.5rem;
}

/* Product Description */
.product-description {
    font-size: 0.85rem;

    line-height: 1.6;

    color: var(--text-dim);
}

/* Product Price */
.product-price {
    font-size: 1rem;

    font-weight: 700;

    color: white;
}

/* Input Fields */
input,
textarea,
select {
    font-size: 0.92rem;

    font-weight: 500;
}

/* Table Head */
table th {
    font-size: 0.88rem;
    font-weight: 600;
}

/* Table Data */
table td {
    font-size: 0.88rem;
}

/* Badge */
.badge {
    font-size: 0.7rem;
    font-weight: 700;
}

/* Auth Title */
.auth-title {
    font-family: 'Outfit', sans-serif;

    font-size: 1.6rem;

    font-weight: 700;

    color: var(--title-color);

    margin-bottom: 2rem;
}

/* Logo */
.logo {
    font-family: 'Outfit', sans-serif;

    font-size: 1.3rem;

    font-weight: 700;

    color: var(--title-color);
}

/* =========================================================
   RESPONSIVE TYPOGRAPHY
   ========================================================= */

/* Tablet */
@media (max-width: 768px) {

    body {
        font-size: 14px;
    }

    h1,
    .hero-title {
        font-size: 2rem;
    }

    h2,
    .section-title {
        font-size: 1.4rem;
    }

    .auth-title {
        font-size: 1.4rem;
    }
}

/* Mobile */
@media (max-width: 480px) {

    body {
        font-size: 13px;
    }

    h1,
    .hero-title {
        font-size: 1.7rem;
    }

    h2,
    .section-title {
        font-size: 1.2rem;
    }

    .card-title,
    h3 {
        font-size: 1rem;
    }

    p {
        font-size: 0.85rem;
    }
}