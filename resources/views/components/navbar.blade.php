@props(['agama' => null])

@php
    $route = request()->route();
    $routeName = $route ? $route->getName() : '';
    $slug = $agama ?? ($route ? $route->parameter('slug') : null);
    $valid = ['islam', 'kristen', 'katolik', 'hindu', 'buddha', 'konghucu'];

    $isPublic = str_starts_with($routeName, 'edukasi')
             || str_starts_with($routeName, 'ibadah')
             || str_starts_with($routeName, 'aksi');
@endphp

@if ($isPublic && $slug && in_array($slug, $valid))
    @include("components.navbars.{$slug}", ['activeRoute' => $routeName])
@else
    @include('layouts.navigation')
@endif
