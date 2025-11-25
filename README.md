# Shnikh Platform – Dual Brand Laravel-Inspired PHP Application

This repository contains a lightweight Laravel-style PHP 8.2 application optimized for Hostinger shared hosting. The platform serves two brands from a single codebase:

- **Shnikh Agrobiotech Pvt. Ltd.** – Plant tissue culture and agri-biotech services.
- **Cordygen** – Cordyceps powered wellness and nutraceutical products.

The stack provides dual-brand storefronts, shared components, an e-commerce cart & checkout (COD + Razorpay), role-based admin panel, and content management primitives without requiring Composer during deployment.

---

## ✨ Highlights

- Dual brand routing (`/shnikh/*` & `/cordygen/*`) with a shared landing page.
- Responsive UI built with TailwindCSS CDN + custom utility layer.
- Shopping cart, checkout, order management, Razorpay order creation, COD support, and order tracking.
- Blog, FAQ, pages, R&D/Science sections, and brand-specific theming.
- Admin portal with RBAC (`SUPER_ADMIN`, `ADMIN`, `CONTENT_MANAGER`) for products, blog, FAQs, pages, brands, orders, and staff users.
- Lean MVC kernel (router, controllers, middleware, services, repositories) designed to mimic Laravel conventions in pure PHP.
- MySQL 8 compatible schema & seed SQL scripts.

---

## 📁 Project Structure

```
app/
  Core/            # Framework core (Config, Env, Database, View, App, Session)
  Helpers/         # Global helper functions
  Http/            # Router, middleware, request/response, controllers
  Models/          # ActiveRecord style models
  Services/        # Domain services (brands, cart, payments, auth)
config/            # Application configuration arrays
database/
  migrations/      # SQL schema + seed scripts
public/
  assets/          # Compiled CSS/JS (Tailwind via CDN)
  index.php        # Front controller
resources/
  views/           # PHP view templates for brands and admin
storage/           # Leads, logs, cache
vendor/autoload.php# PSR-4 autoloader + helpers bootstrap
.env.example       # Environment template
```

---

## 🚀 Getting Started

### Requirements

- PHP 8.2+ with extensions: `pdo_mysql`, `curl`, `json`, `session`.
- MySQL 8.x.
- Webserver pointing the document root to `public/`.

### Installation Steps

1. **Clone & configure**
   ```bash
   git clone <repo>
   cd <repo>
   cp .env.example .env
   ```
   Update `.env` with Hostinger database credentials, APP_URL, mail, and Razorpay keys.

2. **Database**
   - Create the database defined in `.env`.
   - Run the SQL migrations:
     ```sql
     SOURCE database/migrations/20240227000000_create_core_tables.sql;
     SOURCE database/migrations/20240227001000_seed_initial_data.sql;
     ```

3. **File permissions**
   Ensure `storage/` is writable by the web server for leads, logs, and cache.

4. **Web server**
   - Point the virtual host / domain root to `public/`.
   - Enable HTTPS and rewrite rules if applicable (Hostinger automatically handles basic rewrites).

5. **Admin access**
   - Visit `/admin/login`.
   - Default super admin: `admin@shnikhplatform.com` / `ChangeMe123!` (update password immediately).

---

## 🧩 Configuration

- **App** – `config/app.php` (name, URL, timezone).
- **Brands** – `config/brands.php` (fallback brand metadata).
- **Content/Product/Blog fallbacks** – `config/content.php`, `config/products.php`, `config/blog.php`.
- **Payments** – `config/razorpay.php` (keys & capture behaviour).
- **Mail** – `config/mail.php` (SMTP for lead notifications if you extend mailer).

Update configuration arrays or persist data via the admin panel (once database entities exist).

---

## 🛍️ Commerce Flow

1. Users browse `/brand/products`.
2. Cart stored in PHP sessions (`CartService`).
3. Checkout form supports COD and Razorpay.
4. COD confirms order immediately.
5. Razorpay flow creates server-side order and exposes payload for client-side payment collection.
6. Orders & items stored in MySQL with tracking form on `/brand/order-track`.

---

## 🔐 Admin & RBAC

- Middleware ensures authentication for `/admin/*`.
- Roles defined in `roles` table.
- Controllers enforce role-sensitive access (extendable with `RoleMiddleware`).
- Modules: Dashboard, Orders, Products, Blog, Pages, FAQs, Brands, Users.

---

## 🧪 Testing & Local Verification

Without Composer, tests are manual:

1. Ensure PHP built-in server works:
   ```bash
  php -S localhost:8000 -t public
   ```
2. Visit `http://localhost:8000` and validate both brands, cart, checkout, and admin flows.

---

## 🚚 Deployment on Hostinger

1. Upload code (Git deploy or File Manager) ensuring `public/` maps to the domain root.
2. Create database & run migration SQL scripts from phpMyAdmin / MySQL shell.
3. Update `.env` on the server.
4. Configure cron task if you add background jobs.
5. Secure `storage/` & `.env` via Hostinger file manager permissions.

---

## 🧰 Extending the Platform

- Replace the lightweight kernel with full Laravel by adding Composer later if desired.
- Attach a queue/email layer for lead notifications.
- Inject real Razorpay checkout integration script on the confirmation page.
- Add Swagger / Postman collection for API exposure.

---

## 🙌 Credits

Crafted by the Codex autonomous agent as a production-ready dual-brand solution tailored for PHP 8.2 shared hosting. Update this README as you further customize the platform.***
