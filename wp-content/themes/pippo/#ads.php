<?php
/* Template Name: Ads */
get_header();

// Check if user is logged in, if not redirect to login page
if (!is_user_logged_in()) {
    wp_redirect('https://insights.plottybot.com/wp-login.php?loggedout=true');
    exit;
}
// Get browser language header safely
$browser_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '', 0, 2);

// Normalize to IT or EN only
$user_language = ($browser_lang === 'it') ? 'IT' : 'EN';

// Get current WordPress user ID
$current_user_id = get_current_user_id();

// Ads access control variable
$ads_enabled = true; // Set to true to enable ads access, false to disable
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
      <!-- KDP Accounts Nav Item -->
      <button class="service-nav-btn <?php echo $ads_enabled ? 'active' : ''; ?>" data-service="placeholder-1" <?php echo !$ads_enabled ? 'disabled' : ''; ?> style="width: 100%; padding: var(--spacing-20) var(--spacing-24); background: <?php echo $ads_enabled ? 'var(--color-primary-10)' : 'transparent'; ?>; border: none; border-left: 4px solid <?php echo $ads_enabled ? 'var(--color-primary-60)' : 'transparent'; ?>; color: <?php echo $ads_enabled ? 'var(--color-neutral-90)' : 'var(--color-neutral-50)'; ?>; font-weight: 600; font-size: 1rem; cursor: <?php echo $ads_enabled ? 'pointer' : 'not-allowed'; ?>; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-align: left; display: flex; align-items: center; gap: var(--spacing-16); margin-bottom: var(--spacing-4); opacity: <?php echo $ads_enabled ? '1' : '0.5'; ?>;">
        <span style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: <?php echo $ads_enabled ? 'var(--color-primary-50)' : '#E0E0E0'; ?>; border-radius: var(--radius-small);">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="<?php echo $ads_enabled ? 'white' : 'var(--color-neutral-50)'; ?>" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
          </svg>
        </span>
        <span>KDP Accounts</span>
      </button>

      <!-- Optimization Schedule Nav Item -->
      <button class="service-nav-btn" data-service="placeholder-2" <?php echo !$ads_enabled ? 'disabled' : ''; ?> style="width: 100%; padding: var(--spacing-20) var(--spacing-24); background: transparent; border: none; border-left: 4px solid transparent; color: var(--color-neutral-50); font-weight: 600; font-size: 1rem; cursor: <?php echo $ads_enabled ? 'pointer' : 'not-allowed'; ?>; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-align: left; display: flex; align-items: center; gap: var(--spacing-16); margin-bottom: var(--spacing-4); opacity: <?php echo $ads_enabled ? '1' : '0.5'; ?>;">
        <span style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: #E0E0E0; border-radius: var(--radius-small);">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--color-neutral-50)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
          </svg>
        </span>
        <span>Optimization Schedule</span>
      </button>

      <!-- Books Nav Item -->
      <button class="service-nav-btn" data-service="placeholder-books" <?php echo !$ads_enabled ? 'disabled' : ''; ?> style="width: 100%; padding: var(--spacing-20) var(--spacing-24); background: transparent; border: none; border-left: 4px solid transparent; color: var(--color-neutral-50); font-weight: 600; font-size: 1rem; cursor: <?php echo $ads_enabled ? 'pointer' : 'not-allowed'; ?>; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-align: left; display: flex; align-items: center; gap: var(--spacing-16); margin-bottom: var(--spacing-4); opacity: <?php echo $ads_enabled ? '1' : '0.5'; ?>;">
        <span style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: #E0E0E0; border-radius: var(--radius-small);">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--color-neutral-50)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
          </svg>
        </span>
        <span>Books</span>
      </button>

      <!-- Campaign Configuration Nav Item -->
      <button class="service-nav-btn" data-service="placeholder-3" <?php echo !$ads_enabled ? 'disabled' : ''; ?> style="width: 100%; padding: var(--spacing-20) var(--spacing-24); background: transparent; border: none; border-left: 4px solid transparent; color: var(--color-neutral-50); font-weight: 600; font-size: 1rem; cursor: <?php echo $ads_enabled ? 'pointer' : 'not-allowed'; ?>; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-align: left; display: flex; align-items: center; gap: var(--spacing-16); margin-bottom: var(--spacing-4); opacity: <?php echo $ads_enabled ? '1' : '0.5'; ?>;">
        <span style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: #E0E0E0; border-radius: var(--radius-small);">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--color-neutral-50)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="9" y1="3" x2="9" y2="21"></line>
            <line x1="15" y1="3" x2="15" y2="21"></line>
            <line x1="3" y1="9" x2="21" y2="9"></line>
            <line x1="3" y1="15" x2="21" y2="15"></line>
          </svg>
        </span>
        <span>⚠️(TESTING) Campaign Configuration </span>
      </button>

      <!-- Create Campaign Nav Item -->
      <button class="service-nav-btn" data-service="placeholder-4" <?php echo !$ads_enabled ? 'disabled' : ''; ?> style="width: 100%; padding: var(--spacing-20) var(--spacing-24); background: transparent; border: none; border-left: 4px solid transparent; color: var(--color-neutral-50); font-weight: 600; font-size: 1rem; cursor: <?php echo $ads_enabled ? 'pointer' : 'not-allowed'; ?>; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-align: left; display: flex; align-items: center; gap: var(--spacing-16); margin-bottom: var(--spacing-4); opacity: <?php echo $ads_enabled ? '1' : '0.5'; ?>;">
        <span style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: #E0E0E0; border-radius: var(--radius-small);">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--color-neutral-50)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 2v20M2 12h20"></path>
            <circle cx="12" cy="12" r="10"></circle>
          </svg>
        </span>
        <span>⚠️ Create Campaign - WIP DO NOT TOUCH</span>
      </button>

      <!-- Pulse Nav Item -->
      <button class="service-nav-btn" data-service="placeholder-pulse" <?php echo !$ads_enabled ? 'disabled' : ''; ?> style="width: 100%; padding: var(--spacing-20) var(--spacing-24); background: transparent; border: none; border-left: 4px solid transparent; color: var(--color-neutral-50); font-weight: 600; font-size: 1rem; cursor: <?php echo $ads_enabled ? 'pointer' : 'not-allowed'; ?>; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-align: left; display: flex; align-items: center; gap: var(--spacing-16); margin-bottom: var(--spacing-4); opacity: <?php echo $ads_enabled ? '1' : '0.5'; ?>;">
        <span style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: #E0E0E0; border-radius: var(--radius-small);">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--color-neutral-50)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
          </svg>
        </span>
        <span>Pulse</span>
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
  <div id="main-content" class="main-content" style="flex: 1; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: var(--color-neutral-05); position: relative;">

    <!-- Loading Overlay for User Verification -->
    <div id="user-verification-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: var(--color-neutral-00); z-index: 9999; display: flex; align-items: center; justify-content: center;">
      <div style="text-align: center; max-width: 500px; padding: var(--spacing-40);">
        <!-- Animated Icon -->
        <div style="position: relative; width: 100px; height: 100px; margin: 0 auto var(--spacing-32);">
          <svg width="100" height="100" viewBox="0 0 100 100" style="animation: pulse 2s ease-in-out infinite;">
            <circle cx="50" cy="50" r="45" fill="none" stroke="#E0E0E0" stroke-width="4"/>
            <circle cx="50" cy="50" r="45" fill="none" stroke="#00C2A8" stroke-width="4" stroke-dasharray="283" stroke-dashoffset="70" stroke-linecap="round" style="animation: rotate 2s linear infinite; transform-origin: center;"/>
          </svg>
          <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#00C2A8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
          </div>
        </div>

        <!-- Loading Text -->
        <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--color-neutral-90); margin: 0 0 var(--spacing-16) 0;">
          Setting up your account
        </h2>
        <p id="verification-status" style="font-size: 1rem; color: var(--color-neutral-60); margin: 0 0 var(--spacing-24) 0;">
          Verifying your account credentials...
        </p>

        <!-- Progress Steps -->
        <div style="display: flex; flex-direction: column; gap: var(--spacing-12); text-align: left; background: var(--color-neutral-05); padding: var(--spacing-20); border-radius: var(--radius-medium);">
          <div id="step-1" style="display: flex; align-items: center; gap: var(--spacing-12); transition: all 0.3s;">
            <div class="step-indicator" style="width: 24px; height: 24px; border-radius: 50%; background: #00C2A8; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="animation: spin 1s linear infinite;">
                <circle cx="12" cy="12" r="10"></circle>
              </svg>
            </div>
            <span style="font-size: 0.875rem; color: var(--color-neutral-70);">Checking account status...</span>
          </div>

          <div id="step-2" style="display: flex; align-items: center; gap: var(--spacing-12); opacity: 0.4; transition: all 0.3s;">
            <div class="step-indicator" style="width: 24px; height: 24px; border-radius: 50%; background: var(--color-neutral-30); display: flex; align-items: center; justify-content: center; flex-shrink: 0;"></div>
            <span style="font-size: 0.875rem; color: var(--color-neutral-60);">Loading your workspace...</span>
          </div>

          <div id="step-3" style="display: flex; align-items: center; gap: var(--spacing-12); opacity: 0.4; transition: all 0.3s;">
            <div class="step-indicator" style="width: 24px; height: 24px; border-radius: 50%; background: var(--color-neutral-30); display: flex; align-items: center; justify-content: center; flex-shrink: 0;"></div>
            <span style="font-size: 0.875rem; color: var(--color-neutral-60);">Ready to go!</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Content sections (initially hidden) -->
    <div id="main-sections-wrapper" style="opacity: 0; pointer-events: none; transition: opacity 0.5s ease;">

    <!-- KDP Accounts Management Section -->
    <div id="service-placeholder-1" class="service-section active" style="display: block;">
      <div style="max-width: 1200px; margin: 0 auto;">
        <div style="background: var(--color-neutral-00); border: 1px solid var(--color-neutral-30); border-radius: var(--radius-large); box-shadow: 0 8px 32px rgba(0,0,0,0.06); padding: var(--spacing-40);">

          <?php if ($ads_enabled): ?>
            <!-- Header -->
            <div style="text-align: center; margin-bottom: var(--spacing-40);">
              <h1 class="text--heading-lg" style="color: var(--color-neutral-90); margin-bottom: var(--spacing-16);">
                📊 KDP Accounts Management
              </h1>
              <p class="text--body-lg" style="color: var(--color-neutral-70);">
                Connect and manage your Amazon KDP accounts
              </p>
            </div>

            <!-- Add KDP Account Form -->
            <div style="background: var(--color-neutral-05); border-radius: var(--radius-medium); padding: var(--spacing-32); margin-bottom: var(--spacing-40);">
              <h2 style="font-size: 1.25rem; font-weight: 700; color: var(--color-neutral-90); margin: 0 0 var(--spacing-24) 0; display: flex; align-items: center; gap: var(--spacing-8);">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#00C2A8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"></circle>
                  <line x1="12" y1="8" x2="12" y2="16"></line>
                  <line x1="8" y1="12" x2="16" y2="12"></line>
                </svg>
                Add New KDP Account
              </h2>

              <!-- Fetch Authorization Code Button -->
              <div style="margin-bottom: var(--spacing-24); padding: var(--spacing-20); background: linear-gradient(135deg, #E3F9F5, #D1F4EC); border-radius: var(--radius-medium); border: 2px solid #00C2A8;">
                <p style="margin: 0 0 var(--spacing-16) 0; color: var(--color-neutral-80); font-size: 0.9375rem; line-height: 1.6;">
                  <strong>⚠️ Important:</strong> Before clicking the button below, make sure you are logged into <strong>amazon.com</strong> with the credentials of the KDP account you want to connect to Plottybot Ads. This ensures the correct authorization code is retrieved for that specific account.
                </p>
                <button
                  type="button"
                  id="fetch-auth-code-btn"
                  style="width: 100%; padding: var(--spacing-16); background: linear-gradient(135deg, #FF9900, #FF8800); color: white; border: none; border-radius: var(--radius-medium); font-weight: 700; font-size: 1rem; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(255, 153, 0, 0.3); display: flex; align-items: center; justify-content: center; gap: var(--spacing-12);"
                  onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(255, 153, 0, 0.4)'"
                  onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(255, 153, 0, 0.3)'"
                >
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                    <polyline points="15 3 21 3 21 9"></polyline>
                    <line x1="10" y1="14" x2="21" y2="3"></line>
                  </svg>
                  <span>GET AUTHORIZATION CODE</span>
                </button>
              </div>

              <form id="add-kdp-account-form">
                <div style="display: grid; gap: var(--spacing-24); margin-bottom: var(--spacing-24);">

                  <!-- Authorization Code Input (Read-only) -->
                  <div>
                    <label for="kdp-auth-code" style="display: block; margin-bottom: var(--spacing-8); color: var(--color-neutral-90); font-weight: 600; font-size: 0.875rem;">
                      Authorization Code <span style="color: #FF6B6B;">*</span>
                    </label>
                    <input
                      type="text"
                      id="kdp-auth-code"
                      name="auth_code"
                      maxlength="20"
                      placeholder="Click 'Get Authorization Code' button above"
                      required
                      readonly
                      style="width: 100%; padding: 14px 16px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); font-size: 1rem; transition: border-color 0.2s; font-family: 'Courier New', monospace; letter-spacing: 1px; background: var(--color-neutral-05); cursor: not-allowed;"
                    />
                    <p id="auth-code-error" style="margin: var(--spacing-8) 0 0 0; font-size: 0.875rem; color: #FF6B6B; display: none;"></p>
                    <p style="margin: var(--spacing-8) 0 0 0; font-size: 0.875rem; color: var(--color-neutral-60);">
                      The authorization code will be filled automatically after authorization
                    </p>
                  </div>

                  <!-- Account Name Dropdown -->
                  <div>
                    <label for="kdp-account-name" style="display: block; margin-bottom: var(--spacing-8); color: var(--color-neutral-90); font-weight: 600; font-size: 0.875rem;">
                      Account Name <span style="color: #FF6B6B;">*</span>
                    </label>
                    <select
                      id="kdp-account-name"
                      name="account_name"
                      required
                      style="width: 100%; padding: 12px 40px 12px 16px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); font-size: 1rem; font-weight: 500; color: #000; transition: border-color 0.2s; background-color: white; cursor: pointer; -webkit-appearance: none; -moz-appearance: none; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%23666%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 12px center; background-size: 18px; line-height: normal; display: block; min-height: 44px;"
                    >
                      <option value="" style="color: #999;">Select an account name...</option>
                      <option value="KDP-1" style="color: #000; background: white;">KDP-1</option>
                      <option value="KDP-2" style="color: #000; background: white;">KDP-2</option>
                      <option value="KDP-3" style="color: #000; background: white;">KDP-3</option>
                      <option value="KDP-4" style="color: #000; background: white;">KDP-4</option>
                      <option value="KDP-5" style="color: #000; background: white;">KDP-5</option>
                      <option value="KDP-6" style="color: #000; background: white;">KDP-6</option>
                      <option value="KDP-7" style="color: #000; background: white;">KDP-7</option>
                      <option value="KDP-8" style="color: #000; background: white;">KDP-8</option>
                      <option value="KDP-9" style="color: #000; background: white;">KDP-9</option>
                      <option value="KDP-10" style="color: #000; background: white;">KDP-10</option>
                    </select>
                    <p id="account-name-error" style="margin: var(--spacing-8) 0 0 0; font-size: 0.875rem; color: #FF6B6B; display: none;"></p>
                    <p style="margin: var(--spacing-8) 0 0 0; font-size: 0.875rem; color: var(--color-neutral-60);">
                      Select an available account name (unavailable names are greyed out)
                    </p>
                  </div>
                </div>

                <!-- Submit Button -->
                <button
                  type="submit"
                  id="submit-kdp-account"
                  style="width: 100%; padding: var(--spacing-16); background: linear-gradient(135deg, #00C2A8, #00A890); color: var(--color-neutral-00); border: none; border-radius: var(--radius-medium); font-weight: 700; font-size: 1rem; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(0, 194, 168, 0.3);"
                  onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(0, 194, 168, 0.4)'"
                  onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0, 194, 168, 0.3)'"
                >
                  <span id="submit-button-text">Add KDP Account</span>
                </button>
              </form>
            </div>

            <!-- KDP Accounts List -->
            <div>
              <h2 style="font-size: 1.25rem; font-weight: 700; color: var(--color-neutral-90); margin: 0 0 var(--spacing-24) 0; display: flex; align-items: center; gap: var(--spacing-8);">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary-60)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                  <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                </svg>
                Your KDP Accounts
              </h2>

              <!-- Loading State -->
              <div id="kdp-accounts-loading" style="text-align: center; padding: var(--spacing-40); display: none;">
                <div style="display: inline-block; width: 40px; height: 40px; border: 4px solid var(--color-neutral-20); border-top-color: var(--color-primary-60); border-radius: 50%; animation: spin 1s linear infinite;"></div>
                <p style="margin-top: var(--spacing-16); color: var(--color-neutral-60);">Loading accounts...</p>
              </div>

              <!-- Empty State -->
              <div id="kdp-accounts-empty" style="text-align: center; padding: var(--spacing-48); background: var(--color-neutral-05); border-radius: var(--radius-medium); display: none;">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="var(--color-neutral-40)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto var(--spacing-16);">
                  <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                  <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                </svg>
                <p style="color: var(--color-neutral-60); font-size: 1.125rem; margin: 0;">No KDP accounts connected yet</p>
                <p style="color: var(--color-neutral-50); font-size: 0.875rem; margin: var(--spacing-8) 0 0 0;">Add your first account using the form above</p>
              </div>

              <!-- Accounts List Container -->
              <div id="kdp-accounts-list" style="display: grid; gap: var(--spacing-16);"></div>
            </div>

          <?php else: ?>
            <!-- Access Denied Message -->
            <div style="text-align: center; padding: var(--spacing-48);">
              <div style="width: 80px; height: 80px; margin: 0 auto var(--spacing-24); background: linear-gradient(135deg, #FF6B6B, #FF5252); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 24px rgba(255, 107, 107, 0.3);">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"></circle>
                  <line x1="15" y1="9" x2="9" y2="15"></line>
                  <line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
              </div>
              <h1 style="font-size: 2rem; font-weight: 700; color: var(--color-neutral-90); margin: 0 0 var(--spacing-16) 0;">
                Access Denied
              </h1>
              <p style="font-size: 1.125rem; color: var(--color-neutral-70); margin: 0 0 var(--spacing-24) 0; max-width: 500px; margin-left: auto; margin-right: auto;">
                You don't have access to the Ads features.
              </p>
              <div style="padding: var(--spacing-20); background: #FFF3E0; border-radius: var(--radius-medium); border-left: 4px solid #FFA500; max-width: 600px; margin: 0 auto;">
                <p style="margin: 0; color: var(--color-neutral-80); font-size: 1rem;">
                  <strong>💡 Need access?</strong><br>
                  Please contact support to enable Ads features for your account.
                </p>
              </div>
            </div>
          <?php endif; ?>

        </div>
      </div>
    </div>

    <!-- Optimization Schedule Section -->
    <div id="service-placeholder-2" class="service-section" style="display: none;">
      <div style="max-width: 1200px; margin: 0 auto;">
        <div style="background: var(--color-neutral-00); border: 1px solid var(--color-neutral-30); border-radius: var(--radius-large); box-shadow: 0 8px 32px rgba(0,0,0,0.06); padding: var(--spacing-40);">

          <?php if ($ads_enabled): ?>
            <!-- Header -->
            <div style="text-align: center; margin-bottom: var(--spacing-40);">
              <h1 class="text--heading-lg" style="color: var(--color-neutral-90); margin-bottom: var(--spacing-16);">
                ⚙️ Optimization Schedule
              </h1>
              <p class="text--body-lg" style="color: var(--color-neutral-70);">
                View and manage your scheduled optimizations
              </p>
            </div>

            <!-- Schedule New Optimization -->
            <div style="background: var(--color-neutral-05); border-radius: var(--radius-medium); padding: var(--spacing-24); margin-bottom: var(--spacing-40);">
              <h2 style="font-size: 1.125rem; font-weight: 700; color: var(--color-neutral-90); margin: 0; display: flex; align-items: center; gap: var(--spacing-8);">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#00C2A8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"></circle>
                  <line x1="12" y1="8" x2="12" y2="16"></line>
                  <line x1="8" y1="12" x2="16" y2="12"></line>
                </svg>
                Schedule New Optimization
              </h2>

              <form id="schedule-optimization-form">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spacing-16); margin-bottom: var(--spacing-16);">
                  <!-- Account Selection -->
                  <div>
                    <label for="schedule-account" style="display: block; margin-bottom: var(--spacing-8); color: var(--color-neutral-90); font-weight: 600; font-size: 0.875rem;">
                      Account <span style="color: #FF6B6B;">*</span>
                    </label>
                    <select
                      id="schedule-account"
                      name="account"
                      required
                      style="width: 100%; height: 44px; padding: 0 12px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); font-size: 0.9375rem; line-height: 1.5; transition: border-color 0.2s; background: white; cursor: pointer; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%23666%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 12px center; background-size: 16px; padding-right: 36px;"
                    >
                      <option value="">Select an account...</option>
                    </select>
                    <p id="schedule-account-error" style="margin: var(--spacing-8) 0 0 0; font-size: 0.875rem; color: #FF6B6B; display: none;"></p>
                  </div>

                  <!-- Region Selection -->
                  <div>
                    <label for="schedule-region" style="display: block; margin-bottom: var(--spacing-8); color: var(--color-neutral-90); font-weight: 600; font-size: 0.875rem;">
                      Region <span style="color: #FF6B6B;">*</span>
                    </label>
                    <select
                      id="schedule-region"
                      name="region"
                      required
                      style="width: 100%; height: 44px; padding: 0 12px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); font-size: 0.9375rem; line-height: 1.5; transition: border-color 0.2s; background: white; cursor: pointer; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%23666%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 12px center; background-size: 16px; padding-right: 36px;"
                    >
                      <option value="">Select a region...</option>
                      <option value="AU">Australia (AU)</option>
                      <option value="CA">Canada (CA)</option>
                      <option value="DE">Germany (DE)</option>
                      <option value="ES">Spain (ES)</option>
                      <option value="FR">France (FR)</option>
                      <option value="IN">India (IN)</option>
                      <option value="IT">Italy (IT)</option>
                      <option value="JP">Japan (JP)</option>
                      <option value="MX">Mexico (MX)</option>
                      <option value="NL">Netherlands (NL)</option>
                      <option value="UK">United Kingdom (UK)</option>
                      <option value="US">United States (US)</option>
                    </select>
                    <p id="schedule-region-error" style="margin: var(--spacing-8) 0 0 0; font-size: 0.875rem; color: #FF6B6B; display: none;"></p>
                  </div>
                </div>

                <!-- Submit Button -->
                <button
                  type="submit"
                  id="submit-schedule-optimization"
                  style="width: 100%; padding: 12px; background: linear-gradient(135deg, #00C2A8, #00A890); color: var(--color-neutral-00); border: none; border-radius: var(--radius-medium); font-weight: 700; font-size: 0.9375rem; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(0, 194, 168, 0.3);"
                  onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(0, 194, 168, 0.4)'"
                  onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0, 194, 168, 0.3)'"
                >
                  <span id="schedule-submit-button-text">Schedule Optimization</span>
                </button>
              </form>
            </div>

            <!-- Schedules List -->
            <div>
              <h2 style="font-size: 1.25rem; font-weight: 700; color: var(--color-neutral-90); margin: 0 0 var(--spacing-24) 0; display: flex; align-items: center; gap: var(--spacing-8);">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary-60)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"></circle>
                  <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                Scheduled Optimizations
              </h2>

              <!-- Loading State -->
              <div id="schedules-loading" style="text-align: center; padding: var(--spacing-40); display: none;">
                <div style="display: inline-block; width: 40px; height: 40px; border: 4px solid var(--color-neutral-20); border-top-color: var(--color-primary-60); border-radius: 50%; animation: spin 1s linear infinite;"></div>
                <p style="margin-top: var(--spacing-16); color: var(--color-neutral-60);">Loading schedules...</p>
              </div>

              <!-- Empty State -->
              <div id="schedules-empty" style="text-align: center; padding: var(--spacing-48); background: var(--color-neutral-05); border-radius: var(--radius-medium); display: none;">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="var(--color-neutral-40)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto var(--spacing-16);">
                  <circle cx="12" cy="12" r="10"></circle>
                  <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                <p style="color: var(--color-neutral-60); font-size: 1.125rem; margin: 0;">No schedules found</p>
              </div>

              <!-- Schedules List Container -->
              <div id="schedules-list" style="display: grid; gap: var(--spacing-16);"></div>
            </div>

          <?php else: ?>
            <!-- Access Denied Message -->
            <div style="text-align: center; padding: var(--spacing-48);">
              <div style="width: 80px; height: 80px; margin: 0 auto var(--spacing-24); background: linear-gradient(135deg, #FF6B6B, #FF5252); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 24px rgba(255, 107, 107, 0.3);">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"></circle>
                  <line x1="15" y1="9" x2="9" y2="15"></line>
                  <line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
              </div>
              <h1 style="font-size: 2rem; font-weight: 700; color: var(--color-neutral-90); margin: 0 0 var(--spacing-16) 0;">
                Access Denied
              </h1>
              <p style="font-size: 1.125rem; color: var(--color-neutral-70); margin: 0;">
                You don't have access to the Ads features.
              </p>
            </div>
          <?php endif; ?>

        </div>
      </div>
    </div>

    <!-- Books Section -->
    <div id="service-placeholder-books" class="service-section" style="display: none;">
      <div style="max-width: 1400px; margin: 0 auto;">
        <div style="background: var(--color-neutral-00); border: 1px solid var(--color-neutral-30); border-radius: var(--radius-large); box-shadow: 0 8px 32px rgba(0,0,0,0.06); padding: var(--spacing-40);">

          <?php if ($ads_enabled): ?>
            <!-- Header -->
            <div style="text-align: center; margin-bottom: var(--spacing-40);">
              <h1 class="text--heading-lg" style="color: var(--color-neutral-90); margin-bottom: var(--spacing-16);">
                📚 Books Management
              </h1>
              <p class="text--body-lg" style="color: var(--color-neutral-70);">
                Manage your book catalog and royalty settings
              </p>
            </div>

            <!-- Account and Region Selection -->
            <div style="background: var(--color-neutral-05); border-radius: var(--radius-medium); padding: var(--spacing-24); margin-bottom: var(--spacing-32);">
              <div style="display: grid; grid-template-columns: 1fr 1fr auto; gap: var(--spacing-16); align-items: end;">
                <!-- Account Selection -->
                <div>
                  <label for="books-account" style="display: block; margin-bottom: var(--spacing-8); color: var(--color-neutral-90); font-weight: 600; font-size: 0.875rem;">
                    Account <span style="color: #FF6B6B;">*</span>
                  </label>
                  <select
                    id="books-account"
                    style="width: 100%; height: 44px; padding: 0 12px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); font-size: 0.9375rem; background: white; cursor: pointer; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%23666%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 12px center; background-size: 16px; padding-right: 36px;"
                  >
                    <option value="">Select an account...</option>
                  </select>
                </div>

                <!-- Region Selection -->
                <div>
                  <label for="books-region" style="display: block; margin-bottom: var(--spacing-8); color: var(--color-neutral-90); font-weight: 600; font-size: 0.875rem;">
                    Region <span style="color: #FF6B6B;">*</span>
                  </label>
                  <select
                    id="books-region"
                    style="width: 100%; height: 44px; padding: 0 12px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); font-size: 0.9375rem; background: white; cursor: pointer; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%23666%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 12px center; background-size: 16px; padding-right: 36px;"
                  >
                    <option value="">Select a region...</option>
                    <option value="AU">Australia (AU)</option>
                    <option value="CA">Canada (CA)</option>
                    <option value="DE">Germany (DE)</option>
                    <option value="ES">Spain (ES)</option>
                    <option value="FR">France (FR)</option>
                    <option value="IN">India (IN)</option>
                    <option value="IT">Italy (IT)</option>
                    <option value="JP">Japan (JP)</option>
                    <option value="MX">Mexico (MX)</option>
                    <option value="NL">Netherlands (NL)</option>
                    <option value="UK">United Kingdom (UK)</option>
                    <option value="US">United States (US)</option>
                  </select>
                </div>

                <!-- Load Books Button -->
                <button
                  id="load-books-btn"
                  onclick="loadBooks()"
                  style="height: 44px; padding: 0 var(--spacing-24); background: linear-gradient(135deg, #00C2A8, #00A890); color: white; border: none; border-radius: var(--radius-medium); font-weight: 700; font-size: 0.9375rem; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(0, 194, 168, 0.3); white-space: nowrap;"
                  onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(0, 194, 168, 0.4)'"
                  onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0, 194, 168, 0.3)'"
                >
                  Load Books
                </button>
              </div>
            </div>

            <!-- Loading State -->
            <div id="books-loading" style="text-align: center; padding: var(--spacing-40); display: none;">
              <div style="display: inline-block; width: 40px; height: 40px; border: 4px solid var(--color-neutral-20); border-top-color: var(--color-primary-60); border-radius: 50%; animation: spin 1s linear infinite;"></div>
              <p style="margin-top: var(--spacing-16); color: var(--color-neutral-70);">Loading books...</p>
            </div>

            <!-- Error Message -->
            <div id="books-error" style="display: none; background: #FFF5F5; border: 1px solid #FEB2B2; border-radius: var(--radius-medium); padding: var(--spacing-16); margin-bottom: var(--spacing-24);">
              <p style="color: #C53030; margin: 0;" id="books-error-message"></p>
            </div>

            <!-- Success Message -->
            <div id="books-success" style="display: none; background: #F0FDF4; border: 1px solid #86EFAC; border-radius: var(--radius-medium); padding: var(--spacing-16); margin-bottom: var(--spacing-24);">
              <p style="color: #16A34A; margin: 0;" id="books-success-message"></p>
            </div>

            <!-- Books List Container -->
            <div id="books-container" style="display: none;">
              <!-- Action Buttons (Sticky) -->
              <div style="position: sticky; top: 32px; z-index: 100; display: flex; justify-content: flex-end; gap: var(--spacing-16); margin-bottom: var(--spacing-24); padding: var(--spacing-12) 0; background: linear-gradient(to bottom, #f8f9fa 0%, #f8f9fa 85%, rgba(248, 249, 250, 0) 100%);">
                <button
                  id="save-books-btn"
                  onclick="saveBooks()"
                  style="padding: 12px var(--spacing-24); background: linear-gradient(135deg, #00C2A8, #00A890); color: white; border: none; border-radius: var(--radius-medium); font-weight: 700; font-size: 0.9375rem; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(0, 194, 168, 0.3);"
                  onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(0, 194, 168, 0.4)'"
                  onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0, 194, 168, 0.3)'"
                >
                  💾 Save All Royalties
                </button>
              </div>

              <!-- Books Grid -->
              <div id="books-list" style="display: grid; gap: var(--spacing-16);"></div>
            </div>

            <!-- Empty State -->
            <div id="books-empty" style="display: none; text-align: center; padding: var(--spacing-60);">
              <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="var(--color-neutral-40)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto var(--spacing-24);">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
              </svg>
              <h3 style="color: var(--color-neutral-70); margin: 0 0 var(--spacing-8) 0;">No books found</h3>
              <p style="color: var(--color-neutral-60); margin: 0;">Select an account and region to load your books.</p>
            </div>

          <?php else: ?>
            <!-- Access Denied Message -->
            <div style="text-align: center; padding: var(--spacing-60);">
              <div style="width: 80px; height: 80px; margin: 0 auto var(--spacing-32); background: #FEE; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#C53030" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"></circle>
                  <line x1="15" y1="9" x2="9" y2="15"></line>
                  <line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
              </div>
              <h1 style="font-size: 2rem; font-weight: 700; color: var(--color-neutral-90); margin: 0 0 var(--spacing-16) 0;">
                Access Denied
              </h1>
              <p style="font-size: 1.125rem; color: var(--color-neutral-70); margin: 0;">
                You don't have access to the Ads features.
              </p>
            </div>
          <?php endif; ?>

        </div>
      </div>
    </div>

    <!-- Campaign Configuration Section -->
    <div id="service-placeholder-3" class="service-section" style="display: none;">
      <div style="max-width: 1200px; margin: 0 auto;">
        <div style="background: var(--color-neutral-00); border: 1px solid var(--color-neutral-30); border-radius: var(--radius-large); box-shadow: 0 8px 32px rgba(0,0,0,0.06); padding: var(--spacing-40);">

          <!-- Header -->
          <div style="text-align: center; margin-bottom: var(--spacing-40);">
            <h1 class="text--heading-lg" style="color: var(--color-neutral-90); margin-bottom: var(--spacing-16);">
              ⚠️ Campaign Configuration - WIP DO NOT TOUCH
            </h1>
            <p class="text--body-lg" style="color: var(--color-neutral-70);">
              Configure campaign settings for your KDP accounts
            </p>
          </div>

          <!-- Account and Region Selection -->
          <div style="background: var(--color-neutral-05); border-radius: var(--radius-medium); padding: var(--spacing-32); margin-bottom: var(--spacing-40);">
            <h2 style="font-size: 1.25rem; font-weight: 700; color: var(--color-neutral-90); margin: 0 0 var(--spacing-24) 0;">
              Select Account & Region
            </h2>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spacing-24);">
              <!-- Account Selection -->
              <div>
                <label for="campaign-account" style="display: block; margin-bottom: var(--spacing-8); color: var(--color-neutral-90); font-weight: 600; font-size: 0.875rem;">
                  KDP Account <span style="color: #FF6B6B;">*</span>
                </label>
                <select
                  id="campaign-account"
                  name="account"
                  style="width: 100%; height: 44px; padding: 0 12px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); font-size: 0.9375rem; line-height: 1.5; transition: border-color 0.2s; background: white; cursor: pointer; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%23666%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 12px center; background-size: 16px; padding-right: 36px;"
                >
                  <option value="">Select an account...</option>
                </select>
                <p id="campaign-account-error" style="margin: var(--spacing-8) 0 0 0; font-size: 0.875rem; color: #FF6B6B; display: none;"></p>
              </div>

              <!-- Region Selection -->
              <div>
                <label for="campaign-region" style="display: block; margin-bottom: var(--spacing-8); color: var(--color-neutral-90); font-weight: 600; font-size: 0.875rem;">
                  Region <span style="color: #FF6B6B;">*</span>
                </label>
                <select
                  id="campaign-region"
                  name="region"
                  style="width: 100%; height: 44px; padding: 0 12px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); font-size: 0.9375rem; line-height: 1.5; transition: border-color 0.2s; background: white; cursor: pointer; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%23666%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 12px center; background-size: 16px; padding-right: 36px;"
                >
                  <option value="">Select a region...</option>
                  <option value="AU">Australia (AU)</option>
                  <option value="CA">Canada (CA)</option>
                  <option value="DE">Germany (DE)</option>
                  <option value="ES">Spain (ES)</option>
                  <option value="FR">France (FR)</option>
                  <option value="IN">India (IN)</option>
                  <option value="IT">Italy (IT)</option>
                  <option value="JP">Japan (JP)</option>
                  <option value="MX">Mexico (MX)</option>
                  <option value="NL">Netherlands (NL)</option>
                  <option value="UK">United Kingdom (UK)</option>
                  <option value="US">United States (US)</option>
                </select>
                <p id="campaign-region-error" style="margin: var(--spacing-8) 0 0 0; font-size: 0.875rem; color: #FF6B6B; display: none;"></p>
              </div>
            </div>
          </div>


          <!-- Existing Configurations List -->
          <div id="campaign-configs-list-container" style="display: none;">
            <h2 style="font-size: 1.25rem; font-weight: 700; color: var(--color-neutral-90); margin: 0 0 var(--spacing-16) 0;">
              Existing Configurations
            </h2>
            <div id="campaign-configs-list" style="display: grid; gap: var(--spacing-16); margin-bottom: var(--spacing-32);"></div>
            <div id="campaign-configs-empty" style="display: none; padding: var(--spacing-20); background: var(--color-neutral-05); border-radius: var(--radius-medium); text-align: center; margin-bottom: var(--spacing-32);">
              <p style="color: var(--color-neutral-60); font-size: 0.9375rem;">
                No configurations yet. Create your first one below.
              </p>
            </div>
          </div>

          <!-- Campaign Configuration Form -->
          <div id="campaign-config-form-container" style="display: none;">
            <h2 id="config-form-title" style="font-size: 1.25rem; font-weight: 700; color: var(--color-neutral-90); margin: 0 0 var(--spacing-24) 0;">
              Create New Configuration
            </h2>
            <form id="campaign-config-form">

              <div style="background: var(--color-neutral-05); border-radius: var(--radius-medium); padding: var(--spacing-32); margin-bottom: var(--spacing-24);">
                <!-- Two Column Layout: Form Fields (Left) and Targets (Right) -->
                <div style="display: grid; grid-template-columns: 1fr 400px; gap: var(--spacing-32);">
                  
                  <!-- LEFT COLUMN: Form Fields -->
                  <div style="display: grid; gap: var(--spacing-20);">
                    <!-- Campaign and Ad Group Selection -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spacing-20);">
                      <div>
                        <label for="config-campaign-name" style="display: block; margin-bottom: var(--spacing-8); color: var(--color-neutral-90); font-weight: 600; font-size: 0.875rem;">
                          Campaign <span style="color: #FF6B6B;">*</span>
                        </label>
                        <select
                          id="config-campaign-name"
                          name="campaign_name"
                          required
                          style="width: 100%; height: 44px; padding: 0 12px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); font-size: 0.9375rem; line-height: 1.5; background: white; cursor: pointer; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%23666%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 12px center; background-size: 16px; padding-right: 36px;"
                        >
                          <option value="">Select a campaign...</option>
                        </select>
                      </div>

                      <div>
                        <label for="config-ad-group" style="display: block; margin-bottom: var(--spacing-8); color: var(--color-neutral-90); font-weight: 600; font-size: 0.875rem;">
                          Ad Group <span style="color: #FF6B6B;">*</span>
                        </label>
                        <select
                          id="config-ad-group"
                          name="ad_group"
                          required
                          style="width: 100%; height: 44px; padding: 0 12px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); font-size: 0.9375rem; line-height: 1.5; background: white; cursor: pointer; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%23666%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 12px center; background-size: 16px; padding-right: 36px;"
                        >
                          <option value="">First select a campaign...</option>
                        </select>
                      </div>
                    </div>

                    <!-- Bid Update Strategy -->
                    <div>
                      <label for="config-bid-strategy" style="display: block; margin-bottom: var(--spacing-8); color: var(--color-neutral-90); font-weight: 600; font-size: 0.875rem;">
                        Bid Update Strategy <span style="color: #FF6B6B;">*</span>
                      </label>
                      <select
                        id="config-bid-strategy"
                        name="bid_update_strategy"
                        required
                        style="width: 100%; height: 44px; padding: 0 12px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); font-size: 0.9375rem; line-height: 1.5; background: white; cursor: pointer; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%23666%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 12px center; background-size: 16px; padding-right: 36px;"
                      >
                        <option value="conservative">Conservative</option>
                      </select>
                    </div>

                    <!-- ASIN Selection -->
                    <div>
                      <label for="config-asin" style="display: block; margin-bottom: var(--spacing-8); color: var(--color-neutral-90); font-weight: 600; font-size: 0.875rem;">
                        Book ASIN <span style="color: #FF6B6B;">*</span>
                      </label>
                      <select
                        id="config-asin"
                        name="asin"
                        required
                        style="width: 100%; height: 44px; padding: 0 12px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); font-size: 0.9375rem; line-height: 1.5; background: white; cursor: pointer; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%23666%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 12px center; background-size: 16px; padding-right: 36px;"
                      >
                        <option value="">First select an ad group...</option>
                      </select>
                      <p style="margin: var(--spacing-4) 0 0 0; font-size: 0.75rem; color: var(--color-neutral-60);">
                        Price and royalties will be fetched automatically from the book data
                      </p>
                    </div>

                    <!-- Book Preview (shown when ASIN is selected) -->
                    <div id="book-preview" style="display: none; padding: var(--spacing-16); background: var(--color-neutral-05); border-radius: var(--radius-small); border: 1px solid var(--color-neutral-20);">
                      <div style="display: flex; gap: var(--spacing-16); align-items: flex-start;">
                        <img id="book-preview-image" src="" alt="Book cover" style="width: 60px; height: 90px; object-fit: cover; border-radius: var(--radius-small); box-shadow: 0 2px 8px rgba(0,0,0,0.15); flex-shrink: 0;" />
                        <div style="flex: 1;">
                          <div id="book-preview-title" style="font-weight: 600; color: var(--color-neutral-90); margin-bottom: var(--spacing-4); font-size: 0.875rem;"></div>
                          <div id="book-preview-asin" style="font-size: 0.75rem; color: var(--color-neutral-60); font-family: monospace; margin-bottom: var(--spacing-8);"></div>
                          <div id="book-preview-pricing" style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spacing-8); margin-top: var(--spacing-8); padding-top: var(--spacing-8); border-top: 1px solid var(--color-neutral-20);">
                            <div>
                              <div style="font-size: 0.625rem; color: var(--color-neutral-60); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 2px;">Price</div>
                              <div id="book-preview-price" style="font-size: 0.875rem; font-weight: 600; color: var(--color-neutral-90);">-</div>
                            </div>
                            <div>
                              <div style="font-size: 0.625rem; color: var(--color-neutral-60); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 2px;">Royalties</div>
                              <div id="book-preview-royalties" style="font-size: 0.875rem; font-weight: 600; color: var(--color-neutral-90);">-</div>
                            </div>
                          </div>
                          <div id="book-preview-missing-data" style="display: none; margin-top: var(--spacing-12); padding: var(--spacing-8); background: #FFF3E0; border: 1px solid #FFE0B2; border-radius: var(--radius-small);">
                            <div style="display: flex; align-items: center; gap: var(--spacing-6);">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                              </svg>
                              <span style="font-size: 0.75rem; color: #E65100; line-height: 1.4;">
                                Missing price or royalties. Please <a href="#" onclick="event.preventDefault(); switchService('placeholder-books');" style="color: #E65100; font-weight: 600; text-decoration: underline;">update in Books tab</a> before creating configuration.
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- END LEFT COLUMN -->

                  <!-- RIGHT COLUMN: Campaign Targets -->
                  <div>
                    <div style="margin-bottom: var(--spacing-12);">
                      <p style="font-weight: 600; color: var(--color-neutral-90); font-size: 0.875rem; margin: 0 0 var(--spacing-4) 0;">
                        Campaign Targets (Optional)
                      </p>
                      <p style="font-size: 0.75rem; color: var(--color-neutral-60); margin: 0;">
                        Retrieve keywords and products targeted by this campaign to enrich configuration
                      </p>
                    </div>
                    <button
                      type="button"
                      id="retrieve-targets-btn"
                      disabled
                      style="width: 100%; padding: var(--spacing-14); background: var(--color-neutral-20); color: var(--color-neutral-50); border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); font-weight: 700; font-size: 0.9375rem; cursor: not-allowed; transition: all 0.2s; display: flex; align-items: center; justify-content: center; gap: var(--spacing-12);"
                    >
                      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                      </svg>
                      <span id="retrieve-targets-btn-text">Retrieve Campaign Targets</span>
                    </button>
                    
                    <!-- Container for retrieved targets (hidden by default) -->
                    <div id="retrieved-targets-container" style="display: none; margin-top: var(--spacing-16); padding: var(--spacing-16); background: white; border-radius: var(--radius-small); border: 1px solid var(--color-neutral-30);">
                      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spacing-12);">
                        <p style="margin: 0; font-weight: 600; font-size: 0.875rem; color: var(--color-neutral-90);">Retrieved Targets</p>
                        <span id="targets-count" style="padding: 4px 12px; background: var(--color-primary-10); color: var(--color-primary-70); border-radius: var(--radius-small); font-size: 0.75rem; font-weight: 700;">0 items</span>
                      </div>
                      <div id="targets-list" style="max-height: 500px; overflow-y: auto;">
                        <!-- Targets will be populated here -->
                      </div>
                    </div>
                  </div>
                  <!-- END RIGHT COLUMN -->

                </div>
                <!-- END TWO COLUMN LAYOUT -->
              </div>

              <!-- Submit Button -->
              <div>
                <button
                  type="submit"
                  id="submit-campaign-config"
                  style="width: 100%; padding: 14px; background: linear-gradient(135deg, #00C2A8, #00A890); color: var(--color-neutral-00); border: none; border-radius: var(--radius-medium); font-weight: 700; font-size: 1rem; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(0, 194, 168, 0.3);"
                  onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(0, 194, 168, 0.4)'"
                  onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0, 194, 168, 0.3)'"
                >
                  <span id="config-submit-button-text">Create Configuration</span>
                </button>
              </div>
            </form>
          </div>

          <!-- Loading State -->
          <div id="campaign-config-loading" style="display: none; padding: var(--spacing-32); text-align: center;">
            <div class="spinner" style="margin: 0 auto var(--spacing-16) auto;"></div>
            <p style="color: var(--color-neutral-60);">Loading...</p>
          </div>

          <!-- Empty State -->
          <div id="campaign-config-empty" style="display: block; padding: var(--spacing-32); background: var(--color-neutral-05); border-radius: var(--radius-medium); text-align: center;">
            <p style="color: var(--color-neutral-60); font-size: 1rem;">
              Please select a User ID, Account, and Region above to configure campaigns
            </p>
          </div>

        </div>
      </div>
    </div>

    <!-- Create Campaign Section -->
    <div id="service-placeholder-4" class="service-section" style="display: none;">
      <div style="max-width: 1200px; margin: 0 auto;">
        <div style="background: var(--color-neutral-00); border: 1px solid var(--color-neutral-30); border-radius: var(--radius-large); box-shadow: 0 8px 32px rgba(0,0,0,0.06); padding: var(--spacing-40);">

          <?php if ($ads_enabled): ?>
            <!-- Header -->
            <div style="text-align: center; margin-bottom: var(--spacing-40);">
              <h1 class="text--heading-lg" style="color: var(--color-neutral-90); margin-bottom: var(--spacing-16);">
                ⚠️ Create Campaign - WIP DO NOT TOUCH
              </h1>
              <p class="text--body-lg" style="color: var(--color-neutral-70);">
                Get keyword recommendations to optimize your advertising campaigns
              </p>
            </div>

            <!-- Keyword Recommendations Section -->
            <div style="background: var(--color-neutral-05); border-radius: var(--radius-medium); padding: var(--spacing-32);">
              <h2 style="font-size: 1.25rem; font-weight: 700; color: var(--color-neutral-90); margin: 0 0 var(--spacing-24) 0; display: flex; align-items: center; gap: var(--spacing-12);">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#00C2A8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="11" cy="11" r="8"></circle>
                  <path d="m21 21-4.35-4.35"></path>
                </svg>
                Keyword Recommendations
              </h2>

              <!-- Input Form -->
              <form id="keyword-recommendations-form" style="display: grid; gap: var(--spacing-20); margin-bottom: var(--spacing-24);">
                <!-- Book Title -->
                <div>
                  <label for="keyword-book-title" style="display: block; margin-bottom: var(--spacing-8); color: var(--color-neutral-90); font-weight: 600; font-size: 0.875rem;">
                    Book Title <span style="color: #FF6B6B;">*</span>
                  </label>
                  <input
                    type="text"
                    id="keyword-book-title"
                    placeholder="Enter your book title"
                    required
                    style="width: 100%; padding: 12px 16px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); font-size: 0.9375rem;"
                  />
                </div>

                <!-- Market Selector & ASINs -->
                <div style="display: grid; grid-template-columns: 200px 1fr; gap: var(--spacing-20);">
                  <div>
                    <label for="keyword-market" style="display: block; margin-bottom: var(--spacing-8); color: var(--color-neutral-90); font-weight: 600; font-size: 0.875rem;">
                      Market <span style="color: #FF6B6B;">*</span>
                    </label>
                    <select
                      id="keyword-market"
                      required
                      style="width: 100%; height: 44px; padding: 0 12px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); font-size: 0.9375rem; background: white; cursor: pointer;"
                    >
                      <option value="US">US</option>
                      <option value="DE">DE</option>
                      <option value="UK">UK</option>
                      <option value="ES">ES</option>
                      <option value="FR">FR</option>
                    </select>
                  </div>

                  <div>
                    <label for="keyword-asins" style="display: block; margin-bottom: var(--spacing-8); color: var(--color-neutral-90); font-weight: 600; font-size: 0.875rem;">
                      ASINs <span style="color: #FF6B6B;">*</span>
                    </label>
                    <input
                      type="text"
                      id="keyword-asins"
                      placeholder="Enter ASINs separated by commas (e.g., B0FP8VS5MF, B0DL7MQZBG)"
                      required
                      style="width: 100%; padding: 12px 16px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); font-size: 0.9375rem;"
                    />
                    <p style="margin: var(--spacing-4) 0 0 0; font-size: 0.75rem; color: var(--color-neutral-60);">
                      Separate multiple ASINs with commas
                    </p>
                  </div>
                </div>

                <!-- Submit Button -->
                <button
                  type="submit"
                  id="get-keywords-btn"
                  style="padding: 14px 24px; background: linear-gradient(135deg, #00C2A8, #00A890); color: white; border: none; border-radius: var(--radius-medium); font-weight: 700; font-size: 1rem; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(0, 194, 168, 0.3); width: fit-content;"
                  onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(0, 194, 168, 0.4)'"
                  onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0, 194, 168, 0.3)'"
                >
                  Get Keyword Recommendations
                </button>
              </form>

              <!-- Loading State -->
              <div id="keywords-loading" style="display: none; text-align: center; padding: var(--spacing-32);">
                <div style="display: inline-block; width: 40px; height: 40px; border: 4px solid var(--color-neutral-20); border-top-color: var(--color-primary-60); border-radius: 50%; animation: spin 1s linear infinite;"></div>
                <p style="margin-top: var(--spacing-16); color: var(--color-neutral-60);">Fetching keyword recommendations...</p>
              </div>

              <!-- Results Section -->
              <div id="keywords-results" style="display: none;">
                <!-- Action Buttons -->
                <div style="display: flex; justify-content: space-between; gap: var(--spacing-12); margin-bottom: var(--spacing-16);">
                  <button
                    id="get-suggested-bid-btn"
                    onclick="getSuggestedBids()"
                    style="padding: 10px 20px; background: linear-gradient(135deg, #FF9800, #F57C00); color: white; border: none; border-radius: var(--radius-medium); font-weight: 700; font-size: 0.9375rem; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; gap: var(--spacing-8); box-shadow: 0 4px 12px rgba(255, 152, 0, 0.3);"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(255, 152, 0, 0.4)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(255, 152, 0, 0.3)'"
                  >
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <line x1="12" y1="1" x2="12" y2="23"></line>
                      <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                    Get Suggested Bid
                  </button>
                  <div style="display: flex; gap: var(--spacing-12);">
                    <button
                      id="export-csv-btn"
                      onclick="exportKeywordsAsCSV()"
                      style="padding: 10px 16px; background: #4CAF50; color: white; border: none; border-radius: var(--radius-medium); font-weight: 600; font-size: 0.875rem; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; gap: var(--spacing-8);"
                      onmouseover="this.style.background='#45a049'"
                      onmouseout="this.style.background='#4CAF50'"
                    >
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                      </svg>
                      Export CSV
                    </button>
                    <button
                      id="export-excel-btn"
                      onclick="exportKeywordsAsExcel()"
                      style="padding: 10px 16px; background: #2196F3; color: white; border: none; border-radius: var(--radius-medium); font-weight: 600; font-size: 0.875rem; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; gap: var(--spacing-8);"
                      onmouseover="this.style.background='#0b7dda'"
                      onmouseout="this.style.background='#2196F3'"
                    >
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                      </svg>
                      Export Excel
                    </button>
                  </div>
                </div>

                <!-- Filter Controls -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spacing-20); padding: var(--spacing-16); background: white; border-radius: var(--radius-medium); border: 1px solid var(--color-neutral-20);">
                  <div style="display: flex; align-items: center; gap: var(--spacing-16);">
                    <label style="font-weight: 600; color: var(--color-neutral-90); font-size: 0.875rem;">Filter by Match Type:</label>
                    <div style="display: flex; gap: var(--spacing-8);">
                      <button class="match-type-filter active" data-match-type="all" style="padding: 6px 12px; border: 2px solid #00C2A8; background: #00C2A8; color: white; border-radius: var(--radius-small); font-size: 0.875rem; font-weight: 600; cursor: pointer;">
                        All
                      </button>
                      <button class="match-type-filter" data-match-type="BROAD" style="padding: 6px 12px; border: 2px solid var(--color-neutral-30); background: white; color: var(--color-neutral-70); border-radius: var(--radius-small); font-size: 0.875rem; font-weight: 600; cursor: pointer;">
                        Broad
                      </button>
                      <button class="match-type-filter" data-match-type="PHRASE" style="padding: 6px 12px; border: 2px solid var(--color-neutral-30); background: white; color: var(--color-neutral-70); border-radius: var(--radius-small); font-size: 0.875rem; font-weight: 600; cursor: pointer;">
                        Phrase
                      </button>
                      <button class="match-type-filter" data-match-type="EXACT" style="padding: 6px 12px; border: 2px solid var(--color-neutral-30); background: white; color: var(--color-neutral-70); border-radius: var(--radius-small); font-size: 0.875rem; font-weight: 600; cursor: pointer;">
                        Exact
                      </button>
                    </div>
                  </div>
                  <div style="font-weight: 600; color: var(--color-neutral-70); font-size: 0.875rem;">
                    <span id="keywords-count">0</span> keywords
                  </div>
                </div>

                <!-- Keywords List -->
                <div id="keywords-list" style="display: grid; gap: var(--spacing-12); max-height: 500px; overflow-y: auto; padding: var(--spacing-12); background: white; border-radius: var(--radius-medium); border: 1px solid var(--color-neutral-20);">
                  <!-- Keywords will be inserted here -->
                </div>
              </div>
            </div>

          <?php else: ?>
            <!-- Access Denied Message -->
            <div style="text-align: center; padding: var(--spacing-48);">
              <div style="width: 80px; height: 80px; margin: 0 auto var(--spacing-24); background: linear-gradient(135deg, #FF6B6B, #FF5252); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 24px rgba(255, 107, 107, 0.3);">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"></circle>
                  <line x1="15" y1="9" x2="9" y2="15"></line>
                  <line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
              </div>
              <h1 style="font-size: 2rem; font-weight: 700; color: var(--color-neutral-90); margin: 0 0 var(--spacing-16) 0;">
                Access Denied
              </h1>
              <p style="font-size: 1.125rem; color: var(--color-neutral-70); margin: 0;">
                You don't have access to the Ads features.
              </p>
            </div>
          <?php endif; ?>

        </div>
      </div>
    </div>

    <!-- Pulse Section -->
    <div id="service-placeholder-pulse" class="service-section" style="display: none;">
      <div style="max-width: 1200px; margin: 0 auto;">
        <div style="background: var(--color-neutral-00); border: 1px solid var(--color-neutral-30); border-radius: var(--radius-large); box-shadow: 0 8px 32px rgba(0,0,0,0.06); padding: var(--spacing-40);">

          <?php if ($ads_enabled): ?>
            <!-- Header -->
            <div style="text-align: center; margin-bottom: var(--spacing-40);">
              <h1 class="text--heading-lg" style="color: var(--color-neutral-90); margin-bottom: var(--spacing-16);">
                Pulse
              </h1>
              <p class="text--body-lg" style="color: var(--color-neutral-70);">
               Insights and analytics for your ADS campaigns
              </p>
            </div>

            <!-- Filters Section -->
            <div style="background: var(--color-neutral-05); border-radius: var(--radius-medium); padding: var(--spacing-32); margin-bottom: var(--spacing-32);">
              <form id="pulse-filters-form" style="display: grid; grid-template-columns: 1fr 1fr auto; gap: var(--spacing-20); align-items: end;">
                <!-- KDP Account Dropdown -->
                <div>
                  <label for="pulse-kdp-account" style="display: block; margin-bottom: var(--spacing-8); color: var(--color-neutral-90); font-weight: 600; font-size: 0.875rem;">
                    KDP Account <span style="color: #FF6B6B;">*</span>
                  </label>
                  <select
                    id="pulse-kdp-account"
                    name="kdp_account"
                    required
                    disabled
                    style="width: 100%; padding: 12px 40px 12px 16px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); font-size: 1rem; font-weight: 500; color: #000; transition: border-color 0.2s; background-color: white; cursor: pointer; -webkit-appearance: none; -moz-appearance: none; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%23666%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 12px center; background-size: 18px; line-height: normal; display: block; min-height: 44px;"
                    onfocus="this.style.borderColor='var(--color-primary-60)'"
                    onblur="this.style.borderColor='var(--color-neutral-30)'"
                  >
                    <option value="">Loading accounts...</option>
                  </select>
                </div>

                <!-- Region Dropdown -->
                <div>
                  <label for="pulse-region" style="display: block; margin-bottom: var(--spacing-8); color: var(--color-neutral-90); font-weight: 600; font-size: 0.875rem;">
                    Region <span style="color: #FF6B6B;">*</span>
                  </label>
                  <select
                    id="pulse-region"
                    name="region"
                    required
                    style="width: 100%; padding: 12px 40px 12px 16px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); font-size: 1rem; font-weight: 500; color: #000; transition: border-color 0.2s; background-color: white; cursor: pointer; -webkit-appearance: none; -moz-appearance: none; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%23666%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 12px center; background-size: 18px; line-height: normal; display: block; min-height: 44px;"
                    onfocus="this.style.borderColor='var(--color-primary-60)'"
                    onblur="this.style.borderColor='var(--color-neutral-30)'"
                  >
                    <option value="">Select a region...</option>
                    <option value="AU">Australia (AU)</option>
                    <option value="CA">Canada (CA)</option>
                    <option value="DE">Germany (DE)</option>
                    <option value="ES">Spain (ES)</option>
                    <option value="FR">France (FR)</option>
                    <option value="IN">India (IN)</option>
                    <option value="IT">Italy (IT)</option>
                    <option value="JP">Japan (JP)</option>
                    <option value="MX">Mexico (MX)</option>
                    <option value="NL">Netherlands (NL)</option>
                    <option value="UK">United Kingdom (UK)</option>
                    <option value="US">United States (US)</option>
                  </select>
                </div>

                <!-- Analyze Button -->
                <button
                  type="submit"
                  id="pulse-analyze-btn"
                  style="padding: 12px 32px; background: linear-gradient(135deg, #00C2A8, #00A890); color: white; border: none; border-radius: var(--radius-medium); font-weight: 700; font-size: 1rem; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(0, 194, 168, 0.3); height: 44px; display: flex; align-items: center; gap: var(--spacing-8); white-space: nowrap;"
                  onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(0, 194, 168, 0.4)'"
                  onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0, 194, 168, 0.3)'"
                >
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                  </svg>
                  Analyze
                </button>
              </form>
            </div>

            <!-- Account Summary Section -->
            <div id="pulse-account-summary" style="display: none; margin-bottom: var(--spacing-32);">
              <!-- Error State -->
              <div id="pulse-account-summary-error" style="display: none; background: linear-gradient(135deg, #FFF3E0, #FFFBF5); border-radius: var(--radius-medium); padding: var(--spacing-24); text-align: center; border: 1px solid #FFB74D;">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#FF9800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto var(--spacing-12) auto;">
                  <circle cx="12" cy="12" r="10"></circle>
                  <line x1="12" y1="8" x2="12" y2="12"></line>
                  <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--color-neutral-80); margin: 0 0 var(--spacing-8) 0;">No Data Available</h3>
                <p id="pulse-account-summary-error-message" style="font-size: 0.9375rem; color: var(--color-neutral-60); margin: 0;">No account data found for the selected profile.</p>
              </div>

              <!-- Date Range Header -->
              <div id="pulse-account-summary-content">
                <div style="background: linear-gradient(135deg, #E8F5F3, #F7FCFB); border-radius: var(--radius-medium); padding: var(--spacing-16) var(--spacing-24); margin-bottom: var(--spacing-24); border: 1px solid var(--color-primary-20);">
                  <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: var(--spacing-12);">
                      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary-60)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                      </svg>
                      <span style="font-size: 0.9375rem; font-weight: 600; color: var(--color-neutral-80);">Data Period:</span>
                      <span id="pulse-date-range" style="font-size: 0.9375rem; color: var(--color-neutral-70);"></span>
                    </div>
                    <div style="display: flex; align-items: center; gap: var(--spacing-12);">
                      <span style="font-size: 0.8125rem; color: var(--color-neutral-60); font-style: italic;">Updated to last optimization</span>
                      <span id="pulse-optimization-runs" style="display: none; padding: 4px 12px; background: var(--color-primary-10); border-radius: var(--radius-full); font-size: 0.75rem; font-weight: 600; color: var(--color-primary-70);"></span>
                    </div>
                  </div>
                </div>

              <!-- Status Cards -->
              <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: var(--spacing-20); margin-bottom: var(--spacing-32);">
                <!-- Efficiency Trend Card -->
                <div style="background: white; border-radius: var(--radius-large); padding: var(--spacing-24); box-shadow: var(--shadow-low); border-left: 4px solid #4CAF50; min-height: 160px; display: flex; flex-direction: column;">
                  <div style="display: flex; align-items: center; gap: var(--spacing-12); margin-bottom: var(--spacing-8);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4CAF50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                      <polyline points="17 6 23 6 23 12"></polyline>
                    </svg>
                    <h3 style="font-size: 0.8125rem; font-weight: 700; color: var(--color-neutral-60); text-transform: uppercase; letter-spacing: 0.5px; margin: 0;">Efficiency Trend</h3>
                  </div>
                  <p style="font-size: 0.75rem; color: var(--color-neutral-60); margin: 0 0 var(--spacing-12) 0; font-style: italic;">Are clicks converting better or worse over time?</p>
                  <p id="pulse-efficiency-trend" style="font-size: 0.9375rem; font-weight: 600; color: var(--color-neutral-90); margin: 0; line-height: 1.5; flex-grow: 1;">—</p>
                </div>

                <!-- Cost Pressure Card -->
                <div style="background: white; border-radius: var(--radius-large); padding: var(--spacing-24); box-shadow: var(--shadow-low); border-left: 4px solid #FF9800; min-height: 160px; display: flex; flex-direction: column;">
                  <div style="display: flex; align-items: center; gap: var(--spacing-12); margin-bottom: var(--spacing-8);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FF9800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <line x1="12" y1="1" x2="12" y2="23"></line>
                      <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                    <h3 style="font-size: 0.8125rem; font-weight: 700; color: var(--color-neutral-60); text-transform: uppercase; letter-spacing: 0.5px; margin: 0;">Cost Pressure</h3>
                  </div>
                  <p style="font-size: 0.75rem; color: var(--color-neutral-60); margin: 0 0 var(--spacing-12) 0; font-style: italic;">Are costs rising faster than sales?</p>
                  <p id="pulse-cost-pressure" style="font-size: 0.9375rem; font-weight: 600; color: var(--color-neutral-90); margin: 0; line-height: 1.5; flex-grow: 1;">—</p>
                </div>

                <!-- Growth Constraint Card -->
                <div style="background: white; border-radius: var(--radius-large); padding: var(--spacing-24); box-shadow: var(--shadow-low); border-left: 4px solid #2196F3; min-height: 160px; display: flex; flex-direction: column;">
                  <div style="display: flex; align-items: center; gap: var(--spacing-12); margin-bottom: var(--spacing-8);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2196F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <circle cx="12" cy="12" r="10"></circle>
                      <polyline points="8 12 12 16 16 12"></polyline>
                      <line x1="12" y1="8" x2="12" y2="16"></line>
                    </svg>
                    <h3 style="font-size: 0.8125rem; font-weight: 700; color: var(--color-neutral-60); text-transform: uppercase; letter-spacing: 0.5px; margin: 0;">Growth Constraint</h3>
                  </div>
                  <p style="font-size: 0.75rem; color: var(--color-neutral-60); margin: 0 0 var(--spacing-12) 0; font-style: italic;">What is currently limiting growth?</p>
                  <p id="pulse-growth-constraint" style="font-size: 0.9375rem; font-weight: 600; color: var(--color-neutral-90); margin: 0; line-height: 1.5; flex-grow: 1;">—</p>
                </div>
              </div>

              <!-- Metrics Grid -->
              <h2 style="font-size: 1.25rem; font-weight: 700; color: var(--color-neutral-90); margin: 0; display: flex; align-items: center; gap: var(--spacing-12);">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary-60)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="18" y1="20" x2="18" y2="10"></line>
                  <line x1="12" y1="20" x2="12" y2="4"></line>
                  <line x1="6" y1="20" x2="6" y2="14"></line>
                </svg>
                Account Performance Metrics
              </h2>

              <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: var(--spacing-16); margin-bottom: var(--spacing-32);">
                <!-- Impressions -->
                <div style="background: white; border-radius: var(--radius-medium); padding: var(--spacing-20); box-shadow: var(--shadow-low); border-top: 3px solid #9C27B0;">
                  <div style="font-size: 0.75rem; font-weight: 700; color: var(--color-neutral-60); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: var(--spacing-8);">Impressions</div>
                  <div id="pulse-metric-impressions" style="font-size: 1.75rem; font-weight: 700; color: var(--color-neutral-90);">—</div>
                </div>

                <!-- Clicks -->
                <div style="background: white; border-radius: var(--radius-medium); padding: var(--spacing-20); box-shadow: var(--shadow-low); border-top: 3px solid #2196F3;">
                  <div style="font-size: 0.75rem; font-weight: 700; color: var(--color-neutral-60); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: var(--spacing-8);">Clicks</div>
                  <div id="pulse-metric-clicks" style="font-size: 1.75rem; font-weight: 700; color: var(--color-neutral-90);">—</div>
                </div>

                <!-- Cost -->
                <div style="background: white; border-radius: var(--radius-medium); padding: var(--spacing-20); box-shadow: var(--shadow-low); border-top: 3px solid #FF6B6B;">
                  <div style="font-size: 0.75rem; font-weight: 700; color: var(--color-neutral-60); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: var(--spacing-8);">Cost</div>
                  <div id="pulse-metric-cost" style="font-size: 1.75rem; font-weight: 700; color: #FF6B6B;">—</div>
                </div>

                <!-- CPC -->
                <div style="background: white; border-radius: var(--radius-medium); padding: var(--spacing-20); box-shadow: var(--shadow-low); border-top: 3px solid #FF9800;">
                  <div style="font-size: 0.75rem; font-weight: 700; color: var(--color-neutral-60); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: var(--spacing-8);">CPC</div>
                  <div id="pulse-metric-cpc" style="font-size: 1.75rem; font-weight: 700; color: var(--color-neutral-90);">—</div>
                </div>

                <!-- Sales -->
                <div style="background: white; border-radius: var(--radius-medium); padding: var(--spacing-20); box-shadow: var(--shadow-low); border-top: 3px solid #4CAF50;">
                  <div style="font-size: 0.75rem; font-weight: 700; color: var(--color-neutral-60); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: var(--spacing-8);">Sales</div>
                  <div id="pulse-metric-sales" style="font-size: 1.75rem; font-weight: 700; color: #4CAF50;">—</div>
                </div>

                <!-- ACOS -->
                <div style="background: white; border-radius: var(--radius-medium); padding: var(--spacing-20); box-shadow: var(--shadow-low); border-top: 3px solid #E91E63;">
                  <div style="font-size: 0.75rem; font-weight: 700; color: var(--color-neutral-60); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: var(--spacing-8);">ACOS</div>
                  <div id="pulse-metric-acos" style="font-size: 1.75rem; font-weight: 700; color: var(--color-neutral-90);">—</div>
                </div>

                <!-- ROAS -->
                <div style="background: white; border-radius: var(--radius-medium); padding: var(--spacing-20); box-shadow: var(--shadow-low); border-top: 3px solid #4CAF50;">
                  <div style="font-size: 0.75rem; font-weight: 700; color: var(--color-neutral-60); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: var(--spacing-8);">ROAS</div>
                  <div id="pulse-metric-roas" style="font-size: 1.75rem; font-weight: 700; color: #4CAF50;">—</div>
                </div>

                <!-- Money Wasted (Zero Sales) -->
                <div style="background: white; border-radius: var(--radius-medium); padding: var(--spacing-20); box-shadow: var(--shadow-low); border-top: 3px solid #FF6B6B;">
                  <div style="font-size: 0.75rem; font-weight: 700; color: var(--color-neutral-60); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: var(--spacing-8);">Money Wasted</div>
                  <div id="pulse-metric-money-wasted" style="font-size: 1.75rem; font-weight: 700; color: #FF6B6B;">—</div>
                  <div style="font-size: 0.65rem; color: var(--color-neutral-60); margin-top: var(--spacing-4);">Search terms with zero sales</div>
                </div>
              </div>
            </div>
            </div>

            <!-- Spend Effectiveness Section -->
            <div id="pulse-spend-effectiveness" style="display: none; margin-bottom: var(--spacing-20);">
              <h2 style="font-size: 1.25rem; font-weight: 700; color: var(--color-neutral-90); margin: 0 0 var(--spacing-16) 0; display: flex; align-items: center; gap: var(--spacing-12);">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary-60)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"></circle>
                  <path d="M12 6v6l4 2"></path>
                </svg>
                Spend Effectiveness (Last 30 Days)
              </h2>

              <div style="background: white; border-radius: var(--radius-large); padding: var(--spacing-20); box-shadow: var(--shadow-low);">
                <!-- Effectiveness Rating -->
                <div style="display: flex; align-items: center; gap: var(--spacing-12); margin-bottom: var(--spacing-12);\">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#9C27B0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  <h3 style="font-size: 0.8125rem; font-weight: 700; color: var(--color-neutral-60); text-transform: uppercase; letter-spacing: 0.5px; margin: 0;\">Effectiveness Rating</h3>
                </div>
                <p id="pulse-effectiveness-text" style="font-size: 1.125rem; font-weight: 600; color: var(--color-neutral-90); margin: 0 0 var(--spacing-20) 0; line-height: 1.5;\">—</p>

                <!-- Pie Chart -->
                <div style="display: flex; justify-content: center;">
                  <div style="position: relative; height: 240px; width: 100%; max-width: 240px;">
                    <canvas id="pulse-effectiveness-chart"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Money Wasters Section -->
            <div style="background: var(--color-neutral-05); border-radius: var(--radius-medium); padding: var(--spacing-32);">
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spacing-24);">
                <h2 style="font-size: 1.25rem; font-weight: 700; color: var(--color-neutral-90); margin: 0; display: flex; align-items: center; gap: var(--spacing-12);">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FF6B6B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                  </svg>
                  Top Money Wasters - Search Terms
                </h2>
                <span id="pulse-results-count" style="padding: 6px 16px; background: var(--color-neutral-20); border-radius: var(--radius-full); font-size: 0.875rem; font-weight: 600; color: var(--color-neutral-70);">
                  0 terms
                </span>
              </div>

              <p style="color: var(--color-neutral-60); margin-bottom: var(--spacing-24); font-size: 0.9375rem;">
                These are the search terms that generated <strong>zero sales</strong> but cost you the most. Review the matched keywords and consider adding these search terms as negative keywords to optimize your ad spend.
              </p>

              <!-- Loading State -->
              <div id="pulse-loading" style="display: none; text-align: center; padding: var(--spacing-48);">
                <div style="display: inline-block; width: 40px; height: 40px; border: 4px solid var(--color-neutral-20); border-top-color: var(--color-primary-60); border-radius: 50%; animation: spin 1s linear infinite;"></div>
                <p style="margin-top: var(--spacing-16); color: var(--color-neutral-60);">Analyzing your campaigns...</p>
              </div>

              <!-- Empty State -->
              <div id="pulse-empty-state" style="text-align: center; padding: var(--spacing-48);">
                <div style="width: 100px; height: 100px; margin: 0 auto var(--spacing-24); background: var(--color-neutral-10); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                  <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--color-neutral-40)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                  </svg>
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--color-neutral-70); margin: 0 0 var(--spacing-12) 0;">
                  No Data Yet
                </h3>
                <p style="color: var(--color-neutral-60); max-width: 400px; margin: 0 auto;">
                  Select a KDP account and region, then click "Analyze" to see your money-wasting search terms.
                </p>
              </div>

              <!-- Results Table -->
              <div id="pulse-results" style="display: none;">
                <!-- Totals Breakdown -->
                <div id="pulse-totals-breakdown" style="margin-bottom: var(--spacing-32); padding: var(--spacing-24); background: linear-gradient(135deg, #FFF5F5, #FFE5E5); border-radius: var(--radius-medium); border-left: 4px solid #FF6B6B;">
                  <!-- Will be populated dynamically -->
                </div>

                <div style="overflow-x: auto;">
                  <table id="pulse-money-wasters-table" style="width: 100%; border-collapse: separate; border-spacing: 0;">
                    <tbody id="pulse-table-body">
                      <!-- Will be populated dynamically -->
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          <?php else: ?>
            <!-- Access Denied Message -->
            <div style="text-align: center; padding: var(--spacing-64) var(--spacing-24);">
              <div style="font-size: 4rem; margin-bottom: var(--spacing-24);">🔒</div>
              <h2 style="font-size: 1.75rem; font-weight: 700; color: var(--color-neutral-90); margin: 0 0 var(--spacing-16) 0;">
                Access Restricted
              </h2>
              <p style="color: var(--color-neutral-60); font-size: 1.125rem; max-width: 500px; margin: 0 auto;">
                This feature is not available for your account. Please contact support for more information.
              </p>
            </div>
          <?php endif; ?>

        </div>
      </div>
    </div>

    </div> <!-- End main-sections-wrapper -->
  </div> <!-- End Main Content -->
