
<script setup>
import { onMounted, computed } from 'vue'

import { Link, usePage } from '@inertiajs/vue3';
import { useTrans, useRoute } from '/resources/js/trans';

const props = defineProps({
    portfolio: Object,
    locale: String
})

const mainImage = computed(() => {
    if (!props.portfolio.images || props.portfolio.images.length === 0) return ''

    const main = props.portfolio.images.find(img => img.is_main === 1)
    return main ? main.path_url : props.portfolio.images[0].path_url
})
</script>


<template>
    <div class="single-blogg-item mb-30">
        <div class="blogg-thumb">
            <a href="blog-details.html">
                <img :src="mainImage" alt="" class="img-fit">
            </a>
        </div>

       <div class="blogg-content card-body fixed-content">
      <!-- Кнопка Show more -->
      <span class="post-date ">
        <Link :href="route('single_portfolio', [props.locale, portfolio.id])">Show more</Link>
      </span>

      <!-- Название с фиксированной высотой -->
      <div class="title-wrapper">
        <h5>
          <a href="blog-details.html">{{ portfolio.translation_lang?.name }}</a>
        </h5>
      </div>

      <!-- Описание -->
      <p class="text-truncate-3 mt-3">{{ portfolio.translation_lang?.description }}</p>
    </div>
    </div>

</template>
<style scoped>
.blogg-thumb {
  width: 100%;
  height: 200px;
  overflow: hidden;
}

.img-fit {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

/* Фиксируем высоту всего контента */
.fixed-content {
  height: 220px; /* подгоняем под дизайн */
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  overflow: hidden;
}
.post-date{
    width: 100px;
    text-align: center;
    font-weight: bold;
}
/* Название: фиксированная высота и максимум 2 строки */
.title-wrapper {
  height: 48px; /* подгоняем под 2 строки */
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
  width: 100%; /* растягиваем только блок названия, не кнопку */
  margin-bottom: 5px;
  border-bottom: 1px solid #f0f0f0;
}

h5::before{
    background: none;
}
/* Описание: максимум 3 строки */
.text-truncate-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>


