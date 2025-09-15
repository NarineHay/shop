import { defineStore } from 'pinia'
import axios from 'axios'
import { useModalStore } from '@/Stores/modalStore'

// Универсальная нормализация params
function normalizeParams(params) {
    if (!params || typeof params !== 'object') return {}
    return Object.keys(params)
        .sort()
        .reduce((acc, key) => {
            acc[key] = params[key]
            return acc
        }, {})
}

export const useCartStore = defineStore('cart', {
    state: () => ({
        list: JSON.parse(localStorage.getItem('cart_products') || '[]'),
        userId: null,
        products: [], // актуальные данные о товарах из базы
    }),

    actions: {
        setUser(userId) {
            this.userId = userId
            if (userId) this.loadFromServer()
        },

        saveLocal() {
            localStorage.setItem('cart_products', JSON.stringify(this.list))
        },

        async loadFromServer() {
            try {
                const response = await axios.get(`/cart`)
                this.list = response.data.items || []
                await this.fetchProducts()
            } catch (e) {
                console.error('Ошибка загрузки корзины:', e)
            }
        },

        async saveToServer() {
            if (!this.userId) return
            try {
                await axios.post(`/cart`, { items: this.list })
            } catch (e) {
                console.error('Ошибка сохранения корзины:', e)
            }
        },

        async fetchProducts() {
            try {
                const ids = this.list.map(item => item.id)
                if (!ids.length) {
                    this.products = []
                    return
                }
                const response = await axios.post(`/api/products/prices`, { ids })
                this.products = response.data
            } catch (e) {
                console.error('Ошибка загрузки информации о товарах:', e)
            }
        },

        add(productId, params = {}, qty = 1) {
            const modal = useModalStore()
            if (this.list.length >= 50) {
                modal.show('Слишком много товаров')
                return
            }

            const normParams = normalizeParams(params)

            const existing = this.list.find(
                item => item.id === productId &&
                    JSON.stringify(normalizeParams(item.params)) === JSON.stringify(normParams)
            )

            if (existing) existing.qty += qty
            else this.list.push({ id: productId, params: normParams, qty })

            this.userId ? this.saveToServer() : this.saveLocal()
        },

        updateQty(productId, params = {}, qty = 1) {
            const normParams = normalizeParams(params)

            const item = this.list.find(
                i => i.id === productId &&
                    JSON.stringify(normalizeParams(i.params)) === JSON.stringify(normParams)
            )

            if (item) {
                item.qty = qty > 1 ? qty : 1
                this.userId ? this.saveToServer() : this.saveLocal()
            }
        },

        increaseQty(productId, params = {}) {
            const normParams = normalizeParams(params)

            const item = this.list.find(
                i => i.id === productId &&
                    JSON.stringify(normalizeParams(i.params)) === JSON.stringify(normParams)
            )

            if (item) {
                item.qty++
                this.userId ? this.saveToServer() : this.saveLocal()
            }
        },

        decreaseQty(productId, params = {}) {
            const normParams = normalizeParams(params)

            const item = this.list.find(
                i => i.id === productId &&
                    JSON.stringify(normalizeParams(i.params)) === JSON.stringify(normParams)
            )

            if (item) {
                item.qty = item.qty > 1 ? item.qty - 1 : 1
                this.userId ? this.saveToServer() : this.saveLocal()
            }
        },

        remove(productId, params = {}) {
            const normParams = normalizeParams(params)

            this.list = this.list.filter(
                i => !(i.id === productId &&
                    JSON.stringify(normalizeParams(i.params)) === JSON.stringify(normParams))
            )

            this.userId ? this.saveToServer() : this.saveLocal()
        },

        clear() {
            this.list = []
            this.products = []
            this.userId ? this.saveToServer() : this.saveLocal()
        },

        logout() {
            // Очистить state
            this.list = []
            this.products = []
            this.userId = null

            // Очистить localStorage
            localStorage.removeItem('cart_products')
        }
    },

    getters: {
        count: (state) => state.list.reduce((sum, item) => sum + item.qty, 0),
        all: (state) => state.list,
        totalPrice: (state) => state.list.reduce((sum, item) => {
            const product = state.products.find(p => p.id === item.id)
            return sum + (product ? product.price * item.qty : 0)
        }, 0),
        getProduct: (state) => (id) => state.products.find(p => p.id === id),
        getProductName: (state) => (id) => state.products.find(p => p.id === id)?.translation_lang.name || 'No name',
        getProductImage: (state) => (id) => {
            const prod = state.products.find(p => p.id === id)
            if (!prod || !prod.images?.length) return '/assets/img/no-image.png'
            const main = prod.images.find(img => img.is_main)
            return main?.path_url || prod.images[0].path_url
        }
    }
})
