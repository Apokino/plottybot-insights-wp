<?php
/* Template Name: Ads */
get_header();

// Check if user is logged in, if not redirect to login page
if (!is_user_logged_in()) {
    wp_redirect('https://plottybot.com/login');
    exit;
}

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

      <!-- Placeholder Nav Item 3 -->
      <button class="service-nav-btn" data-service="placeholder-3" <?php echo !$ads_enabled ? 'disabled' : ''; ?> style="width: 100%; padding: var(--spacing-20) var(--spacing-24); background: transparent; border: none; border-left: 4px solid transparent; color: var(--color-neutral-50); font-weight: 600; font-size: 1rem; cursor: <?php echo $ads_enabled ? 'pointer' : 'not-allowed'; ?>; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-align: left; display: flex; align-items: center; gap: var(--spacing-16); margin-bottom: var(--spacing-4); opacity: <?php echo $ads_enabled ? '1' : '0.5'; ?>;">
        <span style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: #E0E0E0; border-radius: var(--radius-small);">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--color-neutral-50)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="8" x2="12" y2="12"></line>
            <line x1="12" y1="16" x2="12.01" y2="16"></line>
          </svg>
        </span>
        <span>Placeholder Section 3</span>
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

              <form id="add-kdp-account-form">
                <div style="display: grid; gap: var(--spacing-24); margin-bottom: var(--spacing-24);">
                  <!-- User ID Input (Temporary) -->
                  <div>
                    <label for="kdp-user-id" style="display: block; margin-bottom: var(--spacing-8); color: var(--color-neutral-90); font-weight: 600; font-size: 0.875rem;">
                      User ID <span style="color: #FF6B6B;">*</span>
                    </label>
                    <input
                      type="text"
                      id="kdp-user-id"
                      name="user_id"
                      placeholder="Enter user ID"
                      required
                      style="width: 100%; padding: 14px 16px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); font-size: 1rem; transition: border-color 0.2s;"
                    />
                    <p id="user-id-error" style="margin: var(--spacing-8) 0 0 0; font-size: 0.875rem; color: #FF6B6B; display: none;"></p>
                    <p style="margin: var(--spacing-8) 0 0 0; font-size: 0.875rem; color: var(--color-neutral-60);">
                      ⚠️ Temporary field - will be auto-filled at login in the future
                    </p>
                  </div>

                  <!-- Authorization Code Input -->
                  <div>
                    <label for="kdp-auth-code" style="display: block; margin-bottom: var(--spacing-8); color: var(--color-neutral-90); font-weight: 600; font-size: 0.875rem;">
                      Authorization Code <span style="color: #FF6B6B;">*</span>
                    </label>
                    <input
                      type="text"
                      id="kdp-auth-code"
                      name="auth_code"
                      maxlength="20"
                      placeholder="Enter 20-character authorization code"
                      required
                      style="width: 100%; padding: 14px 16px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); font-size: 1rem; transition: border-color 0.2s; font-family: 'Courier New', monospace; letter-spacing: 1px;"
                    />
                    <p id="auth-code-error" style="margin: var(--spacing-8) 0 0 0; font-size: 0.875rem; color: #FF6B6B; display: none;"></p>
                    <p style="margin: var(--spacing-8) 0 0 0; font-size: 0.875rem; color: var(--color-neutral-60);">
                      Must be exactly 20 characters
                    </p>
                  </div>

                  <!-- Account Name Input -->
                  <div>
                    <label for="kdp-account-name" style="display: block; margin-bottom: var(--spacing-8); color: var(--color-neutral-90); font-weight: 600; font-size: 0.875rem;">
                      Account Name <span style="color: #FF6B6B;">*</span>
                    </label>
                    <input
                      type="text"
                      id="kdp-account-name"
                      name="account_name"
                      placeholder="e.g., my-main-account"
                      required
                      style="width: 100%; padding: 14px 16px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); font-size: 1rem; transition: border-color 0.2s;"
                    />
                    <p id="account-name-error" style="margin: var(--spacing-8) 0 0 0; font-size: 0.875rem; color: #FF6B6B; display: none;"></p>
                    <p style="margin: var(--spacing-8) 0 0 0; font-size: 0.875rem; color: var(--color-neutral-60);">
                      Only letters, numbers, and hyphens (-) allowed. No spaces.
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

            <!-- User ID Input -->
            <div style="background: var(--color-neutral-05); border-radius: var(--radius-medium); padding: var(--spacing-32); margin-bottom: var(--spacing-40);">
              <label for="schedule-user-id" style="display: block; margin-bottom: var(--spacing-8); color: var(--color-neutral-90); font-weight: 600; font-size: 0.875rem;">
                User ID <span style="color: #FF6B6B;">*</span>
              </label>
              <input
                type="text"
                id="schedule-user-id"
                placeholder="Enter user ID to view schedules"
                style="width: 100%; padding: 14px 16px; border: 2px solid var(--color-neutral-30); border-radius: var(--radius-medium); font-size: 1rem; transition: border-color 0.2s;"
              />
              <p style="margin: var(--spacing-8) 0 0 0; font-size: 0.875rem; color: var(--color-neutral-60);">
                ⚠️ Temporary field - will be auto-filled at login in the future
              </p>
            </div>

            <!-- Schedule New Optimization -->
            <div style="background: var(--color-neutral-05); border-radius: var(--radius-medium); padding: var(--spacing-24); margin-bottom: var(--spacing-40);">
              <h2 style="font-size: 1.125rem; font-weight: 700; color: var(--color-neutral-90); margin: 0 0 var(--spacing-20) 0; display: flex; align-items: center; gap: var(--spacing-8);">
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

    <!-- Placeholder Section 3 -->
    <div id="service-placeholder-3" class="service-section" style="display: none;">
      <div style="max-width: 1200px; margin: 0 auto;">
        <div style="background: var(--color-neutral-00); border: 1px solid var(--color-neutral-30); border-radius: var(--radius-large); box-shadow: 0 8px 32px rgba(0,0,0,0.06); padding: var(--spacing-40);">

          <!-- Header -->
          <div style="text-align: center; margin-bottom: var(--spacing-40);">
            <h1 class="text--heading-lg" style="color: var(--color-neutral-90); margin-bottom: var(--spacing-16);">
              💡 Placeholder Section 3
            </h1>
            <p class="text--body-lg" style="color: var(--color-neutral-70);">
              This is a placeholder section. Build your content here.
            </p>
          </div>

          <!-- Content Area -->
          <div style="padding: var(--spacing-32); background: var(--color-neutral-05); border-radius: var(--radius-medium); text-align: center;">
            <p style="color: var(--color-neutral-60); font-size: 1rem;">
              Content goes here...
            </p>
          </div>

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
document.addEventListener('DOMContentLoaded', function() {
  // Check if ads are enabled
  const adsEnabled = <?php echo $ads_enabled ? 'true' : 'false'; ?>;

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

  // KDP Account Form Validation and Submission
  const kdpForm = document.getElementById('add-kdp-account-form');
  const authCodeInput = document.getElementById('kdp-auth-code');
  const accountNameInput = document.getElementById('kdp-account-name');
  const userIdInput = document.getElementById('kdp-user-id');
  const authCodeError = document.getElementById('auth-code-error');
  const accountNameError = document.getElementById('account-name-error');
  const userIdError = document.getElementById('user-id-error');
  const submitButton = document.getElementById('submit-kdp-account');
  const submitButtonText = document.getElementById('submit-button-text');

  if (kdpForm) {
    // Real-time validation for user ID
    userIdInput.addEventListener('input', function() {
      const value = this.value.trim();

      if (value.length > 0) {
        this.style.borderColor = '#00C2A8';
        userIdError.style.display = 'none';
      } else {
        this.style.borderColor = 'var(--color-neutral-30)';
      }
    });

    // Load accounts when user ID changes (after user stops typing)
    let userIdTimeout;
    userIdInput.addEventListener('input', function() {
      const userId = this.value.trim();

      clearTimeout(userIdTimeout);

      if (userId.length > 0) {
        userIdTimeout = setTimeout(() => {
          loadKDPAccounts(userId);
        }, 500);
      }
    });

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

    // Real-time validation for account name
    accountNameInput.addEventListener('input', function() {
      let value = this.value;

      // Remove any characters that aren't letters, numbers, or hyphens
      const cleanValue = value.replace(/[^a-zA-Z0-9-]/g, '');

      if (value !== cleanValue) {
        this.value = cleanValue;
        accountNameError.textContent = 'Removed invalid characters (only letters, numbers, and hyphens allowed)';
        accountNameError.style.display = 'block';
        setTimeout(() => {
          accountNameError.style.display = 'none';
        }, 3000);
      }

      if (cleanValue.length > 0) {
        this.style.borderColor = '#00C2A8';
      } else {
        this.style.borderColor = 'var(--color-neutral-30)';
      }
    });

    // Form submission
    kdpForm.addEventListener('submit', async function(e) {
      e.preventDefault();

      const authCode = authCodeInput.value.trim();
      const accountName = accountNameInput.value.trim();
      const userId = userIdInput.value.trim();

      // Validate user ID
      if (userId.length === 0) {
        userIdError.textContent = 'User ID is required';
        userIdError.style.display = 'block';
        userIdInput.focus();
        return;
      }

      // Validate authorization code
      if (authCode.length !== 20) {
        authCodeError.textContent = 'Authorization code must be exactly 20 characters';
        authCodeError.style.display = 'block';
        authCodeInput.focus();
        return;
      }

      // Validate account name
      if (accountName.length === 0) {
        accountNameError.textContent = 'Account name is required';
        accountNameError.style.display = 'block';
        accountNameInput.focus();
        return;
      }

      if (!/^[a-zA-Z0-9-]+$/.test(accountName)) {
        accountNameError.textContent = 'Account name can only contain letters, numbers, and hyphens';
        accountNameError.style.display = 'block';
        accountNameInput.focus();
        return;
      }

      // Show loading state
      submitButton.disabled = true;
      submitButtonText.textContent = 'Adding Account...';
      submitButton.style.opacity = '0.7';

      try {
        // Call AJAX endpoint to add KDP profile
        const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=add_kdp_profile', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            user_id: userId,
            account_name: accountName,
            auth_code: authCode
          })
        });

        const data = await response.json();

        if (data.success) {
          // Success - clear form (but keep user ID)
          const currentUserId = userIdInput.value;
          kdpForm.reset();
          userIdInput.value = currentUserId;
          authCodeInput.style.borderColor = 'var(--color-neutral-30)';
          accountNameInput.style.borderColor = 'var(--color-neutral-30)';
          userIdInput.style.borderColor = '#00C2A8';

          // Show success message
          const successMessage = document.createElement('div');
          successMessage.style.cssText = 'position: fixed; top: 20px; right: 20px; background: #00C2A8; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 1000; animation: slideInRight 0.3s ease;';
          successMessage.textContent = `✓ Account "${accountName}" added successfully!`;
          document.body.appendChild(successMessage);

          setTimeout(() => {
            successMessage.remove();
          }, 3000);

          // Reload accounts list
          loadKDPAccounts(userId);
        } else {
          // Error from API
          authCodeError.textContent = data.data?.message || 'Failed to add account. Please try again.';
          authCodeError.style.display = 'block';
        }

      } catch (error) {
        authCodeError.textContent = 'Failed to add account. Please check your connection and try again.';
        authCodeError.style.display = 'block';
      } finally {
        submitButton.disabled = false;
        submitButtonText.textContent = 'Add KDP Account';
        submitButton.style.opacity = '1';
      }
    });
  }

  // Load KDP Accounts
  async function loadKDPAccounts(userId) {
    const loadingEl = document.getElementById('kdp-accounts-loading');
    const emptyEl = document.getElementById('kdp-accounts-empty');
    const listEl = document.getElementById('kdp-accounts-list');

    if (!loadingEl || !emptyEl || !listEl) return;

    // If no user ID provided, show prompt to enter user ID
    if (!userId) {
      loadingEl.style.display = 'none';
      emptyEl.style.display = 'block';
      emptyEl.innerHTML = '<p style="color: var(--color-neutral-60);">Please enter a User ID above to view KDP accounts</p>';
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
                <h3 style="margin: 0 0 var(--spacing-8) 0; font-size: 1.125rem; font-weight: 700; color: var(--color-neutral-90);">
                  ${accountName}
                </h3>
                <p style="margin: 0; font-size: 0.875rem; color: var(--color-neutral-60);">
                  User ID: ${userId}
                </p>
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
      } else {
        throw new Error(data.data?.message || 'Failed to load accounts');
      }
    } catch (error) {
      console.error('Error loading accounts:', error);
      loadingEl.style.display = 'none';
      emptyEl.style.display = 'block';
      emptyEl.innerHTML = '<p style="color: #FF6B6B;">Failed to load accounts. Please try again.</p>';
    }
  }

  // Show initial empty state on page load
  if (document.getElementById('kdp-accounts-list')) {
    loadKDPAccounts(null);
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

  function switchService(targetService) {
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
      switchService(service);
    });
  });

  // ============================================
  // OPTIMIZATION SCHEDULE SECTION
  // ============================================

  // Global variables to store current schedules and accounts data
  let currentSchedulesData = null;
  let currentAccountsData = null;

  // Schedule User ID Input
  const scheduleUserIdInput = document.getElementById('schedule-user-id');

  if (scheduleUserIdInput) {
    // Load schedules when user ID changes (after user stops typing)
    let scheduleUserIdTimeout;
    scheduleUserIdInput.addEventListener('input', function() {
      const userId = this.value.trim();

      clearTimeout(scheduleUserIdTimeout);

      if (userId.length > 0) {
        this.style.borderColor = '#00C2A8';
        scheduleUserIdTimeout = setTimeout(() => {
          loadOptimizationSchedules(userId);
        }, 500);
      } else {
        this.style.borderColor = 'var(--color-neutral-30)';
      }
    });
  }

  // Load Optimization Schedules
  async function loadOptimizationSchedules(userId) {
    const loadingEl = document.getElementById('schedules-loading');
    const emptyEl = document.getElementById('schedules-empty');
    const listEl = document.getElementById('schedules-list');

    if (!loadingEl || !emptyEl || !listEl) return;

    // If no user ID provided, show prompt
    if (!userId) {
      loadingEl.style.display = 'none';
      emptyEl.style.display = 'block';
      emptyEl.innerHTML = '<p style="color: var(--color-neutral-60);">Please enter a User ID above to view schedules</p>';
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
      currentAccountsData = accountsData;
      currentSchedulesData = data;

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
                  <div style="display: flex; align-items: center; gap: var(--spacing-16); margin-bottom: var(--spacing-8);">
                    <h3 style="margin: 0; font-size: 1.5rem; font-weight: 700; color: var(--color-neutral-90);">
                      ${job.account_id}
                    </h3>
                    <span style="padding: 6px 16px; background: ${job.active ? '#E6F7F5' : '#FFE6E6'}; color: ${job.active ? '#00C2A8' : '#FF6B6B'}; border-radius: var(--radius-small); font-size: 0.875rem; font-weight: 700; text-transform: uppercase;">
                      ${job.active ? '✓ Active' : '✗ Inactive'}
                    </span>
                  </div>
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

              <div style="display: flex; gap: var(--spacing-12);">
                <button
                  onclick="toggleOptimization('${userId}', '${job.job_name}', ${job.active})"
                  style="flex: 1; padding: 12px 20px; background: ${job.active ? '#FFE6E6' : '#E6F7F5'}; color: ${job.active ? '#FF6B6B' : '#00C2A8'}; border: 1px solid ${job.active ? '#FFCCCC' : '#B3E5DB'}; border-radius: var(--radius-small); cursor: pointer; font-weight: 600; transition: all 0.2s; font-size: 1rem;"
                  onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.1)';"
                  onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
                >
                  ${job.active ? 'Disable' : 'Enable'}
                </button>
                <button
                  onclick="deleteOptimization('${userId}', '${job.job_name}')"
                  style="padding: 12px 20px; background: #FFE6E6; color: #FF6B6B; border: 1px solid #FFCCCC; border-radius: var(--radius-small); cursor: pointer; font-weight: 600; transition: all 0.2s; font-size: 1rem;"
                  onmouseover="this.style.background='#FFCCCC'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.1)';"
                  onmouseout="this.style.background='#FFE6E6'; this.style.transform='translateY(0)'; this.style.boxShadow='none';"
                >
                  Delete
                </button>
              </div>
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
  }

  // Show initial empty state on page load for schedules
  if (document.getElementById('schedules-list')) {
    loadOptimizationSchedules(null);
  }

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


      const userId = document.getElementById('schedule-user-id').value.trim();
      const account = scheduleAccountSelect.value;
      const region = scheduleRegionSelect.value;

      // Validate user ID
      if (!userId) {
        alert('Please enter a User ID first');
        document.getElementById('schedule-user-id').focus();
        return;
      }

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
});

