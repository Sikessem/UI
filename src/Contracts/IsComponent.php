<?php

namespace Sikessem\UI\Contracts;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;

interface IsComponent
{
    /**
     * Get the view / view contents that represent the component.
     *
     * @return View|Htmlable|\Closure|string
     */
    public function render();

    /**
     * Resolve the Blade view or view file that should be used when rendering the component.
     *
     * @return View|Htmlable|\Closure|string
     */
    public function resolveView();

    /**
     * Get the data that should be supplied to the view.
     *
     * @return array<mixed>
     */
    public function data();

    /**
     * Set the component alias name.
     *
     * @param  string  $name
     * @return $this
     */
    public function withName($name);

    /**
     * Set the extra attributes that the component should make available.
     *
     * @return $this
     */
    public function withAttributes(array $attributes);

    /**
     * Determine if the component should be rendered.
     *
     * @return bool
     */
    public function shouldRender();

    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string|null  $view
     * @param  Arrayable<array-key,mixed>|array<mixed>  $data
     * @param  array<mixed>  $mergeData
     * @return View
     */
    public function view($view, $data = [], $mergeData = []);
}