</div> <!-- End Main Container -->

<style>
@keyframes spin {
  to { transform: rotate(360deg); }
}

@keyframes rotate {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}

@keyframes pulse {
  0%, 100% {
    transform: scale(1);
    opacity: 1;
  }
  50% {
    transform: scale(1.05);
    opacity: 0.8;
  }
}

@keyframes slideInRight {
  from {
    transform: translateX(100%);
    opacity: 0;
  }
  to {
    transform: translateX(0);
    opacity: 1;
  }
}

@keyframes fadeOut {
  from {
    opacity: 1;
  }
  to {
    opacity: 0;
  }
}

@keyframes checkmark {
  0% {
    stroke-dashoffset: 50;
  }
  100% {
    stroke-dashoffset: 0;
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
// Global variable for ads enabled status
const adsEnabled = <?php echo $ads_enabled ? 'true' : 'false'; ?>;

// Global variable for current WordPress user ID
const currentUserId = '<?php echo $current_user_id; ?>';

// Global variable for user language preference
const userLanguage = '<?php echo $user_language; ?>';

// Global variables for campaign configuration
let currentCampaigns = [];
let currentConfigurations = [];
let specialHandlingRules = [];
let currentBooksData = []; // Array to store books data

document.addEventListener('DOMContentLoaded', function() {

  // Check/create user in ads optimizer system
  async function checkCreateAdsUser() {
    const overlay = document.getElementById('user-verification-overlay');
    const mainSections = document.getElementById('main-sections-wrapper');
    const statusText = document.getElementById('verification-status');
    const step1 = document.getElementById('step-1');
    const step2 = document.getElementById('step-2');
    const step3 = document.getElementById('step-3');

    try {
      // Step 1: Check/Create user
      if (statusText) statusText.textContent = 'Verifying your account credentials...';

      const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=ads_check_create_user', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        }
      });

      const data = await response.json();

      // Mark step 1 as complete
      if (step1) {
        const indicator = step1.querySelector('.step-indicator');
        indicator.style.background = '#00C2A8';
        indicator.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12" style="stroke-dasharray: 50; stroke-dashoffset: 0; animation: checkmark 0.3s ease;"></polyline></svg>';
      }

      // Step 2: Loading workspace
      await new Promise(resolve => setTimeout(resolve, 500));
      if (statusText) statusText.textContent = 'Setting up your workspace...';
      if (step2) {
        step2.style.opacity = '1';
        const indicator = step2.querySelector('.step-indicator');
        indicator.style.background = '#00C2A8';
        indicator.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="animation: spin 1s linear infinite;"><circle cx="12" cy="12" r="10"></circle></svg>';
      }

      await new Promise(resolve => setTimeout(resolve, 800));

      // Mark step 2 as complete
      if (step2) {
        const indicator = step2.querySelector('.step-indicator');
        indicator.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12" style="stroke-dasharray: 50; stroke-dashoffset: 0; animation: checkmark 0.3s ease;"></polyline></svg>';
      }

      // Step 3: Ready
      await new Promise(resolve => setTimeout(resolve, 300));
      if (statusText) statusText.textContent = 'All set! Loading your dashboard...';
      if (step3) {
        step3.style.opacity = '1';
        const indicator = step3.querySelector('.step-indicator');
        indicator.style.background = '#00C2A8';
        indicator.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12" style="stroke-dasharray: 50; stroke-dashoffset: 0; animation: checkmark 0.3s ease;"></polyline></svg>';
      }

      // Wait a moment to show completion
      await new Promise(resolve => setTimeout(resolve, 600));

      // Hide overlay and show content
      if (overlay) {
        overlay.style.animation = 'fadeOut 0.5s ease';
        setTimeout(() => {
          overlay.style.display = 'none';
        }, 500);
      }

      if (mainSections) {
        mainSections.style.opacity = '1';
        mainSections.style.pointerEvents = 'auto';
      }

    } catch (error) {
      // On error, still show content but with error state
      console.error('User verification error:', error);

      if (statusText) {
        statusText.innerHTML = '<span style="color: #FF6B6B;">⚠ Verification failed, but you can continue</span>';
      }

      // Wait a moment then show content anyway
      await new Promise(resolve => setTimeout(resolve, 1500));

      if (overlay) {
        overlay.style.animation = 'fadeOut 0.5s ease';
        setTimeout(() => {
          overlay.style.display = 'none';
        }, 500);
      }

      if (mainSections) {
        mainSections.style.opacity = '1';
        mainSections.style.pointerEvents = 'auto';
      }
    }
  }

  // Run user check/creation on page load
  checkCreateAdsUser();
});

