<?php
/* Template Name: Home */
get_header();

// Check if user is logged in, if not redirect to login page
if (!is_user_logged_in()) {
    wp_redirect('https://plottybot.com/login');
    exit;
}

// Currency mapping based on market
$currencies = [
    'US' => '$',
    'UK' => '£',
    'DE' => '€',
    'FR' => '€',
    'ES' => '€'
];
?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style-rtl.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/pb-style.php">

<!-- Main Container with Sidebar and Content -->
<div style="display: flex; min-height: calc(100vh - 120px); position: relative; margin-top: 0;">

  <!-- Left Sidebar Navigation -->
  <aside id="sidebar" class="sidebar" style="position: relative; width: 280px; background: #F5F5F5; border-right: 1px solid #E0E0E0; box-shadow: 2px 0 8px rgba(0,0,0,0.05); transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1); overflow-y: auto; flex-shrink: 0;">

    <!-- Navigation Menu -->
    <nav style="padding: var(--spacing-24) 0;">
      <button id="nav-book-search" class="service-nav-btn active" data-service="book-search" style="width: 100%; padding: var(--spacing-20) var(--spacing-24); background: var(--color-primary-10); border: none; border-left: 4px solid var(--color-primary-60); color: var(--color-neutral-90); font-weight: 600; font-size: 1rem; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-align: left; display: flex; align-items: center; gap: var(--spacing-16); margin-bottom: var(--spacing-4);">
        <span style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: var(--color-primary-50); border-radius: var(--radius-small);">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M2 3h6a4 4 0 0 1 4 4v11a3 3 0 0 0-3-3H2z"></path>
            <path d="M18 3h-6a4 4 0 0 0-4 4v11a3 3 0 0 1 3-3h7z"></path>
          </svg>
        </span>
        <span>Book Search</span>
      </button>
      <button id="nav-categories" class="service-nav-btn" data-service="categories" style="width: 100%; padding: var(--spacing-20) var(--spacing-24); background: transparent; border: none; border-left: 4px solid transparent; color: var(--color-neutral-70); font-weight: 600; font-size: 1rem; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-align: left; display: flex; align-items: center; gap: var(--spacing-16); margin-bottom: var(--spacing-4);">
        <span style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: #E0E0E0; border-radius: var(--radius-small);">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="var(--color-neutral-70)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="7" height="7"></rect>
            <rect x="14" y="3" width="7" height="7"></rect>
            <rect x="14" y="14" width="7" height="7"></rect>
            <rect x="3" y="14" width="7" height="7"></rect>
          </svg>
        </span>
        <span>Categories</span>
      </button>
      <button id="nav-ad-campaign" class="service-nav-btn" data-service="ad-campaign" style="width: 100%; padding: var(--spacing-20) var(--spacing-24); background: transparent; border: none; border-left: 4px solid transparent; color: var(--color-neutral-70); font-weight: 600; font-size: 1rem; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-align: left; display: flex; align-items: center; gap: var(--spacing-16); margin-bottom: var(--spacing-4);">
        <span style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: #E0E0E0; border-radius: var(--radius-small);">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="var(--color-neutral-70)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="1" x2="12" y2="23"></line>
            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
          </svg>
        </span>
        <span>Royalties Calculator</span>
      </button>
      <button id="nav-chrome-extension" class="service-nav-btn" data-service="chrome-extension" style="width: 100%; padding: var(--spacing-20) var(--spacing-24); background: transparent; border: none; border-left: 4px solid transparent; color: var(--color-neutral-70); font-weight: 600; font-size: 1rem; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-align: left; display: flex; align-items: center; gap: var(--spacing-16); margin-bottom: var(--spacing-4);">
        <span style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: #E0E0E0; border-radius: var(--radius-small);">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="var(--color-neutral-70)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <circle cx="12" cy="12" r="4"></circle>
            <line x1="21.17" y1="8" x2="12" y2="8"></line>
            <line x1="3.95" y1="6.06" x2="8.54" y2="14"></line>
            <line x1="10.88" y1="21.94" x2="15.46" y2="14"></line>
          </svg>
        </span>
        <span>Chrome Extension</span>
      </button>
    </nav>


  </aside>

  <!-- Toggle Button -->
  <button id="sidebar-toggle" class="sidebar-toggle" style="position: absolute; left: 280px; top: 20px; z-index: 100; width: 40px; height: 40px; background: white; border: 1px solid #E0E0E0; border-radius: var(--radius-medium); color: var(--color-neutral-70); cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 2px 8px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: center;">
    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <polyline points="15 18 9 12 15 6"></polyline>
    </svg>
  </button>

  <!-- Main Content Area -->
  <div id="main-content" class="main-content" style="flex: 1; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: var(--color-neutral-05);">

<!-- Book Search Service -->
<div id="service-book-search" class="service-section active" style="display: block;">
  <div class="section plottybot-homepage aligncenter" style="padding: var(--spacing-48) var(--spacing-16);">
    <div class="filters-container" style="max-width: 900px; margin: 0 auto; background: var(--color-neutral-00); border: 1px solid var(--color-neutral-30); border-radius: var(--radius-large); box-shadow: 0 8px 32px rgba(0,0,0,0.06); padding: var(--spacing-40);">
    <div class="filter-row" style="display: flex; gap: var(--spacing-32); margin-bottom: var(--spacing-32); flex-wrap: wrap;">
      <!-- Market Selector (Custom Dropdown) -->
      <div class="filter-group" style="flex: 1 1 300px; min-width: 220px; position: relative;">
        <label for="market-selector" class="text--label" style="display: block; margin-bottom: var(--spacing-12); color: var(--color-neutral-90); font-weight: 700; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Market</label>
        <div id="market-dropdown" class="dropdown" style="width: 100%;">
          <a href="#" id="market-selected" class="dropdown-toggle" style="display: flex; align-items: center; justify-content: space-between; padding: 16px 40px 16px 12px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); background: var(--color-neutral-00); color: var(--color-neutral-90); font-size: 1rem; font-weight: 500; min-height: 48px; line-height: 1.5; box-sizing: border-box; cursor: pointer; text-decoration: none;">
            <span class="navigation-text" id="market-selected-label">🇺🇸 United States</span>
            <span style="margin-left: 12px; display: flex; align-items: center;"><svg width="12" height="8" viewBox="0 0 12 8"><path fill="#666" d="M1 1l5 5 5-5"/></svg></span>
          </a>
          <ul class="dropdown-menu" id="market-options" style="display: none; position: absolute; left: 0; right: 0; top: 100%; z-index: 10; background: var(--color-neutral-00); border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); margin: 0; padding: 0; list-style: none; box-shadow: 0 8px 32px rgba(0,0,0,0.06);">
            <li><a href="#" data-value="US" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">🇺🇸 United States</span></a></li>
            <li><a href="#" data-value="UK" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">🇬🇧 United Kingdom</span></a></li>
            <li><a href="#" data-value="DE" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">🇩🇪 Germany</span></a></li>
            <li><a href="#" data-value="FR" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">🇫🇷 France</span></a></li>
            <li><a href="#" data-value="ES" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">🇪🇸 Spain</span></a></li>
          </ul>
          <input type="hidden" id="market-selector" name="market" value="US">
        </div>
      </div>
      <!-- Publisher Type Dropdown (replaces toggle) -->
      <div class="filter-group" style="flex: 1 1 300px; min-width: 220px; position: relative;">
        <label for="publisher-selector" class="text--label" style="display: block; margin-bottom: var(--spacing-12); color: var(--color-neutral-90); font-weight: 700; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Publisher Type</label>
        <div id="publisher-dropdown" class="dropdown" style="width: 100%;">
          <a href="#" id="publisher-selected" class="dropdown-toggle" style="display: flex; align-items: center; justify-content: space-between; padding: 16px 40px 16px 12px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); background: var(--color-neutral-00); color: var(--color-neutral-90); font-size: 1rem; font-weight: 500; min-height: 48px; line-height: 1.5; box-sizing: border-box; cursor: pointer; text-decoration: none;">
            <span class="navigation-text" id="publisher-selected-label">All Publishers</span>
            <span style="margin-left: 12px; display: flex; align-items: center;"><svg width="12" height="8" viewBox="0 0 12 8"><path fill="#666" d="M1 1l5 5 5-5"/></svg></span>
          </a>
          <ul class="dropdown-menu" id="publisher-options" style="display: none; position: absolute; left: 0; right: 0; top: 100%; z-index: 10; background: var(--color-neutral-00); border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); margin: 0; padding: 0; list-style: none; box-shadow: 0 8px 32px rgba(0,0,0,0.06);">
            <li><a href="#" data-value="all" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">All Publishers</span></a></li>
            <li><a href="#" data-value="self" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">Self Publishers</span></a></li>
          </ul>
          <input type="hidden" id="publisher-selector" name="publisher_type" value="all">
        </div>
      </div>
    </div>
    <!-- Horizontal filter row for BSR, Price, Ratings -->
    <div class="filter-row" style="display: flex; gap: var(--spacing-32); margin-bottom: var(--spacing-32); flex-wrap: wrap;">
      <!-- BSR Range Custom Dropdown -->
      <div class="filter-group" style="flex: 1 1 220px; min-width: 180px; position: relative;">
        <label class="text--label" style="display: block; margin-bottom: 8px; color: var(--color-neutral-90); font-weight: 700; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">BSR Range</label>
        <div id="bsr-dropdown" class="dropdown" style="width: 100%;">
          <a href="#" id="bsr-selected" class="dropdown-toggle" style="display: flex; align-items: center; justify-content: space-between; padding: 16px 40px 16px 12px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); background: var(--color-neutral-00); color: var(--color-neutral-90); font-size: 1rem; font-weight: 500; min-height: 48px; line-height: 1.5; box-sizing: border-box; cursor: pointer; text-decoration: none;">
            <span class="navigation-text" id="bsr-selected-label">1 - 1,000</span>
            <span style="margin-left: 12px; display: flex; align-items: center;"><svg width="12" height="8" viewBox="0 0 12 8"><path fill="#666" d="M1 1l5 5 5-5"/></svg></span>
          </a>
          <ul class="dropdown-menu" id="bsr-options" style="display: none; position: absolute; left: 0; right: 0; top: 100%; z-index: 10; background: var(--color-neutral-00); border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); margin: 0; padding: 0; list-style: none; box-shadow: 0 8px 32px rgba(0,0,0,0.06);">
            <li><a href="#" data-value="1-1000" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">1 - 1,000</span></a></li>
            <li><a href="#" data-value="1001-5000" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">1,001 - 5,000</span></a></li>
            <li><a href="#" data-value="5001-10000" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">5,001 - 10,000</span></a></li>
            <li><a href="#" data-value="10001-50000" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">10,001 - 50,000</span></a></li>
            <li><a href="#" data-value="50001-100000" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">50,001 - 100,000</span></a></li>
            <li><a href="#" data-value="100001+" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">100,001+</span></a></li>
          </ul>
          <input type="hidden" id="bsr-range" name="bsr_range" value="1-1000">
        </div>
      </div>
      <!-- Price Range Custom Dropdown -->
      <div class="filter-group" style="flex: 1 1 220px; min-width: 180px; position: relative;">
        <label class="text--label" style="display: block; margin-bottom: 8px; color: var(--color-neutral-90); font-weight: 700; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Price Range <span id="currency-symbol" style="color: var(--color-primary-60); font-weight: 700;">($)</span></label>
        <div id="price-dropdown" class="dropdown" style="width: 100%;">
          <a href="#" id="price-selected" class="dropdown-toggle" style="display: flex; align-items: center; justify-content: space-between; padding: 16px 40px 16px 12px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); background: var(--color-neutral-00); color: var(--color-neutral-90); font-size: 1rem; font-weight: 500; min-height: 48px; line-height: 1.5; box-sizing: border-box; cursor: pointer; text-decoration: none;">
            <span class="navigation-text" id="price-selected-label">$0 - $10</span>
            <span style="margin-left: 12px; display: flex; align-items: center;"><svg width="12" height="8" viewBox="0 0 12 8"><path fill="#666" d="M1 1l5 5 5-5"/></svg></span>
          </a>
          <ul class="dropdown-menu" id="price-options" style="display: none; position: absolute; left: 0; right: 0; top: 100%; z-index: 10; background: var(--color-neutral-00); border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); margin: 0; padding: 0; list-style: none; box-shadow: 0 8px 32px rgba(0,0,0,0.06);">
            <li><a href="#" data-value="0-10" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">$0 - $10</span></a></li>
            <li><a href="#" data-value="11-25" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">$11 - $25</span></a></li>
            <li><a href="#" data-value="26-50" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">$26 - $50</span></a></li>
            <li><a href="#" data-value="51-100" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">$51 - $100</span></a></li>
            <li><a href="#" data-value="101+" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">$101+</span></a></li>
          </ul>
          <input type="hidden" id="price-range" name="price_range" value="0-10">
        </div>
      </div>
      <!-- Ratings Range Custom Dropdown -->
      <div class="filter-group" style="flex: 1 1 220px; min-width: 180px; position: relative;">
        <label class="text--label" style="display: block; margin-bottom: 8px; color: var(--color-neutral-90); font-weight: 700; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Number of Ratings</label>
        <div id="ratings-dropdown" class="dropdown" style="width: 100%;">
          <a href="#" id="ratings-selected" class="dropdown-toggle" style="display: flex; align-items: center; justify-content: space-between; padding: 16px 40px 16px 12px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); background: var(--color-neutral-00); color: var(--color-neutral-90); font-size: 1rem; font-weight: 500; min-height: 48px; line-height: 1.5; box-sizing: border-box; cursor: pointer; text-decoration: none;">
            <span class="navigation-text" id="ratings-selected-label">0 - 50</span>
            <span style="margin-left: 12px; display: flex; align-items: center;"><svg width="12" height="8" viewBox="0 0 12 8"><path fill="#666" d="M1 1l5 5 5-5"/></svg></span>
          </a>
          <ul class="dropdown-menu" id="ratings-options" style="display: none; position: absolute; left: 0; right: 0; top: 100%; z-index: 10; background: var(--color-neutral-00); border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); margin: 0; padding: 0; list-style: none; box-shadow: 0 8px 32px rgba(0,0,0,0.06);">
            <li><a href="#" data-value="0-50" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">0 - 50</span></a></li>
            <li><a href="#" data-value="51-200" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">51 - 200</span></a></li>
            <li><a href="#" data-value="201-500" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">201 - 500</span></a></li>
            <li><a href="#" data-value="501-1000" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">501 - 1,000</span></a></li>
            <li><a href="#" data-value="1001+" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">1,001+</span></a></li>
          </ul>
          <input type="hidden" id="ratings-range" name="ratings_range" value="0-50">
        </div>
      </div>
    </div>
    <!-- Categories Tickboxes Section -->
    <div id="categories-section" style="margin-bottom: var(--spacing-32);">
      <label class="text--label" style="display: block; margin-bottom: var(--spacing-12); color: var(--color-neutral-90); font-weight: 700; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Categories</label>
      <div id="categories-list" style="display: flex; flex-wrap: wrap; gap: var(--spacing-16);"></div>
    </div>
    <!-- Submit Button -->
    <div>
      <button id="apply-filters" class="text--buttons" style="width: 100%; padding: var(--spacing-20); background: linear-gradient(135deg, var(--color-primary-60), var(--color-primary-70)); color: var(--color-neutral-00); border: none; border-radius: var(--radius-medium); font-weight: 700; font-size: 1.125rem; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3); text-transform: uppercase; letter-spacing: 0.5px;">
        Search Books
      </button>
    </div>
  </div>

  <!-- Books Results Section -->
  <div id="books-results" style="max-width: 1200px; margin: var(--spacing-48) auto 0;">
    <div id="loading-indicator" style="display: none; text-align: center; padding: var(--spacing-40); color: var(--color-neutral-60);">
      <div style="display: inline-block; width: 50px; height: 50px; border: 5px solid var(--color-neutral-20); border-top-color: var(--color-primary-60); border-radius: 50%; animation: spin 1s linear infinite;"></div>
      <p style="margin-top: var(--spacing-16); font-size: 1.125rem; font-weight: 600;">Searching for books...</p>
    </div>

    <div id="books-container"></div>
  </div>
  </div>
