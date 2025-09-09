import { defineStore } from 'pinia';
import { useModalStore } from '@/Stores/modalStore'


export const useCompareStore = defineStore('compare', {

    state: () => ({
        list: JSON.parse(localStorage.getItem('compare_products') || '[]'),
    }),
    actions: {
        save() {
            localStorage.setItem('compare_products', JSON.stringify(this.list));
        },
        add(productId) {


            if (this.list.includes(productId)) {
                console.log('Уже в списке');
                return;
            }
            if (this.list.length >= 3) {
                const modal = useModalStore();


                return;
            }
            this.list.push(productId);
            this.save();
            console.log('Текущий список:', this.list);
        },
        remove(productId) {
            this.list = this.list.filter(id => id !== productId);
            this.save();
        },
        clear() {
            this.list = [];
            this.save();
        }
    },
    getters: {
        count: (state) => state.list.length,
        ids: (state) => state.list,
    }
});
