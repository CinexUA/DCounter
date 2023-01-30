<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <router-link :to="{ name: 'index' }" class="navbar-brand">
                {{ appName }}
            </router-link>

            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarToggler"
                aria-controls="navbarToggler"
                aria-expanded="false"
            >
                <span class="navbar-toggler-icon" />
            </button>

            <div id="navbarToggler" class="collapse navbar-collapse">

                <ul class="navbar-nav">
                    <locale-dropdown />
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark"
                           href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        >
                            {{ $t('menu') }}
                        </a>
                        <div class="dropdown-menu">
                            <erase-clients />
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
</template>

<script>
    import EraseClients from "./EraseClients";
    import LocaleDropdown from './LocaleDropdown'

    export default {
        components: {
            EraseClients, LocaleDropdown
        },
        data: () => ({
            appName: window.config.appName
        })
    }
</script>
