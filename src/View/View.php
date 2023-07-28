<?php

namespace CatPHP\View;

class View
{
    /**
     * View create instance.
     *
     * @param string $basePath
     * @return void
     */
    public function create($basePath)
    {
        $this->basePath = $basePath;

        return $this;
    }

    /**
     * Get the string contents of the view.
     *
     * @param  string  $view
     * @param  mixed  $data
     * @param  string $extension
     * @return mixed
     */
    public function render($view, $data = [], $extension = 'php')
    {
        $path = $this->basePath.'/'.str_replace('.', '/', $view).'.'.$extension;

        try {
            $contents = $this->getContents($path, $data);

            return $contents;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Get the evaluated contents of the view.
     *
     * @param string $path
     * @param array $data
     * @return string
     */
    protected function getContents(string $path, $data = [])
    {
        ob_start();
        extract($data);
        include $path;

        return ob_get_clean();
    }

    /**
     * Resolve the path.
     *
     * @param  string  $path
     * @return string
     */
    protected function resolvePath($path)
    {
        return realpath($path) ?: $path;
    }
}