export default [
  {
    path: '/product/Index',
    name: 'productIndex',
    component: () => import('@/views/product/Index.vue'),
    meta: {
      pageTitle: 'ข้อมูลสินค้า',
      breadcrumb: [
        {
          text: 'ระบบสินค้า',
        },
        {
          text: 'ข้อมูลสินค้าทั้งหมด',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/Add',
    name: 'productAdd',
    component: () => import('@/views/product/Add.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'ระบบสินค้า',
        },
        {
          text: 'ข้อมูลสินค้าทั้งหมด',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/Info',
    name: 'productInfo',
    component: () => import('@/views/product/Info.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'ระบบสินค้า',
        },
        {
          text: 'ข้อมูลสินค้าทั้งหมด',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/Edit',
    name: 'productEdit',
    component: () => import('@/views/product/Edit.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'ระบบสินค้า',
        },
        {
          text: 'ข้อมูลสินค้าทั้งหมด',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/sale/index',
    name: 'productSaleIndex',
    component: () => import('@/views/product/sale/Index.vue'),
    meta: {
      pageTitle: 'ข้อมูลสินค้าทั้งหมด',
      breadcrumb: [
        {
          text: 'ระบบสินค้า',
        },
        {
          text: 'รายการขายสินค้าทั้งหมด',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/sale/sale',
    name: 'productSale',
    component: () => import('@/views/product/sale/Sale.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'ระบบสินค้า',
        },
        {
          text: 'รายการขายสินค้าทั้งหมด',
        },
        {
          text: 'ขายสินค้า',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/sale/report',
    name: 'saleProductReport',
    component: () => import('@/views/product/sale/components/SaleProductReport.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'ระบบสินค้า',
        },
        {
          text: 'รายการขายสินค้าทั้งหมด',
        },
        {
          text: 'ขายสินค้า',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/Order/Index',
    name: 'orderIndex',
    component: () => import('@/views/product/order/Index.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'ระบบสินค้า',
        },
        {
          text: 'รายการสั่งสินค้า',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/Order/Add',
    name: 'orderAdd',
    component: () => import('@/views/product/order/Add.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'ระบบสินค้า',
        },
        {
          text: 'รายการสั่งสินค้า',
          to: '/product/Order/Index',
        },
        {
          text: 'สั่งสินค้า',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/Order/Edit',
    name: 'orderEdit',
    component: () => import('@/views/product/order/Edit.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'ระบบสินค้า',
        },
        {
          text: 'รายการสั่งสินค้า',
          to: '/product/Order/Index',
        },
        {
          text: 'แก้ไขรายการสั่ง',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/Order/OrderReport',
    name: 'orderReport',
    component: () => import('@/views/product/order/OrderReport.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'ระบบสินค้า',
        },
        {
          text: 'รายการสั่งสินค้า',
          to: '/product/Order/Index',
        },
        {
          text: 'พิมพ์ใบสั่งสินค้า',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/Receive',
    name: 'productReceive',
    component: () => import('@/views/product/Receive.vue'),
    meta: {
      breadcrumb: [
        {
          text: 'ระบบสินค้า',
        },
        {
          text: 'ข้อมูลสินค้าทั้งหมด',
          active: true,
        },
      ],
    },
  },
]
