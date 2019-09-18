<template>

    <b-nav class="sidebar navbar-dark bg-dark">

        <li class="nav-item">
            <router-link :to="{ path: '/' }" exact class="nav-link">
                <i class="nav-icon fa fa-chart-bar"></i>Главная
            </router-link>
        </li>

        <li class="nav-item">
            <router-link to="/pages/page/index" class="nav-link dropdown-toggle" :class="isActive('pages') ? 'active' : ''">
                <i class="nav-icon fa fa-file"></i>Страницы
            </router-link>
            <div class="dropdown-menu" :class="isActive('pages') ? 'show' : ''">
                <router-link to="/pages/page/index" class="dropdown-item"><i class="nav-icon fa fa-file"></i>Страницы</router-link>
                <router-link to="/pages/category/index" class="dropdown-item"><i class="nav-icon fa fa-list"></i>Категории</router-link>
            </div>
        </li>

        <li class="nav-item">
            <router-link to="/catalog/category/index" class="nav-link dropdown-toggle" :class="isActive('catalog') ? 'active' : ''">
                <i class="nav-icon fa fa-sitemap"></i>Каталог
            </router-link>
            <div class="dropdown-menu" :class="isActive('catalog') ? 'show' : ''">
                <router-link to="/catalog/category/index" class="dropdown-item"><i class="nav-icon fa fa-list"></i>Категории</router-link>
            </div>
        </li>

        <li class="nav-item">
            <router-link to="/files/file/index" class="nav-link dropdown-toggle" :class="isActive('files') ? 'active' : ''">
                <i class="nav-icon fa fa-file"></i>Файлы
            </router-link>
            <div class="dropdown-menu" :class="isActive('files') ? 'show' : ''">
                <router-link to="/files/file/index" class="dropdown-item"><i class="nav-icon fa fa-file"></i>Файлы</router-link>
                <router-link to="/files/preset/index" class="dropdown-item"><i class="nav-icon fa fa-list"></i>Пресеты</router-link>
            </div>
        </li>

    </b-nav>

</template>

<script>
    export default {

        methods: {
            isActive (module) {
                let parts = this.$route.path.split('/');
                parts = parts.filter(Boolean);

                return module === parts[0];
            }
        }
    }
</script>
