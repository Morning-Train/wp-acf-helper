<?php namespace Morningtrain\WP\ACF\Classes;

class JsonPath {

    private string $namespace = 'default';

    /**
     * Construct json path and load ACF json files from the specified path
     * @param string $path Full path to the folder
     */
    public function __construct(private string $path)
    {
        add_filter('acf/settings/load_json', [$this, 'loadJsonHook']);
    }

    /**
     * Get specified path
     * @return string
     */
    public function getPath(): string
    {
        return trailingslashit($this->path);
    }

    /**
     * Get the this path's namespace
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * Use this folder as the folder where JSON files are saved when editing in the admin area. Will not set if ACF_SAVE_FOLDER is defined and not set to the specified namespace
     * Will not automatically create the folder, so the folder shall exist.
     * @param string $namespace A namespace used for defining which folder should be the one where files are saved. Defaults to 'default'.
     * @return void
     */
    public function useAsSaveFolder(string $namespace = 'default'): void
    {
        $this->namespace = $namespace;

        add_filter('acf/settings/save_json', [$this, 'saveJsonHook']);
    }

    /**
     * Function used for acf/settings/load_json hook to set a load folder.
     * @param array $paths Paths passed from the filter
     * @return array
     */
    public function loadJsonHook(array $paths): array
    {
        $paths[] = $this->getPath();

        return $paths;
    }

    /**
     * Function used for acf/settings/save_json hook to set save folder. Will not set if ACF_SAVE_FOLDER is defined and not set to this namespace
     * @param string $path Path passed from the filter
     * @return string
     */
    public function saveJsonHook(string $path): string
    {
        if(defined('ACF_SAVE_FOLDER') && ACF_SAVE_FOLDER !== $this->getNamespace()) {
            return $path;
        }

        return $this->getPath();
    }
}