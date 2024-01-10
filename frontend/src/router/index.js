import Vue from 'vue'
import Router from 'vue-router'

// User
import User from '../views/user/list'
import AddUser from '../views/user/add'
import EditUser from '../views/user/edit'
import DetailUser from '../views/user/detail'

// Product
import Product from '../views/product/list'

// Delivery Method
import DeliveryMethod from '../views/delivery_method/list'
import AddDeliveryMethod from '../views/delivery_method/add'
import EditDeliveryMethod from '../views/delivery_method/edit'
import DetailDeliveryMethod from '../views/delivery_method/detail'

Vue.use(Router)

export default new Router({
	routes: [
		{
			path: '/',
			name: 'list-user',
			component: User
		},
		{
			path: '/list-user',
			name: 'list-user',
			component: User
		},
		{
			path: '/add-user',
			name: 'add-user',
			component: AddUser
		},
		{
			path: '/edit-user',
			name: 'edit-user',
			component: EditUser
		},
		{
			path: '/detail-user',
			name: 'detail-user',
			component: DetailUser
		},
		{
			path: '/list-product',
			name: 'list-product',
			component: Product
		},
		{
			path: '/list-delivery-method',
			name: 'list-delivery-method',
			component: DeliveryMethod
		},
		{
			path: '/add-delivery-method',
			name: 'add-delivery-method',
			component: AddDeliveryMethod
		},
		{
			path: '/edit-delivery-method/:id',
			name: 'edit-delivery-method',
			component: EditDeliveryMethod
		},
		{
			path: '/detail-delivery-method/:id',
			name: 'detail-delivery-method',
			component: DetailDeliveryMethod
		},
	]
})
