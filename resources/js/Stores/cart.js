import { defineStore } from 'pinia'
import axios from 'axios'
import { useModalStore } from '@/Stores/modalStore'

export const useCartStore = defineStore('cart', {
    state: () => ({
        list: JSON.parse(localStorage.getItem('cart_products') || '[]'),
        userId: null,
        products: [], // тут будем хранить актуальные данные о товарах из базы
    }),
    actions: {
        setUser(userId) {
            this.userId = userId
            if (userId) {
                this.loadFromServer()
            }
        },
        saveLocal() {
            localStorage.setItem('cart_products', JSON.stringify(this.list))
        },
        async loadFromServer() {
            try {
                const response = await axios.get(`/api/cart/${this.userId}`)
                this.list = response.data.items || []
                await this.fetchProducts() // подгружаем инфу о товарах
            } catch (e) {
                console.error('Ошибка загрузки корзины:', e)
            }
        },
        async saveToServer() {
            if (!this.userId) return
            try {
                await axios.post(`/api/cart/${this.userId}`, { items: this.list })
            } catch (e) {
                console.error('Ошибка сохранения корзины:', e)
            }
        },

        async fetchProducts() {
            try {
                // отправляем ids всех товаров из корзины
                const ids = this.list.map(item => item.id)
                if (ids.length === 0) {
                    this.products = []
                    return
                }

                const response = await axios.post(`/api/products/info`, { ids })
                this.products = response.data // [{id, name, price, ...}]
            } catch (e) {
                console.error('Ошибка загрузки информации о товарах:', e)
            }
        },

        async add(productId, params = {}, qty = 1) {
            const modal = useModalStore()

            if (this.list.length >= 50) {
                modal.show('Слишком много товаров')
                return
            }

            const existing = this.list.find(
                item => item.id === productId && JSON.stringify(item.params) === JSON.stringify(params)
            )

            if (existing) {
                existing.qty += qty
            } else {
                this.list.push({ id: productId, params, qty })
            }

            if (this.userId) {
                await this.saveToServer()
            } else {
                this.saveLocal()
            }

            await this.fetchProducts()
        },

        async updateQty(productId, params = {}, qty = 1) {
            const item = this.list.find(
                item => item.id === productId && JSON.stringify(item.params) === JSON.stringify(params)
            )

            if (item) {
                item.qty = qty > 0 ? qty : 1
                if (this.userId) {
                    await this.saveToServer()
                } else {
                    this.saveLocal()
                }
                await this.fetchProducts()
            }
        },

        async remove(productId, params = {}) {
            this.list = this.list.filter(
                item => !(item.id === productId && JSON.stringify(item.params) === JSON.stringify(params))
            )

            if (this.userId) {
                await this.saveToServer()
            } else {
                this.saveLocal()
            }
            await this.fetchProducts()
        },

        async clear() {
            this.list = []
            if (this.userId) {
                await this.saveToServer()
            } else {
                this.saveLocal()
            }
            this.products = []
        }
    },
    getters: {
        count: (state) => state.list.reduce((sum, item) => sum + item.qty, 0),
        ids: (state) => state.list.map(item => item.id),
        all: (state) => state.list,

        totalPrice: (state) => {
            return state.list.reduce((sum, item) => {
                const product = state.products.find(p => p.id === item.id)
                return sum + (product ? product.price * item.qty : 0)
            }, 0)
        }
    }
})
