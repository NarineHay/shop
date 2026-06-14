<script setup>
import { usePage } from '@inertiajs/vue3'
import { useTrans, useRoute } from '/resources/js/trans';
import { computed} from 'vue';

    const props = defineProps({
        category: Object
    })
    const page = usePage()
    const category = props.category

    const categoryUrl = computed(() => {
        if (props.category.page) {
            return useRoute('category_page', {
                slug: props.category.translation.slug,
                locale: page.props.locale
            })
        }

        return useRoute('products', {
            locale: page.props.locale,
            category_slug: props.category.translation.slug
        })
    })
</script>

<template>
    <li>

        <!-- <a :href="useRoute('products', {'locale': page.props.locale, 'category_slug': category.translation.slug })"> {{ category.translation.name }}
            <span v-if="category.children?.length" class="lnr lnr-chevron-right"></span>
        </a> -->

        <a :href="categoryUrl">
            {{ category.translation.name }}

            <span
                v-if="category.children?.length"
                class="lnr lnr-chevron-right"
            ></span>
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
