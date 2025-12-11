/**
 * Main JavaScript File
 * Warung Kenyang Selalu
 * Kelompok 9 - Pemrograman Web 1
 */

// API Base URL
const API_URL = '/api';

// Utility Functions
function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID').format(angka);
}

function formatDate(dateString) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('id-ID', options);
}

function formatTime(timeString) {
    return timeString.substring(0, 5);
}

function showLoading(elementId) {
    const element = document.getElementById(elementId);
    if (element) {
        element.innerHTML = '<div class="spinner"></div>';
    }
}

function hideLoading(elementId) {
    const element = document.getElementById(elementId);
    if (element) {
        element.innerHTML = '';
    }
}

function showAlert(message, type = 'success') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.role = 'alert';
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    const container = document.querySelector('.container') || document.body;
    if (container) {
        container.insertBefore(alertDiv, container.firstChild);

        setTimeout(() => {
            alertDiv.remove();
        }, 5000);
    }
}

// API Functions
async function fetchAPI(endpoint, options = {}) {
    try {
        const normalizedEndpoint = endpoint.startsWith('/') ? endpoint : `/${endpoint}`;
        const fetchOptions = {
            ...options,
            headers: {
                Accept: 'application/json',
                ...(options.headers || {}),
            },
        };
        const response = await fetch(`${API_URL}${normalizedEndpoint}`, fetchOptions);
        const data = await response.json();
        
        if (!response.ok) {
            throw new Error(data.message || 'Terjadi kesalahan');
        }
        
        return data;
    } catch (error) {
        console.error('API Error:', error);
        throw error;
    }
}

// Menu Functions
async function loadAllMenu() {
    try {
        const data = await fetchAPI('/menu');
        return data.data;
    } catch (error) {
        showAlert('Gagal memuat menu: ' + error.message, 'danger');
        return [];
    }
}

async function loadAvailableMenu() {
    try {
        const data = await fetchAPI('/menu/available');
        return data.data;
    } catch (error) {
        showAlert('Gagal memuat menu: ' + error.message, 'danger');
        return [];
    }
}

async function loadMenuByCategory(category) {
    try {
        const data = await fetchAPI(`/menu/category/${encodeURIComponent(category)}`);
        return data.data;
    } catch (error) {
        showAlert('Gagal memuat menu: ' + error.message, 'danger');
        return [];
    }
}

async function createMenuItem(menuData) {
    try {
        const data = await fetchAPI('/menu', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(menuData)
        });
        return data;
    } catch (error) {
        showAlert('Gagal menambah menu: ' + error.message, 'danger');
        throw error;
    }
}

async function updateMenuItem(menuData) {
    try {
        if (!menuData.id) {
            throw new Error('ID menu diperlukan untuk memperbarui data.');
        }

        const data = await fetchAPI(`/menu/${menuData.id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(menuData)
        });
        return data;
    } catch (error) {
        showAlert('Gagal update menu: ' + error.message, 'danger');
        throw error;
    }
}

async function updateStock(menuId, stock) {
    try {
        const data = await fetchAPI(`/menu/${menuId}/stock`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ menu_id: menuId, stock: stock })
        });
        return data;
    } catch (error) {
        showAlert('Gagal update stok: ' + error.message, 'danger');
        throw error;
    }
}

async function deleteMenuItem(menuId) {
    try {
        const data = await fetchAPI(`/menu/${menuId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
        });
        return data;
    } catch (error) {
        showAlert('Gagal hapus menu: ' + error.message, 'danger');
        throw error;
    }
}

// Order Functions
async function loadAllOrders() {
    try {
        const data = await fetchAPI('/orders');
        return data.data;
    } catch (error) {
        showAlert('Gagal memuat pesanan: ' + error.message, 'danger');
        return [];
    }
}

async function loadOrdersByStatus(status) {
    try {
        const data = await fetchAPI(`/orders/status/${status}`);
        return data.data;
    } catch (error) {
        showAlert('Gagal memuat pesanan: ' + error.message, 'danger');
        return [];
    }
}

async function loadOrdersByUser(userId) {
    try {
        const data = await fetchAPI(`/orders/user/${userId}`);
        return data.data;
    } catch (error) {
        showAlert('Gagal memuat riwayat pesanan: ' + error.message, 'danger');
        return [];
    }
}

async function loadOrderDetail(orderId) {
    try {
        const data = await fetchAPI(`/orders/${orderId}`);
        return data.data;
    } catch (error) {
        showAlert('Gagal memuat detail pesanan: ' + error.message, 'danger');
        return null;
    }
}

async function loadOrderStats() {
    try {
        const data = await fetchAPI('/orders/stats');
        return data.data;
    } catch (error) {
        showAlert('Gagal memuat statistik: ' + error.message, 'danger');
        return null;
    }
}