</div>

<!-- Categories Service -->
<div id="service-categories" class="service-section" style="display: none;">
  <div class="section plottybot-homepage aligncenter" style="padding: var(--spacing-48) var(--spacing-16);">
    <div class="categories-container" style="max-width: 900px; margin: 0 auto; background: var(--color-neutral-00); border: 1px solid var(--color-neutral-30); border-radius: var(--radius-large); box-shadow: 0 8px 32px rgba(0,0,0,0.06); padding: var(--spacing-40);">

      <!-- Header -->
      <div style="text-align: center; margin-bottom: var(--spacing-40);">
        <h1 class="text--heading-lg" style="color: var(--color-neutral-90); margin-bottom: var(--spacing-16);">📊 Categories Analysis</h1>
        <p class="text--body-lg" style="color: var(--color-neutral-70);">Discover trending categories and analyze market performance across different regions.</p>
      </div>

      <!-- Search Form -->
      <div class="categories-form" style="margin-bottom: var(--spacing-40);">
        <div class="filter-row" style="display: flex; gap: var(--spacing-24); margin-bottom: var(--spacing-24); flex-wrap: wrap;">

          <!-- Market Selector -->
          <div class="filter-group" style="flex: 1 1 300px; min-width: 250px; position: relative;">
            <label for="categories-market-selector" class="text--label" style="display: block; margin-bottom: var(--spacing-12); color: var(--color-neutral-90); font-weight: 700; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Market</label>
            <div id="categories-market-dropdown" class="dropdown" style="width: 100%;">
              <a href="#" id="categories-market-selected" class="dropdown-toggle" style="display: flex; align-items: center; justify-content: space-between; padding: 16px 40px 16px 12px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); background: var(--color-neutral-00); color: var(--color-neutral-90); font-size: 1rem; font-weight: 500; min-height: 48px; line-height: 1.5; box-sizing: border-box; cursor: pointer; text-decoration: none;">
                <span class="navigation-text" id="categories-market-selected-label">🇺🇸 United States</span>
                <span style="margin-left: 12px; display: flex; align-items: center;"><svg width="12" height="8" viewBox="0 0 12 8"><path fill="#666" d="M1 1l5 5 5-5"/></svg></span>
              </a>
              <ul class="dropdown-menu" id="categories-market-options" style="display: none; position: absolute; left: 0; right: 0; top: 100%; z-index: 10; background: var(--color-neutral-00); border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); margin: 0; padding: 0; list-style: none; box-shadow: 0 8px 32px rgba(0,0,0,0.06);">
                <!-- Market options will be populated by JavaScript -->
              </ul>
              <input type="hidden" id="categories-market-selector" name="categories_market" value="US">
            </div>
          </div>

          <!-- Macro Category Selector -->
          <div class="filter-group" style="flex: 1 1 300px; min-width: 250px; position: relative;">
            <label for="categories-macro-category-selector" class="text--label" style="display: block; margin-bottom: var(--spacing-12); color: var(--color-neutral-90); font-weight: 700; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Macro Category</label>
            <div id="categories-macro-category-dropdown" class="dropdown" style="width: 100%;">
              <a href="#" id="categories-macro-category-selected" class="dropdown-toggle" style="display: flex; align-items: center; justify-content: space-between; padding: 16px 40px 16px 12px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); background: var(--color-neutral-00); color: var(--color-neutral-90); font-size: 1rem; font-weight: 500; min-height: 48px; line-height: 1.5; box-sizing: border-box; cursor: pointer; text-decoration: none;">
                <span class="navigation-text" id="categories-macro-category-selected-label">Select a category...</span>
                <span style="margin-left: 12px; display: flex; align-items: center;"><svg width="12" height="8" viewBox="0 0 12 8"><path fill="#666" d="M1 1l5 5 5-5"/></svg></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-scrollable" id="categories-macro-category-options" style="display: none; position: absolute; left: 0; right: 0; top: 100%; z-index: 10; background: var(--color-neutral-00); border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); margin: 0; padding: 0; list-style: none; box-shadow: 0 8px 32px rgba(0,0,0,0.06); max-height: 300px; overflow-y: auto;">
                <!-- Macro category options will be populated by JavaScript -->
              </ul>
              <input type="hidden" id="categories-macro-category-selector" name="categories_macro_category" value="">
            </div>
          </div>

        </div>

        <!-- Keyword Search (Optional) -->
        <div class="filter-row" style="margin-bottom: var(--spacing-32);">
          <div class="filter-group" style="width: 100%;">
            <label for="categories-keyword-search" class="text--label" style="display: block; margin-bottom: var(--spacing-12); color: var(--color-neutral-90); font-weight: 700; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Keyword Search <span style="color: var(--color-neutral-60); font-weight: 400; text-transform: none;">(Optional)</span></label>
            <input type="text" id="categories-keyword-search" name="categories_keyword" placeholder="Enter keywords to filter categories..." style="width: 100%; padding: 16px 12px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); background: var(--color-neutral-00); color: var(--color-neutral-90); font-size: 1rem; line-height: 1.5; box-sizing: border-box;">
          </div>
        </div>

        <!-- Search Button -->
        <div style="text-align: center;">
          <button id="categories-search-btn" class="text--buttons" style="width: 100%; padding: var(--spacing-20); background: linear-gradient(135deg, var(--color-primary-60), var(--color-primary-70)); color: var(--color-neutral-00); border: none; border-radius: var(--radius-medium); font-weight: 700; font-size: 1.125rem; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3); text-transform: uppercase; letter-spacing: 0.5px;">
            🔍 Search Categories
          </button>
        </div>
      </div>

      <!-- Results Section -->
      <div id="categories-results" style="margin-top: var(--spacing-40);">
        <div id="categories-loading-indicator" style="display: none; text-align: center; padding: var(--spacing-40); color: var(--color-neutral-60);">
          <div style="display: inline-block; width: 50px; height: 50px; border: 5px solid var(--color-neutral-20); border-top-color: var(--color-primary-60); border-radius: 50%; animation: spin 1s linear infinite;"></div>
          <p style="margin-top: var(--spacing-16); font-size: 1.125rem; font-weight: 600;">Searching categories...</p>
        </div>

        <div id="categories-results-container" style="display: none;">
          <!-- Results will be populated here -->
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Royalties Calculator Service -->
<div id="service-ad-campaign" class="service-section" style="display: none;">
  <div class="section plottybot-homepage aligncenter" style="padding: var(--spacing-48) var(--spacing-16);">
    <div style="max-width: 900px; margin: 0 auto; background: var(--color-neutral-00); border: 1px solid var(--color-neutral-30); border-radius: var(--radius-large); box-shadow: 0 8px 32px rgba(0,0,0,0.06); padding: var(--spacing-40);">

      <!-- Header -->
      <div style="text-align: center; margin-bottom: var(--spacing-40);">
        <h1 class="text--heading-lg" style="color: var(--color-neutral-90); margin-bottom: var(--spacing-16);">💰 Royalties Calculator</h1>
        <p class="text--body-lg" style="color: var(--color-neutral-70);">Calculate your Amazon KDP royalties based on book specifications and pricing.</p>
      </div>

      <!-- Calculator Form -->
      <div class="royalties-form">

        <!-- Row 1: Market and Unit -->
        <div class="filter-row" style="display: flex; gap: var(--spacing-24); margin-bottom: var(--spacing-24); flex-wrap: wrap;">

          <!-- Market Selector -->
          <div class="filter-group" style="flex: 1 1 300px; min-width: 250px; position: relative;">
            <label for="royalties-market-selector" class="text--label" style="display: block; margin-bottom: var(--spacing-12); color: var(--color-neutral-90); font-weight: 700; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Market</label>
            <div id="royalties-market-dropdown" class="dropdown" style="width: 100%;">
              <a href="#" id="royalties-market-selected" class="dropdown-toggle" style="display: flex; align-items: center; justify-content: space-between; padding: 16px 40px 16px 12px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); background: var(--color-neutral-00); color: var(--color-neutral-90); font-size: 1rem; font-weight: 500; min-height: 48px; line-height: 1.5; box-sizing: border-box; cursor: pointer; text-decoration: none;">
                <span class="navigation-text" id="royalties-market-selected-label">🇺🇸 United States</span>
                <span style="margin-left: 12px; display: flex; align-items: center;"><svg width="12" height="8" viewBox="0 0 12 8"><path fill="#666" d="M1 1l5 5 5-5"/></svg></span>
              </a>
              <ul class="dropdown-menu" id="royalties-market-options" style="display: none; position: absolute; left: 0; right: 0; top: 100%; z-index: 10; background: var(--color-neutral-00); border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); margin: 0; padding: 0; list-style: none; box-shadow: 0 8px 32px rgba(0,0,0,0.06);">
                <li><a href="#" data-value="US" data-currency="$" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">🇺🇸 United States</span></a></li>
                <li><a href="#" data-value="UK" data-currency="£" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">🇬🇧 United Kingdom</span></a></li>
                <li><a href="#" data-value="IT" data-currency="€" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">🇮🇹 Italy</span></a></li>
                <li><a href="#" data-value="DE" data-currency="€" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">🇩🇪 Germany</span></a></li>
                <li><a href="#" data-value="FR" data-currency="€" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">🇫🇷 France</span></a></li>
                <li><a href="#" data-value="ES" data-currency="€" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">🇪🇸 Spain</span></a></li>
                <li><a href="#" data-value="CA" data-currency="CA$" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">🇨🇦 Canada</span></a></li>
              </ul>
              <input type="hidden" id="royalties-market-selector" name="royalties_market" value="US">
            </div>
          </div>

          <!-- Unit Selector -->
          <div class="filter-group" style="flex: 1 1 300px; min-width: 250px; position: relative;">
            <label for="royalties-unit-selector" class="text--label" style="display: block; margin-bottom: var(--spacing-12); color: var(--color-neutral-90); font-weight: 700; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Unit</label>
            <div id="royalties-unit-dropdown" class="dropdown" style="width: 100%;">
              <a href="#" id="royalties-unit-selected" class="dropdown-toggle" style="display: flex; align-items: center; justify-content: space-between; padding: 16px 40px 16px 12px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); background: var(--color-neutral-00); color: var(--color-neutral-90); font-size: 1rem; font-weight: 500; min-height: 48px; line-height: 1.5; box-sizing: border-box; cursor: pointer; text-decoration: none;">
                <span class="navigation-text" id="royalties-unit-selected-label">Inches (in)</span>
                <span style="margin-left: 12px; display: flex; align-items: center;"><svg width="12" height="8" viewBox="0 0 12 8"><path fill="#666" d="M1 1l5 5 5-5"/></svg></span>
              </a>
              <ul class="dropdown-menu" id="royalties-unit-options" style="display: none; position: absolute; left: 0; right: 0; top: 100%; z-index: 10; background: var(--color-neutral-00); border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); margin: 0; padding: 0; list-style: none; box-shadow: 0 8px 32px rgba(0,0,0,0.06);">
                <li><a href="#" data-value="in" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">Inches (in)</span></a></li>
                <li><a href="#" data-value="mm" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">Millimeters (mm)</span></a></li>
              </ul>
              <input type="hidden" id="royalties-unit-selector" name="royalties_unit" value="in">
            </div>
          </div>

        </div>

        <!-- Row 2: Trim Size -->
        <div class="filter-row" style="display: flex; gap: var(--spacing-24); margin-bottom: var(--spacing-24); flex-wrap: wrap;">

          <!-- Trim Size Selector -->
          <div class="filter-group" style="flex: 1 1 100%; position: relative;">
            <label for="royalties-trim-size-selector" class="text--label" style="display: block; margin-bottom: var(--spacing-12); color: var(--color-neutral-90); font-weight: 700; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Trim Size</label>
            <div id="royalties-trim-size-dropdown" class="dropdown" style="width: 100%;">
              <a href="#" id="royalties-trim-size-selected" class="dropdown-toggle" style="display: flex; align-items: center; justify-content: space-between; padding: 16px 40px 16px 12px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); background: var(--color-neutral-00); color: var(--color-neutral-90); font-size: 1rem; font-weight: 500; min-height: 48px; line-height: 1.5; box-sizing: border-box; cursor: pointer; text-decoration: none;">
                <span class="navigation-text" id="royalties-trim-size-selected-label">6 x 9 in</span>
                <span style="margin-left: 12px; display: flex; align-items: center;"><svg width="12" height="8" viewBox="0 0 12 8"><path fill="#666" d="M1 1l5 5 5-5"/></svg></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-scrollable" id="royalties-trim-size-options" style="display: none; position: absolute; left: 0; right: 0; top: 100%; z-index: 10; background: var(--color-neutral-00); border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); margin: 0; padding: 0; list-style: none; box-shadow: 0 8px 32px rgba(0,0,0,0.06); max-height: 300px; overflow-y: auto;">
                <!-- Options will be populated by JavaScript -->
              </ul>
              <input type="hidden" id="royalties-width" name="royalties_width" value="6">
              <input type="hidden" id="royalties-height" name="royalties_height" value="9">
            </div>
          </div>

        </div>

        <!-- Row 3: Pages, Price, Ink Type -->
        <div class="filter-row" style="display: flex; gap: var(--spacing-24); margin-bottom: var(--spacing-24); flex-wrap: wrap;">

          <!-- Number of Pages -->
          <div class="filter-group" style="flex: 1 1 200px; min-width: 150px;">
            <label for="royalties-pages" class="text--label" style="display: block; margin-bottom: var(--spacing-12); color: var(--color-neutral-90); font-weight: 700; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Number of Pages</label>
            <input type="number" id="royalties-pages" name="royalties_pages" value="200" min="24" max="828" placeholder="200" style="width: 100%; padding: 16px 12px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); background: var(--color-neutral-00); color: var(--color-neutral-90); font-size: 1rem; line-height: 1.5; box-sizing: border-box;">
          </div>

          <!-- List Price -->
          <div class="filter-group" style="flex: 1 1 200px; min-width: 150px;">
            <label for="royalties-price" class="text--label" style="display: block; margin-bottom: var(--spacing-12); color: var(--color-neutral-90); font-weight: 700; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">List Price <span id="royalties-currency-symbol" style="color: var(--color-primary-60);">($)</span></label>
            <input type="number" id="royalties-price" name="royalties_price" value="9.99" min="0" step="0.01" placeholder="9.99" style="width: 100%; padding: 16px 12px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); background: var(--color-neutral-00); color: var(--color-neutral-90); font-size: 1rem; line-height: 1.5; box-sizing: border-box;">
          </div>

          <!-- Ink Type -->
          <div class="filter-group" style="flex: 1 1 250px; min-width: 200px; position: relative;">
            <label for="royalties-ink-type-selector" class="text--label" style="display: block; margin-bottom: var(--spacing-12); color: var(--color-neutral-90); font-weight: 700; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">Ink Type</label>
            <div id="royalties-ink-type-dropdown" class="dropdown" style="width: 100%;">
              <a href="#" id="royalties-ink-type-selected" class="dropdown-toggle" style="display: flex; align-items: center; justify-content: space-between; padding: 16px 40px 16px 12px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); background: var(--color-neutral-00); color: var(--color-neutral-90); font-size: 1rem; font-weight: 500; min-height: 48px; line-height: 1.5; box-sizing: border-box; cursor: pointer; text-decoration: none;">
                <span class="navigation-text" id="royalties-ink-type-selected-label">Black & White</span>
                <span style="margin-left: 12px; display: flex; align-items: center;"><svg width="12" height="8" viewBox="0 0 12 8"><path fill="#666" d="M1 1l5 5 5-5"/></svg></span>
              </a>
              <ul class="dropdown-menu" id="royalties-ink-type-options" style="display: none; position: absolute; left: 0; right: 0; top: 100%; z-index: 10; background: var(--color-neutral-00); border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); margin: 0; padding: 0; list-style: none; box-shadow: 0 8px 32px rgba(0,0,0,0.06);">
                <li><a href="#" data-value="black" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">Black & White</span></a></li>
                <li><a href="#" data-value="standard_color" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">Standard Color</span></a></li>
                <li><a href="#" data-value="premium_color" class="dropdown-item" style="display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;"><span class="navigation-text">Premium Color</span></a></li>
              </ul>
              <input type="hidden" id="royalties-ink-type-selector" name="royalties_ink_type" value="black">
            </div>
          </div>

        </div>

        <!-- Calculate Button -->
        <div style="text-align: center; margin-top: var(--spacing-32);">
          <button id="royalties-calculate-btn" class="text--buttons" style="width: 100%; padding: var(--spacing-20); background: linear-gradient(135deg, var(--color-primary-60), var(--color-primary-70)); color: var(--color-neutral-00); border: none; border-radius: var(--radius-medium); font-weight: 700; font-size: 1.125rem; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3); text-transform: uppercase; letter-spacing: 0.5px;">
            💰 Calculate Royalties
          </button>
        </div>

      </div>

      <!-- Results Section -->
      <div id="royalties-results" style="margin-top: var(--spacing-40); display: none;">
        <div style="padding: var(--spacing-32); background: var(--color-neutral-10); border-radius: var(--radius-large);">
          <h2 class="text--heading-md" style="color: var(--color-neutral-90); margin-bottom: var(--spacing-24); text-align: center;">Your Royalty Breakdown</h2>

          <div style="display: grid; gap: var(--spacing-12);">
            <div style="padding: var(--spacing-16); background: var(--color-neutral-00); border-radius: var(--radius-medium); border-left: 4px solid var(--color-primary-60);">
              <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                  <p style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--color-neutral-60); margin: 0 0 4px 0; font-weight: 600;">List Price</p>
                  <p style="font-size: 0.875rem; color: var(--color-neutral-70); margin: 0;">Your book's selling price</p>
                </div>
                <span id="result-list-price" style="font-size: 1.5rem; color: var(--color-primary-60); font-weight: 700;">$9.99</span>
              </div>
            </div>

            <div style="padding: var(--spacing-16); background: var(--color-neutral-00); border-radius: var(--radius-medium); border-left: 4px solid #FF6B6B;">
              <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                  <p style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--color-neutral-60); margin: 0 0 4px 0; font-weight: 600;">Printing Cost</p>
                  <p style="font-size: 0.875rem; color: var(--color-neutral-70); margin: 0;">Cost to print your book</p>
                </div>
                <span id="result-printing-cost" style="font-size: 1.5rem; color: #FF6B6B; font-weight: 700;">$3.65</span>
              </div>
            </div>

            <div style="padding: var(--spacing-16); background: var(--color-neutral-00); border-radius: var(--radius-medium); border-left: 4px solid #FF6B6B;">
              <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                  <p style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--color-neutral-60); margin: 0 0 4px 0; font-weight: 600;">Amazon Fee (40%)</p>
                  <p style="font-size: 0.875rem; color: var(--color-neutral-70); margin: 0;">Amazon's commission per sale</p>
                </div>
                <span id="result-amazon-fee" style="font-size: 1.5rem; color: #FF6B6B; font-weight: 700;">$4.00</span>
              </div>
            </div>

            <div style="padding: var(--spacing-20); background: linear-gradient(135deg, #E6FAF7, #D1F5EF); border-radius: var(--radius-medium); border-left: 4px solid #00C2A8; margin-top: var(--spacing-8);">
              <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                  <p style="font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px; color: #00C2A8; margin: 0 0 4px 0; font-weight: 700;">Your Royalty Per Copy</p>
                  <p style="font-size: 0.875rem; color: var(--color-neutral-70); margin: 0;">Your profit after all costs</p>
                </div>
                <span id="result-royalty" style="font-size: 2rem; color: #00C2A8; font-weight: 700;">$2.34</span>
              </div>
            </div>
          </div>

          <!-- ACOS Metrics Section -->
          <div id="acos-metrics-section" style="display: none; margin-top: var(--spacing-32);">
            <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--color-neutral-90); margin-bottom: var(--spacing-16); display: flex; align-items: center; gap: var(--spacing-8);">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#00C2A8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="1" x2="12" y2="23"></line>
                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
              </svg>
              ACOS Metrics for Amazon Ads
            </h3>
            <div style="display: grid; gap: var(--spacing-12);">
              <div style="padding: var(--spacing-16); background: var(--color-neutral-00); border-radius: var(--radius-medium); border-left: 4px solid #FFA500;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                  <div>
                    <p style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--color-neutral-60); margin: 0 0 4px 0; font-weight: 600;">Breakeven ACOS</p>
                    <p style="font-size: 0.875rem; color: var(--color-neutral-70); margin: 0;">The maximum ACOS to avoid losses</p>
                  </div>
                  <span id="result-breakeven-acos" style="font-size: 1.5rem; color: #FF8C00; font-weight: 700;">27.51%</span>
                </div>
              </div>

              <div style="padding: var(--spacing-16); background: var(--color-neutral-00); border-radius: var(--radius-medium); border-left: 4px solid #00C2A8;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                  <div>
                    <p style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--color-neutral-60); margin: 0 0 4px 0; font-weight: 600;">Target ACOS</p>
                    <p style="font-size: 0.875rem; color: var(--color-neutral-70); margin: 0;">Recommended ACOS for profitability</p>
                  </div>
                  <span id="result-target-acos" style="font-size: 1.5rem; color: #00C2A8; font-weight: 700;">18.34%</span>
                </div>
              </div>

              <div style="padding: var(--spacing-16); background: var(--color-neutral-00); border-radius: var(--radius-medium); border-left: 4px solid var(--color-primary-60);">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                  <div>
                    <p style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--color-neutral-60); margin: 0 0 4px 0; font-weight: 600;">Target Ad Spend per Sale</p>
                    <p style="font-size: 0.875rem; color: var(--color-neutral-70); margin: 0;">Maximum amount you can afford to spend on advertising to make a profitable sale</p>
                  </div>
                  <span id="result-max-ad-spend" style="font-size: 1.5rem; color: var(--color-primary-60); font-weight: 700;">$3.67</span>
                </div>
              </div>
            </div>
          </div>

          <div style="margin-top: var(--spacing-24); padding: var(--spacing-16); background: var(--color-neutral-00); border-radius: var(--radius-medium); text-align: center;">
            <p style="font-size: 0.875rem; color: var(--color-neutral-60); margin: 0;">
              📝 Note: This is an estimate. Actual royalties may vary based on Amazon's policies and market-specific fees.
            </p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Chrome Extension Service -->