// Global function to refresh account dropdowns across all tabs
window.refreshAccountDropdowns = async function(userId = null) {
  userId = userId || currentUserId;

  if (!userId) return;

  try {
    // Fetch accounts from API
    const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=get_kdp_accounts', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        user_id: userId
      })
    });

    const data = await response.json();

    if (data.success && data.data && data.data.account_names) {
      const accounts = data.data.account_names;

      // Update Campaign Configuration dropdown
      const campaignAccountSelect = document.getElementById('campaign-account');
      if (campaignAccountSelect) {
        const currentValue = campaignAccountSelect.value;
        campaignAccountSelect.innerHTML = '<option value="">Select an account...</option>';

        if (accounts.length === 0) {
          campaignAccountSelect.innerHTML = '<option value="">No accounts found</option>';
          campaignAccountSelect.disabled = true;
        } else {
          accounts.forEach(account => {
            const option = document.createElement('option');
            option.value = account;
            option.textContent = account;
            campaignAccountSelect.appendChild(option);
          });
          campaignAccountSelect.disabled = false;

          // Restore previous selection if still valid
          if (accounts.includes(currentValue)) {
            campaignAccountSelect.value = currentValue;
          }
        }
      }

      // Update Optimization Schedule dropdown
      const scheduleAccountSelect = document.getElementById('schedule-account');
      if (scheduleAccountSelect) {
        const currentValue = scheduleAccountSelect.value;
        scheduleAccountSelect.innerHTML = '<option value="">Select an account...</option>';

        accounts.forEach(account => {
          const option = document.createElement('option');
          option.value = account;
          option.textContent = account;
          scheduleAccountSelect.appendChild(option);
        });

        // Restore previous selection if still valid
        if (accounts.includes(currentValue)) {
          scheduleAccountSelect.value = currentValue;
        }
      }

      // Update global accounts data for optimization schedule
      if (window.currentAccountsData) {
        window.currentAccountsData = data;
      }
    }
  } catch (error) {
    console.error('Error refreshing account dropdowns:', error);
  }
};

// Global function for loading KDP accounts (accessible from global scope)
window.loadKDPAccounts = async function(userId = null) {
  // Use current WordPress user ID if no userId provided
  userId = userId || currentUserId;

  const loadingEl = document.getElementById('kdp-accounts-loading');
  const emptyEl = document.getElementById('kdp-accounts-empty');
  const listEl = document.getElementById('kdp-accounts-list');

  if (!loadingEl || !emptyEl || !listEl) return;

  // If still no user ID, show error
  if (!userId) {
    loadingEl.style.display = 'none';
    emptyEl.style.display = 'block';
    emptyEl.innerHTML = '<p style="color: #FF6B6B;">User ID not available. Please log in again.</p>';
    listEl.style.display = 'none';
    return;
  }

  // Show loading state
  loadingEl.style.display = 'block';
  emptyEl.style.display = 'none';
  listEl.style.display = 'none';

  try {
    // Fetch accounts from API
    const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=get_kdp_accounts', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        user_id: userId
      })
    });

    const data = await response.json();

    if (data.success && data.data && data.data.account_names) {
      const accounts = data.data.account_names;

      if (accounts.length === 0) {
        loadingEl.style.display = 'none';
        emptyEl.style.display = 'block';
        emptyEl.innerHTML = '<p style="color: var(--color-neutral-60);">No KDP accounts found for this user</p>';
      } else {
        loadingEl.style.display = 'none';
        listEl.style.display = 'grid';

        // Render accounts
        listEl.innerHTML = accounts.map(accountName => `
          <div style="padding: var(--spacing-20); background: var(--color-neutral-00); border: 2px solid var(--color-neutral-20); border-radius: var(--radius-medium); display: flex; justify-content: space-between; align-items: center; transition: all 0.2s; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            <div>
              <h3 style="margin: 0; font-size: 1.125rem; font-weight: 700; color: var(--color-neutral-90);">
                ${accountName}
              </h3>
            </div>
            <div style="display: flex; gap: var(--spacing-12);">
              <button
                onclick="deleteKDPAccount('${userId}', '${accountName}')"
                style="padding: 10px 16px; background: #FFE6E6; color: #FF6B6B; border: 1px solid #FFCCCC; border-radius: var(--radius-small); cursor: pointer; font-weight: 600; transition: all 0.2s;"
                onmouseover="this.style.background='#FFCCCC'; this.style.transform='translateY(-2px)';"
                onmouseout="this.style.background='#FFE6E6'; this.style.transform='translateY(0)';"
              >
                Delete
              </button>
            </div>
          </div>
        `).join('');
      }

      // Refresh account dropdowns in other tabs after loading accounts list
      await window.refreshAccountDropdowns(userId);

      // Update the account name dropdown to disable taken names
      window.updateAccountNameDropdown(accounts);
    } else {
      throw new Error(data.data?.message || 'Failed to load accounts');
    }
  } catch (error) {
    console.error('Error loading accounts:', error);
    loadingEl.style.display = 'none';
    emptyEl.style.display = 'block';
    emptyEl.innerHTML = '<p style="color: #FF6B6B;">Failed to load accounts. Please try again.</p>';
  }
};

// Function to update account name dropdown based on existing accounts
window.updateAccountNameDropdown = function(existingAccounts) {
  const dropdown = document.getElementById('kdp-account-name');
  if (!dropdown) return;

  // Get all options except the first (placeholder)
  const options = dropdown.querySelectorAll('option:not(:first-child)');

  options.forEach(option => {
    const accountName = option.value;
    const isTaken = existingAccounts.includes(accountName);

    if (isTaken) {
      option.disabled = true;
      option.style.color = '#999';
      option.style.background = '#f5f5f5';
      option.textContent = accountName + ' (Already in use)';
    } else {
      option.disabled = false;
      option.style.color = '';
      option.style.background = '';
      option.textContent = accountName;
    }
  });
};

document.addEventListener('DOMContentLoaded', function() {
  // Show initial empty state on page load
  if (document.getElementById('kdp-accounts-list')) {
    window.loadKDPAccounts(null);
  }

  // KDP Account Form Validation and Submission
  const kdpForm = document.getElementById('add-kdp-account-form');
  const authCodeInput = document.getElementById('kdp-auth-code');
  const accountNameInput = document.getElementById('kdp-account-name');
  const authCodeError = document.getElementById('auth-code-error');
  const accountNameError = document.getElementById('account-name-error');
  const submitButton = document.getElementById('submit-kdp-account');
  const submitButtonText = document.getElementById('submit-button-text');

  // Load KDP accounts automatically for current user
  if (document.getElementById('kdp-accounts-list')) {
    window.loadKDPAccounts(currentUserId);
  }

  // Handle GET AUTHORIZATION CODE button - redirects to Amazon OAuth
  const fetchAuthCodeBtn = document.getElementById('fetch-auth-code-btn');
  if (fetchAuthCodeBtn) {
    fetchAuthCodeBtn.addEventListener('click', function() {
      // Build authorization URL (redirects back to ads page)
      const amazonOAuthUrl = 'https://www.amazon.com/ap/oa?client_id=amzn1.application-oa2-client.f58a70d6e0524c08b8634335eba3bcbf&scope=advertising::campaign_management&response_type=code&redirect_uri=https://insights.plottybot.com/ads';

      console.log('Redirecting to Amazon OAuth');

      // Redirect to Amazon (same window - will return to ads page after authorization)
      window.location.href = amazonOAuthUrl;
    });
  }

  // Check if user just returned from Amazon OAuth with authorization code
  function checkForAuthorizationCode() {
    const urlParams = new URLSearchParams(window.location.search);
    const code = urlParams.get('code');

    if (code) {
      console.log('Authorization code detected in URL');
      console.log('Code:', code);

      // Auto-fill the authorization code
      const authCodeInput = document.getElementById('kdp-auth-code');
      if (authCodeInput) {
        authCodeInput.value = code;
        console.log('Authorization code filled automatically');

        // Trigger validation
        authCodeInput.dispatchEvent(new Event('input', { bubbles: true }));

        // Focus on account name field
        const accountNameInput = document.getElementById('kdp-account-name');
        if (accountNameInput) {
          setTimeout(() => {
            accountNameInput.focus();
          }, 300);
        }

        // Show success message
        const successMessage = document.createElement('div');
        successMessage.style.cssText = 'position: fixed; top: 20px; right: 20px; background: #00C2A8; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 10000; animation: slideInRight 0.3s ease;';
        successMessage.innerHTML = '✓ Authorization code retrieved!<br><small>Now enter your Account Name and submit.</small>';
        document.body.appendChild(successMessage);

        setTimeout(() => {
          successMessage.remove();
        }, 5000);
      }

      // Clean URL (remove query parameters) without reloading page
      const cleanUrl = window.location.origin + window.location.pathname;
      window.history.replaceState({}, document.title, cleanUrl);
      console.log('URL cleaned');
    }
  }

  // Run the check immediately on page load
  checkForAuthorizationCode();

  if (kdpForm) {

    // Real-time validation for authorization code
    authCodeInput.addEventListener('input', function() {
      const value = this.value;

      if (value.length > 0 && value.length !== 20) {
        authCodeError.textContent = `Current length: ${value.length}/20 characters`;
        authCodeError.style.display = 'block';
        authCodeInput.style.borderColor = '#FF6B6B';
      } else if (value.length === 20) {
        authCodeError.style.display = 'none';
        authCodeInput.style.borderColor = '#00C2A8';
      } else {
        authCodeError.style.display = 'none';
        authCodeInput.style.borderColor = 'var(--color-neutral-30)';
      }
    });

    // Real-time validation for account name dropdown
    accountNameInput.addEventListener('change', function() {
      const value = this.value;

      if (value && value !== '') {
        this.style.borderColor = '#00C2A8';
        accountNameError.style.display = 'none';
      } else {
        this.style.borderColor = 'var(--color-neutral-30)';
      }
    });

    // Form submission
    kdpForm.addEventListener('submit', async function(e) {
      e.preventDefault();

      const authCode = authCodeInput.value.trim();
      const accountName = accountNameInput.value.trim();
      const userId = currentUserId; // Use current WordPress user ID

      console.log('Form submission - Auth Code:', authCode);
      console.log('Form submission - Auth Code Length:', authCode.length);
      console.log('Form submission - Account Name:', accountName);
      console.log('Form submission - User ID:', userId);

      // Validate authorization code
      if (authCode.length !== 20) {
        authCodeError.textContent = 'Authorization code must be exactly 20 characters';
        authCodeError.style.display = 'block';
        authCodeInput.focus();
        return;
      }

      // Validate account name
      if (!accountName || accountName === '') {
        accountNameError.textContent = 'Please select an account name';
        accountNameError.style.display = 'block';
        accountNameInput.focus();
        return;
      }

      // Check if the selected option is disabled (already taken)
      const selectedOption = accountNameInput.querySelector(`option[value="${accountName}"]`);
      if (selectedOption && selectedOption.disabled) {
        accountNameError.textContent = 'This account name is already in use. Please select another.';
        accountNameError.style.display = 'block';
        accountNameInput.focus();
        return;
      }

      // Show loading state
      submitButton.disabled = true;
      submitButtonText.textContent = 'Adding Account...';
      submitButton.style.opacity = '0.7';

      // Prepare payload
      const payload = {
        user_id: userId,
        account_name: accountName,
        auth_code: authCode,
        redirect_uri: 'https://insights.plottybot.com/ads'
      };

      console.log('=== ADD KDP ACCOUNT REQUEST ===');
      console.log('Payload being sent:', JSON.stringify(payload, null, 2));
      console.log('================================');

      try {
        // Call AJAX endpoint to add KDP profile
        const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=add_kdp_profile', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify(payload)
        });

        const data = await response.json();

        console.log('Add KDP account response:', data);
        console.log('API Response Status:', response.status);
        console.log('Full API Response Object:', JSON.stringify(data, null, 2));

        if (data.success) {
          // Success - clear form
          kdpForm.reset();
          authCodeInput.style.borderColor = 'var(--color-neutral-30)';
          accountNameInput.style.borderColor = 'var(--color-neutral-30)';



          // Show success message
          const successMessage = document.createElement('div');
          successMessage.style.cssText = 'position: fixed; top: 20px; right: 20px; background: #00C2A8; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 1000; animation: slideInRight 0.3s ease;';
          successMessage.textContent = `✓ Account "${accountName}" added successfully!`;
          document.body.appendChild(successMessage);

          setTimeout(() => {
            successMessage.remove();
          }, 3000);

          // Reload accounts list using currentUserId (this also refreshes dropdowns)
          window.loadKDPAccounts(currentUserId);

          // Also refresh optimization schedules if they're loaded
          if (window.loadOptimizationSchedules) {
            window.loadOptimizationSchedules(currentUserId);
          }
        } else {
          // Error from API
          console.error('API returned error:', data);
          console.error('Error message:', data.data?.message);
          console.error('Error details:', data.data);

          // Show detailed error message
          let errorMessage = 'Failed to add account. ';
          if (data.data?.message) {
            errorMessage += data.data.message;
          } else {
            errorMessage += 'Please try again.';
          }

          authCodeError.innerHTML = errorMessage;
          authCodeError.style.display = 'block';
        }

      } catch (error) {
        console.error('Exception during account creation:', error);
        console.error('Error stack:', error.stack);
        authCodeError.innerHTML = 'Failed to add account. Please check your connection and try again.<br><small>Check console for details.</small>';
        authCodeError.style.display = 'block';
      } finally {
        submitButton.disabled = false;
        submitButtonText.textContent = 'Add KDP Account';
        submitButton.style.opacity = '1';
      }
    });
  }


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

  // Make switchService a global function so it can be called from inline onclick handlers
  window.switchService = function(targetService) {
    // Don't allow navigation if ads are not enabled
    if (!adsEnabled) {
      return;
    }

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

      // Prevent navigation if ads are not enabled
      if (!adsEnabled) {
        return;
      }

      const service = this.getAttribute('data-service');
      window.switchService(service);
    });
  });

  // ============================================
  // OPTIMIZATION SCHEDULE SECTION
  // ============================================

  // Global variables to store current schedules and accounts data
  window.currentSchedulesData = null;
  window.currentAccountsData = null;

  // Load optimization schedules automatically for current user
  if (document.getElementById('schedules-list')) {
    window.loadOptimizationSchedules(currentUserId);
  }
});

