# Plottybot Insights WP - Complete Documentation

A comprehensive WordPress theme and system designed for the Plottybot platform, featuring custom user management, WooCommerce integration, affiliate tracking, multilingual support, and a complete design system.

---

## 📋 Table of Contents

1. [Overview](#overview)
2. [Architecture](#architecture)
3. [Design System](#design-system)
4. [File Structure](#file-structure)
5. [Core Features](#core-features)
6. [Installation & Setup](#installation--setup)
7. [REST API Documentation](#rest-api-documentation)
8. [WooCommerce Customizations](#woocommerce-customizations)
9. [Development Guide](#development-guide)
10. [Troubleshooting](#troubleshooting)

---

## 🎯 Overview

**Plottybot Insights WP** is a custom WordPress theme built on the Underscores (_s) starter theme framework. It's specifically designed for the Plottybot AI book writing platform and includes:

- **Custom REST API** for user authentication and token management
- **Advanced WooCommerce integration** with custom billing and VAT handling
- **Affiliate system** with commission tracking and sponsor management
- **Multi-currency support** (EUR, USD, GBP) with automatic conversion
- **Multilingual support** (Italian, English)
- **Complete design system** with CSS variables and reusable components
- **Custom billing system** with invoice and receipt management

---

## 🏗️ Architecture

### System Overview

```
┌─────────────────────────────────────────────────────────────┐
│                    Plottybot Insights WP                     │
├─────────────────────────────────────────────────────────────┤
│                                                               │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐      │
│  │   REST API   │  │  WooCommerce │  │   Affiliate  │      │
│  │              │  │  Integration │  │    System    │      │
│  │ - Register   │  │              │  │              │      │
│  │ - Login      │  │ - Custom     │  │ - Coupons    │      │
│  │ - Validate   │  │   Checkout   │  │ - Sponsors   │      │
│  │ - Tokens     │  │ - Billing    │  │ - Commission │      │
│  └──────────────┘  └──────────────┘  └──────────────┘      │
│                                                               │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐      │
│  │   Currency   │  │ Multilingual │  │    Design    │      │
│  │   Manager    │  │   Support    │  │    System    │      │
│  │              │  │              │  │              │      │
│  │ - EUR/USD/   │  │ - IT/EN      │  │ - Components │      │
│  │   GBP        │  │ - Auto       │  │ - Tokens     │      │
│  │ - Auto Conv. │  │   Detect     │  │ - Icons      │      │
│  └──────────────┘  └──────────────┘  └──────────────┘      │
│                                                               │
└─────────────────────────────────────────────────────────────┘
```

### Core Components

1. **Custom REST API** (`functions.php` lines 1-90)
   - User registration with automatic username generation
   - Email-based login with token generation
   - Token validation for cross-domain authentication
   - Cookie management for `.insights.plottybot.com`

2. **WooCommerce Integration** (`functions.php` lines 200-700)
   - Custom cart behavior (keeps only latest item per product)
   - Custom pricing and product naming
   - Order completion hooks for book status updates
   - Free trial tracking

3. **Billing System** (`functions.php` lines 550-750)
   - VAT/IVA handling with custom rates per user
   - Invoice generation (`fatture` table)
   - Receipt generation (`corrispettivi` table)
   - Automated billing emails
   - Multi-currency support with real-time conversion

4. **Affiliate System** (`functions.php` lines 730-850)
   - Coupon-based affiliate tracking
   - Sponsor system with lifetime commissions (10-20%)
   - Commission tracking in user meta
   - Special rates for specific affiliates

---

## 🎨 Design System

### Location
The design system is located in **`pb-style.php`** and is imported as the first CSS file in `style.css`.

### Design Tokens

#### Color System

The design system uses a comprehensive 11-step color scale (00-100) for each color family:

**Primary Colors** (Teal/Cyan)
```css
--color-primary-00: #E6FCF9  /* Lightest */
--color-primary-50: #00C2A8  /* Base */
--color-primary-100: #003F39 /* Darkest */
```

**Secondary Colors** (Blue)
```css
--color-secondary-00: #F4F7FB
--color-secondary-50: #7EA4D5
--color-secondary-100: #1A2E44
```

**Neutral Colors** (Grayscale)
```css
--color-neutral-00: #FFFFFF
--color-neutral-50: #BDBDBD
--color-neutral-100: #212121
```

**Semantic Colors**
- **Success**: Green scale (`--color-success-*`)
- **Warning**: Yellow scale (`--color-warning-*`)
- **Error**: Red scale (`--color-error-*`)
- **Accent**: Special highlight colors

#### Spacing System

Based on a **4px grid system**:
```css
--spacing-0: 0px
--spacing-4: 4px
--spacing-8: 8px
--spacing-12: 12px
--spacing-16: 16px
--spacing-20: 20px
--spacing-24: 24px
--spacing-28: 28px
--spacing-32: 32px
--spacing-40: 40px
--spacing-48: 48px
--spacing-64: 64px
```

#### Typography System

**Font Families**
- **Primary**: Inter (Google Fonts) - Body text, UI elements
- **Display**: Satoshi Variable - Headings, titles

**Typography Classes**

| Class | Font | Weight | Size | Usage |
|-------|------|--------|------|-------|
| `.text--overline` | Inter | 500 | 11px | Labels, overlines |
| `.text--buttons` | Inter | 600 | 14px | Button text |
| `.text--caption` | Inter | 500 | 12px | Captions, hints |
| `.text--body-sm` | Inter | 400 | 13px | Small body text |
| `.text--body-md` | Inter | 400 | 14px | Regular body text |
| `.text--body-lg` | Inter | 400 | 16px | Large body text |
| `.text--heading-sm` | Satoshi | 500 | 20px | Small headings |
| `.text--heading-md` | Satoshi | 600 | 28px | Medium headings |
| `.text--heading-lg` | Satoshi | 600 | 36px | Large headings |
| `.text--heading-xl` | Satoshi | 700 | 48px | Extra large headings |
| `.text--heading-xxl` | Satoshi | 700 | 64px | Hero headings |

**Usage Example:**
```html
<h1 class="text--heading-xl">Welcome to Plottybot</h1>
<p class="text--body-md">Start creating your book today.</p>
<button class="text--buttons">Get Started</button>
```

#### Elevation System

Three-level shadow system:
```css
--elevation-light: 0px 1px 3px 0px #0000001F
--elevation-medium: 0px 2px 6px 0px #00000029
--elevation-heavy: 0px 4px 12px 0px #0000003D
```

#### Border Radius

```css
--radius-small: 4px
--radius-medium: 8px
--radius-large: 16px
--radius-round: 9999px
```

#### Responsive Breakpoints

```css
--breakpoint-sm: 375px   /* Mobile */
--breakpoint-lg: 1024px  /* Tablet/Desktop */
--breakpoint-xl: 1440px  /* Large Desktop */
```

### Component System

#### Buttons (`pb-style.php`)

**Primary Button**
```html
<button class="button button--primary">Primary Action</button>
```
- Background: `var(--color-primary-50)`
- Hover: `var(--color-primary-60)`
- Active: `var(--color-primary-70)` + `elevation-medium`
- Disabled: Gray with reduced opacity

**Secondary Button**
```html
<button class="button button--secondary">Secondary Action</button>
```
- Transparent background
- Border: `2px solid var(--color-primary-50)`
- Hover: Darker border and text

**Tertiary Button**
```html
<button class="button button--tertiary">Tertiary Action</button>
```
- No background, no border
- Text color changes on hover

**Error Variants**
```html
<button class="button button--primary button--error">Delete</button>
<button class="button button--secondary button--error">Cancel</button>
```

**Size Modifiers**
```html
<button class="button button--primary button--sm">Small</button>
<button class="button button--primary button--md">Medium</button>
<button class="button button--primary button--lg">Large</button>
```

#### Toast Notifications (`pb-components.php`)

Reusable PHP component for notifications:

```php
<?php
echo pb_toast_component(
    "Success!",                    // heading
    "Your book has been created.", // text
    "success",                     // type: success|error|warning|info|default
    ""                            // optional custom HTML
);
?>
```

**Toast Types:**
- `success` - Green with checkmark icon
- `error` - Red with error icon
- `warning` - Yellow with info icon
- `info` - Blue with info icon
- `default` - Gray with info icon

#### Logo System (`pb-style.php`)

**Icon Sizes**
```html
<i class="icon--sm">icon</i>  <!-- 27px -->
<i class="icon--md">icon</i>  <!-- 47px -->
<i class="icon--lg">icon</i>  <!-- 94px -->
```

**Logo Colors**
```html
<div class="logo logo--black">Logo</div>
<div class="logo logo--white">Logo</div>
<div class="logo logo--primary">Logo</div>
```

### Icon System (`pb-iconography.php`)

Custom icon font located in `fonts/` directory using IcoMoon.

**Usage:**
```html
<span class="pb-icon__before--round-checkmark-l-success"></span>
<span class="pb-icon__before--round-error-l-error"></span>
<span class="pb-icon__before--round-info-l-warning"></span>
```

---

## 📁 File Structure

### Root Theme Directory: `wp-content/themes/pippo/`

```
pippo/
├── 📄 functions.php              # Core theme logic & custom functions
├── 📄 header.php                 # Site header template
├── 📄 footer.php                 # Site footer template
├── 📄 style.css                  # Main stylesheet (imports all CSS)
├── 📄 style-rtl.css              # Right-to-left language support
│
├── 🎨 DESIGN SYSTEM FILES
│   ├── pb-style.php              # Design tokens, colors, typography, buttons
│   ├── pb-components.php         # Reusable PHP components (toasts, etc.)
│   ├── pb-iconography.php        # Icon system
│   ├── pb-woo.php                # WooCommerce-specific styles
│   ├── pb-logo-overlay.svg       # Logo overlay graphic
│   └── pb-watermark.webp         # Watermark image
│
├── 📑 PAGE TEMPLATES
│   ├── home.php                  # Homepage template
│   ├── page.php                  # Default page template
│   ├── single.php                # Single post template
│   ├── archive.php               # Archive/blog template
│   ├── search.php                # Search results template
│   ├── 404.php                   # Not found page
│   └── comments.php              # Comments template
│
├── 📂 inc/                       # Theme includes
│   ├── custom-header.php         # Custom header support
│   ├── customizer.php            # Theme customizer options
│   ├── template-tags.php         # Custom template tags
│   ├── template-functions.php    # Template helper functions
│   └── jetpack.php               # Jetpack compatibility
│
├── 📂 template-parts/            # Reusable template parts
│   ├── content.php               # Default post content
│   ├── content-page.php          # Page content
│   ├── content-search.php        # Search result content
│   └── content-none.php          # No content found
│
├── 📂 js/                        # JavaScript files
│   ├── navigation.js             # Navigation menu logic
│   └── customizer.js             # Live preview in customizer
│
├── 📂 fonts/                     # Font files
│   ├── icomoon.eot/ttf/woff      # Icon font files
│   └── Satoshi_Complete/         # Satoshi font family
│       ├── Fonts/
│       │   ├── OTF/              # OpenType fonts
│       │   ├── TTF/              # TrueType fonts
│       │   └── WEB/              # Web fonts (woff, woff2)
│       └── License/
│
├── 📂 languages/                 # Translation files
│   ├── pippo.pot                 # Translation template
│   └── readme.txt
│
├── 📄 composer.json              # PHP dependencies
├── 📄 package.json               # Node.js dependencies
├── 📄 phpcs.xml.dist             # PHP CodeSniffer config
├── 📄 LICENSE                    # Theme license
└── 📄 README.md                  # This file
```

### Key File Purposes

| File | Purpose |
|------|---------|
| `functions.php` | All custom functionality, hooks, REST API, WooCommerce logic |
| `pb-style.php` | Complete design system - tokens, typography, buttons |
| `pb-components.php` | Reusable PHP components (toasts, cards, etc.) |
| `pb-woo.php` | WooCommerce-specific styling |
| `pb-iconography.php` | Icon font definitions and classes |
| `header.php` | Site header, navigation, language/currency detection |
| `footer.php` | Site footer |
| `style.css` | Main CSS that imports all other stylesheets |

---

## 🚀 Core Features

### 1. Custom REST API

**Location:** `functions.php` (lines 30-90)

#### Endpoints

**Register User**
```
POST /wp-json/custom-api/v1/register
Content-Type: application/json

{
  "email": "user@example.com",
  "password": "securepassword"
}
```

Response:
```json
{
  "success": true,
  "user_id": 123,
  "username": "user",
  "email": "user@example.com",
  "token": "abc123def456..."
}
```

**Login User**
```
POST /wp-json/custom-api/v1/login
Content-Type: application/json

{
  "email": "user@example.com",
  "password": "securepassword"
}
```

**Validate Token**
```
POST /wp-json/custom-api/v1/validate
Content-Type: application/json

{
  "token": "abc123def456..."
}
```

Response:
```json
{
  "success": true,
  "user_id": 123,
  "username": "user",
  "email": "user@example.com"
}
```

#### Token Management
- Tokens are 64-character hex strings stored in user meta (`api_token`)
- Cross-domain cookies set for `.insights.plottybot.com`
- New login invalidates previous tokens
- Tokens automatically cleared on logout

### 2. User Meta System

**Automatic User Meta:**
- `user_language` - Saved on registration from browser locale
- `user_currency` - EUR/USD/GBP based on location
- `api_token` - Authentication token
- `email_confirmed` - Email confirmation status
- `vat` - VAT/IVA number for invoicing
- `vatcode` - Unique fiscal code (Italian system)
- `vat-amount` - VAT percentage rate
- `discount` - User-specific discount (disables coupons)
- `free_books` - Count of free trial books
- `affiliate` - Affiliate earnings
- `sponsor` - Sponsor earnings
- `sponsored` - ID of sponsoring user

### 3. Multi-Currency System

**Supported Currencies:** EUR (default), USD, GBP

**How It Works:**
1. Currency detected from user's browser locale on registration
2. Stored in `user_currency` user meta
3. WooCommerce currency filter applies user's currency
4. Real-time conversion using Frankfurter API
5. Fallback rates stored in admin user meta (`eur_to_usd`, `eur_to_gbp`)

**Location:** `functions.php` (lines 170-195)

### 4. WooCommerce Customizations

#### Cart Behavior
- **Only keeps last item per product** - If user adds same product twice, only latest remains
- **Custom pricing** - Products can have custom prices via `custom_price` meta
- **Custom names** - Products can have custom names via `custom_name` meta

**Location:** `functions.php` (lines 220-280)

#### Order Completion Flow
```
Order Completed
    ↓
1. Update Book Status (draft → pending_book)
    ↓
2. Track Free Books (if order total = 0)
    ↓
3. Generate Invoice/Receipt
    ↓
4. Calculate Affiliate Commissions
    ↓
5. Update Sponsor Commissions
    ↓
6. Send Billing Email
```

**Location:** `functions.php` (lines 300-850)

### 5. Billing System

#### Invoice System (`fatture` table)
For users with VAT number:
- Full billing details stored
- VAT calculation with configurable rates
- Multi-currency support
- Email notification sent to accounts team
- `check` flag for processing status

**Fields Stored:**
- User ID, Order ID, Date
- EUR/USD/GBP amounts
- Company name, VAT number, VAT code
- Full billing address
- Contact details

#### Receipt System (`corrispettivi` table)
For users without VAT:
- Simplified receipt
- Multi-currency tracking
- No detailed billing info required

**Location:** `functions.php` (lines 550-700)

### 6. Affiliate System

#### Coupon-Based Affiliates
Special coupons track specific affiliates:
- `aleaccademia` → User 35 (10% commission)
- `titans5` → User 1364 (10% commission)

#### Sponsor System
- Users can be "sponsored" by another user
- `sponsored` meta contains sponsor's user ID
- 10% lifetime commission on all purchases
- Special rates for specific sponsors:
  - User 1362 (Filippo Celentano): 15%
  - User 822 (Gabrielle Nunez): 20%

**Commissions stored in:**
- `affiliate` user meta - coupon commissions
- `sponsor` user meta - sponsor commissions

**Location:** `functions.php` (lines 730-850)

### 7. Multilingual Support

**Supported Languages:**
- Italian (`it_IT`)
- English (`en_US`)

**Features:**
- Auto-detection from browser `Accept-Language` header
- Saved in `user_language` user meta on registration
- WordPress locale switched based on user language
- URL redirects (e.g., `/fatturazione/` → `/billing/`)

**Location:** `functions.php` (lines 120-160), `header.php` (lines 1-100)

### 8. Email Confirmation System

**Blocks login** if user hasn't confirmed email:
- Check `email_confirmed` user meta
- If not set to `1`, login is blocked
- Custom error message in user's language

**Location:** `functions.php` (lines 100-120)

---

## 💻 Installation & Setup

### Prerequisites

- **PHP**: 7.4 or higher
- **WordPress**: 6.0 or higher
- **MySQL**: 5.7 or higher
- **WooCommerce**: Latest version
- **Node.js**: 14.x or higher (for development)
- **Composer**: Latest version (for PHP dependencies)

### Required WordPress Plugins

1. **WooCommerce** - E-commerce functionality
2. **WooCommerce Multilingual** (optional) - Enhanced multilingual support

### Custom Database Tables

The theme requires these custom tables:

**`books` table:**
```sql
CREATE TABLE `books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `umeta_id` int NOT NULL,
  `user_id` int NOT NULL,
  `status` varchar(50) DEFAULT 'draft',
  `format` varchar(50) DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);
```

**`fatture` table (invoices):**
```sql
CREATE TABLE `fatture` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `order_id` int NOT NULL,
  `date` datetime NOT NULL,
  `eur` decimal(10,2) DEFAULT 0,
  `usd` decimal(10,2) DEFAULT 0,
  `gbp` decimal(10,2) DEFAULT 0,
  `company` varchar(255) DEFAULT NULL,
  `vat` varchar(50) DEFAULT NULL,
  `vatcode` varchar(50) DEFAULT NULL,
  `vat_amount` int DEFAULT 22,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `address_1` varchar(255) DEFAULT NULL,
  `address_2` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `postcode` varchar(20) DEFAULT NULL,
  `country` varchar(2) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `check` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
);
```

**`corrispettivi` table (receipts):**
```sql
CREATE TABLE `corrispettivi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `order_id` int NOT NULL,
  `date` datetime NOT NULL,
  `eur` decimal(10,2) DEFAULT 0,
  `usd` decimal(10,2) DEFAULT 0,
  `gbp` decimal(10,2) DEFAULT 0,
  PRIMARY KEY (`id`)
);
```

### Installation Steps

#### 1. Clone or Download Theme

```bash
cd /path/to/wordpress/wp-content/themes/
git clone <repository-url> pippo
cd pippo
```

#### 2. Install PHP Dependencies

```bash
composer install
```

This installs:
- PHP CodeSniffer
- WordPress Theme Review standards
- PHP linting tools
- WP-CLI i18n command

#### 3. Install Node Dependencies

```bash
npm install
```

This installs:
- WordPress Scripts
- Node Sass
- RTLCSS
- Development tools

#### 4. Activate Theme

1. Go to WordPress Admin → **Appearance** → **Themes**
2. Find "pippo" theme
3. Click **Activate**

#### 5. Configure WooCommerce

1. Install and activate **WooCommerce** plugin
2. Complete WooCommerce setup wizard
3. Configure:
   - **Currency**: Set default to EUR
   - **Payment methods**: Configure as needed
   - **Shipping**: Configure as needed
   - **Checkout**: Enable guest checkout if desired

#### 6. Set Currency Conversion Rates

For admin user (user_id = 1):
```php
// In WordPress admin or via plugin
update_user_meta(1, 'eur_to_usd', 1.08);  // Update with current rate
update_user_meta(1, 'eur_to_gbp', 0.85);  // Update with current rate
```

#### 7. Create Required Pages

Create these WordPress pages:
- **Home** - Set as front page
- **Account** - WooCommerce account page
- **Checkout** - WooCommerce checkout page
- **Cart** - WooCommerce cart page
- **Billing** - Custom billing information page

#### 8. Configure Theme Settings

**WordPress Admin → Appearance → Customize:**
- Upload logo
- Set site title and tagline
- Configure menus
- Set up widgets (if using sidebar)

---

## 🔧 Development Guide

### Working with the Design System

#### Using Design Tokens

All design tokens are CSS variables in `pb-style.php`. Use them instead of hard-coded values:

```css
/* ❌ BAD */
.my-component {
  color: #00C2A8;
  padding: 16px;
  border-radius: 8px;
}

/* ✅ GOOD */
.my-component {
  color: var(--color-primary-50);
  padding: var(--spacing-16);
  border-radius: var(--radius-medium);
}
```

#### Adding New Components

**In `pb-components.php`:**

```php
<?php
function pb_my_component($param1, $param2 = "default") {
    ob_start();
    ?>
    
    <div class="my-component">
        <h3 class="text--heading-sm"><?php echo $param1; ?></h3>
        <p class="text--body-md"><?php echo $param2; ?></p>
    </div>
    
    <?php
    return ob_get_clean();
}
?>
```

**Usage:**
```php
<?php echo pb_my_component("Title", "Description"); ?>
```

#### Styling Guidelines

1. **Always use design tokens** for colors, spacing, typography
2. **Use typography classes** instead of custom font styles
3. **Follow BEM naming** for new components: `.block__element--modifier`
4. **Mobile-first** approach: base styles for mobile, then media queries
5. **Avoid !important** unless overriding third-party styles

### Development Commands

#### Watch SCSS Changes
```bash
npm run watch
```

#### Compile CSS
```bash
npm run compile:css
```

#### Generate RTL Stylesheet
```bash
npm run compile:rtl
```

#### Lint PHP
```bash
composer run lint:php
composer run lint:wpcs
```

#### Lint JavaScript
```bash
npm run lint:js
```

#### Create Translation Template
```bash
composer run make-pot
```

#### Create Theme ZIP
```bash
npm run bundle
```

### Adding Custom Hooks

#### Example: After Order Completion

```php
add_action('woocommerce_order_status_completed', 'my_custom_order_function', 20, 1);

function my_custom_order_function($order_id) {
    $order = wc_get_order($order_id);
    $user_id = $order->get_user_id();
    
    // Your custom logic here
}
```

### Working with User Meta

```php
// Get user meta
$user_language = get_user_meta($user_id, 'user_language', true);

// Update user meta
update_user_meta($user_id, 'user_currency', 'usd');

// Delete user meta
delete_user_meta($user_id, 'api_token');
```

### Debugging

Enable WordPress debug mode in `wp-config.php`:

```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
```

View logs:
```bash
tail -f wp-content/debug.log
```

---

## 📚 REST API Documentation

### Authentication Flow

```
1. User registers
   POST /wp-json/custom-api/v1/register
   ↓
2. System generates token
   ↓
3. Token stored in user_meta
   ↓
4. Token returned to client
   ↓
5. Client stores token
   ↓
6. Client sends token with requests
   POST /wp-json/custom-api/v1/validate
```

### Error Responses

All endpoints return WP_Error on failure:

```json
{
  "code": "error_code",
  "message": "Human readable error message",
  "data": {
    "status": 400
  }
}
```

### Common Error Codes

| Code | Message | Status |
|------|---------|--------|
| `missing_fields` | Email e password sono obbligatorie | 400 |
| `email_exists` | Questa email è già registrata | 400 |
| `invalid_email` | Email non trovata | 401 |
| `invalid_login` | Credenziali non valide | 401 |
| `missing_token` | Token mancante | 400 |
| `invalid_token` | Token non valido | 401 |
| `email_not_confirmed` | Please confirm your email | 401 |

### Usage Examples

#### cURL

```bash
# Register
curl -X POST https://insights.plottybot.com/wp-json/custom-api/v1/register \
  -H "Content-Type: application/json" \
  -d '{"email":"user@example.com","password":"secret123"}'

# Login
curl -X POST https://insights.plottybot.com/wp-json/custom-api/v1/login \
  -H "Content-Type: application/json" \
  -d '{"email":"user@example.com","password":"secret123"}'

# Validate
curl -X POST https://insights.plottybot.com/wp-json/custom-api/v1/validate \
  -H "Content-Type: application/json" \
  -d '{"token":"abc123def456..."}'
```

#### JavaScript (Fetch API)

```javascript
// Register
const register = async (email, password) => {
  const response = await fetch('/wp-json/custom-api/v1/register', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ email, password })
  });
  return await response.json();
};

// Login
const login = async (email, password) => {
  const response = await fetch('/wp-json/custom-api/v1/login', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ email, password })
  });
  return await response.json();
};

// Validate
const validate = async (token) => {
  const response = await fetch('/wp-json/custom-api/v1/validate', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ token })
  });
  return await response.json();
};
```

---

## 🛒 WooCommerce Customizations

### Custom Checkout Flow

1. **Product added to cart** with custom price/name
2. **Cart keeps only latest item** per product ID
3. **Currency displayed** based on user meta
4. **Checkout page** uses custom styling from `pb-woo.php`
5. **Order completed:**
   - Book status updated
   - Free books counted
   - Invoice/receipt generated
   - Affiliates credited
   - Sponsors credited
   - Email sent

### Custom Thank You Message

**Location:** `functions.php` (lines 450-490)

For product ID 39 (book product):
- Custom message shown on order confirmation
- Different message for IT/EN users
- Displays user's email address
- Explains book creation timeline

### Disabling Coupons for Discounted Users

Users with `discount` meta cannot use coupons:

```php
// Check if user has discount
$discount = get_user_meta($user_id, 'discount', true);
if (!empty($discount)) {
    // Coupons are disabled
}
```

### Adding Custom Product Meta

```php
// Add to cart with custom price
WC()->cart->add_to_cart($product_id, 1, 0, array(), array(
    'custom_price' => 29.99,
    'custom_name' => 'Custom Book Name'
));
```

---

## 🐛 Troubleshooting

### Common Issues

#### 1. Design System Not Loading

**Symptoms:** Site looks unstyled or default WordPress theme

**Solutions:**
- Check if `pb-style.php` exists and is readable
- Verify `style.css` contains `@import url("pb-style.php");`
- Check browser console for CSS errors
- Clear WordPress cache and browser cache

#### 2. REST API Not Working

**Symptoms:** 404 errors on API endpoints

**Solutions:**
- Go to **Settings → Permalinks** and click "Save Changes"
- Check `.htaccess` file permissions
- Verify WordPress REST API is enabled
- Test with: `curl https://yoursite.com/wp-json/`

#### 3. Currency Not Changing

**Symptoms:** Always shows EUR regardless of user

**Solutions:**
- Check user is logged in
- Verify `user_currency` meta exists: `get_user_meta($user_id, 'user_currency', true)`
- Check fallback rates in admin meta
- Clear WooCommerce caches

#### 4. Invoices Not Generating

**Symptoms:** Orders complete but no invoice created

**Solutions:**
- Verify `fatture` and `corrispettivi` tables exist
- Check database user has INSERT permissions
- Check `wp-content/debug.log` for errors
- Verify user has VAT number for invoice generation

#### 5. Affiliate Commissions Not Tracking

**Symptoms:** Commissions not added to user meta

**Solutions:**
- Verify coupon code matches exactly (case-sensitive)
- Check order status is "completed"
- Verify affiliate user IDs are correct
- Check user meta: `get_user_meta($user_id, 'affiliate', true)`

### Debug Mode

Enable detailed logging:

```php
// In wp-config.php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
define('SCRIPT_DEBUG', true);
```

### Database Queries

Check custom tables:

```sql
-- Check books
SELECT * FROM books WHERE user_id = 123;

-- Check invoices
SELECT * FROM fatture WHERE user_id = 123;

-- Check receipts
SELECT * FROM corrispettivi WHERE user_id = 123;

-- Check user meta
SELECT * FROM wp_usermeta WHERE user_id = 123;
```

### Common Log Messages

```
[error] Invalid token provided
[notice] Order #123 completed for user #456
[warning] Currency conversion failed, using fallback rate
[error] Database insert failed: fatture table
```

---

## 📞 Support & Resources

### Documentation

- **WordPress Codex**: https://codex.wordpress.org/
- **WooCommerce Docs**: https://woocommerce.com/documentation/
- **Underscores (_s)**: https://underscores.me/

### Contact

- **Email**: info@plottybot.com
- **Technical Support**: albertomoneti@gmail.com
- **Accounts**: accounts@plottybot.com

### Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/my-feature`
3. Commit changes: `git commit -am 'Add new feature'`
4. Push to branch: `git push origin feature/my-feature`
5. Submit a pull request

### Code Standards

- **PHP**: Follow WordPress Coding Standards
- **CSS**: Use BEM methodology
- **JavaScript**: ES6+ with proper linting
- **Comments**: Document all functions and complex logic

---

## 📄 License

This theme is licensed under the GNU General Public License v2 or later.

**License URI**: https://www.gnu.org/licenses/gpl-2.0.html

---

## 🎯 Quick Reference

### Essential Commands

```bash
# Install dependencies
composer install && npm install

# Development mode
npm run watch

# Build for production
npm run compile:css && npm run compile:rtl

# Lint code
composer run lint:php && npm run lint:js

# Create deployment package
npm run bundle
```

### Essential Files

| What | Where |
|------|-------|
| Core Logic | `functions.php` |
| Design System | `pb-style.php` |
| Components | `pb-components.php` |
| WooCommerce Styles | `pb-woo.php` |
| Icons | `pb-iconography.php` |
| Main CSS | `style.css` |

### Key User Meta Keys

| Key | Purpose |
|-----|---------|
| `api_token` | Authentication token |
| `user_language` | it_IT or en_US |
| `user_currency` | eur, usd, or gbp |
| `vat` | VAT/IVA number |
| `discount` | User discount (disables coupons) |
| `affiliate` | Affiliate earnings |
| `sponsor` | Sponsor earnings |
| `sponsored` | Sponsor user ID |
| `free_books` | Free trial book count |

---

*This README provides comprehensive documentation for the Plottybot Insights WP theme. For additional support or questions, please contact the development team.*
