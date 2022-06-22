<?php namespace Morningtrain\WP\ACF;

use Morningtrain\WP\ACF\Classes\JsonPath;

class ACF {

    /**
     * Register af folder where ACF should look for ACF JSON files.
     * @param string $path Full path to the folder
     * @return JsonPath
     */
    public static function registerJsonFolder(string $path): JsonPath
    {
        return new JsonPath($path);
    }

    /**
     * Hide the admin interface. Will not hide if WP_ENVIRONMENT_TYPE is set to 'local'.
     * @return void
     */
    public static function hideAdmin(): void
    {
        if(wp_get_environment_type() === 'local') {
            return;
        }

        add_filter( 'acf/settings/show_admin', '__return_false' );
    }

    /**
     * Check if the ACF plugin is installed and activated. Will also return true if ACF is attached in another active plugin or theme.
     * @return bool
     */
    public static function isACFActivated(): bool
    {
        return function_exists('ACF');
    }

    /**
     * :construction: WIP: Display admin notice if ACF is not activated
     * @return void
     */
    public static function displayACFRequiredAdminNotice() {
        if(static::isACFActivated()) {
            return;
        }
    }
}