// Global function for loading optimization schedules (accessible from global scope)
window.loadOptimizationSchedules = async function(userId = null) {
  // Use current WordPress user ID if no userId provided
  userId = userId || currentUserId;

  const loadingEl = document.getElementById('schedules-loading');
  const emptyEl = document.getElementById('schedules-empty');
  const listEl = document.getElementById('schedules-list');

  if (!loadingEl || !emptyEl || !listEl) return;

  // If still no user ID, show error
  if (!userId) {
    loadingEl.style.display = 'none';
    emptyEl.style.display = 'block';
    emptyEl.innerHTML = '<p style="color: #FF6B6B;">User ID not available. Please log in again.</p>';
    listEl.style.display = 'none';
    return;
  }

  // Show loading state
  loadingEl.style.display = 'block';
  emptyEl.style.display = 'none';
  listEl.style.display = 'none';

  try {
    // Fetch accounts and schedules in parallel
    const [accountsResponse, schedulesResponse] = await Promise.all([
      fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=get_kdp_accounts', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify({
          user_id: userId
        })
      }),
      fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=get_optimization_schedules', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify({
          user_id: userId
        })
      })
    ]);

    const accountsData = await accountsResponse.json();
    const data = await schedulesResponse.json();

    // Store data globally for use in form
    window.currentAccountsData = accountsData;
    window.currentSchedulesData = data;

    // Update account dropdown
    updateAccountDropdown(accountsData, data);

    // Update region dropdown filtering
    updateRegionDropdownFiltering(accountsData, data);

    if (data.success && data.data && data.data.jobs) {
      const jobs = data.data.jobs;

      if (jobs.length === 0) {
        loadingEl.style.display = 'none';
        emptyEl.style.display = 'block';
        emptyEl.innerHTML = '<p style="color: var(--color-neutral-60);">No scheduled optimizations found for this user</p>';
      } else {
        loadingEl.style.display = 'none';
        listEl.style.display = 'grid';

        // Render schedules
        listEl.innerHTML = jobs.map((job, index) => {
          const lastRun = job.last_run_time !== "1970-01-01T00:00:00+00:00"
            ? new Date(job.last_run_time).toLocaleString()
            : 'Never';
          const nextRun = job.next_run_time !== "1970-01-01T00:00:00+00:00"
            ? new Date(job.next_run_time).toLocaleString()
            : 'Not scheduled';

            return `
            <div style="padding: var(--spacing-24); background: var(--color-neutral-00); border: 2px solid var(--color-neutral-20); border-radius: var(--radius-medium); box-shadow: 0 2px 8px rgba(0,0,0,0.05); transition: all 0.2s;">
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spacing-20);">
                <div style="flex: 1;">
                  <h3 style="margin: 0 0 var(--spacing-8) 0; font-size: 1.5rem; font-weight: 700; color: var(--color-neutral-90);">
                    ${job.account_id}
                  </h3>
                  <div style="display: flex; align-items: center; gap: var(--spacing-8);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--color-neutral-60)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                      <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    <p style="margin: 0; font-size: 1.125rem; color: var(--color-neutral-70); font-weight: 600;">
                      ${job.region}
                    </p>
                  </div>
                </div>
              </div>

              <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spacing-16); padding: var(--spacing-20); background: var(--color-neutral-05); border-radius: var(--radius-small); margin-bottom: var(--spacing-20);">
                <div>
                  <p style="margin: 0 0 var(--spacing-8) 0; font-size: 0.75rem; color: var(--color-neutral-60); text-transform: uppercase; font-weight: 600; letter-spacing: 0.5px;">
                    Last Run
                  </p>
                  <p style="margin: 0; font-size: 1rem; color: var(--color-neutral-90); font-weight: 500;">
                    ${lastRun}
                  </p>
                </div>
                <div>
                  <p style="margin: 0 0 var(--spacing-8) 0; font-size: 0.75rem; color: var(--color-neutral-60); text-transform: uppercase; font-weight: 600; letter-spacing: 0.5px;">
                    Next Run
                  </p>
                  <p style="margin: 0; font-size: 1rem; color: var(--color-neutral-90); font-weight: 500;">
                    ${nextRun}
                  </p>
                </div>
              </div>

              <div style="display: flex; align-items: center; justify-content: space-between; gap: var(--spacing-16); margin-bottom: var(--spacing-16);">
                <!-- Toggle Switch with Status -->
                <div style="display: flex; align-items: center; gap: var(--spacing-12);">
                  <label style="position: relative; display: inline-block; width: 54px; height: 28px; cursor: pointer;">
                    <input
                      type="checkbox"
                      ${job.active ? 'checked' : ''}
                      onchange="toggleOptimization('${userId}', '${job.account_id}-${job.region}', ${job.active})"
                      style="opacity: 0; width: 0; height: 0;"
                    />
                    <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: ${job.active ? '#00C2A8' : '#E0E0E0'}; transition: 0.3s; border-radius: 28px; box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);">
                      <span style="position: absolute; content: ''; height: 22px; width: 22px; left: ${job.active ? '29px' : '3px'}; bottom: 3px; background-color: white; transition: 0.3s; border-radius: 50%; box-shadow: 0 2px 4px rgba(0,0,0,0.2);"></span>
                    </span>
                  </label>
                  <span style="font-size: 0.9375rem; color: ${job.active ? '#00C2A8' : '#999'}; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                    ${job.active ? 'Active' : 'Inactive'}
                  </span>
                </div>

                <div style="display: flex; gap: var(--spacing-12);">
                  <!-- View Optimization Runs Button -->
                  <button
                    onclick="window.fetchOptimizationRuns('${userId}', '${job.account_id}', '${job.region}', 'schedule-runs-${job.account_id}-${job.region}')"
                    style="padding: 10px 20px; background: #E3F9F5; color: #00A890; border: 1px solid #00C2A8; border-radius: var(--radius-small); cursor: pointer; font-weight: 600; transition: all 0.2s; font-size: 0.9375rem;"
                    onmouseover="this.style.background='#D1F4EC'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.1)';"
                    onmouseout="this.style.background='#E3F9F5'; this.style.transform='translateY(0)'; this.style.boxShadow='none';"
                  >
                    View Optimization Runs
                  </button>

                  <!-- Delete Button -->
                  <button
                    onclick="deleteOptimization('${userId}', '${job.account_id}-${job.region}')"
                    style="padding: 10px 20px; background: #FFE6E6; color: #FF6B6B; border: 1px solid #FFCCCC; border-radius: var(--radius-small); cursor: pointer; font-weight: 600; transition: all 0.2s; font-size: 0.9375rem;"
                    onmouseover="this.style.background='#FFCCCC'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.1)';"
                    onmouseout="this.style.background='#FFE6E6'; this.style.transform='translateY(0)'; this.style.boxShadow='none';"
                  >
                    Delete
                  </button>
                </div>
              </div>

              <!-- Optimization Runs Container -->
              <div id="schedule-runs-${job.account_id}-${job.region}" style="display: none; margin-top: var(--spacing-16); padding: var(--spacing-16); background: var(--color-neutral-05); border-radius: var(--radius-small); border: 1px solid var(--color-neutral-30);"></div>
            </div>
          `}).join('');
      }
    } else {
      throw new Error(data.data?.message || 'Failed to load schedules');
    }
  } catch (error) {
    console.error('Error loading schedules:', error);
    loadingEl.style.display = 'none';
    emptyEl.style.display = 'block';
    emptyEl.innerHTML = '<p style="color: #FF6B6B;">Failed to load schedules. Please try again.</p>';
  }
};

// Helper function to update account dropdown
function updateAccountDropdown(accountsData, schedulesData) {
  const accountDropdown = document.getElementById('schedule-account');
  if (!accountDropdown) return;

  // Get list of accounts
  const accounts = accountsData.success && accountsData.data && accountsData.data.account_names
    ? accountsData.data.account_names
    : [];

  // Clear existing options except the first one
  accountDropdown.innerHTML = '<option value="">Select an account...</option>';

  // Add all accounts
  accounts.forEach(account => {
    const option = document.createElement('option');
    option.value = account;
    option.textContent = account;
    accountDropdown.appendChild(option);
  });
}

// Helper function to update region dropdown filtering based on selected account
function updateRegionDropdownFiltering(accountsData, schedulesData) {
  const accountDropdown = document.getElementById('schedule-account');
  const regionDropdown = document.getElementById('schedule-region');

  if (!accountDropdown || !regionDropdown) return;

  // Remove old event listeners by replacing the element
  const newAccountDropdown = accountDropdown.cloneNode(true);
  accountDropdown.parentNode.replaceChild(newAccountDropdown, accountDropdown);

  // Listen for account changes on the new element
  newAccountDropdown.addEventListener('change', function() {
    filterRegionOptions(this.value, schedulesData);
  });
}

// Helper function to filter region options based on existing schedules
function filterRegionOptions(selectedAccount, schedulesData) {
    const regionDropdown = document.getElementById('schedule-region');
    if (!regionDropdown) return;

    if (!selectedAccount) {
      // Reset all options to enabled
      Array.from(regionDropdown.options).forEach(option => {
        if (option.value) {
          option.disabled = false;
          option.style.color = '';
          // Clean up the text
          const baseText = option.value === 'AU' ? 'Australia (AU)' :
                          option.value === 'CA' ? 'Canada (CA)' :
                          option.value === 'DE' ? 'Germany (DE)' :
                          option.value === 'ES' ? 'Spain (ES)' :
                          option.value === 'FR' ? 'France (FR)' :
                          option.value === 'IN' ? 'India (IN)' :
                          option.value === 'IT' ? 'Italy (IT)' :
                          option.value === 'JP' ? 'Japan (JP)' :
                          option.value === 'MX' ? 'Mexico (MX)' :
                          option.value === 'NL' ? 'Netherlands (NL)' :
                          option.value === 'UK' ? 'United Kingdom (UK)' :
                          option.value === 'US' ? 'United States (US)' : option.textContent;
          option.textContent = baseText;
        }
      });
      return;
    }

    // Get existing schedule combinations
    const existingCombinations = schedulesData && schedulesData.success && schedulesData.data && schedulesData.data.jobs
      ? schedulesData.data.jobs.map(job => ({
          account: job.account_id,
          region: job.region
        }))
      : [];

    // Update region options
    Array.from(regionDropdown.options).forEach(option => {
      if (option.value) {
        const isScheduled = existingCombinations.some(
          combo => combo.account === selectedAccount && combo.region === option.value
        );

        // Get base text
        const baseText = option.value === 'AU' ? 'Australia (AU)' :
                        option.value === 'CA' ? 'Canada (CA)' :
                        option.value === 'DE' ? 'Germany (DE)' :
                        option.value === 'ES' ? 'Spain (ES)' :
                        option.value === 'FR' ? 'France (FR)' :
                        option.value === 'IN' ? 'India (IN)' :
                        option.value === 'IT' ? 'Italy (IT)' :
                        option.value === 'JP' ? 'Japan (JP)' :
                        option.value === 'MX' ? 'Mexico (MX)' :
                        option.value === 'NL' ? 'Netherlands (NL)' :
                        option.value === 'UK' ? 'United Kingdom (UK)' :
                        option.value === 'US' ? 'United States (US)' : option.textContent;

        if (isScheduled) {
          option.disabled = true;
          option.style.color = '#ccc';
          option.textContent = baseText + ' (Already scheduled)';
        } else {
          option.disabled = false;
          option.style.color = '';
          option.textContent = baseText;
        }
      }
    });
}