<div id="service-chrome-extension" class="service-section" style="display: none;">
  <div class="section plottybot-homepage aligncenter" style="padding: var(--spacing-48) var(--spacing-16);">
    <div style="max-width: 900px; margin: 0 auto; background: var(--color-neutral-00); border: 1px solid var(--color-neutral-30); border-radius: var(--radius-large); box-shadow: 0 8px 32px rgba(0,0,0,0.06); padding: var(--spacing-40);">

      <!-- Header -->
      <div style="text-align: center; margin-bottom: var(--spacing-40);">
        <div style="display: inline-flex; align-items: center; justify-content: center; width: 80px; height: 80px; background: linear-gradient(135deg, var(--color-primary-50), var(--color-primary-60)); border-radius: var(--radius-large); margin-bottom: var(--spacing-24); box-shadow: 0 8px 24px rgba(0, 194, 168, 0.3);">
          <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <circle cx="12" cy="12" r="4"></circle>
            <line x1="21.17" y1="8" x2="12" y2="8"></line>
            <line x1="3.95" y1="6.06" x2="8.54" y2="14"></line>
            <line x1="10.88" y1="21.94" x2="15.46" y2="14"></line>
          </svg>
        </div>
        <h1 class="text--heading-lg" style="color: var(--color-neutral-90); margin-bottom: var(--spacing-16); font-size: 2rem;">Plottybot Insights Chrome Extension</h1>
        <p class="text--body-lg" style="color: var(--color-neutral-70); max-width: 650px; margin: 0 auto; line-height: 1.6;">Browse Amazon books, keywords, and categories while getting instant data on demand, profit margins, and niche profitability - all the insights you need to identify winning opportunities on Amazon KDP.</p>
      </div>

      <!-- Features List -->
      <div style="margin-bottom: var(--spacing-40);">
        <div style="display: grid; gap: var(--spacing-24); margin-bottom: var(--spacing-40);">

          <div style="display: flex; gap: var(--spacing-16); align-items: start; padding: var(--spacing-24); background: var(--color-neutral-05); border-radius: var(--radius-medium); border-left: 4px solid var(--color-primary-50);">
            <div style="width: 40px; height: 40px; background: var(--color-primary-10); border-radius: var(--radius-medium); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary-60)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                <line x1="12" y1="22.08" x2="12" y2="12"></line>
              </svg>
            </div>
            <div>
              <h3 style="color: var(--color-neutral-90); font-size: 1.125rem; font-weight: 700; margin: 0 0 var(--spacing-8) 0;">Analyze Demand Instantly</h3>
              <p style="color: var(--color-neutral-70); margin: 0; line-height: 1.6;">While browsing Amazon books, keywords, and categories, instantly see demand metrics, sales estimates, and market trends to identify what's actually selling.</p>
            </div>
          </div>

          <div style="display: flex; gap: var(--spacing-16); align-items: start; padding: var(--spacing-24); background: var(--color-neutral-05); border-radius: var(--radius-medium); border-left: 4px solid var(--color-primary-50);">
            <div style="width: 40px; height: 40px; background: var(--color-primary-10); border-radius: var(--radius-medium); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary-60)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="1" x2="12" y2="23"></line>
                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
              </svg>
            </div>
            <div>
              <h3 style="color: var(--color-neutral-90); font-size: 1.125rem; font-weight: 700; margin: 0 0 var(--spacing-8) 0;">Calculate Profit Margins</h3>
              <p style="color: var(--color-neutral-70); margin: 0; line-height: 1.6;">Get real-time calculations of potential profit margins, printing costs, and royalties as you browse Amazon, so you know exactly what you'll earn before you publish.</p>
            </div>
          </div>

          <div style="display: flex; gap: var(--spacing-16); align-items: start; padding: var(--spacing-24); background: var(--color-neutral-05); border-radius: var(--radius-medium); border-left: 4px solid var(--color-primary-50);">
            <div style="width: 40px; height: 40px; background: var(--color-primary-10); border-radius: var(--radius-medium); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary-60)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"></path>
                <path d="M12 18V6"></path>
              </svg>
            </div>
            <div>
              <h3 style="color: var(--color-neutral-90); font-size: 1.125rem; font-weight: 700; margin: 0 0 var(--spacing-8) 0;">Discover Profitable Niches</h3>
              <p style="color: var(--color-neutral-70); margin: 0; line-height: 1.6;">Access comprehensive data on demand, competition, and profitability directly while browsing Amazon categories and keywords - everything you need to identify winning niches without switching tabs.</p>
            </div>
          </div>

        </div>
      </div>

      <!-- Download Button -->
      <div style="text-align: center;">
        <a href="https://chromewebstore.google.com/detail/plottybot-insights/blhgbobhipddmlpmgdjdcjagfokpbhad?authuser=1&hl=it" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: var(--spacing-12); padding: var(--spacing-24) var(--spacing-40); background: linear-gradient(135deg, var(--color-primary-60), var(--color-primary-70)); color: var(--color-neutral-00); text-decoration: none; border-radius: var(--radius-medium); font-weight: 700; font-size: 1.125rem; transition: all 0.3s; box-shadow: 0 8px 24px rgba(0, 194, 168, 0.3); text-transform: uppercase; letter-spacing: 0.5px;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 32px rgba(0, 194, 168, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 24px rgba(0, 194, 168, 0.3)'">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <circle cx="12" cy="12" r="4"></circle>
            <line x1="21.17" y1="8" x2="12" y2="8"></line>
            <line x1="3.95" y1="6.06" x2="8.54" y2="14"></line>
            <line x1="10.88" y1="21.94" x2="15.46" y2="14"></line>
          </svg>
          <span>Download Chrome Extension</span>
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M7 17L17 7M17 7H7M17 7V17"/>
          </svg>
        </a>
        <p style="margin-top: var(--spacing-16); color: var(--color-neutral-60); font-size: 0.875rem;">
          Free for all Plottybot users • Compatible with Chrome & Edge
        </p>
      </div>

      <!-- Additional Info -->
      <div style="margin-top: var(--spacing-40); padding: var(--spacing-24); background: var(--color-primary-05); border-radius: var(--radius-medium); border: 1px solid var(--color-primary-20);">
        <div style="display: flex; gap: var(--spacing-12); align-items: start;">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary-60)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; margin-top: 2px;">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="16" x2="12" y2="12"></line>
            <line x1="12" y1="8" x2="12.01" y2="8"></line>
          </svg>
          <div>
            <h4 style="color: var(--color-neutral-90); font-size: 1rem; font-weight: 700; margin: 0 0 var(--spacing-8) 0;">Installation Instructions</h4>
            <p style="color: var(--color-neutral-70); margin: 0; line-height: 1.6; font-size: 0.875rem;">
              Click the download button above to visit the Chrome Web Store. Then click "Add to Chrome" to install the extension. Once installed, log in with your Plottybot account credentials to start using all the features.
            </p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

  </div> <!-- End Main Content -->