async function createOrder(orderData) {
    try {
        const data = await fetchAPI('/orders', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(orderData),
        });
        return data;
    } catch (error) {
        showAlert('Gagal membuat pesanan: ' + error.message, 'danger');
        throw error;
    }
}

async function updateOrderStatus(orderId, status) {
    try {
        const data = await fetchAPI(`/orders/${orderId}/status`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ status }),
        });
        return data;
    } catch (error) {
        showAlert('Gagal update status: ' + error.message, 'danger');
        throw error;
    }
}

async function updatePaymentStatus(orderId, paymentMethod) {
    try {
        const data = await fetchAPI(`/orders/${orderId}/payment`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ payment_method: paymentMethod }),
        });
        return data;
    } catch (error) {
        showAlert('Gagal konfirmasi pembayaran: ' + error.message, 'danger');
        throw error;
    }
}

async function cancelOrder(orderId) {
    try {
        const data = await fetchAPI(`/orders/${orderId}`, {
            method: 'DELETE',
        });
        return data;
    } catch (error) {
        showAlert('Gagal membatalkan pesanan: ' + error.message, 'danger');
        throw error;
    }
}

// Shopping Cart Functions
class ShoppingCart {
    constructor() {
        this.items = this.loadCart();
    }
    
    loadCart() {
        const cart = sessionStorage.getItem('cart');
        return cart ? JSON.parse(cart) : [];
    }
    
    saveCart() {
        sessionStorage.setItem('cart', JSON.stringify(this.items));
    }
    
    addItem(menu) {
        const menuId = menu.menu_id ?? menu.id;
        const existingItem = this.items.find(item => item.menu_id === menuId);
        
        if (existingItem) {
            if (existingItem.quantity < menu.stock) {
                existingItem.quantity++;
            } else {
                showAlert('Stok tidak mencukupi!', 'warning');
                return false;
            }
        } else {
            this.items.push({
                menu_id: menuId,
                menu_name: menu.menu_name,
                price: Number(menu.price) || 0,
                quantity: 1,
                stock: menu.stock ?? 0
            });
        }
        
        this.saveCart();
        this.updateCartBadge();
        return true;
    }
    
    removeItem(menuId) {
        this.items = this.items.filter(item => item.menu_id !== menuId);
        this.saveCart();
        this.updateCartBadge();
    }
    
    updateQuantity(menuId, quantity) {
        const item = this.items.find(item => item.menu_id === menuId);
        if (item) {
            if (quantity <= 0) {
                this.removeItem(menuId);
            } else if (quantity <= item.stock) {
                item.quantity = quantity;
                this.saveCart();
            } else {
                showAlert('Stok tidak mencukupi!', 'warning');
                return false;
            }
        }
        return true;
    }
    
    getTotal() {
        return this.items.reduce((total, item) => total + (item.price * item.quantity), 0);
    }
    
    getItemCount() {
        return this.items.reduce((count, item) => count + item.quantity, 0);
    }
    
    clear() {
        this.items = [];
        this.saveCart();
        this.updateCartBadge();
    }
    
    updateCartBadge() {
        const badge = document.getElementById('cartBadge');
        if (badge) {
            const count = this.getItemCount();
            badge.textContent = count;
            badge.style.display = count > 0 ? 'inline-block' : 'none';
        }
    }
}

// Form Validation
function validateForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return false;
    
    const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
    let isValid = true;
    
    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.classList.add('is-invalid');
            isValid = false;
        } else {
            input.classList.remove('is-invalid');
        }
    });
    
    return isValid;
}

// Date & Time Helpers
function getTodayDate() {
    return new Date().toISOString().split('T')[0];
}

function getTomorrowDate() {
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    return tomorrow.toISOString().split('T')[0];
}

function getMinPickupDate() {
    return getTodayDate();
}

function getMaxPickupDate() {
    const maxDate = new Date();
    maxDate.setDate(maxDate.getDate() + 1);
    return maxDate.toISOString().split('T')[0];
}

// Initialize tooltips and popovers (Bootstrap 5)
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Initialize popovers
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
    
    // Auto-hide alerts
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.classList.remove('show');
            setTimeout(() => alert.remove(), 150);
        }, 5000);
    });
    
    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
});

// Export functions for use in other scripts
window.formatRupiah = formatRupiah;
window.formatDate = formatDate;
window.formatTime = formatTime;
window.showAlert = showAlert;
window.ShoppingCart = ShoppingCart;
window.loadAllOrders = loadAllOrders;
window.updateOrderStatus = updateOrderStatus;
window.updatePaymentStatus = updatePaymentStatus;
window.loadOrdersByUser = loadOrdersByUser;
window.loadAvailableMenu = loadAvailableMenu;
window.createOrder = createOrder;