document.addEventListener('DOMContentLoaded', function() {
  // Schedule Optimization Form Submission
  const scheduleOptimizationForm = document.getElementById('schedule-optimization-form');

  if (scheduleOptimizationForm) {
    // Form submission
    scheduleOptimizationForm.addEventListener('submit', async function(e) {
      e.preventDefault();

      // Get fresh references to dropdowns (they may be replaced by cloning)
      const scheduleAccountSelect = document.getElementById('schedule-account');
      const scheduleRegionSelect = document.getElementById('schedule-region');
      const scheduleAccountError = document.getElementById('schedule-account-error');
      const scheduleRegionError = document.getElementById('schedule-region-error');
      const scheduleSubmitButton = document.getElementById('submit-schedule-optimization');
      const scheduleSubmitButtonText = document.getElementById('schedule-submit-button-text');


      const userId = currentUserId; // Use current WordPress user ID
      const account = scheduleAccountSelect.value;
      const region = scheduleRegionSelect.value;


      // Validate account
      if (!account) {
        scheduleAccountError.textContent = 'Please select an account';
        scheduleAccountError.style.display = 'block';
        scheduleAccountSelect.focus();
        return;
      }

      // Validate region
      if (!region) {
        scheduleRegionError.textContent = 'Please select a region';
        scheduleRegionError.style.display = 'block';
        scheduleRegionSelect.focus();
        return;
      }

      // Hide errors
      scheduleAccountError.style.display = 'none';
      scheduleRegionError.style.display = 'none';

      // Show loading state
      scheduleSubmitButton.disabled = true;
      scheduleSubmitButtonText.textContent = 'Scheduling...';
      scheduleSubmitButton.style.opacity = '0.7';

      try {
        // Call AJAX endpoint to schedule optimization
        const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=schedule_optimization', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            user_id: userId,
            account: account,
            region: region
          })
        });

        const data = await response.json();

        if (data.success) {
          // Show success message
          const successMessage = document.createElement('div');
          successMessage.style.cssText = 'position: fixed; top: 20px; right: 20px; background: #00C2A8; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 1000; animation: slideInRight 0.3s ease;';
          successMessage.textContent = `✓ Optimization scheduled for ${account} in ${region}!`;
          document.body.appendChild(successMessage);

          setTimeout(() => {
            successMessage.remove();
          }, 3000);

          // Reload schedules which will automatically update dropdowns
          await loadOptimizationSchedules(userId);

          // Reset form after reload
          scheduleOptimizationForm.reset();
          scheduleAccountSelect.style.borderColor = 'var(--color-neutral-30)';
          scheduleRegionSelect.style.borderColor = 'var(--color-neutral-30)';
        } else {
          // Error from API
          scheduleAccountError.textContent = data.data?.message || 'Failed to schedule optimization. Please try again.';
          scheduleAccountError.style.display = 'block';
        }

      } catch (error) {
        scheduleAccountError.textContent = 'Failed to schedule optimization. Please check your connection and try again.';
        scheduleAccountError.style.display = 'block';
      } finally {
        scheduleSubmitButton.disabled = false;
        scheduleSubmitButtonText.textContent = 'Schedule Optimization';
        scheduleSubmitButton.style.opacity = '1';
      }
    });
  }

  // ============================================
  // CAMPAIGN CONFIGURATION SECTION
  // ============================================

  const campaignAccountSelect = document.getElementById('campaign-account');
  const campaignRegionSelect = document.getElementById('campaign-region');

  if (campaignAccountSelect) {
    // Load KDP accounts automatically for campaign configuration
    (async function() {
      try {
        const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=get_kdp_accounts', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            user_id: currentUserId
          })
        });

        const data = await response.json();

        if (data.success && data.data && data.data.account_names) {
          const accounts = data.data.account_names;

          // Clear and populate account dropdown
          campaignAccountSelect.innerHTML = '<option value="">Select an account...</option>';

          accounts.forEach(account => {
            const option = document.createElement('option');
            option.value = account;
            option.textContent = account;
            campaignAccountSelect.appendChild(option);
          });

          // Enable the dropdown
          campaignAccountSelect.disabled = false;
        } else {
          // No accounts found
          campaignAccountSelect.innerHTML = '<option value="">No accounts found</option>';
          campaignAccountSelect.disabled = true;
        }
      } catch (error) {
        console.error('Error loading accounts for campaign:', error);
        campaignAccountSelect.innerHTML = '<option value="">Error loading accounts</option>';
        campaignAccountSelect.disabled = true;
      }
    })();

    // Load campaigns and configurations when both account and region are selected
    async function loadCampaignData() {
      const userId = currentUserId; // Use current WordPress user ID
      const account = campaignAccountSelect.value;
      const region = campaignRegionSelect.value;

      const formContainer = document.getElementById('campaign-config-form-container');
      const loadingContainer = document.getElementById('campaign-config-loading');
      const emptyContainer = document.getElementById('campaign-config-empty');
      const listContainer = document.getElementById('campaign-configs-list-container');

      // Reset form fields when account/region changes
      const campaignSelect = document.getElementById('config-campaign-name');
      const adGroupSelect = document.getElementById('config-ad-group');
      const asinSelect = document.getElementById('config-asin');
      const bookPreview = document.getElementById('book-preview');
      const bidStrategySelect = document.getElementById('config-bid-strategy');
      
      if (campaignSelect) campaignSelect.value = '';
      if (adGroupSelect) {
        adGroupSelect.innerHTML = '<option value="">Select an ad group...</option>';
      }
      if (asinSelect) {
        asinSelect.innerHTML = '<option value="">Select a book...</option>';
      }
      if (bookPreview) bookPreview.style.display = 'none';
      if (bidStrategySelect) bidStrategySelect.value = 'conservative';
      
      // Reset targets and special rules
      resetTargetsAndRules();

      // Check if all required fields are filled
      if (!userId || !account || !region) {
        formContainer.style.display = 'none';
        listContainer.style.display = 'none';
        loadingContainer.style.display = 'none';
        emptyContainer.style.display = 'block';
        return;
      }

      // Show loading state
      formContainer.style.display = 'none';
      listContainer.style.display = 'none';
      loadingContainer.style.display = 'block';
      emptyContainer.style.display = 'none';

      const kdpProfile = account + '-' + region;

      try {
        console.log('Fetching campaigns and configurations for:', { userId, account, region, kdpProfile });

        // Fetch campaigns, configurations, and books in parallel
        const [campaignsResponse, configsResponse, booksResponse] = await Promise.all([
          fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=get_campaign_list', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify({ user_id: userId, account: account, region: region })
          }),
          fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=list_campaign_configs', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify({ user_id: userId, kdp_profile: kdpProfile })
          }),
          fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=list_books', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify({ user_id: userId, kdp_profile: kdpProfile })
          })
        ]);

        console.log('Campaigns response status:', campaignsResponse.status);
        console.log('Configs response status:', configsResponse.status);
        console.log('Books response status:', booksResponse.status);

        const campaignsData = await campaignsResponse.json();
        const configsData = await configsResponse.json();
        const booksData = await booksResponse.json();

        console.log('Campaigns data:', campaignsData);
        console.log('Configs data:', configsData);
        console.log('Books data:', booksData);
        console.log('configsData.success:', configsData.success);
        console.log('configsData.data:', configsData.data);
        if (configsData.data) {
          console.log('configsData.data.configurations:', configsData.data.configurations);
        }

        if (campaignsData.success && campaignsData.data && campaignsData.data.campaigns) {
          // Filter out PAUSED, ARCHIVED ad groups and AUTO campaigns
          currentCampaigns = campaignsData.data.campaigns.filter(c => 
            c.state !== 'PAUSED' && 
            c.state !== 'ARCHIVED' && 
            c.campaignType !== 'AUTO' &&
            c.adGroupState !== 'PAUSED' &&
            c.adGroupState !== 'ARCHIVED'
          );

          // Extract configurations - handle both cases
          if (configsData.success && configsData.data) {
            if (configsData.data.configurations) {
              currentConfigurations = configsData.data.configurations;
            } else if (Array.isArray(configsData.data)) {
              // In case data itself is the array
              currentConfigurations = configsData.data;
            } else {
              currentConfigurations = [];
            }
          } else {
            currentConfigurations = [];
          }

          // Extract books data
          if (booksData.success && booksData.data && Array.isArray(booksData.data.books)) {
            currentBooksData = booksData.data.books;
          } else {
            currentBooksData = [];
          }

          console.log('Current configurations:', currentConfigurations);
          console.log('Number of configurations:', currentConfigurations.length);
          console.log('Is array?', Array.isArray(currentConfigurations));
          console.log('Current books:', currentBooksData);
          console.log('Number of books:', currentBooksData.length);

          // Render existing configurations list
          renderConfigurationsList(userId, kdpProfile);

          // Populate campaign name dropdown
          // Group campaigns by name and get unique campaigns with their IDs
          // Only include campaigns that have at least one valid ad group
          const uniqueCampaigns = [];
          const seenCampaigns = new Set();
          
          currentCampaigns.forEach(c => {
            if (!seenCampaigns.has(c.campaignName)) {
              seenCampaigns.add(c.campaignName);
              uniqueCampaigns.push({
                id: c.campaignId,
                name: c.campaignName
              });
            }
          });
          
          // Sort by name
          uniqueCampaigns.sort((a, b) => a.name.localeCompare(b.name));
          
          const campaignNameSelect = document.getElementById('config-campaign-name');
          campaignNameSelect.innerHTML = '<option value="">Select a campaign...</option>';
          uniqueCampaigns.forEach(campaign => {
            const option = document.createElement('option');
            option.value = campaign.id;
            option.textContent = campaign.name;
            campaignNameSelect.appendChild(option);
          });

          // Show containers - renderConfigurationsList already handles listContainer visibility
          loadingContainer.style.display = 'none';
          formContainer.style.display = 'block';
        } else {
          throw new Error('No campaigns found');
        }
      } catch (error) {
        console.error('Error loading campaign data:', error);
        loadingContainer.style.display = 'none';
        emptyContainer.style.display = 'block';
        emptyContainer.innerHTML = '<div style="padding: var(--spacing-32); background: var(--color-neutral-05); border-radius: var(--radius-medium); text-align: center;"><p style="color: #FF6B6B; font-size: 1rem;">Failed to load data. Please try again.</p></div>';
      }
    }

    // Note: renderConfigurationsList is now a global function (defined outside DOMContentLoaded)

    // Trigger campaign loading when account or region changes
    campaignAccountSelect.addEventListener('change', loadCampaignData);
    campaignRegionSelect.addEventListener('change', loadCampaignData);

    // Handle keyword recommendations form submission (in Create Campaign tab)
    const keywordForm = document.getElementById('keyword-recommendations-form');
    if (keywordForm) {
      keywordForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        const bookTitle = document.getElementById('keyword-book-title').value.trim();
        const market = document.getElementById('keyword-market').value;
        const asinsInput = document.getElementById('keyword-asins').value.trim();

        // Parse ASINs (split by comma and trim)
        const asins = asinsInput.split(',').map(asin => asin.trim()).filter(asin => asin);

        if (!bookTitle || !market || asins.length === 0) {
          alert('Please fill in all fields');
          return;
        }

        // Get button reference
        const submitButton = document.getElementById('get-keywords-btn');
        const originalButtonText = submitButton.innerHTML;

        // Disable button and change text
        submitButton.disabled = true;
        submitButton.style.opacity = '0.6';
        submitButton.style.cursor = 'not-allowed';
        submitButton.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation: spin 1s linear infinite; margin-right: 8px;"><circle cx="12" cy="12" r="10"></circle></svg> Fetching...';

        // Store market value globally for later use (e.g., suggested bids)
        currentMarket = market;

        // Show loading state
        document.getElementById('keywords-loading').style.display = 'block';
        document.getElementById('keywords-results').style.display = 'none';

        // Prepare payload
        const payload = {
          book_title: bookTitle,
          asins: asins,
          market: market
        };

        console.log('=== KEYWORD RECOMMENDATIONS REQUEST ===');
        console.log('Book Title:', bookTitle);
        console.log('Market:', market);
        console.log('ASINs Input:', asinsInput);
        console.log('Parsed ASINs:', asins);
        console.log('Full Payload:', JSON.stringify(payload, null, 2));
        console.log('======================================');

        try {
          const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=get_keyword_recommendations', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json'
            },
            body: JSON.stringify(payload)
          });

          console.log('Response Status:', response.status);
          console.log('Response OK:', response.ok);

          const data = await response.json();
          console.log('Response Data:', data);

          if (data.success && data.data && data.data.keywords) {
            console.log('Keywords received:', data.data.keywords.length);
            displayKeywordResults(data.data.keywords, market);
          } else {
            console.error('API Error Response:', data);
            const errorMsg = data.data?.message || 'Unknown error';
            const errorDetails = data.data?.error_details || {};
            const sentPayload = data.data?.sent_payload || {};

            console.error('Error Message:', errorMsg);
            console.error('Error Details:', errorDetails);
            console.error('Sent Payload (from backend):', sentPayload);

            alert('Failed to fetch keyword recommendations:\n' + errorMsg + '\n\nCheck console for details.');
          }
        } catch (error) {
          console.error('Exception during fetch:', error);
          alert('Error fetching keyword recommendations. Please try again.\n\nError: ' + error.message);
        } finally {
          // Re-enable button
          submitButton.disabled = false;
          submitButton.style.opacity = '1';
          submitButton.style.cursor = 'pointer';
          submitButton.innerHTML = originalButtonText;

          document.getElementById('keywords-loading').style.display = 'none';
        }
      });
    }

    // Display keyword results
    let allKeywords = [];
    let currentFilter = 'all';
    let currentMarket = '';

    function displayKeywordResults(keywords) {
      allKeywords = keywords;
      currentFilter = 'all';

      // Reset filter buttons
      document.querySelectorAll('.match-type-filter').forEach(btn => {
        btn.classList.remove('active');
        btn.style.background = 'white';
        btn.style.color = 'var(--color-neutral-70)';
        btn.style.borderColor = 'var(--color-neutral-30)';
      });
      document.querySelector('.match-type-filter[data-match-type="all"]').classList.add('active');
      document.querySelector('.match-type-filter[data-match-type="all"]').style.background = '#00C2A8';
      document.querySelector('.match-type-filter[data-match-type="all"]').style.color = 'white';
      document.querySelector('.match-type-filter[data-match-type="all"]').style.borderColor = '#00C2A8';

      filterAndRenderKeywords();

      document.getElementById('keywords-results').style.display = 'block';
    }

    function filterAndRenderKeywords() {
      const filteredKeywords = currentFilter === 'all'
        ? allKeywords
        : allKeywords.filter(k => k.match_type === currentFilter);

      document.getElementById('keywords-count').textContent = filteredKeywords.length;

      const keywordsList = document.getElementById('keywords-list');
      keywordsList.innerHTML = filteredKeywords.map((keyword, index) => {
        const bidInfo = keyword.suggested_bid ? `
          <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 2px; margin-right: var(--spacing-8);">
            <div style="font-size: 0.75rem; color: var(--color-neutral-60);">Suggested: <strong style="color: #00C2A8;">$${keyword.suggested_bid.toFixed(2)}</strong></div>
            <div style="font-size: 0.65rem; color: var(--color-neutral-50);">Range: $${keyword.lowest_suggested_bid?.toFixed(2)} - $${keyword.highest_suggested_bid?.toFixed(2)}</div>
          </div>
        ` : '';

        return `
        <div class="keyword-item" data-keyword="${keyword.keyword}" data-match-type="${keyword.match_type}" style="display: flex; justify-content: space-between; align-items: center; padding: var(--spacing-12) var(--spacing-16); background: var(--color-neutral-05); border-radius: var(--radius-small); border: 1px solid var(--color-neutral-20);">
          <span style="font-size: 0.9375rem; color: var(--color-neutral-90); flex: 1;">${keyword.keyword}</span>
          <div style="display: flex; align-items: center; gap: var(--spacing-12);">
            ${bidInfo}
            <span style="padding: 4px 8px; background: ${getMatchTypeColor(keyword.match_type)}; color: white; border-radius: var(--radius-small); font-size: 0.75rem; font-weight: 600;">
              ${keyword.match_type}
            </span>
            <button
              class="delete-keyword-btn"
              onclick="deleteKeyword('${keyword.keyword}', '${keyword.match_type}')"
              style="padding: 6px; background: #FFE6E6; color: #FF6B6B; border: 1px solid #FFCCCC; border-radius: var(--radius-small); cursor: pointer; transition: all 0.2s; display: flex; align-items: center; justify-content: center;"
              onmouseover="this.style.background='#FFCCCC'"
              onmouseout="this.style.background='#FFE6E6'"
              title="Delete keyword"
            >
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                <line x1="10" y1="11" x2="10" y2="17"></line>
                <line x1="14" y1="11" x2="14" y2="17"></line>
              </svg>
            </button>
          </div>
        </div>
      `;
      }).join('');
    }

    function getMatchTypeColor(matchType) {
      switch(matchType) {
        case 'BROAD': return '#2196F3';
        case 'PHRASE': return '#FF9800';
        case 'EXACT': return '#4CAF50';
        default: return '#9E9E9E';
      }
    }

    // Handle filter button clicks
    document.querySelectorAll('.match-type-filter').forEach(button => {
      button.addEventListener('click', function() {
        currentFilter = this.getAttribute('data-match-type');

        // Update button styles
        document.querySelectorAll('.match-type-filter').forEach(btn => {
          btn.classList.remove('active');
          btn.style.background = 'white';
          btn.style.color = 'var(--color-neutral-70)';
          btn.style.borderColor = 'var(--color-neutral-30)';
        });

        this.classList.add('active');
        this.style.background = '#00C2A8';
        this.style.color = 'white';
        this.style.borderColor = '#00C2A8';

        filterAndRenderKeywords();
      });
    });

    // Global function to delete a keyword
    window.deleteKeyword = function(keyword, matchType) {
      if (!confirm(`Delete keyword "${keyword}" (${matchType})?`)) {
        return;
      }

      // Remove from allKeywords array
      allKeywords = allKeywords.filter(k => !(k.keyword === keyword && k.match_type === matchType));

      // Re-render
      filterAndRenderKeywords();

      // Show success message
      const successMsg = document.createElement('div');
      successMsg.style.cssText = 'position: fixed; top: 20px; right: 20px; background: #4CAF50; color: white; padding: 12px 20px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 10000; animation: slideInRight 0.3s ease;';
      successMsg.textContent = `✓ Keyword "${keyword}" deleted`;
      document.body.appendChild(successMsg);

      setTimeout(() => {
        successMsg.remove();
      }, 3000);
    };

    // Global function to get suggested bids for keywords
    window.getSuggestedBids = async function() {
      if (allKeywords.length === 0) {
        alert('No keywords available');
        return;
      }

      if (!currentMarket) {
        alert('Market information is missing');
        return;
      }

      // Prepare targeting expressions
      const targetingExpressions = allKeywords.map(keyword => {
        // Convert match type to API format
        let type;
        switch(keyword.match_type) {
          case 'EXACT':
            type = 'KEYWORD_EXACT_MATCH';
            break;
          case 'PHRASE':
            type = 'KEYWORD_PHRASE_MATCH';
            break;
          case 'BROAD':
            type = 'KEYWORD_BROAD_MATCH';
            break;
          default:
            type = 'KEYWORD_BROAD_MATCH';
        }

        return {
          type: type,
          value: keyword.keyword
        };
      });

      const payload = {
        region: currentMarket,
        targeting_expressions: targetingExpressions
      };

      console.log('=== GET SUGGESTED BIDS REQUEST ===');
      console.log('Region:', currentMarket);
      console.log('Keywords count:', allKeywords.length);
      console.log('Payload:', JSON.stringify(payload, null, 2));
      console.log('===================================');

      // Disable all action buttons
      const getKeywordsBtn = document.getElementById('get-keywords-btn');
      const getSuggestedBidBtn = document.getElementById('get-suggested-bid-btn');
      const exportCsvBtn = document.getElementById('export-csv-btn');
      const exportExcelBtn = document.getElementById('export-excel-btn');
      const deleteButtons = document.querySelectorAll('.delete-keyword-btn');

      const originalBidBtnText = getSuggestedBidBtn.innerHTML;

      // Disable buttons
      [getKeywordsBtn, getSuggestedBidBtn, exportCsvBtn, exportExcelBtn].forEach(btn => {
        if (btn) {
          btn.disabled = true;
          btn.style.opacity = '0.5';
          btn.style.cursor = 'not-allowed';
        }
      });

      deleteButtons.forEach(btn => {
        btn.disabled = true;
        btn.style.opacity = '0.5';
        btn.style.cursor = 'not-allowed';
      });

      // Update button to show loading
      getSuggestedBidBtn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation: spin 1s linear infinite; margin-right: 8px;"><circle cx="12" cy="12" r="10"></circle></svg> Fetching Bids...';

      try {
        const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=get_suggested_bids', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify(payload)
        });

        const data = await response.json();
        console.log('Response:', data);

        if (data.success && data.data && Array.isArray(data.data)) {
          const bidData = data.data;
          console.log('Bid data received:', bidData.length, 'items');

          // Update allKeywords with bid information
          bidData.forEach(bid => {
            // Find matching keyword in allKeywords
            const matchType = bid.match_type.replace('KEYWORD_', '').replace('_MATCH', '');
            const keywordObj = allKeywords.find(k =>
              k.keyword === bid.value && k.match_type === matchType
            );

            if (keywordObj) {
              keywordObj.suggested_bid = bid.suggested_bid;
              keywordObj.lowest_suggested_bid = bid.lowest_suggested_bid;
              keywordObj.highest_suggested_bid = bid.highest_suggested_bid;
            }
          });

          // Re-render keywords with bid info
          filterAndRenderKeywords();

          // Show success message
          const successMsg = document.createElement('div');
          successMsg.style.cssText = 'position: fixed; top: 20px; right: 20px; background: #00C2A8; color: white; padding: 12px 20px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 10000; animation: slideInRight 0.3s ease;';
          successMsg.textContent = `✓ Bid suggestions loaded for ${bidData.length} keywords`;
          document.body.appendChild(successMsg);

          setTimeout(() => {
            successMsg.remove();
          }, 3000);

        } else {
          console.error('API Error:', data);
          alert('Failed to fetch bid suggestions:\n' + (data.data?.message || 'Unknown error'));
        }

      } catch (error) {
        console.error('Exception:', error);
        alert('Error fetching bid suggestions. Please try again.\n\nError: ' + error.message);
      } finally {
        // Re-enable all buttons
        [getKeywordsBtn, getSuggestedBidBtn, exportCsvBtn, exportExcelBtn].forEach(btn => {
          if (btn) {
            btn.disabled = false;
            btn.style.opacity = '1';
            btn.style.cursor = 'pointer';
          }
        });

        document.querySelectorAll('.delete-keyword-btn').forEach(btn => {
          btn.disabled = false;
          btn.style.opacity = '1';
          btn.style.cursor = 'pointer';
        });

        getSuggestedBidBtn.innerHTML = originalBidBtnText;
      }
    };

    // Global function to export keywords as CSV
    window.exportKeywordsAsCSV = function() {
      if (allKeywords.length === 0) {
        alert('No keywords to export');
        return;
      }

      // Get currently filtered keywords
      const keywordsToExport = currentFilter === 'all'
        ? allKeywords
        : allKeywords.filter(k => k.match_type === currentFilter);

      // Create CSV content
      let csvContent = 'Keyword,Match Type\n';
      keywordsToExport.forEach(keyword => {
        // Escape commas and quotes in keyword text
        const escapedKeyword = keyword.keyword.replace(/"/g, '""');
        csvContent += `"${escapedKeyword}","${keyword.match_type}"\n`;
      });

      // Create blob and download
      const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
      const link = document.createElement('a');
      const url = URL.createObjectURL(blob);

      link.setAttribute('href', url);
      link.setAttribute('download', `keywords_${currentFilter}_${new Date().toISOString().split('T')[0]}.csv`);
      link.style.visibility = 'hidden';
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);

      // Show success message
      const successMsg = document.createElement('div');
      successMsg.style.cssText = 'position: fixed; top: 20px; right: 20px; background: #4CAF50; color: white; padding: 12px 20px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 10000; animation: slideInRight 0.3s ease;';
      successMsg.textContent = `✓ Exported ${keywordsToExport.length} keywords as CSV`;
      document.body.appendChild(successMsg);

      setTimeout(() => {
        successMsg.remove();
      }, 3000);
    };

    // Global function to export keywords as Excel
    window.exportKeywordsAsExcel = function() {
      if (allKeywords.length === 0) {
        alert('No keywords to export');
        return;
      }

      // Get currently filtered keywords
      const keywordsToExport = currentFilter === 'all'
        ? allKeywords
        : allKeywords.filter(k => k.match_type === currentFilter);

      // Create HTML table for Excel
      let tableHTML = '<table><thead><tr><th>Keyword</th><th>Match Type</th></tr></thead><tbody>';
      keywordsToExport.forEach(keyword => {
        tableHTML += `<tr><td>${keyword.keyword}</td><td>${keyword.match_type}</td></tr>`;
      });
      tableHTML += '</tbody></table>';

      // Create blob with Excel MIME type
      const blob = new Blob([tableHTML], { type: 'application/vnd.ms-excel' });
      const link = document.createElement('a');
      const url = URL.createObjectURL(blob);

      link.setAttribute('href', url);
      link.setAttribute('download', `keywords_${currentFilter}_${currentFilter}_${new Date().toISOString().split('T')[0]}.xls`);
      link.style.visibility = 'hidden';
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);

      // Show success message
      const successMsg = document.createElement('div');
      successMsg.style.cssText = 'position: fixed; top: 20px; right: 20px; background: #2196F3; color: white; padding: 12px 20px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 10000; animation: slideInRight 0.3s ease;';
      successMsg.textContent = `✓ Exported ${keywordsToExport.length} keywords as Excel`;
      document.body.appendChild(successMsg);

      setTimeout(() => {
        successMsg.remove();
      }, 3000);
    };

    // When campaign is selected, populate ad group dropdown
    const campaignNameSelect = document.getElementById('config-campaign-name');
    const adGroupSelect = document.getElementById('config-ad-group');

    // Function to check and update retrieve targets button state
    function updateRetrieveTargetsButtonState() {
      const campaignValue = campaignNameSelect?.value;
      const adGroupValue = adGroupSelect?.value;
      const retrieveBtn = document.getElementById('retrieve-targets-btn');
      
      if (campaignValue && adGroupValue && retrieveBtn) {
        // Enable button
        retrieveBtn.disabled = false;
        retrieveBtn.style.background = 'linear-gradient(135deg, #4CAF50, #45a049)';
        retrieveBtn.style.color = 'white';
        retrieveBtn.style.cursor = 'pointer';
        retrieveBtn.style.borderColor = '#4CAF50';
        retrieveBtn.onmouseover = function() {
          this.style.transform = 'translateY(-2px)';
          this.style.boxShadow = '0 4px 12px rgba(76, 175, 80, 0.4)';
        };
        retrieveBtn.onmouseout = function() {
          this.style.transform = 'translateY(0)';
          this.style.boxShadow = 'none';
        };
      } else if (retrieveBtn) {
        // Disable button
        retrieveBtn.disabled = true;
        retrieveBtn.style.background = 'var(--color-neutral-20)';
        retrieveBtn.style.color = 'var(--color-neutral-50)';
        retrieveBtn.style.cursor = 'not-allowed';
        retrieveBtn.style.borderColor = 'var(--color-neutral-30)';
        retrieveBtn.style.transform = 'translateY(0)';
        retrieveBtn.style.boxShadow = 'none';
        retrieveBtn.onmouseover = null;
        retrieveBtn.onmouseout = null;
      }
    }

    // Function to toggle ALWAYS_ON status for a target
    window.toggleAlwaysOn = function(targetId, targetText, matchType, targetType) {
      const uniqueId = `${targetType}-${targetId}`;
      const button = document.getElementById(uniqueId);
      
      if (!button) return;
      
      // Check if already in the array
      const existingIndex = specialHandlingRules.findIndex(rule => rule.target_id === targetId);
      
      if (existingIndex > -1) {
        // Remove from array
        specialHandlingRules.splice(existingIndex, 1);
        
        // Update button style to inactive
        button.classList.remove('active');
        button.style.background = 'var(--color-neutral-10)';
        button.style.color = 'var(--color-neutral-60)';
        button.style.borderColor = 'var(--color-neutral-30)';
      } else {
        // Add to array
        specialHandlingRules.push({
          target_id: targetId,
          target_text: targetText,
          match_type: matchType,
          action: 'ALWAYS_ON'
        });
        
        // Update button style to active
        button.classList.add('active');
        button.style.background = '#4CAF50';
        button.style.color = 'white';
        button.style.borderColor = '#4CAF50';
      }
      
      console.log('Special Handling Rules:', specialHandlingRules);
    };

    // Function to toggle special rules visibility in configuration list
    window.toggleSpecialRules = function(adGroupId) {
      const rulesDiv = document.getElementById(`special-rules-${adGroupId}`);
      const chevron = document.getElementById(`chevron-${adGroupId}`);
      
      if (!rulesDiv || !chevron) return;
      
      if (rulesDiv.style.display === 'none') {
        rulesDiv.style.display = 'block';
        chevron.style.transform = 'rotate(180deg)';
      } else {
        rulesDiv.style.display = 'none';
        chevron.style.transform = 'rotate(0deg)';
      }
    };

    campaignNameSelect.addEventListener('change', function() {
      const selectedCampaignId = this.value;
      adGroupSelect.innerHTML = '<option value="">Select an ad group...</option>';

      if (!selectedCampaignId) return;

      // Get all ad groups for this campaign
      const campaignAdGroups = currentCampaigns.filter(c => c.campaignId === selectedCampaignId);

      // Filter out ad groups that already have configurations
      const configuredAdGroupIds = currentConfigurations.map(c => c.ad_group_id);

      // Use a Set to track unique ad group IDs to avoid duplicates
      const addedAdGroupIds = new Set();

      campaignAdGroups.forEach(campaign => {
        const isConfigured = configuredAdGroupIds.includes(campaign.adGroupId);

        // Only show ad groups that don't have configurations yet and haven't been added already
        if (!isConfigured && !addedAdGroupIds.has(campaign.adGroupId)) {
          addedAdGroupIds.add(campaign.adGroupId);
          
          const option = document.createElement('option');
          option.value = campaign.adGroupId;

          // Build display text with ad group name or ID only
          let displayText = '';
          if (campaign.adGroupName) {
            displayText = campaign.adGroupName;
          } else {
            displayText = `Ad Group ${campaign.adGroupId}`;
          }

          option.textContent = displayText;
          adGroupSelect.appendChild(option);
        }
      });

      // Update retrieve targets button state when campaign changes
      updateRetrieveTargetsButtonState();
      
      // Reset targets list and special handling rules when campaign changes
      resetTargetsAndRules();
    });

    // Handle ad group selection change
    if (adGroupSelect) {
      adGroupSelect.addEventListener('change', function() {
        const selectedAdGroupId = this.value;
        const asinSelect = document.getElementById('config-asin');
        const bookPreview = document.getElementById('book-preview');
        
        // Reset ASIN dropdown and hide preview
        asinSelect.innerHTML = '<option value="">Select a book ASIN...</option>';
        if (bookPreview) {
          bookPreview.style.display = 'none';
        }
        
        if (selectedAdGroupId) {
          // Find the selected campaign/ad group to get its ASINs
          const selectedCampaignId = document.getElementById('config-campaign-name').value;
          const selectedCampaign = currentCampaigns.find(c => 
            c.campaignId === selectedCampaignId && c.adGroupId === selectedAdGroupId
          );
          
          if (selectedCampaign && selectedCampaign.asin && selectedCampaign.asin.length > 0) {
            // Populate ASIN dropdown with the ad group's ASINs
            selectedCampaign.asin.forEach(asin => {
              const option = document.createElement('option');
              option.value = asin;
              option.textContent = asin;
              asinSelect.appendChild(option);
            });
            
            // If only one ASIN, auto-select it and trigger preview
            if (selectedCampaign.asin.length === 1) {
              asinSelect.value = selectedCampaign.asin[0];
              // Trigger change event to show book preview
              asinSelect.dispatchEvent(new Event('change'));
            }
          }
        }
        
        // Update retrieve targets button state when ad group changes
        updateRetrieveTargetsButtonState();
        
        // Reset targets list and special handling rules when ad group changes
        resetTargetsAndRules();
      });
    }

    // Handle ASIN selection change to show book preview
    const asinSelect = document.getElementById('config-asin');
    if (asinSelect) {
      asinSelect.addEventListener('change', async function() {
        const selectedAsin = this.value;
        const bookPreview = document.getElementById('book-preview');
        
        if (!selectedAsin) {
          // Hide preview if no ASIN selected
          if (bookPreview) {
            bookPreview.style.display = 'none';
          }
          return;
        }
        
        // Find the book in currentBooksData
        const book = currentBooksData.find(b => b.asin === selectedAsin);
        
        if (book && bookPreview) {
          // Update preview with book data
          const bookImage = document.getElementById('book-preview-image');
          const bookTitle = document.getElementById('book-preview-title');
          const bookAsin = document.getElementById('book-preview-asin');
          const bookPrice = document.getElementById('book-preview-price');
          const bookRoyalties = document.getElementById('book-preview-royalties');
          const missingDataWarning = document.getElementById('book-preview-missing-data');
          
          if (bookImage && book.image_url) {
            // Upgrade image quality from _SS60_ to _SS200_
            const highQualityImage = book.image_url.replace('_SS60_', '_SS200_');
            bookImage.src = highQualityImage;
            bookImage.alt = book.title || 'Book cover';
          }
          
          if (bookTitle) {
            bookTitle.textContent = book.title || 'Unknown Title';
          }
          
          if (bookAsin) {
            bookAsin.textContent = `ASIN: ${selectedAsin}`;
          }
          
          // Fetch book details from backend to get saved price and royalties
          try {
            const account = document.getElementById('campaign-account').value;
            const region = document.getElementById('campaign-region').value;
            const kdpProfile = account + '-' + region;
            
            const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=get_books', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify({
                user_id: String(currentUserId),
                kdp_profile: kdpProfile
              })
            });
            
            const data = await response.json();
            let savedBook = null;
            
            if (data.success && data.data && data.data.books) {
              savedBook = data.data.books.find(b => b.asin === selectedAsin);
            }
            
            // Display price from book list data
            if (bookPrice) {
              if (book.price && book.price.amount) {
                bookPrice.textContent = `$${book.price.amount.toFixed(2)}`;
              } else {
                bookPrice.textContent = '-';
              }
            }
            
            // Display royalties from saved data
            let hasMissingData = false;
            if (bookRoyalties) {
              if (savedBook && savedBook.royalties && savedBook.royalties.amount) {
                bookRoyalties.textContent = `$${savedBook.royalties.amount.toFixed(2)}`;
              } else {
                bookRoyalties.textContent = '-';
                hasMissingData = true;
              }
            }
            
            // Check if price is also missing
            if (!book.price || !book.price.amount) {
              hasMissingData = true;
            }
            
            // Show/hide missing data warning
            if (missingDataWarning) {
              missingDataWarning.style.display = hasMissingData ? 'block' : 'none';
            }
            
          } catch (error) {
            console.error('Error fetching book details:', error);
            if (bookPrice) bookPrice.textContent = '-';
            if (bookRoyalties) bookRoyalties.textContent = '-';
            if (missingDataWarning) missingDataWarning.style.display = 'block';
          }
          
          // Show the preview
          bookPreview.style.display = 'block';
        } else if (bookPreview) {
          // No book data found, hide preview
          bookPreview.style.display = 'none';
        }
      });
    }

    // Handle retrieve targets button click
    const retrieveTargetsBtn = document.getElementById('retrieve-targets-btn');
    if (retrieveTargetsBtn) {
      retrieveTargetsBtn.addEventListener('click', async function() {
        const campaignId = campaignNameSelect.value; // This is now the campaign ID
        const adGroupValue = adGroupSelect.value;
        const userId = currentUserId;
        const account = document.getElementById('campaign-account').value;
        const region = document.getElementById('campaign-region').value;

        if (!campaignId || !adGroupValue) {
          return;
        }

        // Show loading state
        const btnText = document.getElementById('retrieve-targets-btn-text');
        const originalText = btnText.textContent;
        btnText.textContent = 'Retrieving targets...';
        this.disabled = true;
        this.style.cursor = 'not-allowed';
        this.style.opacity = '0.7';

        try {
          // Build the KDP profile from account and region
          const kdpProfile = `${account}-${region}`;
          
          // Prepare the payload
          const payload = {
            user_id: userId,
            kdp_profile: kdpProfile,
            campaign_id: campaignId,
            adgroups: [adGroupValue]
          };

          console.log('Sending campaign targets request:', payload);
          
          // Make AJAX call to get campaign targets
          const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=get_campaign_targets', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
          });

          const result = await response.json();
          console.log('Campaign targets API response:', result);

          if (result.success && result.data && result.data.targets) {
            const targets = result.data.targets;
            const targetsContainer = document.getElementById('retrieved-targets-container');
            const targetsList = document.getElementById('targets-list');
            const targetsCount = document.getElementById('targets-count');

            // Update count
            targetsCount.textContent = targets.length;

            // Build targets list HTML
            let targetsHTML = '';
            
            // Separate products and keywords
            const products = targets.filter(t => t.target_type === 'product');
            const keywords = targets.filter(t => t.target_type === 'keyword');

            // Display products section if any
            if (products.length > 0) {
              targetsHTML += `
                <div style="margin-bottom: var(--spacing-12);">
                  <div style="font-size: 0.75rem; font-weight: 600; color: var(--color-neutral-60); margin-bottom: var(--spacing-6); text-transform: uppercase; letter-spacing: 0.5px;">
                    Products (${products.length})
                  </div>
                  <div style="display: grid; gap: var(--spacing-4);">
              `;
              
              products.forEach(target => {
                const matchType = target.match_type_display || target.match_type || '';
                const targetId = target.target_id || '';
                const uniqueId = `product-${targetId}`;
                targetsHTML += `
                  <div style="display: flex; align-items: center; justify-content: space-between; padding: var(--spacing-6) var(--spacing-8); background: white; border: 1px solid var(--color-neutral-20); border-radius: var(--radius-small);">
                    <div style="display: flex; align-items: center; gap: var(--spacing-10); flex: 1;">
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary-50)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="7" width="20" height="15" rx="2" ry="2"></rect>
                        <polyline points="17 2 12 7 7 2"></polyline>
                      </svg>
                      <span style="font-size: 0.75rem; color: var(--color-neutral-80);">${target.target_text || ''}</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: var(--spacing-8);">
                      <span style="font-size: 0.625rem; font-weight: 600; color: var(--color-primary-60); background: var(--color-primary-05); padding: 2px 8px; border-radius: 4px; text-transform: uppercase;">
                        ${matchType}
                      </span>
                      <button
                        type="button"
                        id="${uniqueId}"
                        onclick="toggleAlwaysOn('${targetId}', '${target.target_text?.replace(/'/g, "\\'") || ''}', '${target.match_type || ''}', 'product')"
                        style="padding: 4px 10px; background: var(--color-neutral-10); color: var(--color-neutral-60); border: 1px solid var(--color-neutral-30); border-radius: 4px; font-size: 0.625rem; font-weight: 600; cursor: pointer; transition: all 0.2s; white-space: nowrap;"
                        onmouseover="if(!this.classList.contains('active')) { this.style.background='var(--color-neutral-20)'; }"
                        onmouseout="if(!this.classList.contains('active')) { this.style.background='var(--color-neutral-10)'; }"
                      >
                        ALWAYS ON
                      </button>
                    </div>
                  </div>
                `;
              });
              
              targetsHTML += `
                  </div>
                </div>
              `;
            }

            // Display keywords section if any
            if (keywords.length > 0) {
              targetsHTML += `
                <div>
                  <div style="font-size: 0.75rem; font-weight: 600; color: var(--color-neutral-60); margin-bottom: var(--spacing-6); text-transform: uppercase; letter-spacing: 0.5px;">
                    Keywords (${keywords.length})
                  </div>
                  <div style="display: grid; gap: var(--spacing-4);">
              `;
              
              keywords.forEach(target => {
                const matchType = target.match_type_display || target.match_type || '';
                const targetId = target.target_id || '';
                const uniqueId = `keyword-${targetId}`;
                targetsHTML += `
                  <div style="display: flex; align-items: center; justify-content: space-between; padding: var(--spacing-6) var(--spacing-8); background: white; border: 1px solid var(--color-neutral-20); border-radius: var(--radius-small);">
                    <div style="display: flex; align-items: center; gap: var(--spacing-10); flex: 1;">
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--color-neutral-50)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                      </svg>
                      <span style="font-size: 0.75rem; color: var(--color-neutral-80);">${target.target_text || ''}</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: var(--spacing-8);">
                      <span style="font-size: 0.625rem; font-weight: 600; color: var(--color-neutral-60); background: var(--color-neutral-10); padding: 2px 8px; border-radius: 4px; text-transform: uppercase;">
                        ${matchType}
                      </span>
                      <button
                        type="button"
                        id="${uniqueId}"
                        onclick="toggleAlwaysOn('${targetId}', '${target.target_text?.replace(/'/g, "\\'") || ''}', '${target.match_type || ''}', 'keyword')"
                        style="padding: 4px 10px; background: var(--color-neutral-10); color: var(--color-neutral-60); border: 1px solid var(--color-neutral-30); border-radius: 4px; font-size: 0.625rem; font-weight: 600; cursor: pointer; transition: all 0.2s; white-space: nowrap;"
                        onmouseover="if(!this.classList.contains('active')) { this.style.background='var(--color-neutral-20)'; }"
                        onmouseout="if(!this.classList.contains('active')) { this.style.background='var(--color-neutral-10)'; }"
                      >
                        ALWAYS ON
                      </button>
                    </div>
                  </div>
                `;
              });
              
              targetsHTML += `
                  </div>
                </div>
              `;
            }

            // If no targets found
            if (targets.length === 0) {
              targetsHTML = `
                <div style="text-align: center; padding: var(--spacing-16); color: var(--color-neutral-50);">
                  <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto var(--spacing-8);">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                  </svg>
                  <div style="font-size: 0.875rem;">No targets found for this campaign</div>
                </div>
              `;
            }

            targetsList.innerHTML = targetsHTML;
            targetsContainer.style.display = 'block';

            // Success notification
            const successDiv = document.createElement('div');
            successDiv.style.cssText = 'position: fixed; top: 20px; right: 20px; background: #4CAF50; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 1000;';
            successDiv.textContent = `\u2713 Retrieved ${targets.length} target${targets.length !== 1 ? 's' : ''}`;
            document.body.appendChild(successDiv);

            setTimeout(() => {
              successDiv.remove();
            }, 3000);
            
            // Dispatch event to signal that targets have been retrieved
            window.dispatchEvent(new CustomEvent('targetsRetrieved', { detail: { targets } }));
          } else {
            throw new Error(result.data?.message || 'Failed to retrieve targets');
          }

        } catch (error) {
          console.error('Error retrieving targets:', error);
          
          const errorDiv = document.createElement('div');
          errorDiv.style.cssText = 'position: fixed; top: 20px; right: 20px; background: #FF6B6B; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 1000;';
          errorDiv.textContent = '\u2717 Failed to retrieve targets';
          document.body.appendChild(errorDiv);

          setTimeout(() => {
            errorDiv.remove();
          }, 3000);
        } finally {
          // Restore button state
          btnText.textContent = originalText;
          updateRetrieveTargetsButtonState();
        }
      });
    }

    // Handle form submission (create or update)
    const campaignConfigForm = document.getElementById('campaign-config-form');
    if (campaignConfigForm) {
      campaignConfigForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        const submitButton = document.getElementById('submit-campaign-config');
        const submitButtonText = document.getElementById('config-submit-button-text');

        const userId = currentUserId; // Use current WordPress user ID
        const account = campaignAccountSelect.value;
        const region = campaignRegionSelect.value;
        const selectedCampaignId = document.getElementById('config-campaign-name').value; // This is campaign ID
        const selectedAdGroupId = document.getElementById('config-ad-group').value;
        const bidUpdateStrategy = document.getElementById('config-bid-strategy').value;

        // Validate required fields
        if (!selectedCampaignId) {
          alert('Please select a campaign');
          return;
        }

        if (!selectedAdGroupId) {
          alert('Please select an ad group');
          return;
        }

        if (!bidUpdateStrategy) {
          alert('Please select a bid update strategy');
          return;
        }

        // Build kdp_profile
        const kdpProfile = account + '-' + region;

        // Find the selected campaign data
        const selectedCampaign = currentCampaigns.find(c =>
          c.campaignId === selectedCampaignId && c.adGroupId === selectedAdGroupId
        );

        if (!selectedCampaign) {
          alert('Selected campaign/ad group not found');
          return;
        }

        // Get selected ASIN
        const selectedAsin = document.getElementById('config-asin').value;
        
        if (!selectedAsin) {
          alert('Please select a book ASIN');
          return;
        }

        // Build configuration array - single entry for selected ad group
        const configObj = {
          asin: selectedAsin,
          campaign_name: selectedCampaign.campaignName,
          campaign_id: String(selectedCampaign.campaignId), // Ensure string
          ad_group_id: String(selectedCampaign.adGroupId), // Ensure string
          ad_group_name: selectedCampaign.adGroupName || null,
          bid_update_strategy: bidUpdateStrategy
        };

        // Add special handling rules if any targets are marked as ALWAYS_ON
        if (specialHandlingRules.length > 0) {
          configObj.special_handling_rules = specialHandlingRules;
          console.log('Including special handling rules:', specialHandlingRules);
        }

        const configuration = [configObj];

        // Build final payload
        const payload = {
          user_id: String(userId), // Ensure string
          kdp_profile: kdpProfile,
          configuration: configuration
        };

        console.log('Submitting campaign configuration payload:', JSON.stringify(payload, null, 2));

        // Show loading state
        submitButton.disabled = true;
        submitButtonText.textContent = 'Creating...';
        submitButton.style.opacity = '0.7';

        try {
          const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=create_campaign_config', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json'
            },
            body: JSON.stringify(payload)
          });

          const data = await response.json();
          
          console.log('Campaign configuration response:', data);

          if (data.success) {
            // Show success message
            const successDiv = document.createElement('div');
            successDiv.style.cssText = 'position: fixed; top: 20px; right: 20px; background: #00C2A8; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 1000;';
            successDiv.textContent = '✓ Configuration created successfully!';
            document.body.appendChild(successDiv);

            setTimeout(() => {
              successDiv.remove();
            }, 3000);

            // Reset form
            campaignConfigForm.reset();
            resetTargetsAndRules();

            // Reload only configurations (campaigns data is unchanged)
            await reloadConfigurationsOnly(userId, kdpProfile);
          } else {
            // Show error
            const errorDiv = document.createElement('div');
            errorDiv.style.cssText = 'position: fixed; top: 20px; right: 20px; background: #FF6B6B; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 1000;';
            errorDiv.textContent = '✗ ' + (data.data?.message || 'Failed to create configuration');
            document.body.appendChild(errorDiv);

            setTimeout(() => {
              errorDiv.remove();
            }, 5000);
          }
        } catch (error) {
          console.error('Error saving configuration:', error);

          // Show error
          const errorDiv = document.createElement('div');
          errorDiv.style.cssText = 'position: fixed; top: 20px; right: 20px; background: #FF6B6B; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 1000;';
          errorDiv.textContent = '✗ Failed to create configuration';
          document.body.appendChild(errorDiv);

          setTimeout(() => {
            errorDiv.remove();
          }, 5000);
        } finally {
          submitButton.disabled = false;
          submitButtonText.textContent = 'Create Configuration';
          submitButton.style.opacity = '1';
        }
      });
    }
  }
});

// Global functions for campaign configuration management

// Render configurations list
function renderConfigurationsList(userId, kdpProfile) {
  console.log('renderConfigurationsList called with:', userId, kdpProfile);
  const listEl = document.getElementById('campaign-configs-list');
  const listContainer = document.getElementById('campaign-configs-list-container');
  const emptyEl = document.getElementById('campaign-configs-empty');

  console.log('List elements found:', !!listEl, !!listContainer);
  console.log('Configurations to render:', currentConfigurations.length);

  // Always show the container
  listContainer.style.display = 'block';

  if (currentConfigurations.length === 0) {
    console.log('No configurations, showing empty message');
    listEl.innerHTML = '';
    listEl.style.display = 'none';
    if (emptyEl) emptyEl.style.display = 'block';
    return;
  }

  console.log('Rendering', currentConfigurations.length, 'configurations');
  console.log('Configuration objects:', JSON.stringify(currentConfigurations, null, 2));
  if (emptyEl) emptyEl.style.display = 'none';
  listEl.style.display = 'grid';

  try {
    listEl.innerHTML = currentConfigurations.map(config => {
      // Find the matching campaign to get ad group name
      const matchingCampaign = currentCampaigns.find(c => c.adGroupId === config.ad_group_id);
      const adGroupDisplayName = matchingCampaign && matchingCampaign.adGroupName
        ? matchingCampaign.adGroupName
        : `Ad Group ${config.ad_group_id}`;

      return `
    <div id="config-card-${config.ad_group_id}" style="padding: var(--spacing-20); background: var(--color-neutral-00); border: 2px solid var(--color-neutral-20); border-radius: var(--radius-medium); box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
      <!-- VIEW MODE -->
      <div id="config-view-${config.ad_group_id}">
        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: var(--spacing-12);">
          <div>
            <h3 style="margin: 0 0 var(--spacing-4) 0; font-size: 1.125rem; font-weight: 700; color: var(--color-neutral-90);">
              ${config.campaign_name}
            </h3>
            <p style="margin: 0; font-size: 0.875rem; color: var(--color-neutral-60);">
              ${adGroupDisplayName}
            </p>
          </div>
          <div style="display: flex; gap: var(--spacing-8);">
            <button
              onclick="editConfigInline('${config.ad_group_id}')"
              style="padding: 8px 12px; background: #E3F2FD; color: #1976D2; border: 1px solid #BBDEFB; border-radius: var(--radius-small); cursor: pointer; font-weight: 600; transition: all 0.2s; font-size: 0.875rem;"
              onmouseover="this.style.background='#BBDEFB'"
              onmouseout="this.style.background='#E3F2FD'"
            >
              Edit
            </button>
            <button
              onclick="deleteCampaignConfig('${userId}', '${kdpProfile}', '${config.ad_group_id}')"
              style="padding: 8px 12px; background: #FFEBEE; color: #D32F2F; border: 1px solid #FFCDD2; border-radius: var(--radius-small); cursor: pointer; font-weight: 600; transition: all 0.2s; font-size: 0.875rem;"
              onmouseover="this.style.background='#FFCDD2'"
              onmouseout="this.style.background='#FFEBEE'"
            >
              Delete
            </button>
          </div>
        </div>
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: var(--spacing-12); padding: var(--spacing-12); background: var(--color-neutral-05); border-radius: var(--radius-small);">
          <div>
            <p style="margin: 0; font-size: 0.75rem; color: var(--color-neutral-60); text-transform: uppercase; letter-spacing: 0.5px;">Strategy</p>
            <p style="margin: var(--spacing-4) 0 0 0; font-size: 0.9375rem; font-weight: 600; color: var(--color-neutral-90);">${config.bid_update_strategy}</p>
          </div>
          <div>
            <p style="margin: 0; font-size: 0.75rem; color: var(--color-neutral-60); text-transform: uppercase; letter-spacing: 0.5px;">ASINs</p>
            <p style="margin: var(--spacing-4) 0 0 0; font-size: 0.9375rem; font-weight: 600; color: var(--color-neutral-90);">${config.asin ? (Array.isArray(config.asin) ? config.asin.join(', ') : config.asin) : 'N/A'}</p>
          </div>
        </div>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spacing-12); padding: var(--spacing-12); margin-top: var(--spacing-8); background: var(--color-neutral-00); border: 1px solid var(--color-neutral-20); border-radius: var(--radius-small);">
          <div>
            <p style="margin: 0; font-size: 0.75rem; color: var(--color-neutral-60); text-transform: uppercase; letter-spacing: 0.5px;">Royalties</p>
            <p style="margin: var(--spacing-4) 0 0 0; font-size: 0.9375rem; font-weight: 600; color: var(--color-neutral-90);">$${config.royalties}</p>
          </div>
          <div>
            <p style="margin: 0; font-size: 0.75rem; color: var(--color-neutral-60); text-transform: uppercase; letter-spacing: 0.5px;">Book Price</p>
            <p style="margin: var(--spacing-4) 0 0 0; font-size: 0.9375rem; font-weight: 600; color: var(--color-neutral-90);">$${config.book_price}</p>
          </div>
        </div>
        ${config.special_handling_rules && config.special_handling_rules.length > 0 ? `
        <div style="margin-top: var(--spacing-12);">
          <button
            type="button"
            onclick="toggleSpecialRules('${config.ad_group_id}')"
            style="width: 100%; padding: var(--spacing-10); background: #FFF3E0; color: #E65100; border: 1px solid #FFE0B2; border-radius: var(--radius-small); cursor: pointer; font-weight: 600; transition: all 0.2s; font-size: 0.875rem; display: flex; align-items: center; justify-content: space-between;"
            onmouseover="this.style.background='#FFE0B2'"
            onmouseout="this.style.background='#FFF3E0'"
          >
            <span style="display: flex; align-items: center; gap: var(--spacing-6);">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
              </svg>
              Special Rules: ${config.special_handling_rules.length} ALWAYS ON target${config.special_handling_rules.length !== 1 ? 's' : ''}
            </span>
            <svg id="chevron-${config.ad_group_id}" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="transition: transform 0.2s;">
              <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
          </button>
          <div id="special-rules-${config.ad_group_id}" style="display: none; margin-top: var(--spacing-8); padding: var(--spacing-12); background: var(--color-neutral-00); border: 1px solid #FFE0B2; border-radius: var(--radius-small);">
            <p style="margin: 0 0 var(--spacing-8) 0; font-size: 0.75rem; font-weight: 600; color: var(--color-neutral-70); text-transform: uppercase; letter-spacing: 0.5px;">Always-On Targets</p>
            <div style="display: grid; gap: var(--spacing-6);">
              ${config.special_handling_rules.map(rule => `
                <div style="padding: var(--spacing-6) var(--spacing-8); background: #FFFAF0; border: 1px solid #FFE0B2; border-radius: var(--radius-small); display: flex; align-items: center; justify-content: space-between;">
                  <span style="font-size: 0.75rem; color: var(--color-neutral-80); flex: 1;">${rule.target_text}</span>
                  <span style="font-size: 0.625rem; font-weight: 600; color: #E65100; background: #FFF3E0; padding: 2px 8px; border-radius: 4px; margin-left: var(--spacing-8);">${rule.match_type}</span>
                </div>
              `).join('')}
            </div>
          </div>
        </div>
        ` : ''}
      </div>
      
      <!-- EDIT MODE (hidden by default) -->
      <div id="config-edit-${config.ad_group_id}" style="display: none;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spacing-16);">
          <h3 style="margin: 0; font-size: 1.125rem; font-weight: 700; color: var(--color-neutral-90);">
            Editing: ${config.campaign_name} - ${adGroupDisplayName}
          </h3>
          <button
            onclick="cancelConfigInlineEdit('${config.ad_group_id}')"
            style="padding: 6px 12px; background: var(--color-neutral-20); color: var(--color-neutral-70); border: 1px solid var(--color-neutral-30); border-radius: var(--radius-small); cursor: pointer; font-size: 0.875rem;"
          >
            Cancel
          </button>
        </div>
        
        <!-- Edit Form Fields -->
        <div style="display: grid; gap: var(--spacing-16);">
          <!-- ASIN Display (Read-only) -->
          <div style="padding: var(--spacing-16); background: var(--color-neutral-05); border-radius: var(--radius-small); border: 1px solid var(--color-neutral-20);">
            <div style="margin-bottom: var(--spacing-8);">
              <label style="display: block; color: var(--color-neutral-60); font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">
                Book ASIN
              </label>
            </div>
            <div style="font-family: monospace; font-size: 1rem; font-weight: 600; color: var(--color-neutral-90);">
              ${config.asin ? (Array.isArray(config.asin) ? config.asin[0] : config.asin) : 'N/A'}
            </div>
            <p style="margin: var(--spacing-8) 0 0 0; font-size: 0.75rem; color: var(--color-neutral-60);">
              ASIN cannot be changed. Create a new configuration to use a different ASIN.
            </p>
          </div>
          
          <div>
            <label style="display: block; margin-bottom: var(--spacing-6); font-weight: 600; font-size: 0.875rem; color: var(--color-neutral-80);">Bid Update Strategy</label>
            <select
              id="edit-bid-strategy-${config.ad_group_id}"
              style="width: 100%; padding: var(--spacing-10); border: 2px solid var(--color-neutral-30); border-radius: var(--radius-small); font-size: 0.9375rem;"
            >
              <option value="conservative" selected>Conservative</option>
            </select>
          </div>
          
          <!-- Targets Section -->
          <div style="margin-top: var(--spacing-12); padding: var(--spacing-16); background: var(--color-neutral-05); border: 1px solid var(--color-neutral-20); border-radius: var(--radius-medium);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spacing-12);">
              <h4 style="margin: 0; font-size: 1rem; font-weight: 600; color: var(--color-neutral-80);">Campaign Targets</h4>
              <button
                type="button"
                id="edit-retrieve-btn-${config.ad_group_id}"
                onclick="retrieveTargetsForEdit('${config.ad_group_id}')"
                disabled
                style="padding: 8px 16px; background: var(--color-neutral-20); color: var(--color-neutral-50); border: 1px solid var(--color-neutral-30); border-radius: var(--radius-small); cursor: not-allowed; font-weight: 600; font-size: 0.875rem;"
              >
                <span id="edit-retrieve-text-${config.ad_group_id}">Retrieve Targets</span>
              </button>
            </div>
            <div id="edit-targets-container-${config.ad_group_id}" style="display: none; margin-top: var(--spacing-12);">
              <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: var(--spacing-12); padding: var(--spacing-10); background: var(--color-primary-05); border-left: 3px solid var(--color-primary-50); border-radius: var(--radius-small);">
                <span style="font-size: 0.875rem; font-weight: 600; color: var(--color-primary-70);">
                  <span id="edit-targets-count-${config.ad_group_id}">0</span> targets retrieved
                </span>
              </div>
              <div id="edit-targets-list-${config.ad_group_id}" style="max-height: 400px; overflow-y: auto;"></div>
            </div>
          </div>
          
          <!-- Update Button -->
          <div style="display: flex; justify-content: flex-end; gap: var(--spacing-12); margin-top: var(--spacing-12);">
            <button
              type="button"
              onclick="cancelConfigInlineEdit('${config.ad_group_id}')"
              style="padding: 12px 24px; background: var(--color-neutral-20); color: var(--color-neutral-70); border: 1px solid var(--color-neutral-30); border-radius: var(--radius-small); cursor: pointer; font-weight: 600;"
            >
              Cancel
            </button>
            <button
              type="button"
              onclick="updateConfigInline('${config.ad_group_id}')"
              style="padding: 12px 24px; background: linear-gradient(135deg, #1976D2, #1565C0); color: white; border: none; border-radius: var(--radius-small); cursor: pointer; font-weight: 600; transition: all 0.2s;"
              onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(25, 118, 210, 0.4)';"
              onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
            >
              Update Configuration
            </button>
          </div>
        </div>
      </div>
    </div>
  `;
    }).join('');

    console.log('Rendered HTML length:', listEl.innerHTML.length);
    console.log('List element display:', listEl.style.display);
    console.log('Container display:', listContainer.style.display);

  } catch (error) {
    console.error('Error rendering configurations:', error);
    listEl.innerHTML = '<div style="padding: 20px; color: red;">Error rendering configurations: ' + error.message + '</div>';
  }
}

