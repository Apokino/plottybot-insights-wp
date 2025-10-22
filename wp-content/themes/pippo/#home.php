<?php
/* Template Name: Home */
get_header();

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

<!-- Navigation Menu -->
<div class="services-navigation" style="background: var(--color-neutral-00); border-bottom: 1px solid var(--color-neutral-30); box-shadow: 0 2px 8px rgba(0,0,0,0.04); margin-bottom: var(--spacing-48);">
  <div style="max-width: 1200px; margin: 0 auto; padding: 0 var(--spacing-16);">
    <nav style="display: flex; gap: 0;">
      <button id="nav-book-search" class="service-nav-btn active" data-service="book-search" style="padding: var(--spacing-20) var(--spacing-32); background: none; border: none; border-bottom: 3px solid var(--color-primary-60); color: var(--color-neutral-90); font-weight: 600; font-size: 1rem; cursor: pointer; transition: all 0.3s; position: relative;">
        📚 Book Search
      </button>
      <button id="nav-categories" class="service-nav-btn" data-service="categories" style="padding: var(--spacing-20) var(--spacing-32); background: none; border: none; border-bottom: 3px solid transparent; color: var(--color-neutral-60); font-weight: 600; font-size: 1rem; cursor: pointer; transition: all 0.3s; position: relative;">
        📊 Categories
      </button>
      <button id="nav-ad-campaign" class="service-nav-btn" data-service="ad-campaign" style="padding: var(--spacing-20) var(--spacing-32); background: none; border: none; border-bottom: 3px solid transparent; color: var(--color-neutral-60); font-weight: 600; font-size: 1rem; cursor: pointer; transition: all 0.3s; position: relative;">
        🎯 Ad Campaign Assistant
      </button>
    </nav>
  </div>
</div>

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

<!-- Ad Campaign Assistant Service -->
<div id="service-ad-campaign" class="service-section" style="display: none;">
  <div class="section plottybot-homepage aligncenter" style="padding: var(--spacing-48) var(--spacing-16);">
    <div style="max-width: 900px; margin: 0 auto; background: var(--color-neutral-00); border: 1px solid var(--color-neutral-30); border-radius: var(--radius-large); box-shadow: 0 8px 32px rgba(0,0,0,0.06); padding: var(--spacing-40); text-align: center;">
      <div style="margin-bottom: var(--spacing-32);">
        <h1 class="text--heading-lg" style="color: var(--color-neutral-90); margin-bottom: var(--spacing-16);">🎯 Ad Campaign Assistant</h1>
        <p class="text--body-lg" style="color: var(--color-neutral-70); margin-bottom: var(--spacing-32);">AI-powered advertising optimization and campaign management tools.</p>
      </div>
      
      <div style="padding: var(--spacing-48); background: var(--color-neutral-10); border-radius: var(--radius-large); margin-bottom: var(--spacing-32);">
        <div style="font-size: 4rem; margin-bottom: var(--spacing-24);">🤖</div>
        <h2 class="text--heading-md" style="color: var(--color-neutral-90); margin-bottom: var(--spacing-16);">Coming Soon</h2>
        <p class="text--body-md" style="color: var(--color-neutral-60); max-width: 500px; margin: 0 auto;">
          Our AI-powered advertising assistant will help you create, optimize, and manage your Amazon advertising campaigns for maximum ROI.
        </p>
      </div>
      
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: var(--spacing-24); text-align: left;">
        <div style="padding: var(--spacing-24); background: var(--color-neutral-05); border-radius: var(--radius-medium);">
          <h3 class="text--heading-sm" style="color: var(--color-primary-60); margin-bottom: var(--spacing-12);">🎯 Keyword Optimization</h3>
          <p class="text--body-sm" style="color: var(--color-neutral-70);">AI-suggested keywords and bid optimization for better campaign performance.</p>
        </div>
        <div style="padding: var(--spacing-24); background: var(--color-neutral-05); border-radius: var(--radius-medium);">
          <h3 class="text--heading-sm" style="color: var(--color-primary-60); margin-bottom: var(--spacing-12);">📊 Performance Analytics</h3>
          <p class="text--body-sm" style="color: var(--color-neutral-70);">Deep insights into campaign performance with actionable recommendations.</p>
        </div>
        <div style="padding: var(--spacing-24); background: var(--color-neutral-05); border-radius: var(--radius-medium);">
          <h3 class="text--heading-sm" style="color: var(--color-primary-60); margin-bottom: var(--spacing-12);">🚀 Auto-Optimization</h3>
          <p class="text--body-sm" style="color: var(--color-neutral-70);">Automated campaign adjustments based on real-time performance data.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
