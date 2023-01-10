<?php namespace Morningtrain\WP\ACFHelper;

use Morningtrain\WP\ACFHelper\Classes\JsonPath;

class ACFHelper {

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
     * Hide the admin interface.
     * @return void
     */
    public static function hideAdmin(): void
    {
        add_filter( 'acf/settings/show_admin', '__return_false' );
    }

    /**
     * Hide the admin interface except on specific environments set by the WP_ENVIRONMENT_TYPE constant
     * @param array|string $environments local, development, staging or production
     * @return void
     */
    public static function hideAdminExceptOn(array|string $environments = 'local'): void
    {
        if(in_array(wp_get_environment_type(), (array) $environments)) {
            return;
        }

        static::hideAdmin();
    }

    /**
     * Check if the ACF plugin is installed and activated. Will also return true if ACF is attached in another active plugin or theme.
     * @return bool
     */
    public static function isACFActivated(): bool
    {
        return function_exists('ACF');
    }
}