function cancelConfigEdit() {
  document.getElementById('campaign-config-form').reset();
  
  // Reset targets and special handling rules
  resetTargetsAndRules();
}

// Helper function to reset targets (needs to be global)
function resetTargetsAndRules() {
  // Clear special handling rules array
  specialHandlingRules = [];
  
  // Hide targets container
  const targetsContainer = document.getElementById('retrieved-targets-container');
  if (targetsContainer) {
    targetsContainer.style.display = 'none';
  }
  
  // Clear targets list
  const targetsList = document.getElementById('targets-list');
  if (targetsList) {
    targetsList.innerHTML = '';
  }
  
  // Reset count
  const targetsCount = document.getElementById('targets-count');
  if (targetsCount) {
    targetsCount.textContent = '0 items';
  }
}

// Inline edit functions for configuration cards
let editingInlineConfigs = {}; // Store special handling rules per config being edited

async function editConfigInline(adGroupId) {
  console.log('Editing config inline:', adGroupId);
  
  const config = currentConfigurations.find(c => c.ad_group_id === adGroupId);
  if (!config) {
    console.error('Configuration not found');
    return;
  }
  
  // Hide view mode, show edit mode
  const viewMode = document.getElementById(`config-view-${adGroupId}`);
  const editMode = document.getElementById(`config-edit-${adGroupId}`);
  
  if (viewMode) viewMode.style.display = 'none';
  if (editMode) editMode.style.display = 'block';
  
  // Initialize special handling rules for this config
  editingInlineConfigs[adGroupId] = {
    specialHandlingRules: config.special_handling_rules ? [...config.special_handling_rules] : [],
    campaignId: config.campaign_id,
    account: currentUserId // will be set from context
  };
  
  // Enable retrieve button
  const retrieveBtn = document.getElementById(`edit-retrieve-btn-${adGroupId}`);
  if (retrieveBtn) {
    retrieveBtn.disabled = false;
    retrieveBtn.style.background = 'linear-gradient(135deg, #4CAF50, #45a049)';
    retrieveBtn.style.color = 'white';
    retrieveBtn.style.cursor = 'pointer';
  }
  
  // Auto-retrieve targets if there are special handling rules
  if (config.special_handling_rules && config.special_handling_rules.length > 0) {
    await retrieveTargetsForEdit(adGroupId);
  }
}

function cancelConfigInlineEdit(adGroupId) {
  console.log('Canceling inline edit:', adGroupId);
  
  // Show view mode, hide edit mode
  const viewMode = document.getElementById(`config-view-${adGroupId}`);
  const editMode = document.getElementById(`config-edit-${adGroupId}`);
  
  if (viewMode) viewMode.style.display = 'block';
  if (editMode) editMode.style.display = 'none';
  
  // Clear stored data
  delete editingInlineConfigs[adGroupId];
  
  // Hide targets
  const targetsContainer = document.getElementById(`edit-targets-container-${adGroupId}`);
  if (targetsContainer) {
    targetsContainer.style.display = 'none';
  }
}

// Populate ASIN dropdown for edit mode
async function populateEditAsinDropdown(adGroupId, config) {
  const asinSelect = document.getElementById(`edit-asin-${adGroupId}`);
  if (!asinSelect) return;
  
  // Find the matching campaign
  const matchingCampaign = currentCampaigns.find(c => c.adGroupId === adGroupId);
  if (!matchingCampaign || !matchingCampaign.sponsoredAsins || matchingCampaign.sponsoredAsins.length === 0) {
    asinSelect.innerHTML = '<option value="">No ASINs found for this ad group</option>';
    return;
  }
  
  // Get current user's books to show titles
  const account = document.getElementById('campaign-account').value;
  const region = document.getElementById('campaign-region').value;
  const kdpProfile = `${account}-${region}`;
  
  let userBooks = [];
  try {
    const booksResponse = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=get_books', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        user_id: String(currentUserId),
        kdp_profile: kdpProfile
      })
    });
    const booksResult = await booksResponse.json();
    if (booksResult.success && booksResult.data) {
      userBooks = booksResult.data;
    }
  } catch (error) {
    console.error('Error fetching books:', error);
  }
  
  // Build options
  let options = '<option value="">Select an ASIN...</option>';
  matchingCampaign.sponsoredAsins.forEach(asin => {
    const book = userBooks.find(b => b.asin === asin);
    const displayText = book ? `${asin} - ${book.clean_title || book.title}` : asin;
    const currentAsin = Array.isArray(config.asin) ? config.asin[0] : config.asin;
    const selected = asin === currentAsin ? 'selected' : '';
    options += `<option value="${asin}" ${selected}>${displayText}</option>`;
  });
  
  asinSelect.innerHTML = options;
  
  // Add change event listener
  asinSelect.addEventListener('change', async function() {
    await handleEditAsinSelection(adGroupId, this.value);
  });
  
  // If there's a current ASIN selected, show preview
  const currentAsin = Array.isArray(config.asin) ? config.asin[0] : config.asin;
  if (currentAsin) {
    await handleEditAsinSelection(adGroupId, currentAsin);
  }
}

// Handle ASIN selection in edit mode
async function handleEditAsinSelection(adGroupId, selectedAsin) {
  const bookPreview = document.getElementById(`edit-book-preview-${adGroupId}`);
  const bookImage = document.getElementById(`edit-book-preview-image-${adGroupId}`);
  const bookTitle = document.getElementById(`edit-book-preview-title-${adGroupId}`);
  const bookAsinDisplay = document.getElementById(`edit-book-preview-asin-${adGroupId}`);
  const bookPrice = document.getElementById(`edit-book-preview-price-${adGroupId}`);
  const bookRoyalties = document.getElementById(`edit-book-preview-royalties-${adGroupId}`);
  const missingDataWarning = document.getElementById(`edit-book-preview-missing-data-${adGroupId}`);
  
  if (!selectedAsin) {
    if (bookPreview) bookPreview.style.display = 'none';
    return;
  }
  
  // Show preview container
  if (bookPreview) bookPreview.style.display = 'block';
  
  // Get account/region
  const account = document.getElementById('campaign-account').value;
  const region = document.getElementById('campaign-region').value;
  const kdpProfile = `${account}-${region}`;
  
  try {
    // Fetch book details
    const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=get_book', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        user_id: String(currentUserId),
        kdp_profile: kdpProfile,
        asin: selectedAsin
      })
    });
    
    const result = await response.json();
    if (result.success && result.data) {
      const book = result.data;
      
      // Display book info
      if (bookImage && book.image_url) {
        bookImage.src = book.image_url;
      }
      if (bookTitle) {
        bookTitle.textContent = book.clean_title || book.title || 'Unknown Title';
      }
      if (bookAsinDisplay) {
        bookAsinDisplay.textContent = `ASIN: ${selectedAsin}`;
      }
      
      // Display price
      if (bookPrice) {
        if (book.price && book.price.amount) {
          bookPrice.textContent = `$${book.price.amount.toFixed(2)}`;
        } else {
          bookPrice.textContent = '-';
        }
      }
      
      // Display royalties
      if (bookRoyalties) {
        if (book.royalties && book.royalties.amount) {
          bookRoyalties.textContent = `$${book.royalties.amount.toFixed(2)}`;
        } else {
          bookRoyalties.textContent = '-';
        }
      }
      
      // Show/hide missing data warning
      const hasMissingData = !book.price?.amount || !book.royalties?.amount;
      if (missingDataWarning) {
        missingDataWarning.style.display = hasMissingData ? 'block' : 'none';
      }
    } else {
      // Book not found or error
      if (bookTitle) bookTitle.textContent = 'Book not found';
      if (bookAsinDisplay) bookAsinDisplay.textContent = `ASIN: ${selectedAsin}`;
      if (bookPrice) bookPrice.textContent = '-';
      if (bookRoyalties) bookRoyalties.textContent = '-';
      if (missingDataWarning) missingDataWarning.style.display = 'block';
    }
  } catch (error) {
    console.error('Error loading book preview:', error);
    if (bookTitle) bookTitle.textContent = 'Error loading book';
    if (bookPrice) bookPrice.textContent = '-';
    if (bookRoyalties) bookRoyalties.textContent = '-';
    if (missingDataWarning) missingDataWarning.style.display = 'block';
  }
}

async function retrieveTargetsForEdit(adGroupId) {
  console.log('Retrieving targets for edit:', adGroupId);
  
  const config = currentConfigurations.find(c => c.ad_group_id === adGroupId);
  if (!config) return;
  
  const matchingCampaign = currentCampaigns.find(c => c.adGroupId === adGroupId);
  if (!matchingCampaign) {
    console.error('Campaign not found for ad group:', adGroupId);
    return;
  }
  
  const retrieveBtn = document.getElementById(`edit-retrieve-btn-${adGroupId}`);
  const retrieveText = document.getElementById(`edit-retrieve-text-${adGroupId}`);
  
  // Show loading state
  if (retrieveText) retrieveText.textContent = 'Retrieving...';
  if (retrieveBtn) {
    retrieveBtn.disabled = true;
    retrieveBtn.style.cursor = 'not-allowed';
    retrieveBtn.style.opacity = '0.7';
  }
  
  try {
    const account = document.getElementById('campaign-account').value;
    const region = document.getElementById('campaign-region').value;
    const kdpProfile = `${account}-${region}`;
    
    const payload = {
      user_id: currentUserId,
      kdp_profile: kdpProfile,
      campaign_id: String(matchingCampaign.campaignId),
      adgroups: [String(adGroupId)]
    };
    
    console.log('Fetching targets with payload:', payload);
    
    const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=get_campaign_targets', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    });
    
    const result = await response.json();
    console.log('Targets response:', result);
    
    if (result.success && result.data && result.data.targets) {
      const targets = result.data.targets;
      const targetsContainer = document.getElementById(`edit-targets-container-${adGroupId}`);
      const targetsList = document.getElementById(`edit-targets-list-${adGroupId}`);
      const targetsCount = document.getElementById(`edit-targets-count-${adGroupId}`);
      
      if (targetsCount) targetsCount.textContent = targets.length;
      
      // Separate products and keywords
      const products = targets.filter(t => t.target_type === 'product');
      const keywords = targets.filter(t => t.target_type === 'keyword');
      
      let targetsHTML = '';
      
      // Render products
      if (products.length > 0) {
        targetsHTML += `
          <div style="margin-bottom: var(--spacing-12);">
            <div style="font-size: 0.75rem; font-weight: 600; color: var(--color-neutral-60); margin-bottom: var(--spacing-6); text-transform: uppercase;">
              Products (${products.length})
            </div>
            <div style="display: grid; gap: var(--spacing-4);">
        `;
        products.forEach(target => {
          const targetId = target.target_id || '';
          const isActive = editingInlineConfigs[adGroupId]?.specialHandlingRules?.some(r => r.target_id === targetId);
          targetsHTML += `
            <div style="display: flex; align-items: center; justify-content: space-between; padding: var(--spacing-6) var(--spacing-8); background: white; border: 1px solid var(--color-neutral-20); border-radius: var(--radius-small);">
              <div style="display: flex; align-items: center; gap: var(--spacing-10); flex: 1;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary-50)" stroke-width="2">
                  <rect x="2" y="7" width="20" height="15" rx="2" ry="2"></rect>
                  <polyline points="17 2 12 7 7 2"></polyline>
                </svg>
                <span style="font-size: 0.75rem; color: var(--color-neutral-80);">${target.target_text || ''}</span>
              </div>
              <div style="display: flex; align-items: center; gap: var(--spacing-8);">
                <span style="font-size: 0.625rem; font-weight: 600; color: var(--color-primary-60); background: var(--color-primary-05); padding: 2px 8px; border-radius: 4px;">${target.match_type_display || target.match_type || ''}</span>
                <button
                  type="button"
                  id="edit-target-${adGroupId}-${targetId}"
                  onclick="toggleAlwaysOnInline('${adGroupId}', '${targetId}', '${(target.target_text || '').replace(/'/g, "\\'")}', '${target.match_type || ''}')"
                  class="${isActive ? 'active' : ''}"
                  style="padding: 4px 10px; background: ${isActive ? 'var(--color-success-50)' : 'var(--color-neutral-10)'}; color: ${isActive ? 'white' : 'var(--color-neutral-60)'}; border: 1px solid ${isActive ? 'var(--color-success-50)' : 'var(--color-neutral-30)'}; border-radius: 4px; font-size: 0.625rem; font-weight: 600; cursor: pointer; transition: all 0.2s;"
                >
                  ALWAYS ON
                </button>
              </div>
            </div>
          `;
        });
        targetsHTML += `</div></div>`;
      }
      
      // Render keywords
      if (keywords.length > 0) {
        targetsHTML += `
          <div>
            <div style="font-size: 0.75rem; font-weight: 600; color: var(--color-neutral-60); margin-bottom: var(--spacing-6); text-transform: uppercase;">
              Keywords (${keywords.length})
            </div>
            <div style="display: grid; gap: var(--spacing-4);">
        `;
        keywords.forEach(target => {
          const targetId = target.target_id || '';
          const isActive = editingInlineConfigs[adGroupId]?.specialHandlingRules?.some(r => r.target_id === targetId);
          targetsHTML += `
            <div style="display: flex; align-items: center; justify-content: space-between; padding: var(--spacing-6) var(--spacing-8); background: white; border: 1px solid var(--color-neutral-20); border-radius: var(--radius-small);">
              <div style="display: flex; align-items: center; gap: var(--spacing-10); flex: 1;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--color-neutral-50)" stroke-width="2">
                  <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                </svg>
                <span style="font-size: 0.75rem; color: var(--color-neutral-80);">${target.target_text || ''}</span>
              </div>
              <div style="display: flex; align-items: center; gap: var(--spacing-8);">
                <span style="font-size: 0.625rem; font-weight: 600; color: var(--color-neutral-60); background: var(--color-neutral-10); padding: 2px 8px; border-radius: 4px;">${target.match_type_display || target.match_type || ''}</span>
                <button
                  type="button"
                  id="edit-target-${adGroupId}-${targetId}"
                  onclick="toggleAlwaysOnInline('${adGroupId}', '${targetId}', '${(target.target_text || '').replace(/'/g, "\\'")}', '${target.match_type || ''}')"
                  class="${isActive ? 'active' : ''}"
                  style="padding: 4px 10px; background: ${isActive ? 'var(--color-success-50)' : 'var(--color-neutral-10)'}; color: ${isActive ? 'white' : 'var(--color-neutral-60)'}; border: 1px solid ${isActive ? 'var(--color-success-50)' : 'var(--color-neutral-30)'}; border-radius: 4px; font-size: 0.625rem; font-weight: 600; cursor: pointer; transition: all 0.2s;"
                >
                  ALWAYS ON
                </button>
              </div>
            </div>
          `;
        });
        targetsHTML += `</div></div>`;
      }
      
      if (targetsList) targetsList.innerHTML = targetsHTML;
      if (targetsContainer) targetsContainer.style.display = 'block';
      
    } else {
      throw new Error('Failed to retrieve targets');
    }
    
  } catch (error) {
    console.error('Error retrieving targets:', error);
  } finally {
    if (retrieveText) retrieveText.textContent = 'Retrieve Targets';
    if (retrieveBtn) {
      retrieveBtn.disabled = false;
      retrieveBtn.style.cursor = 'pointer';
      retrieveBtn.style.opacity = '1';
    }
  }
}

function toggleAlwaysOnInline(adGroupId, targetId, targetText, matchType) {
  if (!editingInlineConfigs[adGroupId]) {
    editingInlineConfigs[adGroupId] = { specialHandlingRules: [] };
  }
  
  const rules = editingInlineConfigs[adGroupId].specialHandlingRules;
  const existingIndex = rules.findIndex(r => r.target_id === targetId);
  const button = document.getElementById(`edit-target-${adGroupId}-${targetId}`);
  
  if (existingIndex >= 0) {
    // Remove from rules
    rules.splice(existingIndex, 1);
    if (button) {
      button.classList.remove('active');
      button.style.background = 'var(--color-neutral-10)';
      button.style.color = 'var(--color-neutral-60)';
      button.style.borderColor = 'var(--color-neutral-30)';
    }
  } else {
    // Add to rules
    rules.push({
      target_id: targetId,
      target_text: targetText,
      match_type: matchType,
      action: 'ALWAYS_ON'
    });
    if (button) {
      button.classList.add('active');
      button.style.background = 'var(--color-success-50)';
      button.style.color = 'white';
      button.style.borderColor = 'var(--color-success-50)';
    }
  }
  
  console.log('Updated special handling rules for', adGroupId, ':', rules);
}

async function updateConfigInline(adGroupId) {
  console.log('Updating config inline:', adGroupId);
  
  const bidStrategy = document.getElementById(`edit-bid-strategy-${adGroupId}`).value;
  
  // Get config to access ASIN
  const config = currentConfigurations.find(c => c.ad_group_id === adGroupId);
  if (!config) return;
  
  const selectedAsin = Array.isArray(config.asin) ? config.asin[0] : config.asin;
  
  // Validation
  if (!selectedAsin) {
    alert('ASIN is missing from configuration');
    return;
  }
  
  // Get account info for API call
  const account = document.getElementById('campaign-account').value;
  const region = document.getElementById('campaign-region').value;
  const kdpProfile = `${account}-${region}`;
  
  // Build the configuration object (only include fields that API accepts)
  const configuration = {
    asin: selectedAsin,  // String, not array
    campaign_name: config.campaign_name,
    campaign_id: String(config.campaign_id),
    ad_group_id: String(adGroupId),
    ad_group_name: config.ad_group_name || '',
    bid_update_strategy: bidStrategy
  };
  
  // Add special handling rules if any
  if (editingInlineConfigs[adGroupId]?.specialHandlingRules?.length > 0) {
    configuration.special_handling_rules = editingInlineConfigs[adGroupId].specialHandlingRules;
  }
  
  // Wrap in the expected payload structure
  const payload = {
    user_id: String(currentUserId),
    kdp_profile: kdpProfile,
    configuration: [configuration]
  };
  
  console.log('Updating configuration with payload:', payload);
  
  try {
    const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=create_campaign_config', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    });
    
    const result = await response.json();
    console.log('Update response:', result);
    console.log('Response details:', JSON.stringify(result, null, 2));
    
    if (result.success) {
      // Success notification
      const successDiv = document.createElement('div');
      successDiv.style.cssText = 'position: fixed; top: 20px; right: 20px; background: #4CAF50; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 1000;';
      successDiv.textContent = '✓ Configuration updated successfully';
      document.body.appendChild(successDiv);
      setTimeout(() => successDiv.remove(), 3000);
      
      // Cancel edit mode
      cancelConfigInlineEdit(adGroupId);
      
      // Reload configurations
      await reloadConfigurationsOnly(currentUserId, kdpProfile);
      
    } else {
      const errorMessage = result.data?.message || result.data?.error || 'Failed to update configuration';
      console.error('Backend error:', errorMessage);
      throw new Error(errorMessage);
    }
    
  } catch (error) {
    console.error('Error updating configuration:', error);
    const errorDiv = document.createElement('div');
    errorDiv.style.cssText = 'position: fixed; top: 20px; right: 20px; background: #FF6B6B; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 1000;';
    errorDiv.textContent = '✗ ' + error.message;
    document.body.appendChild(errorDiv);
    setTimeout(() => errorDiv.remove(), 5000);
  }
}

async function editCampaignConfig(adGroupId) {
  const config = currentConfigurations.find(c => c.ad_group_id === adGroupId);
  if (!config) {
    console.error('Configuration not found for ad_group_id:', adGroupId);
    return;
  }

  console.log('Editing configuration:', config);

  // Set editing state FIRST - this is crucial for ad group dropdown filtering
  editingConfigAdGroupId = adGroupId;
  document.getElementById('config-editing-ad-group-id').value = adGroupId;

  // Store special handling rules temporarily if they exist
  const savedSpecialRules = config.special_handling_rules || [];
  
  // Reset targets display initially
  const targetsContainer = document.getElementById('retrieved-targets-container');
  if (targetsContainer) {
    targetsContainer.style.display = 'none';
  }

  // Populate form fields
  document.getElementById('config-royalties').value = config.royalties || '';
  document.getElementById('config-book-price').value = config.book_price || '';
  document.getElementById('config-bid-strategy').value = config.bid_update_strategy;

  // Select campaign - this will trigger the ad group dropdown population
  const campaignSelect = document.getElementById('config-campaign-name');
  // Campaign dropdown now uses campaign_id as value, so we need to find and set it
  const campaignToEdit = currentCampaigns.find(c => c.adGroupId === adGroupId);
  if (campaignToEdit) {
    campaignSelect.value = campaignToEdit.campaignId;
  }

  // Trigger ad group dropdown population
  const event = new Event('change');
  campaignSelect.dispatchEvent(event);

  // The ad group dropdown is populated synchronously, so we can select immediately
  // Use nextTick to ensure DOM has updated
  await new Promise(resolve => setTimeout(resolve, 0));

  const adGroupSelect = document.getElementById('config-ad-group');
  adGroupSelect.value = adGroupId;

  // Trigger change event to update button state
  const adGroupChangeEvent = new Event('change');
  adGroupSelect.dispatchEvent(adGroupChangeEvent);

  // Verify the selection worked
  if (adGroupSelect.value !== adGroupId) {
    console.warn('Failed to select ad group:', adGroupId, 'Available options:',
      Array.from(adGroupSelect.options).map(o => o.value));
  } else {
    console.log('Successfully selected ad group:', adGroupId);
  }

  // If there are targets to retrieve (either special rules exist or we want to show targets)
  // Automatically trigger the retrieve targets button
  await new Promise(resolve => setTimeout(resolve, 100));
  const retrieveBtn = document.getElementById('retrieve-targets-btn');
  if (retrieveBtn && !retrieveBtn.disabled) {
    console.log('Auto-retrieving targets for edit mode...');
    
    // Temporarily store the special rules to restore after retrieval
    const rulesToRestore = [...savedSpecialRules];
    
    // Create a promise that waits for targets to be retrieved
    const waitForTargets = new Promise(resolve => {
      // Create a one-time event listener for target retrieval completion
      window.addEventListener('targetsRetrieved', function handler() {
        window.removeEventListener('targetsRetrieved', handler);
        resolve();
      }, { once: true });
    });
    
    // Trigger the retrieve button click
    retrieveBtn.click();
    
    // Wait for targets to be retrieved and rendered
    await waitForTargets;
    
    // Additional small delay to ensure DOM is fully updated
    await new Promise(resolve => setTimeout(resolve, 100));
    
    // Restore special handling rules and mark buttons as active
    if (rulesToRestore.length > 0) {
      console.log('Restoring special handling rules:', rulesToRestore);
      specialHandlingRules = [...rulesToRestore];
      
      // Mark the corresponding buttons as active
      rulesToRestore.forEach(rule => {
        // Try to find the button by target_id
        const productBtn = document.getElementById(`product-${rule.target_id}`);
        const keywordBtn = document.getElementById(`keyword-${rule.target_id}`);
        const button = productBtn || keywordBtn;
        
        if (button) {
          console.log('Activating button for target:', rule.target_id);
          button.classList.add('active');
          button.style.background = 'var(--color-success-50)';
          button.style.color = 'white';
          button.style.borderColor = 'var(--color-success-50)';
        } else {
          console.warn('Button not found for target_id:', rule.target_id);
        }
      });
    }
  }

  // Update UI
  document.getElementById('config-form-title').textContent = 'Edit Configuration';
  document.getElementById('config-submit-button-text').textContent = 'Update Configuration';
  document.getElementById('cancel-campaign-config').style.display = 'block';

  // Scroll to form
  document.getElementById('campaign-config-form-container').scrollIntoView({ behavior: 'smooth' });
}

async function reloadConfigurationsOnly(userId, kdpProfile) {
  console.log('reloadConfigurationsOnly called with:', { userId, kdpProfile });

  try {
    const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=list_campaign_configs', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
      body: JSON.stringify({ user_id: userId, kdp_profile: kdpProfile })
    });

    console.log('Response status:', response.status);
    const configsData = await response.json();
    console.log('Configs data received:', configsData);

    if (configsData.success && configsData.data && configsData.data.configurations) {
      currentConfigurations = configsData.data.configurations;
      console.log('Updated currentConfigurations to:', currentConfigurations.length, 'items');
      console.log('Configuration details:', JSON.stringify(currentConfigurations, null, 2));

      // Re-render the configurations list
      console.log('Calling renderConfigurationsList...');
      renderConfigurationsList(userId, kdpProfile);
      console.log('renderConfigurationsList completed');
    } else {
      console.error('Failed to reload configurations:', configsData);
      console.log('Setting currentConfigurations to empty array');
      currentConfigurations = [];
      renderConfigurationsList(userId, kdpProfile);
    }
  } catch (error) {
    console.error('Error reloading configurations:', error);
    console.error('Error stack:', error.stack);
  }
}

async function deleteCampaignConfig(userId, kdpProfile, adGroupId) {
  try {
    // Find the configuration to get campaign_id
    const config = currentConfigurations.find(c => c.ad_group_id === adGroupId);
    if (!config) {
      console.error('Configuration not found for ad_group_id:', adGroupId);
      return;
    }

    const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=delete_campaign_config', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        user_id: userId,
        kdp_profile: kdpProfile,
        campaign_id: config.campaign_id,
        ad_group_id: adGroupId
      })
    });

    const data = await response.json();

    if (data.success) {
      console.log('Configuration deleted successfully, reloading list...');
      // Only reload configurations, campaigns data stays the same
      await reloadConfigurationsOnly(userId, kdpProfile);
    } else {
      console.error('Failed to delete configuration:', data);
    }
  } catch (error) {
    console.error('Error deleting configuration:', error);
  }
}

