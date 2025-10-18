<?php
/* Template Name: Home */
get_header();
?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style-rlt.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/pb-style.php">

<div class="section plottybot-homepage aligncenter">
  <h1 class="section-title demo-gradient plottybot-title aligncenter text--heading-lg" style="color:var(--color-primary-90);">Plottybot Tools</h1>
  <div class="aligncenter" style="max-width:700px;display:grid;grid-template-columns:repeat(2,1fr);gap:var(--spacing-16);justify-content:center;">
    <?php $locked = !is_user_logged_in(); ?>
    <div class="fancy-tile insights-tile<?php echo $locked ? ' locked-tile' : ''; ?>" data-locked="<?php echo $locked ? '1' : '0'; ?>" style="margin:var(--spacing-8);width:300px;min-height:180px;background:var(--color-neutral-00);border:2px solid var(--color-neutral-40);border-radius:var(--radius-medium);box-shadow:0 4px 24px rgba(0,0,0,0.08);padding:2.5rem 2rem;text-align:center;display:flex;flex-direction:column;align-items:center;justify-content:center;position:relative;">
      <span class="pb-icon" style="mask:url('https://insights.plottybot.com/img/icons/pb-iconography/icons-xl/insights.svg') no-repeat center;-webkit-mask:url('https://insights.plottybot.com/img/icons/pb-iconography/icons-xl/insights.svg') no-repeat center;mask-size:contain;width:40px;height:40px;background-color:var(--color-neutral-70);display:inline-block;margin-bottom:var(--spacing-8);"></span>
      <h2 class="tile-title text--heading-md" style="color:var(--color-neutral-90);">Insights</h2>
      <?php if ($locked): ?>
        <div class="tile-lock" style="position:absolute;top:var(--spacing-4);right:var(--spacing-4);z-index:2;">
          <span class="tile-lock-icon pb-icon" style="mask:url('https://insights.plottybot.com/img/icons/pb-iconography/icons-xl/lock.svg') no-repeat center;-webkit-mask:url('https://insights.plottybot.com/img/icons/pb-iconography/icons-xl/lock.svg') no-repeat center;mask-size:contain;width:28px;height:28px;background-color:var(--color-neutral-70);"></span>
        </div>
      <?php endif; ?>
    </div>
    <div class="fancy-tile ads-tile<?php echo $locked ? ' locked-tile' : ''; ?>" data-locked="<?php echo $locked ? '1' : '0'; ?>" style="margin:var(--spacing-8);width:300px;min-height:180px;background:var(--color-neutral-00);border:2px solid var(--color-neutral-40);border-radius:var(--radius-medium);box-shadow:0 4px 24px rgba(0,0,0,0.08);padding:2.5rem 2rem;text-align:center;display:flex;flex-direction:column;align-items:center;justify-content:center;position:relative;">
      <span class="pb-icon" style="mask:url('https://insights.plottybot.com/img/icons/pb-iconography/icons-xl/ads.svg') no-repeat center;-webkit-mask:url('https://insights.plottybot.com/img/icons/pb-iconography/icons-xl/ads.svg') no-repeat center;mask-size:contain;width:40px;height:40px;background-color:var(--color-neutral-70);display:inline-block;margin-bottom:var(--spacing-8);"></span>
      <h2 class="tile-title text--heading-md" style="color:var(--color-neutral-90);">Ads</h2>
      <?php if ($locked): ?>
        <div class="tile-lock" style="position:absolute;top:var(--spacing-4);right:var(--spacing-4);z-index:2;">
          <span class="tile-lock-icon pb-icon" style="mask:url('https://insights.plottybot.com/img/icons/pb-iconography/icons-xl/lock.svg') no-repeat center;-webkit-mask:url('https://insights.plottybot.com/img/icons/pb-iconography/icons-xl/lock.svg') no-repeat center;mask-size:contain;width:28px;height:28px;background-color:var(--color-neutral-70);"></span>
        </div>
      <?php endif; ?>
    </div>
    <div class="fancy-tile cover-tile<?php echo $locked ? ' locked-tile' : ''; ?>" data-locked="<?php echo $locked ? '1' : '0'; ?>" style="margin:var(--spacing-8);width:300px;min-height:180px;background:var(--color-neutral-00);border:2px solid var(--color-neutral-40);border-radius:var(--radius-medium);box-shadow:0 4px 24px rgba(0,0,0,0.08);padding:2.5rem 2rem;text-align:center;display:flex;flex-direction:column;align-items:center;justify-content:center;position:relative;">
      <span class="pb-icon" style="mask:url('https://insights.plottybot.com/img/icons/pb-iconography/icons-xl/cover.svg') no-repeat center;-webkit-mask:url('https://insights.plottybot.com/img/icons/pb-iconography/icons-xl/cover.svg') no-repeat center;mask-size:contain;width:40px;height:40px;background-color:var(--color-neutral-70);display:inline-block;margin-bottom:var(--spacing-8);"></span>
      <h2 class="tile-title text--heading-md" style="color:var(--color-neutral-90);">Cover</h2>
      <?php if ($locked): ?>
        <div class="tile-lock" style="position:absolute;top:var(--spacing-4);right:var(--spacing-4);z-index:2;">
          <span class="tile-lock-icon pb-icon" style="mask:url('https://insights.plottybot.com/img/icons/pb-iconography/icons-xl/lock.svg') no-repeat center;-webkit-mask:url('https://insights.plottybot.com/img/icons/pb-iconography/icons-xl/lock.svg') no-repeat center;mask-size:contain;width:28px;height:28px;background-color:var(--color-neutral-70);"></span>
        </div>
      <?php endif; ?>
    </div>
    <div class="fancy-tile search-tile<?php echo $locked ? ' locked-tile' : ''; ?>" data-locked="<?php echo $locked ? '1' : '0'; ?>" style="margin:var(--spacing-8);width:300px;min-height:180px;background:var(--color-neutral-00);border:2px solid var(--color-neutral-40);border-radius:var(--radius-medium);box-shadow:0 4px 24px rgba(0,0,0,0.08);padding:2.5rem 2rem;text-align:center;display:flex;flex-direction:column;align-items:center;justify-content:center;position:relative;">
      <span class="pb-icon" style="mask:url('https://insights.plottybot.com/img/icons/pb-iconography/icons-xl/search.svg') no-repeat center;-webkit-mask:url('https://insights.plottybot.com/img/icons/pb-iconography/icons-xl/search.svg') no-repeat center;mask-size:contain;width:40px;height:40px;background-color:var(--color-neutral-70);display:inline-block;margin-bottom:var(--spacing-8);"></span>
      <h2 class="tile-title text--heading-md" style="color:var(--color-neutral-90);">Book Search</h2>
      <?php if ($locked): ?>
        <div class="tile-lock" style="position:absolute;top:var(--spacing-4);right:var(--spacing-4);z-index:2;">
          <span class="tile-lock-icon pb-icon" style="mask:url('https://insights.plottybot.com/img/icons/pb-iconography/icons-xl/lock.svg') no-repeat center;-webkit-mask:url('https://insights.plottybot.com/img/icons/pb-iconography/icons-xl/lock.svg') no-repeat center;mask-size:contain;width:28px;height:28px;background-color:var(--color-neutral-70);"></span>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<style>
