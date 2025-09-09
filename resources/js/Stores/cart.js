import { defineStore } from 'pinia';
import axios from 'axios'; // для работы с базой через API
import { useModalStore } from '@/Stores/modalStore';
   

export const useCartStore = defineStore('cart', {
    state: () => ({
        list: JSON.parse(localStorage.getItem('cart_products') || '[]'),
        userId: null, // сюда можно записывать ID авторизованного пользователя
    }),
    actions: {
        setUser(userId) {
            this.userId = userId;
            if (userId) {
                // загружаем корзину с сервера
                this.loadFromServer();
            }
        },
        saveLocal() {
            localStorage.setItem('cart_products', JSON.stringify(this.list));
        },
        async loadFromServer() {
            try {
                const response = await axios.get(`/api/cart/${this.userId}`);
                this.list = response.data.items || [];
            } catch (e) {
                console.error('Ошибка загрузки корзины:', e);
            }
        },
        async saveToServer() {
            if (!this.userId) return;
            try {
                await axios.post(`/api/cart/${this.userId}`, { items: this.list });
            } catch (e) {
                console.error('Ошибка сохранения корзины:', e);
            }
        },
        async add(productId) {
            if (this.list.includes(productId)) {
                console.log('Уже в корзине');
                return;
            }

            const modal = useModalStore();
            if (this.list.length >= 10) { // пример ограничения
                modal.show('Слишком много товаров');
                return;
            }

            this.list.push(productId);

            if (this.userId) {
                await this.saveToServer();
            } else {
                this.saveLocal();
            }

            console.log('Текущая корзина:', this.list);
        },
        async remove(productId) {
            this.list = this.list.filter(id => id !== productId);

            if (this.userId) {
                await this.saveToServer();
            } else {
                this.saveLocal();
            }
        },
        async clear() {
            this.list = [];

            if (this.userId) {
                await this.saveToServer();
            } else {
                this.saveLocal();
            }
        }
    },
    getters: {
        count: (state) => state.list.length,
        ids: (state) => state.list,
    }
});