// Global function to download PDF report for an optimization run
window.downloadRunPDF = async function(userId, runId, buttonElement) {
  const originalHTML = buttonElement.innerHTML;
  const originalBg = buttonElement.style.background;

  try {
    // Show loading state
    buttonElement.disabled = true;
    buttonElement.innerHTML = `
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="animation: spin 1s linear infinite;">
        <line x1="12" y1="2" x2="12" y2="6"></line>
        <line x1="12" y1="18" x2="12" y2="22"></line>
        <line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line>
        <line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line>
        <line x1="2" y1="12" x2="6" y2="12"></line>
        <line x1="18" y1="12" x2="22" y2="12"></line>
        <line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line>
        <line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line>
      </svg>
    `;
    buttonElement.style.background = 'var(--color-neutral-50)';

    // Call WordPress AJAX to get the signed download URL
    const url = new URL('<?php echo admin_url('admin-ajax.php'); ?>');
    url.searchParams.append('action', 'get_pdf_download_url');
    url.searchParams.append('user_id', userId);
    url.searchParams.append('run_id', runId);
    url.searchParams.append('language', userLanguage);

    const response = await fetch(url, {
      method: 'GET',
      credentials: 'same-origin'
    });

    if (!response.ok) {
      const responseText = await response.text();
      console.error('PDF Download error:', responseText);
      throw new Error(`Failed to get download URL (${response.status})`);
    }

    const data = await response.json();

    if (!data.success || !data.data || !data.data.download_url) {
      throw new Error(data.message || 'Invalid response from server');
    }

    // Use the signed URL to download the PDF directly from GCS
    const downloadUrl = data.data.download_url;
    const filename = data.data.filename || `optimization-report-${runId}.pdf`;

    // Create a temporary link and trigger download
    const a = document.createElement('a');
    a.href = downloadUrl;
    a.download = filename;
    a.target = '_blank';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);

    // Show success state briefly
    buttonElement.innerHTML = `
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="20 6 9 17 4 12"></polyline>
      </svg>
      Done
    `;
    buttonElement.style.background = '#10B981';

    setTimeout(() => {
      buttonElement.innerHTML = originalHTML;
      buttonElement.style.background = originalBg;
      buttonElement.disabled = false;
    }, 2000);

  } catch (error) {
    console.error('Error downloading PDF:', error);

    // Show error state
    buttonElement.innerHTML = `
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"></circle>
        <line x1="15" y1="9" x2="9" y2="15"></line>
        <line x1="9" y1="9" x2="15" y2="15"></line>
      </svg>
      Error
    `;
    buttonElement.style.background = '#EF4444';

    setTimeout(() => {
      buttonElement.innerHTML = originalHTML;
      buttonElement.style.background = originalBg;
      buttonElement.disabled = false;
    }, 2000);
  }
};

// Global function to toggle run details display
window.toggleRunDetails = async function(userId, runId, containerId) {
  const container = document.getElementById(containerId);

  if (!container) {
    console.error('Run details container not found:', containerId);
    return;
  }

  // If already visible, hide it
  if (container.style.display === 'block') {
    container.style.display = 'none';
    return;
  }

  // Show loading state
  container.style.display = 'block';
  container.innerHTML = '<div style="text-align: center; padding: var(--spacing-12);"><div style="display: inline-block; width: 20px; height: 20px; border: 2px solid var(--color-neutral-20); border-top-color: var(--color-primary-60); border-radius: 50%; animation: spin 1s linear infinite;"></div><p style="margin-top: var(--spacing-8); color: var(--color-neutral-60); font-size: 0.75rem;">Loading run details...</p></div>';

  try {
    const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=get_run_details', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        user_id: userId,
        run_id: runId,
        language: userLanguage
      })
    });

    const data = await response.json();

    if (data.success && data.data && Array.isArray(data.data)) {
      const logs = data.data;

      if (logs.length === 0) {
        container.innerHTML = '<p style="margin: 0; color: var(--color-neutral-60); font-size: 0.75rem;">No actions found for this run.</p>';
        return;
      }

      // Group logs by campaign_name -> adgroup_id -> action_type
      const groupedLogs = {};

      logs.forEach(log => {
        const campaignName = log.campaign_name || 'Unknown Campaign';
        const adgroupId = log.adgroup_id || 'unknown';
        const actionType = log.action_type || 0;

        if (!groupedLogs[campaignName]) {
          groupedLogs[campaignName] = {};
        }
        if (!groupedLogs[campaignName][adgroupId]) {
          groupedLogs[campaignName][adgroupId] = {};
        }
        if (!groupedLogs[campaignName][adgroupId][actionType]) {
          groupedLogs[campaignName][adgroupId][actionType] = [];
        }

        groupedLogs[campaignName][adgroupId][actionType].push(log);
      });

      // Build HTML
      let html = '<div style="display: grid; gap: var(--spacing-12);">';

      // Sort campaign names alphabetically
      const sortedCampaigns = Object.keys(groupedLogs).sort();

      sortedCampaigns.forEach((campaignName, campaignIndex) => {
        const adgroups = groupedLogs[campaignName];
        const campaignId = `campaign-${runId}-${campaignIndex}`;

        // Count total actions in this campaign
        let totalActions = 0;
        Object.keys(adgroups).forEach(adgroupId => {
          Object.keys(adgroups[adgroupId]).forEach(actionType => {
            totalActions += adgroups[adgroupId][actionType].length;
          });
        });

        html += `
          <div style="background: white; border-radius: var(--radius-small); border: 1px solid var(--color-neutral-30);">
            <div
              onclick="document.getElementById('${campaignId}').style.display = document.getElementById('${campaignId}').style.display === 'none' ? 'block' : 'none'; event.currentTarget.querySelector('.chevron').style.transform = document.getElementById('${campaignId}').style.display === 'none' ? 'rotate(0deg)' : 'rotate(180deg)';"
              style="padding: var(--spacing-12); cursor: pointer; display: flex; align-items: center; justify-content: space-between; transition: background 0.2s;"
              onmouseover="this.style.background='var(--color-neutral-05)';"
              onmouseout="this.style.background='white';"
            >
              <h6 style="margin: 0; font-size: 0.875rem; font-weight: 700; color: var(--color-primary-60); display: flex; align-items: center; gap: var(--spacing-6);">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                  <line x1="9" y1="3" x2="9" y2="21"></line>
                </svg>
                ${campaignName}
                <span style="font-size: 0.75rem; font-weight: 500; color: var(--color-neutral-60);">(${totalActions} action${totalActions !== 1 ? 's' : ''})</span>
              </h6>
              <svg class="chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--color-neutral-50)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="transition: transform 0.2s; transform: rotate(0deg);">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </div>
            <div id="${campaignId}" style="display: none; padding: 0 var(--spacing-12) var(--spacing-12) var(--spacing-12); display: none;">
              <div style="display: grid; gap: var(--spacing-10);">
        `;

        // Sort adgroup IDs - CAMPAIGN_LEVEL should come first
        const sortedAdgroups = Object.keys(adgroups).sort((a, b) => {
          if (a === 'CAMPAIGN_LEVEL') return -1;
          if (b === 'CAMPAIGN_LEVEL') return 1;
          return a.localeCompare(b);
        });

        sortedAdgroups.forEach((adgroupId, adgroupIndex) => {
          const actionTypes = adgroups[adgroupId];
          const adgroupId_unique = `adgroup-${runId}-${campaignIndex}-${adgroupIndex}`;

          // Special handling for CAMPAIGN_LEVEL - display actions directly without adgroup wrapper
          if (adgroupId === 'CAMPAIGN_LEVEL') {
            // Sort action types - prioritize TURN_OFF (3) and LOWER_BID (2) first, then RAISE_BID (1)
            const sortedActionTypes = Object.keys(actionTypes).sort((a, b) => {
              const aType = parseInt(a);
              const bType = parseInt(b);

              const getPriority = (type) => {
                if (type === 3) return 0; // TURN_OFF - highest priority
                if (type === 2) return 1; // LOWER_BID - medium priority
                if (type === 1) return 2; // RAISE_BID - lowest priority
                return 999; // Unknown types go last
              };

              return getPriority(aType) - getPriority(bType);
            });

            // Add campaign-level optimizations section header
            html += `
              <div style="background: #F3F4F6; padding: var(--spacing-6) var(--spacing-8); border-radius: var(--radius-small); margin-bottom: var(--spacing-4);">
                <div style="font-size: 0.7rem; font-weight: 700; color: var(--color-neutral-60); text-transform: uppercase; letter-spacing: 0.05em;">
                  📍 Campaign-Level Optimizations
                </div>
              </div>
            `;

            sortedActionTypes.forEach(actionType => {
              const actions = actionTypes[actionType];

              // Display each action's description with color-coded borders
              actions.forEach(action => {
                let borderColor = 'var(--color-neutral-20)';
                let backgroundColor = 'white';

                if (action.action_type === 1) {
                  borderColor = '#10B981';
                  backgroundColor = '#F0FDF4';
                } else if (action.action_type === 2) {
                  borderColor = '#F59E0B';
                  backgroundColor = '#FFFBEB';
                } else if (action.action_type === 3) {
                  borderColor = '#EF4444';
                  backgroundColor = '#FEF2F2';
                }

                html += `
                  <div style="padding: var(--spacing-8); background: ${backgroundColor}; border-radius: var(--radius-small); font-size: 0.75rem; line-height: 1.5; color: var(--color-neutral-80); border: 1px solid var(--color-neutral-20); border-left: 4px solid ${borderColor};">
                    ${action.description}
                  </div>
                `;
              });
            });

            return; // Skip the normal adgroup rendering
          }

          // Count actions in this ad group
          let adgroupActions = 0;
          Object.keys(actionTypes).forEach(actionType => {
            adgroupActions += actionTypes[actionType].length;
          });

          html += `
            <div style="background: var(--color-neutral-05); border-radius: var(--radius-small); border-left: 3px solid var(--color-primary-40);">
              <div
                onclick="document.getElementById('${adgroupId_unique}').style.display = document.getElementById('${adgroupId_unique}').style.display === 'none' ? 'block' : 'none'; event.currentTarget.querySelector('.chevron').style.transform = document.getElementById('${adgroupId_unique}').style.display === 'none' ? 'rotate(0deg)' : 'rotate(180deg)';"
                style="padding: var(--spacing-8); cursor: pointer; display: flex; align-items: center; justify-content: space-between; transition: background 0.2s;"
                onmouseover="this.style.background='rgba(255,255,255,0.5)';"
                onmouseout="this.style.background='transparent';"
              >
                <div style="font-size: 0.75rem; font-weight: 600; color: var(--color-neutral-70);">
                  Ad Group ID: ${adgroupId}
                  <span style="font-weight: 500; color: var(--color-neutral-60);">(${adgroupActions} action${adgroupActions !== 1 ? 's' : ''})</span>
                </div>
                <svg class="chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--color-neutral-50)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="transition: transform 0.2s; transform: rotate(0deg);">
                  <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
              </div>
              <div id="${adgroupId_unique}" style="display: none; padding: 0 var(--spacing-8) var(--spacing-8) var(--spacing-8);">
                <div style="display: grid; gap: var(--spacing-6);">
          `;

          // Sort action types - prioritize TURN_OFF (3) and LOWER_BID (2) first, then RAISE_BID (1)
          const sortedActionTypes = Object.keys(actionTypes).sort((a, b) => {
            const aType = parseInt(a);
            const bType = parseInt(b);

            // Priority order: TURN_OFF (3) = highest priority (0), LOWER_BID (2) = medium (1), RAISE_BID (1) = lowest (2)
            const getPriority = (type) => {
              if (type === 3) return 0; // TURN_OFF - highest priority
              if (type === 2) return 1; // LOWER_BID - medium priority
              if (type === 1) return 2; // RAISE_BID - lowest priority
              return 999; // Unknown types go last
            };

            return getPriority(aType) - getPriority(bType);
          });

          sortedActionTypes.forEach(actionType => {
            const actions = actionTypes[actionType];

            // Display each action's description with color-coded borders
            actions.forEach(action => {
              // Determine color based on action_type
              // RAISE_BID = 1 (green), LOWER_BID = 2 (orange), TURN_OFF = 3 (red)
              let borderColor = 'var(--color-neutral-20)';
              let backgroundColor = 'white';

              if (action.action_type === 1) {
                // Raise bid - green
                borderColor = '#10B981';
                backgroundColor = '#F0FDF4';
              } else if (action.action_type === 2) {
                // Lower bid - orange
                borderColor = '#F59E0B';
                backgroundColor = '#FFFBEB';
              } else if (action.action_type === 3) {
                // Turn off - red
                borderColor = '#EF4444';
                backgroundColor = '#FEF2F2';
              }

              html += `
                <div style="padding: var(--spacing-8); background: ${backgroundColor}; border-radius: var(--radius-small); font-size: 0.75rem; line-height: 1.5; color: var(--color-neutral-80); border: 1px solid var(--color-neutral-20); border-left: 4px solid ${borderColor};">
                  ${action.description}
                </div>
              `;
            });
          });

          html += `
                </div>
              </div>
            </div>
          `;
        });

        html += `
              </div>
            </div>
          </div>
        `;
      });

      html += '</div>';

      container.innerHTML = html;
    } else {
      container.innerHTML = '<p style="margin: 0; color: #FF6B6B; font-size: 0.75rem;">Failed to fetch run details. Please try again.</p>';
    }
  } catch (error) {
    console.error('Error fetching run details:', error);
    container.innerHTML = '<p style="margin: 0; color: #FF6B6B; font-size: 0.75rem;">Error fetching run details. Please try again.</p>';
  }
};

// Global function to fetch and display optimization runs for an account and specific region
window.fetchOptimizationRuns = async function(userId, accountName, region = null, containerId = null) {
  // Use provided containerId or default to runs-${accountName}
  const containerIdToUse = containerId || `runs-${accountName}`;
  const runsDiv = document.getElementById(containerIdToUse);

  if (!runsDiv) {
    console.error('Runs container not found:', containerIdToUse);
    return;
  }

  // Toggle visibility - if already visible, hide it
  if (runsDiv.style.display === 'block') {
    runsDiv.style.display = 'none';
    return;
  }

  // Show loading state
  runsDiv.style.display = 'block';
  runsDiv.innerHTML = '<div style="text-align: center; padding: var(--spacing-16);"><div style="display: inline-block; width: 24px; height: 24px; border: 3px solid var(--color-neutral-20); border-top-color: var(--color-primary-60); border-radius: 50%; animation: spin 1s linear infinite;"></div><p style="margin-top: var(--spacing-8); color: var(--color-neutral-60); font-size: 0.875rem;">Loading optimization runs...</p></div>';

  try {
    const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=get_optimization_runs', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        user_id: userId,
        account_name: accountName
      })
    });

    const data = await response.json();

    if (data.success && data.data) {
      let runs = data.data.runs || [];
      const totalCount = data.data.count || 0;

      // Filter runs by region if region parameter is provided
      if (region) {
        runs = runs.filter(run => run.region === region);
      }

      const count = runs.length;

      if (runs.length === 0) {
        runsDiv.innerHTML = '<p style="margin: 0; color: var(--color-neutral-60); font-size: 0.875rem;">No optimization runs found for this account.</p>';
      } else {
        // Sort runs by datetime (most recent first)
        runs.sort((a, b) => new Date(b.datetime) - new Date(a.datetime));

        runsDiv.innerHTML = `
          <div style="margin-bottom: var(--spacing-12);">
            <h4 style="margin: 0 0 var(--spacing-12) 0; font-size: 0.875rem; font-weight: 700; color: var(--color-neutral-90);">
              Optimization Runs (${count} total)
            </h4>
          </div>
          <div style="display: grid; gap: var(--spacing-6);">
            ${runs.map((run, index) => {
              const date = new Date(run.datetime);
              const formattedDate = date.toLocaleString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
              });

              const runContainerId = `run-details-${accountName}-${run.region}-${index}`;

              return `
                <div>
                  <div style="padding: var(--spacing-10); background: white; border: 1px solid var(--color-neutral-30); border-radius: var(--radius-small); display: flex; align-items: center; gap: var(--spacing-10); transition: all 0.2s;">
                    <div
                      data-kdp-profile="${run.kdp_profile}"
                      data-run-id="${run.run_id}"
                      onclick="window.toggleRunDetails('${userId}', '${run.run_id}', '${runContainerId}')"
                      style="flex: 1; display: flex; align-items: center; gap: var(--spacing-10); cursor: pointer;"
                      onmouseover="this.parentElement.style.background='var(--color-neutral-05)'; this.parentElement.style.borderColor='var(--color-primary-60)';"
                      onmouseout="this.parentElement.style.background='white'; this.parentElement.style.borderColor='var(--color-neutral-30)';"
                    >
                      <div style="width: 6px; height: 6px; background: #00C2A8; border-radius: 50%; flex-shrink: 0;"></div>
                      <div style="font-size: 0.8125rem; color: var(--color-neutral-70); flex: 1;">
                        ${formattedDate}
                      </div>
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--color-neutral-50)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                        <polyline points="6 9 12 15 18 9"></polyline>
                      </svg>
                    </div>
                    <button
                      onclick="event.stopPropagation(); window.downloadRunPDF('${userId}', '${run.run_id}', this);"
                      title="Download PDF Report"
                      style="padding: var(--spacing-6) var(--spacing-10); background: var(--color-primary-60); color: white; border: none; border-radius: var(--radius-small); font-size: 0.75rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: var(--spacing-4); transition: all 0.2s; flex-shrink: 0;"
                      onmouseover="this.style.background='var(--color-primary-70)';"
                      onmouseout="this.style.background='var(--color-primary-60)';"
                    >
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                      </svg>
                      PDF
                    </button>
                  </div>
                  <div id="${runContainerId}" style="display: none; margin-top: var(--spacing-8); padding: var(--spacing-12); background: var(--color-neutral-05); border: 1px solid var(--color-neutral-30); border-radius: var(--radius-small);"></div>
                </div>
              `;
            }).join('')}
          </div>
        `;
      }
    } else {
      runsDiv.innerHTML = '<p style="margin: 0; color: #FF6B6B; font-size: 0.875rem;">Failed to fetch optimization runs. Please try again.</p>';
    }
  } catch (error) {
    console.error('Error fetching optimization runs:', error);
    runsDiv.innerHTML = '<p style="margin: 0; color: #FF6B6B; font-size: 0.875rem;">Error fetching runs. Please try again.</p>';
  }
};

// Global functions for account management
async function deleteKDPAccount(userId, accountName) {
  try {
    await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=delete_kdp_account', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        user_id: userId,
        account_name: accountName
      })
    });

    // Always reload accounts list regardless of response
    // The account will disappear if deletion was successful
    window.loadKDPAccounts(userId);

    // Also refresh optimization schedules if they're loaded
    if (window.loadOptimizationSchedules) {
      window.loadOptimizationSchedules(userId);
    }
  } catch (error) {
    console.error('Error deleting KDP account:', error);
    // Still reload the list to reflect actual state
    window.loadKDPAccounts(userId);

    // Also refresh optimization schedules if they're loaded
    if (window.loadOptimizationSchedules) {
      window.loadOptimizationSchedules(userId);
    }
  }
}

// Global functions for optimization schedule management
async function toggleOptimization(userId, kdpProfile, currentlyActive) {
  const action = currentlyActive ? 'disable' : 'enable';

  try {
    const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=toggle_optimization', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        user_id: userId,
        kdp_profile: kdpProfile,
        active: !currentlyActive
      })
    });

    const data = await response.json();

    if (data.success) {
      // Reload schedules using current user ID (this will update the toggle state)
      await window.loadOptimizationSchedules(currentUserId);
    } else {
      // Show error message
      const errorMessage = document.createElement('div');
      errorMessage.style.cssText = 'position: fixed; top: 20px; right: 20px; background: #FF6B6B; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 1000; animation: slideInRight 0.3s ease;';
      errorMessage.textContent = '✗ Failed to ' + action + ' optimization';
      document.body.appendChild(errorMessage);

      setTimeout(() => {
        errorMessage.remove();
      }, 3000);
    }
  } catch (error) {
    console.error('Error toggling optimization:', error);
    // Show error message
    const errorMessage = document.createElement('div');
    errorMessage.style.cssText = 'position: fixed; top: 20px; right: 20px; background: #FF6B6B; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 1000; animation: slideInRight 0.3s ease;';
    errorMessage.textContent = '✗ Failed to ' + action + ' optimization';
    document.body.appendChild(errorMessage);

    setTimeout(() => {
      errorMessage.remove();
    }, 3000);
  }
}

async function deleteOptimization(userId, kdpProfile) {
  try {
    const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=delete_optimization', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        user_id: userId,
        kdp_profile: kdpProfile
      })
    });

    const data = await response.json();

    if (data.success) {
      // Show success message
      const successMessage = document.createElement('div');
      successMessage.style.cssText = 'position: fixed; top: 20px; right: 20px; background: #00C2A8; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 1000; animation: slideInRight 0.3s ease;';
      successMessage.textContent = '✓ Optimization deleted successfully';
      document.body.appendChild(successMessage);

      setTimeout(() => {
        successMessage.remove();
      }, 3000);

      // Reload schedules using current user ID
      await window.loadOptimizationSchedules(currentUserId);
    } else {
      // Show error message with details
      const errorMessage = document.createElement('div');
      errorMessage.style.cssText = 'position: fixed; top: 20px; right: 20px; background: #FF6B6B; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 1000; animation: slideInRight 0.3s ease;';
      errorMessage.textContent = '✗ Failed to delete optimization: ' + (data.data?.message || 'Unknown error');
      document.body.appendChild(errorMessage);

      setTimeout(() => {
        errorMessage.remove();
      }, 5000);
    }
  } catch (error) {
    console.error('Error deleting optimization:', error);

    // Show error message
    const errorMessage = document.createElement('div');
    errorMessage.style.cssText = 'position: fixed; top: 20px; right: 20px; background: #FF6B6B; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 1000; animation: slideInRight 0.3s ease;';
    errorMessage.textContent = '✗ Failed to delete optimization';
    document.body.appendChild(errorMessage);

    setTimeout(() => {
      errorMessage.remove();
    }, 3000);
  }
}

// ===========================================
// BOOKS MANAGEMENT FUNCTIONS
// ===========================================

let currentKdpProfile = '';

// Load books for selected account and region
async function loadBooks() {
  const accountSelect = document.getElementById('books-account');
  const regionSelect = document.getElementById('books-region');
  const account = accountSelect.value;
  const region = regionSelect.value;

  if (!account || !region) {
    showBooksError('Please select both account and region');
    return;
  }

  currentKdpProfile = `${account}-${region}`;

  // Debug logging
  console.log('Loading books with:', {
    user_id: String(currentUserId),
    kdp_profile: currentKdpProfile,
    account: account,
    region: region
  });

  // Show loading state
  document.getElementById('books-loading').style.display = 'block';
  document.getElementById('books-container').style.display = 'none';
  document.getElementById('books-empty').style.display = 'none';
  document.getElementById('books-error').style.display = 'none';
  document.getElementById('books-success').style.display = 'none';

  try {
    // First call: Get books from Amazon Ads API
    const listResponse = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=list_books', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        user_id: String(currentUserId),
        kdp_profile: currentKdpProfile
      })
    });

    const listData = await listResponse.json();
    console.log('List books response:', listData);

    if (!listData.success || !listData.data || !listData.data.books) {
      throw new Error(listData.data?.error || 'Failed to load books from API');
    }

    // Second call: Get saved royalties data
    const getResponse = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=get_books', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        user_id: String(currentUserId),
        kdp_profile: currentKdpProfile
      })
    });

    const getData = await getResponse.json();
    const savedBooks = (getData.success && getData.data && getData.data.books) ? getData.data.books : [];

    // Filter and merge data: exclude books without price, without availability, or OUT_OF_STOCK
    currentBooksData = listData.data.books
      .filter(book => book.price && book.availability && book.availability !== 'OUT_OF_STOCK')
      .map(apiBook => {
        const savedBook = savedBooks.find(sb => sb.asin === apiBook.asin);
        return {
          ...apiBook,
          royalties: savedBook?.royalties || null
        };
      });

    // Hide loading, show books
    document.getElementById('books-loading').style.display = 'none';

    if (currentBooksData.length === 0) {
      document.getElementById('books-empty').style.display = 'block';
    } else {
      document.getElementById('books-container').style.display = 'block';
      renderBooksList();
    }

  } catch (error) {
    console.error('Error loading books:', error);
    document.getElementById('books-loading').style.display = 'none';
    showBooksError(error.message || 'Failed to load books. Please try again.');
  }
}

// Calculate break-even ACoS
function calculateBreakEvenAcos(bookPrice, royalties) {
  if (!bookPrice || bookPrice <= 0) return 0;
  return (royalties / bookPrice) * 100;
}

// Calculate profit margin (1/3 of break-even ACoS)
function calculateProfitMargin(bookPrice, royalties) {
  return calculateBreakEvenAcos(bookPrice, royalties) / 3;
}

// Calculate target ACoS (break-even ACoS - profit margin)
function calculateTargetAcos(bookPrice, royalties) {
  const breakEven = calculateBreakEvenAcos(bookPrice, royalties);
  const margin = calculateProfitMargin(bookPrice, royalties);
  return breakEven - margin;
}