#login-popup {
  display: none;
  position: fixed;
  z-index: 9999;
  left: 0; top: 0; right: 0; bottom: 0;
  background: rgba(0,0,0,0.4);
  align-items: center;
  justify-content: center;
}
#login-popup .popup-content {
  background: var(--color-neutral-00);
  padding: var(--spacing-16) var(--spacing-16);
  border-radius: var(--radius-medium);
  box-shadow: 0 4px 24px rgba(0,0,0,0.15);
  font-size: 1.2em;
  color: var(--color-neutral-90);
  text-align: center;
  position: relative;
}
#login-popup .popup-close {
  position: absolute;
  top: var(--spacing-4);
  right: var(--spacing-8);
  font-size: 1.5em;
  color: var(--color-neutral-70);
  cursor: pointer;
}
</style>
<div id="login-popup">
  <div class="popup-content text--body-md">
    <span class="popup-close" onclick="document.getElementById('login-popup').style.display='none'">&times;</span>
    You have to login.
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var lockedTiles = document.querySelectorAll('.fancy-tile[data-locked="1"]');
  lockedTiles.forEach(function(tile) {
    tile.addEventListener('click', function(e) {
      e.preventDefault();
      var popup = document.getElementById('login-popup');
      if (popup) popup.style.display = 'flex';
    });
  });
  var popup = document.getElementById('login-popup');
  if (popup) {
    popup.addEventListener('click', function(e) {
      if (e.target === popup) popup.style.display = 'none';
    });
  }
});
</script>

<?php
get_footer();
?>
