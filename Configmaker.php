<?php

namespace Organelles\Install;

class Configmaker
{

    /**
     * Masks for making configs.
     *
     * @var array
     */
    private $masks = [];

    /**
     * Directories where should make configs.
     *
     * @var array
     */
    private $directories = [];

    /**
     * Configmaker constructor.
     *
     * @param array $masks
     * @param array $directories
     */
    public function __construct(array $masks = [], array $directories = [])
    {
        foreach ($masks as $mask) {
            $this->addMask($mask);
        }
        foreach ($directories as $directory) {
            $this->addDirectory($directory);
        }
    }

    /**
     * Add a mask.
     *
     * @param string $mask
     * @return $this
     */
    public function addMask(string $mask): Configmaker
    {
        $this->masks[$mask] = $mask;

        return $this;
    }

    /**
     * Delete a mask.
     *
     * @param string $mask
     * @return $this
     */
    public function deleteMask(string $mask): Configmaker
    {
        unset($this->masks[$mask]);

        return $this;
    }

    /**
     * Add a directory.
     *
     * @param string $directory
     * @return $this
     */
    public function addDirectory(string $directory): Configmaker
    {
        $this->directories[$directory] = $directory;

        return $this;
    }

    /**
     * Delete a directory.
     *
     * @param string $directory
     * @return $this
     */
    public function deleteDirectory(string $directory): Configmaker
    {
        unset($this->directories[$directory]);

        return $this;
    }

    /**
     * Make (or remake) configs
     *
     * @param bool $recursive
     * @param bool $remake
     * @return bool
     */
    public function make(string $direcory = null, bool $recursive = true, bool $remake = false): bool
    {
        $result = 0;

        if (empty($direcory)) {
            foreach ($this->directories as $dir) {
                $this->make($dir, $recursive, $remake);
            }
        }

        if ($recursive) {
            $subDirectories = array_filter(glob($direcory . '/*'), 'is_dir');
            foreach ($subDirectories as $subDirectory) {
                $this->make($subDirectory, $recursive, $remake);
            }
        }

        foreach ($this->masks as $mask) {
            $files = glob($direcory . '/' . $mask);
            if (!empty($files)) {
                foreach ($files as $file) {

                }
            }
        }

        return (bool)$result;
    }

}