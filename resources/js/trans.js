import { usePage } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import { computed } from 'vue'
// export function useTrans(value) {
//     const array = usePage().props.translations;
//     array[value] != null ? array[value] : value;
//     console.log(array['page']['title'], ' ***********')
//     // return array[value] != null ? array[value] : value;
// }


// export function useTrans(value) {
//     const array = usePage().props.translations;

//     return value.split('.').reduce((t, k) => t?.[k] ?? value, array);
// }

export function useTrans(key, params = {}) {
    const translations = usePage().props.translations || {};

    // Безопасно разбиваем ключ, если он вообще передан
    if (typeof key !== 'string') return '';

    // Находим текст перевода
    const text = key.split('.').reduce((t, k) => t?.[k], translations);

    // Если не нашли — возвращаем сам ключ
    if (!text) return key;

    // Подставляем параметры (например :from → 1)
    return Object.entries(params).reduce((acc, [paramKey, paramValue]) => {
        const regex = new RegExp(`:${paramKey}`, 'g');
        return acc.replace(regex, paramValue);
    }, text);
}


// export function useRoute(value = null) {
//     return `/${usePage().props.locale}${value ?? ''}`;
// }

// export function useRoute(name, params = {}, absolute = true) {
//     console.log(usePage().props.locale, 22222222)
//     const locale = window.Ziggy?.params?.locale ?? 'hy';
//     return route(name, { locale, ...params }, absolute, window.Ziggy);
// }


export function useRoute(name, params = {}, absolute = true) {
  const locale = usePage().props.locale ?? 'hy'
  return route(name, { locale, ...params }, absolute)
}


export const currentLocale = computed(() => usePage().props.locale)