@keyframes spin {
  to { transform: rotate(360deg); }
}

/* Navigation Styles */
.service-nav-btn {
  position: relative;
  transition: all 0.3s ease;
}

.service-nav-btn:hover {
  color: var(--color-primary-60) !important;
  background: var(--color-neutral-05) !important;
}

.service-nav-btn.active {
  color: var(--color-neutral-90) !important;
  border-bottom-color: var(--color-primary-60) !important;
  background: var(--color-neutral-05) !important;
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

.category-checkbox-label input {
  margin: 0;
  width: 16px;
  height: 16px;
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
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Service Navigation Functionality
  const navButtons = document.querySelectorAll('.service-nav-btn');
  const serviceSections = document.querySelectorAll('.service-section');
  
  function switchService(targetService) {
    // Update navigation buttons
    navButtons.forEach(btn => {
      btn.classList.remove('active');
      btn.style.borderBottomColor = 'transparent';
      btn.style.color = 'var(--color-neutral-60)';
      btn.style.background = 'none';
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
      activeBtn.style.borderBottomColor = 'var(--color-primary-60)';
      activeBtn.style.color = 'var(--color-neutral-90)';
      activeBtn.style.background = 'var(--color-neutral-05)';
      
      activeSection.classList.add('active');
      activeSection.style.display = 'block';
    }
  }
  
  // Add click event listeners to navigation buttons
  navButtons.forEach(btn => {
    btn.addEventListener('click', function() {
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

        const response = await fetch('https://api-frontend-q66rh5ei3a-uc.a.run.app/categories/search', {
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
                  <p style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--color-neutral-60); margin: 0 0 4px 0; font-weight: 600;">Daily Sales to #1</p>
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
      const response = await fetch('https://api-frontend-1044931876531.us-central1.run.app/api/v2/books/search_books', {
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
        <div style="display: flex; gap: var(--spacing-24); padding: var(--spacing-24); background: var(--color-neutral-00); border: 1px solid var(--color-neutral-30); border-radius: var(--radius-large); box-shadow: 0 2px 8px rgba(0,0,0,0.04); transition: all 0.3s;" onmouseover="this.style.boxShadow='0 4px 16px rgba(0,0,0,0.08)'" onmouseout="this.style.boxShadow='0 2px 8px rgba(0,0,0,0.04)'">
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

            <div style="display: flex; gap: var(--spacing-24); flex-wrap: wrap; margin-top: var(--spacing-16);">
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

              <div style="margin-left: auto;">
                <a href="${amazonLink}" target="_blank" rel="noopener noreferrer" style="display: inline-block; padding: 10px 20px; background: linear-gradient(135deg, var(--color-primary-60), var(--color-primary-70)); color: var(--color-neutral-00); text-decoration: none; border-radius: var(--radius-medium); font-weight: 600; font-size: 0.875rem; transition: all 0.2s; box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(99, 102, 241, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(99, 102, 241, 0.3)'">
                  View on Amazon →
                </a>
              </div>
            </div>
          </div>
        </div>
      `;
    });

    html += '</div>';
    booksContainer.innerHTML = html;

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
      const url = `https://api-frontend-1044931876531.us-central1.run.app/categories?country=${country}`;
      console.log('API URL:', url);
      const resp = await fetch(url);
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
});
</script>

<?php
get_footer();
?>