// Global functions for account management
function deleteKDPAccount(userId, accountName) {
  if (confirm(`Are you sure you want to delete the account "${accountName}"?`)) {
    alert('Delete account: ' + accountName + '\nUser ID: ' + userId + '\n\nThis will be implemented with actual delete functionality.');
    // TODO: Implement actual delete API call
  }
}

// Global functions for optimization schedule management
async function toggleOptimization(userId, jobName, currentlyActive) {
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
        job_name: jobName,
        active: !currentlyActive
      })
    });

    const data = await response.json();

    if (data.success) {
      // Show success message
      const successMessage = document.createElement('div');
      successMessage.style.cssText = 'position: fixed; top: 20px; right: 20px; background: #00C2A8; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 1000; animation: slideInRight 0.3s ease;';
      successMessage.textContent = `✓ Optimization ${action}d successfully!`;
      document.body.appendChild(successMessage);

      setTimeout(() => {
        successMessage.remove();
      }, 3000);

      // Reload schedules
      const scheduleUserIdInput = document.getElementById('schedule-user-id');
      if (scheduleUserIdInput && scheduleUserIdInput.value) {
        loadOptimizationSchedules(scheduleUserIdInput.value);
      }
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

async function deleteOptimization(userId, jobName) {

  try {
    const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=delete_optimization', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        user_id: userId,
        job_name: jobName
      })
    });

    const data = await response.json();

    if (data.success) {
      // Show success message
      const successMessage = document.createElement('div');
      successMessage.style.cssText = 'position: fixed; top: 20px; right: 20px; background: #00C2A8; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 1000; animation: slideInRight 0.3s ease;';
      successMessage.textContent = '✓ Optimization deleted successfully!';
      document.body.appendChild(successMessage);

      setTimeout(() => {
        successMessage.remove();
      }, 3000);

      // Reload schedules
      const scheduleUserIdInput = document.getElementById('schedule-user-id');
      if (scheduleUserIdInput && scheduleUserIdInput.value) {
        loadOptimizationSchedules(scheduleUserIdInput.value);
      }
    } else {
      // Show error message
      const errorMessage = document.createElement('div');
      errorMessage.style.cssText = 'position: fixed; top: 20px; right: 20px; background: #FF6B6B; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 1000; animation: slideInRight 0.3s ease;';
      errorMessage.textContent = '✗ Failed to delete optimization';
      document.body.appendChild(errorMessage);

      setTimeout(() => {
        errorMessage.remove();
      }, 3000);
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
</script>

<?php
get_footer();
?>