// Render the books list
function renderBooksList() {
  const booksListDiv = document.getElementById('books-list');
  
  if (currentBooksData.length === 0) {
    booksListDiv.innerHTML = '';
    return;
  }

  // Group books by clean_title
  const groupedBooks = currentBooksData.reduce((groups, book, index) => {
    const key = book.clean_title || book.title;
    if (!groups[key]) {
      groups[key] = [];
    }
    groups[key].push({ ...book, originalIndex: index });
    return groups;
  }, {});

  // Render grouped books
  booksListDiv.innerHTML = Object.entries(groupedBooks).map(([title, variants]) => {
    // Use the first variant's image, upgrade quality
    const firstBook = variants[0];
    const imageUrl = firstBook.image_url ? firstBook.image_url.replace('_SS60_', '_SS200_') : null;
    const author = firstBook.author || 'N/A';
    
    return `
      <div style="background: white; border: 1px solid var(--color-neutral-20); border-radius: var(--radius-medium); padding: var(--spacing-20); box-shadow: 0 1px 3px rgba(0,0,0,0.05); transition: box-shadow 0.2s;" onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,0.05)'">
        <div style="display: flex; gap: var(--spacing-20); margin-bottom: var(--spacing-16);">
          <!-- Book Image -->
          <div style="flex-shrink: 0; width: 90px; height: 135px; background: var(--color-neutral-10); border-radius: var(--radius-small); overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
            ${imageUrl
              ? `<img src="${imageUrl}" alt="${title}" style="width: 100%; height: 100%; object-fit: cover;">` 
              : `<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--color-neutral-40)" stroke-width="2" style="margin: 48px auto; display: block;"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>`
            }
          </div>

          <!-- Book Info & Variants -->
          <div style="flex: 1; min-width: 0;">
            <!-- Title & Author -->
            <h3 style="margin: 0 0 var(--spacing-4) 0; font-size: 1rem; font-weight: 600; color: var(--color-neutral-90); line-height: 1.3;">
              ${title}
            </h3>
            <div style="font-size: 0.8125rem; color: var(--color-neutral-60); margin-bottom: var(--spacing-12);">
              ${author} • ${variants.length} format${variants.length > 1 ? 's' : ''}
            </div>

            <!-- Variants Table -->
            <div style="border: 1px solid var(--color-neutral-20); border-radius: var(--radius-small); overflow: hidden;">
              ${variants.map((book, idx) => {
                const price = book.price ? `${book.price.currency} ${book.price.amount.toFixed(2)}` : 'N/A';
                const royaltyAmount = book.royalties?.amount || 0;
                const royaltyCurrency = book.royalties?.currency || (book.price?.currency || 'USD');
                
                // Calculate metrics if royalties and price are available
                const bookPrice = book.price?.amount || 0;
                const hasMetrics = royaltyAmount > 0 && bookPrice > 0;
                const breakEvenAcos = hasMetrics ? calculateBreakEvenAcos(bookPrice, royaltyAmount) : 0;
                const profitMargin = hasMetrics ? calculateProfitMargin(bookPrice, royaltyAmount) : 0;
                const targetAcos = hasMetrics ? calculateTargetAcos(bookPrice, royaltyAmount) : 0;
                
                return `
                  <div style="background: ${idx % 2 === 0 ? 'white' : 'var(--color-neutral-05)'}; border-top: ${idx > 0 ? '1px solid var(--color-neutral-20)' : 'none'};">
                    <div style="display: grid; grid-template-columns: 100px 120px 100px 140px 1fr; gap: var(--spacing-12); padding: var(--spacing-10) var(--spacing-12); align-items: center;">
                      <!-- Format Badge -->
                      <div>
                        ${book.format ? `<span style="display: inline-block; padding: 3px 10px; background: linear-gradient(135deg, var(--color-primary-60), var(--color-primary-70)); color: white; border-radius: 3px; font-size: 0.75rem; font-weight: 600; white-space: nowrap;">${book.format}</span>` : '<span style="color: var(--color-neutral-40); font-size: 0.75rem;">—</span>'}
                      </div>
                      
                      <!-- ASIN -->
                      <div style="font-size: 0.8125rem; color: var(--color-neutral-70); font-family: monospace;">
                        ${book.asin}
                      </div>
                      
                      <!-- Price -->
                      <div style="font-size: 0.8125rem; color: var(--color-neutral-70); font-weight: 500;">
                        ${price}
                      </div>
                      
                      <!-- Created Date -->
                      <div style="font-size: 0.75rem; color: var(--color-neutral-60);">
                        ${book.created_date || '—'}
                      </div>
                      
                      <!-- Royalties Input -->
                      <div style="display: flex; gap: var(--spacing-6); align-items: center;">
                        <input
                          type="number"
                          step="0.01"
                          min="0"
                          value="${royaltyAmount}"
                          data-book-index="${book.originalIndex}"
                          data-field="royalty-amount"
                          onchange="updateRoyalty(${book.originalIndex}, this.value, document.querySelector('[data-book-index=&quot;${book.originalIndex}&quot;][data-field=&quot;royalty-currency&quot;]').value)"
                          style="width: 80px; height: 28px; padding: 0 6px; border: 1px solid var(--color-neutral-30); border-radius: var(--radius-small); font-size: 0.8125rem;"
                          placeholder="0.00"
                        />
                        <select
                          data-book-index="${book.originalIndex}"
                          data-field="royalty-currency"
                          onchange="updateRoyalty(${book.originalIndex}, document.querySelector('[data-book-index=&quot;${book.originalIndex}&quot;][data-field=&quot;royalty-amount&quot;]').value, this.value)"
                          style="width: 60px; height: 28px; padding: 0 4px; border: 1px solid var(--color-neutral-30); border-radius: var(--radius-small); font-size: 0.8125rem; cursor: pointer;"
                        >
                          <option value="USD" ${royaltyCurrency === 'USD' ? 'selected' : ''}>USD</option>
                          <option value="EUR" ${royaltyCurrency === 'EUR' ? 'selected' : ''}>EUR</option>
                          <option value="GBP" ${royaltyCurrency === 'GBP' ? 'selected' : ''}>GBP</option>
                          <option value="CAD" ${royaltyCurrency === 'CAD' ? 'selected' : ''}>CAD</option>
                          <option value="AUD" ${royaltyCurrency === 'AUD' ? 'selected' : ''}>AUD</option>
                          <option value="JPY" ${royaltyCurrency === 'JPY' ? 'selected' : ''}>JPY</option>
                        </select>
                      </div>
                    </div>
                    
                    <!-- Metrics Row (only shown when royalties are set) -->
                    ${hasMetrics ? `
                      <div style="padding: var(--spacing-8) var(--spacing-12); display: flex; gap: var(--spacing-12); border-top: 1px dashed var(--color-neutral-20);">
                        <div style="flex: 1; display: flex; align-items: center; gap: var(--spacing-6);">
                          <span style="font-size: 0.6875rem; color: var(--color-neutral-60); text-transform: uppercase; font-weight: 600;">Break-even ACoS:</span>
                          <span style="font-size: 0.75rem; color: var(--color-neutral-90); font-weight: 700; padding: 2px 8px; background: linear-gradient(135deg, #FFE5E5, #FFD5D5); border-radius: 3px;">${breakEvenAcos.toFixed(2)}%</span>
                        </div>
                        <div style="flex: 1; display: flex; align-items: center; gap: var(--spacing-6);">
                          <span style="font-size: 0.6875rem; color: var(--color-neutral-60); text-transform: uppercase; font-weight: 600;">Profit Margin:</span>
                          <span style="font-size: 0.75rem; color: var(--color-neutral-90); font-weight: 700; padding: 2px 8px; background: linear-gradient(135deg, #E5F5FF, #D5EBFF); border-radius: 3px;">${profitMargin.toFixed(2)}%</span>
                        </div>
                        <div style="flex: 1; display: flex; align-items: center; gap: var(--spacing-6);">
                          <span style="font-size: 0.6875rem; color: var(--color-neutral-60); text-transform: uppercase; font-weight: 600;">Target ACoS:</span>
                          <span style="font-size: 0.75rem; color: white; font-weight: 700; padding: 2px 8px; background: linear-gradient(135deg, #00C2A8, #00A890); border-radius: 3px;">${targetAcos.toFixed(2)}%</span>
                        </div>
                      </div>
                    ` : ''}
                  </div>
                `;
              }).join('')}
            </div>
          </div>
        </div>
      </div>
    `;
  }).join('');
}

// Update royalty for a specific book
function updateRoyalty(index, amount, currency) {
  const amountValue = parseFloat(amount) || 0;
  
  if (currentBooksData[index]) {
    currentBooksData[index].royalties = {
      amount: amountValue,
      currency: currency
    };
    
    // Re-render to update metrics in real-time
    renderBooksList();
  }
}

// Save all books with royalties
async function saveBooks() {
  if (!currentUserId || !currentKdpProfile) {
    showBooksError('Please load books first');
    return;
  }

  const saveBtn = document.getElementById('save-books-btn');
  const originalText = saveBtn.innerHTML;
  saveBtn.disabled = true;
  saveBtn.innerHTML = '💾 Saving...';

  try {
    // Prepare books data - ensure royalties are properly formatted
    const booksToSave = currentBooksData.map(book => {
      const bookData = {
        asin: book.asin,
        title: book.title,
        clean_title: book.clean_title,
        format: book.format,
        author: book.author,
        availability: book.availability,
        image_url: book.image_url,
        price: book.price,
        created_date: book.created_date,
        variation_list: book.variation_list
      };

      // Only include royalties if amount is positive
      if (book.royalties && book.royalties.amount > 0) {
        bookData.royalties = {
          amount: parseFloat(book.royalties.amount),
          currency: book.royalties.currency
        };
      }

      return bookData;
    });

    console.log('Saving books:', booksToSave);

    const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=save_books', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        user_id: String(currentUserId),
        kdp_profile: currentKdpProfile,
        books: booksToSave
      })
    });

    const data = await response.json();
    console.log('Save response:', data);

    if (!data.success) {
      throw new Error(data.data?.error || 'Failed to save books');
    }

    // Update current books data with saved data
    if (data.data && data.data.books) {
      currentBooksData = data.data.books.map(savedBook => {
        const currentBook = currentBooksData.find(b => b.asin === savedBook.asin);
        return {
          ...currentBook,
          ...savedBook
        };
      });
    }

    showBooksSuccess(`Successfully saved ${data.data.saved_count} book(s)`);
    renderBooksList(); // Refresh the list with updated data

  } catch (error) {
    console.error('Error saving books:', error);
    showBooksError(error.message || 'Failed to save books. Please try again.');
  } finally {
    saveBtn.disabled = false;
    saveBtn.innerHTML = originalText;
  }
}

// Show error message
function showBooksError(message) {
  const errorDiv = document.getElementById('books-error');
  const errorMsg = document.getElementById('books-error-message');
  errorMsg.textContent = message;
  errorDiv.style.display = 'block';
  
  // Hide success message
  document.getElementById('books-success').style.display = 'none';
  
  // Auto-hide after 5 seconds
  setTimeout(() => {
    errorDiv.style.display = 'none';
  }, 5000);
}

// Show success message
function showBooksSuccess(message) {
  const successDiv = document.getElementById('books-success');
  const successMsg = document.getElementById('books-success-message');
  successMsg.textContent = message;
  successDiv.style.display = 'block';
  
  // Hide error message
  document.getElementById('books-error').style.display = 'none';
  
  // Auto-hide after 3 seconds
  setTimeout(() => {
    successDiv.style.display = 'none';
  }, 3000);
}

// Populate books account dropdown when service is loaded
document.addEventListener('DOMContentLoaded', function() {
  const booksAccountSelect = document.getElementById('books-account');
  if (booksAccountSelect) {
    // Load KDP accounts for books dropdown
    (async function() {
      try {
        const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=get_kdp_accounts', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            user_id: currentUserId
          })
        });

        const data = await response.json();

        if (data.success && data.data && data.data.account_names) {
          const accounts = data.data.account_names;

          // Clear and populate account dropdown
          booksAccountSelect.innerHTML = '<option value="">Select an account...</option>';

          accounts.forEach(account => {
            const option = document.createElement('option');
            option.value = account;
            option.textContent = account;
            booksAccountSelect.appendChild(option);
          });

          // Enable the dropdown
          booksAccountSelect.disabled = false;
        } else {
          // No accounts found
          booksAccountSelect.innerHTML = '<option value="">No accounts found</option>';
          booksAccountSelect.disabled = true;
        }
      } catch (error) {
        console.error('Error loading accounts for books:', error);
        booksAccountSelect.innerHTML = '<option value="">Error loading accounts</option>';
        booksAccountSelect.disabled = true;
      }
    })();
  }

  // Populate pulse account dropdown
  const pulseAccountSelect = document.getElementById('pulse-kdp-account');
  if (pulseAccountSelect) {
    // Load KDP accounts for pulse dropdown
    (async function() {
      try {
        const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=get_kdp_accounts', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            user_id: currentUserId
          })
        });

        const data = await response.json();

        if (data.success && data.data && data.data.account_names) {
          const accounts = data.data.account_names;

          // Clear and populate account dropdown
          pulseAccountSelect.innerHTML = '<option value="">Select an account...</option>';

          accounts.forEach(account => {
            const option = document.createElement('option');
            option.value = account;
            option.textContent = account;
            pulseAccountSelect.appendChild(option);
          });

          // Enable the dropdown
          pulseAccountSelect.disabled = false;
        } else {
          // No accounts found
          pulseAccountSelect.innerHTML = '<option value="">No accounts found</option>';
          pulseAccountSelect.disabled = true;
        }
      } catch (error) {
        console.error('Error loading accounts for pulse:', error);
        pulseAccountSelect.innerHTML = '<option value="">Error loading accounts</option>';
        pulseAccountSelect.disabled = true;
      }
    })();
  }

  // Pulse form submission handler
  const pulseForm = document.getElementById('pulse-filters-form');
  if (pulseForm) {
    pulseForm.addEventListener('submit', async function(e) {
      e.preventDefault();
      
      const account = document.getElementById('pulse-kdp-account').value;
      const region = document.getElementById('pulse-region').value;

      if (!account || !region) {
        alert('Please select both account and region');
        return;
      }

      const kdpProfile = `${account}-${region}`;

      console.log('Analyzing money wasters for:', {
        user_id: String(currentUserId),
        kdp_profile: kdpProfile
      });

      // Load account summary first
      loadPulseAccountSummary(String(currentUserId), kdpProfile, userLanguage);

      // Load spend effectiveness
      loadPulseSpendEffectiveness(String(currentUserId), kdpProfile, userLanguage);

      // Show loading state
      document.getElementById('pulse-loading').style.display = 'block';
      document.getElementById('pulse-empty-state').style.display = 'none';
      document.getElementById('pulse-results').style.display = 'none';

      try {
        const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=pulse_money_wasters', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            user_id: String(currentUserId),
            kdp_profile: kdpProfile
          })
        });

        const data = await response.json();
        console.log('Money wasters response:', data);

        // Hide loading
        document.getElementById('pulse-loading').style.display = 'none';

        if (!data.success) {
          throw new Error(data.data?.error || 'Failed to load money wasters');
        }

        const responseData = data.data || {};
        const moneyWasters = responseData.data || [];
        const totals = responseData.totals || {};

        if (moneyWasters.length === 0) {
          // Show empty state
          document.getElementById('pulse-empty-state').style.display = 'block';
          document.getElementById('pulse-results-count').textContent = '0 terms';
        } else {
          // Show results
          document.getElementById('pulse-results').style.display = 'block';
          document.getElementById('pulse-results-count').textContent = `${moneyWasters.length} term${moneyWasters.length !== 1 ? 's' : ''}`;
          
          // Populate table
          populateMoneyWastersTable(moneyWasters);
          
          // Display totals breakdown
          displayMoneyWastersTotals(totals);
        }

      } catch (error) {
        console.error('Error loading money wasters:', error);
        document.getElementById('pulse-loading').style.display = 'none';
        document.getElementById('pulse-empty-state').style.display = 'block';
        alert(error.message || 'Failed to analyze money wasters. Please try again.');
      }
    });
  }

  // Export button handler
  const pulseExportBtn = document.getElementById('pulse-export-btn');
  if (pulseExportBtn) {
    pulseExportBtn.addEventListener('click', exportMoneyWastersCSV);
  }
});

// Function to display money wasters totals
function displayMoneyWastersTotals(totals) {
  const container = document.getElementById('pulse-totals-breakdown');
  if (!container) return;

  const accountTotal = totals.account_total || 0;
  const byCampaign = totals.by_campaign || [];

  // Format currency
  const formatCurrency = (value) => {
    return new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'USD',
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }).format(value || 0);
  };

  let html = `
    <div style="margin-bottom: var(--spacing-16);">
      <h3 style="font-size: 1.125rem; font-weight: 700; color: #FF6B6B; margin: 0 0 var(--spacing-8) 0; display: flex; align-items: center; gap: var(--spacing-8);">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"></circle>
          <line x1="12" y1="8" x2="12" y2="12"></line>
          <line x1="12" y1="16" x2="12.01" y2="16"></line>
        </svg>
        Total Money Wasted on Zero-Sale Search Terms
      </h3>
      <div style="font-size: 2rem; font-weight: 700; color: #FF6B6B; margin-bottom: var(--spacing-4);">${formatCurrency(accountTotal)}</div>
      <p style="font-size: 0.875rem; color: var(--color-neutral-60); margin: 0;">This is the total amount spent on search terms that generated zero sales across all campaigns.</p>
    </div>
  `;

  if (byCampaign.length > 0) {
    html += `
      <div style="margin-top: var(--spacing-24);">
        <h4 style="font-size: 0.875rem; font-weight: 700; color: var(--color-neutral-70); text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 var(--spacing-12) 0;">Breakdown by Campaign</h4>
        <div style="display: flex; flex-direction: column; gap: var(--spacing-12);">
    `;

    byCampaign.forEach(campaign => {
      const percentage = accountTotal > 0 ? ((campaign.total_wasted / accountTotal) * 100).toFixed(1) : 0;
      const barWidth = percentage;
      
      html += `
        <div style="background: white; border-radius: var(--radius-small); padding: var(--spacing-12); box-shadow: var(--shadow-low);">
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spacing-8);">
            <div style="font-size: 0.9375rem; font-weight: 600; color: var(--color-neutral-90); flex: 1; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="${campaign.campaign_name}">
              ${campaign.campaign_name}
            </div>
            <div style="font-size: 1rem; font-weight: 700; color: #FF6B6B; margin-left: var(--spacing-16);">${formatCurrency(campaign.total_wasted)}</div>
          </div>
          <div style="display: flex; align-items: center; gap: var(--spacing-8);">
            <div style="flex: 1; background: #FFE5E5; border-radius: var(--radius-full); height: 8px; overflow: hidden;">
              <div style="background: #FF6B6B; height: 100%; width: ${barWidth}%; transition: width 0.3s ease;"></div>
            </div>
            <div style="font-size: 0.75rem; font-weight: 600; color: var(--color-neutral-60); min-width: 45px; text-align: right;">${percentage}%</div>
          </div>
        </div>
      `;
    });

    html += `
        </div>
      </div>
    `;
  }

  container.innerHTML = html;
  container.style.display = 'block';

  // Store account total for use in account summary
  window.pulseMoneyWastedTotal = accountTotal;
  
  // Update account summary metric if it exists
  updateMoneyWastedMetric(accountTotal);
}

// Function to populate the money wasters table with grouped display
function populateMoneyWastersTable(data) {
  const tbody = document.getElementById('pulse-table-body');
  tbody.innerHTML = '';

  // Group data by campaign and ad group
  const grouped = {};
  
  data.forEach(item => {
    const campaignKey = `${item.campaign_id}_${item.campaign_name}`;
    const adGroupKey = `${item.ad_group_id}_${item.ad_group_name}`;
    
    if (!grouped[campaignKey]) {
      grouped[campaignKey] = {
        campaign_id: item.campaign_id,
        campaign_name: item.campaign_name,
        adGroups: {}
      };
    }
    
    if (!grouped[campaignKey].adGroups[adGroupKey]) {
      grouped[campaignKey].adGroups[adGroupKey] = {
        ad_group_id: item.ad_group_id,
        ad_group_name: item.ad_group_name,
        terms: []
      };
    }
    
    grouped[campaignKey].adGroups[adGroupKey].terms.push(item);
  });

  // Sort terms within each ad group by cost (descending)
  Object.values(grouped).forEach(campaign => {
    Object.values(campaign.adGroups).forEach(adGroup => {
      adGroup.terms.sort((a, b) => (b.cost || 0) - (a.cost || 0));
    });
  });

  // Format currency
  const formatCurrency = (value) => {
    return new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'USD',
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }).format(value || 0);
  };

  // Format numbers
  const formatNumber = (value) => {
    return new Intl.NumberFormat('en-US').format(value || 0);
  };

  // Render grouped data
  Object.values(grouped).forEach((campaign, campaignIndex) => {
    const campaignId = `campaign-${campaign.campaign_id}`;
    
    // Campaign header row (collapsible)
    const campaignHeaderRow = document.createElement('tr');
    campaignHeaderRow.style.background = 'linear-gradient(135deg, #E8F5F3, #D1EBE6)';
    campaignHeaderRow.style.borderTop = campaignIndex > 0 ? '2px solid var(--color-primary-40)' : '1px solid var(--color-neutral-20)';
    campaignHeaderRow.style.borderBottom = '1px solid var(--color-primary-30)';
    campaignHeaderRow.style.cursor = 'pointer';
    campaignHeaderRow.style.transition = 'background 0.2s';
    campaignHeaderRow.dataset.campaignId = campaignId;
    campaignHeaderRow.dataset.expanded = 'true';
    
    campaignHeaderRow.onmouseover = function() { 
      this.style.background = 'linear-gradient(135deg, #D1EBE6, #B8E0D8)'; 
    };
    campaignHeaderRow.onmouseout = function() { 
      this.style.background = 'linear-gradient(135deg, #E8F5F3, #D1EBE6)'; 
    };
    
    campaignHeaderRow.innerHTML = `
      <td colspan="6" style="padding: 14px 16px; font-weight: 700; font-size: 1rem; color: var(--color-primary-80);">
        <div style="display: flex; align-items: center; gap: var(--spacing-12);">
          <svg class="collapse-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="transition: transform 0.2s;">
            <polyline points="6 9 12 15 18 9"></polyline>
          </svg>
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="9" y1="3" x2="9" y2="21"></line>
          </svg>
          <span>Campaign: ${campaign.campaign_name}</span>
          <span style="font-size: 0.75rem; font-weight: 500; color: var(--color-neutral-60); margin-left: auto;">ID: ${campaign.campaign_id}</span>
        </div>
      </td>
    `;
    
    // Add click handler to toggle campaign
    campaignHeaderRow.onclick = function() {
      const isExpanded = this.dataset.expanded === 'true';
      this.dataset.expanded = !isExpanded;
      const icon = this.querySelector('.collapse-icon');
      icon.style.transform = isExpanded ? 'rotate(-90deg)' : 'rotate(0deg)';
      
      // Toggle all ad groups and terms for this campaign
      const allRows = tbody.querySelectorAll(`[data-parent-campaign="${campaignId}"]`);
      allRows.forEach(row => {
        row.style.display = isExpanded ? 'none' : '';
      });
    };
    
    tbody.appendChild(campaignHeaderRow);

    // Ad groups within campaign
    Object.values(campaign.adGroups).forEach((adGroup, adGroupIndex) => {
      const adGroupId = `adgroup-${campaign.campaign_id}-${adGroup.ad_group_id}`;
      
      // Ad group header row (collapsible)
      const adGroupHeaderRow = document.createElement('tr');
      adGroupHeaderRow.dataset.parentCampaign = campaignId;
      adGroupHeaderRow.dataset.adGroupId = adGroupId;
      adGroupHeaderRow.dataset.expanded = 'true';
      adGroupHeaderRow.style.background = 'linear-gradient(to right, #F7FCFB, #FFFFFF)';
      adGroupHeaderRow.style.borderBottom = '2px solid var(--color-primary-20)';
      adGroupHeaderRow.style.cursor = 'pointer';
      adGroupHeaderRow.style.transition = 'all 0.2s';
      
      adGroupHeaderRow.onmouseover = function() { 
        this.style.background = 'linear-gradient(to right, #E8F5F3, #F7FCFB)'; 
      };
      adGroupHeaderRow.onmouseout = function() { 
        this.style.background = 'linear-gradient(to right, #F7FCFB, #FFFFFF)'; 
      };
      
      adGroupHeaderRow.innerHTML = `
        <td colspan="6" style="padding: 12px 16px 12px 40px; font-weight: 600; font-size: 0.9375rem; color: var(--color-neutral-80);">
          <div style="display: flex; align-items: center; gap: var(--spacing-10);">
            <svg class="collapse-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="transition: transform 0.2s;">
              <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="3" width="7" height="7"></rect>
              <rect x="14" y="3" width="7" height="7"></rect>
              <rect x="14" y="14" width="7" height="7"></rect>
              <rect x="3" y="14" width="7" height="7"></rect>
            </svg>
            <span>Ad Group: ${adGroup.ad_group_name}</span>
            <span style="font-size: 0.75rem; font-weight: 400; color: var(--color-neutral-60); margin-left: auto;">${adGroup.terms.length} term${adGroup.terms.length !== 1 ? 's' : ''}</span>
          </div>
        </td>
      `;
      
      // Add click handler to toggle ad group
      adGroupHeaderRow.onclick = function(e) {
        e.stopPropagation(); // Prevent campaign toggle
        const isExpanded = this.dataset.expanded === 'true';
        this.dataset.expanded = !isExpanded;
        const icon = this.querySelector('.collapse-icon');
        icon.style.transform = isExpanded ? 'rotate(-90deg)' : 'rotate(0deg)';
        
        // Toggle all terms for this ad group
        const termRows = tbody.querySelectorAll(`[data-parent-adgroup="${adGroupId}"]`);
        termRows.forEach(row => {
          row.style.display = isExpanded ? 'none' : '';
        });
      };
      
      tbody.appendChild(adGroupHeaderRow);

      // Table column headers (appears after each ad group header)
      const columnHeaderRow = document.createElement('tr');
      columnHeaderRow.dataset.parentCampaign = campaignId;
      columnHeaderRow.dataset.parentAdgroup = adGroupId;
      columnHeaderRow.style.background = 'var(--color-primary-10)';
      columnHeaderRow.style.borderBottom = '2px solid var(--color-primary-30)';
      columnHeaderRow.innerHTML = `
        <th style="padding: 12px 16px 12px 64px; text-align: left; font-weight: 700; font-size: 0.8125rem; color: var(--color-primary-80); text-transform: uppercase; letter-spacing: 0.5px;">Search Term</th>
        <th style="padding: 12px 16px; text-align: left; font-weight: 700; font-size: 0.8125rem; color: var(--color-primary-80); text-transform: uppercase; letter-spacing: 0.5px;">Keyword</th>
        <th style="padding: 12px 16px; text-align: left; font-weight: 700; font-size: 0.8125rem; color: var(--color-primary-80); text-transform: uppercase; letter-spacing: 0.5px;">Match Type</th>
        <th style="padding: 12px 16px; text-align: right; font-weight: 700; font-size: 0.8125rem; color: var(--color-primary-80); text-transform: uppercase; letter-spacing: 0.5px;">Impressions</th>
        <th style="padding: 12px 16px; text-align: right; font-weight: 700; font-size: 0.8125rem; color: var(--color-primary-80); text-transform: uppercase; letter-spacing: 0.5px;">Clicks</th>
        <th style="padding: 12px 16px; text-align: right; font-weight: 700; font-size: 0.8125rem; color: #FF6B6B; text-transform: uppercase; letter-spacing: 0.5px;">Cost</th>
      `;
      tbody.appendChild(columnHeaderRow);

      // Search terms rows
      adGroup.terms.forEach((item, termIndex) => {
        const row = document.createElement('tr');
        row.dataset.parentCampaign = campaignId;
        row.dataset.parentAdgroup = adGroupId;
        row.style.borderBottom = '1px solid var(--color-neutral-20)';
        row.style.background = 'white';
        row.style.transition = 'background 0.2s';
        row.onmouseover = function() { this.style.background = 'var(--color-neutral-05)'; };
        row.onmouseout = function() { this.style.background = 'white'; };

        // Format keyword display - handle ASIN targeting
        const keywordText = item.keyword_text || 'N/A';
        const isAsinTargeting = keywordText.includes('asin=');
        const displayKeyword = isAsinTargeting ? keywordText.replace(/asin="([^"]+)"/g, 'ASIN: $1') : keywordText;
        
        // Format match type
        const matchType = item.keyword_type || 'N/A';
        const displayMatchType = matchType === 'TARGETING_EXPRESSION' ? 'Product Targeting' : matchType;
        
        row.innerHTML = `
          <td style="padding: 14px 16px 14px 64px; font-weight: 500; color: var(--color-neutral-90); font-size: 0.9375rem;">${item.search_term || 'N/A'}</td>
          <td style="padding: 14px 16px; font-weight: 400; color: var(--color-neutral-70); font-size: 0.875rem; font-family: monospace;">${displayKeyword}</td>
          <td style="padding: 14px 16px; font-weight: 400; color: var(--color-neutral-70); font-size: 0.875rem;">${displayMatchType}</td>
          <td style="padding: 14px 16px; text-align: right; color: var(--color-neutral-70); font-size: 0.9375rem;">${formatNumber(item.impressions)}</td>
          <td style="padding: 14px 16px; text-align: right; color: var(--color-neutral-70); font-size: 0.9375rem;">${formatNumber(item.clicks)}</td>
          <td style="padding: 14px 16px; text-align: right; font-weight: 700; color: #FF6B6B; font-size: 0.9375rem;">${formatCurrency(item.cost)}</td>
        `;

        tbody.appendChild(row);
      });
    });
  });
}

// Function to add negative keyword (placeholder)
function addNegativeKeyword(searchTerm, campaignId, adGroupId) {
  console.log('Add negative keyword:', { searchTerm, campaignId, adGroupId });
  alert(`This feature will block the search term: "${searchTerm}"\nCampaign ID: ${campaignId}\nAd Group ID: ${adGroupId}\n\nFunctionality coming soon!`);
}

// Function to export money wasters as CSV (placeholder)
function exportMoneyWastersCSV() {
  console.log('Export money wasters as CSV');
  alert('CSV export functionality coming soon!');
}

// Global variable for effectiveness chart
let effectivenessChart = null;

// Load Account Summary
async function loadPulseAccountSummary(userId, kdpProfile, language, dateFrom = null, dateTo = null) {
  if (!userId || !kdpProfile) {
    console.error('User ID and KDP Profile are required');
    return;
  }

  // Show loading state
  jQuery('#pulse-account-summary').show();
  jQuery('#pulse-account-summary-error').hide();
  jQuery('#pulse-account-summary-content').show();
  jQuery('#pulse-date-range').text('Loading...');
  jQuery('#pulse-efficiency-trend, #pulse-cost-pressure, #pulse-growth-constraint').text('Loading...');
  jQuery('[id^="pulse-metric-"]').text('—');

  const requestData = {
    user_id: userId,
    kdp_profile: kdpProfile,
    language: language || 'EN'
  };

  if (dateFrom) requestData.date_from = dateFrom;
  if (dateTo) requestData.date_to = dateTo;

  try {
    const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=pulse_account_summary', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(requestData)
    });

    const data = await response.json();
    console.log('Account summary response:', data);

    if (!data.success) {
      throw new Error(data.data?.error || 'Failed to load account summary');
    }

    displayPulseAccountSummary(data.data);

  } catch (error) {
    console.error('Error loading account summary:', error);
    // Show error state
    jQuery('#pulse-account-summary').show();
    jQuery('#pulse-account-summary-content').hide();
    jQuery('#pulse-account-summary-error').show();
    
    // Set error message
    const errorMessage = error.message || 'Unable to load account summary data.';
    jQuery('#pulse-account-summary-error-message').text(errorMessage);
  }
}

// Display Account Summary Data
function displayPulseAccountSummary(data) {
  // Display date range
  if (data.meta && data.meta.date_from && data.meta.date_to) {
    const dateFrom = new Date(data.meta.date_from).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
    const dateTo = new Date(data.meta.date_to).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
    jQuery('#pulse-date-range').text(`${dateFrom} - ${dateTo}`);
  }

  // Display optimization runs count if available and > 0
  if (data.meta && data.meta.optimization_runs && data.meta.optimization_runs > 0) {
    const runCount = data.meta.optimization_runs;
    const runText = runCount === 1 ? '1 optimization run' : `${runCount} optimization runs`;
    jQuery('#pulse-optimization-runs').text(runText).show();
  } else {
    jQuery('#pulse-optimization-runs').hide();
  }

  // Display status cards
  if (data.cards) {
    // Efficiency Trend
    const efficiencyText = data.cards.efficiency_trend?.text || data.cards.efficiency_trend || 'N/A';
    const efficiencySentiment = data.cards.efficiency_trend?.sentiment || 0;
    jQuery('#pulse-efficiency-trend').text(efficiencyText);
    
    // Cost Pressure
    const costPressureText = data.cards.cost_pressure?.text || data.cards.cost_pressure || 'N/A';
    const costPressureSentiment = data.cards.cost_pressure?.sentiment || 0;
    jQuery('#pulse-cost-pressure').text(costPressureText);
    
    // Growth Constraint
    const growthConstraintText = data.cards.growth_constraint?.text || data.cards.growth_constraint || 'N/A';
    const growthConstraintSentiment = data.cards.growth_constraint?.sentiment || 0;
    jQuery('#pulse-growth-constraint').text(growthConstraintText);
    
    // Apply sentiment-based styling
    applySentimentStyling('#pulse-efficiency-trend', efficiencySentiment);
    applySentimentStyling('#pulse-cost-pressure', costPressureSentiment);
    applySentimentStyling('#pulse-growth-constraint', growthConstraintSentiment);
  }

  // Display metrics
  if (data.totals) {
    const totals = data.totals;
    
    // Format numbers with thousands separators
    const formatNumber = (num) => {
      return num !== null && num !== undefined ? Number(num).toLocaleString('en-US', { maximumFractionDigits: 0 }) : '—';
    };

    // Format currency
    const formatCurrency = (num) => {
      return num !== null && num !== undefined ? '$' + Number(num).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : '—';
    };

    // Format percentage
    const formatPercentage = (num) => {
      return num !== null && num !== undefined ? Number(num).toFixed(2) + '%' : '—';
    };

    // Format ratio
    const formatRatio = (num) => {
      return num !== null && num !== undefined ? Number(num).toFixed(2) + 'x' : '—';
    };

    jQuery('#pulse-metric-impressions').text(formatNumber(totals.impressions));
    jQuery('#pulse-metric-clicks').text(formatNumber(totals.clicks));
    jQuery('#pulse-metric-cost').text(formatCurrency(totals.cost));
    jQuery('#pulse-metric-cpc').text(formatCurrency(totals.cpc));
    jQuery('#pulse-metric-sales').text(formatCurrency(totals.sales));
    jQuery('#pulse-metric-acos').text(formatPercentage(totals.acos));
    jQuery('#pulse-metric-roas').text(formatRatio(totals.roas));
  }
  
  // Update money wasted metric if available
  if (window.pulseMoneyWastedTotal !== undefined) {
    updateMoneyWastedMetric(window.pulseMoneyWastedTotal);
  }
}

// Update Money Wasted Metric
function updateMoneyWastedMetric(amount) {
  const formatCurrency = (num) => {
    return num !== null && num !== undefined ? '$' + Number(num).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : '—';
  };
  
  const metricElement = document.getElementById('pulse-metric-money-wasted');
  if (metricElement) {
    metricElement.textContent = formatCurrency(amount);
  }
}

// Load Spend Effectiveness
async function loadPulseSpendEffectiveness(userId, kdpProfile, language) {
  if (!userId || !kdpProfile) {
    console.error('User ID and KDP Profile are required');
    return;
  }

  // Show section
  jQuery('#pulse-spend-effectiveness').show();

  const requestData = {
    user_id: userId,
    kdp_profile: kdpProfile,
    language: language || 'EN'
  };

  try {
    const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=pulse_spend_effectiveness', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(requestData)
    });

    const data = await response.json();
    console.log('Spend effectiveness response:', data);

    if (!data.success) {
      throw new Error(data.data?.error || 'Failed to load spend effectiveness');
    }

    displayPulseSpendEffectiveness(data.data);

  } catch (error) {
    console.error('Error loading spend effectiveness:', error);
    jQuery('#pulse-spend-effectiveness').hide();
  }
}

// Display Spend Effectiveness Data
function displayPulseSpendEffectiveness(data) {
  if (!data) return;

  // Format currency helper
  const formatCurrency = (num) => {
    return num !== null && num !== undefined ? '$' + Number(num).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : '—';
  };

  // Format percentage helper
  const formatPercentage = (num) => {
    return num !== null && num !== undefined ? Number(num).toFixed(2) + '%' : '—';
  };

  // Display effectiveness text with sentiment
  if (data.effectiveness) {
    const effectivenessText = data.effectiveness.text || 'N/A';
    const sentiment = data.effectiveness.sentiment || 0;
    
    jQuery('#pulse-effectiveness-text').text(effectivenessText);
    applySentimentStyling('#pulse-effectiveness-text', sentiment);
  }

  // Create/update pie chart
  if (data.breakdown) {
    const ctx = document.getElementById('pulse-effectiveness-chart').getContext('2d');
    
    // Destroy existing chart if it exists
    if (effectivenessChart) {
      effectivenessChart.destroy();
    }

    const costWithSales = data.breakdown.cost_with_sales || 0;
    const costNoSales = data.breakdown.cost_no_sales || 0;

    const total = costWithSales + costNoSales;
    const salesSharePercent = total > 0 ? ((costWithSales / total) * 100).toFixed(1) : 0;
    const noSalesSharePercent = total > 0 ? ((costNoSales / total) * 100).toFixed(1) : 0;

    effectivenessChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Sales Share', 'No Sales Share'],
        datasets: [{
          data: [costWithSales, costNoSales],
          backgroundColor: ['#4CAF50', '#FF6B6B'],
          borderColor: ['#fff', '#fff'],
          borderWidth: 3
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          legend: {
            position: 'bottom',
            align: 'center',
            labels: {
              padding: 12,
              font: {
                size: 13,
                weight: '600'
              },
              color: '#424242',
              boxWidth: 15,
              boxHeight: 15,
              usePointStyle: false
            }
          },
          tooltip: {
            backgroundColor: 'rgba(0, 0, 0, 0.8)',
            padding: 12,
            titleFont: { size: 13, weight: 'bold' },
            bodyFont: { size: 12 },
            callbacks: {
              label: function(context) {
                const label = context.label || '';
                const value = context.parsed;
                const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                return `${label}: $${value.toFixed(2)} (${percentage}%)`;
              }
            }
          },
          datalabels: {
            color: '#fff',
            font: {
              size: 18,
              weight: 'bold'
            },
            formatter: function(value, context) {
              const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
              return percentage + '%';
            }
          }
        }
      },
      plugins: [ChartDataLabels]
    });
  }
}

// Apply sentiment-based styling to status cards
function applySentimentStyling(elementSelector, sentiment) {
  const element = jQuery(elementSelector);
  
  // Reset to default color
  element.css('color', 'var(--color-neutral-90)');
  
  if (sentiment === 1) {
    // Positive sentiment - green
    element.css('color', '#4CAF50');
    element.css('font-weight', '700');
  } else if (sentiment === -1) {
    // Negative sentiment - red
    element.css('color', '#F44336');
    element.css('font-weight', '700');
  } else {
    // Neutral - gray
    element.css('color', '#757575');
    element.css('font-weight', '600');
  }
}

</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>

<?php
get_footer();
?>

