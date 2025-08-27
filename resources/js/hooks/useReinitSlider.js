// resources/js/hooks/useReinitSlider.js
import { onMounted, watch, nextTick } from 'vue'
import $ from 'jquery'

export function useReinitSlider(selector, initFn, watchSource) {
    
    const init = () => {
        const $el = $(selector)
        if ($el.length === 0) return

        // если slick уже инициализирован → убираем
        if ($el.hasClass('slick-initialized')) {
            $el.slick('unslick')
        }

        // запускаем кастомную инициализацию
        initFn($el)
    }

    onMounted(() => {
        nextTick(() => init())
    })

    if (watchSource) {
        watch(watchSource, async () => {
            await nextTick()
            init()
        })
    }
}
