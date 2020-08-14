@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-12">
                <ul class="nav nav-pills">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">{{ __('Users') }}</a>
                        <ul class="dropdown-menu">
                            <li>
                                <router-link class="dropdown-item" :to="{ name: 'users.index' }" exact>All</router-link>
                            </li>
                            <li>
                                <router-link class="dropdown-item" :to="{ name: 'users.create' }">Add</router-link>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <router-link class="dropdown-item" :to="{ name: 'users.deleted' }">{{ __('Trash') }}</router-link>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">{{ __('Organizations') }}</a>
                        <ul class="dropdown-menu">
                            <li>
                                <router-link class="dropdown-item" :to="{ name: 'organizations.index' }" exact>All</router-link>
                            </li>
                            <li>
                                <router-link class="dropdown-item" :to="{ name: 'organizations.create' }">Add</router-link>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <router-link class="dropdown-item" :to="{ name: 'organizations.deleted' }">{{ __('Trash') }}</router-link>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">{{ __('Clients') }}</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">All</a></li>
                            <li>
                                <router-link class="dropdown-item" :to="{ name: 'clients.create' }">Add</router-link>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Trash</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- route outlet -->
                <!-- component matched by the route will render here -->
                <router-view></router-view>
            </div>
        </div>
    </div>
@endsection
