<script setup>
    defineProps({
        category: Object
    })
</script>

<template>
    <li>
        <a href="#"> {{ category.translation.name }}
            <span v-if="category.children?.length" class="lnr lnr-chevron-right"></span>
        </a>

        <ul v-if="category.children?.length" class="cat-submenu">
            <CategoryItem
                v-for="child in category.children"
                :key="child.id"
                :category="child"
            />
        </ul>
    </li>
</template>
