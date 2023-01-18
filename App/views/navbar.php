<?php

declare(strict_types=1);


echo '<div class="wrap">
			<div id ="moppm_message"></div>
				<h1>' . PPPU_APP_NAME . ' </h1>';
                echo '<h1>' . __('You can create up to 500 users with 500 individual page named exactly like username', 'private-posts-per-user') .  '</h1>';

echo '<br><br><br>';
echo '<a id="pppu_menu" class="nav-tab ' . \esc_html('pppu_settings' == $active_tab
    ? 'nav-tab-active' : '') . '" href="' . \esc_url($settings_url) . '">' . __('Settings', 'private-posts-per-user') . '</a>';
echo '<a id="pppu_menu" class="nav-tab ' . \esc_html('pppu_password_change' == $active_tab
    ? 'nav-tab-active' : '') . '" href="' . \esc_url($password_change_url) . '">' . __('Password change', 'private-posts-per-user') . '</a>';
echo '</div>';
