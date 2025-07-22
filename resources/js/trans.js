import { usePage } from '@inertiajs/vue3';

// export function useTrans(value) {
//     const array = usePage().props.translations;
//     array[value] != null ? array[value] : value;
//     console.log(array['page']['title'], ' ***********')
//     // return array[value] != null ? array[value] : value;
// }


export function useTrans(value) {
    const array = usePage().props.translations;

    return value.split('.').reduce((t, k) => t?.[k] ?? value, array);
}
