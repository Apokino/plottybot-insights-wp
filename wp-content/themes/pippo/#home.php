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
</div>

<style>
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
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
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

  applyButton.addEventListener('click', function() {
    const priceMax = parseFloat(document.getElementById('price-max').value);
    const ratingsMax = parseFloat(document.getElementById('ratings-max').value);

    const filters = {
      market: marketSelector.value,
      bsr_min: parseFloat(document.getElementById('bsr-min').value),
      bsr_max: parseFloat(document.getElementById('bsr-max').value),
      price_min: parseFloat(document.getElementById('price-min').value),
      price_max: priceMax >= 100 ? 'unlimited' : priceMax,
      publisher_type: publisherSelectorInput.value,
      ratings_min: parseFloat(document.getElementById('ratings-min').value),
      ratings_max: ratingsMax >= 1000 ? 'unlimited' : ratingsMax
    };

    console.log('Applied Filters:', filters);

    // TODO: Add your filter application logic here
    // For example, send to a REST API endpoint or process the data
  });

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