</div> <!-- End Main Container -->

<style>
@keyframes spin {
  to { transform: rotate(360deg); }
}

@keyframes slideIn {
  from {
    opacity: 0;
    transform: translateX(-20px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes pulse {
  0%, 100% {
    box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4);
  }
  50% {
    box-shadow: 0 0 0 8px rgba(255, 255, 255, 0);
  }
}

/* Sidebar Styles */
.sidebar {
  scrollbar-width: thin;
  scrollbar-color: #C0C0C0 transparent;
  display: flex;
  flex-direction: column;
}

.sidebar::-webkit-scrollbar {
  width: 6px;
}

.sidebar::-webkit-scrollbar-track {
  background: transparent;
}

.sidebar::-webkit-scrollbar-thumb {
  background: #C0C0C0;
  border-radius: 3px;
}

.sidebar::-webkit-scrollbar-thumb:hover {
  background: #A0A0A0;
}

.sidebar.collapsed {
  width: 0 !important;
  margin-left: -280px;
  overflow: hidden;
}

.sidebar-toggle.collapsed {
  left: 0 !important;
}

.main-content.expanded {
  margin-left: 0 !important;
}

/* Navigation Styles */
.service-nav-btn {
  position: relative;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.service-nav-btn:hover {
  background: var(--color-primary-05) !important;
  border-left-color: var(--color-primary-40) !important;
  color: var(--color-neutral-90) !important;
}

.service-nav-btn:hover span:first-of-type {
  background: var(--color-primary-40) !important;
}

.service-nav-btn:hover span:first-of-type svg {
  stroke: white !important;
}

.service-nav-btn.active {
  background: var(--color-primary-10) !important;
  border-left-color: var(--color-primary-60) !important;
  color: var(--color-neutral-90) !important;
}

.service-nav-btn.active span:first-of-type {
  background: var(--color-primary-50) !important;
}

.service-nav-btn.active span:first-of-type svg {
  stroke: white !important;
}

.sidebar-toggle {
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.sidebar-toggle:hover {
  background: var(--color-primary-50) !important;
  border-color: var(--color-primary-60) !important;
  color: white !important;
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  transform: scale(1.05);
}

.sidebar-toggle:hover svg {
  stroke: white !important;
}

.sidebar-toggle:active {
  transform: scale(0.95);
}

.sidebar-toggle svg {
  transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.sidebar-toggle.collapsed svg {
  transform: rotate(180deg);
}

.service-section {
  transition: opacity 0.3s ease;
}

.service-section:not(.active) {
  display: none !important;
}

/* Scrollable dropdown menu */
.dropdown-menu-scrollable {
  max-height: 300px;
  overflow-y: auto;
}

.dropdown-menu-scrollable::-webkit-scrollbar {
  width: 8px;
}

.dropdown-menu-scrollable::-webkit-scrollbar-track {
  background: var(--color-neutral-10);
  border-radius: var(--radius-small);
}

.dropdown-menu-scrollable::-webkit-scrollbar-thumb {
  background: var(--color-neutral-40);
  border-radius: var(--radius-small);
}

.dropdown-menu-scrollable::-webkit-scrollbar-thumb:hover {
  background: var(--color-neutral-50);
}

/* Button hover effects for categories search */
#categories-search-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
  background: linear-gradient(135deg, var(--color-primary-70), var(--color-primary-80));
}

#categories-search-btn:active {
  transform: translateY(0);
  box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
}

/* Remove slider styles since we use dropdowns now */
.range-input, .range-slider-wrapper, .range-track-bg, .range-track-fill { display: none !important; }

/* Toggle Switch Styling */
.slider:before {
  position: absolute;
  content: "";
  height: 22px;
  width: 22px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  transition: .3s;
  border-radius: 50%;
  box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

input:checked + .slider {
  background-color: var(--color-primary-60);
}

input:checked + .slider:before {
  transform: translateX(24px);
}

.slider:hover {
  box-shadow: inset 0 1px 3px rgba(0,0,0,0.15);
}

/* Toggle Label Interactions */
.toggle-label {
  user-select: none;
}

/* Button Styling */
#apply-filters:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
  background: linear-gradient(135deg, var(--color-primary-70), var(--color-primary-80));
}

#apply-filters:active {
  transform: translateY(0);
  box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
}

/* Select Dropdown Styling */
select {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

select:hover {
  border-color: var(--color-primary-40);
}

select:focus {
  outline: none;
  border-color: var(--color-primary-60);
  box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

/* Ensure select options display properly */
select option {
  padding: 8px;
  line-height: 1.5;
}

/* Categories Section Styling */
#categories-list {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
  gap: 8px;
}

.category-checkbox-label {
  display: flex;
  align-items: center;
  gap: 6px;
  padding: 4px 6px;
  font-size: 0.85rem;
  color: var(--color-neutral-90);
  cursor: pointer;
  background: none;
  border-radius: 0;
  border: none;
  box-shadow: none;
  margin: 0;
}

/* Sort Buttons Styles */
.sort-buttons {
  display: flex;
  border: 2px solid var(--color-neutral-30);
  border-radius: var(--radius-medium);
  overflow: hidden;
}

.sort-btn {
  padding: 8px 16px;
  background: var(--color-neutral-00);
  color: var(--color-neutral-90);
  border: none;
  font-size: 0.875rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s;
}

.sort-btn.active {
  background: var(--color-primary-60);
  color: var(--color-neutral-00);
}

/* Responsive Styles */
@media (max-width: 768px) {
  .sidebar {
    width: 0 !important;
    margin-left: -280px;
  }

  .sidebar-toggle {
    left: 0 !important;
  }

  .sidebar:not(.collapsed) {
    width: 280px !important;
    margin-left: 0;
  }

  .sidebar-toggle:not(.collapsed) {
    left: 280px !important;
  }
}

@media (min-width: 769px) and (max-width: 1024px) {
  .sidebar {
    width: 240px;
  }

  .sidebar.collapsed {
    width: 0 !important;
    margin-left: -240px;
  }

  .sidebar-toggle {
    left: 240px;
  }
}
</style>

<script>

document.addEventListener('DOMContentLoaded', function() {
  // Sidebar Toggle Functionality
  const sidebar = document.getElementById('sidebar');
  const sidebarToggle = document.getElementById('sidebar-toggle');
  const mainContent = document.getElementById('main-content');

  if (sidebarToggle && sidebar && mainContent) {
    sidebarToggle.addEventListener('click', function(e) {
      e.preventDefault();
      sidebar.classList.toggle('collapsed');
      sidebarToggle.classList.toggle('collapsed');
      mainContent.classList.toggle('expanded');
    });
  }

  // Service Navigation Functionality
  const navButtons = document.querySelectorAll('.service-nav-btn');
  const serviceSections = document.querySelectorAll('.service-section');

  function switchService(targetService) {
    // Update navigation buttons
    navButtons.forEach(btn => {
      btn.classList.remove('active');
      btn.style.borderLeftColor = 'transparent';
      btn.style.color = 'var(--color-neutral-70)';
      btn.style.background = 'transparent';

      // Reset icon background
      const iconSpan = btn.querySelector('span:first-of-type');
      if (iconSpan) {
        iconSpan.style.background = '#E0E0E0';
        const svg = iconSpan.querySelector('svg');
        if (svg) {
          svg.style.stroke = 'var(--color-neutral-70)';
        }
      }
    });

    // Update sections
    serviceSections.forEach(section => {
      section.classList.remove('active');
      section.style.display = 'none';
    });

    // Activate selected service
    const activeBtn = document.querySelector(`[data-service="${targetService}"]`);
    const activeSection = document.getElementById(`service-${targetService}`);

    if (activeBtn && activeSection) {
      activeBtn.classList.add('active');
      activeBtn.style.borderLeftColor = 'var(--color-primary-60)';
      activeBtn.style.color = 'var(--color-neutral-90)';
      activeBtn.style.background = 'var(--color-primary-10)';

      // Update active icon
      const iconSpan = activeBtn.querySelector('span:first-of-type');
      if (iconSpan) {
        iconSpan.style.background = 'var(--color-primary-50)';
        const svg = iconSpan.querySelector('svg');
        if (svg) {
          svg.style.stroke = 'white';
        }
      }

      activeSection.classList.add('active');
      activeSection.style.display = 'block';
    }
  }

  // Add click event listeners to navigation buttons
  navButtons.forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      const service = this.getAttribute('data-service');
      switchService(service);
    });
  });

  // Available markets and macro categories data for Categories service
  const availableMarkets = [
    { code: 'US', name: 'United States', flag: '🇺🇸' },
    { code: 'UK', name: 'United Kingdom', flag: '🇬🇧' },
    { code: 'DE', name: 'Germany', flag: '🇩🇪' },
    { code: 'FR', name: 'France', flag: '🇫🇷' },
    { code: 'ES', name: 'Spain', flag: '🇪🇸' }
  ];

  const macroCategoriesData = {
    ES: [
      'Literatura y ficción', 'Arte, cine y fotografía', 'Biografías, diarios y hechos reales',
      'Libros universitarios y de estudios superiores', 'Cómics, manga y novelas gráficas',
      'Juvenil', 'Infantil', 'Religión', 'Libros en idiomas extranjeros', 'Humor',
      'Deportes y aire libre', 'Ciencias, tecnología y medicina', 'Erótica',
      'Guías de estudio y repaso', 'Salud, familia y desarrollo personal',
      'Hogar, manualidades y estilos de vida', 'Romántica', 'Libros LGBTQ+',
      'Sociedad y ciencias sociales', 'Economía y empresa', 'Ficción histórica',
      'Lengua, lingüística y redacción', 'Libros en inglés', 'Fantasía, terror y ciencia ficción',
      'Historia', 'Policíaca, negra y suspense', 'Informática, internet y medios digitales',
      'Consulta', 'Libros escolares', 'Cocina, bebida y hospitalidad', 'Viajes',
      'Educación y consulta', 'Calendarios', 'Política', 'Derecho', 'Libros en español',
      'Acción y aventura', 'Libros infantiles', 'Tecnología y medicina',
      'Fantadía, terror y ciencia ficción', 'Libros en catalán', 'Libros en gallego',
      'Libros en euskera', 'Fantástico, terror y ciencia ficción'
    ],
    UK: [
      'Young Adult', 'Crime, Thrillers & Mystery', 'Science & Nature', 'Home & Garden',
      'Romance', 'Biography', 'Sports, Hobbies & Games', 'Erotica', 'Fiction',
      'Society, Politics & Philosophy', 'Children\'s Books', 'Humour', 'Comics & Graphic Novels',
      'Art, Architecture & Photography', 'Religion & Spirituality', 'Health, Family & Lifestyle',
      'Reference', 'Business, Finance & Law', 'School Books', 'Scientific, Technical & Medical',
      'Science Fiction & Fantasy', 'Computers & Internet', 'Medical', 'Mind, Body & Spirit',
      'Poetry, Drama & Criticism', 'Education Studies & Teaching', 'Languages', 'Food & Drink',
      'History', 'Horror', 'Biology', 'Travel & Holiday', 'Calendars, Diaries, Annuals & More',
      'Poetry', 'Computer & Internet', 'Games', 'Language'
    ],
    US: [
      'Biographies & Memoirs', 'Children\'s Books', 'Engineering & Transportation',
      'New, Used & Rental Textbooks', 'Teens', 'Education & Teaching', 'Cookbooks, Food & Wine',
      'Science & Math', 'Comics & Graphic Novels', 'Parenting & Relationships',
      'Computers & Technology', 'Humor & Entertainment', 'Biologies & Memoirs', 'Medical Books',
      'Politics & Social Sciences', 'Business & Money', 'Reference', 'Travel',
      'Arts & Photography', 'Sports & Outdoors', 'Religion & Spirituality',
      'Christian Books & Bibles', 'Literature & Fiction', 'Health, Fitness & Dieting',
      'History', 'Mystery, Thriller & Suspense', 'Self-Help', 'Crafts, Hobbies & Home',
      'Cooking, Food & Wine', 'Law', 'Test Preparation', 'Science Fiction & Fantasy',
      'Romance', 'Lesbian, Gay, Bisexual & Transgender Books', 'Libros en español',
      'Cooking & Food', 'Young Adult Fiction', 'Teen & Young Adult', 'Teen\'s Books',
      'Pets & Animal Care', 'Medicine & Health Sciences', 'Calendars', 'Books on CD', 'Cooking'
    ],
    DE: [
      'Screen, Art & Culture', 'Children\'s Books', 'Reference', 'Biographies & Memoirs',
      'Business & Careers', 'Erotic', 'Guidebooks', 'Comics & Manga', 'Home & Garden',
      'Fiction', 'Natural Science & Technical', 'Arts & Photography', 'Mystery & Thrillers',
      'Medical & Health Sciences', 'Romance', 'Religion', 'Sports', 'Music',
      'Politics & History', 'Computers & Internet', 'Gift Books', 'Self-help',
      'Cooking, Food & Wine', 'Science', 'Teens', 'Music & Arts', 'Foreign Language Books',
      'Travel', 'Calendars', 'Science Fiction & Fantasy', 'Esoteric', 'Health & Medicine',
      'Scores, Songbooks & Lyrics', 'Music & Scores', 'Health Sciences & Medicine',
      'Biologies & Memoirs', 'Rest of the World (En)', 'Fitness & Strength Training',
      'Health & Fitness', 'Music & Singing', 'Art & Culture', 'Audio Books',
      'Political Science & International Relations', 'Medicine & Health Sciences',
      'Science & Engineering', 'Teen Fiction', 'Calendar & Books', 'Postgott', 'Arts & Culture'
    ],
    FR: [
      'Dictionnaires, langues et encyclopédies', 'Livres pour enfants', 'Adolescents',
      'Art, Musique et Cinéma', 'Sciences humaines', 'Famille, Santé et Bien-être',
      'Santé, Forme et Diététique', 'Actu, Politique et Société', 'Policier et Suspense',
      'Littérature', 'Sciences, Techniques et Médecine', 'Loisirs créatifs, décoration et passions',
      'Religions et Spiritualités', 'Romance et littérature sentimentale',
      'Livres anglais et étrangers', 'Informatique et Internet', 'Histoire',
      'Ésotérisme et Paranormal', 'Science-Fiction', 'Fantasy et Terreur', 'Sports',
      'Droit', 'Scolaire et Parascolaire', 'Cuisine et Vins', 'Etudes supérieures',
      'Manga', 'Tourisme et Voyages', 'Entreprise et Bourse', 'Erotisme',
      'Bandes dessinées', 'Nature et animaux', 'Humour', 'Arts, Musique et Cinéma',
      'Calendriers et Agendas', 'Beaux livres', 'Fantasy et Terreurs', 'Musique',
      'Entreprises et Bourse'
    ]
  };

  // Categories Service Functionality
  function initializeCategoriesService() {
    const categoriesMarketDropdown = document.getElementById('categories-market-dropdown');
    const categoriesMarketSelected = document.getElementById('categories-market-selected');
    const categoriesMarketOptions = document.getElementById('categories-market-options');
    const categoriesMarketSelector = document.getElementById('categories-market-selector');
    const categoriesMarketSelectedLabel = document.getElementById('categories-market-selected-label');

    const categoriesMacroCategoryDropdown = document.getElementById('categories-macro-category-dropdown');
    const categoriesMacroCategorySelected = document.getElementById('categories-macro-category-selected');
    const categoriesMacroCategoryOptions = document.getElementById('categories-macro-category-options');
    const categoriesMacroCategorySelector = document.getElementById('categories-macro-category-selector');
    const categoriesMacroCategorySelectedLabel = document.getElementById('categories-macro-category-selected-label');

    const categoriesKeywordSearch = document.getElementById('categories-keyword-search');
    const categoriesSearchBtn = document.getElementById('categories-search-btn');
    const categoriesLoadingIndicator = document.getElementById('categories-loading-indicator');
    const categoriesResultsContainer = document.getElementById('categories-results-container');

    // Populate market options
    function populateMarketOptions() {
      categoriesMarketOptions.innerHTML = '';
      availableMarkets.forEach(market => {
        const li = document.createElement('li');
        const a = document.createElement('a');
        a.href = '#';
        a.setAttribute('data-value', market.code);
        a.className = 'dropdown-item';
        a.style = 'display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;';
        a.innerHTML = `<span class="navigation-text">${market.flag} ${market.name}</span>`;
        li.appendChild(a);
        categoriesMarketOptions.appendChild(li);
      });
    }

    // Populate macro category options based on selected market
    function populateMacroCategoryOptions(marketCode) {
      categoriesMacroCategoryOptions.innerHTML = '';
      const categories = macroCategoriesData[marketCode] || [];

      if (categories.length === 0) {
        const li = document.createElement('li');
        li.innerHTML = '<span style="padding: 12px; color: var(--color-neutral-60);">No categories available</span>';
        categoriesMacroCategoryOptions.appendChild(li);
        return;
      }

      categories.forEach(category => {
        const li = document.createElement('li');
        const a = document.createElement('a');
        a.href = '#';
        a.setAttribute('data-value', category);
        a.className = 'dropdown-item';
        a.style = 'display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;';
        a.innerHTML = `<span class="navigation-text">${category}</span>`;
        li.appendChild(a);
        categoriesMacroCategoryOptions.appendChild(li);
      });
    }

    // Market dropdown functionality
    categoriesMarketSelected.addEventListener('click', function(e) {
      e.preventDefault();
      categoriesMarketOptions.style.display = categoriesMarketOptions.style.display === 'block' ? 'none' : 'block';
    });

    // Macro category dropdown functionality
    categoriesMacroCategorySelected.addEventListener('click', function(e) {
      e.preventDefault();
      categoriesMacroCategoryOptions.style.display = categoriesMacroCategoryOptions.style.display === 'block' ? 'none' : 'block';
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
      if (!categoriesMarketDropdown.contains(e.target)) {
        categoriesMarketOptions.style.display = 'none';
      }
      if (!categoriesMacroCategoryDropdown.contains(e.target)) {
        categoriesMacroCategoryOptions.style.display = 'none';
      }
    });

    // Market selection handler
    categoriesMarketOptions.addEventListener('click', function(e) {
      if (e.target.closest('.dropdown-item')) {
        e.preventDefault();
        const item = e.target.closest('.dropdown-item');
        const value = item.getAttribute('data-value');
        categoriesMarketSelector.value = value;
        categoriesMarketSelectedLabel.innerHTML = item.querySelector('.navigation-text').innerHTML;
        categoriesMarketOptions.style.display = 'none';

        // Update macro categories for selected market
        populateMacroCategoryOptions(value);
        // Reset macro category selection
        categoriesMacroCategorySelector.value = '';
        categoriesMacroCategorySelectedLabel.textContent = 'Select a category...';
      }
    });

    // Macro category selection handler
    categoriesMacroCategoryOptions.addEventListener('click', function(e) {
      if (e.target.closest('.dropdown-item')) {
        e.preventDefault();
        const item = e.target.closest('.dropdown-item');
        const value = item.getAttribute('data-value');
        categoriesMacroCategorySelector.value = value;
        categoriesMacroCategorySelectedLabel.textContent = item.querySelector('.navigation-text').textContent;
        categoriesMacroCategoryOptions.style.display = 'none';
      }
    });

    // Search button functionality
    categoriesSearchBtn.addEventListener('click', async function() {
      const market = categoriesMarketSelector.value.toLowerCase();
      const macroCategory = categoriesMacroCategorySelector.value;
      const keyword = categoriesKeywordSearch.value.trim();

      if (!macroCategory) {
        alert('Please select a macro category before searching.');
        return;
      }

      // Show loading indicator
      categoriesLoadingIndicator.style.display = 'block';
      categoriesResultsContainer.style.display = 'none';
      categoriesSearchBtn.disabled = true;

      try {
        const payload = {
          market: market,
          macro_category: macroCategory,
          keyword: keyword || undefined
        };

        // Remove undefined values
        Object.keys(payload).forEach(key => {
          if (payload[key] === undefined) delete payload[key];
        });

        console.log('Categories API Request Payload:', payload);

        const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=plottybot_search_categories', {
          method: 'POST',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(payload)
        });

        if (!response.ok) {
          throw new Error(`API error: ${response.status}`);
        }

        const data = await response.json();
        console.log('Categories API Response:', data);

        // Hide loading indicator
        categoriesLoadingIndicator.style.display = 'none';
        categoriesSearchBtn.disabled = false;

        // Render results
        renderCategoriesResults(data);

      } catch (error) {

        console.error('Error fetching categories:', error);
        categoriesLoadingIndicator.style.display = 'none';
        categoriesSearchBtn.disabled = false;
        categoriesResultsContainer.innerHTML = `
          <div style="text-align: center; padding: var(--spacing-40); color: var(--color-danger-60);">
            <p style="font-size: 1.125rem; font-weight: 600; margin-bottom: var(--spacing-12);">Error loading categories</p>
            <p style="color: var(--color-neutral-60);">${error.message}</p>
          </div>
        `;
        categoriesResultsContainer.style.display = 'block';
      }
    });

    // Function to render categories results
    function renderCategoriesResults(data, sortOrder = 'desc') {
      const { count, results, search_criteria } = data;

      // Sort results based on sortOrder
      const sortedResults = [...results].sort((a, b) => {
        const aSales = a.copies_per_day || 0;
        const bSales = b.copies_per_day || 0;
        if (sortOrder === 'asc') {
          return aSales - bSales;
        } else {
          return bSales - aSales;
        }
      });

      // Amazon bestseller base URLs by market
      const amazonBestsellerUrls = {
        'us': 'https://www.amazon.com/Best-Sellers-Books/zgbs/books/',
        'uk': 'https://www.amazon.co.uk/Best-Sellers-Books/zgbs/books/',
        'de': 'https://www.amazon.de/gp/bestsellers/books/',
        'fr': 'https://www.amazon.fr/gp/bestsellers/books/',
        'es': 'https://www.amazon.es/gp/bestsellers/books/'
      };

      let html = `
        <div style="margin-bottom: var(--spacing-24); padding: var(--spacing-24); background: var(--color-neutral-10); border-radius: var(--radius-medium);">
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spacing-12);">
            <h3 style="font-size: 1.25rem; font-weight: 700; margin: 0; color: var(--color-neutral-90);">
              Search Results for "${search_criteria.macro_category}"
            </h3>
            <div style="display: flex; align-items: center; gap: var(--spacing-12);">
              <span style="font-size: 0.875rem; font-weight: 600; color: var(--color-neutral-70);">Sort by Daily Sales:</span>
              <div class="sort-buttons" style="display: flex; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); overflow: hidden;">
                <button class="sort-btn ${sortOrder === 'desc' ? 'active' : ''}" data-sort="desc" style="padding: 8px 16px; border: none; font-size: 0.875rem; font-weight: 600; cursor: pointer; transition: all 0.2s;">
                  Highest First
                </button>
                <button class="sort-btn ${sortOrder === 'asc' ? 'active' : ''}" data-sort="asc" style="padding: 8px 16px; border: none; font-size: 0.875rem; font-weight: 600; cursor: pointer; transition: all 0.2s;">
                  Lowest First
                </button>
              </div>
            </div>
          </div>
          <div style="display: flex; gap: var(--spacing-16); flex-wrap: wrap; margin-bottom: var(--spacing-12);">
            <span style="background: var(--color-primary-10); color: var(--color-primary-70); padding: 4px 12px; border-radius: var(--radius-medium); font-size: 0.875rem; font-weight: 600;">
              Market: ${search_criteria.market.toUpperCase()}
            </span>
            ${search_criteria.keyword ? `<span style="background: var(--color-secondary-10); color: var(--color-secondary-70); padding: 4px 12px; border-radius: var(--radius-medium); font-size: 0.875rem; font-weight: 600;">Keyword: "${search_criteria.keyword}"</span>` : ''}
          </div>
          <p style="font-size: 1rem; font-weight: 600; color: var(--color-neutral-90); margin: 0;">
            Found ${count} result${count !== 1 ? 's' : ''} • Sorted by Daily Sales (${sortOrder === 'desc' ? 'highest' : 'lowest'} first)
          </div>
      `;

      if (count === 0) {
        html += `
          <div style="text-align: center; padding: var(--spacing-40); color: var(--color-neutral-60);">
            <p style="font-size: 1.125rem; font-weight: 600;">No categories found</p>
            <p>Try adjusting your search criteria or selecting a different macro category.</p>
          </div>
        `;
      } else {
        html += '<div style="display: grid; gap: var(--spacing-16);">';

        sortedResults.forEach((category, index) => {
          const amazonUrl = amazonBestsellerUrls[search_criteria.market] + (category.category_id || '');
          const dailySales = Math.round(category.copies_per_day || 0);
          const bsr = category.bsr || 'N/A';

          html += `
            <div style="padding: var(--spacing-24); background: var(--color-neutral-00); border: 1px solid var(--color-neutral-30); border-radius: var(--radius-large); box-shadow: 0 2px 8px rgba(0,0,0,0.04); transition: all 0.3s;" onmouseover="this.style.boxShadow='0 4px 16px rgba(0,0,0,0.08)'" onmouseout="this.style.boxShadow='0 2px 8px rgba(0,0,0,0.04)'">

              <!-- Category Path (Clickable) -->
              <div style="margin-bottom: var(--spacing-16);">
                <a href="${amazonUrl}" target="_blank" rel="noopener noreferrer" style="color: var(--color-primary-60); text-decoration: none; font-size: 1.125rem; font-weight: 600; line-height: 1.4; transition: color 0.2s;" onmouseover="this.style.color='var(--color-primary-70)'" onmouseout="this.style.color='var(--color-primary-60)'">
                  ${category.category_path || category.name || `Category ${index + 1}`}
                </a>
              </div>

              <!-- Metrics Row -->
              <div style="display: flex; gap: var(--spacing-32); flex-wrap: wrap; align-items: center;">

                <!-- Daily Sales to #1 -->
                <div style="flex: 1; min-width: 140px;">
                  <p style="font-size: 0.75rem; text-transform: uppercase, letter-spacing: 0.5px; color: var(--color-neutral-60); margin: 0 0 4px 0; font-weight: 600;">Daily Sales to #1</p>
                  <p style="font-size: 1.25rem; font-weight: 700; color: var(--color-success-60); margin: 0;">
                    ${dailySales.toLocaleString()} <span style="font-size: 0.875rem; color: var(--color-neutral-70);">copies/day</span>
                  </p>
                </div>

                <!-- Macro Category -->
                <div style="flex: 1; min-width: 120px;">
                  <p style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--color-neutral-60); margin: 0 0 4px 0; font-weight: 600;">Macro Category</p>
                  <span style="background: var(--color-secondary-10); color: var(--color-secondary-70); padding: 4px 12px; border-radius: var(--radius-medium); font-size: 0.875rem; font-weight: 600; word-break: break-word; display: inline-block; max-width: 100%;">
                    ${category.macro_category || search_criteria.macro_category || 'Unknown'}
                  </span>
                </div>

                <!-- View on Amazon Button -->
                <div style="margin-left: auto;">
                  <a href="${amazonUrl}" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: var(--spacing-8); padding: 12px 20px; background: linear-gradient(135deg, var(--color-primary-60), var(--color-primary-70)); color: var(--color-neutral-00); text-decoration: none; border-radius: var(--radius-medium); font-weight: 600; font-size: 0.875rem; transition: all 0.2s; box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(99, 102, 241, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(99, 102, 241, 0.3)'">
                    View on Amazon
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M7 17L17 7M17 7H7M17 7V17"/>
                    </svg>
                  </a>
                </div>

              </div>
            </div>
          `;
        });

        html += '</div>';
      }

      categoriesResultsContainer.innerHTML = html;
      categoriesResultsContainer.style.display = 'block';

      // Add event listeners for sort buttons
      const sortButtons = document.querySelectorAll('.sort-btn');
      sortButtons.forEach(btn => {
        btn.addEventListener('click', function() {
          const sortOrder = this.getAttribute('data-sort');
          renderCategoriesResults(data, sortOrder);
        });
      });

      // Scroll to results
      document.getElementById('categories-results').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // Initialize the dropdowns
    populateMarketOptions();
    populateMacroCategoryOptions('US'); // Default to US
  }

  // Initialize Categories service when the page loads
  initializeCategoriesService();

  // Currency mapping
  const currencies = <?php echo json_encode($currencies); ?>;

  // Market selector change handler
  const marketSelector = document.getElementById('market-selector');
  const currencySymbol = document.getElementById('currency-symbol');
  const currencyMin = document.getElementById('currency-min');
  const currencyMax = document.getElementById('currency-max');

  marketSelector.addEventListener('change', function() {
    const selectedMarket = this.value;
    const currency = currencies[selectedMarket];
    currencySymbol.textContent = `(${currency})`;
    currencyMin.textContent = currency;
    currencyMax.textContent = currency;
  });

  // Publisher dropdown handler
  const publisherDropdown = document.getElementById('publisher-dropdown');
  const publisherSelected = document.getElementById('publisher-selected');
  const publisherOptions = document.getElementById('publisher-options');
  const publisherSelectorInput = document.getElementById('publisher-selector');
  const publisherSelectedLabel = document.getElementById('publisher-selected-label');

  publisherSelected.addEventListener('click', function(e) {
    e.preventDefault();
    publisherOptions.style.display = publisherOptions.style.display === 'block' ? 'none' : 'block';
  });

  document.addEventListener('click', function(e) {
    if (!publisherDropdown.contains(e.target)) {
      publisherOptions.style.display = 'none';
    }
  });

  Array.from(publisherOptions.querySelectorAll('.dropdown-item')).forEach(function(item) {
    item.addEventListener('click', function(e) {
      e.preventDefault();
      const value = this.getAttribute('data-value');
      publisherSelectorInput.value = value;
      // Use innerHTML to preserve flag and text
      publisherSelectedLabel.innerHTML = this.querySelector('.navigation-text').innerHTML;
      publisherOptions.style.display = 'none';
    });
  });

  // Apply filters button
  const applyButton = document.getElementById('apply-filters');
  const loadingIndicator = document.getElementById('loading-indicator');
  const booksContainer = document.getElementById('books-container');

  applyButton.addEventListener('click', async function() {
    // Parse range values
    const bsrRange = document.getElementById('bsr-range').value;
    const priceRange = document.getElementById('price-range').value;
    const ratingsRange = document.getElementById('ratings-range').value;

    // Helper function to parse range strings
    function parseRange(rangeStr) {
      if (rangeStr.includes('+')) {
        const min = parseInt(rangeStr.replace('+', ''));
        return [min, 999999999]; // Large max value for "+" ranges
      }
      const parts = rangeStr.split('-').map(s => parseInt(s));
      return parts.length === 2 ? parts : [parts[0], parts[0]];
    }

    // Get selected categories
    const selectedCategories = Array.from(document.querySelectorAll('input[name="categories[]"]:checked'))
      .map(cb => cb.value);

    // Build API payload
    const payload = {
      market: marketSelector.value,
      bsr_range: parseRange(bsrRange),
      price_range: parseRange(priceRange),
      ratings_count_range: parseRange(ratingsRange),
      rating_range: [4, 5], // Default rating range 4-5 stars
      categories: selectedCategories,
      publisher_type: publisherSelectorInput.value === 'self' ? 'self_publisher' : null,
      limit: 100,
      offset: 0
    };

    // Remove null values
    Object.keys(payload).forEach(key => {
      if (payload[key] === null) delete payload[key];
    });

    console.log('API Request Payload:', payload);

    // Show loading indicator
    loadingIndicator.style.display = 'block';
    booksContainer.innerHTML = '';
    applyButton.disabled = true;

    try {
      const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=plottybot_search_books', {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(payload)
      });

      if (!response.ok) {
        throw new Error(`API error: ${response.status}`);
      }

      const data = await response.json();
      console.log('API Response:', data);

      // Hide loading indicator
      loadingIndicator.style.display = 'none';
      applyButton.disabled = false;

      // Render books
      renderBooks(data.books, data.total_count);

    } catch (error) {
      console.error('Error fetching books:', error);
      loadingIndicator.style.display = 'none';
      applyButton.disabled = false;
      booksContainer.innerHTML = `
        <div style="text-align: center; padding: var(--spacing-40); color: var(--color-danger-60);">
          <p style="font-size: 1.125rem; font-weight: 600; margin-bottom: var(--spacing-12);">Error loading books</p>
          <p style="color: var(--color-neutral-60);">${error.message}</p>
        </div>
      `;
    }
  });

  // Function to render books
  function renderBooks(books, totalCount) {
    if (!books || books.length === 0) {
      booksContainer.innerHTML = `
        <div style="text-align: center; padding: var(--spacing-40); color: var(--color-neutral-60);">
          <p style="font-size: 1.125rem; font-weight: 600;">No books found</p>
          <p>Try adjusting your filters to see more results.</p>
        </div>
      `;
      return;
    }

    // Map market codes to Amazon domains
    const amazonDomains = {
      'US': 'amazon.com',
      'UK': 'amazon.co.uk',
      'DE': 'amazon.de',
      'FR': 'amazon.fr',
      'ES': 'amazon.es'
    };

    // Header with count
    let html = `
      <div style="margin-bottom: var(--spacing-24); padding: var(--spacing-16); background: var(--color-neutral-10); border-radius: var(--radius-medium);">
        <p style="font-size: 1.125rem; font-weight: 600; color: var(--color-neutral-90);">
          Found ${totalCount || books.length} book${(totalCount || books.length) !== 1 ? 's' : ''}
        </p>
      </div>
      <div style="display: grid; gap: var(--spacing-24);">
    `;

    // Render each book
    books.forEach(book => {
      const authors = Array.isArray(book.authors) ? book.authors.join(', ') : 'Unknown Author';
      const rating = book.average_rating || 0;
      const reviewsCount = book.reviews_count || 0;
      const bsr = book.bsr || 'N/A';
      const price = book.paperback_price || 'N/A';
      const cover = book.cover || '';
      const title = book.title || 'Untitled';
      const asin = book.asin || '';

      // Generate Amazon link
      const market = marketSelector.value;
      const amazonDomain = amazonDomains[market] || 'amazon.com';
      const amazonLink = asin ? `https://www.${amazonDomain}/dp/${asin}` : '#';

      // Generate star rating HTML
      const fullStars = Math.floor(rating);
      const hasHalfStar = rating % 1 >= 0.5;
      let starsHtml = '';
      for (let i = 0; i <5; i++) {
        if (i < fullStars) {
          starsHtml += '<span style="color: #FFA500; font-size: 1.125rem;">★</span>';
        } else if (i === fullStars && hasHalfStar) {
          starsHtml += '<span style="color: #FFA500; font-size: 1.125rem;">★</span>';
        } else {
          starsHtml += '<span style="color: #DDD; font-size: 1.125rem;">★</span>';
        }
      }

      html += `
        <div class="book-card" data-asin="${asin}" style="padding: var(--spacing-24); background: var(--color-neutral-00); border: 1px solid var(--color-neutral-30); border-radius: var(--radius-large); box-shadow: 0 2px 8px rgba(0,0,0,0.04); transition: all 0.3s;" onmouseover="this.style.boxShadow='0 4px 16px rgba(0,0,0,0.08)'" onmouseout="this.style.boxShadow='0 2px 8px rgba(0,0,0,0.04)'">

          <div style="display: flex; gap: var(--spacing-24);">
            <!-- Book Cover -->
            <div style="flex-shrink: 0;">
              <a href="${amazonLink}" target="_blank" rel="noopener noreferrer" style="display: block; text-decoration: none;">
                ${cover ? `<img src="${cover}" alt="${title}" style="width: 120px; height: auto; border-radius: var(--radius-medium); box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">` : `<div style="width: 120px; height: 180px; background: var(--color-neutral-20); border-radius: var(--radius-medium); display: flex; align-items: center; justify-content: center; color: var(--color-neutral-60);">No Image</div>`}
              </a>
            </div>

            <!-- Book Details -->
            <div style="flex: 1; min-width: 0;">
              <h3 style="font-size: 1.25rem; font-weight: 700; margin: 0 0 var(--spacing-8) 0; line-height: 1.4;">
                <a href="${amazonLink}" target="_blank" rel="noopener noreferrer" style="color: var(--color-neutral-90); text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--color-primary-60)'" onmouseout="this.style.color='var(--color-neutral-90)'">
                  ${title}
                </a>
              </h3>

              <p style="font-size: 0.95rem; color: var(--color-neutral-70); margin: 0 0 var(--spacing-12) 0;">
                by ${authors}
              </p>

              <div style="display: flex; align-items: center; gap: var(--spacing-8); margin-bottom: var(--spacing-12);">
                <div style="display: flex; align-items: center;">
                  ${starsHtml}
                </div>
                <span style="font-size: 1rem; font-weight: 600; color: var(--color-neutral-90);">${rating.toFixed(1)}</span>
                <span style="font-size: 0.875rem; color: var(--color-neutral-60);">(${reviewsCount.toLocaleString()} ratings)</span>
              </div>

              <div style="display: flex; gap: var(--spacing-24); flex-wrap: wrap; margin-top: var(--spacing-16); align-items: flex-end;">
                <div>
                  <p style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--color-neutral-60); margin: 0 0 4px 0; font-weight: 600;">BSR</p>
                  <p style="font-size: 1rem; font-weight: 700; color: var(--color-primary-60); margin: 0;">#${typeof bsr === 'number' ? bsr.toLocaleString() : bsr}</p>
                </div>

                <div>
                  <p style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--color-neutral-60); margin: 0 0 4px 0; font-weight: 600;">Price</p>
                  <p style="font-size: 1rem; font-weight: 700; color: var(--color-neutral-90); margin: 0;">${currencies[marketSelector.value] || '$'}${price}</p>
                </div>

                <div>
                  <p style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--color-neutral-60); margin: 0 0 4px 0; font-weight: 600;">ASIN</p>
                  <p style="font-size: 1rem; font-weight: 700; color: var(--color-neutral-90); margin: 0; font-family: monospace;">${asin}</p>
                </div>

                <div style="margin-left: auto; display: flex; gap: var(--spacing-12);">
                  <button class="expand-details-btn" data-asin="${asin}" style="display: inline-flex; align-items: center; gap: var(--spacing-8); padding: 10px 20px; background: linear-gradient(135deg, #00C2A8, #00A890); color: var(--color-neutral-00); border: none; border-radius: var(--radius-medium); font-weight: 600; font-size: 0.875rem; cursor: pointer; transition: all 0.2s; box-shadow: 0 2px 8px rgba(0, 194, 168, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(0, 194, 168, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0, 194, 168, 0.3)'">
                    <svg class="book-analysis-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <circle cx="11" cy="11" r="8"></circle>
                      <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <span>Book Analysis</span>
                  </button>
                  <a href="${amazonLink}" target="_blank" rel="noopener noreferrer" style="display: inline-block; padding: 10px 20px; background: linear-gradient(135deg, var(--color-primary-60), var(--color-primary-70)); color: var(--color-neutral-00); text-decoration: none; border-radius: var(--radius-medium); font-weight: 600; font-size: 0.875rem; transition: all 0.2s; box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(99, 102, 241, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(99, 102, 241, 0.3)'">
                    View on Amazon →
                  </a>
                </div>
              </div>
            </div>
          </div>

          <!-- Expandable Details Section -->
          <div class="book-details-expanded" style="display: none; margin-top: var(--spacing-24); padding-top: var(--spacing-24); border-top: 1px solid var(--color-neutral-30);">
            <div class="details-loading" style="text-align: center; padding: var(--spacing-32); color: var(--color-neutral-60);">
              <div style="display: inline-block; width: 40px; height: 40px; border: 4px solid var(--color-neutral-20); border-top-color: #00C2A8; border-radius: 50%; animation: spin 1s linear infinite;"></div>
              <p style="margin-top: var(--spacing-16); font-size: 1rem; font-weight: 600;">Loading additional details...</p>
            </div>
            <div class="details-content" style="display: none;">
              <!-- Additional data will be inserted here via API call -->
            </div>
          </div>
        </div>
      `;
    });

    html += '</div>';
    booksContainer.innerHTML = html;

    // Global flag to track if an analysis is running
    let isAnalysisRunning = false;

    // Add event listeners to expand buttons
    const expandButtons = document.querySelectorAll('.expand-details-btn');
    expandButtons.forEach(btn => {
      btn.addEventListener('click', async function() {
        // Check if another analysis is already running
        if (isAnalysisRunning) {
          alert('Please wait for the current book analysis to complete before analyzing another book.');
          return;
        }

        const asin = this.getAttribute('data-asin');
        const bookCard = this.closest('.book-card');
        const expandedSection = bookCard.querySelector('.book-details-expanded');
        const loadingDiv = expandedSection.querySelector('.details-loading');
        const contentDiv = expandedSection.querySelector('.details-content');

        // Set global lock and disable all analysis buttons
        isAnalysisRunning = true;
        const allAnalysisButtons = document.querySelectorAll('.expand-details-btn');
        allAnalysisButtons.forEach(button => {
          button.disabled = true;
          button.style.opacity = '0.6';
          button.style.cursor = 'not-allowed';
        });

        // Expand section for this book
        expandedSection.style.display = 'block';

        // Show loading
        loadingDiv.style.display = 'block';
        contentDiv.style.display = 'none';

        try {
          // Get the current market from the search
          const currentMarket = marketSelector.value.toLowerCase();

          // Make API call to analyze book
          const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=plottybot_analyze_book', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json'
            },
            body: JSON.stringify({
              asin: asin,
              market: currentMarket
            })
          });

          if (!response.ok) {
            throw new Error('API error: ' + response.status);
          }

          const data = await response.json();
          console.log('Book analysis data:', data);

          // Hide loading and show content
          loadingDiv.style.display = 'none';
          contentDiv.style.display = 'block';

          // Extract data from response
          const summary = data.analysis_summary || {};
          const hasKnownAuthors = summary.has_known_authors || false;
          const hasReputablePublisher = summary.has_reputable_publisher || false;
          const isCopyTitle = summary.is_copy_title || false;
          const keywords = summary.keywords || [];

          // Format keywords for display
          const keywordsHtml = keywords.length > 0
            ? keywords.map(keyword => `
                <span style="display: inline-block; padding: 6px 12px; background: var(--color-primary-10); color: var(--color-primary-70); border-radius: var(--radius-medium); font-size: 0.875rem; font-weight: 600; margin: 4px 4px 4px 0;">
                  ${keyword}
                </span>
              `).join('')
            : '<p style="margin: 0; font-size: 0.875rem; color: var(--color-neutral-60); font-style: italic;">No keywords identified</p>';

          // Render analysis results
          contentDiv.innerHTML = `
            <div style="padding: var(--spacing-20); background: var(--color-neutral-05); border-radius: var(--radius-medium);">
              <h4 style="font-size: 1rem; font-weight: 700; color: var(--color-neutral-90); margin: 0 0 var(--spacing-16) 0; display: flex; align-items: center; gap: var(--spacing-8);">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00C2A8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="11" cy="11" r="8"></circle>
                  <path d="m21 21-4.35-4.35"></path>
                </svg>
                Analysis Results
              </h4>

              <!-- Compact Grid Layout for Quick Facts -->
              <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: var(--spacing-12); margin-bottom: var(--spacing-16);">
                <div style="padding: 12px; background: var(--color-neutral-00); border-radius: var(--radius-medium); border-left: 3px solid ${hasKnownAuthors ? '#FF6B6B' : '#00C2A8'};">
                  <p style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--color-neutral-60); margin: 0 0 4px 0; font-weight: 600;">Has Known Authors?</p>
                  <p style="margin: 0; font-size: 0.95rem; font-weight: 700; color: ${hasKnownAuthors ? '#FF6B6B' : '#00C2A8'};">
                    ${hasKnownAuthors ? 'Yes ✗' : 'No ✓'}
                  </p>
                </div>

                <div style="padding: 12px; background: var(--color-neutral-00); border-radius: var(--radius-medium); border-left: 3px solid ${hasReputablePublisher ? '#FF6B6B' : '#00C2A8'};">
                  <p style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--color-neutral-60); margin: 0 0 4px 0; font-weight: 600;">Reputable Publisher?</p>
                  <p style="margin: 0; font-size: 0.95rem; font-weight: 700; color: ${hasReputablePublisher ? '#FF6B6B' : '#00C2A8'};">
                    ${hasReputablePublisher ? 'Yes ✗' : 'No ✓'}
                  </p>
                </div>

                <div style="padding: 12px; background: var(--color-neutral-00); border-radius: var(--radius-medium); border-left: 3px solid ${isCopyTitle ? '#FF6B6B' : '#00C2A8'};">
                  <p style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--color-neutral-60); margin: 0 0 4px 0; font-weight: 600;">Is Title in Copy?</p>
                  <p style="margin: 0; font-size: 0.95rem; font-weight: 700; color: ${isCopyTitle ? '#FF6B6B' : '#00C2A8'};">
                    ${isCopyTitle ? 'Yes ✗' : 'No ✓'}
                  </p>
                </div>
              </div>

              <!-- Keywords -->
              <div>
                <p style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--color-neutral-60); margin: 0 0 8px 0; font-weight: 600;">Identified Keywords</p>
                <div style="padding: 12px; background: var(--color-neutral-00); border-radius: var(--radius-medium); border: 2px solid var(--color-primary-20); display: flex; flex-wrap: wrap; align-items: center; min-height: 44px;">
                  ${keywordsHtml}
                </div>
              </div>
            </div>
          `;

          // Release global lock and re-enable all other buttons (keep this one disabled)
          isAnalysisRunning = false;
          const allAnalysisButtons = document.querySelectorAll('.expand-details-btn');
          allAnalysisButtons.forEach(button => {
            if (button !== this) {
              button.disabled = false;
              button.style.opacity = '1';
              button.style.cursor = 'pointer';
            }
          });

        } catch (error) {
          console.error('Error analyzing book:', error);
          loadingDiv.style.display = 'none';
          contentDiv.style.display = 'block';
          contentDiv.innerHTML = `
            <div style="padding: var(--spacing-24); text-align: center; color: var(--color-danger-60);">
              <p style="font-size: 1.125rem; font-weight: 600; margin-bottom: var(--spacing-12);">Error loading analysis</p>
              <p style="color: var(--color-neutral-60); margin-bottom: var(--spacing-16);">${error.message}</p>
              <p style="font-size: 0.875rem; color: var(--color-neutral-70);">You can try clicking the button again to retry.</p>
            </div>
          `;

          // Release global lock and re-enable all buttons on error
          isAnalysisRunning = false;
          const allAnalysisButtons = document.querySelectorAll('.expand-details-btn');
          allAnalysisButtons.forEach(button => {
            button.disabled = false;
            button.style.opacity = '1';
            button.style.cursor = 'pointer';
          });

          // Collapse the section
          expandedSection.style.display = 'none';
        }
      });
    });

    // Scroll to results
    document.getElementById('books-results').scrollIntoView({ behavior: 'smooth', block: 'start' });
  }

  // Custom Market Dropdown Logic
  const marketDropdown = document.getElementById('market-dropdown');
  const marketSelected = document.getElementById('market-selected');
  const marketOptions = document.getElementById('market-options');
  const marketSelectorInput = document.getElementById('market-selector');
  const marketSelectedLabel = document.getElementById('market-selected-label');

  marketSelected.addEventListener('click', function(e) {
    e.preventDefault();
    marketOptions.style.display = marketOptions.style.display === 'block' ? 'none' : 'block';
  });

  document.addEventListener('click', function(e) {
    if (!marketDropdown.contains(e.target)) {
      marketOptions.style.display = 'none';
    }
  });

  Array.from(marketOptions.querySelectorAll('.dropdown-item')).forEach(function(item) {
    item.addEventListener('click', function(e) {
      e.preventDefault();
      const value = this.getAttribute('data-value');
      marketSelectorInput.value = value;
      // Use innerHTML to preserve flag and text
      marketSelectedLabel.innerHTML = this.querySelector('.navigation-text').innerHTML;
      marketOptions.style.display = 'none';
      // Update currency symbol if needed
      if (typeof currencies !== 'undefined') {
        const currency = currencies[value];
        if (currencySymbol) currencySymbol.textContent = `(${currency})`;
        if (currencyMin) currencyMin.textContent = currency;
        if (currencyMax) currencyMax.textContent = currency;
      }
      // Trigger category fetch for the new market
      const country = marketToCountry[value] || 'us';
      if (allowedCountries.includes(country)) {
        currentCountry = country;
        fetchCategories(country);
      }
    });
  });

  // Custom Dropdown Logic for BSR, Price, Ratings
  function setupCustomDropdown(dropdownId, selectedId, optionsId, inputId, labelId) {
    const dropdown = document.getElementById(dropdownId);
    const selected = document.getElementById(selectedId);
    const options = document.getElementById(optionsId);
    const input = document.getElementById(inputId);
    const label = document.getElementById(labelId);

    selected.addEventListener('click', function(e) {
      e.preventDefault();
      options.style.display = options.style.display === 'block' ? 'none' : 'block';
    });

    document.addEventListener('click', function(e) {
      if (!dropdown.contains(e.target)) {
        options.style.display = 'none';
      }
    });

    Array.from(options.querySelectorAll('.dropdown-item')).forEach(function(item) {
      item.addEventListener('click', function(e) {
        e.preventDefault();
        const value = this.getAttribute('data-value');
        input.value = value;
        label.textContent = this.querySelector('.navigation-text').textContent;
        options.style.display = 'none';
      });
    });
  }

  setupCustomDropdown('bsr-dropdown', 'bsr-selected', 'bsr-options', 'bsr-range', 'bsr-selected-label');
  setupCustomDropdown('price-dropdown', 'price-selected', 'price-options', 'price-range', 'price-selected-label');
  setupCustomDropdown('ratings-dropdown', 'ratings-selected', 'ratings-options', 'ratings-range', 'ratings-selected-label');

  // --- Categories Dynamic Tickboxes ---
  const categoriesList = document.getElementById('categories-list');
  const allowedCountries = ['us', 'uk', 'de', 'es', 'fr'];
  // Map market codes to country codes
  const marketToCountry = { US: 'us', UK: 'uk', DE: 'de', ES: 'es', FR: 'fr' };

  function renderCategories(categories) {
    categoriesList.innerHTML = '';
    if (!categories || categories.length === 0) {
      categoriesList.innerHTML = '<span style="color: var(--color-neutral-60);">No categories found.</span>';
      return;
    }
    categories.forEach(cat => {
      const id = 'cat-' + cat.replace(/[^a-zA-Z0-9]/g, '');
      const label = document.createElement('label');
      label.className = 'category-checkbox-label';
      label.style = 'display: flex; align-items: center; gap: 8px; background: var(--color-neutral-10); padding: 8px 12px; border-radius: var(--radius-medium); font-size: 0.95rem; color: var(--color-neutral-90); cursor: pointer;';
      const checkbox = document.createElement('input');
      checkbox.type = 'checkbox';
      checkbox.value = cat;
      checkbox.id = id;
      checkbox.name = 'categories[]';
      checkbox.style = 'margin: 0;';
      label.appendChild(checkbox);
      const span = document.createElement('span');
      span.textContent = cat;
      label.appendChild(span);
      categoriesList.appendChild(label);
    });
  }

  async function fetchCategories(country) {
    categoriesList.innerHTML = '<span style="color: var(--color-neutral-60);">Loading categories...</span>';
    try {
      console.log('Fetching categories for country:', country);
      const url = '<?php echo admin_url('admin-ajax.php'); ?>?action=plottybot_fetch_categories&country=' + country;
      console.log('API URL:', url);
      const resp = await fetch(url, {
        headers: {
          'Accept': 'application/json'
        }
      });
      console.log('API response status:', resp.status);
      if (!resp.ok) throw new Error('API error: ' + resp.status);
      const data = await resp.json();
      console.log('API response data:', data);
      if (!data.categories || !Array.isArray(data.categories)) throw new Error('Malformed API response');
      renderCategories(data.categories);
    } catch (err) {
      console.error('Failed to load categories:', err);
      categoriesList.innerHTML = '<span style="color: var(--color-danger-60);">Failed to load categories.</span>';
    }
  }

  // Initial load (default market)
  let currentCountry = marketToCountry[marketSelector.value] || 'us';
  fetchCategories(currentCountry);

  // On market change, fetch new categories
  marketSelector.addEventListener('change', function() {
    const selectedMarket = marketSelector.value;
    const country = marketToCountry[selectedMarket] || 'us';
    if (allowedCountries.includes(country)) {
      currentCountry = country;
      fetchCategories(country);
    }
  });

  // ===== ROYALTIES CALCULATOR FUNCTIONALITY =====

  // Trim sizes data
  const trimSizesInches = [
    { width: 5, height: 8, label: '5 x 8 in' },
    { width: 5.25, height: 8, label: '5.25 x 8 in' },
    { width: 5.5, height: 8.5, label: '5.5 x 8.5 in' },
    { width: 6, height: 9, label: '6 x 9 in' },
    { width: 5.06, height: 7.81, label: '5.06 x 7.81 in' },
    { width: 6.14, height: 9.21, label: '6.14 x 9.21 in' },
    { width: 6.69, height: 9.61, label: '6.69 x 9.61 in' },
    { width: 7, height: 10, label: '7 x 10 in' },
    { width: 7.44, height: 9.69, label: '7.44 x 9.69 in' },
    { width: 7.5, height: 9.25, label: '7.5 x 9.25 in' },
    { width: 8, height: 10, label: '8 x 10 in' },
    { width: 8.5, height: 11, label: '8.5 x 11 in' },
    { width: 8.27, height: 11.69, label: '8.27 x 11.69 in' },
    { width: 8.25, height: 6, label: '8.25 x 6 in' },
    { width: 8.25, height: 8.25, label: '8.25 x 8.25 in' },
    { width: 8.5, height: 8.5, label: '8.5 x 8.5 in' }
  ];

  const trimSizesMm = [
    { width: 127, height: 203.2, label: '127 x 203.2 mm' },
    { width: 133.3, height: 203.2, label: '133.3 x 203.2 mm' },
    { width: 139.7, height: 215.9, label: '139.7 x 215.9 mm' },
    { width: 152.4, height: 228.6, label: '152.4 x 228.6 mm' },
    { width: 128.5, height: 198.4, label: '128.5 x 198.4 mm' },
    { width: 156, height: 233.9, label: '156 x 233.9 mm' },
    { width: 169.9, height: 244.1, label: '169.9 x 244.1 mm' },
    { width: 177.8, height: 254, label: '177.8 x 254 mm' },
    { width: 189, height: 246.1, label: '189 x 246.1 mm' },
    { width: 190.5, height: 234.9, label: '190.5 x 234.9 mm' },
    { width: 203.2, height: 254, label: '203.2 x 254 mm' },
    { width: 215.9, height: 279.4, label: '215.9 x 279.4 mm' },
    { width: 210, height: 297, label: '210 x 297 mm' },
    { width: 209.5, height: 152.4, label: '209.5 x 152.4 mm' },
    { width: 209.5, height: 209.5, label: '209.5 x 209.5 mm' },
    { width: 215.9, height: 215.9, label: '215.9 x 215.9 mm' }
  ];

  // Currency symbols for royalties
  const royaltiesCurrencies = {
    'US': '$',
    'UK': '£',
    'IT': '€',
    'DE': '€',
    'FR': '€',
    'ES': '€',
    'CA': 'CA$'
  };

  // Royalties Calculator Elements
  const royaltiesMarketDropdown = document.getElementById('royalties-market-dropdown');
  const royaltiesMarketSelected = document.getElementById('royalties-market-selected');
  const royaltiesMarketOptions = document.getElementById('royalties-market-options');
  const royaltiesMarketSelector = document.getElementById('royalties-market-selector');
  const royaltiesMarketSelectedLabel = document.getElementById('royalties-market-selected-label');
  const royaltiesCurrencySymbol = document.getElementById('royalties-currency-symbol');

  const royaltiesUnitDropdown = document.getElementById('royalties-unit-dropdown');
  const royaltiesUnitSelected = document.getElementById('royalties-unit-selected');
  const royaltiesUnitOptions = document.getElementById('royalties-unit-options');
  const royaltiesUnitSelector = document.getElementById('royalties-unit-selector');
  const royaltiesUnitSelectedLabel = document.getElementById('royalties-unit-selected-label');

  const royaltiesTrimSizeDropdown = document.getElementById('royalties-trim-size-dropdown');
  const royaltiesTrimSizeSelected = document.getElementById('royalties-trim-size-selected');
  const royaltiesTrimSizeOptions = document.getElementById('royalties-trim-size-options');
  const royaltiesWidth = document.getElementById('royalties-width');
  const royaltiesHeight = document.getElementById('royalties-height');
  const royaltiesTrimSizeSelectedLabel = document.getElementById('royalties-trim-size-selected-label');

  const royaltiesInkTypeDropdown = document.getElementById('royalties-ink-type-dropdown');
  const royaltiesInkTypeSelected = document.getElementById('royalties-ink-type-selected');
  const royaltiesInkTypeOptions = document.getElementById('royalties-ink-type-options');
  const royaltiesInkTypeSelector = document.getElementById('royalties-ink-type-selector');
  const royaltiesInkTypeSelectedLabel = document.getElementById('royalties-ink-type-selected-label');

  const royaltiesPages = document.getElementById('royalties-pages');
  const royaltiesPrice = document.getElementById('royalties-price');
  const royaltiesCalculateBtn = document.getElementById('royalties-calculate-btn');
  const royaltiesResults = document.getElementById('royalties-results');

  // Function to populate trim size options based on unit
  function populateTrimSizes(unit) {
    const sizes = unit === 'in' ? trimSizesInches : trimSizesMm;
    royaltiesTrimSizeOptions.innerHTML = '';

    sizes.forEach(size => {
      const li = document.createElement('li');
      const a = document.createElement('a');
      a.href = '#';
      a.setAttribute('data-width', size.width);
      a.setAttribute('data-height', size.height);
      a.className = 'dropdown-item';
      a.style = 'display: flex; align-items: center; padding: 12px; color: var(--color-neutral-90); text-decoration: none;';
      a.innerHTML = `<span class="navigation-text">${size.label}</span>`;
      li.appendChild(a);
      royaltiesTrimSizeOptions.appendChild(li);
    });

    // Set default to first size or 6x9 inches / 152.4x228.6 mm
    if (unit === 'in') {
      royaltiesWidth.value = 6;
      royaltiesHeight.value = 9;
      royaltiesTrimSizeSelectedLabel.textContent = '6 x 9 in';
    } else {
      royaltiesWidth.value = 152.4;
      royaltiesHeight.value = 228.6;
      royaltiesTrimSizeSelectedLabel.textContent = '152.4 x 228.6 mm';
    }
  }

  // Market dropdown
  royaltiesMarketSelected.addEventListener('click', function(e) {
    e.preventDefault();
    royaltiesMarketOptions.style.display = royaltiesMarketOptions.style.display === 'block' ? 'none' : 'block';
  });

  royaltiesMarketOptions.addEventListener('click', function(e) {
    if (e.target.closest('.dropdown-item')) {
      e.preventDefault();
      const item = e.target.closest('.dropdown-item');
      const value = item.getAttribute('data-value');
      const currency = item.getAttribute('data-currency');
      royaltiesMarketSelector.value = value;
      royaltiesMarketSelectedLabel.innerHTML = item.querySelector('.navigation-text').innerHTML;
      royaltiesCurrencySymbol.textContent = `(${currency})`;
      royaltiesMarketOptions.style.display = 'none';
    }
  });

  // Unit dropdown
  royaltiesUnitSelected.addEventListener('click', function(e) {
    e.preventDefault();
    royaltiesUnitOptions.style.display = royaltiesUnitOptions.style.display === 'block' ? 'none' : 'block';
  });

  royaltiesUnitOptions.addEventListener('click', function(e) {
    if (e.target.closest('.dropdown-item')) {
      e.preventDefault();
      const item = e.target.closest('.dropdown-item');
      const value = item.getAttribute('data-value');
      royaltiesUnitSelector.value = value;
      royaltiesUnitSelectedLabel.textContent = item.querySelector('.navigation-text').textContent;
      royaltiesUnitOptions.style.display = 'none';

      // Update trim sizes based on selected unit
      populateTrimSizes(value);
    }
  });

  // Trim size dropdown
  royaltiesTrimSizeSelected.addEventListener('click', function(e) {
    e.preventDefault();
    royaltiesTrimSizeOptions.style.display = royaltiesTrimSizeOptions.style.display === 'block' ? 'none' : 'block';
  });

  royaltiesTrimSizeOptions.addEventListener('click', function(e) {
    if (e.target.closest('.dropdown-item')) {
      e.preventDefault();
      const item = e.target.closest('.dropdown-item');
      const width = item.getAttribute('data-width');
      const height = item.getAttribute('data-height');
      royaltiesWidth.value = width;
      royaltiesHeight.value = height;
      royaltiesTrimSizeSelectedLabel.textContent = item.querySelector('.navigation-text').textContent;
      royaltiesTrimSizeOptions.style.display = 'none';
    }
  });

  // Ink type dropdown
  royaltiesInkTypeSelected.addEventListener('click', function(e) {
    e.preventDefault();
    royaltiesInkTypeOptions.style.display = royaltiesInkTypeOptions.style.display === 'block' ? 'none' : 'block';
  });

  royaltiesInkTypeOptions.addEventListener('click', function(e) {
    if (e.target.closest('.dropdown-item')) {
      e.preventDefault();
      const item = e.target.closest('.dropdown-item');
      const value = item.getAttribute('data-value');
      royaltiesInkTypeSelector.value = value;
      royaltiesInkTypeSelectedLabel.textContent = item.querySelector('.navigation-text').textContent;
      royaltiesInkTypeOptions.style.display = 'none';
    }
  });

  // Close royalties dropdowns when clicking outside
  document.addEventListener('click', function(e) {
    if (royaltiesMarketDropdown && !royaltiesMarketDropdown.contains(e.target)) {
      royaltiesMarketOptions.style.display = 'none';
    }
    if (royaltiesUnitDropdown && !royaltiesUnitDropdown.contains(e.target)) {
      royaltiesUnitOptions.style.display = 'none';
    }
    if (royaltiesTrimSizeDropdown && !royaltiesTrimSizeDropdown.contains(e.target)) {
      royaltiesTrimSizeOptions.style.display = 'none';
    }
    if (royaltiesInkTypeDropdown && !royaltiesInkTypeDropdown.contains(e.target)) {
      royaltiesInkTypeOptions.style.display = 'none';
    }
  });

  // Initialize trim sizes with default unit (inches)
  populateTrimSizes('in');

  // Calculate button
  royaltiesCalculateBtn.addEventListener('click', async function() {
    const market = royaltiesMarketSelector.value;
    const currency = royaltiesCurrencies[market] || '$';
    const unit = royaltiesUnitSelector.value;
    const width = parseFloat(royaltiesWidth.value);
    const height = parseFloat(royaltiesHeight.value);
    const pages = parseInt(royaltiesPages.value);
    const listPrice = parseFloat(royaltiesPrice.value);
    const inkType = royaltiesInkTypeSelector.value;

    // Validate inputs
    if (!pages || pages < 24 || pages > 828) {
      alert('Please enter a valid number of pages (24-828).');
      return;
    }
    if (!listPrice || listPrice <= 0) {
      alert('Please enter a valid list price.');
      return;
    }

    // Prepare API payload
    const payload = [
      {
        asin: '101010', // fake id as required
        dimensions: {
          width: width,
          height: height,
          unit: unit
        },
        market: market,
        number_of_pages: pages,
        list_price: listPrice
      }
    ];

    // Show loading state
    royaltiesCalculateBtn.disabled = true;
    royaltiesCalculateBtn.textContent = 'Calculating...';

    try {
      const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=plottybot_calculate_royalties', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify(payload)
      });
      if (!response.ok) {
        throw new Error('API error: ' + response.status);
      }
      const data = await response.json();
      // Find the correct ink type in the response
      const royaltiesData = data.royalties_per_copy && data.royalties_per_copy[0];
      if (!royaltiesData) throw new Error('No royalty data returned');
      const inkTypeData = royaltiesData.by_ink_type.find(i => i.ink_type === inkType);
      if (!inkTypeData) throw new Error('No data for selected ink type');

      // Get ACOS metrics
      const acosData = data.acos_metrics && data.acos_metrics[0];

      // Display results
      document.getElementById('result-list-price').textContent = `${inkTypeData.currency}${royaltiesData.list_price.toFixed(2)}`;
      document.getElementById('result-printing-cost').textContent = `${inkTypeData.currency}${inkTypeData.print_cost.toFixed(2)}`;
      // Amazon fee is not returned by API, so estimate as 40% of list price
      const amazonFee = royaltiesData.list_price * 0.40;
      document.getElementById('result-amazon-fee').textContent = `${inkTypeData.currency}${amazonFee.toFixed(2)}`;
      document.getElementById('result-royalty').textContent = `${inkTypeData.currency}${inkTypeData.royalties_per_copy.toFixed(2)}`;

      // Display ACOS metrics if available
      const acosSection = document.getElementById('acos-metrics-section');
      if (acosData && acosSection) {
        document.getElementById('result-breakeven-acos').textContent = `${acosData.breakeven_acos.toFixed(2)}%`;
        document.getElementById('result-target-acos').textContent = `${acosData.target_acos.toFixed(2)}%`;
        document.getElementById('result-max-ad-spend').textContent = `${inkTypeData.currency}${acosData.max_ad_spend_per_sale.toFixed(2)}`;
        acosSection.style.display = 'block';
      } else if (acosSection) {
        acosSection.style.display = 'none';
      }

      // Show results
      royaltiesResults.style.display = 'block';
      royaltiesResults.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } catch (error) {
      alert('Error calculating royalties: ' + error.message);
    } finally {
      royaltiesCalculateBtn.disabled = false;
      royaltiesCalculateBtn.textContent = '💰 Calculate Royalties';
    }
  });
});
</script>

<?php
get_footer();
?>
